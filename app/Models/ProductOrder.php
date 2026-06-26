<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use Carbon\Carbon;

class ProductOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'order_id',
    'type',
    'transaction_id',
    'delivery_type',
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
    'cancel_reason',
    'cancelled_by',
  ];
  protected $primaryKey = 'id';

  public function orderItems()
  {
    return $this->hasMany(ProductOrderItem::class, 'order_id', 'id');
  }
  public function orderAddress()
  {
    return $this->hasMany(OrderAddress::class, 'order_id', 'id');
  }
  public function paymentDetails()
  {
    return $this->hasOne(PaymentHistory::class, 'transaction_id', 'transaction_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
  public function scopeDeliveryType($q, $type = null)
  {
    return $type ? $q->where('delivery_type', $type) : $q;
  }

  /**
   * Indicates if the model should have created_by and updated_by fields.
   *
   * @var bool
   */
  public $createdUpdatedBy = true;

  /**
   * Get the created by that owns the details.
   */
  public function createdBy()
  {
    return $this->belongsTo('App\Models\User', 'created_by');
  }

  /**
   * Get the updated by that owns the details.
   */
  public function updatedBy()
  {
    return $this->belongsTo('App\Models\User', 'updated_by');
  }
}
