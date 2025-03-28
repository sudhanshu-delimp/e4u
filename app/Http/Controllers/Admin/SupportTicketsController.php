<?php
namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\Http\Requests\Escort\SupportTicketsRequest;
use App\Models\TicketConversations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Repositories\SupportTickets\SupportTicketsInterface;
use App\Models\SupportTickets;
use Illuminate\Http\Request;

class SupportTicketsController extends AppController
{
    /*protected $SupportTickets;

    public function __construct(SupportTicketsInterface $support_tickets)
    {
        $this->SupportTickets = $support_tickets;
    }*/

    public function index()
    {
        /*$tickets
         = SupportTickets::where('user_id', auth()->user()->id)
            ->orderBy('created_on', 'DESC')
            ->orderBy('status', 'ASC')
            ->get()->toArray();*/


        return view('admin.SupportTickets.list');
    }

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
        $tickets = SupportTickets::where('user_id', '>', 0);
        switch ($order_key) {
            case 1:
                $tickets->orderBy('department', $dir);
                break;
            case 2:
                $tickets->orderBy('priority', $dir);
                break;
            case 3:
                $tickets->orderBy('service_type', $dir);
                break;
        }
        if($order_key == 6) {
            $tickets->orderBy('created_on', $dir)->orderBy('status', 'ASC');
        } elseif($order_key == 7) {
            $tickets->orderBy('status', $dir)->orderBy('created_on', 'DESC');
        } else {
            $tickets->orderBy('created_on', 'DESC');
            $tickets->orderBy('status', 'ASC');
        }

        $totalTickets = $tickets->count();
        $tickets = $tickets
            ->offset($start)
            ->limit($limit)->get();

        $i = 1;
        foreach($tickets as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->sn = ($start+$i);
            $item->member_id = $item->user->member_id;
            $item->created_on = Carbon::parse($item->created_on)->format('d-m-Y');
            $item->status_id = $item->getRawOriginal('status');
            $item->status_mod = "<span data-status-id='".$item->status_id."'>$item->status</span>";
//            $item->status_mod2 = '<div class="dropdown no-arrow archive-dropdown">
//                                <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                '.$item->status.'
//                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
//                                    <a class="dropdown-item editTour view_ticket" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
//                                        <i class="fa fa-fw fa-comments " style="float: right;"></i>
//                                    </a>
//                                </div>
//                            </div>';

            $item->status_mod2 = '<div class="change_status dropdown theme-color" data-ticket-id="'.$item->id.'">
                                       <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="current_status">'.$item->status.'</span>
                                           <span class="caret"></span>
                                       </button>
                                       <ul class="dropdown-menu p-3 border-0" style="">';
            foreach (config('common.supportTicket.statuses') as $sID => $status) {
                if($sID != 4) { //We are not displaying Withdrawn/cancelled as it's user closable status
                    if($sID == $item->status_id)
                        $item->status_mod2 .= '<li hidden><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
                    else
                        $item->status_mod2 .= '<li><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
                }
            }
            $item->status_mod2 .= '     </ul>
                                    </div>';
            $item->action = '<div class="dropdown no-arrow archive-dropdown">
                                <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <a class="dropdown-item editTour view_ticket" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
                                        <i class="fa fa-fw fa-comments " style="float: right;"></i>
                                    </a>
                                </div>
                            </div>';
            $i++;
        }

        return [$tickets, $totalTickets];
    }

    function conversations($ticket_id) {
        $ticket = SupportTickets::where('id', $ticket_id)->with('conversations')->with('User')->first()->toArray();
        return response()->json($ticket);
    }


//    public function submit_ticket(SupportTicketsRequest $request)
//    {
//        $input = [
//            'user_id' => auth()->user()->id,
//            'department' => $request->department,
//            'priority' => $request->priority,
//            'service_type' => $request->service_type,
//            'subject' => $request->subject,
//            'message' => $request->message,
//            'created_on' => date('Y-m-d H:i:s'),
//            'status' => 1
//        ];
//        if($request->hasFile('file')) {
//            $file = $request->file('file');
////            $mime = $file->getMimeType();
//            $encryptedFileName = $this->_generateUniqueFilename(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
//            $input['file'] = $encryptedFileName;
//        }
//
////        if($this->SupportTickets->store($input)) {
//        if(SupportTickets::insert($input)) {
//            Storage::disk('support_tickets')->put($encryptedFileName, file_get_contents($file));
//            return redirect()->route('escort.dashboard')->with('success', 'Ticket created successfully');
//        } else {
//            return redirect()->route('escort.dashboard')->with('error', 'Error while creating the ticket');
//        }
//    }


    function save_message(Request $request)
    {
        $input = [
            'admin_id' => auth()->user()->id,
            'support_ticket_id' => $request->ticketId,
            'message' => $request->message,
            'date_time' => date('Y-m-d H:i:s')
        ];
        $ticketConv = new TicketConversations;
        if($ticketConv->insert($input)) {
            $st = SupportTickets::find($request->ticketId);
            $st->unread = 1;
            $st->save();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }


    function status_update($ticketID, $status_id) {
        $ticket = SupportTickets::where('id', $ticketID)->first();
        $response = [
            'status' => 'error',
            'message' => ''
        ];
        if($ticket) {
            if($ticket->status != "3" || $ticket->status != 4) { //Resolved or withdrawn
                $ticket->status = $status_id;
                $ticket->save();
                $response['status'] = 'success';
                $response['message'] = config('common.supportTicket.statuses')[$status_id];
            } else {
                $response['message'] = "Currently can't change the ticket status";
            }
        } else {
            $response['message'] = "Ticket not found";
        }
        return response()->json($response);
    }
}
