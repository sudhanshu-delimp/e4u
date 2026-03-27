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
        'tour_location_id',
        'massage_id',
        'membership',
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

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'utc_start_time' => 'datetime',
        'utc_end_time' => 'datetime',
        'rate' => 'decimal:2',
        'discount_rate' => 'decimal:2',
        'total_rate' => 'decimal:2',
        'paid_rate' => 'decimal:2',
    ];


}
