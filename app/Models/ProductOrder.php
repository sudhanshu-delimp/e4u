<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'order_id',
    'user_id',
    'order_date',
    'order_status',
    'payment_status',
    'payment_method',
    'sub_total',
    'total_amount',
    'tax_amount',
    'wallet_amount',
    'delivery_charges',
    'notes',
  ];
}
