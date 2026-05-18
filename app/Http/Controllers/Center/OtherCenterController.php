<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMassageCentre;
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

        $userlists  = User::where('created_by', auth()->user()->id)->orderBy('id','desc')->get();
        
        // $countries = getCountryList();
        // $totalActive = $masseurs->where('status', 1)->count();

        $data = $userlists->map(function ($row)  {

            // if($row->status==1)
            // $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action" data-row-id="'.$row->id.'" id="row_deactive" href="javascript:void(0)">   <i class="fa fa-ban"></i> Suspend</a>';   
            //     else
            // $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-circle"></i> Activate</a>';     
            
            
            $links = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-times-circle"></i> Suspend</a>';     
            $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-circle"></i> Grant Access</a>'; 
            $links.= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-eye"></i> View</a>'; 
            
            $action = '<div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                
                                                
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-center-btn" href="javascript:void(0)" data-row=\''.json_encode($row).'\'> <i class="fa fa-pen"></i> Edit profile </a>
                                                <div class="dropdown-divider"></div>'.$links;
                                                
                                                
                                                
            '</div>';
            

            return [
                'member_id' => $row->member_id,
                'name' => $row->name,
                'entity_name' => $row->entity_name,
                'business_address' => $row->business_address,
                'business_number' => $row->business_number,
                'mobile' => $row->phone,
                'email' => $row->email,
                'action' => $action,
                'login' => '<a href="'.route('center.switch-to-child', $row->id).'">Switch Account</a>'

            ];
        });  


        return response()->json([
            'data' => $data,
        ]);


    }


   


    public function backToParent()
    {
      
        if (!session()->has('parent_user_id')) {

            abort(403, 'No parent session found');
        }

        $parentUser = User::find(session('parent_user_id'));

        if (!$parentUser) {

            Auth::logout();

            session()->flush();

            return redirect('/advertiser-login');
        }

        Auth::login($parentUser);

        session()->forget([
            'parent_user_id',
            'is_impersonated'
        ]);

        return redirect('/center-dashboard')
            ->with('success', 'Back to parent account');
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

        return redirect('/center-dashboard')->with('success', 'Logged in as child account');
    }

}
