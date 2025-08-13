<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageViewerInteractions extends Model
{
    use HasFactory;
    protected $table = 'massage_viewer_interactions';
    
    protected $fillable = ['user_id', 'massage_id', 'viewer_id', 'action_by', 'massage_blocked_viewer', 'massage_disabled_contact', 'massage_disabled_notification', 'viewer_blocked_massage','viewer_disabled_contact','viewer_disabled_notification','viewer_rate_massage'];

    public function massageCenters()
    {
        return $this->hasMany(MassageProfile::class, 'id','massage_id');
    }
}
