<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use App\Mail\EmailContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailComposerController extends Controller
{
    public function composer(Request $request)
    {
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->get();
        return view('admin.email.composer', $data);
    }

    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'recipient_email' => 'nullable|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'cc_email' => 'nullable|email',
            'attachments' => 'nullable|array',
        ]);

        //recipient details
        $recipient = User::findOrFail($validatedData['recipient_id']);
        $recipientEmail = $recipient->email;
        $recipientName = $recipient->name;

        //email record
        $email = Email::create([
            'user_id' => $recipient->id,
            'recipient_name' => $recipientName,
            'recipient_email' => $recipientEmail,
            'cc_email' => $validatedData['cc_email'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
            'status' => 'draft',
            'attachments' => $validatedData['attachments'] ?? [],
        ]);

        try {
            // Send email using Mailtrap configuration from .env
            $mailer = Mail::to($recipientEmail);

            if ($validatedData['cc_email']) {
                $mailer->cc($validatedData['cc_email']);
            }

            $mailer->send(new EmailContent($email));

            // Update status after successful send
            $email->update([
                'status' => 'sent',
                'sent_at' => now()
            ]);

            return redirect()->back()->with('success', 'Email sent successfully to Mailtrap');

        } catch (\Exception $e) {
            \Log::error('Failed to send email to Mailtrap: ' . $e->getMessage());

            $email->update(['status' => 'failed']);

            return redirect()->back()
                ->withErrors(['email' => 'Failed to send email to Mailtrap. Error: ' . $e->getMessage()]);
        }
    }

    public function sent()
    {
        $sentEmails = Email::where('status', 'sent')
            ->with('user')
            ->latest('sent_at')
            ->paginate(10);

        $totalEmails = Email::where('status', 'sent')->count();

        $dateRange = [
            'from' => Email::where('status', 'sent')->min('sent_at'),
            'to' => Email::where('status', 'sent')->max('sent_at')
        ];

        return view('admin.email.sent', compact('sentEmails', 'totalEmails', 'dateRange'));
    }

    public function read($id)
    {
        // Get email with user relationship only since attachments relationship doesn't exist
        $email = Email::with('user')
                      ->findOrFail($id);

        // Check if user has permission to read this email
        if (Auth::id() !== $email->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Mark as read if not already read
        if (!$email->read_at) {
            $email->update([
                'read_at' => now()
            ]);
        }

        // Get related emails (same subject/thread)
        $relatedEmails = Email::where('subject', $email->subject)
                             ->where('id', '!=', $email->id)
                             ->latest()
                             ->limit(5)
                             ->get();

        return view('admin.email.read', [
            'email' => $email,
            'relatedEmails' => $relatedEmails
        ]);
    }


    public function storeDraft(Request $request)
    {
        $validatedData = $request->validate([
            'recipient_email' => 'nullable|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'cc_email' => 'nullable|email',
            'attachments' => 'nullable|array',
        ]);

        $email = new Email();
        $email->user_id = Auth::id();
        $email->recipient_name = User::where('email', $validatedData['recipient_email'])->value('name');
        $email->recipient_email = $validatedData['recipient_email'];
        $email->cc_email = $validatedData['cc_email'] ?? null;
        $email->subject = $validatedData['subject'];
        $email->message = $validatedData['message'];
        $email->status = 'draft';
        $email->attachments = $validatedData['attachments'] ?? [];
        $email->save();

        return redirect()->back()->with('success', 'Draft saved successfully');
    }

    public function getDrafts()
    {
        $drafts = Email::where('user_id', Auth::id())
                        ->where('status', 'draft')
                        ->latest()
                        ->paginate(10);

        return view('admin.emails.drafts', compact('drafts'));
    }

    public function updateDraft(Request $request, $id)
    {
        $email = Email::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->where('status', 'draft')
                      ->firstOrFail();

        $validatedData = $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'cc_email' => 'nullable|email',
            'attachments' => 'nullable|array',
        ]);

        $email->recipient_name = User::where('email', $validatedData['recipient_email'])->value('name');
        $email->recipient_email = $validatedData['recipient_email'];
        $email->cc_email = $validatedData['cc_email'] ?? null;
        $email->subject = $validatedData['subject'];
        $email->message = $validatedData['message'];
        $email->attachments = $validatedData['attachments'] ?? [];
        $email->save();

        return redirect()->back()->with('success', 'Draft updated successfully');
    }
}