<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassagerMasseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('massager_masseurs');

        Schema::create('massager_masseurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('massage_profile_id')->nullable();
            $table->unsignedBigInteger('masseur_profile_id')->nullable();
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
        Schema::dropIfExists('massager_masseurs');
    }
}
