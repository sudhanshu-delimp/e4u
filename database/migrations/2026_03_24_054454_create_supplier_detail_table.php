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
        Schema::create('supplier_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->date('date_appointed')->nullable();
            $table->string('point_of_contact', 100)->nullable();
            $table->enum('concierge_service', ['email', 'massage', 'sim'])->default('email'); 
            $table->date('agreement_date')->nullable();
            $table->string('term')->nullable();
            $table->string('fee')->nullable();
            $table->string('agreement_file')->nullable();
            $table->decimal('commission_advertising', total: 8, places: 2)->nullable();
            $table->enum('commission_advertising_type', ['fixed', 'percent'])->default('fixed');
            $table->decimal('commission_massage_centre', total: 8, places: 2)->nullable();
            $table->enum('commission_massage_centre_type', ['fixed', 'percent'])->default('fixed');
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
        Schema::dropIfExists('supplier_details');
    }
};
