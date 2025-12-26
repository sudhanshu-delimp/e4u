<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayIdColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             // Pay ID Name
            $table->string('pay_id_name')
                  ->nullable()
                  ->after('remember_token');

            // Pay ID Number
            $table->string('pay_id_no')
                  ->nullable()
                  ->after('pay_id_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pay_id_name', 'pay_id_no']);
        });
    }
}
