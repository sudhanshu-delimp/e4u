<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProspectListController extends Controller
{
    public function prospectList(){

        return view('agent.dashboard.Marketing.create-prospect');
    }
}
