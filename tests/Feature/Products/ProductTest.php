<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Parameter;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_app_can_create_product()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create(['category_id' => $category->id]);

        $product->images()->create([
            'image' => 'image.jpg',
        ]);

        Parameter::factory()->create(['product_id' => $product->id]);

        $response = $this->get(route('product.show', $product->slug));

        $response->assertStatus(200);
    }

    #[Test]
    public function test_product_page_request_and_cache()
    {
        Cache::flush();

        Category::factory()->count(10)->create();
        Product::factory()->count(20)->create();

        $page = 1;
        $perPage = 10;
        $cacheKey = "products_{$perPage}_page_{$page}";

        $this->assertFalse(Cache::has($cacheKey));

        DB::enableQueryLog();

        $response = $this->get(route('products.index', ['page' => $page]));
        $response->assertStatus(200);

        $this->assertTrue(Cache::has($cacheKey));

        $queriesAfterFirstRequest = DB::getQueryLog();
        $this->assertNotEmpty($queriesAfterFirstRequest, 'Первый запрос должен загружать данные из БД');

        DB::flushQueryLog();

        $response = $this->get(route('products.index', ['page' => $page]));
        $response->assertStatus(200);

        $queriesAfterSecondRequest = DB::getQueryLog();
        $this->assertCount(0, $queriesAfterSecondRequest, 'Данные не должны запрашиваться из БД при наличии кеша');
    }
}
