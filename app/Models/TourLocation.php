<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourLocation extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'state_id', 'start_date', 'end_date'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function profiles()
    {
        return $this->hasMany(TourProfile::class);
    }
}

