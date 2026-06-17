<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMassageCentre;
use App\Mail\MessageCentr\OtherCentreRegistrationEmail;
use App\Models\User;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtherCenterController extends Controller
{
    protected $escort;
    protected $availability;
    protected $service;
    protected $user;
    protected $massage_profile;
    protected $attemptlogin;
    protected $account;

    public function __construct(AttemptLoginRepository $attemptlogin, MassageProfileInterface $massage_profile, UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service)
    {
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
        $this->availability = $availability;
        $this->service = $service;
        $this->user = $user;
        $this->attemptlogin = $attemptlogin;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }


    public function add_sub_account(AddMassageCentre $request)
    {
        $data = $request->all();
        try
        {
            $data = $request->all();

            if(!isset($data['center_id']) || $data['center_id']=="")
            $resposne = $this->user->add_subuser_account($data);
            else
            $resposne = $this->user->update_subuser_account($data);    

            if($resposne['status'])
            return  Success_response([],$resposne['message'],200);
            else
            return  Success_response([],$resposne['message'],200);   
        } 
        catch(Exception $e){
          return  Success_response([],'Failed to add new centre',200);    
        }
    }


    public function  get_all_other_centre_list(Request $request)
    {
        //$userlists  = User::where('created_by', auth()->user()->id)->orderBy('id','desc')->get();

        $userlists = User::where('created_by', auth()->id())
        ->where('type','4')
        ->withCount([
            'user_support_notification as notification_count' => function ($query) {
                $query->where('is_seen', 0)
                      ->where('notification_listing_type', '1');
            }
        ])
        ->orderBy('id', 'desc')
        ->get();
        
        $data = $userlists->map(function ($row)  {

            $row->access_granted        = ($row->is_access_granted == 1) ? 'Yes' : 'No';
            $row->join_date             = date('d-m-Y',strtotime($row->created_at));
            
            $row->method_of_contact = "";
            if (!empty($row->contact_type)) 
            {
                $contactType = $row->contact_type;
                if (is_array($contactType) && count($contactType) > 0) {
                    $row->method_of_contact = implode(', ', $this->user->get_contact_type($contactType));
                }
            }


            $statusText = $row->status ?? 'NA';
            $badgeClass = getStatusBadgeClass($statusText);
            $row->status_text = '<span class="custom_badge '.$badgeClass.'">'.$statusText.'</span>';

           

            

            $row->access_permitted = ($row->is_access_granted) ? 'Yes' : 'No';

            $links = "";
            $label = "";


            if($row->notification_count>0)
            $label = '<span class="brb_icon listing-tag-tooltip  m-1 notification_support_ticket" style="background-color:#182333">'.$row->notification_count.' unread support ticket</span>';


            if($row->is_access_granted)
            $label .= '<span class="brb_icon listing-tag-tooltip ml-1" style="background-color:#1CC88A">Granted</span>';

           

            if($row->status=='Suspended')
            $label .= '<span class="playmate_icon listing-tag-tooltip ml-1">Suspended</span>';


            $display_name = "<span class='grant-access'>".$row->name.$label."</span>";            

            if($row->is_access_granted)
            {
                if($row->status!='Suspended')
                $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" data-row-id="'.$row->id.'" id="row_suspend"  href="javascript:void(0)">   <i class="fa fa-times-circle"></i> Suspend</a>'; 
                else
                $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" data-row-id="'.$row->id.'" id="row_suspend"  href="javascript:void(0)">   <i class="fa fa-check"></i> Activate</a>';    

            }
             if(!$row->is_access_granted)
             $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-grant-access" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-circle"></i> Grant Access</a>'; 
             if(!session()->has('parent_agent_id')) {
            $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center login_center" data-row-id="'.$row->id.'" href="javascript:void(0)"> <i class="fa fa-random"></i> Switch to</a>';  
             }

            $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-center-btn" href="javascript:void(0)" data-row=\''.json_encode($row).'\'  href="javascript:void(0)">   <i class="fa fa-eye"></i> View</a>'; 
            
            $action = '<div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                
                                                
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-center-btn" href="javascript:void(0)" data-row=\''.json_encode($row).'\'> <i class="fa fa-pen"></i> Edit profile </a>
                                                '.$links;
                                                
                                                
                                                
            '</div>';
            

            return [
                'member_id' => $row->member_id,
                'name' => $display_name,
                'entity_name' => $row->entity_name,
                'business_address' => $row->business_address,
                'business_number' => $row->business_number,
                'mobile' => $row->phone,
                'email' => $row->email,
                'status' => $statusText,
                'action' => $action,
            ];
        });  


        return response()->json([
            'data' => $data,
        ]);


    }

    public function account_action(Request $request)
    {
        $user = User::where('id',$request->id)->first();

        if($request->id && $request->request_type && $request->request_type=='suspend')
        {
            if($user->status && $user->status=='Suspended')
            {
                return Success_response([],'This Account Already Suspended',200); 
            }
            
            $user->status = '3';
            $response = $user->save();

            if($response)
            return Success_response([],'Account Suspended Successfully',200); 
            else
            return Success_response([],'Error Occurred while Account Suspending',200);
        }

        else if($request->id && $request->request_type && $request->request_type=='access-grant')
        {
            if($user->status && $user->is_access_granted==1)
            {
                return Success_response([],'This Account Already Acccess Granted ',200); 
            }
            
            $new_password = 'e4u' . random_int(100000, 999999);

            $user->is_access_granted = 1;
            $user->password =  Hash::make($new_password);
            $response = $user->save();

            try {
            Mail::to($user->email)->send( new OtherCentreRegistrationEmail($user,$new_password));
            } 
            catch (Exception $e) {
            Log::error('Other Massage Center Email sending failed: ' . $e->getMessage());
            }

            if($response)
            return Success_response([],'Account Granted Successfully',200); 
            else
            return Success_response([],'Error Occurred while Account Suspending',200);
        }

        else if($request->id && $request->request_type && $request->request_type=='activate-account')
        {
            if($user->status && $user->status=='Active')
            {
                return Success_response([],'This Account Already Active ',200); 
            }
            
                $user->status = '1';
            $response = $user->save();

            if($response)
            return Success_response([],'Account Activated Successfully',200); 
            else
            return Success_response([],'Error Occurred while Account Suspending',200);
        }
        else
        {
            return Success_response([],'Unknown Input Found',200);
                
        }
            
    }
 

    public function backToParent()
    {
      
        if (!session()->has('parent_massage_id')) {

            abort(403, 'No parent session found');
        }

        $parentUser = User::find(session('parent_massage_id'));

        if (!$parentUser) {

            Auth::logout();

            session()->flush();

            return redirect('/advertiser-login');
        }

        Auth::login($parentUser);

        session()->forget([
            'parent_massage_id',
            'is_impersonated',
            'switch_for'
        ]);

        return redirect('/center-dashboard')
            ->with('success', "Switched back to ".Auth::user()->name." account");
    }


    public function switchLogin($id)
    {


        $loggedInUser = Auth::user();

        if ($loggedInUser->is_child == 1) {

            abort(403, 'Child account cannot switch users');
        }


        if ($loggedInUser->type != 4) {

            abort(403, 'Unauthorized');
        }

      

        $childUser = User::where('id', $id)
            ->where('created_by', $loggedInUser->id)
            ->where('is_child', 1)
            ->first();

        if (!$childUser) {

            abort(404, 'Child account not found');
        }


        session([
            'parent_massage_id' => $loggedInUser->id,
            'switch_for'=> 'massage_to_massage',
            'is_impersonated' => true
        ]);

        Auth::login($childUser);

        return redirect('/center-dashboard')->with('success', 'Logged in as '.Auth::user()->name);
    }

}
