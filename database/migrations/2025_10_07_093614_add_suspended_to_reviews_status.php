<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSuspendedToReviewsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            DB::statement("ALTER TABLE reviews MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'published', 'suspended') DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            DB::statement("ALTER TABLE reviews MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'published') DEFAULT 'pending'");
        });
    }
}
