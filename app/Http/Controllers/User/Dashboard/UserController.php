<?php

namespace App\Http\Controllers\User\Dashboard;

use Auth;
use Exception;
use App\Models\User;
use Carbon\Carbon;
use App\Models\MyLegbox;
use Illuminate\Http\Request;
use App\Models\MyMassageLegbox;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreAvatarMediaRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public $user;
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
      //dd($user_type->myLegBox->pluck('id')->toArray());
        return view('user.dashboard.legbox.list',compact('user_type'));
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
        $user = User::with('account_setting')->where('id',auth()->user()->id)->first();
        //dd( $user);
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
        $response = [];
        try 
        {
                $current_user  = User::with('account_setting')->where('id',auth()->user()->id)->first();
                if(!Hash::check($request->password, $current_user->password)){
                    $response = ['error' => true ,'message'=>'Your current password is incorrect.'];
                }
                else
                {   
                    
                    $data = $request->all();
                    $this->user->changeUserPassword($data);    
                    $response = ['error' => false ,'message'=>'Password Changed Successfully'];
                }
                return response()->json($response);
        } 
        catch (Exception $e ) {
         return response()->json(['error' => true ,'message'=>'Error occured while changing password']);
        }
    }


    public function updatePasswordExpiry(Request $request)
    {
        $data = $request->all();
        $this->user->update_account_setting($data); 
        return response()->json(['error' => false ,'message'=>'Password Settings Updated Successfully']);
    
    }


    public function uploadAvatar()
    {
        return view('user.dashboard.profileAvatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request,$id)
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
            return response()->json(compact('type','avatarName'));
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
                return response()->json([ 'type' => 1,'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if(File::exists($path)){
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            }else{
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
           $defaultImg = asset(config('constants.viewer_default_icon')); //for viewer
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg ]);
            
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json([ 'type' => 1,'message' => 'An error occurred while removing avatar. Please try again.' ], 500);
        }
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
