<?php

namespace Tests\Feature\User\PasswrodReset;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_password_reset_link_sent_to_requested_email_for_password_reset(): void
    {
        Mail::fake();

        $user = User::factory()->create();

        $inputs = ['email' => $user->email];

        $response = $this->postJson('/api/password/reset', $inputs);

        $response->assertSuccessful();
        $response->assertJson(
            fn (AssertableJson $response) =>
            $response->where('message', "An mail sent to {$inputs['email']}.")
                ->etc()
        );
        $this->assertDatabaseHas('password_resets', [
            'user_id' => $user->id,
            'token' => $user->passwordResetToken()->first()->token
        ]);

        Mail::assertSent(ResetPasswordEmail::class);
    }
}
