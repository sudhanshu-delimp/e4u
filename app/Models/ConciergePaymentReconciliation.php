<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciergePaymentReconciliation extends Model
{
  use HasFactory;
  protected $table = 'concierge_payment_reconciliation';

  protected $fillable = [
    'bill_generated_date',
    'bill_start_date',
    'bill_end_date',
    'service',
    'gross_sale_amount',
    'supplier_amount',
    'e4u_earning',
    'status',
  ];
}
