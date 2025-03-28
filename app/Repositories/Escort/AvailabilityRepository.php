<?php

namespace App\Repositories\Escort;

use App\Repositories\BaseRepository;
use App\Models\Availability;

class AvailabilityRepository extends BaseRepository implements AvailabilityInterface
{
    protected $availability;

    public function __construct(Availability $availability)
    {
        $this->model = $availability;
    }
}
