<?php

namespace App\Http\Controllers\Escort;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Escort;
use App\Models\PlaymateHistory;
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
                ->whereDoesntHave('activeSuspendProfile')
                ->get();
                

                $playmateIds = $escortProfile->playmates()->pluck('playmate_id')->toArray();

                
                $escorts = $escorts->reject(function ($escort) use ($playmateIds) {
                    return in_array($escort->id, $playmateIds);
                });
            }
            else{
                $escorts = $escortProfile->playmates()->get();
                $veryFirstEscortWithPlaymate = [];
                if($escorts->count()==0){
                    $veryFirstEscortProfileWithPlaymate = $user->listedEscorts()
                    ->join('escort_playmate', 'escorts.id', '=', 'escort_playmate.escort_id')
                    ->orderBy('escort_playmate.created_at', 'asc')
                    ->first()->escort_id;
                    $escortProfile = Escort::find($veryFirstEscortProfileWithPlaymate);
                    $escorts = $escortProfile->playmates()->get();
                }
                else{
                    $escorts->map(function($escort) {
                        $escort->is_playmate = true;
                        return $escort;
                    });
                }
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

    public function storePlaymates(Request $request, $escortId)
    {
        $error = false;
        $escort = Escort::find($escortId);

        if($request->has('add_playmate')){
            $escort->playmates()->syncWithoutDetaching($request->add_playmate);

            foreach($request->add_playmate as $playmateId){
                $this->savePlaymateHistory($escort->id, $playmateId, $escort->user->id);
            }


            foreach ($request->add_playmate as $playmateId) {//add profile to other escort profiles
                $otherEscort = Escort::find($playmateId);
                if ($otherEscort) {
                    $otherEscort->playmates()->syncWithoutDetaching($escort->id);
                    $this->savePlaymateHistory($playmateId, $escort->id, $otherEscort->user->id);
                }
            }
        }
        else{
            $playmateIds = $escort->playmates()->pluck('playmate_id')->toArray();

            $checkedIds = (!empty($request->update_playmate))?$request->update_playmate:[];
            $escort->playmates()->sync($checkedIds);

            if(!empty($checkedIds)){
                foreach($checkedIds as $playmateId){
                    $this->savePlaymateHistory($escort->id, $playmateId, $escort->user->id);
                }
                
                foreach ($request->update_playmate as $playmateId) {//add profile to other escort profiles
                    $otherEscort = Escort::find($playmateId);
                    if ($otherEscort) {
                        $otherEscort->playmates()->syncWithoutDetaching($escort->id);
                        $this->savePlaymateHistory($playmateId, $escort->id, $otherEscort->user->id);
                    }
                }
            }

            $uncheckedIds = array_diff($playmateIds, $checkedIds);
            if(!empty($uncheckedIds)){//remove profile to other escort profiles
                foreach ($uncheckedIds as $playmateId) {
                    $otherEscort = Escort::find($playmateId);
                    if ($otherEscort) {
                        $otherEscort->playmates()->detach($escortId);
                    }
                }
            }
        }

        
        return response()->json(compact('error'));
    }

    protected function savePlaymateHistory($escort_id, $playmate_id, $user_id){
        PlaymateHistory::updateOrInsert(
            [
                'escort_id' => $escort_id,
                'playmate_id' => $playmate_id,
            ],
            [
                'user_id' => $user_id,
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}