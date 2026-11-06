<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function escorts()
    {
        return $this->belongsTo(Escort::class, 'listing_profile_id', 'id');
    }

    public function massage()
    {
        return $this->belongsTo(MassageProfile::class, 'listing_profile_id', 'id');
    }
}
