<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\AttemptLogin;

class ImpersonateController extends Controller
{
    protected $availability;
    protected $service;
    protected $user;
    protected $attemptlogin;
    protected $account;

    public function __construct()
    {
       //
     
    }

    /**
     * Back from child to parent account
     */
    public function backToParent()
    { 
        try {
            if (!session()->has('parent_user_id')) {
                //abort(403, 'No parent session found');
                return redirect()->back()->with('error', 'No parent session found.');
            }

            $parentUser = User::find(session('parent_user_id'));

            if (!$parentUser) {
                Auth::logout();
                session()->flush();
                return redirect('/admin-login');
            }
            Auth::logout();
            Auth::login($parentUser);

            session()->forget([
                'parent_user_id',
                'is_impersonated',
                'switch_for',
            ]);

            return redirect('/admin-dashboard/dashboard')->with('success', 'Successfully switched back to your account.');
        } catch (Exception $e) {
            // abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while backt to the your account.');
        }
    }

    /**
     * Switch from Admin to other account
     */
    public function switchLogin($id)
    {
        try {
            $loggedInUser = Auth::user();

            if ($loggedInUser->is_child == 1) {
                return redirect()->back()->with('error', 'Child account cannot switch users.');
            }

            $user = User::where('id', $id)->first();

            if (!$user) {

                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            $type = (int)$user->type;
            $notAllowedUserType = [7, 10];
            if(in_array($type, $notAllowedUserType)) {
                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            $dashboardURL = getDashboardUrl($type);
     
            Auth::logout();

            // regenerate csrf token
            request()->session()->regenerateToken();

            // login new user
            Auth::login($user);

            // $this->guard()->user();
            $user->update_last_login($user);

            // regenerate new authenticated session
            request()->session()->regenerate();

            $roleType = $user->role_type;

            if ($roleType == 'Agents') {
                $roleType = "Agent";
            }
            $roleType = str_replace(['-'], ' ', $roleType);

            // store impersonation data AFTER login
            session([
                'parent_user_id' => $loggedInUser->id,
                'switch_for' => 'admin_to_any',
                'is_impersonated' => true
            ]);

            return redirect('/'.$dashboardURL)->with('success', "Successfully switched to the " . $roleType . " account.");

        } catch (Exception $e) {
            abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while switching account.');
        }
    }

    public function getUserIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP from shared internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passed from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            // Sometimes multiple IPs are returned, get the first one
            $ip = explode(',', $ip)[0];
        } else {
            // Remote IP
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function getBrowser()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Unknown Browser";

        if (preg_match('/MSIE (\\d+\\.\\d+)/i', $userAgent, $matches)) {
            $browser = "Internet Explorer";
        } elseif (preg_match('/Trident.*rv:(\\d+\\.\\d+)/i', $userAgent, $matches)) {
            $browser = "Internet Explorer";
        } elseif (preg_match('/Edg\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Microsoft Edge";
        } elseif (preg_match('/OPR\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Opera";
        } elseif (preg_match('/Chrome\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Google Chrome";
        } elseif (preg_match('/Safari\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Apple Safari";
        } elseif (preg_match('/Firefox\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Mozilla Firefox";
        }

        return $browser;
    }


}
