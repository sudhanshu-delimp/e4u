<?php

namespace App\Http\Controllers;

use App\Mail\NotificationPasswordReset;
use Auth;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\sendForgotPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
           'name' => !empty($users->name) ? $users->name : $data['email'],
           'ref'  => $users->id,
           'member_id' => !empty($users->member_id) ? $users->member_id : ''
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
        $password = $request->password;  
        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $request->cusotm_token)->first();

        if (!$tokenData) {
            return response()->json([
                'error'   => false,   // as you want
                'type'    => 'error',
                'title'   => 'Password Reset Link Expired',
                'message' => 'Your password reset link is invalid or has expired. Please request a new one.'
            ], 200);
        }

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) {  return redirect()->route('viewer.login'); }

        $user = User::where('email', $tokenData->email)->first();
       
        // Redirect the user back if the email is invalid
        

        $body = [
           'new_password' => $password,
           'name' => !empty($user->name) ? $user->name : $tokenData->email,
           'ref'  => $user->id,
           'member_id' => !empty($user->member_id) ? $user->member_id : ''
        ];
        
        Mail::to($tokenData->email)->send(new NotificationPasswordReset($body));
        $msg = 'Your request to reset your password has been completed. Your new password is: ' . $password;
        $sendotp = new SendSms();
        $output = $sendotp->send($user->phone, $msg);
        
        //Hash and update the new password
        $user->password = Hash::make($password);
        $error = false;
        $check = $user->save();
        if($check) {
            $error = true;
        }
       
       
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
