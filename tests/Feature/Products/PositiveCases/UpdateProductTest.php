<?php

namespace Tests\Feature\Products\PositiveCases;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sucessfully_update_the_product_name_and_description()
    {
        $product = Product::factory(1)->create()->first();
        $data = ['name' => $this->faker->colorName, 'description' => $this->faker->sentence];

        $response = $this->patchJson(route('api.product.update', $product->id), $data);

        $response
            ->assertStatus(200)
            ->assertJsonPath('data.name', $data['name'])
            ->assertJsonPath('data.description', $data['description']);
        $this->assertDatabaseHas('products', $data);
        $this->assertDatabaseMissing('products', $product->only('name', 'description'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sucessfully_update_the_product_categories_and_images()
    {
        $file = UploadedFile::fake();
        $product = Product::factory()->create();
        $image = Image::factory()->create([
            Image::FIELD_FILE => $file->image('old.jpg')->store("images/products/{$product->id}/dummy.jpg"),
            Image::FIELD_ENABLE => true
        ]);
        $categories = Category::factory(2)->create()->map(function (Category $entity) {
            return $entity->id;
        })->values()->toArray();
        $product->categories()->sync([$categories[1]]);
        $product->images()->sync([$image->id]);
        $data = ['categories' => [$categories[0]], 'images' => [$file->image('nexw.jpg')]];

        $response = $this->patchJson(route('api.product.update', $product->id), $data);

        $response
            ->assertStatus(200)
            ->assertJsonPath('data.categories.0.id', $categories[0])
            ->assertJsonPath('data.images.0.id', $response->original->images[0]['id']);
        
        $this->assertDatabaseHas('categories_products', [
            'category_id' => $categories[0],
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseMissing('categories_products', [
            'category_id' => $categories[1],
            'product_id' => $product->id,
        ]);

        $this->assertDatabaseHas('products_images', [
            'image_id' => $response->original->images[0]->id,
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseMissing('products_images', [
            'image_id' => $image->id,
            'product_id' => $product->id,
        ]);
    }
}
