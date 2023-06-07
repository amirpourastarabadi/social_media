<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;

class LoginTest extends UserTestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_login_and_get_auth_token(): void
    {
        $user = User::factory()->create();
        $inputs = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->postJson('/api/login', $inputs);

        $response->assertSuccessful();
        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('data.key', $user->uuid)
                ->where('data.email', $user->email)
                ->where('data.name', $user->name)
                ->has('data.auth_token')
                ->etc()
        );
        $this->assertTrue(Auth::guard('api')->check());
        $this->assertTrue(auth()->user()->is($user));
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
        $inputs = [
            'email' => $this->faker->email(),
            'password' => 'password'
        ];

        $response = $this->postJson('/api/login', $inputs);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('message', 'invalid credentials.')
                ->etc()
        );
        $this->assertFalse(Auth::guard('api')->check());
    }
}
