<?php

namespace App\Http\Controllers\Shareholder;

use App\Http\Controllers\Controller;
use App\Models\ShareholderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Shareholder\UpdateShareholderMyAccount;
use App\Models\Shareholder;
use App\Models\ShareholderContact;
use App\Models\ShareholderSetting;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\User\UserInterface;

class ShareholderController extends Controller
{
    protected $current_date_time;
    protected $user;
    protected $mainuser;

    public function __construct(Shareholder $user, UserInterface $mainuser)
    {
        $this->user = $user;
        $this->mainuser = $mainuser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agentNotifications = $this->shareHolderNotification();
        $staff = Shareholder::where("id", auth()->user()->id)->first();
        return view('shareholder.dashboard.index', compact('agentNotifications', 'staff'));
    }

    //get Shareholder Notificaiton
    public function shareHolderNotification()
    {
        $today = Carbon::today();
        $todayDate = $today->toDateString();
        $loggedMemberId = Auth::user()->member_id ?? 0;

        $notifications = ShareholderNotification::where('status', 'Published')->where(function ($query) use ($todayDate, $loggedMemberId) {
            //Ad hod Notification Validate Today
            $query->where('type', 'Ad hoc')
                ->where('start_date', '<=', $todayDate)
                ->where('end_date', '>=', $todayDate);
            // Notice notifications valid for today with matching member_id
            $query->orWhere(function ($q) use ($todayDate, $loggedMemberId) {
                $q->where('type', 'Notice')
                    ->where('start_date', '<=', $todayDate)
                    ->where('end_date', '>=', $todayDate)
                    ->where('member_id', $loggedMemberId);
            });

            // Notice notifications valid for template 
            $query->orWhere(function ($q) use ($todayDate) {
                $q->where('type', 'Template')
                    ->where('start_date', '<=', $todayDate)
                    ->where('end_date', '>=', $todayDate);
            });
            // Scheduled notifications valid for today based on scheduled_days or forever recurring
            $query->orWhere(function ($q) use ($todayDate) {
                $q->where('type', 'Scheduled')
                    ->where(function ($sq) use ($todayDate) {
                        $sq->whereRaw('FIND_IN_SET(?, scheduled_days)', [$todayDate])
                            ->orWhere('recurring_type', 'forever');
                    });
            });
        })->orderBy('created_at', 'desc')
            ->select('id', 'heading', 'content', 'template_name')
            ->get();
        return $notifications;
    }

    // my account
    public function editMyaccount()
    {
        $staff = Shareholder::where("id", auth()->user()->id)->first();
        return view('shareholder.dashboard.my-account.edit-my-account', compact('staff'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateShareholderMyAccount  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShareholderMyAccount $request)
    {
        $data = $request->all();
        $contactType = isset($data['contact_type']) ? $data['contact_type'] : "";
        $dataToSave  =  [
            'contact_person' => $data['contact_person'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            //'business_name' => $data['business_name'] ?? null,
            'business_address' => $data['business_address'] ?? null,
            'contact_type' => isset($data['contact_type'])  ? $contactType : null,
            'updated_by' => (session()->has('parent_user_id')) ? session('parent_user_id') : Auth::id()

        ];

        $error = true;
        if ($this->user->where('id', auth()->user()->id)->update($dataToSave)) {

            $staffSetting = ShareholderSetting::firstOrNew(['user_id' => auth()->user()->id]);
            $staffSetting->idle_preference_time = $data['idle_preference_time'] ?? null;
            $staffSetting->twofa = $data['twofa'] ?? '2';
            $staffSetting->save();
            $contactIds = isset($data['contact_id']) ? $data['contact_id'] : [];
            $persons = isset($data['key_contact_name']) ? $data['key_contact_name'] : [];
            $mobiles = isset($data['key_contact_phone']) ? $data['key_contact_phone'] : [];
            $emails = isset($data['key_contact_email']) ? $data['key_contact_email'] : [];
            $idsFromForm = [];

            if (isset($data['user_id']) && (!empty($data['user_id']))) {
                $user =  $this->user->where('id', $data['user_id'])->first();
                if ($user) {

                    foreach ($persons as $index => $person) {

                        $contactId = $contactIds[$index] ?? null;
                        $mobile     = $mobiles[$index] ?? null;
                        $email     = $emails[$index] ?? null;
                        // skip empty row
                        if (!$person && !$mobile && !$email) {
                            continue;
                        }

                        if ($contactId) {
                            // UPDATE EXISTING
                            $contact = $user->contacts()->find($contactId);

                            if ($contact) {
                                $contact->update([
                                    'name'  => $person,
                                    'mobile' => $mobile,
                                    'email' => $email,
                                ]);

                                $idsFromForm[] = $contactId;
                            }
                        } else {
                            // CREATE NEW
                            $newContact = $user->contacts()->create([
                                'name'  => $person,
                                'mobile' => $mobile,
                                'email' => $email,
                            ]);

                            $idsFromForm[] = $newContact->id;
                        }
                    }
                    # DELETE REMOVED CONTACTS

                    $user->contacts()
                        ->whereNotIn('id', $idsFromForm)
                        ->delete();

                    $message = 'Shareholder\'s Account updated successfully.';
                } else {
                    $this->response = ['status' => false, 'message' => 'Shareholder not found.'];
                    return $this->response;
                }
            } else {
                $shareholderData['enabled'] = 1;
                $shareholderData['status'] = 2;
                $shareholderData['type'] = '8';
                $message = 'New shareholder\'s account added successfully.';
                $user = Shareholder::create($shareholderData);
                if ($user) {
                    $shareholder = $this->shareholder->where('id', $user->id)->first();
                    $shareholder->update(['contact_type' => $contactType]);
                    $this->setting->create_account_setting($user);

                    foreach ($persons as $index => $person) {
                        if ($person || $mobiles[$index] || $emails[$index]) {
                            $shareholder->contacts()->create([
                                'name'  => $person,
                                'mobile' => $mobiles[$index] ?? null,
                                'email' => $emails[$index] ?? null,
                            ]);
                        }
                    }
                }
            }

            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function changePassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('shareholder.dashboard.my-account.change-password', compact('user'));
    }

    /**
     * Update password
     * 
     * @param Illuminate\Http\Request $request
     * 
     */
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
        //echo $request->current_password." <> " .$request->password;
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(["status" => false, "message" => 'Your current password is incorrect.']);
        }
        //$user->password = Hash::make($request->new_password);
        //$user->save();
        $data = $request->all();

        $this->mainuser->changeUserPassword($data);
        return response()->json(["status" => true, "message" => 'Your password has been updated successfully!']);
    }
    public function uploadAvatar()
    {
        return view('shareholder.dashboard.my-account.upload-my-avatar');
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
            $defaultImg = asset(config('constants.shareholder_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }

     /**
     * Delete shareholder key contact
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $contact = ShareholderContact::find($id);
        
        if (!$contact) {
            return response()->json([
                'status' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'status' => true,
            'message' => 'Contact deleted successfully'
        ]);
    }
    public function myShareholding()
    {
        return view('shareholder.dashboard.my-account.my-shareholding');
    }

    // Blackbox Tech Pty Ltd

    public function annualReport()
    {
        return view('shareholder.dashboard.blackbox-tech.annual-report');
    }
    public function directors()
    {
        return view('shareholder.dashboard.blackbox-tech.directors');
    }
    public function portfolio()
    {
        return view('shareholder.dashboard.blackbox-tech.portfolio');
    }
    public function contactUs()
    {
        return view('shareholder.dashboard.blackbox-tech.contact-us');
    }
    // newsletter

    public function newsletter()
    {
        return view('shareholder.dashboard.communications.newsletter');
    }
    public function shareholderNotices()
    {
        return view('shareholder.dashboard.communications.shareholder-notices');
    }



    // newsletter

    public function registrations()
    {
        return view('shareholder.dashboard.e4u-information.registrations');
    }
    public function revenue()
    {
        return view('shareholder.dashboard.e4u-information.revenue');
    }


    // newsletter

    public function escortListing()
    {
        return view('shareholder.dashboard.global-monitoring.escort-listings');
    }
    public function massageListing()
    {
        return view('shareholder.dashboard.global-monitoring.massage-centre-listings');
    }
    public function pinUplisting()
    {
        return view('shareholder.dashboard.global-monitoring.pin-up-listing');
    }

    // Shareholder Documents


    public function annualProfitloss()
    {
        return view('shareholder.dashboard.shareholder-documents.annual-profit-and-loss');
    }
    public function balanceSheet()
    {
        return view('shareholder.dashboard.shareholder-documents.balance-sheet');
    }
    public function constitution()
    {
        return view('shareholder.dashboard.shareholder-documents.constitution');
    }
    public function shareholderMinutes()
    {
        return view('shareholder.dashboard.shareholder-documents.shareholder-minutes');
    }
    public function shareholderUpdates()
    {
        return view('shareholder.dashboard.shareholder-documents.shareholder-updates');
    }
    public function financials()
    {
        return view('shareholder.dashboard.blackbox-tech.financials');
    }


    // Share Register

    public function overview()
    {
        return view('shareholder.dashboard.share-register.overview');
    }
    public function shareholders()
    {
        return view('shareholder.dashboard.share-register.shareholders');
    }
    public function shareValue()
    {
        return view('shareholder.dashboard.share-register.share-value');
    }



    // support

    public function escortStatistics()
    {
        return view('shareholder.dashboard.statistics.escort-statistics');
    }
    public function massageStatistics()
    {
        return view('shareholder.dashboard.statistics.massage-centre-statistics');
    }


    // Subsidiaries

    public function overviewPortfolio()
    {
        return view('shareholder.dashboard.subsidiaries.overview-and-portfolio');
    }
    public function subAnnualProfitloss()
    {
        return view('shareholder.dashboard.subsidiaries.annual-profit-and-loss');
    }
    public function subBalancesheet()
    {
        return view('shareholder.dashboard.subsidiaries.balance-sheet');
    }


    // support

    public function submit()
    {
        return view('shareholder.dashboard.support-tickets.submit');
    }
    public function viewReply()
    {
        return view('shareholder.dashboard.support-tickets.view-and-reply');
    }
}
