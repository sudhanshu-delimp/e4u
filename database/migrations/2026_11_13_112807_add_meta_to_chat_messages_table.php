<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaToChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_messages', function (Blueprint $t) {
            $t->text('meta')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chat_messages', function (Blueprint $t) {
            $t->dropColumn('meta');
        });
    }
}
