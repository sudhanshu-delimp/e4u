<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassageAvailability extends Model
{
    protected $table = "massage_availability";
    protected $guarded = ['id'];
    protected $casts = [
        'availability_time' => 'array',
    ];


}