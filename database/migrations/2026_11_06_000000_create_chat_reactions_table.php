<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatReactionsTable extends Migration
{
    public function up()
    {
        // One reaction per person per message
        Schema::create('chat_reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('user_id');
            $table->string('emoji', 16);
            $table->timestamps();

            $table->unique(['message_id', 'user_id']);
            $table->index('message_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_reactions');
    }
}