<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Requests\User\Password\PasswordResetRequest;
use App\Events\User\PasswordResetRequestEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Password\PasswordUpdatedRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    public function requestMailForm()
    {
        return view('auth.password.resetForm');
    }

    public function newPasswordFrom(Request $request)
    {
        return view('auth.password.newPasswordForm', ['token' => $request->get('token'), 'email' => $request->get('email')]);
    }

    public function sendMail(PasswordResetRequest $request)
    {
        PasswordResetRequestEvent::dispatch($request->validated('email'));

        return response()->json(['message' => "An mail sent to {$request->email}."]);
    }

    public function update(PasswordUpdatedRequest $request)
    {

        $user = User::where('email', $request->validated('email'))->first();
        
        if(is_null($user)){
            abort(Response::HTTP_UNAUTHORIZED);
        }
        if($user->reset_password_token !== $request->validated('token'))
        {
            abort(Response::HTTP_UNAUTHORIZED);
        }
        
        $user->update(['password' => $request->validated('password')]);
        
        $token = User::attemptToLogin($request->only('password', 'email'))->auth_token;

        return response()->json(['message' => 'password updated', 'auth_token' => $token, 'redirect_to' => route('home')]);
    }
}
