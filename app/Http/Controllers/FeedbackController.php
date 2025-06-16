<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Mail\SendFeedbackRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Exception;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request, $id = null)
    {
        $feedbackSubjects = config('common.feedback_subject');
        $input = [];
        $optionId = null;
        $optionText = "";
         $userId = null;
         if (Auth::user()) {
                $user =  Auth::user();
                $userId =  $user->id;
            }
        if (isset($request->option_id) &&  (int)$request->option_id > 0) {
            $optionId = $request->option_id;
            $optionData = Option::where('id', $optionId)->first();
            if($optionData) {
                $optionText = $optionData->name;
            }
        } else if (isset($request->option_text) && $request->option_text != "") {
            $optionText = trim($request->option_text);
            $option = Option::where('name', $optionText)->first();
            $data =  [
                'subject_id' => $request->subject_id,
                'name' => $optionText,
            ];
            $optionId = Option::create($data)->id;
        }
        $input = [
            'user_id' => $userId,
            'subject_id' => $request->subject_id,
            'option_id' => $optionId,
            'comment' => $request->comment,
            'email' => $request->email,
        ];

        $error = false;
        if (!empty($input)) {
            $data = Feedback::create($input);
            $error = false;
            $subjectName = isset($feedbackSubjects[$request->subject_id]) ? $feedbackSubjects[$request->subject_id] : "";
            $body = [
                'subject' => 'Feedback Request',
                'subject_name' => $subjectName,
                'option' =>  $optionText,
                'email' => $request->email,
                'comment' => $request->comment,
            ];
            if ($data && !empty($subjectName)) {
                $mailResp = Mail::to(config('common.contactus_admin_email'))->queue(new SendFeedbackRequest($body));
            } else {
                $error = true;
            }
        }
        return response()->json(compact('data', 'error'));
        // return ! $id ? Option::create($data) : Option::update($id, $input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function showOption(Request $request)
    {
        $result = Option::where('subject_id', $request->subject_id)->get();
        $error = true;
        if ($result->count() > 0) {
            $error = false;
            $data['result'] = [];
        }
        $data['result'] = $result;
        $data['error'] = $error;
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
