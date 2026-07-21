<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMassageCentre;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreRequestRates;
use App\Http\Requests\Escort\StoreRequestServices;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\UpdateMassageRequest;
use App\Models\CenterNotification;
use App\Models\DashboardViewer;
use App\Models\Duration;
use App\Models\FeesConciergeService;
use App\Models\FeesSupportService;
use App\Models\MassageSetting;
use App\Models\MembershipPlan;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\User;
use App\Models\VariablLoyaltyProgram;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use Auth;
use Carbon\Carbon;
use Exception;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\AdvertiserDiscount;


class CenterController extends Controller
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


    public function index()
    {
        $result = $this->attemptlogin->findby(auth()->user()->id);
        if ($result[0]->login_count <= 1 && !session()->has('welcome_popup_closed')) {
            session(['show_welcome_popup' => true]);
        }
        $escorts = $this->escort->all();
        $viewer_array = DashboardViewer::where('user_id', auth()->id())->first(); 
        $notification = $this->getActiveNotification(); 
        return view('center.dashboard.index', compact('escorts','viewer_array', 'notification'));
    }


   
    public function dataTable()
    {
        list($escort, $count) = $this->massage_profile->massagePaginated(
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
            "data"            => $escort
        );

        return response()->json($data);
    }

    public function deleteProfile($id)
    {
        //dd($id);
        $escort = $this->massage_profile->find($id);

        $escort->services()->sync([]);
        $escort->durations()->sync([]);
        $escort->medias()->delete();
        $escort->images()->delete();
        $escort->availability()->delete();
        //$escort->videos()->delete();
        //$escort->messages()->delete();
        $this->massage_profile->destroy($id);
        $error = 1;

        return redirect()->route('center.list');
        //return response()->json(compact('error'));

    }
    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('center.my-account.change-password', compact('user'));
    }
    public function updatePassword(UpdateEscortRequest $request)
    {
        $response = [];
        try {
            $current_user  = User::with('account_setting')->where('id', auth()->user()->id)->first();
            if (!Hash::check($request->password, $current_user->password)) {
                $response =  error_response('Your current password is incorrect.', 422);
            } else {
                $data = $request->all();
                $this->user->changeUserPassword($data);
               $response =  Success_response($data,'Password Changed Successfully',200);
            }
            return $response;
        } catch (\Exception $e) {
            return error_response('Error occured while changing password', 500);
        }
    }
    
    public function updatePasswordExpiry(UpdateEscortRequest $request)
    {
        // $user = $this->user->find(auth()->user()->id);
        // $error = true;

        // //'Write here your update password code';
        // $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
        // $user->passwordSecurity->password_notification = $request->password_notification;
        // $user->passwordSecurity->password_updated_at = Carbon::now();
        // $user->passwordSecurity->save();
        // // dd( $request->all());
        // return response()->json(compact('error'));

        $data = $request->all();
        try{
            $this->user->update_account_setting($data);
           return  Success_response($data,'Password Settings Updated Successfully',200);
        } catch(\Exception $e){
             return error_response('Failed to update Password Settings', 500);
            
        }
    }
    public function uploadAvatar()
    {
        return view('center.my-account.upload-avatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request, $id)
    {

        try {
            if ((int) Auth::id() !== (int) $id) {
                return response()->json(['type' => 1, 'message' => 'Unauthorized'], 403);
            }

            $src = $request->input('src');

            $semicolonPos = strpos($src, ';');
            $mime = substr($src, 5, $semicolonPos - 5); // image/jpeg
            $extension = explode('/', $mime)[1] ?? 'png';
            $extension = strtolower($extension) === 'jpeg' ? 'jpg' : strtolower($extension);

            $commaPos = strpos($src, ',');
            $base64 = substr($src, $commaPos + 1);
            $binary = base64_decode($base64, true);

            $dir = public_path('avatars');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $avatarOwner = Auth::id();
            $avatarName = time() . '-' . $avatarOwner . '.' . $extension;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $avatarName;
            if (File::put($fullPath, $binary) === false) {
                throw new \RuntimeException('Failed to save avatar file');
            }

            $user = $this->user->find($id);
            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }

            if (!empty($user->avatar_img)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $user->avatar_img;
                if (File::exists($oldPath)) {
                    @File::delete($oldPath);
                }
            }

            $user->avatar_img = $avatarName;
            $user->save();

            $type = 0;
            return response()->json(compact('type', 'avatarName'));
        } catch (\Throwable $e) {
            \Log::error('Error saving avatar for user ' . $id . ': ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => $e->getMessage()], 500);
        }
    }
    public function removeMyAvatar()
    {
        try {
            $user = $this->user->find(auth()->user()->id);

            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if (File::exists($path)) {
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            } else {
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
            $defaultImg = asset(config('constants.massage_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => $e->getMessage()], 500);
        }
    }
    public function edit()
    {
        $escort = User::find(auth()->id());
    

        return view('center.my-account.edit-my-account', compact('escort'));
    }
    public function update(UpdateMassageRequest $request)
    {
        // dd($request->all());  // "payID_name" => "5386363869" "paID_no" => "8998"
        $data = [];
        $data = [
            'name' => $request->name,
            'entity_name' => $request->entity_name,
            'business_address' => $request->business_address,
            'business_number' => removeSpaceFromString($request->business_number),
            'phone' => removeSpaceFromString($request->phone),
            'contact_type' => $request->contact_type,
            'pay_id_name'=> removeSpaceFromString($request->payID_name),
            'pay_id_no'=> $request->paID_no,
            'social_media_consent' => $request->social_media_consent,
            'subrub_city'=>$request->subrub_city,

            // 'gender' => $request->gender,
            //'phone' => $request->phone,
            //'city_id'=>$request->city_id,
            //'country_id'=>$request->country_id,
            // 'state_id'=>$request->state_id,
            // 'email'=>$request->email ? $request->email : null,
            //'social_links'=>$request->social_links,
            
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }

        account_complete_status();
        return response()->json(compact('error'));
    }

    public function timeConvert($array)
    {
        $time = explode(':', $array);
    }

    public function getActiveNotification(){
        $userId = auth()->user()->member_id;
         $notification  = CenterNotification::where('status', 'Published')
                ->where('start_date', '<=', now())
                ->where(function($query) use ($userId) {
                    $query->whereNull('member_id')
                          ->orWhere('member_id', $userId);
                })
                ->orderBy('start_date', 'asc')
                ->select('id', 'heading', 'content', 'template_name')
                ->first();
            return $notification;   
    }
    
    
    public function customiseDashboard(Request $request)
    {
        
        $viewer_array = DashboardViewer::where('user_id', auth()->id())->first(); 
        return view('center.dashboard.customise-dashboard', compact('viewer_array'));
    }

    public function updateCustomiseDashboard(Request $request)
    {
           $viewers = config('constants.dashboard_viewer.center');
            $my_view = [];
            foreach($viewers as $view) :
                $my_view[$view['key']] = 0 ;
            endforeach;

          
            $viewer = DashboardViewer::firstOrCreate(
                ['user_id' => auth()->id()],
                ['my_view' =>  $my_view]
            );

            $data = $viewer->my_view;
            $data[$request->key] = (int) $request->value;

            $viewer->update(['my_view' => $data]);
            return response()->json(['success' => true, 'data' => $data]);
    }

    public function LogsAndStatus()
    {
        $user = Auth::user();
        $state = config('escorts.profile.states')[$user->state_id]['stateName'] ?? '';
        $logAndStatus = $user->LoginStatus;
        $passwirdExpire = $user->account_setting;
        $getLastLoginTime = getUserWiseLastLoginTime($user);
        $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);
        return view('center.dashboard.logs-and-status',compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire', 'getLastLoginTime'));
    }

    public function updatePasswordDuration(UpdateEscortRequest $request)
    {
        $user = Auth::user();
        $passwordExpiry = $request->input('password_expiry');

        if ($user->account_setting) {
            $user->account_setting->password_expiry_days = $passwordExpiry;
            $user->account_setting->save();
        } else {

            return  error_response('Password security settings not found.', 422);
        }

        $passwordExpiryText = CheckExpireDate($passwordExpiry);

        return Success_response(['passwordExp' => $passwordExpiry, 'text' => $passwordExpiryText], 'Password duration updated successfully', 200);
    }


    public function pricing() {
        
        $states = config('escorts.profile.states');
        $membership_types = MembershipPlan::where('is_for_calculater','1')->get()->toArray();
        $no_of_members = config('agent.no_of_members');

        $advertings = Pricing::with('memberships')->get()->toArray();
        $discount = AdvertiserDiscount::getActiveForUser($this->account->id);
        if($this->account->type == MESSAGE_CENTER && $discount){
            $rows = array_map(function($item) use($discount){
                if(in_array($item['membership_id'],['5'])){
                    $item['special_discount'] = $discount->value;
                    $item['new_rate'] = number_format($discount->discountAmount($item['price']),2);
                    $item['discount_amount'] = AdvertiserDiscount::getNetDiscount($item, $discount);
                }
                return $item;
            },$advertings);
            $advertings = $rows;
        }
        $fees_concierge_services = FeesConciergeService::all();
        $fees_support_services = FeesSupportService::all();
        $variablLoyaltyProgram = VariablLoyaltyProgram::all();
    
        return view('center.dashboard.Community.pricing',compact('advertings', 'membership_types','states','no_of_members','fees_concierge_services','fees_support_services','variablLoyaltyProgram'));
    }

}
