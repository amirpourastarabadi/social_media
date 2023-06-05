<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\User\RegistrationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register.form');
    }

    public function register(RegisterRequest $request)
    {
        RegistrationEvent::dispatch($request->validated());

        return response()->json(['message' => 'please verify your email to continue.']);
    }
}
