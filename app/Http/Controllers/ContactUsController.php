<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\sendContactUsRequest;
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
            $input = $request->all();
            $body = [
                'subject' => 'Contact us request',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'message' => $request->message,
            ];

            $mailResp = Mail::to($request->email)->queue(new sendContactUsRequest($body));

            if (isset($mailResp)) {
                return response()->redirectTo('/contact-us')->with('success', __('Your contact us message sent successfully.'));
            } else {
                return response()->redirectTo('/contact-us')->with('error', __('Your contact us message failed to send. Please try later..'));
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . ', line: ' . $e->getLine();
            return response()->redirectTo('/contact-us')->with('error',  'Your contact us message failed to send. Please try later..');
        }
    }
}
