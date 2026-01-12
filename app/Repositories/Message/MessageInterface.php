<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepositoryInterface;

interface MessageInterface extends BaseRepositoryInterface
{
      
         public function findDefault($user_id, $offset);
}