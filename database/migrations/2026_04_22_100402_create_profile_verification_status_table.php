<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileVerificationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_verification_status', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('profile_id');

            // 3 = escort, 4 = massage
            $table->enum('type', ['3', '4'])->comment('3=escort,4=massage');

            // 0 = pending, 1 = verified, 2 = unverified
            $table->enum('status', ['0', '1', '2'])
                ->default('0')
                ->comment('0=pending,1=verified,2=unverified');

            $table->timestamps();

            $table->unique(['profile_id', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_verification_status');
    }
}
