<?php

namespace App\Http\Controllers\Agent;


use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AdvertiserAgentRequest;
use App\Http\Requests\Agent\AgentRequest;
use App\Models\AdvertiserAgentRequestUser;

class AgentRequestController extends Controller
{
    
        public function agentRequest(AgentRequest $request)
        {
            $agent_users = User::where('state_id', auth()->user()->state_id)
                ->where('type', 5)
                ->pluck('id')
                ->unique()
                ->toArray();

            if (empty($agent_users)) {
                return redirect()->back()->with('error', 'Agent User Not Found.');
            }

            try 
            {

                $refNumber = random_string();
                DB::transaction(function () use ($request, $agent_users,$refNumber) {
                    $agentData = [
                        'user_id' => auth()->user()->id,
                        'state_id' => auth()->user()->state_id,
                        'ref_number' => $refNumber,
                        'first_name' => $request->first_name ?? "",
                        'last_name' => $request->last_name ?? "",
                        'email' => $request->email ?? "",
                        'mobile_number' => $request->mobile_number ?? "",
                        'contact_by_email' => $request->contact_by_email ?? 0,
                        'contact_by_mobile' => $request->contact_by_mobile ?? 0,
                        'comments' => $request->comments ?? "",
                        'status' => 0,
                        'created_on' => now(),
                    ];

                   
                    $agentRequest = AdvertiserAgentRequest::create($agentData);

                    $advertiser_agent_request_users = [];
                    foreach ($agent_users as $userId) {
                        $advertiser_agent_request_users[] = [
                            'advertiser_agent_requests_id' => $agentRequest->id,
                            'advertiser_user_id' => auth()->user()->id,
                            'receiver_agent_id' => $userId,
                            'status' => 0,
                        ];
                    }

                    AdvertiserAgentRequestUser::insert($advertiser_agent_request_users);
                });

                return redirect()->back()->with('req_ref_number', $refNumber)->with('agent_success', 'Request submitted successfully.');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'An error occurred while submitting the request.');
            }
        }



    public function newRequest(Request $request)
    {
            
            $query = AdvertiserAgentRequest::whereHas('advertiser_agent_request_users', function ($q) {
                $q->where('status', 0)
                ->where('receiver_agent_id', auth()->id());
            })
            ->with([
                'user',
                'user.state',
                'advertiser_agent_request_users' => function ($q) {
                    $q->where('status', 0)
                    ->where('receiver_agent_id', auth()->id());
                },
            ]);
            
            $search = $request->query('search');
             if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }
            $lists = $query->orderBy('id', 'desc')->paginate(3);
            ///dd(json_decode(json_encode($lists),true));
            if ($request->ajax()) {
                return view('agent.dashboard.Advertisers.agent-requests-list', compact('lists'))->render();
            }

            return view('agent.dashboard.Advertisers.new-requests', compact('lists'));   
    }

    public function processRequest(Request $request)
    {
        if((isset($request->id)) && (isset($request->request_type)))
        {

            if($this->is_already_accepted($request->id))
            return response()->json(['success' => false]); 


            if($request->request_type=='accept')
            {   
               $status = '1'; 
               $response = $this->changeRequestStatus($request->id,$status); 
            }
            

            if($request->request_type=='reject')
            {
                 $status = '2';
                 $response = $this->changeRequestStatus($request->id,$status);
            }
           

            if($response)
            return response()->json(['success' => true]);
            else
            return response()->json(['success' => false]); 
        
        }
        else
        {
            return response()->json(['success' => false]); 
        }

    }



    public function historyRequests(Request $request)
    {

        $query = AdvertiserAgentRequest::whereHas('advertiser_agent_request_users', function ($q) {
                $q->where('status', '!=', 0)
                ->where('receiver_agent_id', auth()->id());
            })
            ->with([
                'user',
                'user.state',
                'advertiser_agent_request_users' => function ($q) {
                    $q->where('status', '!=', 0)
                    ->where('receiver_agent_id', auth()->id());
                },
            ]);
            
            $search = $request->query('search');
             if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }


            $lists = $query->orderBy('id', 'desc')->paginate(3);

            //dd(json_decode(json_encode($lists),true));

            if ($request->ajax()) {
                return view('agent.dashboard.Advertisers.history-requests-list', compact('lists'))->render();
            }

            return view('agent.dashboard.Advertisers.history-requests', compact('lists')); 

    }


    public function is_already_accepted($request_id)
    {

        $is_already_accepted = AdvertiserAgentRequestUser::where('advertiser_agent_requests_id', $request_id)
        ->where('status', '1')
        ->first();

        if ($is_already_accepted)
            return true;
        else
            return false;

    }


    public function changeRequestStatus($request_id,$status)
    {
       try 
       {
        ########## First Update My Column ###################
        AdvertiserAgentRequestUser::
        where('advertiser_agent_requests_id', $request_id)
        ->where('receiver_agent_id', '=', auth()->id())
        ->update(['status'=>$status]);

        ##########  Update Other Agent Status  ###################
        if($status=='1')
        AdvertiserAgentRequestUser::
            where('advertiser_agent_requests_id', $request_id)
            ->where('receiver_agent_id','!=', auth()->id())
            ->where('status','!=',2)
            ->update(['status'=>3]); 
            return true; 
        } catch (Exception $e) {
          Log::info($e->getMessage());  
          return false;
        } 

      }

}
