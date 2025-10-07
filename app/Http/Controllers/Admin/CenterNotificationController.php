<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterNotificationController extends Controller
{
    public function index(){
          return view('admin.notifications.centres.index');
    }

    public function store(Request $request){
        dd($request->all());
    }
}
