<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Repositories\ServiceCategory\ServiceCategoryInterface;
use App\Repositories\Service\ServiceInterface;
use App\Http\Requests\SaveServiceRequest;
use App\Traits\ApiResponser;

class ServiceController extends BaseController
{
    use ApiResponser;
    protected $service;
    protected $category;

    public function __construct(ServiceInterface $service, ServiceCategoryInterface $category)
    {
        $this->service = $service;
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();

        return view('admin.service.index', compact('categories'));
    }

    public function dataTable()
    {
       
        list($services, $count) = $this->service->paginated(
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
            "data"            => $services
        );
       
        return response()->json($data);
    }

    public function save(SaveServiceRequest $request, $id = null)
    {
        $data = $request->validated();
        
        $service = $this->service->store($data, $id);

		return $this->apiResponse(
			'Service saved successfully',
			array(),
			array(),
			200,
			1,
		);
    }

    public function delete($id = null)
    {
        $service = $this->service->destroy($id);
        
		return $this->apiResponse(
			'Service deleted successfully',
			array(),
			array(),
			200,
			1,
		);
    }
}
