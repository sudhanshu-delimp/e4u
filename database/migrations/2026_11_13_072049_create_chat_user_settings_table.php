<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_user_settings', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('user_id')->unique();
            $t->boolean('calling_enabled')->default(false);
            $t->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_user_settings');
    }
}
