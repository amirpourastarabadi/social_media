<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('auth.password.resetForm');
    }
}
