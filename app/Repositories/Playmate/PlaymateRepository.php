<?php

namespace App\Repositories\Playmate;

use App\Repositories\BaseRepository;
use App\Models\Playmate;

class PlaymateRepository extends BaseRepository implements PlaymateInterface
{
    protected $playmate;

    public function __construct(Playmate $playmate)
    {
        $this->model = $playmate;
    }
}
