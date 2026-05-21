<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaConsentToUsersTable extends Migration
{


    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('social_media_consent',['0','1'])
                ->default(0)
                 ->comment('0 = No, 1 = Yes')
                ->after('pay_id_no');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('social_media_consent');
        });
    }
}
