<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Services\User\Profile\UserProfileUpdateService;
use Illuminate\Support\ServiceProvider;

class UserProfileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserProfileUpdateService::class, function () {
            return new UserProfileUpdateService(new UserRepository);
        });
    }
}
