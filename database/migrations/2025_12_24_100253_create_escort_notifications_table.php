<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('heading');  
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['Ad hoc','Template', 'Notice']);
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->string('member_id')->nullable();
            $table->enum('status', ['Published','Completed','Suspended', 'Removed'])->default('Published');
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
        Schema::dropIfExists('escort_notifications');
    }
}
