<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectedReasonAndAdminIdToNumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nums', function (Blueprint $table) {
            $table->text('admin_action')->nullable()->after('status'); // or adjust the column position
            $table->unsignedBigInteger('admin_id')->nullable()->after('admin_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nums', function (Blueprint $table) {
            $table->dropColumn(['admin_action', 'admin_id']);
        });
    }
}
