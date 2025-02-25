<?php

namespace Database\Factories;

use App\Models\Parameter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParameterFactory extends Factory
{
    protected $model = Parameter::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->unique()->word(),
            'description' => $this->faker->realText(100) ?? '',
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'type' => $this->faker->randomElement(['string', 'integer', 'float', 'boolean', 'date']),
            'unit' => $this->faker->optional()->randomElement(['kg', 'm', 'cm', 'pcs', 'l']),
            'default_value' => $this->faker->optional()->word(),
            'is_required' => $this->faker->boolean(),
            'is_filterable' => $this->faker->boolean(),
            'is_visible' => $this->faker->boolean(),
            'sort_order' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'min_value' => $this->faker->optional()->randomFloat(2, 0, 10),
            'max_value' => $this->faker->optional()->randomFloat(2, 10, 100),
            'validation_rules' => ['required', 'max:255'],
            'name_translations' => ['en' => $this->faker->word(), 'ru' => $this->faker->word()],
            'description_translations' => ['en' => $this->faker->realText(100), 'ru' => $this->faker->realText(100)],
        ];
    }
}
