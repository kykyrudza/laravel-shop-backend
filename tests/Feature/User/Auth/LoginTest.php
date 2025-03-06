<?php

namespace Tests\Feature\User\Auth;

use App\Actions\User\Auth\UserLoginAction;
use App\Exceptions\User\Auth\UserLoginException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function test_user_can_login()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('Password@123'),
        ];

        $user = User::query()->create($userData);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'Password@123',
        ]);

        $this->assertAuthenticated();

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');
    }

    #[Test]
    public function test_user_login_has_validation_errors()
    {
        $data = [
            'email' => 'invalid-email',
            'password' => 'short',
        ];

        $response = $this->post(route('login.store'), $data);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'email',
            'password',
        ]);
    }

    #[Test]
    public function test_user_can_not_login()
    {
        $this->partialMock(UserLoginAction::class, function ($mock) {
            $mock->shouldReceive('handle')->once()->andThrow(new UserLoginException('Ошибка при регистрации.'));
        });

        $data = [
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Password123!',
        ];

        $response = $this->post(route('login.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
    }
}
