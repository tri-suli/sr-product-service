<?php

namespace Tests\Feature\Categories\NegativeCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_name_is_required()
    {
        $category = Category::factory(1)->create()->first();
        $response = $this->patchJson(route('api.category.update', $category->id));
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'name'
                    ]
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_name_length_cannot_be_greather_than_100()
    {
        $category = Category::factory(1)->create()->first();

        $response = $this->patchJson(route('api.category.update', $category->id), [
            'name' => $this->faker->sentences(10, true)
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'name'
                    ]
                ]
            ]);
    }
}
