<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

class UpdateProfileTest extends UserTestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_update_its_profile(): void
    {
        $this->login();
        $inputs = [
            "name" => "updated name",
            "email" => "updadte_email@example.net",
            "bio" => "updated bio",
            "image" => UploadedFile::fake()->image('new_image.png'),
        ];

        $response = $this->putJson('/api/user/profile', $inputs);
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $this->authUser->id,
            'name' => $inputs['name'],
            'email' => $inputs['email'],
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $this->authUser->id,
            'bio' => $inputs['bio'],
        ]);
    }

    public function test_gust_user_cannot_update_its_profile(): void
    {
        $inputs = [
            "name" => "updated name",
            "email" => "updadte_email@example.net",
            "bio" => "updated bio",
            "image" => UploadedFile::fake()->image('new_image.png'),
        ];

        $response = $this->putJson('/api/user/profile', $inputs);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
