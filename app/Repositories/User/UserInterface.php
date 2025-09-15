<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;

interface UserInterface extends BaseRepositoryInterface
{
    public function changeUserPassword($data);
    public function update_account_setting($data);
}
