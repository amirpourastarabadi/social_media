<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Requests\User\Password\PasswordResetRequest;
use App\Events\User\PasswordResetRequestEvent;
use App\Http\Controllers\Controller;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('auth.password.resetForm');
    }

    public function sendMail(PasswordResetRequest $request)
    {
        PasswordResetRequestEvent::dispatch($request->validated('email'));

        return response()->json(['message' => "An mail sent to {$request->email}."]);
    }
}
