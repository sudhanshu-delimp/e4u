<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciergeMobileSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concierge_mobile_sims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('contact_pref_email')->nullable();
            $table->boolean('contact_pref_mobile')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('mobile', 20);
            $table->text('delivery_address');
            $table->integer('period_required')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('terms');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('concierge_mobile_sims');
    }
}
