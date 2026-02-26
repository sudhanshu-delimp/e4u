<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunterboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('punterbox', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->date('incident_date')->nullable();
            $table->string('incident_state')->nullable();
            $table->string('incident_location')->nullable();
            $table->string('escort_name')->nullable();
            $table->string('escort_mobile', 20)->nullable();
            $table->string('escort_email')->nullable();
            $table->string('incident_nature')->nullable();
            $table->string('platform')->nullable();
            $table->string('profile_link')->nullable();

            $table->text('what_happened')->nullable();
            $table->string('rating')->nullable();

            $table->enum('status', ['0','1','2','3'])
                  ->default('0')
                  ->comment('0 = Pending, 1 = Published, 2 = On Hold, 3 = Rejected');

            $table->text('admin_action')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->timestamps();

            // Foreign Keys (Optional but Recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            // Index for performance
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punterbox');
    }
}
