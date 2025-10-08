<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CenterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CenterNotificationController extends Controller
{
    public function index(){
          return view('admin.notifications.centres.index');
    }

    public function store(Request $request){
        $data =  $request->only(['heading','start_date', 'finish_date', 'type', 'content', 'member_id']);
        $start = Carbon::parse($data['start_date']);
        $end =  Carbon::parse($data['finish_date']);
        //Check condition 
        $query = CenterNotification::where(function($q) use ($start, $end){
                $q->whereBetween('start_date', [$start, $end])
                ->orWhereBetween('finish_date', [$start, $end])
                ->orWhere(function($q2) use ($start, $end){
                    $q2->where('start_date', '<=', $start)
                        ->where('finish_date', '>=', $end);
                    });
        });
        if($query->exists()){
             return error_response('A Notification already exists in the selected date range!', 422);
        }
        try {
            CenterNotification::create($data);
             return success_response($data, 'Notification create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
       
    }
}
