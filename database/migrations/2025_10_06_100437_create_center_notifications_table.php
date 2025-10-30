<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('heading');  
            $table->date('start_date');
            $table->date('finish_date');
            $table->enum('type', ['Adhoc','Template', 'Notice']);
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->enum('status', ['Published','Completed','Removed'])->default('Published');
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
        Schema::dropIfExists('center_notifications');
    }
}
