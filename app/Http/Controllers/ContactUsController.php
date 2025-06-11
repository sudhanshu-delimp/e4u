<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\SendContactUsRequest;
use App\Mail\SendContactusConfirmation;
use App\Models\Contactus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactUsController extends AppController
{
    /**
     * Contact us page
     */
    public function index()
    {
        return view("web.pages.contact-us");
    }

    /**
     * Validate contactus form data and send the request to admin's email
     */
    public function sendContact(Request $request)
    {
        $rules = [
            'first_name' => 'bail|required|string|max:100',
            'last_name' => 'bail|required|string|max:100',
            'email' => 'required|email:rfc,filter|max:100',
            'message' => 'bail|required|string|max:5000'
        ];
        $attributes = request()->validate($rules);
        try {
            $contactObj = (new Contactus);
            $input = $request->all();
            $userId = null;
            $userType = null;
            $roleType = "Visitor";
            $email  = $request->email;
            if (Auth::user()) {
                $user =  Auth::user();
                $userId =  $user->id;
                $userType =  $user->type;
                $roleType =  $user->role_type;
            }

            $refNumber = random_string();
            $body = [
                'subject' => 'Contact Us Request',
                'ref_number' => $refNumber,
                'user_id' => $userId,
                'user_type' => $userType,
                'role_type' => $roleType,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $email,
                'message' => $request->message,
            ];

            $contactObj->ref_number = $refNumber;
            $contactObj->user_id = $userId;
            $contactObj->user_type = $userType;
            $contactObj->first_name = $request->first_name;
            $contactObj->last_name = $request->last_name;
            $contactObj->email = $email;
            $contactObj->comments = $request->message;
            if ($contactObj->save()) {
                $mailResp = Mail::to(config('common.contactus_admin_email'))->queue(new SendContactUsRequest($body));
                $body['subject'] = 'Contact Us Confirmation';
                $mailResp2 = Mail::to($email)->queue(new SendContactusConfirmation($body));
                return response()->redirectTo('/contact-us')->with('success', __('Your Contact us request has been successfully sent. '));
            } else {
                return response()->redirectTo('/contact-us')->with('error', __('Your contact us request failed to send. Please try later..'));
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . ', line: ' . $e->getLine();
            return response()->redirectTo('/contact-us')->with('error',  'Your contact us request failed to send. Please try later..');
        }
    }
}
