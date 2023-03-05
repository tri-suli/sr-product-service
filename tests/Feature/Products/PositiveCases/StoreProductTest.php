<?php

namespace Tests\Feature\Products\PositiveCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * The goal of this test case is to create a new product record without 'images'
     * and save it in the datatabase then returns back the created product
     * along with realated 'images' & 'categories' of products
     *
     * @return  void
     */
    public function test_successfully_record_a_new_product_without_images(): void
    {
        $categories = Category::factory(2)->create();
        $data = [
            'name' => $this->faker->colorName,
            'description' => $this->faker->sentence,
            'enable' => true,
        ];

        $response = $this->postJson(route('api.product.store'), array_merge(
            $data,
            [
                'categories' => $categories->map(function (Category $entity) {
                    return $entity->id;
                })->values()->toArray()
            ]
        ));

        $response
            ->assertStatus(201)
            ->assertJsonFragment($data);
        
        $this->assertNotEmpty($response->original->categories->toArray());
        $this->assertEmpty($response->original->images->toArray());
        $this->assertDatabaseHas('products', $data);
        $this->assertDatabaseHas('categories_products', [
            'category_id' => $categories->get(0)->id,
            'product_id' => $response->original->id,
        ]);
        $this->assertDatabaseHas('categories_products', [
            'category_id' => $categories->get(1)->id,
            'product_id' => $response->original->id,
        ]);
    }

    /**
     * The goal of this test case is to create a new product record with 'images'
     * and save it in the datatabase then returns back the created product
     * along with realated 'images' & 'categories' of products
     * 
     * @return  void
     */
    public function test_successfully_record_a_new_product_with_images(): void
    {
        $file = UploadedFile::fake();
        $categories = Category::factory(2)->create();
        $images = collect([$file->image('img1.jpg'), $file->image('img2.jpg')]);
        $data = [
            'name' => $this->faker->colorName,
            'description' => $this->faker->sentence,
            'enable' => true,
        ];

        $response = $this->postJson(route('api.product.store'), array_merge(
            $data,
            ['images' => $images->toArray()],
            [
                'categories' => $categories->map(function (Category $entity) {
                    return $entity->id;
                })->values()->toArray()
            ]
        ));
        
        $response->assertStatus(201)->assertJsonFragment($data);
        $this->assertNotEmpty($response->original->categories->toArray());
        $this->assertNotEmpty($response->original->images->toArray());
        $this->assertDatabaseHas('products', $data);
        $this->assertDatabaseHas('categories_products', [
            'category_id' => $categories->get(0)->id,
            'product_id' => $response->original->id,
        ]);
        $this->assertDatabaseHas('categories_products', [
            'category_id' => $categories->get(1)->id,
            'product_id' => $response->original->id,
        ]);
        $this->assertDatabaseHas('products_images', [
            'image_id' => $categories->get(0)->id,
            'product_id' => $response->original->id,
        ]);
        $this->assertDatabaseHas('products_images', [
            'image_id' => $categories->get(1)->id,
            'product_id' => $response->original->id,
        ]);
    }
}
