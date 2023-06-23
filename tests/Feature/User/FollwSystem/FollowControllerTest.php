<?php

namespace Tests\Feature\User\FollwSystem;

use App\Mail\NewConnectionEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\User\UserTestCase;
use Tests\TestCase;

class FollowControllerTest extends UserTestCase
{
    use RefreshDatabase;
    
    public function test_when_user_follow_other_user_it_appears_in_its_following_list(): void
    {
        $users = User::factory(3)->create();
        
        $this->login($users[0]);
        
        $response = $this->postJson(route('api.follow', ['following' => $users[1]]));

        $userFirstFollowing = $users[0]->followings()->select('following_id')->get()->pluck('following_id')->toArray();
        
        $this->assertContains($users[1]->getKey(), $userFirstFollowing);

        $this->assertNotContains($users[2]->getKey(), $userFirstFollowing);
    }

    public function test_when_user_follow_other_user_second_user_receive_a_following_notification(): void
    {
        Mail::fake();
       
        $users = User::factory(2)->create();
        
        $this->login($users[0]);
        
        $response = $this->postJson(route('api.follow', ['following' => $users[1]]));

        Mail::assertSent(NewConnectionEmail::class);
    }

    public function test_guest_user_cant_request_for_following():void
    {
        $users = User::factory(2)->create();
        
        $response = $this->postJson(route('api.follow', ['following' => $users[1]]));
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
