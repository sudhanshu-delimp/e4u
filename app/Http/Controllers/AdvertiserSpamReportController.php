<?php

namespace App\Http\Controllers;

use App\Models\ReportEscortProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertiserSpamReportController extends Controller
{
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

            $escort_id = $request->escort_id;
            $viewer_id = Auth::user()->id;

            $res = ReportEscortProfile::where('escort_id', $escort_id)->where( 
                    'viewer_id', $viewer_id)->select('report_desc','report_tag')->first();

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

            $escort_id = $request->escort_id;
            $viewer_id = Auth::user()->id;
            $report_tag = $request->report_tag;
            $report_desc = $request->description;

            $res = ReportEscortProfile::updateOrCreate(
                [
                    'escort_id' => $escort_id,  
                    'viewer_id' => $viewer_id, 
                ],
                [
                    'report_tag'     => $report_tag,  
                    'report_desc'    => $report_desc, 
                    'admin_id'       => null,
                    'report_status'  => 'pending',
                    'action_message' => null,
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
}
