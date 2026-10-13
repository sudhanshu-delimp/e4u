<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use App\Models\Option;

class Feedback extends Model
{
    use HasFactory;
    protected $table = "feedbacks";
    protected $guarded = ['id'];

    /**
     * Status mapping
     */
    protected $statusMap = [
        '1' => 'Pending',
        '2' => 'Completed',
    ];

    /**
     * Accessor for human-readable status
     */
    public function getStatusTextAttribute()
    {
        return $this->statusMap[$this->status] ?? 'NA';
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->exists && empty($model->ref_number)) {
                $model->ref_number = generateReferenceNunber($model);
                // Prevent the update from triggering model events again.
                $model->saveQuietly();
            }
        });
    }

}
