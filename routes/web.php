<?php

use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\General\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)->name('home');

Route::get('register', [RegisterController::class, 'showForm'])->name('register.form');
Route::get('login', [LoginController::class, 'showForm'])->name('login.form');

Route::get('user/profile', [UserProfileController::class, 'show']);

Route::get('password/reset-request', [PasswordResetController::class, 'requestMailForm'])->name('password.reset.request');
Route::get('password/reset-form', [PasswordResetController::class, 'newPasswordFrom'])->name('password.reset.new_password');

