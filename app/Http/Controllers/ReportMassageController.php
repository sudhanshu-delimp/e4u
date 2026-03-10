<?php

namespace App\Http\Controllers;

use App\Models\AttemptLogin;
use App\Models\MassageLike;
use App\Models\MassageProfile;
use App\Models\ReportEscortProfile;
use App\Models\ReportMassageProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportMassageController extends Controller
{

   protected $model_massage_profile;
    public function __construct()
    {
        $this->model_massage_profile = new MassageProfile;

    }


    public function getSpamReportForAdvertiser(Request $request)
    {
        
        if(!(Auth::user() && Auth::user()->type == 0)){
            $data = array(
                'status'=>404,
                'success'=>false,
                'message'=>'User not found!',
                'error'=>true,
                'data'=>collect()
            );
        }else{

            $massage_id = $request->massage_id;
            $viewer_id = Auth::user()->id;


             $res = ReportEscortProfile::where('advertiser_id', $massage_id)
                            ->where('advertiser_type', 'massage')
                            ->where('viewer_id', $viewer_id)
                            ->select('report_desc','report_tag')->first();


            $data = array(
                'status'=>200,
                'success'=>true,
                'message'=>'Advertiser report has been retrieved successfully.',
                'error'=>false,
                'data'=>$res
            );

        }

        return response()->json($data);
    }

    public function saveSpamReportForAdvertiser(Request $request)
    {
        if(!(Auth::user() && Auth::user()->type == 0)){
            $data = array(
                'status'=>404,
                'success'=>false,
                'message'=>'User not found!',
                'error'=>true,
                'data'=>[]
            );
        }else{

            $massage_id = $request->massage_id;
            $viewer_id = Auth::user()->id;
            $report_tag = $request->report_tag;
            $report_desc = $request->description;

           

            $res = ReportEscortProfile::updateOrCreate(
                [
                    'advertiser_id'   => $massage_id,
                    'viewer_id'       => $viewer_id,
                    'advertiser_type' => 'massage',
                ],
                [
                    'report_tag'      => $report_tag,
                    'report_desc'     => $report_desc,
                    'admin_id'        => null,
                    'report_status'   => 'pending',
                    'action_message'  => null,
                ]
            );

            $data = array(
                'status'=>200,
                'success'=>true,
                'message'=>'Advertiser report has been save successfully.',
                'error'=>false,
                'data'=>$res
            );

        }

        return response()->json($data);
    }


    public function massageLikeDislike(Request $request)
    {
        
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $ipAddress = AttemptLogin::Where('user_id', $userId)->first();

        if($ipAddress == null){
           $ipAddress = $this->model_massage_profile->getClientIP();
        }else{
            $ipAddress = $ipAddress->ip_address; 
        }
       
        $massage_id = $request->massage_id;
        $like = $request->vote;
        //request()->post('userId');
        $votingData = [
            'user_id' => $userId,
            'massage_id' => $massage_id,
            'like' => $like,
            'ip_address' => $ipAddress,
        ];

        $todayVote = $this->model_massage_profile->getUserLikeDislike($massage_id, $ipAddress, $userId);
       
        $error = 0;
        if($todayVote) {
            $todayVote->like = $like;
            if(!$todayVote->save()) {
                $error = 1;
            }
        } else {
            $votingData = MassageLike::create($votingData);
            if(!$votingData) {
                $error = 1;
            }
        }

        # add stats after like
        $massageUser = MassageProfile::where('id', $massage_id)->first();
        if($massageUser != null) {
            saving_escort_stats($massageUser->user_id, $massage_id, 'recommendation_count');
        }   
        
        $total = MassageLike::where('massage_id', $massage_id)->count();
        if($total > 0) {
            $likeCount = MassageLike::where('like',1)->where('massage_id',$massage_id)->count();
            $dislikeCount = MassageLike::where('like',0)->where('massage_id',$massage_id)->count();
            $lp = round($likeCount/$total * 100);
            $dp = round($dislikeCount/$total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }

        return response()->json(compact('error','lp','dp', 'like'));
    }
}
