<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageSuspendProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_suspend_profiles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('massage_profile_id');
            $table->unsignedBigInteger('user_id');

            $table->date('start_date');
            $table->date('end_date');

            $table->decimal('credit', 10, 2);

            $table->text('note')->nullable();

            $table->string('status')->default('1');

           

            $table->dateTime('utc_start_date')->nullable();
            $table->dateTime('utc_end_date')->nullable();


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
        Schema::dropIfExists('massage_suspend_profiles');
    }
}
