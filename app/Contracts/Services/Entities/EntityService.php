<?php declare(strict_types=1);

namespace App\Contracts\Services\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EntityService
{
    /**
     * Get all record as an collection
     *
     * @param   array   $columns
     * @return  Collection
     */
    public function all(array $columns = ['*']): Collection;
    
    /**
     * Get a single record by id
     *
     * @param   int     $id
     * @param   array   $columns [default select all]
     * @return  Model|null
     */
    public function findById(int $id, array $columns = ['*']): ?Model;

    /**
     * Delete a single record from database
     *
     * @param   int     $id
     * @return  bool
     */
    public function delete(int $id): bool;

    /**
     * Insert a new record into database and
     * return the model object
     *
     * @param   array   $attributes
     * @return  Model
     */
    public function store(array $attributes): Model;

    /**
     * Update a single record and return the result as an object
     *
     * @param   int   $id
     * @param   array $attributes
     * @return  Model|null
     */
    public function update(int $id, array $attributes): ?Model;
}
