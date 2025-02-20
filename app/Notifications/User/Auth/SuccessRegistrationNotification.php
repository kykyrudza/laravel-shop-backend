<?php

namespace App\Notifications\User\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Успешная регистрация')
            ->greeting("Привет, {$this->user->name}!")
            ->line('Вы успешно зарегистрировались в нашем сервисе.')
            ->action('Перейти на сайт', url('/'))
            ->line('Спасибо, что выбрали нас!');
    }
}
