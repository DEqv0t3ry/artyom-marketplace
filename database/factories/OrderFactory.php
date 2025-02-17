<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product=Product::query()->inRandomOrder()->first();
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->regexify('/(\+79)\d{9}/'),
            'count' => fake()->numberBetween(1, 10),
            'product_id' => $product->id,
            'processed' => fake()->boolean()
        ];
    }
}
