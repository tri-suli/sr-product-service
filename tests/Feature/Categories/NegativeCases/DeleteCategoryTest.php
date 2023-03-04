<?php

namespace Tests\Feature\Categories\NegativeCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_category_id_is_required()
    {
        $response = $this->deleteJson(route('api.category.delete'));
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'category_id'
                    ]
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_field_category_id_should_already_stored_into_database()
    {
        $response = $this->deleteJson(route('api.category.delete'), [
            'category_id' => 1
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'category_id'
                    ]
                ]
            ]);
    }
}
