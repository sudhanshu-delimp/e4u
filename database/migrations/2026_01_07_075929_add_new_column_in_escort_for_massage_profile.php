<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInEscortForMassageProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            
            $table->string('business_name')->nullable()->after('title');
            $table->string('business_no')->nullable()->after('business_name');
            $table->string('building')->nullable()->after('business_no');
            $table->string('parking')->nullable()->after('building');
            $table->string('entry')->nullable()->after('parking');
            $table->string('furniture_types')->nullable()->after('entry');
            $table->string('shower')->nullable()->after('furniture_types');
            $table->string('ambiance')->nullable()->after('shower');
            $table->string('security')->nullable()->after('ambiance');
            $table->string('payment')->nullable()->after('security');
            $table->string('loyalty')->nullable()->after('payment');
            $table->string('duration_id')->nullable()->after('loyalty');

            $table->mediumText('massage_price')->nullable()->after('duration_id');
            $table->mediumText('incall_price')->nullable()->after('massage_price');
            $table->mediumText('outcall_price')->nullable()->after('incall_price');

            $table->mediumText('availability_time')->nullable()->after('outcall_price');
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escorts', function (Blueprint $table) {
            //
        });
    }
}
