<?php

namespace App\Http\Controllers\Center;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class MediaController extends BaseController
{
   public function videoGalleries()
    {
        return view('center.dashboard.media-centre.videos');
    }
}
