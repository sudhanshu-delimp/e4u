<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('ref_no')->unique();
        $table->string('service')->nullable();
        $table->decimal('amount', 12, 2)->nullable();
        $table->string('currency', 10)->default('AUD');
        $table->string('transaction_id')->nullable();

        $table->enum('status', ['pending', 'success', 'failed', 'refunded'])
        ->default('pending');

        $table->timestamp('paid_at')->nullable();
        $table->string('card')->nullable();
        $table->json('meta')->nullable();

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
        Schema::dropIfExists('payment_histories');
    }
}
