<?php

namespace App\Repositories\Shareholding;

use App\Repositories\BaseRepositoryInterface;

interface ShareholdingInterface extends BaseRepositoryInterface
{
    public function addUpdate(array $data);
    public function check_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);
    public function sendSuspendEmail(array $data);
    public function sendActiveEmail(array $data);
}
