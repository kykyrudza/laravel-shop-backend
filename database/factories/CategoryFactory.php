<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->optional()->realText(100),
            'status' => $this->faker->boolean(),
            'sort_order' => $this->faker->numberBetween(0, 100),
            'parent_id' => null,
        ];
    }
}
