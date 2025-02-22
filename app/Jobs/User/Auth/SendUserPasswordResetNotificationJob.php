<?php

namespace App\Jobs\User\Auth;

use App\Models\User;
use App\Notifications\User\Auth\SendResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendUserPasswordResetNotificationJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public readonly User $user;

    public readonly string $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function handle(): void
    {
        $this->user->notify(new SendResetPasswordNotification($this->user, $this->token));
    }
}
