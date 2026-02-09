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
        Schema::create('concierge_mobile_sims', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->boolean('contact_pref_email')->default(false);
            $table->boolean('contact_pref_mobile')->nullable()->default(false);
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('mobile', 20);
            $table->string('delivery_address', 500);
            $table->integer('period_required')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('terms')->default(false);
            $table->boolean('status')->default(true);
            $table->string('order_ref')->nullable();
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
};
