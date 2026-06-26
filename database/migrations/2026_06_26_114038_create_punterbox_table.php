<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('punterbox', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->date('incident_date')->nullable();
            $table->string('incident_state')->nullable();
            $table->string('incident_location')->nullable();

            $table->string('escorts_name')->nullable();
            $table->string('escorts_mobile', 20)->nullable();
            $table->string('escorts_email')->nullable();

            $table->enum('incident_nature', [
                'Fraud',
                'No Show',
                'Violence'
            ])->nullable();

            $table->string('platform')->nullable();
            $table->string('profile_link')->nullable();

            $table->text('what_happened')->nullable();

            $table->enum('rating', [
                'Do not book',
                'Exercise caution',
                'Safe'
            ])->nullable();

            $table->string('status')->default('Pending');

            $table->text('admin_action')->nullable();

            $table->unsignedBigInteger('admin_id')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punterbox');
    }
};
