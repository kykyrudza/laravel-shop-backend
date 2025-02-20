<?php

namespace Tests\Feature\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserRegisterAction;
use App\Exceptions\User\Auth\UserRegisterException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function test_store_success()
    {
        //Event::fake();

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ];

        $response = $this->post(route('register.store'), $userData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

       // Event::assertDispatched(UserRegistered::class);
    }

    #[Test]
    public function test_store_validation_errors()
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
    public function test_store_failure()
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
    public function test_store_email_already_exists()
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
