<?php

namespace App\Repositories\Agent;




use Exception;
use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Repositories\Agent\AgentInterface;

class AgentRepository extends BaseRepository implements AgentInterface
{
    
    protected $agent;
    public $response = [];
    
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
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


    public function updateAgent(array $data)
    {
        
       try 
       {
            DB::transaction(function () use ($data) 
            {
                $user = $this->agent->where('id',$data['user_id'])->firstOrFail(); 

                $user->update([
                'business_name' => $data['business_name'] ?? null,
                'abn' => $data['abn'] ?? null,
                'business_address' => $data['business_address'] ?? null,
                'business_number' => $data['business_number'] ?? null,
                'contact_person' => $data['contact_person'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'email2' => $data['email2'] ?? null,
                'state_id' => $data['state_id'] ?? null,
                'viewer_contact_type' => isset($data['viewer_contact_type']) ? json_encode($data['viewer_contact_type']) : null,
                ]);

            /// Update agent detail

            $agent = $user->agent_detail ?? $user->agent_detail()->create([]);

            if (!empty($data['agreement_file'])) {
                $file = $data['agreement_file'];
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file_path = 'agent_files/' . $filename; 
                $file->storeAs('public/agent_files', $filename);
                $agent->update(['agreement_file' => $file_path]);
                $agrement_file = $file_path;
            }

            else{
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

            /// Handle file upload
            

            });

            $this->response = ['status' => true,'message' => 'Agent Updated Successfully'];
            return $this->response;
       } 
       catch (Exception $e) {
         logErrorLocal($e);
         $this->response['message'] = 'Error occured while updating agent...';
         return $this->response;
       }
    }


    public function change_user_status(array $data)
    {
         $user = $this->agent->where('id',$data['user_id'])->firstOrFail(); 
         if($user && $data['status']!="")
         {
             $user->update(['status' =>  $data['status']]);
             return $this->response = ['status' => true,'message' => 'Approved Successfully'];
         }
         else
         {
             return $this->response = ['status' => true,'message' => 'Error occured while approving the user'];
         }

    }

   

}
