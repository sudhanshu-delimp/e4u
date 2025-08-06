<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EscortPinup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'escort_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'utc_start_time',
        'utc_end_time',
    ];

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('utc_end_time', '>', Carbon::now('UTC'));
    }

    public static function latestActiveForCity(int $cityId): ?self
    {
        return self::query()
            ->where('city_id', $cityId)
            ->active()
            ->whereHas('escort', function ($escortQuery) {
                $escortQuery->whereDoesntHave('suspendProfile', function ($suspendQuery) {
                    $suspendQuery->where('start_date', '<=', Carbon::now('UTC'))
                                 ->where('end_date', '>=', Carbon::now('UTC'));
                });
            })
            ->orderBy('utc_end_time', 'desc')
            ->first();
    }
}
