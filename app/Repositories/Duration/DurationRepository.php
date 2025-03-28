<?php

namespace App\Repositories\Duration;

use App\Repositories\BaseRepository;
use App\Models\Duration;

class DurationRepository extends BaseRepository implements DurationInterface
{
    protected $duration;

    public function __construct(Duration $duration)
    {
        $this->model = $duration;
    }
    
}
