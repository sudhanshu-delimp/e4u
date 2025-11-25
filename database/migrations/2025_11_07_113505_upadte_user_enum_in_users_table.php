<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpadteUserEnumInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("ALTER TABLE users CHANGE COLUMN type type VARCHAR(2) NOT NULL DEFAULT '0';");
        DB::statement("
            ALTER TABLE `users`
            MODIFY `type` ENUM('0', '1', '2', '3', '4', '5','6','7','8')
            NOT NULL DEFAULT '0'
            COMMENT '0=user; 1=admin; 2=sub-admin; 3=escort; 4=massage-center; 5=agents,6=staff, 7=operator,8=shareholder'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
