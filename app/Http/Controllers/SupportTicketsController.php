<?php
namespace App\Http\Controllers;

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
    protected $SupportTickets;

    /*public function __construct()
    {

    }*/

    public function index()
    {
        /*$tickets = SupportTickets::where('user_id', auth()->user()->id)
            ->orderBy('created_on', 'DESC')
            ->orderBy('status', 'ASC')
            ->get()->toArray();*/
        list($prefix, $prefix2) = $this->_getPrefix(auth()->user()->type);
        return view("$prefix2.SupportTickets.list");
    }

    public function create() {
        list($prefix, $prefix2) = $this->_getPrefix(auth()->user()->type);
        return view("$prefix2.SupportTickets.submit_ticket")
            ->withPrefix($prefix);
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
        $tickets = SupportTickets::where('user_id', auth()->user()->id);
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
            $item->created_on = Carbon::parse($item->created_on)->format('d-m-Y');
            $item->status_mod = "<span class='status' data-status-id='".$item->getRawOriginal('status')."'>$item->status</span>";
            $item->action = '<div class="dropdown no-arrow archive-dropdown">
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
                            </div>';

            $i++;
        }

        return [$tickets, $totalTickets];
    }

    function conversations($ticket_id) {
        $ticket = SupportTickets::where('user_id', auth()->user()->id)
                    ->where('id', $ticket_id)->with('conversations')
                    ->with('User')->first();
        $ticket->unread = 0;
        $ticket->save();
        $ticket->status_id = $ticket->getRawOriginal('status');
        $ticket = $ticket->toArray();
        return response()->json($ticket);
    }


    public function submit_ticket(SupportTicketsRequest $request)
    {
        $input = [
            'user_id' => auth()->user()->id,
            'department' => $request->department,
            'priority' => $request->priority,
            'service_type' => $request->service_type,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_on' => date('Y-m-d H:i:s'),
            'status' => 1
        ];
        $encryptedFileName = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
//            $mime = $file->getMimeType();
            $encryptedFileName = $this->_generateUniqueFilename(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $input['file'] = $encryptedFileName;
        }

//        if($this->SupportTickets->store($input)) {
        if(SupportTickets::insert($input)) {
            if($encryptedFileName)
                Storage::disk('support_tickets')->put($encryptedFileName, file_get_contents($file));

            return redirect()->route("support-ticket.list")->with('success', 'Ticket created successfully');
        } else {
            return redirect()->route("support-ticket.list")->with('error', 'Error while creating the ticket');
        }
    }


    function save_message(Request $request) {
        $input = [
            'user_id' => auth()->user()->id,
            'support_ticket_id' => $request->ticketId,
            'message' => $request->message,
            'date_time' => date('Y-m-d H:i:s')
        ];

        if(TicketConversations::insert($input)) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }


    function withdraw($ticketID) {
        $ticket = SupportTickets::where('user_id', auth()->user()->id)->where('id', $ticketID)->first();
        $response = [
            'status' => 'error',
            'message' => ''
        ];
        if($ticket) {
            if($ticket->status != "3") { //Resolved
                $ticket->status = 4;
                $ticket->save();
                $response['status'] = 'success';
            } else {
                $response['message'] = "Ticket is resolved so can't change";
            }
        } else {
            $response['message'] = "Ticket not found";
        }
        return response()->json($response);
    }
}
