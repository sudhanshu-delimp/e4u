<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\DataTablePagination;
use Carbon\Carbon;

class WalletService
{
    use DataTablePagination;
    public function credit(
        User $user,
        float $amount,
        ?Model $source = null,
        ?string $description = null,
        array $meta = []
    ) {
        return DB::transaction(function () use ($user, $amount, $source, $description, $meta) {
            $wallet = $user->getOrCreateWallet();
            $wallet->increment('balance', $amount);
            $wallet->refresh();
            $creditTransaction = $wallet->transactions()->create([
                'type' => 'credit',
                'amount' => $amount,
                'balance_after' => $wallet->balance,
                'description' => $description,
                'meta' => $meta,
                'transactionable_id' => $source?->id,
                'transactionable_type' => $source ? get_class($source) : null,
            ]);
            return $creditTransaction;
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
            $wallet->refresh();
            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'balance_after' => $wallet->balance,
                'description' => $description,
                'meta' => $meta,
                'transactionable_id' => $source?->id,
                'transactionable_type' => $source ? get_class($source) : null,
            ]);
        });
    }

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user = null)
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFieldsName($columns);
        $query = $user->wallet->transactions();
        if ($search) {
            $query->where(function ($q) use ($searchables, $search) {
                foreach ($searchables as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            });
        }
        $count =  $query->count();
        $query->orderBy($order_field, $dir);
        $mainQuery = $query->offset($start)->limit($limit);
        return [$mainQuery->get(), $count, [$query->toSql(), $searchables]];
    }

    public function modifyRecords($result)
    {
        foreach ($result as $key => $item) {
            $item->created_date = convert_aus_date_time_format($item->created_at);
            $item->type = ucfirst($item->type);
            $item->amount = formatCurrency($item->amount);
            $item->transaction_type = $item->type == 'Credit' ? "<span class='credit'>{$item->type}</span>" : "<span class='debit'>{$item->type}</span>";
            $item->transaction_amount = $item->type == 'Credit' ? "<span class='amount-plus'>+{$item->amount}</span>" : "<span class='amount-minus'>-{$item->amount}</span>";
            $item->transaction_balance_after = formatCurrency($item->balance_after);
        }
        return $result;
    }

    public function updateEarnDays($user, int $days, string $action = 'add'): void
    {
        DB::transaction(function () use ($user, $days, $action) {

            $wallet = $user->getOrCreateWallet();

            switch ($action) {

                case 'add': {
                        $wallet->increment('earn_days', $days);
                    }
                    break;

                case 'subtract': {
                        $newValue = max(0, $wallet->earn_days - $days);
                        if ($newValue > 0) {
                            $wallet->decrement('earn_days', $days);
                        }
                    }
                    break;
                default:
                    throw new \InvalidArgumentException('Invalid action type');
            }
        });
    }
}
