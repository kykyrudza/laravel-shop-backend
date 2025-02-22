<?php

namespace App\Listeners\User\Auth;

use App\Events\User\Auth\UserLogging;
use App\Jobs\User\Auth\SendUserLoggingNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserLoggingNotification implements ShouldQueue
{
    public function handle(UserLogging $event): void
    {
        SendUserLoggingNotificationJob::dispatch($event->user);
    }
}
