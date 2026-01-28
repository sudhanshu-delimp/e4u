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
        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wallet_id');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 15);
            $table->string('module');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['wallet_id', 'module']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_transactions');
    }
};
