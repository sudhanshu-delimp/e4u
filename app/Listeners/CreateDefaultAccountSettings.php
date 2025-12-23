<?php

namespace App\Listeners;


use App\Models\User;
use App\Models\AgentSetting;
use App\Models\EscortSetting;
use App\Models\ViewerSetting;
use App\Models\AccountSetting;
use App\Models\MassageSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ViewerNotificationSetting;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultAccountSettings
{
    
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
    
        $userdata  =  json_decode(json_encode($event),true);

       
        
        if(isset($userdata['escort']) || isset($userdata['user']) || isset($userdata['agent']) || isset($userdata['massage']))
        {
            if (isset($userdata['escort'])) {
                $user = $userdata['escort'];
            } 
            elseif (isset($userdata['user'])) {
                $user = $userdata['user'];
            } 
            elseif (isset($userdata['agent'])) {
                $user = $userdata['agent'];
            }
            elseif (isset($userdata['massage'])) {
                $user = $userdata['massage'];
            }
           
         
            

            if(isset($user['id']))
            {
                AccountSetting::create([
                    'user_id'  => $user['id'],
                    'password_updated_date' => date('Y-m-d H:i:s'),
                    'password_expiry_days'   => '30',
                    'is_text_notificaion_on' => '0',
                    'is_email_notificaion_on' => '0',
                    'is_first_login' => '1',
                ]);

               $user  = User::where('id',$user['id'])->first();

              
               ########### For Viewer ##########################
               if($user &&  $user->type=='0')
               {
                   ViewerSetting::create([
                        'user_id'=>$user['id'],
                        'user_type'=>$user->type,
                        'features_push_notifications_from_escorts' => '1',
                        'features_direct_chatting_with_escorts' => '1',
                        'features_write_reviews' => '1',
                        'features_enable_my_legbox' => '1',
                        'features_enable_my_notebox' => '1',
                        'listings_preferences_view' => '1',
                        'interests_with_male' => '1',
                        'interests_with_female' => '1',
                        'interests_with_trans' => '1',
                        'interests_with_cross_dresser' => '1',
                        'interests_with_couples' => '1',
                        'idle_preference_time' => '60' 
                    ]);
               }
               ########### For Viewer ##########################


               ########## For Agent ###########################
               if($user &&  $user->type=='5')
               {
                   AgentSetting::create([
                        'user_id'=>$user['id'],
                        'advertiser_email'=>'1',  
                        'idle_preference_time' => '60'             
                    ]);
               }

               ############ End For Agent ####################

              ########## For Massage ###########################
               if($user &&  $user->type=='4')
               {
                   MassageSetting::create([
                        'user_id'=>$user['id'], 
                        'idle_preference_time' => '60'            
                    ]);
               }

               ############ End For Massage ####################

               ########## For Escort ###########################
               if($user &&  $user->type=='3')
               {
                   EscortSetting::create([
                        'user_id'=>$user['id'], 
                        'subscriptions_state'=> '1',
                        'idle_preference_time' => '60'              
                    ]);
               }

               ############ End For Escort ####################

            }    
           
        }

       
    }
}
