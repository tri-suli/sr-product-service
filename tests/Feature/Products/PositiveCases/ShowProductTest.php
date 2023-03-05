<?php

namespace Tests\Feature\Products\PositiveCases;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
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
    public function test_successfully_fetch_a_single_product_entity(): void
    {
        $product = Product::factory()->create([Product::FIELD_ENABLE => true]);
        $product->categories()->sync(Category::factory()->create());
        $product->images()->sync(Image::factory()->create());

        $response = $this->getJson(route('api.product.show', $product->id));
        
        $response
            ->assertStatus(200)
            ->assertJsonPath('data.id', $product->id)
            ->assertJsonPath('data.description', $product->description)
            ->assertJsonPath('data.enable', $product->enable)
            ->assertJsonPath('data.categories.0', $product->categories[0]->toArray())
            ->assertJsonPath('data.images.0', $product->images[0]->toArray());
    }
}
