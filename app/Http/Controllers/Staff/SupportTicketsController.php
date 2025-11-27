<?php

namespace App\Http\Controllers\Staff;

//use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SupportTickets;
use App\Models\TicketConversations;
use Illuminate\Support\Facades\Log;
use App\Mail\sendSupportReplyToUser;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Storage;
use App\Mail\sendSupportTicketConfirmationToUser;
use App\Http\Requests\Escort\SupportTicketsRequest;
use App\Repositories\SupportTickets\SupportTicketsInterface;

class SupportTicketsController extends AppController
{
    protected $notification;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    public function __construct()
    {
        $this->notification = new Notification;
        $this->middleware(function ($request, $next) {
            $user = auth()->user();   // works here
            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }

    public function index()
    {
        return view('staff.SupportTickets.list');
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

        //dd($data);

        return response()->json($data);
    }


    private function paginatedList($start, $limit, $order_key, $dir)
    {


        $tickets = SupportTickets::with('user')->where('user_id', '>', 0);
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
        $tickets = $tickets
            ->offset($start)
            ->limit($limit)->get();

        $i = 1;
        foreach ($tickets as $key => $item) {
            $s = explode('/', $_SERVER['REQUEST_URI']);
            $item->sn = ($start + $i);
            $item->member_id = $item->user->member_id;
            $item->created_on = Carbon::parse($item->created_on)->format('d-m-Y');

            $dropdown = "";
            $dropdown = '<div class="dropdown no-arrow archive-dropdown text-center">
                                <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">';

            if ($item->status != 'Active') {
                $dropdown .= '<a 
                                        class="dropdown-item editTour change-status-btn d-flex align-items-center justify-content-start gap-10" 
                                        href="#"
                                        data-id="' . $item->id . '" 
                                        data-status="1">
                                        <i class="fa fa-circle"></i>  
                                        Active 
                                        </a> <div class="dropdown-divider"></div>';
            }


            if ($item->status != 'In-progress') {
                $dropdown .=  '<a 
                                        class="dropdown-item editTour change-status-btn d-flex align-items-center justify-content-start gap-10" 
                                        href="#"
                                        data-id="' . $item->id . '" 
                                        data-status="2"> 
                                        <i class="fa fa-spinner"></i> In-progress
                                        </a> <div class="dropdown-divider"></div>';
            }


            if ($item->status != 'Resolved') {
                $dropdown .=  '<a  
                                        class="dropdown-item editTour change-status-btn d-flex align-items-center justify-content-start gap-10" 
                                        href="#"
                                        data-id="' . $item->id . '" 
                                        data-status="3">
                                       
                                        <i class="fa fa-check"></i>  Resolved
                                        </a> <div class="dropdown-divider"></div>';
            }


            $dropdown .= '<a class="dropdown-item editTour view_ticket d-flex align-items-center justify-content-start gap-10" id="cdTour" href="#" data-toggle="modal" data-id=' . $item->id . ' data-target="#conversation_modal"> <i class="fa fa-comments text-default"></i> History
                                        
                                        </a>';
            $dropdown .= '</div></div>';
            $item->action = "";
            if ($this->editAccessEnabled) {
                $item->action = $dropdown;
            }
            $i++;
        }



        return [$tickets, $totalTickets];
    }
    //     private function paginatedList($start, $limit, $order_key, $dir)
    //     {
    //         $tickets = SupportTickets::where('user_id', '>', 0);
    //         switch ($order_key) {
    //             case 1:
    //                 $tickets->orderBy('department', $dir);
    //                 break;
    //             case 2:
    //                 $tickets->orderBy('priority', $dir);
    //                 break;
    //             case 3:
    //                 $tickets->orderBy('service_type', $dir);
    //                 break;
    //         }
    //         if($order_key == 6) {
    //             $tickets->orderBy('created_on', $dir)->orderBy('status', 'ASC');
    //         } elseif($order_key == 7) {
    //             $tickets->orderBy('status', $dir)->orderBy('created_on', 'DESC');
    //         } else {
    //             $tickets->orderBy('created_on', 'DESC');
    //             $tickets->orderBy('status', 'ASC');
    //         }

    //         $totalTickets = $tickets->count();
    //         $tickets = $tickets
    //             ->offset($start)
    //             ->limit($limit)->get();

    //         $i = 1;
    //         foreach($tickets as $key => $item) {
    //             $s = explode('/',$_SERVER['REQUEST_URI']);
    //             $item->sn = ($start+$i);
    //             $item->member_id = $item->user->member_id;
    //             $item->created_on = Carbon::parse($item->created_on)->format('d-m-Y');
    //             $item->status_id = $item->getRawOriginal('status');
    //             $item->status_mod = "<span data-status-id='".$item->status_id."'>$item->status</span>";
    // //            $item->status_mod2 = '<div class="dropdown no-arrow archive-dropdown">
    // //                                <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    // //                                '.$item->status.'
    // //                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
    // //                                    <a class="dropdown-item editTour view_ticket" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
    // //                                        <i class="fa fa-fw fa-comments " style="float: right;"></i>
    // //                                    </a>
    // //                                </div>
    // //                            </div>';

    //             $item->status_mod2 = '<div class="change_status dropdown theme-color" data-ticket-id="'.$item->id.'">
    //                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                                             <span class="current_status">'.$item->status.'</span>
    //                                            <span class="caret"></span>
    //                                        </button>
    //                                        <ul class="dropdown-menu p-3 border-0" style="">';
    //             foreach (config('common.supportTicket.statuses') as $sID => $status) {
    //                 if($sID != 4) { //We are not displaying Withdrawn/cancelled as it's user closable status
    //                     if($sID == $item->status_id)
    //                         $item->status_mod2 .= '<li hidden><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
    //                     else
    //                         $item->status_mod2 .= '<li><a onclick="return change_status(this, '.$sID.')" href="">'.$status.'</a></li>';
    //                 }
    //             }
    //             $item->status_mod2 .= '     </ul>
    //                                     </div>';
    //             $item->action = '<div class="dropdown no-arrow archive-dropdown">
    //                                 <a class="dropdown-toggle" href="" role="button" class="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
    //                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
    //                                     <a class="dropdown-item editTour view_ticket" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#conversation_modal">History
    //                                         <i class="fa fa-fw fa-comments " style="float: right;"></i>
    //                                     </a>
    //                                 </div>
    //                             </div>';
    //             $i++;
    //         }



    //         return [$tickets, $totalTickets];
    //     }

    function conversations($ticket_id)
    {

        $ticket = SupportTickets::with([
            'conversations',
            'conversations.user_from_admin',
            'conversations.user_from_user',
            'user'
        ])
            ->where('id', $ticket_id)
            ->first();

        //$ticket = SupportTickets::where('id', $ticket_id)->with('conversations')->with('User')->first();
        $ticket->status_id = $ticket->getRawOriginal('status');
        $ticket = $ticket->toArray();
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
        if ($ticketConv->insert($input)) {
            $st = SupportTickets::find($request->ticketId);
            $st->unread = 1;
            $st->save();

            ################# Send Email To User #####################
            $userData = [

                'user_id' => $st->user->id,
                'ref_number' => $st->ref_number,
                'department' => $st->department,
                'priority' => $st->priority,
                'service_type' => $st->service_type,
                'subject' => $st->subject,
                'message' => $request->message,
                'name' => isset($st->user->name) ? $st->user->name : "",
                'email' => isset($st->user->email) ? $st->user->email : "",
                'member_id' => isset($st->user->member_id) ? $st->user->member_id : "",
            ];

            ############ Send Notification ################
            $user_type = User::where('id', $st->user->id)->first();
            if ($user_type->type == '3' || $user_type->type == '4')
                $url = url('/support_tickets/ticket-list');
            elseif ($user_type->type == '5')
                $url =  url('/support_tickets/ticket-list/');
            else
                $url =  url('/user-dashboard/view-and-reply-ticket/');

            $title =    'You have received a new message on <a href="' . $url . '"> support ticket#' . $st->ref_number . '</a>';

            $data = [
                'title' => $title,
                'to_user' => [$st->user->id],
                'ref_number_id' => $request->reference_id,
                'notification_type' =>  'support_ticket',
                'notification_listing_type' =>  '1',
            ];
            $this->notification->sendNotification($data);
            ############## End Send Notification ##########

            //$this->sendSupportReplyToUser($userData);

            ################## End Send Email To User ################

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }


    function status_update($ticketID, $status_id)
    {
        $ticket = SupportTickets::where('id', $ticketID)->first();
        $response = [
            'status' => 'error',
            'message' => ''
        ];
        if ($ticket) {
            if ($ticket->status != "3" || $ticket->status != 4) {
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


    public function sendSupportReplyToUser($userData)
    {
        try {
            if (isset($userData['email']) && $userData['email'] != "") {
                Mail::to($userData['email'])->queue(new sendSupportReplyToUser($userData));
                return true;
            }

            return false;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return false;
        }
    }
}
