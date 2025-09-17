<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentAdvertiserListController extends Controller
{
    public function index()
    {
        return view('agent.dashboard.Advertisers.advertiser-list');
    }
}
