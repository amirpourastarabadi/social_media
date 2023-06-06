<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Resources\User\Authentication\Register\RegisteredUserResource;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Events\User\RegistrationEvent;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register.form');
    }

    public function register(RegisterRequest $request)
    {
        $result = RegistrationEvent::dispatch($request->validated()); 

        return RegisteredUserResource::make($result[0]); 
    }
}
