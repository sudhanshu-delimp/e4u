<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvertiserAgentRequestUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
         Schema::create('advertiser_agent_request_users', function (Blueprint $table) {
       
           $table->id();
            $table->bigInteger('advertiser_agent_requests_id')->nullable();
            $table->bigInteger('advertiser_user_id')->nullable();
            $table->bigInteger('receiver_agent_id')->nullable();
            $table->tinyInteger('status')
                ->default(0)
                ->comment('Status of request: 0 = Pending, 1 = Accepted, 2 = Rejected , 3 = Forfeited');

            $table->timestamps();
        });
        //php artisan migrate --path=database/migrations/2025_07_16_200342_advertiser_agent_request_users.php
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_agent_request_users');
    }
}
