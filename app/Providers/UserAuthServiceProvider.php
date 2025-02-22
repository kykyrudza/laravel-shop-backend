<?php

namespace App\Providers;

use App\Repositories\User\Auth\UserRepository;
use App\Services\User\Auth\UserResetPasswordFormService;
use App\Services\User\Auth\UserForgotPasswordEmailFormService;
use App\Services\User\Auth\UserLoginService;
use App\Services\User\Auth\UserRegisterService;
use Illuminate\Support\ServiceProvider;

class UserAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserRegisterService::class, function () {
            return new UserRegisterService(new UserRepository);
        });
        $this->app->singleton(UserLoginService::class, function (){
            return new UserLoginService(new UserRepository);
        });
        $this->app->singleton(UserForgotPasswordEmailFormService::class, function () {
            return new UserForgotPasswordEmailFormService(new UserRepository);
        });
        $this->app->singleton(UserResetPasswordFormService::class, function () {
            return new UserResetPasswordFormService(new UserRepository);
        });
    }

    public function boot(): void
    {
        //
    }
}
