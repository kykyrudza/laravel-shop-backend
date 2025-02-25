<?php

namespace App\Listeners\User\Auth;

use App\Events\User\Auth\UserRegistered;
use App\Jobs\User\Auth\SendUserRegisteredNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserRegisteredNotification implements ShouldQueue
{
    public function handle(UserRegistered $event): void
    {
        SendUserRegisteredNotificationJob::dispatch($event->user);
    }
}
