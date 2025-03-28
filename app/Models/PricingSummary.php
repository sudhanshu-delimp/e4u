<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingSummary extends Model
{
    use HasFactory;
    protected $table = "pricing_summary";
    protected $guarded = ['id'];

    public function memberships()
    {
        return $this->belongsTo('App\Models\MembershipPlan', 'membership_id');
    }
}
