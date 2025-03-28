<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentBankDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "agent_bank_details";
}
