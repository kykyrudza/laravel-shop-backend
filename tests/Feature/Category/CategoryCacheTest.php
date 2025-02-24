<?php

namespace Tests\Feature\Category;


use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryCacheTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_caches_categories_after_first_query()
    {
        Cache::flush();

        Category::factory()->count(3)->create();

        DB::enableQueryLog();

        $this->get(route('home'));

        $queryCountAfterFirstRequest = count(DB::getQueryLog());

        DB::flushQueryLog();

        $this->get(route('home'));

        $this->assertCount($queryCountAfterFirstRequest, DB::getQueryLog(), 'Кеш не используется');
    }
}
