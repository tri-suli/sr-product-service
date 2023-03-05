<?php

namespace Tests\Feature\Products\PositiveCases;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successfully_delete_product_record(): void
    {
        $file = UploadedFile::fake();
        $product = Product::factory()->create();
        $product->categories()->sync($categoryId = Category::factory()->create()->id);
        $product->images()->sync($imageId = Image::factory()->create([
            Image::FIELD_FILE => $file->image('image.jpg')->store("images/products/{$product->id}")
        ])->id);

        $response = $this->deleteJson(route('api.product.delete'), ['product_id' => $product->id]);
        
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Entity deleted'
            ]);
        $this->assertDatabaseMissing('categories', $product->toArray());
        $this->assertDatabaseMissing('categories_products', [
            'category_id' => $categoryId,
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseMissing('products_images', [
            'image_id' => $imageId,
            'product_id' => $product->id,
        ]);
    }
}
