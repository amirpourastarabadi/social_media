<?php

use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)->name('home');

Route::get('register', [RegisterController::class, 'showForm'])->name('register.form');
Route::get('login', [LoginController::class, 'showForm'])->name('login.form');


Route::get('password/reset-request', [PasswordResetController::class, 'requestMailForm'])->name('password.reset.request');
Route::get('password/reset-form', [PasswordResetController::class, 'newPasswordFrom'])->name('password.reset.new_password');

// Route::group(['middleware' => ['auth']],  function () {
    Route::get('user/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::get('user/{user:uuid}', [UserController::class, 'show'])->name('user');
// });
