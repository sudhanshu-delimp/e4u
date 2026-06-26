<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'balance_after',
        'description',
        'meta',
        'transactionable_id',
        'transactionable_type'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function paymentItems()
    {
        return $this->morphMany(PaymentItem::class, 'item');
    }
}
