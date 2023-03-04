<?php

namespace Tests\Feature\Categories\PositiveCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successfully_delete_category_record(): void
    {
        $category = Category::factory(1)->create()->first();

        $response = $this->deleteJson(route('api.category.delete'), ['category_id' => $category->id]);
        
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Entity deleted'
            ]);
        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
