<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortViewerInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_viewer_interactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('its user id of member');
            $table->integer('escort_id')->nullable()->comment('its escort id of member');
            $table->integer('viewer_id')->comment('its user id of viewer');
            $table->string('action_by')->nullable()->comment('action taken by member or viewer');
            
            $table->boolean('escort_blocked_viewer')->default(false);
            $table->boolean('escort_disabled_contact')->default(false);
            $table->boolean('escort_disabled_notification')->default(false);
            
            $table->boolean('viewer_blocked_escort')->default(false);
            $table->boolean('viewer_disabled_contact')->default(false);
            $table->boolean('viewer_disabled_notification')->default(false);
            $table->string('viewer_rate_escort')->default('no_rated');

            // Unique to avoid duplicates
            $table->unique(['escort_id', 'viewer_id']);

            $table->timestamps();
        });

        // php artisan migrate --path=database/migrations/2025_07_21_103208_create_escort_viewer_interactions_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escort_viewer_interactions');
    }
}
