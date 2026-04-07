<?php

namespace App\Repositories\Supplier;

use App\Repositories\BaseRepositoryInterface;

interface SupplierInterface extends BaseRepositoryInterface
{
    public function addUpdate(array $data);
    public function check_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);
    public function sendSuspendEmail(array $data);
    public function sendActiveEmail(array $data);
}
