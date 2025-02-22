<?php

namespace Tests\Feature\User\Auth;

use App\Actions\User\Auth\UserRegisterAction;
use App\Exceptions\User\Auth\UserRegisterException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ];

        $response = $this->post(route('register.store'), $userData);

        $response->assertStatus(302);

        $response->assertStatus(302);

        if (! User::where('email', $userData['email'])->exists()) {
            dd('Пользователь не создан в базе');
        }

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    #[Test]
    public function test_user_register_has_validation_errors()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email',
            'phone' => 'invalid-phone',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
        ];

        $response = $this->post(route('register.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone',
            'password',
        ]);
    }

    #[Test]
    public function test_user_can_not_register()
    {
        $this->partialMock(UserRegisterAction::class, function ($mock) {
            $mock->shouldReceive('handle')->once()->andThrow(new UserRegisterException('Ошибка при регистрации.'));
        });

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => '1234567890',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $response = $this->post(route('register.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

    #[Test]
    public function test_user_register_error_email_exist()
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $data = [
            'name' => $this->faker->name,
            'email' => 'existing@example.com',
            'phone' => '1234567890',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $response = $this->post(route('register.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
