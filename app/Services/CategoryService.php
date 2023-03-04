<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\CategoryService as ServiceContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
/**
 * Service to handle category resources
 * 
 * @final
 * @author Tri Suli Prasetyo <trisulipras@gmail.com>
 */
final class CategoryService implements ServiceContract
    /**
     * Get one category by id
     *
     * @param   int     $id
     * @param   array   $columns [default select all]
     * @return  Category|null
     */
    public function findById(int $id, array $columns = ['*']): ?Category
    {
        return Category::select($columns)->find($id);
    }

    /**
     * Insert a new category record into database and
     * return the category object
     *
     * @param   array   $attributes
     * @return  Category
     */
    public function store(array $attributes): Category
    {
        $entity = Category::create($attributes);

        return $this->findById($entity->id);
    }

    /**
     * Update a single category record and
     * return the category object
     *
     * @param   int   $id
     * @param   array $attributes
     * @return  Category|null
     */
    public function update(int $id, array $attributes): ?Category
    {
        if ($this->findById($id)->update($attributes)) {
            return $this->findById($id);
        }

        return null;
    }
}
