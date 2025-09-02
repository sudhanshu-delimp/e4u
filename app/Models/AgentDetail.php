<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'agreement_date',
        'term',
        'option_peroid',
        'option_exercised',
        'commission_advertising_percent',
        'commission_registration_amount',
         'agreement_file',
        
    ];
}
