<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentCoreRepository
 *
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        return $this->model->get();
    }
    /**
     * @inheritdoc
     */
    public function store(array $input, $id = null)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($id, array $data)
	{
		$this->model->where('id', $id)->update($data);
		return $this->find($id);
	}

    /**
     * @inheritdoc
     */
    public function make()
    {
        return $this->model->make();
    }

    /**
     * @inheritdoc
     */
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();
    }
}
