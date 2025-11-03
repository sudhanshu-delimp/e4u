<?php

namespace App\Repositories\Staff;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\AccountSetting;
use App\Events\StaffRegistered;
use App\Mail\StaffApprovalEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Staff\StaffInterface;

class StaffRepository extends BaseRepository implements StaffInterface
{
    
    protected $staff;
    protected $setting;
    public $user_model;
    public $response = [];

    
    public function __construct(Staff $staff, User $user_model,  AccountSetting $setting)
    {
        $this->staff = $staff;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false,'message' => ''];
       
    }
    

    public function check_staff_email(array $data)
    {

        $errors = [];
        if(isset($data['user_id']) && $data['user_id']!="")
        {
            if (!empty($data['email'])) {
                $existsEmail =$this->staff->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

       
            if (!empty($data['email2'])) {
                $existsEmail2 =$this->staff->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }

        }
        else
        {
            if (!empty($data['email'])) {
                $existsEmail =$this->staff->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

       
            if (!empty($data['email2'])) {
                $existsEmail2 =$this->staff->where('email2', $data['email2'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }

        }
       
        return $errors;
    }


    public function addUpdateStaff(array $data)
    {
        
      return  DB::transaction(function () use ($data) 
        {
            try 
            {
                $staffData  =  [
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
                    $user = $this->staff->where('id', $data['user_id'])->first();
                    if ($user) 
                    {
                        $user->update($staffData);
                        $message = 'Staff updated successfully';
                    } 
                    else 
                    {
                        $this->response = ['status' => false,'message' => 'Staff not found'];
                        return $this->response;
                    }
                } 
                else 
                {
                    $staffData['enabled'] = 1;
                    $staffData['status'] = 2;
                    $staffData['type'] = 5;
                    $message = 'New staff added successfully';
                    $user = User::create($staffData);

                    $userDataForEvent = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'email' => $data['email'],
                        'location' => config('escorts.profile.states')[$user->state_id]['stateName'] ?? null,
                        'user_id'  => $user->member_id,
                        'create_at' => Carbon::now()->format('j F'),
                    ];
       
                    //event(new StaffRegistered($userDataForEvent));
                    $this->setting->create_account_setting($user);
                  
                }

            
                 /// Update staff detail
                $staff = $user->staff_detail ?? $user->staff_detail()->create(['user_id' =>$user->id]);
                if (!empty($data['agreement_file'])) {
                    $file = $data['agreement_file'];
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $file_path = 'staff_files/' . $filename; 
                    $file->storeAs('public/staff_files', $filename);
                    $staff->update(['agreement_file' => $file_path]);
                    $agrement_file = $file_path;
                }

                else
                {
                    $agrement_file  = $staff->agreement_file;
                }

          
                $staff->update([
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
         $user = $this->staff->where('id',$data['user_id'])->firstOrFail(); 
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
         $user = $this->staff->where('id',$data['user_id'])->firstOrFail(); 
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
        Mail::to($user->email)->send(new StaffApprovalEmail($user));
        
    }




}
