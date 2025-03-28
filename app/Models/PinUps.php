<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PinUps extends Model
{
    use HasFactory;
    protected $table = "pin_ups";
    protected $guarded = ['id'];

    public function getWeekStartAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
