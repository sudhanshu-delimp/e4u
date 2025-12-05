<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepositoryInterface;

interface AdminInterface extends BaseRepositoryInterface
{
    public function addUpdateStaff(array $data);
    public function check_staff_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);
}
