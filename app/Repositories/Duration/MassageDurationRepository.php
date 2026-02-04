<?php

namespace App\Repositories\Duration;

use App\Repositories\BaseRepository;
use App\Models\MassageDuration;

class MassageDurationRepository extends BaseRepository implements MassageDurationInterface
{
    protected $duration;

    public function __construct(MassageDuration $duration)
    {
        $this->model = $duration;
    }
    
}
