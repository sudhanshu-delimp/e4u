<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupportTickets;
use App\Models\TicketConversations;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSupportTicketToAdmin;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Storage;
use App\Mail\sendSupportTicketConfirmationToUser;
use App\Http\Requests\Escort\SupportTicketsRequest;
use App\Repositories\SupportTickets\SupportTicketsInterface;

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
            $search = request()->input('search.value');

            if (!empty($search)) {
                $tickets->where(function ($query) use ($search) {
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
                case 6:
                    $tickets->orderBy('created_on', $dir)->orderBy('status', 'ASC');
                    break;
                case 7:
                    $tickets->orderBy('status', $dir)->orderBy('created_on', 'DESC');
                    break;
                default:
                    $tickets->orderBy('created_on', 'DESC')->orderBy('status', 'ASC');
                    break;
            }

            $totalTickets = $tickets->count();

            $tickets = $tickets->offset($start)
                            ->limit($limit)
                            ->get();

            $i = 1;
            foreach ($tickets as $item) {
                $item->sn = ($start + $i);
                $item->file = ($item->file!="") ? '<a download="true" href = "'.asset('support_tickets/'.$item->file).'">Download</a>' : "No Documents";
                $item->created_on = \Carbon\Carbon::parse($item->created_on)->format('d-m-Y');
                $item->status_mod = "<span class='status' data-status-id='".$item->getRawOriginal('status')."'>$item->status</span>";
                $item->action = '<div class="dropdown no-arrow archive-dropdown text-center">
                                    <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                    ';

                $item->action .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view_ticket" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal"> <i class="fa fa-comments"></i> History
                                    </a>  <div class="dropdown-divider"></div>';
                if (!in_array($item->getRawOriginal('status'), [3, 4])) {
                    $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 cancelTicket" href="#" data-id=' . $item->id . '> <i class="fa fa-ban"></i> Withdraw
                                        </a>';
                }
                $item->action .= '</div></div>';

                $i++;
            }

            return [$tickets, $totalTickets];
    }


    function conversations($ticket_id) {

        $ticket = SupportTickets::with([
            'conversations',
            'conversations.user_from_admin',
            'conversations.user_from_user',
            'user'
        ])
        ->where('user_id', auth()->id())
        ->where('id', $ticket_id)
        ->first();


        $ticket->unread = 0;
        $ticket->save();
        $ticket->status_id = $ticket->getRawOriginal('status');
        $ticket = $ticket->toArray();
        return response()->json($ticket);
    }


    public function submit_ticket(SupportTicketsRequest $request)
    {
       
        $refNumber = random_string();
        $red_url = (isset($request->user_type) && $request->user_type == 'viewer') ? 'user.view-and-reply-ticket' : 'support-ticket.list';
        $input = [
            'user_id' => auth()->user()->id,
            'ref_number'=> $refNumber,
            'department' => $request->department,
            'priority' => $request->priority,
            'service_type' => $request->service_type,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_on' => date('Y-m-d H:i:s'),
            'status' => 1
        ];
        $encryptedFileName = '';
        $is_file_attached = "";
        if($request->hasFile('file')) {
            $file = $request->file('file');
//            $mime = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();
            $encryptedFileName = $this->_generateUniqueFilename(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension;
            $input['file'] = $encryptedFileName;
        }


        

        if(SupportTickets::insert($input)) 
        {
            
            if($encryptedFileName)
            {
                Storage::disk('support_tickets')->put($encryptedFileName, file_get_contents($file));
                $input['file_path'] = $encryptedFileName; 
                $is_file_attached = $encryptedFileName;
            }
            

            ################### Send Email User And Admin #######################
            
            $input['name'] = auth()->user()->name;
            $input['member_id'] = auth()->user()->member_id;
            $body = $input;
            try 
            {
                Mail::to(config('common.contactus_admin_email'))->queue(new SendSupportTicketToAdmin($body));
                Mail::to(auth()->user()->email)->queue(new sendSupportTicketConfirmationToUser($body));
            } 
            catch (Exception $e) {
                
            }
            ################### End Send Email User And Admin #######################
            if($is_file_attached!="")
            {

                 $message = 'Your ticket is submitted successfully along with attached document.';
            }
            else
            {
                $message = 'Your ticket is submitted successfully.';
            }
           

            return redirect()->route($red_url)->with('success', $message);
        } 
        else 
        {
            return redirect()->route($red_url)->with('error', 'Error while creating the ticket');
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
