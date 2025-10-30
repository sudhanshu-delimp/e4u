<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Controllers\BaseController;

class ReportingController extends BaseController
{


    public function userRegistrationReport(Request $request)
    {
        return view('admin.reporting.registrations');
    }


    public function getRegistrationReport(Request $request)
    {
       
        list($result, $count) = $this->registration_data_pagination(
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


    public function registration_data_pagination($start, $limit, $order_key, $dir)
    {
        $agent = User::query();

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
               
        foreach($agents as $key => $item) {
            $item->territory = isset($item->state->iso2) ? $item->state->iso2 : 'NA';
            $dropdown = '<div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-pause-circle"></i> On Hold
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-check-circle "></i> Registered
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-times-circle "></i> Rejected
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-ban "></i> Cancelled
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-user-slash"></i> Suspended
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report"
                                                href="#" data-id="1435">
                                                <i class="fa fa-eye mr-2"></i> View
                                            </a>
                                        </div>
                                    </div>';
            
            
            $item->action = $dropdown;
            $i++;
        }

        return [$agents, $total_agents];
    }
    
}
