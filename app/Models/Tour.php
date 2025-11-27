<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'start_date', 'end_date'];

    public function locations()
    {
        return $this->hasMany(TourLocation::class);
    }

    public function latestLocation()
    {
        return $this->hasOne(TourLocation::class)->latestOfMany('end_date');
    }

    public function getStartDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }

    public function getEndDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }


    public function user()
    {
        return $this->hasOne(user::class, 'id', 'user_id');
    }

    public function getDaysNumberAttribute()
    {
        return Carbon::parse($this->start_date)
              ->diffInDays(Carbon::parse($this->end_date))+1;
    }

    public function tourProfiles()
    {
        return $this->hasManyThrough(
            TourProfile::class,   // Final model
            TourLocation::class,  // Intermediate model
            'tour_id',            // Foreign key on tour_locations table
            'tour_location_id',   // Foreign key on tour_profiles table
            'id',                 // Local key on tours table
            'id'                  // Local key on tour_locations table
        );
    }

    public function tourPurchase()
    {
        return $this->hasManyThrough(
            Purchase::class,   // Final model
            TourLocation::class,  // Intermediate model
            'tour_id',            // Foreign key on tour_locations table
            'tour_location_id',   // Foreign key on Purchase table
            'id',                 // Local key on tours table
            'id'                  // Local key on tour_locations table
        );
    }
}

