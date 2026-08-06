<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateByToLegboxNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legbox_notifications', function (Blueprint $table) {
            $table->integer('create_by')->nullable()->after('status');
            $table->string('create_by_member_id')->nullable()->after('create_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('legbox_notifications', function (Blueprint $table) {
            $table->dropColumn('create_by');
            $table->dropColumn('create_by_member_id');
        });
    }
}
