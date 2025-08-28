<?php

namespace App\Repositories\Agent;



use DB;
use Carbon\Carbon;
use App\Models\Agent;
use App\Repositories\BaseRepository;
use App\Repositories\Agent\AgentInterface;

class AgentRepository extends BaseRepository implements AgentInterface
{
    
    protected $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }
    

    public function check_agent_email(array $data)
    {
        $errors = [];
        if (!empty($request->email)) {
            $existsEmail =$this->agent->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
            if ($existsEmail) {
                $errors['email'] = ['This email is already taken.'];
            }
        }

       
        if (!empty($request->email2)) {
            $existsEmail2 =$this->agent->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

            if ($existsEmail2) {
                $errors['email2'] = ['This email is already taken.'];
            }
        }

        return $errors;
    }


    public function updateAgent(array $data,)
    {
        $user = $this->agent->where('id',$data['user_id'])->firstOrFail();
        // Update user table
        $user->update([
            'business_name' => $data['business_name'] ?? null,
            'abn' => $data['abn'] ?? null,
            'business_address' => $data['business_address'] ?? null,
            'business_number' => $data['business_number'] ?? null,
            'contact_person' => $data['contact_person'] ?? null,
            'phone' => $data['phone'] ?? null,
            //'email' => $data['email'] ?? null,
            //'email2' => $data['email2'] ?? null,
            'state_id' => $data['state_id'] ?? null,
            'viewer_contact_type' => isset($data['viewer_contact_type']) ? json_encode($data['viewer_contact_type']) : null,
        ]);

        // Update agent detail
        // $agent = $user->agent_detail ?? $user->agent_detail()->create([]);
        // $agent->update([
        //     'agreement_date' => $data['agreement_date'] ?? null,
        //     'term' => $data['term'] ?? null,
        //     'option_peroid' => $data['option_peroid'] ?? null,
        //     'option_exercised' => $data['option_exercised'] ?? null,
        //     'commission_advertising_percent' => $data['commission_advertising_percent'] ?? null,
        //     'commission_registration_amount' => $data['commission_registration_amount'] ?? null,
        // ]);

        // // Handle file upload
        // if (!empty($data['agreement_file'])) {
        //     $file = $data['agreement_file'];
        //     $filename = time().'_'.$file->getClientOriginalName();
        //     $file->storeAs('public/agent_files', $filename);
        //     $agent->update(['agreement_file' => $filename]);
        // }

        return $user;
    }
}
