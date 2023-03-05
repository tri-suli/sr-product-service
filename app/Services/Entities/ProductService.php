<?php declare(strict_types=1);

namespace App\Services\Entities;

use Exception;
use App\Contracts\Models\Image;
use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ProductService as ServiceContract;
use App\Services\Entities\EntityService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Service to handle product resources
 * 
 * @final
 * @author Tri Suli Prasetyo <trisulipras@gmail.com>
 */
final class ProductService extends EntityService implements ServiceContract
{
    /**
     * Get the model contract name of product service 
     *
     * @return string
     */
    public function entityContract(): string
    {
        return Product::class;
    }

    /**
     * Create a new record into table 'products'
     * and sync the 'categories_products'
     *
     * (@override)
     * @param   array $attributes
     * @return  Model
     */
    public function store(array $attributes): Model
    {
        $record = parent::store($attributes);

        $record->categories()->sync(request('categories'));

        return $record;
    }

    /**
     * Get the current model instance includes all models
     * that related with it.
     *
     * @return Product
     */
    public function getEntities(Product $product): Product
    {
        return $this->entity->with('categories', 'images')->find($product->id);
    }

    /**
     * Sync the uploaded images with specified product
     *
     * @param   Product     $product
     * @param   Image|Collection<Image>  $image
     * @return  Product
     */
    public function syncImages(Product $product, $image): Product
    {
        if ($image) {
            if ($image instanceof Collection) {
                $product->images()->sync(
                    $image->map(function (Image $image) {
                        return $image->id;
                    })->values()->toArray()
                );
            }
    
            if ($image instanceof Image) {
                $product->images()->sync($image->id);
            }
            
            return $this->entity->with('images')->find($product->id);
        }

        throw new Exception("Invalid Image given");
    }

    /**
     * Delete product record from database along with the relationships
     *
     * @param   int     $id
     * @return  bool
     */
    public function deleteSyncs(int $id): bool
    {
        $product = $this->findById($id);

        $product->categories()->detach();
        $product->images()->detach();

        return $this->delete($product->id);
    }

    /**
     * Update the specified product and re-sync the many-no-many retaionships
     *
     * @param   Product     $product
     * @param   array       $attributes
     * @return  Product|null
     */
    public function updateSyncs(Product $product, array $attributes): ?Product
    {
        $product = $this->update(
            $product->id,
            Arr::except($attributes, ['categories', 'images'])
        );

        if ($product instanceof Product) {
            if (Arr::has($attributes, 'categories')) {
                $product->categories()->sync($attributes['categories']);
            }
    
            if (Arr::has($attributes, 'images')) {
                $this->syncImages($product, $attributes['images']);
            }

            return $this->getEntities($product);
        }

        return null;
    }
}
