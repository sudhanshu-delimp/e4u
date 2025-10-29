<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesConciergeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_concierge_services', function (Blueprint $table) {
            $table->id();
            $table->enum('fee', ['Accommodation','Email Account','Mobile SIM','Travel','Visa Migration & Education Placement'])->nullable(true);
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
        Schema::dropIfExists('fees_concierge_services');
    }
}
