<?php

namespace Database\Factories;

use App\Enums\DefaultImagesEnum;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unit=Unit::query()->inRandomOrder()->first();
        return [
            'name' => fake()->word(),
            'price' => fake()->numberBetween(100, 10000),
            'unit_id' => $unit->id,
            'short_description' => fake()->sentence(),
            'main_description' => fake()->realText(),
            'on_sale' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
