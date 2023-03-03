<?php

namespace Database\Seeders;

use App\Contracts\Models\Category;
use App\Models\Category as ModelsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::DEFAULT as $name) {
            DB::table('categories')->updateOrInsert([Category::FIELD_NAME => $name], [Category::FIELD_NAME => $name]);
        }

        if ($count = config('database.seeders.categories')) {
            ModelsCategory::factory($count)->create();
        }
    }
}
