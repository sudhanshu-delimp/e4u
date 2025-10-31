<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TourLocation extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'state_id', 'start_date', 'end_date','status'];
    protected $dates = ['start_date', 'end_date'];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    
    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    
    public function profiles()
    {
        return $this->hasMany(TourProfile::class,'tour_location_id');
    }

    public function getStartDateFormattedAttribute()
    {
        return $this->start_date
            ? Carbon::parse($this->start_date)->format('d-m-Y')
            : null;
    }
    public function getEndDateFormattedAttribute()
    {
        return $this->end_date
            ? Carbon::parse($this->end_date)->format('d-m-Y')
            : null;
    }
}

