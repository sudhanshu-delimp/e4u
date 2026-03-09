<?php

namespace App\Repositories\MassageReview;


use App\Models\Reviews;
use App\Repositories\BaseRepository;

class MassageReviewRepository extends BaseRepository implements MassageReviewInterface
{
    protected $review;
    public function __construct(Reviews $review)
    {
        $this->model = $review;
    }


}
