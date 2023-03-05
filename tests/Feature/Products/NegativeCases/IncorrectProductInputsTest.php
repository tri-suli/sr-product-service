<?php

namespace Tests\Feature\Products\NegativeCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_some_fields_that_has_required_rule_will_be_error()
    {
        $response = $this->postJson(route('api.product.store'));
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'name',
                        'description',
                        'categories',
                    ]
                ]
            ]);
    }

    public function test_the_response_should_contains_errors_incorrect_images_mime_types()
    {
        $file = UploadedFile::fake();
        $categories = Category::factory(2)->create();
        $images = collect([$file->image('dummy1.pdf'), $file->image('dummy1.txt')]);

        $response = $this->postJson(route('api.product.store'), [
            'name' => 'new product',
            'description' => 'Just simple description',
            'categories' => $categories->map(function (Category $entity) {
                return $entity->id;
            })->values()->toArray(),
            'images' => $images->toArray(),
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'images.0',
                        'images.1',
                    ]
                ]
            ]);
    }

    public function test_some_fields_that_has_array_rule_will_be_error(): void
    {
        $file = UploadedFile::fake();
        $category = Category::factory(1)->create()->first();

        $response = $this->postJson(route('api.product.store'), [
            'name' => 'new product',
            'description' => 'Just simple description',
            'categories' => $category->id,
            'images' => $file->image('dummy1.pdf'),
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'images',
                        'categories',
                    ]
                ]
            ]);
    }

    public function test_categories_fields_should_be_containing_ids_existing_categories_reocord()
    {
        $response = $this->postJson(route('api.product.store'), [
            'name' => 'new product',
            'description' => 'Just simple description',
            'categories' => [1, 2],
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'categories.0',
                        'categories.1',
                    ]
                ]
            ]);
    }
}
