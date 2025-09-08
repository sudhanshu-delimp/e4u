<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastPageToLoginAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('login_attempts', function (Blueprint $table) {
             $table->string('page')->nullable()->after('ip_address'); 
             $table->string('online')->default('no')->after('ip_address'); 
        });

        // php artisan migrate --path=database/migrations/2025_09_03_074431_add_last_page_to_login_attempts_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login_attempts', function (Blueprint $table) {
            $table->dropColumn('page');
            $table->dropColumn('online');
        });
    }
}
