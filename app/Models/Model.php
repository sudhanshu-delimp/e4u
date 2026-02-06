<?php

namespace App\Models;


use App\Traits\Models\HasCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use HasCreatedUpdatedBy;

    /**
     * The name of the "created_by" column.
     *
     * @var string|null
     */
    const CREATED_BY = 'created_by';

    /**
     * The name of the "updated_by" column.
     *
     * @var string|null
     */
    const UPDATED_BY = 'updated_by';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function($model) {
            $model->setModelCreatedUpdatedBy();
        });
    }
}
