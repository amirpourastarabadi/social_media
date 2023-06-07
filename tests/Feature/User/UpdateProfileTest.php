<?php

namespace Tests\Feature\User;

use App\Utilities\FileSystem\FileSystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Mockery;
use Mockery\MockInterface;

class UpdateProfileTest extends UserTestCase
{
    use RefreshDatabase;

    private array $inputs = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->inputs = [
            'name'  => "updated name",
            'email' => "updadte_email@example.net",
            'bio'   => "updated bio",
            'image' => UploadedFile::fake()->image('new_image.png'),
        ];

        $this->mock(FileSystem::class, function (MockInterface $mock) {
            $mock->shouldReceive('uploadFile')->once()->andReturn($mock);
            $mock->shouldReceive('to')->once()->andReturn($mock);
            $mock->shouldReceive('organizeByDate')->once()->andReturn($mock);
            $mock->shouldReceive('save')->once()->andReturn('filename');
            Mockery::close();
        });
    }

    public function test_auth_user_can_update_its_profile(): void
    {
        $this->login();

        $response = $this->putJson('/api/user/profile', $this->inputs);
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $this->authUser->id,
            'name' => $this->inputs['name'],
            'email' => $this->inputs['email'],
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $this->authUser->id,
            'bio' => $this->inputs['bio'],
        ]);
    }

    public function test_gust_user_cannot_update_its_profile(): void
    {
        $response = $this->putJson('/api/user/profile', $this->inputs);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
