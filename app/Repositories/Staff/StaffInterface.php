<?php

namespace App\Repositories\Staff;

use App\Repositories\BaseRepositoryInterface;

interface StaffInterface extends BaseRepositoryInterface
{
    public function addUpdateStaff(array $data);
    public function check_staff_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);
    public function sendSuspendEmail(array $data);
    public function sendActiveEmail(array $data);
}
