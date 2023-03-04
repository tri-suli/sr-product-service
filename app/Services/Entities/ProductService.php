<?php declare(strict_types=1);

namespace App\Services\Entities;

use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ProductService as ServiceContract;
use App\Services\Entities\EntityService;
use Illuminate\Database\Eloquent\Collection;

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
}
