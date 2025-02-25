<?php

namespace App\Mail\User\Auth;

use Illuminate\Mail\Mailable;

class SuccessLoggingNotification extends Mailable
{
    public $user;
    public $loginTime;

    public function __construct($user)
    {
        $this->user = $user;
        $this->loginTime = now();
    }

    public function build()
    {
        return $this->subject('Успешный вход')
            ->view('mail.auth.SuccessLoggingNotification')
            ->with([
                'name' => $this->user->name,
                'loginTime' => $this->loginTime,
            ]);
    }
}
