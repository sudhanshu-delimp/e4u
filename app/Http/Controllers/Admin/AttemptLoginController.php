<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Mail\sendConfirmationMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Sms\SendSms;
use Mail;

class AttemptLoginController extends BaseController
{
    use AuthenticatesUsers;
    protected $attemptlogin;
    protected $user;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(AttemptLoginRepository $attemptlogin, UserInterface $user)
    {
        $this->attemptlogin = $attemptlogin;
        $this->user = $user;
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
                return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
            }

            return $next($request);
        });
    }
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    public function index()
    {
        //dd($this->cateory->all());
        return view('admin.attemptLogin.index');
    }
    public function showOnlieUsers()
    {
        //dd($this->cateory->all());
        return view('admin.attemptLogin.onlineUsers');
    }
    public function showAllUsers()
    {
        //dd($this->cateory->all());
        return view('admin.management.users.allUsers');
    }
    public function allUserDatatable()
    {
        //dd($this->user->onlineUser());
        list($user, $count) = $this->user->paginatedByUsers(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $this->editAccessEnabled
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user,
        );
        //dd($data);
        return response()->json($data);
    }
    public function showOnlieStaff()
    {
        //dd($this->cateory->all());
        return view('admin.attemptLogin.onlineStaff');
    }

    public function OnlineStaff()
    {
    
        //dd($this->user->onlineUser());
        list($user, $count) = $this->user->paginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user,
        );
        //dd($data);
        return response()->json($data);
    }

    public function dataTable()
    {
        list($attemptlogin, $count) = $this->attemptlogin->paginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $attemptlogin,
        );
        //dd($data);
        return response()->json($data);
    }
    
    public function changeSecurityLevel($id)
    {
        
       $escort = $this->user->find($id);
        //return response()->json(compact('error'));
        return view('admin.management.users.editUsers',compact('escort'));
    }
    public function updateSecurityLevel(Request $request , $id)
    {
        
        //dd($request->all());
       
        $data = [];
        $data = [
                'name' => $request->name,
                'gender' => $request->gender,
                //'type' => $request->type,
                // 'contact_type' => $request->contact_type,
               // 'phone' => $request->phone,
                //'city_id'=>$request->city_id,
                //'country_id'=>$request->country_id,
                // 'state_id'=>$request->state_id,
                // 'email'=>$request->email ? $request->email : null,
                //'social_links'=>$request->social_links,
        ];
        $user = $this->user->find($id);
        if($user->type != $request->type) {
            $type = $request->type;
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $phone = $user->phone;
            $user->save();
           
            $msg = "Never tell anyone this code. Your E4U one time password code is :".$otp;
            $sendotp = new SendSms();
            $output = $sendotp->send($user->phone,$msg);
            $error = false;
            return response()->json(compact('error','phone','otp','type')); 
            
        } 
        // else {
        //     $error = true;
        //     return response()->json(compact('error'));
        // }
        
        if($this->user->store($data, auth()->user()->id)) {
            $error = true;
            return response()->json(compact('error'));
        }
        //return response()->json(compact('error'));
    }
    protected function checkOTP(Request $request, $id)
    {
        
        //dd($request->all());
        $user = $this->user->find($id);
        if($user->otp == $request->otp) {
            $user->type = $request->type;
            $user->save();
            $error = false;
            $body = [
                
                'name' => $user->name,
             ];
            Mail::to($user->email)->send(new sendConfirmationMail($body));
       
            // if (Mail::failures()) {
            //     $error = false;
            //     return new Error(Mail::failures()); 
                
            // }
            return response()->json(compact('error')); 
            //return $this->sendLoginResponse($request);Staff@123 // Staff@123

        } else {
            return $this->sendFailedLoginResponse($request);
        }
        // $req = $request->only($this->username(), 'password','type');
        //$req = $request->only($this->username(), 'password','type');
        // dd($req);
        //return $request->only($this->username(), 'password','type');
    }


}
