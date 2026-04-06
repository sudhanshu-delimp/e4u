<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageBrbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_brbs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('profile_id');

            $table->date('date_set');

            $table->dateTime('selected_time')->nullable();

            $table->dateTime('brb_time');

            $table->text('brb_note');

            $table->char('active', 1)->default('Y');

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
        Schema::dropIfExists('massage_brbs');
    }
}
