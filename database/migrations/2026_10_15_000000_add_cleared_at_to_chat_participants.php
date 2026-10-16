<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClearedAtToChatParticipants extends Migration
{
    public function up()
    {
        Schema::table('chat_participants', function (Blueprint $table) {
            // Messages up to this time are hidden for this person only
            $table->timestamp('cleared_at')->nullable()->after('deleted_at');
        });
    }

    public function down()
    {
        Schema::table('chat_participants', function (Blueprint $table) {
            $table->dropColumn('cleared_at');
        });
    }
}