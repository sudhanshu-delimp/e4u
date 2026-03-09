<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function escort()
    // {
    //     return $this->hasOne(Escort::class, 'id', 'escort_id');
    // }



    public function escort()
    {
       return $this->belongsTo(Escort::class, 'advertiser_id');
    }

    public function massage()
    {
         return $this->belongsTo(MassageProfile::class, 'advertiser_id');
    }

     public function getAdvertiserAttribute()
    {
        if ($this->advertiser_type == 'escort') {
            return $this->escort;
        }

        if ($this->advertiser_type == 'massage') {
            return $this->massage;
        }

        return null;
    }
    
}
