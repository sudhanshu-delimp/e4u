<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiserDiscount extends Model
{
    use HasFactory;
    protected $table = 'advertiser_discounts';
    protected $fillable = [
        'user_id',
        'type',
        'value',
        'start_date',
        'end_date',
        'is_active',
        'cancelled_at',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'start_date'   => 'datetime',
        'end_date'     => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('start_date', '<=', now('UTC'))
            ->where('end_date', '>=', now('UTC'));
    }

    public function scopeWhereUserType($query, $type)
    {
        return $query->whereHas('user', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    public function discountAmount($price)
    {
        if ($this->type === 'percentage') {
            $discount = ($price * $this->value) / 100;
        } else {
            $discount = $this->value;
        }

        return max(0, $price - $discount);
    }

    public static function getActiveForUser($userId)
    {
        return self::where('user_id', $userId)->active()->latest()->first();
    }

    // public static function getNetDiscount($pricing, $discount){
    //     $amount = 0.00;
    //     if($discount){
    //         $amount =  $pricing['new_rate'] - ($pricing['new_rate']*$pricing['percentage'])/100;
    //     }
    //     return number_format($amount, 2);
        
    // }

    public static function getNetDiscount($pricing, $discount){
        $amount = 0.00;
        if($discount){
            if(empty($pricing->new_rate)){
                $pricing->new_rate = number_format($discount->discountAmount($pricing->price),2);
            }
            $amount =  $pricing->new_rate - ($pricing->new_rate*$pricing->percentage)/100;
        }
        return number_format($amount, 2);
        
    }
}
