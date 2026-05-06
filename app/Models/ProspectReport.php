<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectReport extends Model
{
    use HasFactory;

    protected $table = 'prospect_reports';

    protected $fillable = [
        'agent_id',
        'post_code_label',
        'type',
        'listings_count',
        'center_ids',
        'merged',
        'status_type',
    ];

    protected $casts = [
        'center_ids' => 'array',
        'merge_center_ids' => 'array',
    ];

    public function centers()
    {
        return MassageExcel::whereIn('id', $this->center_ids ?? [])->get();
    }
}
