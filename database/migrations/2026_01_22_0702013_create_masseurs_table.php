<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('masseurs');

        Schema::create('masseurs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('token_id');
            $table->string('name');
            $table->string('stage_name');
            $table->string('mobile', 20);

            $table->string('nationality')->nullable();
            $table->string('ethnicity')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->enum('vaccination', ['1', '2', '3'])->nullable();

            $table->longText('commentary')->nullable();
            $table->mediumText('availability')->nullable(); 
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
        Schema::dropIfExists('masseurs');
    }
}
