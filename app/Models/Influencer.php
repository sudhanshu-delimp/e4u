<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'email',
        'social_media',
        'comments',
        'status',
        'ref_number'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->exists && Schema::hasColumn($model->getTable(), 'ref_number') && empty($model->ref_number)) {
                $model->ref_number = generateReferenceNunber($model);
                // Prevent model events from triggering again
                $model->saveQuietly();
            }
        });
    }
}
