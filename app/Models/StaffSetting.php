<?php

namespace App\Models;

use App\Models\StaffDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffSetting extends Model
{
    use HasFactory;
    protected $table = 'staff_settings';

        protected $fillable = [
        'user_id',
        'idle_preference_time',
        'twofa',
    ];
  
}
