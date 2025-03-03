<?php

namespace App\Services\Products;

use App\Exceptions\Products\ProductNotFound;
use App\Models\Product;
use App\Repositories\Products\ProductRepository;
use Throwable;

class ProductShowService
{
    public function __construct(
        protected ProductRepository $repository
    ) {
    }

    /**
     * @throws ProductNotFound
     */
    public function handle(string $slug): Product
    {
        try {
            return $this->repository->getProduct($slug);
        } catch (Throwable $e) {
            throw new ProductNotFound(
                __('errors.products.not-found'),
                0,
                $e
            );
        }
    }
}
