<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_alerts', function (Blueprint $table) {
            $table->id();
            $table->enum('alert_type', ['Employment','New Features','Scammer Alerts','Website Updates'])->default('Employment');
            $table->text('subject');
            $table->longText('description')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['Published','Withdrawn'])->default('Published');
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
        Schema::dropIfExists('footer_alerts');
    }
}
