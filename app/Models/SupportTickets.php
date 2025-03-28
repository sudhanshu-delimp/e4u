<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TicketConversations;
use App\Models\User;

class SupportTickets extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "support_tickets";
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id', 'department', 'priority', 'service_type', 'subject', 'message', 'file', 'created_on', 'status', 'unread'
    ];


    public function getStatusAttribute($value)
    {
        return config("common.supportTicket.statuses.$value");
    }



    public function conversations()
    {
        return $this->hasMany('App\Models\TicketConversations', 'support_ticket_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
