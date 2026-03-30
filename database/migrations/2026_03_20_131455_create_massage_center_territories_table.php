<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageCenterTerritoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_center_territories', function (Blueprint $table) {
            $table->id();
            $table->string('territory_name')->unique();
            $table->enum('status', ['Pending', 'Active', 'Suspended'])->default('Pending');
            $table->integer('state_id')->nullable();
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
        Schema::dropIfExists('massage_center_territories');
    }
}
