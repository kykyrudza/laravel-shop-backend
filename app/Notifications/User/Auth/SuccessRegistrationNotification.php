<?php

namespace App\Notifications\User\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\User\Auth\SuccessRegistrationNotification as SuccessRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SuccessRegistrationNotification extends Notification implements ShouldQueue
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

    public function toMail($notifiable): SuccessRegistration
    {
        return new SuccessRegistration($this->user);
    }
}
