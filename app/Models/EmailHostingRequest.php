<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHostingRequest extends Model
{
  use HasFactory;
  protected $table = 'email_hosting_requests';
  protected $fillable = [
    // User details
    'user_id',
    'user_type',

    // Contact details
    'email',
    'first_name',
    'last_name',
    'mobile',
    'contact_preference',

    // Request details
    'term_condition',
    'auth',
    'period_required',

    // Request status
    'status',

    // Payment details
    'payment_status',
    'monthly_fee',
    'gst_rate',
    'payment_date',

    // Service validity
    'start_date',
    'end_date',

    // Payment gateway information
    'payment_gateway',
    'gateway_customer_id',
    'payment_method_id',
    'payment_transaction_id',
    'payment_reference',

    // Payment failure / refund information
    'payment_error_message',
    'refunded_at',
    'refunded_amount',

    // Admin notes
    'comments',
  ];

  protected $casts = [
    'contact_preference' => 'array',
    'term_condition' => 'boolean',
    'auth' => 'boolean',
    'period_required' => 'integer',
    'monthly_fee' => 'decimal:2',
    'gst_rate' => 'decimal:2',
    'refunded_amount' => 'decimal:2',
    'payment_date' => 'datetime',
    'refunded_at' => 'datetime',
    'start_date' => 'date',
    'end_date' => 'date',
  ];
}
