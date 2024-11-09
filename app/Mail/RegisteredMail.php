<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $rememberToken;

    public function __construct(User $user, $rememberToken)
    {
        $this->user = $user;
        $this->rememberToken = $rememberToken;
    }

    public function build()
    {
    return $this->markdown('emails.register')
                ->subject(config('app.name') . ' - Register Mail Password Set');
    }



}