<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageCenterBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_center_bank_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bsb')->nullable();
            $table->unsignedBigInteger('account_number')->nullable();
            $table->tinyInteger('state')
                  ->nullable()
                  ->comment('1 = Primary Account, 2 = Secondary Account');
            $table->boolean('eft')
                  ->default(0)
                  ->comment('0 = EFT disabled, 1 = EFT enabled');
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
        Schema::dropIfExists('massage_center_bank_details');
    }
}
