<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegboxNotificationForEscrtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legbox_notification_for_escrts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['Adhoc', 'Template', 'Notice']);
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->string('member_id')->nullable();
            $table->enum('status', ['Published', 'Completed', 'Removed', 'Suspended'])->default('Published');
            $table->integer('create_by')->nullable();
            $table->string('create_by_member_id')->nullable();
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
        Schema::dropIfExists('legbox_notification_for_escrts');
    }
}
