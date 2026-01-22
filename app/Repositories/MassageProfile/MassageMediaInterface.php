<?php

namespace App\Repositories\MassageProfile;

use App\Repositories\BaseRepositoryInterface;

interface MassageMediaInterface extends BaseRepositoryInterface
{
    public function with_Or_withoutPosition($user_id,$position);
}   
