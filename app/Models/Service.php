<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo('App\Models\ServiceCategory', 'category_id');
    }

    public function escorts()
    {
        return $this->belongsToMany('App\Models\Escort', 'escort_services', 'service_id', 'escort_id')->withPivot('price');
    }

}
