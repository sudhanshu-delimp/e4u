<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTypeToNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            

            $table->enum('user_type', ['0','1', '2', '3','4','5'])
            ->nullable(true)
            ->comment('0=>user; 1=>admin; 2=>sub-admin; 3=>escort; 4=>massage-center; 5=>agents')
            ->after('to_user');
            

        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
}
