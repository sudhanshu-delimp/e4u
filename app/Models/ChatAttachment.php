<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatAttachment extends Model
{
    protected $table = 'chat_attachments';

    protected $guarded = [];

    public function message()
    {
        return $this->belongsTo(ChatMessage::class, 'message_id');
    }
}