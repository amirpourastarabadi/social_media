<?php

namespace Tests\Feature\User;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{

    use RefreshDatabase;

    public function test_requested_token_verify_user_email(): void
    {
        $this->freezeTime();
        $user = User::factory()->create();
        $token = $user->email_verification_token;

        $this->assertDatabaseHas('email_verification_tokens', ['token' => $token]);
        
        $response = $this->getJson(
            route(
                'api.email_verification',
                [
                    'token' => $token,
                    'email' => $user->email
                ]
            )
        );

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('message', 'email verified successfully')
                ->etc()
        );
        $this->assertDatabaseMissing('email_verification_tokens', ['token' => $token]);
    }

    public function test_invalid_requested_fail_to_verify_email(): void
    {
        $user = User::factory()->create();
        $token = 'invalid token';
        $response = $this->getJson(
            route(
                'api.email_verification',
                [
                    'token' => $token,
                    'email' => $user->email
                ]
            )
        );

        $response->assertStatus(500);

        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('message', 'invalid request')
                ->etc()
        );

        $this->assertDatabaseHas('email_verification_tokens', ['token' => $user->email_verification_token]);
    }
}
