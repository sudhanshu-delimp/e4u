<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspendProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'escort_profile_id',
        'user_id',
        'start_date',
        'end_date',
        'credit',
        'utc_start_date',
        'utc_end_date',
        'note',
        'status',
    ];

    public function escort()
    {
        return $this->belongsTo(Escort::class,'escort_profile_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
