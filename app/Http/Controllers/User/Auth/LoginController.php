<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Resources\User\Authentication\Login\LoginUserResource;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login.form');
    }

    public function login(LoginRequest $request)
    {
        $user = User::attemptToLogin($request->only('password', 'email'));

        return LoginUserResource::make($user);
    }
}
