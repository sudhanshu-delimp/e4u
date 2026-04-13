<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_excels', function (Blueprint $table) {
            $table->id();
            $table->string('bussiness_name')->nullable();
            $table->string('address')->nullable();
            $table->integer('post_code')->nullable();
            $table->string('state_abbr');
            $table->integer('state_id');
            $table->string('territory_name')->nullable()->comment('state full name');
            $table->string('mobile_number')->nullable();
            $table->string('business_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->enum('archive', ['true', 'false'])->default('false');
            //$table->enum('status', ['Published', 'Suspended','Pending'])->default('Pending');
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
        Schema::dropIfExists('massage_excels');
    }
}
