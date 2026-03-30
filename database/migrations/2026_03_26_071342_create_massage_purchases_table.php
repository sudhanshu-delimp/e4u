<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::dropIfExists('massage_purchases');

       Schema::create('massage_purchases', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('membership_id')->default(0);
           
            $table->unsignedBigInteger('massage_centre_id');
            $table->unsignedBigInteger('massage_profile_id');

        
            $table->date('start_date');
            $table->dateTime('utc_start_time')->nullable();

            $table->date('end_date');
            $table->dateTime('utc_end_time')->nullable();

            $table->enum('status', ['pending', 'listed', 'expire', 'cancel'])
                  ->default('pending');

            $table->decimal('rate', 10, 2)->default(0.00);
            $table->decimal('discount_rate', 10, 2)->default(0.00);
            $table->decimal('total_rate', 10, 2)->default(0.00);
            $table->decimal('paid_rate', 10, 2)->default(0.00);

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
        Schema::dropIfExists('massage_purchases');
    }
}
