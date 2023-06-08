<?php

use App\Http\Controllers\User\Auth\EmailVerificationController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('verification/email', [EmailVerificationController::class, 'verify'])->name('email_verification');

Route::post('password/reset', [PasswordResetController::class, 'sendMail'])->name('password.reset.mail');
Route::put('password/reset', [PasswordResetController::class, 'update'])->name('password.update');

Route::group(['middleware' => ['auth']], function () {
    Route::put('user/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('user/profile', [PasswordResetController::class, 'changePassword'])->name('password.change');
});
