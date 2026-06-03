<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'start_date', 'end_date'];

    public function locations()
    {
        return $this->hasMany(TourLocation::class);
    }

    public function getCurrentLocationAttribute()
    {
        return $this->locations()->with('state')->get()->first(function ($location) {

            $today = Carbon::now($location->timezone)->format('Y-m-d');

            return $today >= $location->start_date->format('Y-m-d') && $today <= $location->end_date->format('Y-m-d');
        });
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

    public function transactions()
    {
        return $this->morphMany(CreditTransaction::class, 'transactionable');
    }

    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = true;

    /**
     * Get the created by that owns the details.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the details.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}

