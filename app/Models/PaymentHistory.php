<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'paid_amount',
        'currency',
        'transaction_id',
        'status',
        'paid_at',
        'card',
        'meta',
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
  
}
