<?php

namespace App\Http\Controllers;

use App\Mail\Influencer\RequestInfluencerOperationCenterMail;
use App\Mail\Influencer\RequestInfluencerToUserMail;
use App\Models\Influencer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InfluencerController extends Controller
{
    public function becomeInfluencer(Request $request)
    {
        return view('web.influencer');
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'email' => 'required|email',
            'social_media' => 'required',
            'comments' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $memberId = $request->member_id ?? '';

        $member = User::where('member_id', $memberId)->first();

        if($member == null){
            return response()->json(['status' => false , 'type'=>'not_found','message' => 'The provided Membership ID doesn’t exist, Please check and try again.'], 200);
        }

        $social_media = json_encode($request->social_media);
        $ref_number = 'REF-' . $member->id . '-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);

        $influencerExist = Influencer::where('member_id', $memberId)->first();
        
        if($influencerExist != null){
            return response()->json(['status' => false, 'type'=>'found','message' => 'You have already submitted an influencer request.'], 200);
        }

        $influencer = Influencer::create([
            'member_id' => $request->member_id,
            'email' => $request->email,
            'social_media' => $social_media,
            'comments' => $request->comments,
            'status' => 'pending',
            'ref_number' => $ref_number,
        ]);

        $location = config('escorts.profile.states')[$member->state_id];

        $body = [
            'ref_number' => $influencer->ref_number,
            'email' => $member->email ? $member->email : $request->email,
            'member_id' => $request->member_id,
            'member_name' => $member->name,
            'subject' => 'Influencer Request',
            'mobile' => $member->phone ?? 'N/A',
            'social_media' => implode(', ',json_decode($influencer->social_media)),
            'location' => $location['stateName'] ?? 'N/A',
            'comments' => $request->comments,
            'status' => 'pending',
            'cc_email' => $request->has('cc_email') ? true : false,
        ];

        try {
            if($request->has('cc_email')  && $request->cc_email == 'on'){
                 // Test email sending
                Mail::to(config('escorts.mobileOrderSimRequest.admin'))->queue(new RequestInfluencerOperationCenterMail($body));
                sleep(10);
                Mail::to([$member->email, $request->email])->queue(new RequestInfluencerToUserMail($body));
            }else{
                Mail::to($member->email)->queue(new RequestInfluencerToUserMail($body));
            }
           
        } catch (\Exception $e) {
            Log::info('Influencer Email sending failed: ' . $e->getMessage());
        }
        

        return response()->json(['status' => true ,'message' => 'Influencer request sent successfully.'], 200);
    }
}
