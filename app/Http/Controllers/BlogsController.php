<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

            $currentDate = $month
                ? Carbon::createFromFormat('Y-m', $month)->startOfMonth()
                : Carbon::now()->startOfMonth();


            $previousDate  = $month ?  $currentDate :  $currentDate->copy()->subMonth();

            //Baisc Query
            $baseQuery = PublicationBlog::query();

            if ($search) {
                $baseQuery->where('title', "like", "%{$search}%");
            }

            //Current Month Blogs
            $currentBlogs = (clone $baseQuery)
                ->select('id', 'title', 'slug', 'blog_image', 'description', 'created_at')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($query) {
                    $query->blog_image = asset(ImageService::url($query->blog_image, 'original', 'publication_blog'));
                    return $query;
                });


            //Previous Month Blogs (Archive)

            $previousBlogs = (clone $baseQuery)
                ->select('id', 'title', 'slug')
                ->whereYear('created_at', $previousDate->year)
                ->whereMonth('created_at', $previousDate->month)
                ->orderByDesc('created_at')
                ->get();



            // html blog render 
            $htmlBlog =   view('web.pages.blog.dynamic-card', ['blogs' => $currentBlogs])->render();
            $preHtml = view('web.pages.blog.archive-list', ['archives' => $previousBlogs])->render();

            return success_response([
                'card'       => $htmlBlog,
                'archive'    => $preHtml,
                'month'      => $currentDate->format('Y-m'),
                'pre_month'  => $previousDate->format('Y-m'),
            ]);

        } catch (\Exception $e) {
            dd($e);
            return error_response($e->getMessage());
        }
    }
}
