<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tour extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'location'=> 'array'
    ];

    public function locations()
    {
        return $this->belongsToMany('App\Models\State', 'tour_location', 'tour_id', 'location_id');
    }
    // public function locations()
    // {
    //     return $this->belongsToMany('App\Models\City', 'tour_location', 'tour_id', 'location_id');
    // }
    public function profiles()
    {
        return $this->belongsToMany('App\Models\Escort', 'tour_location', 'tour_id', 'profile_id');
    }
    public function tour_location()
    {
        return $this->hasMany('App\Models\TourLocation', 'tour_id');
    }
    public function getMembershipTypeAttribute($value)
    {

         switch($value)
         {
             case(1): return "Platinum";  break;
             case(2): return "Gold";  break;
             case(3): return "Silver";  break;
             case(4): return "Free";  break;

         }

    }


}
