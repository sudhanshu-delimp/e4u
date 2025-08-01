<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsAgentAssignToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

             $table->enum('is_agent_assign', ['0', '1'])->default('0')->after('email2')->comment('1-yes,0-No');
             $table->integer('assigned_agent_id')->nullable()->after('is_agent_assign')->comment('assigned agent id');
            
        });

        // php artisan migrate --path=database/migrations/2025_07_29_162916_add_column_is_agent_assign_to_user_table.php
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
