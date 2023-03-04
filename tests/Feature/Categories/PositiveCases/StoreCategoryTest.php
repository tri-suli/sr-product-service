<?php

namespace Tests\Feature\Categories\PositiveCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * (@override)
     */
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow('2023-03-05 08:00:00');
    }

    /**
     * 
     *
     * @return void
     */
    public function test_successfully_record_a_new_category(): void
    {
        $data = [
            'name' => $this->faker->colorName,
            'enable' => true
        ];

        $response = $this->postJson(route('api.category.store'), $data);

        $response
            ->assertStatus(201)
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_successfully_record_a_new_disabled_category(): void
    {
        $data = [
            'name' => $this->faker->colorName,
        ];

        $response = $this->postJson(route('api.category.store'), $data);

        $response
            ->assertStatus(201)
            ->assertJsonFragment(array_merge($data, ['enable' => false]));
        $this->assertDatabaseHas('categories', array_merge($data, ['enable' => false]));
    }
}
