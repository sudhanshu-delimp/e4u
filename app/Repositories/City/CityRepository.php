<?php

namespace App\Repositories\City;

use App\Repositories\BaseRepository;
use App\Models\City;

class CityRepository extends BaseRepository implements CityInterface
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function search($str, $state_id = null)
	{
		$query = $this->model
			->where('name',  'LIKE', "%{$str}%");
        if($state_id) {
            $query->where('state_id',  $state_id);
        }

        return $query->orderBy('name')
			->get(['id','name']);
	}

}
