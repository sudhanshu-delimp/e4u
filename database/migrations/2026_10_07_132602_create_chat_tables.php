<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTables extends Migration
{
    public function up()
    {
        // One row per pair of users. user_one_id is always the smaller id.
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_one_id');
            $table->unsignedBigInteger('user_two_id');
            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            $table->unique(['user_one_id', 'user_two_id']);
            $table->index('user_two_id');
        });

        // Per-user state of a conversation (mute, archive, delete)
        Schema::create('chat_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('last_read_message_id')->nullable();
            $table->boolean('is_muted')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamp('deleted_at')->nullable(); // deleted for this user only
            $table->timestamps();

            $table->unique(['conversation_id', 'user_id']);
            $table->index('user_id');
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('sender_id');
            $table->text('body')->nullable();
            $table->string('type', 20)->default('text'); // text, image, video
            $table->timestamp('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['conversation_id', 'id']);
            $table->index('sender_id');
        });

        Schema::create('chat_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->string('path');
            $table->string('kind', 20); // image, video
            $table->string('mime', 100)->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->timestamps();

            $table->index('message_id');
        });

        Schema::create('chat_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blocker_id');
            $table->unsignedBigInteger('blocked_id');
            $table->timestamps();

            $table->unique(['blocker_id', 'blocked_id']);
            $table->index('blocked_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_blocks');
        Schema::dropIfExists('chat_attachments');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_participants');
        Schema::dropIfExists('chat_conversations');
    }
}