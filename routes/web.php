<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\VerificationController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])
    ->name('home');

Route::post('locale', [MainController::class, 'locale'])
    ->name('locale.change');

Route::middleware('auth')->group(function () {

    Route::get('/profile/{user_id}', [UserController::class, 'index'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'store'])->name('profile.update');
    Route::post('/profile/add/address', [UserController::class, 'addAddress'])->name('profile.add.address');
    Route::put('/profile/password/update', [UserController::class, 'password'])->name('profile.password.update');

    Route::get('/{user_id}/orders}', [UserController::class, 'orders'])->name('profile.orders');

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

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');

require __DIR__ . '/auth.php';
