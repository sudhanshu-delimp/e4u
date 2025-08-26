<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Playmate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MyPlaymatesContoller extends Controller
{
    public function index()
    {

        if(!Auth::user()){
            return redirect()->route('advertiser.login');
        }
        
        $playmates = Auth::user()
            ->playmates()
            ->with('user','user.state')
            ->get()
            ->groupBy('user_id');

            $usersWithPlaymates = $playmates->map(function ($group) {
                return [
                    'user' => $group->first()->user, 
                    'playmates' => $group->pluck('id')
                ];
            });

        return view('escort.dashboard.my-playmates',[
            'usersWithPlaymates' => $usersWithPlaymates]);
    }

    public function dashboardUserPlaymatesListAjax(Request $request)
    {
        if (auth()->user()) {

            $playmates = Auth::user()
            ->playmates()
            ->with('user','user.state') // eager load user relation
            ->get()
            ->groupBy('user_id');

            $usersWithPlaymates = $playmates->map(function ($group) {
                return [
                    'user' => $group->first()->user, // related user
                    'playmates' => $group->pluck('id') // saare playmates of that user
                ];
            });

            $totalPlaymatesCount = $playmates->flatten()->count();

             return DataTables::of($usersWithPlaymates)
                // ->filter(function ($collection) use ($request) {
                //     $search = $request->input('search.value');
                //     if (!empty($search)) {
                //         $collection->filter(function ($item) use ($search) {
                //             return str_contains($item['user']->member_id, $search);
                //         });
                //     }
                // })
                ->addColumn('playmate', function ($row) {

                    $avatar = $row['user']->avatar_img ?? null;
                    $path   = public_path('assets/app/img/' . $avatar);

                    if ($avatar && file_exists($path)) {
                        $img = asset('assets/app/img/' . $avatar);
                    } else {
                        $img = asset('assets/app/img/service-provider/Frame-408.png'); // default image
                    }
                    
                    return '<div class="playmate-avatar">
                        <img
                        src="'. $img .'"
                        class="img-fluid rounded-circle"
                        alt=" ">
                    </div>';
                    //return $row['user'] ? $row->messageViewerLegbox->user_id : '-';
                })
                ->addColumn('current_location', function($row){
                    return $row['user']->state->name ?? '-';
                })
                ->addColumn('member_id', function ($row){
                    return $row['user']->member_id ?? '-';
                })
                ->addColumn('profile', function ($row){
                    return count($row['playmates']) ?? '0';
                })
                ->addColumn('action', function ($row) {
                    $dataMemberIds = $row['user']->member_id ?? '';
                    $dataUserId = $row['user']->id ?? '';
                    $dataEscortIds = json_encode($row['playmates']) ?? '';
                    $dataUserName = $row['user']->name ?? '';

                    $actionButtons = '
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i
                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink" style="">
                                <a class="listPlaymateModal dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-user-name="'.$dataUserName.'" data-member-ids="'.$dataMemberIds.'" data-user-id="'.$dataUserId.'" data-escort-ids="'.$dataEscortIds.'"> <i class="fa fa-list"></i> List</a>
                                <div class="dropdown-divider"></div>
                            <a class="removePlaymateParentClass dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-user-id="'.$dataUserId.'" data-escort-ids="'.$dataEscortIds.'"> <i class="fa fa-trash"></i> Remove</a>
                        </div>
                    </div>';

                    return $actionButtons;
                })

                ->rawColumns(['playmate', 'action'])
                ->with('totalPlaymatesCount', $totalPlaymatesCount)
                ->make(true);
        }

        return view('center.dashboard.Communication.legbox-viewers');
    }

    public function getPlaymatesDataByAjax(Request $request)
    {
        if(!Auth::user()){
            return redirect()->route('advertiser.login');
        }

        
        $escortIds = json_decode($request->escort_ids);
        
        $playmates = Escort::whereIn('id',$escortIds)->select('id','profile_name','name','user_id')->with('user')->get();

        return response([
            'status'=>200,
            'success'=>true,
            'message'=>'Playmates fetched successfully',
            'data'=>$playmates,
        ]);
    }

    public function removePlaymatesByAjax(Request $request)
    {
        if(!Auth::user()){
            return redirect()->route('advertiser.login');
        }

        $playmateIds = json_decode($request->escort_ids);

        $userId = auth()->user()->id;
        $result = Playmate::whereIn('playmate_id',$playmateIds)->where('user_id', $userId)->delete();
        $msg = $result ? 'Playmates deleted successfully' : 'Something went wrong, Please try again';

        return response([
            'status'=>$result ? 200 : 403,
            'success'=>$result ? true :false,
            'message'=> $msg,
            'data'=>$result,
        ]);
    }
}
