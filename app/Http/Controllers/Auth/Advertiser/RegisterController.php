<?php

namespace App\Http\Controllers\Auth\Advertiser;

use App\Events\EscortRegister;
use App\Events\MassageRegister;
use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;

use App\Models\PasswordSecurity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Repositories\State\StateInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\StoreAdvertiserRegisterRequest;

class RegisterController extends Controller
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
    protected $state;
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, StateInterface $state)
    {
        $this->middleware('guest');
        $this->state = $state;
        $this->user = $user;

    }

    public function index()
    {
        $state = $this->state->allByCountryId();

        return view('auth.advertiser.register',compact('state'));
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

     /**
     * Check if agent_id exists in the users table.
     *
     * @param int $agent_id
     * @return int
     */

    

    protected function getAgentIdIfExist($data){
        if ($data['agent_id']) {
            $agent = User::where('member_id', $data['agent_id'])->where('type', 5)->first();
            return $agent ? $agent->member_id : null;
        }else{
            return null;
        }
    }

    protected function create($data)
    {
        return User::create([
            // 'phone' => (int) $data['phone'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'state_id' => $data['state_id'],
            'type' => $data['type'],
            'referred_by_agent_id' => $this->getAgentIdIfExist($data),
            'password' => Hash::make($data['password']),
            'enabled' => 1,
            'viewer_contact_type' => ["2"],
            'tour_permissition_type' => ["1","2"],
            'profile_creator' => ["1","2"]
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(StoreAdvertiserRegisterRequest $request)
    {

        $password = $request->password;
        $user = $this->create($request->all());
        $userDataForEvent = [
            'id' => $user->id,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => $request->password,
            'agent_id' => $user->referred_by_agent_id ? $user->referred_by_agent_id : null,
            'location'  => config('escorts.profile.states')[$user->state_id]['stateName'] ?? null,
            'create_at' => date('d-m-Y'),
            'member_id' => $user->member_id,
        ];

        // $userDataForEvent = [
        //     'id'        => 123,
        //     'email'     => 'johndoe@example.com',
        //     'phone'     => '9876543210',
        //     'password'  => 'password',
        //     'agent_id' =>  'A40312',
        //     'location'  => 'Delhi',
        //     'create_at' => '5 April',
        //     'member_id' => 'E100324'
        // ];
    

        //3 is Escote and 4 is Massage Center
        if($request->type == 3){
            event(new EscortRegister((object)$userDataForEvent));
        }elseif($request->type == 4){
            event(new MassageRegister((object)$userDataForEvent));
        }
       

        if($user) {
            $error = 1;
            $phone = $user->phone;
            $pwd = $user->password;
            $otp = $this->user->generateOTP();
            $user->otp = $otp;
            $user->member_id = $user->memberId;
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
            return response()->json(compact('error','phone'));
        } else {
            $error = 0;
            return response()->json(compact('error'));
        }


    }
    
    // public function register(StoreAdvertiserRegisterRequest $request)
    // {
    //     dd($request->all());

    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     if ($response = $this->registered($request, $user)) {
    //         return $response;
    //     }

    //     return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    // }


    public function generateAllUsersMemberId()
    {
        try {
            $usersWithoutMemberId = User::whereNull('member_id')
                ->orWhere('member_id', '')
                ->get();

            foreach ($usersWithoutMemberId as $user) {
                $memberId = $user->generateMemberId();
                if ($memberId) {
                    $user->member_id = $memberId;
                    $user->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'All missing member_ids generated and saved.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
