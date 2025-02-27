<?php

namespace App\Jobs\User\Auth;

use App\Models\User;
use App\Notifications\User\Auth\SuccessLoggingNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendUserLoggingNotificationJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public readonly User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        $this->user->notify(new SuccessLoggingNotification($this->user));
    }
}
