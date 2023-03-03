<?php

use App\Contracts\Models\Image;
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
        Schema::create('products_images', function (Blueprint $table) {
            $table->unsignedBigInteger(Product::PIVOT_KEY);
            $table->unsignedBigInteger(Image::PIVOT_KEY);

            $table->index([
                Product::PIVOT_KEY,
                Image::PIVOT_KEY,
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
        Schema::dropIfExists('products_images');
    }
};
