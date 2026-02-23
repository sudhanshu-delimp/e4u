<?php

namespace App\Repositories\MassageReview;

use App\Repositories\BaseRepository;
use App\Models\MassageReviews;

class MassageReviewRepository extends BaseRepository implements MassageReviewInterface
{
    protected $review;
    public function __construct(MassageReviews $review)
    {
        $this->model = $review;
    }


}
