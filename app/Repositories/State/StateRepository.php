<?php

namespace App\Repositories\State;

use App\Repositories\BaseRepository;
use App\Models\State;

class StateRepository extends BaseRepository implements StateInterface
{
    protected $state;
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function search($str, $country_id = null)
	{
		$query = $this->state
			->where('name',  'LIKE', "%{$str}%");

        if($country_id) {
            $query->where('country_id',  $country_id);
        }

        return $query->orderBy('name')
			->get(['id','name']);
	}
    public function allByCountryId()
	{
		return $query = $this->state->where('country_id', 14)->orderBy('name', 'ASC')->get();



	}

}
