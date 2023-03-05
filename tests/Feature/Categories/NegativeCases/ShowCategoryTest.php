<?php

namespace Tests\Feature\Categories\NegativeCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cannot_find_the_category_with_specified_id()
    {
        $response = $this->getJson(route('api.category.show', 1));
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => ['message']
                ]
            ])
            ->assertJsonPath('data.errors.message', 'Entity not found!');
    }
}
