<?php

namespace App\Providers;

use App\Repositories\Products\ProductRepository;
use App\Services\Products\ProductIndexService;
use App\Services\Products\ProductShowService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductShowService::class, function () {
            return new ProductShowService(new ProductRepository);
        });
        $this->app->singleton(ProductIndexService::class, function () {
            return new ProductIndexService(new ProductRepository);
        });
    }
}
