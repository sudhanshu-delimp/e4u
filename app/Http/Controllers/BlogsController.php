<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\PublicationBlog;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;

class BlogsController extends Controller
{
    public function index()
    {
        return view('web.pages.blog.index');
    }

    public function blogsDetail($slug)
    {
        return view('web.pages.blog.blogs-single');
    }

    public function blogsList(Request $request)
    {
        $month = $request->get('month');
        $search = $request->get('search');


        try {
            $query  = PublicationBlog::select('id', 'title', 'slug', 'blog_image', 'description', 'created_at');
            //Month Filter
            if ($month) {
                [$year,$month]  = explode('-', $month);
                $query->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            }

            //Search Filter
            if ($search) {
                $query->where('title', "like", "%{$search}%");
            }

            $blogs = $query->orderBy('created_at', 'desc')->get()->map(function($blog){
                $blog->blog_image = asset(ImageService::url($blog->blog_image, 'original', 'publication_blog'));
                return $blog;
    
            });

            

            // html blog render 
            $htmlBlog =   view('web.pages.blog.dynamic-card', ['blogs' => $blogs])->render();

            //Archive blog list

            return success_response(['card' => $htmlBlog]);
        } catch (\Exception $e) {
            dd($e);
            return error_response($e->getMessage());
        }
    }
}
