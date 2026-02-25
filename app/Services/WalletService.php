<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function credit(
        User $user,
        float $amount,
        ?Model $source = null,
        ?string $description = null,
        array $meta = []
    ) {
        DB::transaction(function () use ($user, $amount, $source, $description, $meta) {
            $wallet = $user->getOrCreateWallet();
            $wallet->increment('balance', $amount);

            $wallet->transactions()->create([
                'type' => 'credit',
                'amount' => $amount,
                'description' => $description,
                'meta' => $meta,
                'transactionable_id' => $source?->id,
                'transactionable_type' => $source ? get_class($source) : null,
            ]);
        });
    }

    public function debit(
        User $user,
        float $amount,
        ?Model $source = null,
        ?string $description = null,
        array $meta = []
    ) {
        if ($user->wallet->balance < $amount) {
            throw new Exception('Insufficient wallet balance');
        }

        DB::transaction(function () use ($user, $amount, $source, $description, $meta) {
            $wallet = $user->getOrCreateWallet();
            $wallet->decrement('balance', $amount);

            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'description' => $description,
                'meta' => $meta,
                'transactionable_id' => $source?->id,
                'transactionable_type' => $source ? get_class($source) : null,
            ]);
        });
    }
}