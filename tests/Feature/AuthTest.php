<?php

namespace Tests\Feature;

use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function test_user_cannot_login_with_invalid_credentials_when_user_exists(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->assertDatabaseHas('audit_trails', [
            'user_id' => $user->id,
            'action' => 'Login Gagal',
        ]);

        $audit = AuditTrail::first();
        $this->assertEquals('test@example.com', $audit->properties['email']);
    }

    public function test_user_cannot_login_with_invalid_credentials_when_user_does_not_exist(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->assertDatabaseHas('audit_trails', [
            'user_id' => null,
            'action' => 'Login Gagal',
        ]);

        $audit = AuditTrail::first();
        $this->assertEquals('nonexistent@example.com', $audit->properties['email']);
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('audit_trails', [
            'user_id' => $user->id,
            'action' => 'Login Berhasil',
        ]);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();

        $this->assertDatabaseHas('audit_trails', [
            'user_id' => $user->id,
            'action' => 'Logout',
        ]);
    }

    public function test_user_with_2fa_enabled_is_redirected_to_challenge(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'two_factor_secret' => 'secret_placeholder',
            'two_factor_recovery_codes' => 'recovery_placeholder',
            'two_factor_confirmed_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/two-factor-challenge');
        $this->assertGuest();
    }

    public function test_password_confirmation_page_renders_successfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/user/confirm-password');

        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Password');
    }

    public function test_forgot_password_page_renders_successfully(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
        $response->assertSee('Lupa Password');
    }

    public function test_forgot_password_sends_reset_link(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHas('status');
    }

    public function test_forgot_password_does_not_reveal_whether_email_exists(): void
    {
        $response = $this->post('/forgot-password', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertSessionHas('status');
    }

    public function test_user_can_reset_password_with_valid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old_password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'test@example.com',
            'password' => 'new_password123',
            'password_confirmation' => 'new_password123',
        ]);

        $response->assertSessionHas('status');
        $this->assertTrue(Hash::check('new_password123', $user->fresh()->password));

        $this->assertDatabaseHas('audit_trails', [
            'user_id' => $user->id,
            'action' => 'Reset Password Berhasil',
        ]);
    }

    public function test_user_cannot_reset_password_with_invalid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old_password'),
        ]);

        $response = $this->post('/reset-password', [
            'token' => 'invalid-token',
            'email' => 'test@example.com',
            'password' => 'new_password123',
            'password_confirmation' => 'new_password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('old_password', $user->fresh()->password));
    }

    public function test_user_cannot_reset_password_with_mismatched_confirmation(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old_password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'test@example.com',
            'password' => 'new_password123',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('old_password', $user->fresh()->password));
    }
}
