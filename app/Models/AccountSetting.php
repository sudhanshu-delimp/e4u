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
        'is_email_notificaion_on',
        'is_first_login'
     ];



     public function create_account_setting($user)
     {
        if (!AccountSetting::where('user_id', $user->id)->exists()) {
         self::create([
               'user_id'  => $user->id,
               'password_updated_date' => date('Y-m-d H:i:s'),
               'password_expiry_days'   => '30',
               'is_text_notificaion_on' => '0',
               'is_email_notificaion_on' => '0',
               'is_first_login' => '1',
         ]);
        }
        
        return true;
     }
}

