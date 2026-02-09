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
        Schema::create('account_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->dateTime('password_updated_date')->nullable();
            $table->enum('password_expiry_days', ['never', '30', '60', '90'])->nullable()->default('60');
            $table->enum('is_text_notificaion_on', ['1', '0'])->default('0');
            $table->enum('is_email_notificaion_on', ['1', '0'])->default('0');
            $table->enum('is_first_login', ['0', '1'])->default('0')->comment('0=>No, 1=>Yes');
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('account_settings');
    }
};
