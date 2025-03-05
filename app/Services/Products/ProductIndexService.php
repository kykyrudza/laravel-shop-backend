<?php

namespace App\Services\Products;

use App\Exceptions\Products\ProductNotFound;
use App\Repositories\Products\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class ProductIndexService
{
    public function __construct(
        protected ProductRepository $repository
    ) {}

    /**
     * @throws ProductNotFound
     */
    public function handle(): LengthAwarePaginator
    {
        try {

            return $this->getProducts();

        } catch (Throwable $e) {
            throw new ProductNotFound('Something went wrong', 0, $e);
        }
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     */
    private function getProducts(): LengthAwarePaginator
    {
        return $this->getProductsFromCache() ?? $this->getProductsFromDatabase();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getProductsFromCache(): ?LengthAwarePaginator
    {
        $cacheKey = $this->getCacheKey();

        if (! cache()->has($cacheKey)) {
            return null;
        }

        return $this->createPaginatorFromCache($cacheKey);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws InvalidArgumentException
     */
    private function getProductsFromDatabase(): LengthAwarePaginator
    {
        $products = $this->repository->getProducts();
        $this->setCache($products);

        return $products;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws InvalidArgumentException
     */
    private function setCache(LengthAwarePaginator $products): void
    {
        $cacheKey = $this->getCacheKey();
        cache()->set($cacheKey, $this->formatCacheData($products), now()->addMinutes(30));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getCacheKey(): string
    {
        $page = request()->get('page', 1);
        $perPage = 10;

        return "products_{$perPage}_page_$page";
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function createPaginatorFromCache(string $cacheKey): LengthAwarePaginator
    {
        $cachedData = cache()->get($cacheKey);

        return new LengthAwarePaginator(
            collect($cachedData['items']),
            $cachedData['total'],
            $cachedData['per_page'],
            request()->get('page', 1),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    private function formatCacheData(LengthAwarePaginator $products): array
    {
        return [
            'items' => $products->getCollection()->toArray(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
        ];
    }
}
