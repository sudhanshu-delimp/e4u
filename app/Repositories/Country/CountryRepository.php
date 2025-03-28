<?php

namespace App\Repositories\Country;

use App\Repositories\BaseRepository;
use App\Models\Country;

class CountryRepository extends BaseRepository implements CountryInterface
{
    protected $country;
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function search($str)
	{
		return $this->country
			->where('name',  'LIKE', "%{$str}%")
			->orderBy('name')
			->get(['id','name']);
	}
}
