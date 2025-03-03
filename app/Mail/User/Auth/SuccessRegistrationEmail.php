<?php

namespace App\Mail\User\Auth;

use App\Models\User;
use Illuminate\Mail\Mailable;

class SuccessRegistrationEmail extends Mailable
{
    public User $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build(): SuccessRegistrationEmail
    {
        return $this->to($this->user->email)
            ->subject('Добро пожаловать в наш сервис!')
            ->view('mail.auth.SuccessRegistrationNotification')
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
