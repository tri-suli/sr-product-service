<?php

namespace Tests\Feature\Categories\NegativeCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
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
        $response = $this->postJson(route('api.category.store'));
        
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
        $response = $this->postJson(route('api.category.store'), [
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
