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
        Schema::create('alert_notics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('motion', ['static', 'scrolling']);
            $table->longText('notice_descrioption')->nullable();
            $table->enum('action', ['public', 'suspend'])->nullable();
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
        Schema::dropIfExists('alert_notics');
    }
};
