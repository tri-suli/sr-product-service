<?php

namespace Tests\Feature\Products\NegativeCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cannot_find_the_product_with_specified_id(): void
    {
        $response = $this->getJson(route('api.product.show', 1));
        
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
