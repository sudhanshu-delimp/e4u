<?php

namespace App\Http\Controllers;

use App\Models\SupportTickets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mugs;

class MugsController extends Controller
{
    function create(Request $request) {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $mugs = new Mugs();
        if($mugs->create($data)) {
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 200);
        }
    }

    public function dataTable()
    {
        list($result, $count) = $this->paginatedList(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir'],
            request()->get('search')['value']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    private function paginatedList($start, $limit, $order_key, $dir, $search)
    {
        if($search) {
            $mugs = Mugs::where('mobile', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            switch ($order_key) {
                case 2:
                    $mugs->orderBy('incident_date', $dir);
                    break;
            }
            /*if($order_key == 6) {
                $tickets->orderBy('created_on', $dir)->orderBy('status', 'ASC');
            } elseif($order_key == 7) {
                $tickets->orderBy('status', $dir)->orderBy('created_on', 'DESC');
            } else {
                $tickets->orderBy('created_on', 'DESC');
                $tickets->orderBy('status', 'ASC');
            }*/


            $totalMugs = $mugs->count();
            $mugs = $mugs
                ->offset($start)
                ->limit($limit)->get();

            $i = 1;
            foreach ($mugs as $key => $item) {
                $s = explode('/', $_SERVER['REQUEST_URI']);
                $item->sn = ($start + $i);
                $item->date = Carbon::parse($item->incident_date)->format('d-m-Y');
                $item->user_name = $item->user->name;
                /*$item->action = '<div class="dropdown no-arrow archive-dropdown">
                                    <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <a class="dropdown-item view_ticket" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
                                            <i class="fa fa-fw fa-comments " style="float: right;"></i>
                                        </a>';
                if(!in_array($item->getRawOriginal('status'), [3,4])) {
                    $item->action .= '<a class="dropdown-item cancelTicket" href="#" data-id=' . $item->id . '>Withdraw
                                            <i class="fa fa-fw fa-ban " style="float: right;"></i>
                                        </a>';
                }
                $item->action .=  '</div>
                                </div>';*/

                $i++;
            }
        } else {
            $mugs = [];
            $totalMugs = 0;
        }

        return [$mugs, $totalMugs];
    }
}
