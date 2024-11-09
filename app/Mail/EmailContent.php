<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailContent extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailData;

    public function __construct(Email $email)
    {
        $this->emailData = $email;
    }

    public function build()
{
    return $this->from(config('mail.from.address'), config('mail.from.name'))
                ->subject($this->emailData->subject)
                ->view('emails.generic')
                ->with([
                    'subject' => $this->emailData->subject,
                    'emailContent' => $this->emailData->message, // Changed variable name here
                    'recipient_name' => $this->emailData->recipient_name,
                ]);
}


}