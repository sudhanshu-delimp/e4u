<?php

namespace App\Http\Controllers\Escort;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
            $escortId = $request->escortId;
            $user = auth()->user();
            $escortProfile = Escort::find($escortId);
            $searchValue = !empty($request->searchValue)?$request->searchValue:false;
            if($searchValue){
                $accountUserId = $user->id;
                $userIds = User::where(['current_state_id'=>$selectedStateId,'member_id'=>$request->searchValue,'available_playmate'=>1])->pluck('id');

                $escorts = Escort::whereIn('user_id', $userIds)
                ->where('state_id', $selectedStateId)
                ->where('user_id', '!=', $accountUserId)
                ->where('enabled',1)
                ->whereNotNull('name')
                ->get();
                

                $playmateIds = $escortProfile->playmates()->pluck('playmate_id')->toArray();

                
                $escorts = $escorts->reject(function ($escort) use ($playmateIds) {
                    return in_array($escort->id, $playmateIds);
                });
            }
            else{
                //$userIds = User::where(['current_state_id'=>$selectedStateId,'available_playmate'=>1])->pluck('id');
                $escorts = $escortProfile->playmates()->get();
                $escorts->map(function($escort) {
                    $escort->is_playmate = true;
                    return $escort;
                });
            }

            

            $response['success'] = true;
            $response['escorts'] = $escorts;
            
            $response['playmates_container_html'] = view('escort.dashboard.profile.partials.playmates_container',compact('searchValue','escorts'))->render();

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}