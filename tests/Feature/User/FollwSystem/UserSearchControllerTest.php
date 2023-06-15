<?php

namespace Tests\Feature\User\FollwSystem;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\User\UserTestCase;
use Tests\TestCase;

class UserSearchControllerTest extends UserTestCase
{
    use RefreshDatabase;

    public function test_user_can_search_user_with_name_and_email(): void
    {
        // create three user
        // first user search for second user name
        // second user appears in result but not third one
        // first user search for third user email
        // third user appears in result but not second one
    }

    public function test_guest_user_cant_use_search_option(): void
    {
        // create a user
        // cant pass auth middleware when search for others
    }
}
