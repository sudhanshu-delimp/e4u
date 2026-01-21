<?php 
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class CreditService
{
    public function credit(User $user, float $amount, string $module, ?int $referenceId = null, array $meta = [])
    {
        DB::transaction(function () use ($user, $amount, $module, $referenceId, $meta) {
            $wallet = $user->wallet()->lockForUpdate()->firstOrCreate(['user_id' => $user->id]);

            $wallet->increment('balance', $amount);

            $wallet->transactions()->create([
                'type' => 'credit',
                'amount' => $amount,
                'module' => $module,
                'reference_id' => $referenceId,
                'meta' => $meta,
            ]);
        });
    }

    public function debit(User $user, float $amount, string $module, ?int $referenceId = null, array $meta = [])
    {
        DB::transaction(function () use ($user, $amount, $module, $referenceId, $meta) {
            $wallet = $user->wallet()->lockForUpdate()->firstOrCreate(['user_id' => $user->id]);

            if ($wallet->balance < $amount) {
                throw new Exception("Insufficient credits");
            }

            $wallet->decrement('balance', $amount);

            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'module' => $module,
                'reference_id' => $referenceId,
                'meta' => $meta,
            ]);
        });
    }

    public function refund(User $user, float $amount, string $module, ?int $referenceId = null, array $meta = [])
    {
        // Refund is just a credit transaction
        $this->credit($user, $amount, $module, $referenceId, array_merge($meta, ['refund' => true]));
    }

    public function balance(User $user)
    {
        return $user->wallet ? $user->wallet->balance : 0;
    }
}
