<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourLocation extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'state_id', 'start_date', 'end_date','status'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function profiles()
    {
        return $this->hasMany(TourProfile::class);
    }
}

