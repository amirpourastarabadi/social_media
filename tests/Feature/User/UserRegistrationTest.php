<?php

namespace Tests\Feature\User;

use App\Listeners\User\SendVerificationEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
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
        $response->assertStatus(200);
        $response->assertJson(
            fn(AssertableJson $response) =>
            $response->where('message', 'please verify your email to continue.')
                     ->etc()
        );
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', Arr::except($inputs, ['password_confirmation', 'password']));
    }
}
