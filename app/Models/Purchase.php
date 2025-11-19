<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['escort_id', 'start_date', 'end_date', 'membership', 'utc_start_time', 'utc_end_time', 'status', 'tour_location_id'];
    protected $table = 'purchase';
    public $timestamps = false;


    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getStartDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }

    public function getEndDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }

    public function getDaysNumberAttribute()
    {
        return Carbon::parse($this->start_date)
              ->diffInDays(Carbon::parse($this->end_date))+1;
    }

    public function getMembershipTypeAttribute($value)
    {

        switch($this->membership)
        {
            case(1): return "Platinum";  break;
            case(2): return "Gold";  break;
            case(3): return "Silver";  break;
            case(4): return "Free";  break;

        }

    }

    public function escort()
    {
        return $this->belongsTo('App\Models\Escort', 'escort_id');
    }

    public function scopeOverlapping($query, $start, $end)
    {
        $formatted_start = Carbon::createFromFormat('d-m-Y', $start)->format('Y-m-d');
        $formatted_end = Carbon::createFromFormat('d-m-Y', $end)->format('Y-m-d');

        return $query->where('start_date', '<=', $formatted_end)
                     ->where('end_date', '>=', $formatted_start);
    }
    
    public function availabilityFromA($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if($attribute =  $availability->{$day.'_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function availabilityToA($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if($attribute =  $availability->{$day.'_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }
}
