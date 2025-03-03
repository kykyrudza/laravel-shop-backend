<?php

namespace App\Mail\User\Auth;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;

class SuccessLoggingEmail extends Mailable
{
    public User $user;
    public Carbon $loginTime;

    public function __construct($user)
    {
        $this->user = $user;
        $this->loginTime = now();
    }

    public function build(): SuccessLoggingEmail
    {
        return $this->to($this->user->email)
            ->subject('Успешный вход')
            ->view('mail.auth.SuccessLoggingNotification')
            ->with([
                'name' => $this->user->name,
                'loginTime' => $this->loginTime,
            ]);
    }
}
