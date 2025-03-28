<?php

namespace App\Http\Controllers;
use App\Mail\sendForgotPassword;
use App\Sms\SendSms;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Auth;
// use Illuminate\Support\Facades\Mail;

class SendForgotPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        //dd($request->all());
        //Check if the user exists
        if (!$user = User::where('email', '=', $request->email)->select('email')->first()) {
            //return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            $error = false;
            $email = "User does not exist";
            return response()->json(compact('error','email'));
        }
    
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
    
        // if ($this->sendResetEmail($request->email, $tokenData->token)) {
        //     return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        // } else {
        //     return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        // }

        $link = $request->url ."/". $tokenData->token;
        // $link = $request->url . 'password/reset/' . $tokenData->token . '?email=' . urlencode($user->email);

        $data = [];
        $data = [
            'email'=>$request->email,
            'url'=>$request->url,
        ];
        $users = User::where('email',$request->email)->first();

        $email = $data['email'];
        $body = [
           'url' => $link,
           'name' => $data['email'],
        ];
 
        $error = true;
        Mail::to($email)->send(new sendForgotPassword($body));
       
        if (Mail::failures()) {
            // return failed mails
            $error = false;
            return new Error(Mail::failures()); 
            
        }
        //dd($error);
        //return back()->with('status','Mail sent successfully');
        return response()->json(compact('error','email'));
        
        
    }
    public function viewerResetPassword(Request $request)
    {
        //dd($request->all());
       //Validate input
        // $validator = Validator::make($request->all(), [
        //     //'email' => 'required|email|exists:users,email',
        //     'password' => 'required|confirmed',
        //     'token' => 'required' ]);

        // //check if payload is valid before moving on
        // if ($validator->fails()) {
        //     dd("validation");
        //     return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        // }

        $password = $request->password;  
        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $request->cusotm_token)->first();
        
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) {  return redirect()->route('viewer.login'); }
        // if (!$tokenData) { dd("tokendata"); return view('auth.passwords.email'); }

        $user = User::where('email', $tokenData->email)->first();
        
        // Redirect the user back if the email is invalid
        if (!$user) { 
            if($user->type == 0) {
               return redirect()->route('viewer.login'); 
            }
            if($user->type == 1) {
               return redirect()->route('admin.login'); 
            }
            if($user->type == 3) {
               return redirect()->route('advertiser.login'); 
            }
            if($user->type == 5) {
               return redirect()->route('agent.login'); 
            }
            
            // return redirect()->back()->withErrors(['email' => 'Email not found']);
        }
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $error = false;
        if($user->update()) {
            $error = true;
        }
        //or $user->save();

        //login the user immediately they change password successfully
        //Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
        ->delete();
        return response()->json(compact('error'));
        //Send Email Reset Success Email
        // if ($this->sendSuccessEmail($tokenData->email)) {
        //     return view('index');
        // } else {
        //     return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        // }


    }
    // private function sendResetEmail($email, $token)
    // {
    // //Retrieve the user from the database
    // $user = User::where('email', $email)->first();
    // //Generate, the password reset link. The token generated is embedded in the link
    // $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

    //     try {
    //     //Here send the link with CURL with an external email API 
    //         return true;
    //     } catch (\Exception $e) {
    //         return false;
    //     }
    // }
    public function sendOtp(Request $request)
    {
        //dd($request->all());
        $phone = $request->phone;
        $msg = $request->msg.":".$this->generateOTP();
        $sendotp = new SendSms();
        $output = $sendotp->send($phone,$msg);
        return response()->json(compact('output')); 
    }
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }

}
