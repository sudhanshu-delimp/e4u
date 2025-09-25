<?php

namespace App\Http\Middleware;

use App\Models\AttemptLogin;
use App\Models\City;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrackLastPageVisitMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('logout') || Str::contains($request->path(), 'logout')) {
            return $next($request);
        }
        
        if(auth()->user() != null) {

            # if user is suspended or blocked then logout the console
            if (auth()->user()->status == 'Suspended' || auth()->user()->status == 3 || auth()->user()->status == 'Blocked' || auth()->user()->status == 4) {
                auth()->logout();

                return redirect()->route('/')
                    ->withErrors(['message' => 'You have been logged out due to suspended by admin.']);
            }

             $lastActivity = AttemptLogin::where('user_id', auth()->user()->id)
            ->value('updated_at');

            # logout user if their idle time is more than their preference time
            if ($lastActivity && now()->diffInMinutes($lastActivity) > (int)auth()->user()->idle_preference_time) {
                auth()->logout();

                return redirect()->route('/')
                    ->withErrors(['message' => 'You have been logged out due to inactivity.']);
            }

            # Update activity timestamp
            AttemptLogin::where('user_id', auth()->user()->id)
            ->update(['updated_at' => now()]);


            $attempt = AttemptLogin::where('user_id', auth()->user()->id)
                ->latest()
                ->first();

            $state = auth()->user()->state_id;
            $cityId = null;
            $countryId = null;
            $path = $request->path();

            if (Str::contains($path, 'get-notification') || Str::contains($path, 'get-geolocation-data') || Str::contains($path, 'state-name') || Str::contains($path, 'web.state.name') ) {
                return $next($request);
            }

            if ($request->ajax() || $request->isMethod('post')) {
                return $next($request);
            }

            if($state != null){
                $city = City::where('state_id',$state)->first();
                $cityId = $city->id;
                $countryId = $city->country_id;
            }

            if ($attempt != null) {
                AttemptLogin::where('user_id',auth()->user()->id)->update([
                    'page' => $path, // e.g. "dashboard/advertiser"
                    'online' => 'yes',
                    'email'=> auth()->user()->email,
                    'ip_address' => $this->getUserIp(),
                    'device' => $this->getBrowser(),
                    'country' => $countryId,
                    'city' => $cityId,
                    'type' => 1,
                ]);
            } else {
                AttemptLogin::create([
                    'user_id' => auth()->user()->id,
                    'online' => 'yes',
                    'email'=> auth()->user()->email,
                    'page'    => $path,
                    'ip_address' => $this->getUserIp(),
                    'device' => $this->getBrowser(),
                    'country' => $countryId,
                    'city' => $cityId,
                    'type' => 1,
                ]);
            }
        }

        return $next($request);
    }

    public function getUserIp() {
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

    public function getBrowser() {
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
