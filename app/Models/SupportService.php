<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SupportService extends Model
{
   use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'services',
        'booked_by',
    ];

    protected $casts = [
        'services' => 'array',
    ];

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advertiser_id', 'id');
    }

    public function bookedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'booked_by', 'id');
    }

    public function paymentItems(): MorphMany
    {
        return $this->morphMany(PaymentItem::class, 'item');
    }

}
