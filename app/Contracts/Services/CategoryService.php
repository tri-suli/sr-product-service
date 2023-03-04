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
     * Delete a single category record from database
     *
     * @param   int     $id
     * @return  bool
     */
    public function delete(int $id): bool;

    /**
     * Insert a new category record into database and
     * return the category object
     *
     * @param   array   $attributes
     * @return  Category
     */
    public function store(array $attributes): Category;

    /**
     * Update a single category record and
     * return the category object
     *
     * @param   int   $id
     * @param   array $attributes
     * @return  Category|null
     */
    public function update(int $id, array $attributes): ?Category;
}
