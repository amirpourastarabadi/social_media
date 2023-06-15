<?php

namespace Tests\Feature\User\FollwSystem;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\User\UserTestCase;
use Tests\TestCase;

class FollowControllerTest extends UserTestCase
{
    use RefreshDatabase;
    
    public function test_when_user_follow_other_user_it_appears_in_its_following_list(): void
    {
        // create three user
        // one user follow other one
        // followed user appears it following list
        // third user not appears it following list
    }

    public function test_when_user_follow_other_user_second_user_receive_a_following_notification(): void
    {
        // create three user
        // one user follow other one
        // followed user appears it following list
        // third user not appears it following list
    }

    public function test_guest_user_cant_request_for_following():void
    {
        // create user
        // request for follow
        // cant pass auth middleware
    }
}
