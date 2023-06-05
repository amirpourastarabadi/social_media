<?php

use App\Http\Controllers\User\Auth\EmailVerificationController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('verification/email', [EmailVerificationController::class, 'verify'])->name('email_verification');

