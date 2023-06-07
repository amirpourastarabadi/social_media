<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Resources\User\Authentication\Login\LoginUserResource;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login.form');
    }

    public function login(LoginRequest $request)
    {
        if(!$user = User::attemptToLogin($request->validated())){
            return response()->json(['message' => 'invalid credentials.'], Response::HTTP_UNAUTHORIZED);
        }

        return LoginUserResource::make($user);
    }
}
