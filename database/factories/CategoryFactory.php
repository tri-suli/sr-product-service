<?php

namespace Database\Factories;

use App\Contracts\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            Category::FIELD_NAME => $this->faker->safeColorName,
            Category::FIELD_ENABLE => $this->faker->randomElement([true, false]),
        ];
    }
}
