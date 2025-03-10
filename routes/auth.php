<?php

use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisterController::class, 'index'])
        ->name('register');
    Route::post('register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('login', [LoginController::class, 'store'])
        ->name('login.store');

    Route::get('password/reset', [ForgotPasswordController::class, 'index'])
        ->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'index'])
        ->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'store'])
        ->name('password.update');

});
