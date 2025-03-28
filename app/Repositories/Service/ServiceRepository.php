<?php

namespace App\Repositories\Service;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Service;
use Carbon\Carbon;

class ServiceRepository extends BaseRepository implements ServiceInterface
{
    use DataTablePagination;

    protected $service;

    public function __construct(Service $service)
    {
        $this->model = $service;
    }
    public function limit($to,$from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function findByCategory(array $ids)
    {
        $services = [];
        foreach($ids as $id)
        {
            $services[] = $this->model->where('category_id', $id)->get();
        }
        return $services;
    }

    public function CategoryByServices($id,$escort)
    {

        $services = [];
        $service = $this->model->where('category_id', $id)->get();
       
        $count = round(count($service)/3);
      
        $services[] = $this->model->where('category_id', $id)->offset(0)->limit($count)->get();
        
        $services[] = $this->model->where('category_id', $id)->offset($count)->limit($count)->get();
        $services[] = $this->model->where('category_id', $id)->offset($count*2)->limit($count)->get();
       
        foreach($services as $key => $services_one) {
            $services_one->map(function($service, $key) use($escort) {
                $service->services_price = null;
                if($escort_service = $escort->services()->where('services.id', $service->id)->first()) {
                    $service->services_price = $escort_service->pivot->price;
                }
                return $service;
            });  
        }
        
        return $services;
    }

    protected function modifyProperties($result)
    {
        foreach($result as $key => $item) {

            $item->category_name = $item->category ? $item->category->name : null;
            $item->created_at_parsed = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#save-service" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->category ? $item->category->id : null).'">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-service" href="#" data-id="'.$item->id.'">Delete</a> </div></div>';
		}

        return $result;
    }

    // public function servicesWithPrice($id, $escort_id)
    // {
    //     $query = $this->model->whereHas('escorts', function($q) use($id, $escort_id) {
    //         $q->where('escort_services.escort_id', $escort_id)
    //         ->where('escort_services.service_id', $id)
    //         ->with('services');
    //     });
    //     //->withPivot('price');

    //     dd($service);
    //     return $query->first();
    // }

    public function getHourMinetTime($time)
    {
        $times = [];
        if($time) {
            $time = explode(':',$time);
            $times[] = ($time[0] < 12)? "AM" :"PM";
            $times[] = ($time[0] > 12)? $time[0] - 12 : $time[0];
            $times[] = $time[1];
            return $times;
        } else {
            return ['', '', ''];
        }
    }
}
