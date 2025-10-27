<?php

namespace App\Repositories\Agent;

use App\Repositories\BaseRepositoryInterface;

interface AgentInterface extends BaseRepositoryInterface
{
    public function addUpdateAgent(array $data);
    public function check_agent_email(array $data);
    public function change_user_status(array $data);
    public function activate_user(array $data);

    

}
