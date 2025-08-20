<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'password_updated_date',
        'password_expiry_days',
        'is_text_notificaion_on',
        'is_email_notificaion_on'
     ];
}
