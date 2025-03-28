<?php

namespace App\Repositories\MassageProfile;

use App\Repositories\BaseRepository;
use App\Models\MassageAvailability;

class MassageAvailabilityRepository extends BaseRepository implements MassageAvailabilityInterface
{
    protected $availability;

    public function __construct(MassageAvailability $availability)
    {
        $this->model = $availability;
    }
}
