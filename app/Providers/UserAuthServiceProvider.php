<?php

namespace App\Providers;

use App\Repositories\User\Auth\UserRepository;
use App\Services\User\Auth\UserRegisterService;
use Illuminate\Support\ServiceProvider;

class UserAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserRegisterService::class, function () {
            return new UserRegisterService(new UserRepository);
        });
    }

    public function boot(): void
    {
        //
    }
}
