<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuspendProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspend_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escort_profile_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('credit', 10, 2);
            $table->text('note')->nullable();
            $table->string('status')->default(true);
            $table->timestamps();
        });

        // php artisan migrate --path=database/migrations/2025_07_03_093743_create_suspend_profiles_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suspend_profiles');
    }
}
