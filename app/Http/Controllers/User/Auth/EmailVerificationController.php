<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\EmailVerificationEvent;
use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $result = EmailVerificationEvent::dispatch($request->email, $request->token);
        
        return response()->json(['message' => $result[1]]);
    }
}
