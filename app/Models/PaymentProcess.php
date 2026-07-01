<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'payment_id',
        'payload',
        'status',
        'type',
    ];

    protected $casts = [
        'payload' => 'encrypted:array',
    ];


   
}
