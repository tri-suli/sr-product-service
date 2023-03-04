<?php declare(strict_types=1);

namespace App\Services\Entities;

use App\Contracts\Services\Entities\EntityService as ServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class EntityService implements ServiceContract
{
    protected Model $entity;

    public function __construct()
    {
        $this->entity = app()->make($this->entityContract());    
    }

    /**
     * Get the service entity name 
     *
     * @return  string
     */
    abstract public function entityContract(): string;

    /**
     * Get all record as an collection
     *
     * @param   array   $columns
     * @return  Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->entity->select($columns)->get();
    }
    
    /**
     * Get a single record by id
     *
     * @param   int     $id
     * @param   array   $columns [default select all]
     * @return  Model|null
     */
    public function findById(int $id, array $columns = ['*']): ?Model
    {
        return $this->entity->select($columns)->find($id);
    }

    /**
     * Delete a single record from database
     *
     * @param   int     $id
     * @return  bool
     */
    public function delete(int $id): bool
    {
        return (bool) $this->entity->destroy($id);
    }

    /**
     * Insert a new record into database and
     * return the model object
     *
     * @param   array   $attributes
     * @return  Model
     */
    public function store(array $attributes): Model
    {
        $record = $this->entity->create($attributes);

        return $this->findById($record->id);
    }

    /**
     * Update a single record and return the result as an object
     *
     * @param   int   $id
     * @param   array $attributes
     * @return  Model|null
     */
    public function update(int $id, array $attributes): ?Model
    {
        if ($this->findById($id)->update($attributes)) {
            return $this->findById($id);
        }

        return null;
    }
}
