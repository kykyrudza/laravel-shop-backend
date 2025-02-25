<?php

namespace App\Repositories\Products;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function getProduct(string $slug): Product
    {
        return Product::query()
            ->where('slug', $slug)
            ->with(['category', 'parameters', 'images'])
            ->firstOrFail();
    }

    public function getProducts(int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()
            ->with(['category', 'parameters', 'images'])
            ->paginate($perPage);
    }
}
