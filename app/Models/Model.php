<?php

namespace App\Models;


use App\Traits\Models\HasCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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
        static::saving(function ($model) {
           // Log::info("Model saving called");
            $model->setModelCreatedUpdatedBy();
        });

        static::created(function ($model) {
             //Log::info("Model created called");
            $tableName = $model->getTable();
            if ($tableName == 'payment_histories') {
                $fefNumber =  generateReferenceNunber($model);
                $model->ref_no = $fefNumber;
                // Log::info("generateReferenceNunber called from payment_histories " .$fefNumber);
                $model->saveQuietly();
            } else if ($model->exists && Schema::hasColumn($model->getTable(), 'ref_number') && empty($model->ref_number)) {
                $fefNumber =  generateReferenceNunber($model);
                $model->ref_number = $fefNumber;
                // Prevent model events from triggering again
                // Log::info("Other table called from payment_histories " . $fefNumber);
                $model->saveQuietly();
            }
        });
    }
}
