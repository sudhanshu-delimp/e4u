<?php

namespace App\Http\Controllers;

use App\Models\ReportMassageProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportMassageController extends Controller
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

            $massage_id = $request->massage_id;
            $viewer_id = Auth::user()->id;

            $res = ReportMassageProfile::where('massage_id', $massage_id)->where( 
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

            $massage_id = $request->massage_id;
            $viewer_id = Auth::user()->id;
            $report_tag = $request->report_tag;
            $report_desc = $request->description;

            $res = ReportMassageProfile::updateOrCreate(
                [
                    'massage_id' => $massage_id,  
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
