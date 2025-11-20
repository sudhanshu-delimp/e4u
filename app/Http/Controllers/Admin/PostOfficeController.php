<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostOfficeController extends Controller
{
    public function addPostOfficeReport()
    {
        return view('admin.post-office.reports');
    }

    public function listingPostOfficeReport()
    {
        return view('admin.post-office.send-reports');
    }
    public function storePostOfficeReportAjax()
    {
        return view('admin.post-office.send-reports');
    }
}
