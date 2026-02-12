<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

}
