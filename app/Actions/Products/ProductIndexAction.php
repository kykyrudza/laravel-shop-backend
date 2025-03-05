<?php

namespace App\Actions\Products;

use App\Exceptions\Products\ProductNotFound;
use App\Services\Products\ProductIndexService;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductIndexAction
{
    public function __construct(
        protected ProductIndexService $service,
    ) {}

    /**
     * @throws ProductNotFound
     */
    public function handle(): LengthAwarePaginator
    {
        return $this->service->handle();
    }
}
