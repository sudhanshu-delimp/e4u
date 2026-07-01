<?php

namespace App\Models;

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
        'benefit_token'
    ];

    protected $casts = [
        'payload' => 'encrypted:array',
        'benefit_token' => 'encrypted:array',

    ];
}
