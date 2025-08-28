<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;
use App\Repositories\Agent\AgentInterface;

class AgentController extends Controller
{
    protected $current_date_time;
     protected $agentRepo;

    public function __construct(AgentInterface $agentRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->agentRepo = $agentRepo;
    }


    public function agent_list(Request $request)
    {

        //$lists = User::where('type','5')->get();
        //dd($lists);
        return view('admin.management.agent');

    }


    public function agent_data_list()
    {
        list($result, $count) = $this->agent_data_pagination(
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


    public function agent_data_pagination($start, $limit, $order_key, $dir)
    {
        $agent = User::with('state','agent_detail')->where('type','5');

      
        
        $search = request()->input('search.value');

           if (!empty($search)) {
            $agent->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('state', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
            });
            }

            switch ($order_key) {
                case 1:
                    $agent->orderBy('id', $dir);
                    break;
                case 2:
                    $agent->orderBy('name', $dir);
                    break;
                    
                default:
                    $agent->orderBy('id', 'DESC')->orderBy('id', 'ASC');
                    break;
            }

      

        $total_agents = $agent->count();
        $agents = $agent->offset($start)->limit($limit)->get();


         


        $i = 1;
                //dd($agents);
        foreach($agents as $key => $item) {

            $item->no_of_client = 'NA';
            $item->last_login = 'NA';
            $item->agent_id = $item->id;
            $item->territory = isset($item->state->name) ? $item->state->name : 'NA';

            $suspend_html = "";
            if($item->status!='Suspended')
            $suspend_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id='.$item->id.'>   <i class="fa fa-ban"></i> Suspend</a>
                        <div class="dropdown-divider"></div>' ;  


            $dropdown = '<div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                
                                               <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id='.$item->id.'>  <i class="fa fa-eye "></i> View Account</a>
                                                <div class="dropdown-divider"></div>'.$suspend_html.'
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-agent-btn" href="javascript:void(0)" data-id='.$item->id.'  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>
                                             </div>
                                          </div>';
            
            
            $item->action = $dropdown;
            $i++;
        }

        return [$agents, $total_agents];
    }


    public function suspend_agent(Request $request)
    {
        if($request->id && $request->request_type && $request->request_type=='suspend')
        {

            $user = User::where('id',$request->id)->first();
            if($user->status && $user->status=='Suspended')
            {
                return response()->json(['success' => true,'message'=>'This Account Already Suspended']);
                exit;
            }
            

            $user->status = '3';
            $response = $user->save();

            if($response)
            {
                return response()->json(['success' => true,'message'=>'Account Suspended Successfully']);
            }    
            
            else
            {
                return response()->json(['success' => false,'message'=>'Error Occurred while Account Suspending']); 
            }
        }
        else
        {
            return response()->json(['success' => false,'message'=>'Unknown Input Found']);  
        }
         
    }


    public function check_agent_email(Request $request)
    {
        $request->validate([
            'email'  => 'nullable|email',
            'email2' => 'nullable|email',
        ]);

        $errors = [];
       
        if (!empty($request->email)) {
            $existsEmail = User::where('email', $request->email)
                            ->where('id', '!=', $request->user_id)
                            ->exists();

            if ($existsEmail) {
                $errors['email'] = ['This email is already taken.'];
            }
        }

       
        if (!empty($request->email2)) {
            $existsEmail2 = User::where('email2', $request->email2)
                            ->where('id', '!=', $request->user_id)
                            ->exists();

            if ($existsEmail2) {
                $errors['email2'] = ['This email is already taken.'];
            }
        }

       
        if (!empty($errors)) {
            return response()->json([
                'status' => false,
                'errors' => $errors
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'Email(s) are available.'
        ]);
    }



    public function update_agent(Request $request)
    {

        $data = $request->all();
        exit;
        $this->agentRepo->updateAgent($data);
        return response()->json(['message' => 'Agent updated successfully']);
    }

    

    
}
