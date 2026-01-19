<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepository;
use App\Models\EscortMessages;

class MessageRepository extends BaseRepository implements MessageInterface
{
    protected $message;
    public function __construct(EscortMessages $message)
    {
        $this->model = $message;
    }


}
