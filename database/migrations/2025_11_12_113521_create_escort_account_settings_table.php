<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_account_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            // Single-value settings
            $table->string('auto_recharge_option')->default('no'); // e.g. "100"
            $table->string('twofa')->nullable();                      // e.g. "2"
            $table->string('num')->nullable();                       // e.g. "NUM"
            $table->string('subscription')->nullable();      
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
        Schema::dropIfExists('escort_account_settings');
    }
}
