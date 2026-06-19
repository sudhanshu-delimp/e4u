<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class PaymentHistory extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'completed_by',
    'ref_no',
    'service',
    'amount',
    'wallet_amount',
    'loyalty_amount',
    'net_amount',
    'gst_amount',
    'delivery_charge',
    'paid_amount',
    'currency',
    'transaction_id',
    'status',
    'paid_at',
    'card',
    'meta',
    'created_by',
    'updated_by'
  ];

  protected $casts = [
    'meta' => 'array',
    'paid_at' => 'datetime',
  ];

  public function items()
  {
    return $this->hasMany(PaymentItem::class, 'payment_history_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function completedByUser()
  {
    return $this->belongsTo(User::class, 'completed_by');
  }
  public function getPaidAtFormattedAttribute()
  {
    if (!$this->paid_at) {
      return 'N/A';
    }

    $tz = config('app.escort_server_timezone');
    return \Carbon\Carbon::parse($this->paid_at)
      ->timezone($tz)
      ->format('Y-m-d h:i A');
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

    // Agent Commission
    public function commissions()
    {
        return $this->morphMany(AgentCommission::class, 'commissionable');
    }
}
