<?php

namespace App\Repositories\Operator;

use App\Repositories\BaseRepositoryInterface;

interface OperatorInterface extends BaseRepositoryInterface
{
    public function addUpdateOperator(array $data);
    public function check_operator_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);
    public function sendSuspendEmail(array $data);
    public function sendActiveEmail(array $data);
}
