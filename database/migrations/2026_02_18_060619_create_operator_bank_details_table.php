<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bsb')->index()->nullable();
            $table->bigInteger('account_number')->index()->nullable();
            $table->tinyInteger('state')->nullable()->comment('1->Primary Account, 2-> Secondary Account');
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
        Schema::dropIfExists('operator_bank_details');
    }
};
