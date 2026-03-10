<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreditTransactionsTable extends Migration {

    public function up(): void
    {
       Schema::dropIfExists('credit_transactions');

        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wallet_id');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 15, 2);
            // 3. Polymorphic relation (manual to avoid long index name)
            $table->string('transactionable_type')->nullable();
            $table->unsignedBigInteger('transactionable_id')->nullable();
            $table->string('description')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(
                ['transactionable_type', 'transactionable_id'],
                'ct_transactionable_idx'
            );

            // 5. Wallet FK (safe)
            $table->foreign('wallet_id')
                  ->references('id')
                  ->on('wallets')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('credit_transactions', function (Blueprint $table) {

            // Drop FK
            $table->dropForeign(['wallet_id']);

            // Drop morph index + columns
            $table->dropIndex('ct_transactionable_idx');
            $table->dropColumn([
                'transactionable_type',
                'transactionable_id',
                'description',
            ]);

            // Restore old columns
            $table->string('module');
            $table->unsignedBigInteger('reference_id')->nullable();

            // Restore amount
            $table->decimal('amount', 15)->change();

            $table->index(['wallet_id', 'module']);
        });
    }
};