<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastOnlineAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->comment('0=>user; 1=>admin; 2=>sub-admin; 3=>escort; 4=>massage-center; 5=>agents')->after('remember_token');
            $table->timestamp('last_online_at')->useCurrent()->after('type')->comment('0=>female; 1=>male; 2=>ither');
            $table->tinyInteger('gender')->after('last_online_at')->nullable();
            $table->tinyInteger('enabled')->after('gender');
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
            $table->dropColumn('type');
            $table->dropColumn('last_online_at');
            $table->dropColumn('gender');
            $table->dropColumn('enabled');
        });
    }
}
