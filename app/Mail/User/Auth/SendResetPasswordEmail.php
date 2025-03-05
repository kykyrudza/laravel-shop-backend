<?php

namespace App\Mail\User\Auth;

use Illuminate\Mail\Mailable;

class SendResetPasswordEmail extends Mailable
{
    public $notifiable;

    public $token;

    public function __construct($notifiable, $token)
    {
        $this->notifiable = $notifiable;
        $this->token = $token;
    }

    public function build(): SendResetPasswordEmail
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->notifiable->email,
        ], false));

        return $this->subject('Запрос на сброс пароля')
            ->view('mail.auth.SendResetPasswordEmail')
            ->with([
                'name' => $this->notifiable->name,
                'resetUrl' => $resetUrl,
            ]);
    }
}
