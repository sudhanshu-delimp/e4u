<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Visitor;
use Illuminate\Support\Str;
use App\Models\AttemptLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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

        $path = $request->path();

        if (Str::contains($path, 'get-notification') || Str::contains($path, 'get-geolocation-data') || Str::contains($path, 'state-name') || Str::contains($path, 'web.state.name') ) {
            return $next($request);
        }

        if ($request->ajax() || $request->isMethod('post')) {
            return $next($request);
        }
        
        if(auth()->user() != null) 
        {

            # if user is suspended or blocked then logout the console
            if (auth()->user()->status == 'Blocked' || auth()->user()->status == 4) {
                auth()->logout();

                return redirect()->route('/')
                    ->withErrors(['message' => 'You have been logged out due to suspended by admin.']);
            }

            $lastActivity = AttemptLogin::where('user_id', auth()->user()->id)
            // ->where('email', '!=', 'admin@e4u.com.au')
            ->value('updated_at');


            
            # logout user if their idle time is more than their preference time
            if(auth()->user()->type == 5)
            {

                $idle_preference_time = (auth()->user()->agent_settings && auth()->user()->agent_settings->idle_preference_time) ? auth()->user()->agent_settings->idle_preference_time : '60';

                if ($lastActivity && now()->diffInMinutes($lastActivity) > (int) $idle_preference_time) {
                auth()->logout();
                return redirect()->route('agent.login')
                    ->withErrors(['message' => 'You have been logged out due to inactivity.']);
                } 
            }
            elseif(auth()->user()->type == 4)
            {

                $idle_preference_time = (auth()->user()->massage_settings && auth()->user()->massage_settings->idle_preference_time) ? auth()->user()->massage_settings->idle_preference_time : '60';

                if ($lastActivity && now()->diffInMinutes($lastActivity) > (int) $idle_preference_time) {
                auth()->logout();
                return redirect()->route('advertiser.login')
                    ->withErrors(['message' => 'You have been logged out due to inactivity.']);
                } 
            }

            elseif(auth()->user()->type == 3)
            {

                $idle_preference_time = (auth()->user()->escort_settings && auth()->user()->escort_settings->idle_preference_time) ? auth()->user()->escort_settings->idle_preference_time : '60';

                if ($lastActivity && now()->diffInMinutes($lastActivity) > (int) $idle_preference_time) {
                auth()->logout();
                return redirect()->route('advertiser.login')
                    ->withErrors(['message' => 'You have been logged out due to inactivity.']);
                } 
            }

            elseif(auth()->user()->type == 0)
            {

                $idle_preference_time = (auth()->user()->viewer_settings && auth()->user()->viewer_settings->idle_preference_time) ? auth()->user()->viewer_settings->idle_preference_time : '60';
                if ($lastActivity && now()->diffInMinutes($lastActivity) > (int) $idle_preference_time) {
                auth()->logout();
                return redirect()->route('viewer.login')
                    ->withErrors(['message' => 'You have been logged out due to inactivity.']);
                } 
            }
             elseif(auth()->user()->type == 1)
            {
                if(auth()->user()->staff_setting && auth()->user()->staff_setting->idle_preference_time!==null)
                {
                    $idle_preference_time =  (auth()->user()->staff_setting && auth()->user()->staff_setting->idle_preference_time) ? auth()->user()->staff_setting->idle_preference_time : '60';
                    
                    if ($lastActivity && now()->diffInMinutes($lastActivity) > (int) $idle_preference_time) {
                         auth()->logout();
                        return redirect()->route('admin.login')->withErrors(['message' => 'You have been logged out due to inactivity.']);
                        
                    } 
                }
                
            }


            // # logout user if their idle time is more than their preference time
            // if ($lastActivity && now()->diffInMinutes($lastActivity) > (int)auth()->user()->idle_preference_time) {
            //     auth()->logout();

            //     return redirect()->route('/')
            //         ->withErrors(['message' => 'You have been logged out due to inactivity.']);
            // }

            # Update activity timestamp
            AttemptLogin::where('user_id', auth()->user()->id)
            ->update(['updated_at' => now()]);


            $attempt = AttemptLogin::where('user_id', auth()->user()->id)
                ->latest()
                ->first();

            $state = auth()->user()->state_id;
            $cityId = null;
            $countryId = null;

            if($state != null){
                $city = City::where('state_id',$state)->first();
                $cityId = $city->id;
                $countryId = $city->country_id;
            }

            # Update visitor guest user to logged user
            Visitor::where('ip_address',$this->getUserIp())->update([
                'user_id' => auth()->user()->id,
                'user_type' => 'user',
            ]);

            // update auth user
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
        }else{
            $visitor = Visitor::where('ip_address',$this->getUserIp())->first();
            
            if($visitor != null){
                # update visitor activity
                Visitor::where('ip_address',$this->getUserIp())->update([
                    'page' => $path, // e.g. "dashboard/advertiser"
                    'device' => $this->getBrowser(),
                    'platform' => $this->getBrowser(),
                    'country' => $this->getVisitorCountry()[0],
                    'city' => null,
                    'state' => $this->getVisitorCountry()[1],
                    'user_type' => 'guest',
                    'user_id' => null,
                    'idle' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s a'),
                    'origin' => $this->getVisitorCountry()[0],
                    'date' => now(config('app.escort_server_timezone')),
                ]);
            }else{
                # create visitor activity
                Visitor::create([
                    'page' => $path, // e.g. "dashboard/advertiser"
                    'ip_address' => $this->getUserIp(),
                    'device' => $this->getBrowser(),
                    'platform' => $this->getBrowser(),
                    'country' => $this->getVisitorCountry()[0],
                    'city' => null,
                    'state' => $this->getVisitorCountry()[1],
                    'user_type' => 'guest',
                    'user_id' => null,
                    'landed' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s a'),
                    'idle' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s a'),
                    'origin' => $this->getVisitorCountry()[0],
                    'date' => now(config('app.escort_server_timezone')),
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

    public function getVisitorCountry() 
    {
        $ip = $this->getUserIp();

        // Check if IP and Country are already stored in session
        if (Session::has('visitor_ip') && Session::get('visitor_ip') === $ip && Session::has('visitor_country')) {
            return [Session::get('visitor_country'),Session::get('visitor_state')];
        }

        // If not in session, fetch from API
        $response = Http::get("http://ip-api.com/json/{$ip}");
        $data = $response->json();

        $visitorState = null;
        $visitorCountry = null;
        if ($data && isset($data['status']) && $data['status'] === 'success') {
            $visitorCountry = $data['country'];
            $visitorState   = $data['regionName'];

            // Store in session for later use
            Session::put('visitor_ip', $ip);
            Session::put('visitor_country', $visitorCountry);
            Session::put('visitor_state', $visitorState);
        }

        return [$visitorCountry, $visitorState];
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
