<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Review\ReviewInterface;


class MessageReviewController extends Controller
{
    protected $escort;
    protected $reviews;
    protected $message;

    public function __construct(EscortInterface $escort, ReviewInterface $reviews, MessageInterface $message)
    {
        $this->escort = $escort;
        $this->reviews = $reviews;
        $this->message = $message;

    }

    public function saveMessage(Request $request, $escort_id)
    {
        //dd($request->all());
        $data = [
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'escort_id' => $escort_id,
        ];
        $id = null;
        $error = true;
        if($this->message->store($data, $id))
        {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }
    public function SaveReviewAdvertiser(Request $request, $escort_id)
    {
        $error = true;
        if(auth()->user() && auth()->user()->type == 0) {
            $data = [
                'description' => $request->description,
                'star_rating' => $request->rating ? $request->rating : NULL,
                'user_id' => auth()->user()->id,
                'escort_id' => $escort_id,
            ];
            $id = null;
            if($this->reviews->store($data, $id))
            {
                $error = false;
            }
        } else {
            $data = 'You are not allowed to give review';
        }
        return response()->json(compact('data','error'));
    }
}
