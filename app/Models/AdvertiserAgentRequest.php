<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class AdvertiserAgentRequest extends Model
{
    use HasFactory;

    protected $table = "advertiser_agent_requests";
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'state_id',
        'contact_by_email',
        'contact_by_mobile',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'status',
        'ref_number',
        'comments'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getMobileNumberAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setMobileNumberAttribute($value)
    {
    
        $clean = removeSpaceFromString($value);
        $this->attributes['mobile_number'] = $clean;
    }

  

   public function advertiser_agent_request_user()
    {
        return $this->hasOne(AdvertiserAgentRequestUser::class, 'advertiser_agent_requests_id');
    }

    public function agent_request_users()
    {
        return $this->hasMany(AdvertiserAgentRequestUser::class, 'advertiser_agent_requests_id');
    }

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
