<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Repositories\User\UserInterface;
use App\Repositories\Page\PageInterface;
use App\Repositories\PageCategory\PageCategoryInterface;
use Carbon\Carbon;
use Auth;

class PageController extends Controller
{
    protected $user;
    protected $page;
    protected $pageCategory;

    public function __construct(UserInterface $user, PageInterface $page, PageCategoryInterface $pageCategory)
    {
        $this->user = $user;
        $this->page = $page;
        $this->pageCategory = $pageCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_count = $this->page->pageCount();
        $published_page_count = $this->page->publishedPageCount();
        return view('admin.pages.index', compact('page_count', 'published_page_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pageListAjaxdatatable()
    {
        list($page, $count) = $this->page->paginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $page
        );

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        //dd($request->all());
		$validate=$request->validate([
		'page_title'=>'required',
		'slug'=>'required|unique:pages']);
		unset($request['_token']);
		unset($request['_method']);
		$request['user_id'] = 121; //Auth::user()->id;
		Page::create($request->all());
		return redirect('admin.page.index')->with('status','Record successfully inserted!..');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $page = $this->page->viewPage($slug);

		return view('admin.pages.view', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $page = $this->page->find($id);
        //dd($page->categories);
        if(!$page = $this->page->find($id))
        {
            $page = $this->page->make();
        }
        $pageCategories = $this->pageCategory->all();
		return view('admin.pages.edit', compact('page','pageCategories'));
    }

    public function duplicate($id)
    {
        $page = $this->page->find($id);
        $pagess = $this->page->make();
        $pageCategories = $this->pageCategory->all();
        return view('admin.pages.duplicate', compact('page', 'pagess', 'pageCategories'));
    }

    public function published(UpdatePageRequest $request, $id)
    {
        //dd($request->published);
        $data = [];
        $data = ['published' => $request->published];
        $error = false;
        if($this->page->store($data, $id))
        {
            $error = true;
        }
        return response()->json($error);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id = null)
    {


        //
        $data = [];
        $data = [
            'page_title' => $request->page_title,
            'slug' => $request->slug,
            'sub_title' => $request->sub_title,
            'body_title' => $request->body_title,
            //'content' => $request->content,
            'user_id' => auth()->user()->id,
        ];

        $msg = "";
		if($page = $this->page->store($data, $id)) {
            $page->categories()->sync($request->category_id);
            $msg = "Record successfully updated !..";
        }
		return redirect()->route('admin.page.index')->with('status',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->page->destroy($id);
		return redirect()->route('admin.page.index')->with('status','Record successfully delete ...!');
    }
	public function pages($slug)
	{
		$page = Page::where('slug',$slug)->first();
		return view('Pages.pagemaker',compact('page'));
	}
}
