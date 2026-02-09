<?php

namespace App\Models;

use App\Models\StaffDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatorStaffSetting extends Model
{
    use HasFactory;
    protected $table = 'operator_staff_settings';

        protected $fillable = [
        'user_id',
        'idle_preference_time',
        'twofa',
    ];
  
}

