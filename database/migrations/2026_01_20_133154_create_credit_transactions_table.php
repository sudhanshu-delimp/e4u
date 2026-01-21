<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['credit','debit']);
            $table->decimal('amount', 15, 2);
            $table->string('module'); // booking, chat, subscription, etc
            $table->unsignedBigInteger('reference_id')->nullable(); // order_id, booking_id
            $table->json('meta')->nullable(); // extra info if needed
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
}
