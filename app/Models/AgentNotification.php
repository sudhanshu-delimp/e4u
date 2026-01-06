<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'current_day','heading', 'type', 'start_date', 'end_date', 'member_id', 'recurring_type', 'start_day', 'end_day', 'start_month', 'end_month', 'num_recurring', 'content', 'scheduled_days', 'status', 'template_name'
    ];

    /**
     * Scope for active (visible) notifications on a given date.
     *
     * Handles: adhoc - visible between start_date and end_date
     *          notice - same, but only for specific member_id
     *          scheduled - recurring logic based on type
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $date e.g. '2025-11-11' defaults to today
     * @param string|null $memberId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $date = null, $memberId = null)
    {
        $date = $date ?: now()->toDateString();

        // Adhoc: show between start_date and end_date
        $query->where(function ($q) use ($date, $memberId) {
            $q->where(function ($q2) use ($date) {
                $q2->where('type', 'adhoc')
                    ->whereDate('start_date', '<=', $date)
                    ->whereDate('end_date', '>=', $date);
            });

            // Notice: show for specific member (and between dates)
            $q->orWhere(function ($q2) use ($date, $memberId) {
                $q2->where('type', 'notice')
                    ->whereNotNull('member_id')
                    ->where('member_id', $memberId)
                    ->whereDate('start_date', '<=', $date)
                    ->whereDate('end_date', '>=', $date);
            });

            // Scheduled: recurring logic
            $q->orWhere(function ($q2) use ($date) {
                $q2->where('type', 'scheduled')
                   // We must match the recurring_type: weekly, monthly, yearly, forever
                   ->where(function ($q3) use ($date) {
                        $q3->where(function ($q4) use ($date) {
                            // Forever: always visible if published
                            $q4->where('recurring_type', 'forever');
                        })
                        ->orWhere(function ($q4) use ($date) {
                            // Weekly: visible if today is in that week day range and within NUM_RECURRING (if set)
                            $q4->where('recurring_type', 'weekly')
                                ->where(function ($qr) use ($date) {
                                    $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeekIso; // 1=Mon
                                    $qr->where('start_day', '<=', $dayOfWeek)
                                       ->where('end_day', '>=', $dayOfWeek);
                                });
                                // Recurrence limit: could optionally check created_at + num_recurring*weeks etc.
                        })
                        ->orWhere(function ($q4) use ($date) {
                            // Monthly: if today is in start_day to end_day
                            $q4->where('recurring_type', 'monthly')
                                ->where(function ($qm) use ($date) {
                                    $d = \Carbon\Carbon::parse($date);
                                    $day = $d->day;
                                    $qm->where('start_day', '<=', $day)->where('end_day', '>=', $day);
                                });
                                // Recurrence limit: could add num_recurring logic
                        })
                        ->orWhere(function ($q4) use ($date) {
                            // Yearly: if today is in the range start_month/start_day to end_month/end_day
                            $q4->where('recurring_type', 'yearly')
                               ->where(function ($qy) use ($date) {
                                    $d = \Carbon\Carbon::parse($date);
                                    $monthDay = ($d->month * 100) + $d->day;
                                    $startMD = (\DB::raw('start_month * 100 + start_day'));
                                    $endMD   = (\DB::raw('end_month * 100 + end_day'));
                                    // Logic: raw where because Eloquent can't compare computed cols easily, leave as callable for now
                                    $qy->whereRaw('( (start_month * 100 + start_day) <= ? and (end_month * 100 + end_day) >= ? )', [$monthDay, $monthDay]);
                               });
                        });
                    });
            });
        });

        return $query;
    }
}
