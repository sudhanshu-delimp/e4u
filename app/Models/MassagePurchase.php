<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassagePurchase extends Model
{
    use HasFactory;
    
    protected $table = 'massage_purchases';
    protected $fillable = [
        'parent_id',
        'membership_id',
        'massage_centre_id',
        'massage_profile_id',
        'start_date',
        'utc_start_time',
        'end_date',
        'utc_end_time',
        'status',
        'rate',
        'discount_rate',
        'total_rate',
        'paid_rate',
    ];

    


}
