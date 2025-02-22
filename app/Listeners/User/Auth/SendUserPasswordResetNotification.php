<?php

namespace App\Listeners\User\Auth;

use App\Events\User\Auth\ResetPasswordEmail;
use App\Jobs\User\Auth\SendUserPasswordResetNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserPasswordResetNotification implements ShouldQueue
{
    public function handle(ResetPasswordEmail $event): void
    {
        SendUserPasswordResetNotificationJob::dispatch($event->user, $event->token);
    }
}
