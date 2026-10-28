<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToFeesSupportServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees_support_services', function (Blueprint $table) {
            $table->enum('category', [
                'My Account',
                'Profile Management',
                'Concierge',
                'My Playbox',
            ])->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees_support_services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
}
