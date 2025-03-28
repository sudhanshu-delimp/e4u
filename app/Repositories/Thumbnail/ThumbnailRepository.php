<?php

namespace App\Repositories\Thumbnail;

use App\Repositories\BaseRepository;
use App\Models\Thumbnail;

class ThumbnailRepository extends BaseRepository implements ThumbnailInterface
{
    protected $thumbnail;

    public function __construct(Thumbnail $thumbnail)
    {
        $this->model = $thumbnail;
    }

    public function findByPath($path)
    {
        return $this->model->where('path', $path)->first();
    }
}
