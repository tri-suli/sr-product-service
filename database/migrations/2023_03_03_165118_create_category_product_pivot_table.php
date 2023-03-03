<?php

use App\Contracts\Models\Category;
use App\Contracts\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_products', function (Blueprint $table) {
            $table->unsignedBigInteger(Product::PIVOT_KEY);
            $table->unsignedBigInteger(Category::PIVOT_KEY);

            $table->index([
                Product::PIVOT_KEY,
                Category::PIVOT_KEY,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_products');
    }
};
