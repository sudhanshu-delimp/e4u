<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = "availability";
    protected $guarded = ['id'];
    protected $casts = [
        'availability_time' => 'array',
    ];


}
