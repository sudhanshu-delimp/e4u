<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Exception;

class AddRefNumberToExistingRecordsService
{
    public function updateReferenceNumber()
    {
        try {
            $tables = [
                'concierge_mobile_sims',
                'agent_notifications',
                'center_notifications',
                'escort_notifications',
                'global_notifications',
                'legbox_notifications',
                'notifications',
                'shareholder_notifications',
                'viewer_notifications',
                'publication_blogs',
                'reviews',
                'massage_reviews',
                'advertiser_agent_requests',
                'communications',
                'nums',
                'punterbox',
                'support_tickets',
                'notebox',
                'influencers',
                'feedbacks',
                'payment_histories',
            ];

            foreach ($tables as $table) {

                $refColumnName = 'ref_number';
                if ($table ==  'payment_histories') {
                    $refColumnName = 'ref_no';
                }

                if (!Schema::hasTable($table) || !Schema::hasColumn($table, $refColumnName)) {
                    Log::info($table . " has not " . $refColumnName . "Column");
                    continue;
                }


                $model = new class extends Model {
                    public $timestamps = false;
                    protected $guarded = [];
                };
                $model->setTable($table);

                $model->newQuery()
                    ->when($table !== 'payment_histories', function ($query) use ($refColumnName) {
                        $query->where(function ($q) use ($refColumnName) {
                            $q->whereNull($refColumnName)
                                ->orWhere($refColumnName, '');
                        });
                    })
                    ->orderByDesc('id')
                    ->chunk(50, function ($records) use ($table, $refColumnName) {
                        foreach ($records as $tableObj) {
                            if (Schema::hasColumn($table, 'created_at')) {
                                $id = $tableObj->id;
                                $createdAt = $tableObj->created_at;

                                if (!empty($createdAt)) {
                                    $refNum = generateReferenceNunber($tableObj);
                                    $tableObj->{$refColumnName} = $refNum;
                                    $tableObj->saveQuietly();
                                }
                            } else {
                                Log::info($table . " has no created_at column");
                            }
                        }
                    });
            }
        } catch (Exception $e) {
            Log::info("Exception : " . $e->getMessage() . " line number: " . $e->getLine());
        }
    }
}
