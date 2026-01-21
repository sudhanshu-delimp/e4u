<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masseur extends Model
{
    use HasFactory;


    public function durations()
    {
        return $this->belongsToMany('App\Models\Duration','masseur_rate','masseur_profile_id','duration_id')->withPivot('massage_price','incall_price','outcall_price');
    }

    public function durationRate($duration_id, $duration_type)
    {
        if($duration = $this->durations()->where('duration_id',$duration_id)->first()) {
            return $duration->pivot->{$duration_type};
        }

        return null;
    }
}
