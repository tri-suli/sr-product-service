<?php

namespace Database\Factories;

use App\Contracts\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            Image::FIELD_NAME => $this->faker->colorName,
            Image::FIELD_FILE => $this->faker->file,
            Image::FIELD_ENABLE => $this->faker->randomElement([true, false]),
        ];
    }
}
