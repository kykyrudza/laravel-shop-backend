<?php

namespace App\Actions\Products;

use App\Exceptions\Products\ProductNotFound;
use App\Models\Product;
use App\Services\Products\ProductShowService;

class ProductShowAction
{
    public function __construct(
        protected ProductShowService $service,
    ) {}

    /**
     * @throws ProductNotFound
     */
    public function handle(string $slug): Product
    {
        return $this->service->handle($slug);
    }
}
