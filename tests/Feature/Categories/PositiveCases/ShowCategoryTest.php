<?php

namespace Tests\Feature\Categories\PositiveCases;

use App\Models\Category;
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
    public function test_successfully_fetch_detail_category(): void
    {
        $category = Category::factory()->create([Category::FIELD_ENABLE => true]);
        
        $response = $this->getJson(route('api.category.show', $category->id));

        $response
            ->assertStatus(200)
            ->assertJsonPath('data.id', $category->id)
            ->assertJsonPath('data.name', $category->name)
            ->assertJsonPath('data.enable', $category->enable);
    }
}
