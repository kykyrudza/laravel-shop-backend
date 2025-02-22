<?php

namespace App\Notifications\User\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Запрос на сброс пароля')
            ->greeting("Здравствуйте, {$notifiable->name}!")
            ->line('Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашего аккаунта.')
            ->action('Сбросить пароль', url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->email
            ], false)))
            ->line('Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.')
            ->line('Ссылка для сброса пароля будет действительна в течение 60 минут.')
            ->line('Спасибо, что пользуетесь нашим сервисом!');
    }
}
