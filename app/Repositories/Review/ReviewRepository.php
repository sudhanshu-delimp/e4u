<?php

namespace App\Repositories\Review;

use App\Repositories\BaseRepository;
use App\Models\Reviews;

class ReviewRepository extends BaseRepository implements ReviewInterface
{
    protected $review;
    public function __construct(Reviews $review)
    {
        $this->model = $review;
    }


}
