<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notebox', function (Blueprint $table) {
            $table->id();
            $table->string('escort_type')->nullable();
            $table->string('stage_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('advertised_price_per_hour')->nullable();
            $table->string('state')->nullable();

            $table->string('location')->nullable();
            $table->string('extras_charged')->nullable();
            $table->string('meeting_type')->nullable();
            $table->string('photos_authenticity')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('nationality')->nullable();

            $table->string('estimated_age')->nullable();
            $table->string('body_shape')->nullable();
            $table->string('overall_looks')->nullable();
            $table->string('overall_personality')->nullable();
            $table->string('bd')->nullable();

            $table->string('blowjob')->nullable();
            $table->string('oral_on_escort')->nullable();
            $table->string('anal_sex')->nullable();
            $table->string('overall_performance')->nullable();
            $table->string('met_profile_undertakings')->nullable();

            $table->string('drug_consumption')->nullable();
            $table->string('platform')->nullable();
            $table->string('profile_link')->nullable();
            $table->text('summary_of_encounter')->nullable();
            $table->string('profile_pic')->nullable();

            $table->string('status_type')->nullable();
            $table->string('status')->nullable();
            $table->string('admin_action')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('rating')->nullable();

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
        Schema::dropIfExists('notebox');
    }
}
