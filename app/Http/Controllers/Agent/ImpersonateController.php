<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\AttemptLogin;
use App\Models\City;

class ImpersonateController extends Controller
{
    protected $availability;
    protected $service;
    protected $user;
    protected $attemptlogin;
    protected $account;

    public function __construct(AttemptLoginRepository $attemptlogin, UserInterface $user, AvailabilityInterface $availability, ServiceInterface $service)
    {
        $this->availability = $availability;
        $this->service = $service;
        $this->user = $user;
        $this->attemptlogin = $attemptlogin;
    }

    /**
     * Back from child to parent account
     */
    public function backToParent()
    {
        try {
            if (!session()->has('parent_agent_id')) {
                //abort(403, 'No parent session found');
                return redirect()->back()->with('error', 'No parent session found.');
            }

            $parentUser = User::find(session('parent_agent_id'));

            if (!$parentUser) {
                Auth::logout();
                session()->flush();
                return redirect('/agent-login');
            }
            Auth::logout();
            Auth::login($parentUser);

            session()->forget([
                'parent_agent_id',
                'is_impersonated',
                'switch_for',
            ]);

            return redirect('/agent-dashboard')->with('success', 'Successfully back to the agent account');
        } catch (Exception $e) {
            // abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while backt to the agent account.');
        }
    }

    /**
     * Switch from Agent to Escort or Massage Center account
     */
    public function switchLogin($id)
    {
        try {
            $loggedInUser = Auth::user();

            if ($loggedInUser->is_child == 1) {
                abort(403, 'Child account cannot switch users');
            }

            if ($loggedInUser->type != 5) {
                //abort(403, 'Unauthorized');
                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            $childUser = User::where('id', $id)
                ->where('assigned_agent_id', $loggedInUser->id)
                //->where('is_child', 1)
                ->first();

            if (!$childUser) {
                abort(404, 'Child account not found');
                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            Auth::logout();

            // invalidate old session
            //request()->session()->invalidate();

            // regenerate csrf token
            request()->session()->regenerateToken();

            // login new user
            Auth::login($childUser);

           // $this->guard()->user();
            $childUser->update_last_login($childUser);

             // regenerate new authenticated session
            request()->session()->regenerate();


            $state = $childUser->state_id;
            $cityId = null;
            $countryId = null;

            if ($state != null) {
                $city = City::where('state_id', $state)->first();
                $cityId = $city->id;
                $countryId = $city->country_id;
            }

            /*$attempt = AttemptLogin::where('user_id', $childUser->id)
                ->latest()
                ->first();

            // update auth user
            if ($attempt != null) {
                AttemptLogin::where('user_id', $childUser->id)->update([
                    'page' => ($childUser->type == 3) ? '/escort-dashboard' : '/center-dashboard',
                    'online' => 'yes',
                    'email' => $childUser->email,
                    'ip_address' => $this->getUserIp(),
                    'device' => $this->getBrowser(),
                    'country' => $countryId,
                    'city' => $cityId,
                    'type' => 1,
                ]);
            } else {
                AttemptLogin::create([
                    'user_id' => $childUser->id,
                    'online' => 'yes',
                    'email' => $childUser->email,
                    'page'    => ($childUser->type == 3) ? '/escort-dashboard' : '/center-dashboard',
                    'ip_address' => $this->getUserIp(),
                    'device' => $this->getBrowser(),
                    'country' => $countryId,
                    'city' => $cityId,
                    'type' => 1,
                ]);
            } */

            // store impersonation data AFTER login
            session([
                'parent_agent_id' => $loggedInUser->id,
                'switch_for' => 'agent_to_massage',
                'is_impersonated' => true
            ]);


            if (($childUser->type == 3)) {
                return redirect('/escort-dashboard')->with('success', "Successfully switch to the escort account");
            } else {
                return redirect('/center-dashboard')->with('success', "Successfully switch to the massage center account");
            }
        } catch (Exception $e) {
            abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while switching accounts.');
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
