<?php

namespace Tests\Feature\User\Auth;

use App\Models\User;
use App\Notifications\User\Auth\SendResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendResetPasswordNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_notification_is_sent()
    {
        Notification::fake();

        $user = User::factory()->create();

        $token = 'test-reset-token';

        $user->notify(new SendResetPasswordNotification($user, $token));

        Notification::assertSentTo($user, SendResetPasswordNotification::class, function ($notification) use ($token) {
            return $notification->token === $token;
        });
    }
}
