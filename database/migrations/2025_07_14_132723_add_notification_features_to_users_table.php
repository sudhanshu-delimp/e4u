<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationFeaturesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('notification_features')->nullable()
            ->after('agent_communications')
            ->comment('viewer_notification = 1,viewer_ask_question = 2,viewer_send_text = 3,available_playmate = 4');
        });

        // php artisan migrate --path=database/migrations/2025_07_14_132723_add_notification_features_to_users_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notification_features');
        });
    }
}
