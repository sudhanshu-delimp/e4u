<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesSupportServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
       Schema::create('fees_support_services', function (Blueprint $table) {
            $table->id();
            $table->enum('fee', 
            [
            'Create Profile',
            'Edit Profile',
            'Create Tour',
            'Edit Tour',
            'Upload Media (for verification)',
            'Complete Media Verification (excluding Platinum)',
            'Complete Profile Information',
            'Organise Profiles and Media in Archives',
            ])->nullable(true);
            $table->enum('frequency', ['Per Service'])->default('Per Service');
            $table->decimal('amount', 8, 2)->nullable(true);
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
        Schema::dropIfExists('fees_support_services');
    }
}
