<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class ShareholderNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'current_day',
        'heading',
        'type',
        'start_date',
        'end_date',
        'member_id',
        'recurring_type',
        'start_day',
        'end_day',
        'start_month',
        'end_month',
        'num_recurring',
        'content',
        'scheduled_days',
        'status',
        'template_name'
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
