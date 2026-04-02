<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierSetting extends Model
{
    use HasFactory;
    protected $table = 'supplier_settings';

        protected $fillable = [
        'user_id',
        'idle_preference_time',
        'twofa',
    ];
  
}
