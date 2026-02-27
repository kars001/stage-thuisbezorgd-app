<?php

namespace Tests\Feature\Auth;

use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_page(): void
    {
        $response = $this->get('authentication/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post('/authentication/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    public function test_user_cannot_login_with_incorrect_password(): void
    {
        $response = $this->post('/authenticate/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_user_is_redirected_to_home_if_already_authenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/authentication/login');

        $response->assertRedirect('/');
    }

    public function test_root_url_redirects_to_login_page_for_guests(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/authentication/login');
    }
}
