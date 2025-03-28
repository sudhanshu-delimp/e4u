<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhonePhoneVerifiedAtOtpStatusColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('email')->nullable();
            $table->timestamp('phone_verified_at')->after('phone')->nullable();
            $table->string('otp')->after('phone_verified_at')->nullable();
            $table->tinyInteger('status')->after('otp')->nullable();
            $table->dropColumn('email');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('otp');
            $table->dropColumn('status');
            $table->string('email')->after('id');
        });
    }
}
