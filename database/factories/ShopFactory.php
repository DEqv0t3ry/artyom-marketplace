<?php

namespace Database\Factories;

use App\Enums\DefaultImagesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'inn' => fake()->numberBetween(1000000000, 9999999999),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
