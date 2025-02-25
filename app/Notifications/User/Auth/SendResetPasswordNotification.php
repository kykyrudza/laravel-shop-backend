<?php

namespace App\Notifications\User\Auth;

use App\Mail\User\Auth\SendResetPasswordEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public readonly User $user;

    public readonly string $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): SendResetPasswordEmail
    {
        return (new SendResetPasswordEmail($notifiable, $this->token))
            ->to($notifiable->email);
    }
}
