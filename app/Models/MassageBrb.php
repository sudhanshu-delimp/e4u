<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
class MassageBrb extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = true;

    /**
     * Get the created by that owns the details.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the details.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
