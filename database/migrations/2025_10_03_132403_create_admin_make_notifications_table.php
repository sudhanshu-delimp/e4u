<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMakeNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_make_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('ref')->unique();
            $table->string('heading');
            $table->date('start_date');
            $table->date('finish_date');
            $table->enum('type', ['Adhoc', 'Template', 'Notice']);
            $table->text('content');
            $table->enum('status', ['Published', 'Completed', 'Removed'])->default('Published');
            $table->unsignedBigInteger('member_id')->nullable(); // for Notice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_make_notifications');
    }
}
