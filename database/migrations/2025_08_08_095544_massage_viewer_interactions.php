<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MassageViewerInteractions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_viewer_interactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('its user id of member');
            $table->integer('massage_id')->nullable()->comment('its massage center id ');
            $table->integer('viewer_id')->comment('its user id of viewer');
            $table->string('action_by')->nullable()->comment('action taken by massage or viewer');
            
            $table->boolean('massage_blocked_viewer')->default(false);
            $table->boolean('massage_disabled_contact')->default(false);
            $table->boolean('massage_disabled_notification')->default(false);
            
            $table->boolean('viewer_blocked_massage')->default(false);
            $table->boolean('viewer_disabled_contact')->default(false);
            $table->boolean('viewer_disabled_notification')->default(false);
            $table->string('viewer_rate_massage')->default('no_rated');

            // Unique to avoid duplicates
            $table->unique(['massage_id', 'viewer_id']);

            $table->timestamps();
        });

        // php artisan migrate --path=database/migrations/2025_08_08_095544_massage_viewer_interactions.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
