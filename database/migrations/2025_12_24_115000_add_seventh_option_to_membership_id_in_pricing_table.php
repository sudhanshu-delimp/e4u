<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeventhOptionToMembershipIdInPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing', function (Blueprint $table) {
            // Drop the existing column
            $table->dropColumn('membership_id');
        });

        Schema::table('pricing', function (Blueprint $table) {
            // Re-add membership_id as ENUM 1–7, nullable
            $table->enum('membership_id', ['1','2','3','4','5','6','7'])
                  ->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing', function (Blueprint $table) {
            $table->dropColumn('membership_id');
        });

        Schema::table('pricing', function (Blueprint $table) {
            // Recreate original ENUM 1–6, nullable
            $table->enum('membership_id', ['1','2','3','4','5','6'])
                  ->nullable();
        });
    }
}
