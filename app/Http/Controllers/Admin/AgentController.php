<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    protected $current_date_time;
    public function __construct()
    {
        $this->current_date_time = date('Y-m-d H:i:s');
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
        $agent = User::where('type','5');
        $search = request()->input('search.value');

            if (!empty($search)) {
                $agent->where(function ($query) use ($search) {
                    $query->where('id', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('priority', 'like', "%{$search}%")
                        ->orWhere('service_type', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%")
                        ->orWhere('created_on', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('ref_number', 'like', "%{$search}%");
                });
            }

            // switch ($order_key) {
            //     case 1:
            //         $agent->orderBy('department', $dir);
            //         break;
            //     case 2:
            //         $agent->orderBy('priority', $dir);
            //         break;
            //     case 3:
            //         $agent->orderBy('service_type', $dir);
            //         break;
            //     case 6:
            //         $agent->orderBy('created_on', $dir)->orderBy('status', 'ASC');
            //         break;
            //     case 7:
            //         $agent->orderBy('status', $dir)->orderBy('created_on', 'DESC');
            //         break;
                    
            //     default:
            //         $agent->orderBy('created_on', 'DESC')->orderBy('status', 'ASC');
            //         break;
            // }

      

        $total_agents = $agent->count();
        $agents = $agent->offset($start)->limit($limit)->get();
        $i = 1;

        foreach($agents as $key => $item) {

            $item->no_of_client = '23232';
            $item->last_login = 'NA';
            $item->status = 'active';
            $item->agent_id = (isset($item->member_id) && $item->member_id!="") ? $item->member_id : 'NA';

            // $s = explode('/',$_SERVER['REQUEST_URI']);
            // $item->sn = ($start+$i);
            // $item->member_id = $item->user->member_id;
            // $item->created_on = Carbon::parse($item->created_on)->format('d-m-Y');
            // $item->status_id = $item->getRawOriginal('status');
            // $item->status_mod = "<span data-status-id='".$item->status_id."'>$item->status</span>";
//            $item->status_mod2 = '<div class="dropdown no-arrow archive-dropdown">
//                                <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                '.$item->status.'
//                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
//                                    <a class="dropdown-item editTour view_ticket" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
//                                        <i class="fa fa-fw fa-comments " style="float: right;"></i>
//                                    </a>
//                                </div>
//                            </div>';

            // $item->status_mod2 = '<div class="change_status dropdown theme-color" data-ticket-id="'.$item->id.'">
            //                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //                                 <span class="current_status">'.$item->status.'</span>
            //                                <span class="caret"></span>
            //                            </button>
            //                            <ul class="dropdown-menu p-3 border-0" style="">';
            // foreach (config('common.supportTicket.statuses') as $sID => $status) {
            //     if($sID != 4) { //We are not displaying Withdrawn/cancelled as it's user closable status
            //         if($sID == $item->status_id)
            //             $item->status_mod2 .= '<li hidden><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
            //         else
            //             $item->status_mod2 .= '<li><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
            //     }
            // }
            // $item->status_mod2 .= '     </ul>
            //                         </div>';

            	
            $dropdown = '<div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-id='.$item->id.'>  <i class="fa fa-eye "></i> View Account</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Suspend</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#edit_agent_data" data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>
                                             </div>
                                          </div>';
            
            
            $item->action = $dropdown;
            $i++;
        }

        return [$agents, $total_agents];
    }


    
}
