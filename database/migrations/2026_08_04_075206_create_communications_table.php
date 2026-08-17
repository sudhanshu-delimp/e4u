<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('state_id')->default(null);
            $table->unsignedBigInteger('sender_id')->default(null);
            $table->unsignedBigInteger('receiver_id')->default(null);
            $table->enum('sender_type', ['escort'])->default('escort');
            $table->enum('send_on_email', ['1','0'])->default('0');
            $table->enum('send_on_mobile',['1','0'])->default('0');
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
        Schema::dropIfExists('communications');
    }
}
