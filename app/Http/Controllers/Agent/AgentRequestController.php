<?php

namespace App\Http\Controllers\Agent;


use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\AdvertiserAgentRequest;
use App\Http\Requests\Agent\AgentRequest;
use App\Models\AdvertiserAgentRequestUser;

class AgentRequestController extends Controller
{
    
        public function agentRequest(AgentRequest $request)
        {
           
           if(auth()->user()->assigned_agent_id!=""  && auth()->user()->is_agent_assign=='1')
           return redirect()->back()->with('error', 'You have already been assigned an Agent.');

           
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
                            'created_at' => date('Y-m-d H:i:s')
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
            
            $query = AdvertiserAgentRequest::whereHas('advertiser_agent_request_user', function ($q) {
                $q->where('status', 0)
                ->where('receiver_agent_id', auth()->id());
            })
            ->with([
                'user',
                'user.state',
                'advertiser_agent_request_user' => function ($q) {
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
            {
                return response()->json(['success' => true]);
                Http::post(config('constants.socket_url').'/agent-assigned', ['id' => $request->id,'status' => 'updated']);
            }    
            
            else
            {
                return response()->json(['success' => false]); 
            }
        
        }
        else
        {
            return response()->json(['success' => false]); 
        }

    }



    public function historyRequests(Request $request)
    {

        $query = AdvertiserAgentRequest::whereHas('advertiser_agent_request_user', function ($q) {
                $q->where('status', '!=', 0)
                ->where('receiver_agent_id', auth()->id());
            })
            ->with([
                'user',
                'user.state',
                'advertiser_agent_request_user' => function ($q) {
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


            $lists = $query->orderBy('id', 'desc')->paginate(8);

            

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
            
            DB::transaction(function () use($request_id,$status) {
                ########## First Update My Column ###################

              $updated_data  =  AdvertiserAgentRequestUser::
                    where('advertiser_agent_requests_id', $request_id)
                    ->where('receiver_agent_id', '=', auth()->id())
                    ->update(['status'=>$status,'created_at' => date('Y-m-d H:i:s')]);



                ##########  Update Other Agent Status  ###################
                if($status=='1')
                {
                    AdvertiserAgentRequestUser::
                    where('advertiser_agent_requests_id', $request_id)
                    ->where('receiver_agent_id','!=', auth()->id())
                    ->where('status','!=',2)
                    ->update(['status'=>3,'created_at' => date('Y-m-d H:i:s')]); 

                   $advertiser = AdvertiserAgentRequestUser::
                                     where('advertiser_agent_requests_id', $request_id)
                                    ->where('receiver_agent_id', '=', auth()->id())
                                    ->where('status','1')
                                    ->first();

                    User::where('id', $advertiser->advertiser_user_id)
                            ->where(function ($query) {
                            $query->where('type', 3)
                            ->orWhere('type', 4);
                            })
                            ->update([
                                'is_agent_assign' => '1',
                                'assigned_agent_id' => auth()->id()
                    ]);
                }
                
            });
          return true; 
        } 
          catch (Exception $e) {
          Log::info($e->getMessage());  
          return false;
        } 

      }



      public function allAgentRequests(Request $request)
      {

        $query = AdvertiserAgentRequest::whereHas('agent_request_users', function ($q) {
                $q->where('id', '>', 0);
            })
            ->with([
                'user:id,name,member_id,phone,state_id',
                'user.state',
                'agent_request_users.user:id,name,member_id,phone,state_id' ,
                'agent_request_users' => function ($q) {
                   $q->where('id', '>', 0);
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

            
            return view('admin.reports.agent-requests', compact('lists')); 
      }


    ################### Agent Request Listing Into The Admin ########################

    public function dataTable()
    {
        list($result, $count) = $this->paginatedList(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }

    private function paginatedList($start, $limit, $order_key, $dir)
    {
            
           $query = AdvertiserAgentRequest::whereHas('agent_request_users', function ($q) {
                $q->where('id', '>', 0);
            })
            ->with([
                'user',
                'user.state',
                'agent_request_users.user' ,
                'agent_request_users' => function ($q) {
                   $q->where('id', '>', 0);
                },
            ]);
        
            
            $search = request()->input('search.value');

           if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }

            switch ($order_key) {
                case 1:
                    $query->orderBy('ref_number', $dir);
                    break;

                default:
                    $query->orderBy('created_at', 'DESC')->orderBy('created_at', 'ASC');
                    break;
            }

            $totalRequest = $query->count();

            $requestList = $query->offset($start)
                            ->limit($limit)
                            ->get();

                            

            $i = 1;
            foreach ($requestList as $item) {

               
                $agent_name = [];
                $agent_mobile = [];
                $agent_status = [];
                $list_arr = [];
                $accepted_date = "";
                $followup = "";
               

                if(isset($item->agent_request_users ) && count($item->agent_request_users)>0)
                {
                 foreach ($item->agent_request_users as $index => $agent_user)
                 {

                    $agent_name[] = isset($agent_user->user->member_id) ? $agent_user->user->member_id: 'NA';
                    

                 }
                }

                if(isset($item->agent_request_users ) && count($item->agent_request_users)>0)
                {
                 foreach ($item->agent_request_users as $index => $agent_user)
                 {
                   
                    $agent_mobile[] = isset($agent_user->user->phone) ? $agent_user->user->phone: 'NA '; 
                   

                 }
                }

                if(isset($item->agent_request_users ) && count($item->agent_request_users)>0)
                {
                 foreach ($item->agent_request_users as $index => $agent_user)
                 {
                    if($agent_user->status==0)
                    $agent_status[] = '<p class="accepted-badge">Open</p>';
                    
                     if($agent_user->status==1)
                    $agent_status[] = '<p class="accepted-badge">Accepted</p>';

                     if($agent_user->status==2)
                    $agent_status[] = '<p class="declined-badge" >Rejected</p>';

                     if($agent_user->status==3)
                    $agent_status[] = '<p class="forfeited-badge">Forfeited</p>';
                    
                 }
                }

                if(isset($item->agent_request_users ) && count($item->agent_request_users)>0)
                {
                 foreach ($item->agent_request_users as $index => $agent_user)
                 {
                    if($agent_user->status==1)
                    {
                        $accepted_date  =  date('d-m-Y',strtotime($agent_user->created_at));
                        break;
                    }
                 }
                }
               

                $item->ref_number =  $item->ref_number;
                $item->requested_at = date('d-m-Y',strtotime($item->created_at));
                $item->user_member_id =  $item->user->member_id;
                $item->phone =  $item->user->phone;
                $item->country_code =  isset($item->user->state->iso2) ? $item->user->state->iso2 : 'NA';
                //$item->agent_name =  $agent_name;
                //$item->agent_mobile =  $agent_mobile;
                //$item->agent_status =  $agent_status;

                $item->list_arr = [
                    'agent_mobile' => $agent_mobile,
                    'agent_status' => $agent_status,
                    'agent_id' => $agent_name,

                ];
               

                

                
                $item->accepted_date =  $accepted_date;
                if($accepted_date=='')
                $followup = '<a class="dropdown-item align-item-custom notiification-confirmation" href="#" data-id="' . $item->id . '"  data-toggle="modal"> <i class="fa fa-bell"></i> Follow Up</a><div class="dropdown-divider"></div>';
                                    
               

                $item->action = '<div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">'.$followup.'
                                    <a class="dropdown-item align-item-custom view-agent-details" href="#"  data-id="' . $item->id . '" data-toggle="modal"> <i class="fa fa-eye" aria-hidden="true" ></i> View</a>
                                </div>';

                $item->view_status =  '<a href="javascript:void(0)" class="current_status" data-id="' . $item->id . '">View Status</a>';


                $i++;
            }

            // dd($requestList);
            return [$requestList, $totalRequest];
    }


    public function accepted_advertiser_paginatedList($start, $limit, $order_key, $dir)
    {

        $query = AdvertiserAgentRequest::whereHas('advertiser_agent_request_user', function ($q) {
                $q->where('status', '=', 1)
                ->where('receiver_agent_id', auth()->id());
            })
             ->with([
                'user',
                'user.state',
                'advertiser_agent_request_user' => function ($q) {
                    $q->where('status', '!=', 0)
                    ->where('receiver_agent_id', auth()->id());
                },
            ]);
            
            $search = request()->input('search.value');
             if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }


            switch ($order_key) {
                case 1:
                    $query->orderBy('ref_number', $dir);
                    break;

                default:
                    $query->orderBy('created_at', 'DESC')->orderBy('created_at', 'ASC');
                    break;
            }

            $totalRequest = $query->count();
            $requestList = $query->offset($start)->limit($limit)->get();


          foreach ($requestList as $item) {

              $item->ref_number =  $item->ref_number;
              $item->member_id =  $item->user->member_id;
              $item->name =  $item->user->name;
              $item->phone =  $item->user->phone;
              $item->email =  $item->user->email;
              $item->state =  isset($item->user->state->iso2) ? $item->user->state->iso2 : 'NA';
          }

            return [$requestList, $totalRequest];
    }

    

    ################### accepted_advertiser_datatable ##############################
     public function accepted_advertiser_datatable()
    {
        list($result, $count) = $this->accepted_advertiser_paginatedList(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);

    }

    public function is_agent_assigned($agent_id)
    {

    }

}
