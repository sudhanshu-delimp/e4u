<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['escort_id', 'start_date', 'end_date', 'membership', 'utc_start_time', 'utc_end_time', 'status'];
    protected $table = 'purchase';
    public $timestamps = false;

    protected $dates = ['start_date', 'end_date'];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
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
        return $query->where('start_date', '<=', $end)
                     ->where('end_date', '>=', $start);
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
