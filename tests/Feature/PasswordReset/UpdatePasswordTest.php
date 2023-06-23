<?php

namespace Tests\Feature\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_update_password_if_has_right_token(): void
    {
        $user = User::factory()->create();
        PasswordReset::generateTokenForUser($user);
        
        $inputs = [
            'token' => $user->reset_password_token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        
        $response = $this->putJson('/api/password/reset', $inputs);
        $response->assertSuccessful();
        $user->refresh();
        
        $this->assertAuthenticated('api');

        $this->assertTrue(Auth::user()->is($user));
        
        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('message', 'password updated')
                ->where('auth_token', $user->auth_token)
                ->where('redirect_to', route('web.home'))
                ->etc()
        );
    }

    public function test_user_cannot_update_password_with_mismatch_mail_and_token(): void
    {
        $user = User::factory()->create();
        $maliciousUser = User::factory()->create();
        PasswordReset::generateTokenForUser($user);
        PasswordReset::generateTokenForUser($maliciousUser);
        
        $inputs = [
            'token' => $maliciousUser->reset_password_token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->putJson('/api/password/reset', $inputs);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertGuest('api');
    }

    public function test_user_cannot_update_password_of_invalid_password()
    {
        $user = User::factory()->create();
        PasswordReset::generateTokenForUser($user);
        
        $inputs = [
            'token' => $user->reset_password_token,
            'email' => $this->faker()->email(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->putJson('/api/password/reset', $inputs);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertGuest('api');
    }
}
