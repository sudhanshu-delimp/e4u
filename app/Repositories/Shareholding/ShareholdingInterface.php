<?php

namespace App\Repositories\Shareholding;

use App\Repositories\BaseRepositoryInterface;

interface ShareholdingInterface extends BaseRepositoryInterface
{
    public function addUpdate(array $data);
    public function check_email(array $data);

}
