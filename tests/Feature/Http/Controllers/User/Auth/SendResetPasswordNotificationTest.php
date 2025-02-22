<?php


namespace Tests\Feature\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserLoginAction;
use App\Exceptions\User\Auth\UserLoginException;
use App\Models\User;
use App\Notifications\User\Auth\SendResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\Test;
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
