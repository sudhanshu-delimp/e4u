<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table = "pricing";
    protected $guarded = ['id'];

    public function memberships()
    {
        return $this->belongsTo('App\Models\MembershipPlan', 'membership_id');
    }


    public function getPercentageAttribute($value)
    {
        return (int) $value;
    }
}
