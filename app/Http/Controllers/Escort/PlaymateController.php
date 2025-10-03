<?php

namespace App\Http\Controllers\Escort;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Escort;
use App\Repositories\User\UserInterface;
use App\Repositories\Escort\EscortInterface;

class PlaymateController extends Controller
{
    protected $escort;
    protected $user;
    public function __construct(EscortInterface $escort, UserInterface $user)
    {
        $this->escort = $escort;
        $this->user = $user;
    }

    public function getAvailablePlaymates(Request $request){
        try {
            $response['success'] = false;
            $selectedStateId = $request->input('stateId');
            $accountUserId = auth()->user()->id;
            $userIds = User::where('current_state_id', $selectedStateId)->pluck('id');
            $escorts = Escort::whereIn('user_id', $userIds)
            ->where('state_id', $selectedStateId)
            ->where('user_id', '!=', $accountUserId)
            ->where('enabled',1)
            ->whereNotNull('name')
            ->get();

            $response['success'] = true;
            $response['playmates_container_html'] = view('escort.dashboard.profile.partials.playmates_container',compact('escorts'))->render();

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}