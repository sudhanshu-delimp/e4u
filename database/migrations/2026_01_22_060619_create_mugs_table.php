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
        Schema::create('mugs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->date('incident_date');
            $table->string('place_name')->nullable();
            $table->string('email')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('mobile', 100);
            $table->text('explain_incident');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mugs');
    }
};
