<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile.show', ['user' => User::factory()->create()]);
    }
}
