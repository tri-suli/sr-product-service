<?php

namespace Tests\Feature\Categories\PositiveCases;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_product_collection()
    {
        Product::factory(3)->create();

        $response = $this->getJson(route('api.product.all'));

        $response
            ->assertStatus(200)
            ->assertJsonIsArray('data');
    }
}
