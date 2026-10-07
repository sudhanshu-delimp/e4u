<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'state_id', 'id');
    }
}
