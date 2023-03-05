<?php declare(strict_types=1);

namespace App\Contracts\Services\Entities;

use App\Contracts\Models\Category;
use App\Contracts\Models\Image;
use App\Contracts\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductService extends EntityService
{
    /**
     * Get the current model instance includes all models
     * that related with it.
     *
     * @return Product
     */
    public function getEntities(Product $product): Product;

    /**
     * Sync the uploaded images with specified product
     *
     * @param   Product     $product
     * @param   Image|Collection<Images>  $image
     * @return  Product
     */
    public function syncImages(Product $product, $image): Product;
}
