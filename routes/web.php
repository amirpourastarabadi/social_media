<?php

use App\Http\Controllers\User\Auth\RegisterController;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisterController::class, 'showForm']);
