<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Repositories\ServiceCategory\ServiceCategoryRepository;

class ServiceCategoryController extends BaseController
{
    protected $cateory;

    public function __construct(ServiceCategoryRepository $cateory)
    {
        $this->cateory = $cateory;
    }

    public function index()
    {
        //dd($this->cateory->all());
        return view('admin.service-category.index');
    }
}
