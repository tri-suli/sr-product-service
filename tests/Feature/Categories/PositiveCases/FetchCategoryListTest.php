<?php

namespace Tests\Feature\Categories\PositiveCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FetchCategoryListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_catetory_collection()
    {
        Category::factory(3)->create();

        $response = $this->getJson(route('api.category.list'));

        $response
            ->assertStatus(200)
            ->assertJsonIsArray('data');
    }
}
