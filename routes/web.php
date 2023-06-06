<?php

use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisterController::class, 'showForm']);
Route::get('user/profile', [UserProfileController::class, 'show']);
Route::get('user/password', [PasswordResetController::class, 'showForm'])->name('password.request');
