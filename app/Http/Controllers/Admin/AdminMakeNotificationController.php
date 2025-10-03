<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminMakeNotification;

class AdminMakeNotificationController extends Controller
{
    public function index()
    {
        //return view('admin_make_notifications.index');
    }


    public function list(Request $request)
    {
        $notifications = AdminMakeNotification::orderBy('id','desc')->get();
        return response()->json(['data' => $notifications]);
    }

    public function store(Request $request)
    {
        $ref = AdminMakeNotification::max('ref') + 1;

        $notification = AdminMakeNotification::create([
            'ref'        => $ref,
            'heading'    => $request->heading,
            'start_date' => $request->start_date,
            'finish_date'=> $request->finish_date,
            'type'       => $request->type,
            'content'    => $request->content,
            'member_id'  => $request->member_id,
            'status'     => 'Published'
        ]);

        return response()->json(['success' => true, 'data' => $notification]);
    }

    public function remove($id)
    {
        $notification = AdminMakeNotification::findOrFail($id);
        $notification->update(['status' => 'Removed']);
        return response()->json(['success' => true]);
    }

}
