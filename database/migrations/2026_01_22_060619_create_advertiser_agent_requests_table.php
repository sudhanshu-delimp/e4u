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
        Schema::create('advertiser_agent_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->index('agent_requests_user_id_index');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('ref_number')->nullable()->index('agent_requests_ref_number_index');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('mobile_number', 20);
            $table->boolean('contact_by_email')->default(false);
            $table->boolean('contact_by_mobile')->default(false);
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0)->comment('Status of request: 0 = Pending, 1 = Accepted, 2 = Rejected');
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
        Schema::dropIfExists('advertiser_agent_requests');
    }
};
