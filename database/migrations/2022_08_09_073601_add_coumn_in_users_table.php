<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //business_name,business_number ,abn ,business_address ,contact_person ,email2,business_number
            $table->string('business_name')->after('otp_created_at')->nullable();
            $table->bigInteger('business_number')->after('business_name')->nullable();
            $table->bigInteger('abn')->after('business_number')->nullable();
            $table->longText('business_address')->after('abn')->nullable();
            $table->string('contact_person')->after('business_address')->nullable();
            $table->string('email2')->nullable()->after('contact_person')->unique();
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
            $table->dropColumn('business_name');
            $table->dropColumn('business_number');
            $table->dropColumn('abn');
            $table->dropColumn('business_address');
            $table->dropColumn('contact_person');
            $table->dropColumn('email2');
        });
    }
}
