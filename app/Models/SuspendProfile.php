<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspendProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'escort_profile_id',
        'start_date',
        'end_date',
        'credit',
        'note',
        'status',
    ];
}
