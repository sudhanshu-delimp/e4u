<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_staff_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unique();
            $table->string('name')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('kin_name')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->string('kin_mobile')->nullable();
            $table->string('kin_email')->nullable();
            $table->enum('position', ['1', '2', '3', '4'])->default('2')->comment('1=>Admin; 2=>Staff; 3=>Sub Admin; 4=>Developer')->index();
            $table->string('location')->nullable()->index();
            $table->date('commenced_date')->nullable();
            $table->enum('security_level', ['1', '2', '3', '4'])->default('2')->index();
            $table->enum('employment_status', ['full_time', 'part_time', 'casual', 'contractor'])->default('full_time')->index();
            $table->enum('employment_agreement', ['yes', 'no'])->default('no');
            $table->enum('building_access_code', ['yes', 'no'])->default('no');
            $table->enum('car_parking', ['yes', 'no'])->default('no');
            $table->enum('keys_issued', ['yes', 'no'])->default('no');
            $table->bigInteger('created_by')->nullable()->index();
            $table->bigInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('operator_staff_details');
    }
};
