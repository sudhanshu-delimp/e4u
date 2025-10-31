<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nums', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // dd-mm-yyyy format can be handled in frontend
            $table->date('incident_date')->nullable(); // dd-mm-yyyy format can be handled in frontend
            $table->string('incident_state')->nullable(); // State name or ID
            $table->string('incident_location')->nullable(); // City name
            $table->string('offender_name')->nullable(); // If known
            $table->string('offender_mobile', 20)->nullable(); // Only numbers
            $table->string('offender_email')->nullable(); // If known
            $table->string('incident_nature')->nullable(); // Dropdown/enum: assault, harassment, etc.
            $table->string('platform')->nullable(); // Platform name if known
            $table->string('profile_link')->nullable(); // URL or Membership ID
            $table->text('what_happened')->nullable(); // Description
            $table->string('rating')->nullable(); // Ratings options
            $table->string('status')->nullable(); // Ratings options
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
        Schema::dropIfExists('nums');
    }
}
