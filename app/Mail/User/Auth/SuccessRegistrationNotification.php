<?php

namespace App\Mail\User\Auth;

use Illuminate\Mail\Mailable;

class SuccessRegistrationNotification extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Добро пожаловать в наш сервис!')
            ->view('mail.auth.SuccessRegistrationNotification')
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
