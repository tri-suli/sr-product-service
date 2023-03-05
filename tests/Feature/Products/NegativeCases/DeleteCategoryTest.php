<?php

namespace Tests\Feature\Products\NegativeCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_product_id_is_required()
    {
        $response = $this->deleteJson(route('api.product.delete'));
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'product_id'
                    ]
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_product_id_should_already_stored_into_database()
    {
        $response = $this->deleteJson(route('api.product.delete'), [
            'product_id' => 1
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'product_id'
                    ]
                ]
            ]);
    }
}
