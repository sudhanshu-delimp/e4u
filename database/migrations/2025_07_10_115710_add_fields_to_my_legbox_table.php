<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMyLegboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_legbox', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(false)->after('escort_id');
            $table->string('rate')->nullable()->after('is_blocked');
            $table->boolean('is_enabled_contact')->default(true)->after('rate');
            $table->boolean('is_notification_enabled')->default(true)->after('is_enabled_contact');
        });

        // php artisan migrate --path=database/migrations/2025_07_10_115710_add_fields_to_my_legbox_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_legbox', function (Blueprint $table) {
            $table->dropColumn(['is_blocked', 'rate', 'is_enabled_contact', 'is_notification_enabled']);
        });
    }
}
