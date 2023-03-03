<?php

namespace Database\Factories;

use App\Contracts\Models\Product;
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
    public function definition()
    {
        return [
            Product::FIELD_NAME => $this->faker->colorName,
            Product::FIELD_DESCRIPTION => $this->faker->sentences(1, true),
            Product::FIELD_ENABLE => $this->faker->randomElement([true, false]),
        ];
    }
}
