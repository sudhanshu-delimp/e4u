<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHostingRequest extends Model
{
  use HasFactory;
  protected $table = 'email_hosting_requests';
  protected $fillable = [
    'user_id',
    'email',
    'first_name',
    'last_name',
    'mobile',
    'contact_preference',
    'term_condition',
    'auth',
    'period_required',
    'user_type',
    'request_status',
    'monthly_fee',
    'total_subscription_cost',
    'gst_rate',
    'total_gst',
    'currency',
    'start_date',
    'end_date',
    'next_payment_date',
    'payment_gateway',
    'gateway_customer_id',
    'payment_method_id',
    'pin_customer_token',
    'pin_card_token',
    'subscription_status',
    'auto_renew',
    'comments',
  ];

  protected $casts = [
    'contact_preference' => 'array',
    'term_condition' => 'boolean',
    'auth' => 'boolean',
    'auto_renew' => 'boolean',
    'period_required' => 'integer',
    'monthly_fee' => 'decimal:2',
    'total_subscription_cost' => 'decimal:2',
    'gst_rate' => 'decimal:2',
    'total_gst' => 'decimal:2',
    'start_date' => 'date',
    'end_date' => 'date',
    'next_payment_date' => 'date',
  ];
  public function subscriptionPayments()
  {
    return $this->hasMany(
      EmailHostingSubscriptionPayment::class,
      'email_hosting_request_id',
      'id'
    );
  }
}
