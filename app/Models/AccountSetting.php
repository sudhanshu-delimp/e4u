<?php

namespace App\Models;

use Exception;
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



     public function create_account_setting($user, $data = [])
     {

        return self::create([
               'user_id'  => $user->id,
               'password_updated_date' => (isset($data['password_updated_date']) && $data['password_updated_date']!="") ? $data['password_updated_date'] :  date('Y-m-d H:i:s'),
               'password_expiry_days'   => '30',
               'is_text_notificaion_on' => '0',
               'is_email_notificaion_on' => '0',
               'is_first_login' => '1',
         ]);

        

     }

    public function update_account_setting($user, array $data)
    {

        try 
        {
            $accountSetting = self::where('user_id', $user->id)->first();
            if(!$accountSetting)
            {   
                $data['password_updated_date'] = date('Y-m-d H:i:s');
            }

            $user_account_setting  =  $this->create_account_setting($user,$$data);

            if(isset($data['password_updated_date']) && $data['password_updated_date']!="")
            $user_account_setting->password_updated_date = $data['password_updated_date'];

            if(isset($data['password_expiry_days']) && $data['password_expiry_days']!="")
            $user_account_setting->password_expiry_days = $data['password_expiry_days'];

            if(isset($data['is_text_notificaion_on']) && $data['is_text_notificaion_on']!="")
            $user_account_setting->is_text_notificaion_on = $data['is_text_notificaion_on'];

            $user_account_setting->is_first_login = '0';
            $user_account_setting->save();
            return true;
        } 
        catch (Exception $e) {
        return false; 
        }

    }
}

