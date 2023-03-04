<?php declare(strict_types=1);

namespace App\Contracts\Services;

use App\Contracts\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryService
{
    /**
     * Get one category by id
     *
     * @param   int     $id
     * @param   array   $columns [default select all]
     * @return  Category|null
     */
    public function findById(int $id, array $columns = ['*']): ?Category;

    /**
     * Insert a new category record into database and
     * return the category object
     *
     * @param   array   $attributes
     * @return  Category
     */
    public function store(array $attributes): Category;

}
