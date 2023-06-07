<?php

namespace App\Http\Controllers\User;

use App\Events\User\UpdateUserProfileEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile.show', ['user' => User::factory()->create()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        UpdateUserProfileEvent::dispatch(auth()->user(), $request->validated());
        return response()->json([], 200);
    }
}
