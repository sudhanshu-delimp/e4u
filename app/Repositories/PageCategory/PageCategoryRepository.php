<?php

namespace App\Repositories\PageCategory;

use App\Repositories\BaseRepository;
use App\Models\PageCategory;

class PageCategoryRepository extends BaseRepository implements PageCategoryInterface
{
    protected $categories;
    public function __construct(PageCategory $categories)
    {
        $this->model = $categories;
    }
}
