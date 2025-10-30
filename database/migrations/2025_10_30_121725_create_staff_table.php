<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            // Personal Details
            $table->string('name')->nullable()->index();
            $table->string('address')->nullable();
            //$table->string('mobile')->nullable();
            //$table->string('email')->nullable();
            //$table->tinyInteger('gender')->comment('0=>female 1=>male 2=>other')->nullable();
            // Next of Kin (Emergency Contact)
            $table->string('kin_name')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->string('kin_mobile')->nullable();
            $table->string('kin_email')->nullable();
            // Other Details
            $table->string('position')->nullable();
            $table->string('location')->nullable();
            $table->date('commenced_date')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->enum('employment_status', ['full_time', 'part_time', 'casual', 'contractor'])->default('full_time')->index();
            $table->enum('employment_agreement',  ['yes', 'no'])->default('no');
            // Building Security
            $table->enum('building_access',  ['yes', 'no'])->default('no');
            $table->enum('alarm_code',  ['yes', 'no'])->default('no');
            $table->enum('keys_issued',  ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
