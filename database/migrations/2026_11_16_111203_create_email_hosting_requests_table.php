<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailHostingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up(): void
    {
        Schema::create('email_hosting_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->nullable();

            $table->json('contact_pref')->nullable();
            $table->json('contact_preference')->nullable();

            $table->boolean('term_condition')->default(false);
            $table->boolean('auth')->default(false);

            $table->unsignedInteger('period_required')->nullable();

            $table->text('comments')->nullable();

            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_hosting_requests');
    }
}
