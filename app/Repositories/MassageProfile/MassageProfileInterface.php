<?php

namespace App\Repositories\MassageProfile;

use App\Repositories\BaseRepositoryInterface;

interface MassageProfileInterface extends BaseRepositoryInterface
{
     public function findDefault($user_id,$default_setting);
     public function  get_massage_by_id($id);
}
