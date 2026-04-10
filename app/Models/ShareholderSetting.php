<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShareholderSetting extends Model
{
    use HasFactory;
    protected $table = 'shareholder_settings';

        protected $fillable = [
        'user_id',
        'idle_preference_time',
        'twofa',
    ];
  
}
