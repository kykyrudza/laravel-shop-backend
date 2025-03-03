<?php

namespace App\Notifications\User\Auth;

use App\Mail\User\Auth\SuccessLoggingEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SuccessLoggingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public readonly User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): SuccessLoggingEmail
    {
        return (new SuccessLoggingEmail($this->user))
            ->to($notifiable->email);
    }
}
