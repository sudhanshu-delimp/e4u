<?php

namespace App\Repositories\SupportTickets;

use App\Repositories\BaseRepository;
use App\Models\SupportTickets;

class SupportTicketsRepository extends BaseRepository implements SupportTicketsInterface
{
    protected $playmate;

    public function __construct(Playmate $playmate)
    {
        $this->model = $playmate;
    }
}
