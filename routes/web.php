<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])
    ->name('home');

Route::post('locale', [MainController::class, 'locale'])
    ->name('locale.change');

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

Route::middleware('auth')->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::post('email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('product.show');
