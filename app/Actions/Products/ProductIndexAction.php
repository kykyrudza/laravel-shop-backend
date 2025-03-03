<?php

namespace App\Actions\Products;

use App\Exceptions\Products\ProductNotFound;
use App\Services\Products\ProductIndexService;
use Illuminate\Contracts\View\View;

class ProductIndexAction
{
    public function __construct(
        protected ProductIndexService $service,
    ) {
    }

    /**
     * @throws ProductNotFound
     */
    public function handle(): View
    {
        return $this->service->cached();
    }
}
