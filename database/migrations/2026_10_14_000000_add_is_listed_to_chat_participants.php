<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsListedToChatParticipants extends Migration
{
    public function up()
    {
        Schema::table('chat_participants', function (Blueprint $table) {
            // 1 = the chat is shown in this person's list even before a message exists
            $table->boolean('is_listed')->default(false)->after('is_archived');
        });
    }

    public function down()
    {
        Schema::table('chat_participants', function (Blueprint $table) {
            $table->dropColumn('is_listed');
        });
    }
}