<?php

namespace App\Repositories\Page;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Page;
use Carbon\Carbon;

class PageRepository extends BaseRepository implements PageInterface
{
    use DataTablePagination;
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
    public function onlineUser()
    {
        $date = Carbon::now();
        return $this->model->where('last_online_at', '>', $date->modify("-5 minutes")->toDateTimeString())->get();

    }

   
    protected function modifyProperties($result)
    {

       
        foreach($result as $key => $item) {
            $item->page_title = $item->page_title ? "
            <div class='form-check'>
                <input class='form-check-input' type='checkbox' value=''
                    id='flexCheckDefault'>
                <label class='form-check-label' for='flexCheckDefault'></label>
            </div>$item->page_title <br>
            <div><a href='pages-edit/$item->id?'>Edit</a> <a href='pages-duplicate/$item->id'>Duplicate</a> <a href='pages-details/$item->slug'>View</a> <a
                    href='pages-details/$item->slug'>
                    View Edit Log</a> <a href='pages/$item->id'>Delete</a>
            </div>
            </div>" : null;
            $item->slug =  $item->slug ? "[ID: ".$item->id ."]". $item->slug : "[ID: ".$item->id ."]";
            $item->Link_categories = "Footer links , Legal";
            $item->editor = $item->users? $item->users->role_type.' '.$item->users->name :null;
            $item->date = $item->updated_at ? Carbon::parse($item->updated_at)->format("Y/m/d g:i A") : null;
            $item->Last_date = $item->published ? 'Published</br>'. Carbon::parse($item->updated_at)->format("Y/m/d g:i A") : 'Unpublished</br>'. Carbon::parse($item->updated_at)->format("Y/m/d g:i A");
            

        }

        return $result;
    }

    public function findEscort()
    {
        return $this->model->where('type', 3)->get();
    }

    public function published()
    {
        return $this->model->where('published', 1)->get();
    }

    public function search($agent_id, $str = null)
	{
        $agent = $this->model->find($agent_id);

        return $agent->agentEscorts()
            ->orWhere('name',  'LIKE', "%{$str}%")
            ->orWhere('users.id',  '=', "{$str}")
            ->orWhere('phone',  'LIKE', "%{$str}%")
            ->get();
	}

    public function pageCount()
    {
        return $this->model->count();
    }

    public function publishedPageCount()
    {
        return $this->model->where('published', 1)->count();
    }
    public function viewPage($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
