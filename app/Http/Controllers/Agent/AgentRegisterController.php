<?php

namespace App\Http\Controllers\Agent;

use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use App\Events\AgentRegistered;
use App\Models\PasswordSecurity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Repositories\State\StateInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\StoreAgentRegisterRequest;



class AgentRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    protected $state;
    protected $user;
    public function __construct(User $user, StateInterface $state)
    {
        $this->middleware('guest');
        $this->state = $state;
        $this->user = $user;
        
    }

    public function index()
    {
        $state = $this->state->allByCountryId();
        return view('agent.register',compact('state'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return \Illuminate\Contracts\Validation\Validator
      */

    protected function create($data)
    {
        return User::create([
            'business_name' => $data['name'],
            'state_id' => $data['state_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
            'enabled' => 1,
            'status' => 2
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function register(StoreAgentRegisterRequest $request)
    {
            $user = $this->create($request->all());
            $userDataForEvent = [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $request->email,
                'location' => config('escorts.profile.states')[$user->state_id]['stateName'] ?? null,
                'agent_id'  => $user->member_id,
                'create_at' => date('d-m-Y'),
            ];
        
            event(new AgentRegistered($userDataForEvent));

            if($user) {
                $error = 1;
                $phone = $user->phone;
                $status = $user->status;
                $otp = $this->user->generateOTP();
                $user->otp = $otp;
                $user->save();
                PasswordSecurity::create([
                    'user_id' => $user->id,
                    'password_expiry_days' =>30,
                    //'status' =>1,
                    'password_updated_at' => Carbon::now(),
                ]);
                $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";

                $sendotp = new SendSms();
                $output = $sendotp->send($phone,$msg);
                //TODO:: don't send otp in the response, remove from bellow compact function
                return response()->json(compact('error','phone','status'));
            } else {
                $error = 0;
                return response()->json(compact('error'));
            }

    }
   


    // public function register(StoreAgentRegisterRequest $request)
    // {
    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     if ($response = $this->registered($request, $user)) {
    //         return $response;
    //     }

    //     return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    // }
}
