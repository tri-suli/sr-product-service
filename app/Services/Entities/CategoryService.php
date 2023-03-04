<?php declare(strict_types=1);

namespace App\Services\Entities;

use App\Contracts\Models\Category;
use App\Contracts\Services\Entities\CategoryService as ServiceContract;
use App\Services\Entities\EntityService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service to handle category resources
 * 
 * @final
 * @author Tri Suli Prasetyo <trisulipras@gmail.com>
 */
final class CategoryService extends EntityService implements ServiceContract
{
    /**
     * Get the model contract name of category service 
     *
     * @return string
     */
    public function entityContract(): string
    {
        return Category::class;
    }
}
