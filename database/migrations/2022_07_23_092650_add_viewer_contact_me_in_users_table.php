<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewerContactMeInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('viewer_contact_type')->after('type')->comment('1=>Call me,2=>Text me,3=>Email me')->nullable();
            $table->string('tour_permissition_type')->after('viewer_contact_type')->nullable()->comment('1=>Allow Created,2=>Allow Edit,3=>Post a Tour leg');
            $table->string('alert_notifications')->after('tour_permissition_type')->nullable()->comment('1=>Email,2=>Text msg');
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
            $table->dropColumn('viewer_contact_type');
            $table->dropColumn('tour_permissition_type');
            $table->dropColumn('alert_notifications');
        });
    }
}
