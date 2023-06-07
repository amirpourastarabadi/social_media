<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tests\TestCase;

class UserTestCase extends TestCase
{
    use RefreshDatabase;

    protected User|null $authUser = null;

    protected function login(null|User $user = null): void
    {
        $this->authUser = $user ?? User::factory()->create();

        Auth::guard('api')->login($this->authUser);
    }
}
