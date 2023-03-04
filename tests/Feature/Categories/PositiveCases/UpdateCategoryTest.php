<?php

namespace Tests\Feature\Categories\PositiveCases;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successfully_updating_category_name(): void
    {
        $category = Category::factory(1)->create()->first();
        $data = ['name' => 'new name'];

        $response = $this->patchJson(route('api.category.update', $category->id), $data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment($data);
        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * A basic feature test example.
     *
     * @dataProvider enableOrDisableCategory
     * @param   bool    $enable
     * @return  void
     */
    public function test_successfully_enabling_or_disabling_category(bool $enable): void
    {
        $category = Category::factory(1)->create(['enable' => !$enable])->first();
        $data = ['name' => 'new name', 'enable' => $enable];

        $response = $this->patchJson(route('api.category.update', $category->id), $data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment($data);
        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
        $this->assertDatabaseHas('categories', $data);
    }

    public function enableOrDisableCategory(): array
    {
        return [
            'set category to enable' => [true],
            'set category to disable' => [false],
        ];
    }
}
