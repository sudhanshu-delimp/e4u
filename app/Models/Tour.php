<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function locations()
    {
        return $this->hasMany(TourLocation::class);
    }

    public function user()
    {
        return $this->hasOne(user::class, 'id', 'user_id');
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

