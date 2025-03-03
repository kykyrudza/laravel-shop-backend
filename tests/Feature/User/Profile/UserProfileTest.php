<?php

namespace Tests\Feature\User\Profile;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_user_can_visit_profile()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('profile', ['user_id' => $user->id]));

        $response->assertStatus(200);
    }

    #[Test]
    public function test_user_can_update_account()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->put(route('profile.update'), [
            'name' => 'Test Name',
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com',
        ]);
    }
    #[Test]
    public function test_user_can_change_password()
    {
        $this->refreshDatabase();

        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);

        $this->actingAs($user);

        $response = $this->put(route('profile.password.update'), [
            'current_password' => 'password',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $user->refresh();

        $this->assertTrue(Hash::check('new_password', $user->password));
    }
}
