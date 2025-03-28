<?php

namespace App\Repositories;

/**
 * Interface BaseRepository
 */
interface BaseRepositoryInterface
{
    /**
     * @param  int $id
     * @return $model
     */
    public function find($id);

    /**
     * Return a collection of all elements of the resource
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Create or update a resource
     * @param  $data, int $id
     * @return $model
     */
    public function store(array $data, $id = null);

    /**
     * Create a resource
     * @param  $data
     * @return $model
     */
    public function create($data);

    /**
     * Update a resource
     * @param  $model
     * @param  array $data
     * @return $model
     */
    public function update($id, array $data);

    /**
     * Create empty model instance
     * @param  $model
     * @return bool
     */
    public function make();

    /**
     * Destroy a resource
     * @param  $model
     * @return bool
     */
    public function destroy($model);

}