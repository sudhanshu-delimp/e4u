<?php

namespace App\Models;

use App\Models\MassageProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageBumpup extends Model
{
    use HasFactory;
    protected $table = "massage_bumpup";
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function massage()
    {
        return $this->belongsTo(MassageProfile::class);
    }


    public function scopeActive($query)
    {
        return $query->where('utc_start_time', '<=', Carbon::now('UTC'))
        ->where('utc_end_time', '>=', Carbon::now('UTC'));
    }
}
