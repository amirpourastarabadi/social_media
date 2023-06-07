<?php

namespace Tests\Feature\User;

use App\Listeners\User\SendVerificationEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $inputs = [
            'email'                 => 'example@gmail.com',
            'name'                  => 'user',
            'password'              => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/api/register', $inputs);
        $response->assertSuccessful();
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', Arr::except($inputs, ['password_confirmation', 'password']));
    }

    public function test_registered_user_response_structure(): void
    {
        $inputs = [
            'email'                 => 'example@gmail.com',
            'name'                  => 'user',
            'password'              => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/api/register', $inputs);
        $registeredUser = User::first();

        $response->assertJson(
            fn (AssertableJson $response) =>
            $response
                ->where('data.key', $registeredUser->uuid)
                ->where('data.name',     $registeredUser->name)
                ->whereNot('data.auth_token', null)
                ->where('data.is_verified', $registeredUser->is_verified)
                ->etc()
        );
    }
}
