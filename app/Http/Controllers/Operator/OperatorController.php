<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Operator\AddNewOperator;
use App\Models\Operator;
use App\Repositories\Operator\OperatorInterface;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\Operator\UpdateMyAccountOperator;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OperatorController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.dashboard.index');
    }

    /**
     * View my account
     * 
     *  @return \Illuminate\Http\Response
     */
    public function editMyaccount()
    {
        $operator = Operator::with('operator_detail', 'operator_setting')->where("id", auth()->user()->id)->first();
        return view('operator.dashboard.my-account.edit-my-account', compact('operator'));
    }

    public function editPassword()
    {
         $user = $this->user->find(auth()->user()->id);
        return view('operator.dashboard.my-account.change-password', compact('user'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateMyAccountOperator  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMyAccountOperator $request)
    {
        $data = [
            'name' => $request->company_name ?? null,
            'business_name' => $request->business_name ?? null,
            'business_number' => $request->business_number ?? null,
            'abn' => $request->abn ?? null,
            'business_address' => $request->business_address ?? null,
            'business_number' => $request->business_number ?? null,
            'contact_type' => isset($data['contact_type'])  ? json_encode($data['contact_type']) : null,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $data = $request->all();
            $user = Operator::where('id', $data['user_id'])->first();
            $operatorDetail = $user->operator_detail;
            $point_of_contact = $data['point_of_contact'];
            $operatorDetail->update([
                'point_of_contact' => $data['point_of_contact'] ?? $operatorDetail->point_of_contact,
            ]);
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(Request $request)
    {
        $error = true;
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:new_password_confirmation',
            'new_password_confirmation' => 'required|min:8',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.same' => 'New password and confirmation do not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
            'new_password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(["status" => false, "message" => 'Your current password is incorrect.']);
        }
        //$user->password = Hash::make($request->new_password);
        //$user->save();
        $data = $request->all();
        $this->user->changeUserPassword($data);
        return response()->json(["status" => true, "message" => 'Your password has been updated successfully!']);
    }

    /**
     * Upload avtar for logged in user
     */
    public function uploadAvatar()
    {
        return view('operator.dashboard.my-account.upload-avatar');
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
            /** @var \App\Models\User $user */
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

    /**
     * Remove saved avtar
     */
    public function removeMyAvatar()
    {
        try {
            /** @var \App\Models\User $user */
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
            $defaultImg = asset(config('constants.operator_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }

    /**
     * Update password
     * 
     * @param ChangePasswordRequest $request
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $data = $request->all();
        $currentPassword = $data['password'];
        $resposne = $this->user->changeUserPassword($data);

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }


    public function bankAccount()
    {
        return view('operator.dashboard.my-account.bank-account');
    }
    public function agentMonthlyreport()
    {
        return view('operator.dashboard.reports.agents-monthly-report');
    }
    public function e4uMonthlyreport()
    {
        return view('operator.dashboard.reports.operator-monthly-report');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
}
