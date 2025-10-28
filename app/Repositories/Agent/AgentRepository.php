<?php

namespace App\Repositories\Agent;




use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\AccountSetting;
use App\Events\AgentRegistered;
use App\Mail\agentApprovalEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Agent\AgentInterface;

class AgentRepository extends BaseRepository implements AgentInterface
{
    
    protected $agent;
    protected $setting;
    public $user_model;
    public $response = [];

    
    public function __construct(Agent $agent, User $user_model,  AccountSetting $setting)
    {
        $this->agent = $agent;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false,'message' => ''];
       
    }
    

    public function check_agent_email(array $data)
    {

        $errors = [];
        if(isset($data['user_id']) && $data['user_id']!="")
        {
            if (!empty($data['email'])) {
                $existsEmail =$this->agent->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

       
            if (!empty($data['email2'])) {
                $existsEmail2 =$this->agent->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }

        }
        else
        {
            if (!empty($data['email'])) {
                $existsEmail =$this->agent->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

       
            if (!empty($data['email2'])) {
                $existsEmail2 =$this->agent->where('email2', $data['email2'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }

        }
       
        return $errors;
    }


    public function addUpdateAgent(array $data)
    {
        
      return  DB::transaction(function () use ($data) 
        {
            try 
            {
                $agentData  =  [
                        'business_name'       => $data['business_name'] ?? null,
                        'abn'                 => $data['abn'] ?? null,
                        'business_address'    => $data['business_address'] ?? null,
                        'business_number'     => $data['business_number'] ?? null,
                        'contact_person'      => $data['contact_person'] ?? null,
                        'phone'               => $data['phone'] ?? null,
                        'email'               => $data['email'] ?? null,
                        'email2'              => $data['email2'] ?? null,
                        'state_id'            => $data['state_id'] ?? null,
                        'viewer_contact_type' => isset($data['viewer_contact_type'])  ? json_encode($data['viewer_contact_type']): null,
                    ];

                if (isset($data['user_id']) && (!empty($data['user_id']))) 
                {
                    $user = $this->agent->where('id', $data['user_id'])->first();
                    if ($user) 
                    {
                        $user->update($agentData);
                        $message = 'agent updated successfully';
                    } 
                    else 
                    {
                        $this->response = ['status' => false,'message' => 'agent not found'];
                        return $this->response;
                    }
                } 
                else 
                {
                    $agentData['enabled'] = 1;
                    $agentData['status'] = 2;
                    $agentData['type'] = 5;
                    $message = 'New agent added successfully';
                    $user = User::create($agentData);

                    $userDataForEvent = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'email' => $data['email'],
                        'location' => config('escorts.profile.states')[$user->state_id]['stateName'] ?? null,
                        'agent_id'  => $user->member_id,
                        'create_at' => Carbon::now()->format('j F'),
                    ];
       
                    //event(new AgentRegistered($userDataForEvent));
                    $this->setting->create_account_setting($user);
                  
                }

            
                 /// Update agent detail
                $agent = $user->agent_detail ?? $user->agent_detail()->create(['agent_id' =>$user->id]);
                if (!empty($data['agreement_file'])) {
                    $file = $data['agreement_file'];
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $file_path = 'agent_files/' . $filename; 
                    $file->storeAs('public/agent_files', $filename);
                    $agent->update(['agreement_file' => $file_path]);
                    $agrement_file = $file_path;
                }

                else
                {
                    $agrement_file  = $agent->agreement_file;
                }

          
                $agent->update([
                    'agreement_date' => !empty($data['agreement_date'])? date('Y-m-d', strtotime($data['agreement_date'])): null,
                    'term' => $data['term'] ?? null,
                    'option_peroid' => $data['option_peroid'] ?? null,
                    'option_exercised' => $data['option_exercised'] ?? null,
                    'commission_advertising_percent' => $data['commission_advertising_percent'] ?? null,
                    'commission_registration_amount' => $data['commission_registration_amount'] ?? null,
                    'agreement_file' => $agrement_file,
                ]);


                 $this->response = ['status' => true,'message' => $message];
                 return $this->response;
            
             } 
                catch (Exception $e) {

                Log::info($e->getMessage());
                logErrorLocal($e);
                  $this->response = ['status' => false,'message' => 'Error occured while making request...'];
                  return $this->response;
            
            }

        });
    }


    public function change_user_status(array $data)
    {
         $user = $this->agent->where('id',$data['user_id'])->firstOrFail(); 
         if($user && $data['status']!="")
         {
             $password  = random_string($type = 'alnum', $len = 8);
             $user->update(['status' =>  $data['status'],'password'=> Hash::make($password)]);
             $this->sendApprovalEmail($user,$password);
             return $this->response = ['status' => true,'message' => 'Approved Successfully'];
         }
         else
         {
             return $this->response = ['status' => true,'message' => 'Error occured while approving the user'];
         }

    }


     public function activate_user(array $data)
    {
         $user = $this->agent->where('id',$data['user_id'])->firstOrFail(); 
         if($user && $data['status']!="")
         {
             $user->update(['status' => '1']);
             return $this->response = ['status' => true,'message' => 'Activated Successfully'];
         }
         else
         {
             return $this->response = ['status' => true,'message' => 'Error occured while activating the user'];
         }

    }


    public function sendApprovalEmail($user,$plainPassword)
    {
        $user['plainPassword'] = $plainPassword;

        logErrorLocal($user);
        Mail::to($user->email)->send(new agentApprovalEmail($user));
        
    }




}
