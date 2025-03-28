<?php

namespace App\Repositories\ServiceCategory;

use App\Repositories\BaseRepository;
use App\Models\ServiceCategory;

class ServiceCategoryRepository extends BaseRepository implements ServiceCategoryInterface
{
    public function __construct(ServiceCategory $model)
    {
        $this->model = $model;
    }
}