<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['escort_id', 'start_date', 'end_date', 'membership'];
    protected $table = 'purchase';
    public $timestamps = false;


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
