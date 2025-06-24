<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePeopleStaffController extends Controller
{
    public function index()
    {
        return view('admin.management.manage-user');
    }
}
