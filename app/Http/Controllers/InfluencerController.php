<?php

namespace App\Http\Controllers;

use App\Mail\Influencer\RequestInfluencerOperationCenterMail;
use App\Mail\Influencer\RequestInfluencerToUserMail;
use App\Models\Influencer;
use App\Models\User;
use Illuminate\Http\Request;
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
            'membership_id' => 'required',
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

        $member = User::where('member_id', $request->member_id)->first();

        if($member == null){
            return response()->json(['status' => false ,'message' => 'The provided Membership ID doesn’t exist, Please check and try again.'], 422);
        }

        $validator['status'] = 'pending';
        $validator['social_media'] = json_encode($request->social_media);
        $validator['ref_number'] = 'REF-' . $member->id . '-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);

        $influencer = Influencer::create($validator);

        $location = config('escorts.profile.states')[$member->state_id];

        $body = [
            'ref_number' => $influencer->ref_number,
            'email' => $request->email,
            'member_id' => $request->membership_id,
            'member_name' => $member->name,
            'subject' => 'Influencer Request',
            'mobile' => $member->mobile,
            'social_media' => $influencer->social_media,
            'location' => $location,
            'comments' => $request->comments,
            'status' => 'pending',
        ];

        // if(isset($request->has('cc_email'))) {
        //     $body['cc_email'] = true;
        // } else {
        //     $body['cc_email'] = false;
        // }

        //$ccEmail = isset($request->has('cc_email'));

        Mail::to(config('escorts.mobileOrderSimRequest.admin'))->queue(new RequestInfluencerOperationCenterMail($body));
        Mail::to($request->email)->queue(new RequestInfluencerToUserMail($body));

        return response()->json(['message' => 'Membership created successfully!']);
    }
}
