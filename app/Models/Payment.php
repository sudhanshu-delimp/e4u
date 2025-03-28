<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];
    protected $table = "payments";
    protected $casts = [
    'referenceId' => 'array',
    'plan_type' => 'array',
    
    ];

}
