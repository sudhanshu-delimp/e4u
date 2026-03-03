<?php

namespace App\Models;

use App\Models\MassageProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMassageProfile extends Model
{
    use HasFactory;

     protected $table = 'report_massage_profiles';
    
    protected $fillable = ['id', 'massage_id', 'viewer_id', 'report_tag', 'report_desc', 'admin_id', 'report_status', 'action_message'];

    public function massage()
    {
        return $this->hasOne(MassageProfile::class, 'id', 'massage_id');
    }

    public function viewer()
    {
        return $this->hasOne(User::class, 'id', 'viewer_id');
    }
}
