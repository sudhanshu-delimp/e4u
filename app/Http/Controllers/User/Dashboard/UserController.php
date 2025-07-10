<?php

namespace App\Http\Controllers\User\Dashboard;

use Auth;
use Carbon\Carbon;
use App\Models\MyLegbox;
use Illuminate\Http\Request;
use App\Models\MyMassageLegbox;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Models\Escort;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $user;
     public function __construct(UserInterface $user)
     {
        $this->user = $user;
     }
    public function index()
    {

        return view('user.dashboard.index');
    }
    public function myLegboxList()
    {
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }

        $escorts =  collect();
        if($user_type){
            $myLegbboxIds = MyLegbox::where('user_id',auth()->user()->id)->pluck('escort_id');
            $escorts = Escort::whereIn('id',$myLegbboxIds)->with(['city','state','likes',
                'suspendProfile' => function ($query) {
                    $today = Carbon::now(config('app.timezone'));
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today)
                        ->where('status', true);
                }
            ])->where('enabled',1)->get(); // city_id
        }

      //dd($user_type->myLegBox->pluck('id')->toArray());
        return view('user.dashboard.legbox.escort-list',compact('user_type','escorts'));
    }
    public function massageLegboxList()
    {
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }
      //dd($user_type->myLegBox->pluck('id')->toArray());
        return view('user.dashboard.legbox.massagelist',compact('user_type'));
    }
    public function saveMyLegbox($escort_id)
    {
        //dd($escort_id);
        $user_id = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_id = auth()->user()->id;
        }

        $index = [];
            $index = [
                'user_id' => $user_id,
                'escort_id' => $escort_id,
            ];
            $error = 0;
            $message = '';
        if(!empty($user_id)) {
            $result = MyLegbox::where('escort_id',$escort_id)->where('user_id', $user_id)->first();
            if (!empty($result)) {
                $message = 'Already added to legbox';
            } else {
                $data = MyLegbox::create($index);
                $message = 'Added to legbox';
            }
        } else {
            $error = 1;
        }

        return response()->json(compact('error','user_id', 'message'));
    }
    public function deleteMyLegbox($escort_id)
    {
        // echo "delete id";
        // dd($escort_id);
        $user_id = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_id = auth()->user()->id;
        }
        $error = 0;
        if(!empty($user_id)) {
            $result = MyLegbox::where('escort_id',$escort_id)->where('user_id',$user_id)->delete();
            $error = 1;

        }

        return response()->json(compact('error','user_id'));
    }


    public function saveMyMassageLegbox($escort_id)
    {
        //dd($escort_id);
        $user_id = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_id = auth()->user()->id;
        }

        $index = [];
            $index = [
                'user_id' => $user_id,
                'massage_id' => $escort_id,
            ];
            $error = 0;
        if(!empty($user_id)) {
            $result = MyMassageLegbox::where('massage_id',$escort_id)->where('user_id', $user_id)->first();
            if(!empty($result))
            {
                $error = 2;
            } else {
                $data = MyMassageLegbox::create($index);
                $error = 1;
            }
        }

        return response()->json(compact('error','user_id'));
    }
    public function deleteMyMassageLegbox($escort_id)
    {
        // echo "delete id";
        // dd($escort_id);
        $user_id = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_id = auth()->user()->id;
        }
        $error = 0;
        if(!empty($user_id)) {
            $result = MyMassageLegbox::where('massage_id',$escort_id)->where('user_id',$user_id)->delete();
            $error = 1;

        }

        return response()->json(compact('error','user_id'));
    }
    public function deleteLegbox($escort_id)
    {

        $user_id = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_id = auth()->user()->id;
        }
        $error = 0;
        if(!empty($user_id)) {
            $result = MyLegbox::where('escort_id',$escort_id)->where('user_id',$user_id)->delete();
            $error = 1;

        }

        return redirect()->back()->with('success', 'Legbox delete successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function legboxDataTable()
    {
        $user = auth()->user();

        list($user, $count) = $this->user->paginatedLegboxEscort(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );
        //dd($count);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = $this->user->find(auth()->user()->id);

        //dd($user->passwordSecurity);
        return view('user.dashboard.my-account', compact('user'));
    }
    // public function edit()
    // {
    //     $profile = auth()->user();
    //     return view('user.dashboard.profile.create-profile',compact('profile'));
    // }

    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        //dd($user->passwordSecurity);
        return view('user.dashboard.change-password',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        //dd($request->all());
        $data = [];
        $data = [
                'name' => $request->name,
                'gender' => $request->gender,
               //'contact_type' => $request->contact_type,
               // 'phone' => $request->phone,
                //'city_id'=>$request->city_id,
                //'country_id'=>$request->country_id,
                // 'state_id'=>$request->state_id,
                // 'email'=>$request->email ? $request->email : null,
                //'social_links'=>$request->social_links,
        ];

        $error = false;
        if($this->user->store($data, auth()->user()->id)) {
            $error = true;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(Request $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $error = true;
        if(!Hash::check($request->password, $user->password)){
           //'Return error with current passowrd is not match';
           $error = false;
        }else{
            //'Write here your update password code';
            $data = [
                'password' => Hash::make($request->new_password),
            ];
            $this->user->store($data, auth()->user()->id);

        }

        return response()->json(compact('error'));
    }
    public function updatePasswordExpiry(Request $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $error = true;

            //'Write here your update password code';
            $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
            $user->passwordSecurity->password_notification = $request->password_notification;
            $user->passwordSecurity->password_updated_at = Carbon::now();
            $user->passwordSecurity->save();
            // dd( $request->all());
        return response()->json(compact('error'));
    }
    public function uploadAvatar()
    {
        return view('user.dashboard.profileAvatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request,$id)
    {
        //$attachment = $request->file('avatar_img');
        $avatar = $request->file('avatar_img');
        $extension = $avatar->getClientOriginalExtension();
        //$extension = explode('/', mime_content_type($request->src))[1];
        $data = $request->src;

        list($type, $data)  = explode(';', $data);
        list(, $data)       = explode(',', $data);
        $data               = base64_decode($data);
        $avatar_owner       = Auth::user()->id;

        $avatarName          = time(). '-' .$avatar_owner .'.'.$extension;
        $avatar_uri          = file_put_contents(public_path() . '/avatars/' . $avatarName, $data);

    
        //dd($avatar_uri);
        $user = $this->user->find($id);
        $user->avatar_img = $avatarName;

        $user->save();
        $type = 0;


        return response()->json(compact('type','avatarName'));
    }
    public function removeMyAvatar()
    {
            $user = $this->user->find(auth()->user()->id);
            $user->avatar_img = null;
            $user->save();
            $type = 1;
        return response()->json(compact('type'));
    }
    public function notificationsFeatures()
    {
        return view('user.dashboard.profileNotifications');
    }
    public function updateAvailablePlaymate()
    {
        $available_playmate = request()->get('available_playmate');
        $user = $this->user->find(auth()->user()->id);
        $user->available_playmate = $available_playmate;
        $user->save();
        return response()->json(compact('available_playmate'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function legboxMassageDataTable()
    {
        $user = auth()->user();
        list($user, $count) = $this->user->massageLegboxPaginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );

        return response()->json($data);
    }

}
