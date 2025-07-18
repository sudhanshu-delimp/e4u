<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConversations extends Model
{
    use HasFactory;
    protected $table = "ticket_conversations";
    protected $guarded = ['id'];


    public function support_ticket()
    {
        return $this->belongsTo('App\Models\SupportTickets', 'support_ticket_id');
    }


        public function user_from_admin()
        {
            return $this->belongsTo(User::class, 'admin_id');
        }

        public function user_from_user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}
