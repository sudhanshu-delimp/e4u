<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        return view('web.pages.blogs');
    }

    public function blogsSingle()
    {
        return view('web.pages.blogs-single');
    }
}
