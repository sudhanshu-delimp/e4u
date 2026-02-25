<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('credit_transactions', function (Blueprint $table) {

            // 1. Fix amount precision
            $table->decimal('amount', 15, 2)->change();

            // 2. Remove old columns
            if (Schema::hasColumn('credit_transactions', 'module')) {
                $table->dropColumn('module');
            }

            if (Schema::hasColumn('credit_transactions', 'reference_id')) {
                $table->dropColumn('reference_id');
            }

            // 3. Polymorphic relation (manual to avoid long index name)
            $table->string('transactionable_type')->nullable();
            $table->unsignedBigInteger('transactionable_id')->nullable();

            $table->index(
                ['transactionable_type', 'transactionable_id'],
                'ct_transactionable_idx'
            );

            // 4. Description
            $table->string('description')->nullable();

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