<?php

namespace App\Repositories\Service;

use App\Repositories\BaseRepositoryInterface;

interface ServiceInterface extends BaseRepositoryInterface
{
    public function limit($to, $from);
}
