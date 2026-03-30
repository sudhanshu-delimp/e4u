<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncallOutcallFieldsToEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->boolean('incall_enabled')
                  ->default(false)
                  ->after('default_setting');
    
            $table->decimal('incall_amount', 10, 2)
                  ->nullable()
                  ->after('incall_enabled');
    
            $table->boolean('outcall_enabled')
                  ->default(false)
                  ->after('incall_amount');
    
            $table->decimal('outcall_amount', 10, 2)
                  ->nullable()
                  ->after('outcall_enabled');
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
            $table->dropColumn([
                'incall_enabled',
                'incall_amount',
                'outcall_enabled',
                'outcall_amount'
            ]);
        });
    }
}
