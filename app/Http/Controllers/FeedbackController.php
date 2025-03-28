<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

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
        $input = [];
        $input = [
            'subject_id' => $request->subject_id,
            'option_id' => $request->option_id,
            'comment' => $request->comment,
            'email' => $request->email,
        ];
        $error=true;
        if(!empty($input)) {
            $data = Feedback::create($input);
            $error=false;
        }
        return response()->json(compact('data','error'));
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
        $result = Option::where('subject_id',$request->subject_id)->get();

        return response()->json($result);
        
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
