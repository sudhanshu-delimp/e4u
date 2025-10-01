<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function list(Request $request){

        if($request->ajax()){
            $query = AdminBlog::query();
            //optional : search by title
            if($request->has('search') && $request->get('serach')){
                $s = $request->get('serach');
                $query->where('title', 'link', "%$s%");
            }
            $blogs = $query->orderBy('created_at','desc');
            
        }
        return view('admin.blog');
       
         
    }



}
