<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortPinup extends Model
{
    use HasFactory;

    protected $fillable = [
        'escort_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'utc_start_time',
        'utc_end_time',
    ];

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
