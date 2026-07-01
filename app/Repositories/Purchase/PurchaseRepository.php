<?php

namespace App\Repositories\Purchase;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Escort;
use App\Models\Purchase;
use Illuminate\Support\Arr;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;

class PurchaseRepository extends BaseRepository implements PurchaseInterface
{
    use DataTablePagination;
    protected $escort;
    protected $purchase;
    protected $user;

    public function __construct(Purchase $purchase, Escort $escort, User $user)
    {
        $this->model = $purchase;
        $this->escort = $escort;
        $this->user = $user;
    }
    public function limit($to, $from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    protected function getOrderPurchase($order_key, $conditionsIn)
    {
        if (count($conditionsIn) > 0) {
            $columns = ['escort_id', 'name', 'location', 'profile_name', 'membership', 'start_date', 'end_date', 'days_number', 'remaining_days',  'status'];
        } else {
            $columns = ['escort_id', 'profile_name', 'location', 'name', 'start_date', 'end_date', 'days_number', 'membership', 'status', 'fee'];
        }

        $columns = ['escort_id', 'profile_name', 'location', 'name', 'start_date', 'end_date', 'days_number', 'membership', 'status', 'fee'];
        return isset($columns[$order_key]) ? $columns[$order_key] :  'escort_id';
    }

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id, $conditions = [], $conditionsIn = [])
    {
        // $order_field = $this->getOrderPurchase($order_key, $conditionsIn);

        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $table = $this->model->getTable();
        $query = $this->model
            ->where($conditions)
            ->with([
                'escort.brb' => function ($q) {
                    $q->where('brb_time', '>', Carbon::now('UTC'))
                        ->where('active', 'Y')
                        ->orderBy('brb_time', 'desc');
                }
            ])
            ->whereHas('escort', function ($sub_query) use ($user_id, $searchables, $search, $conditionsIn) {
                if ($user_id > 0) {
                    $sub_query = $sub_query->where('user_id', $user_id);
                }
                $sub_query->whereNotNull('profile_name');
                if ($search) {
                    if (count($conditionsIn) > 0 && isset($conditionsIn['column']) && isset($conditionsIn['condition'])) {
                        $sub_query->where(function ($q) use ($search) {
                            $q->where('profile_name', 'LIKE', "%{$search}%")
                                ->orWhereHas('user', function ($q) use ($search) {
                                    $q->where('member_id', 'LIKE', "%{$search}%");
                                });
                        });
                    } else {
                        $sub_query->where(function ($q) use ($searchables, $search) {
                            foreach ($searchables as $column) {
                                $q->orWhere($column, 'LIKE', "%{$search}%");
                            }
                        });
                    }
                }
            });
        if (count($conditionsIn) > 0 && isset($conditionsIn['column']) && isset($conditionsIn['condition'])) {
            $query = $query->whereIn($conditionsIn['column'], $conditionsIn['condition']);
        }
        $count =  $query->count();
        if (in_array($order_field, ['profile_name', 'name'])) {
            $query->orderBy(
                Escort::select("{$order_field}")->whereColumn('escorts.id', 'purchase.escort_id')->limit(1),
                $dir
            );
        } else if ($order_field == 'days_number') {
            $query->orderByRaw("DATEDIFF(end_date, start_date) $dir");
        } else if ($order_field == 'remaining_days') {

            $query->selectRaw("$table.*,DATEDIFF(end_date, NOW()) as days_left")->orderBy('days_left', $dir);
        } else {
            $query->orderByRaw("
            CASE
            WHEN end_date >= CURDATE() THEN 0
            ELSE 1
            END ASC
            ")->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyEscorts($mainQuery->get(), $start);
        return [$result, $count];
    }

    protected function modifyEscorts($result, $start)
    {
        $i = 1;
        $locations = config('escorts.profile.states');
        foreach ($result as $key => $item) {

            $startDate = Carbon::parse(date('d-m-Y', strtotime($item->start_date)))->startOfDay();
            $endDate = Carbon::parse(date('d-m-Y', strtotime($item->end_date)))->startOfDay();
            $now = Carbon::now()->startOfDay();
            if ($startDate > $now) {
                $statusBtn = '<span class="custom_badge badge_upcoming">Upcoming</span>';
            } elseif ($endDate < $now) {
                $statusBtn = '<span class="custom_badge badge_suspended">Expired</span>';
            } else {
                $statusBtn = '<span class="custom_badge badge_current">Current</span>';
            }
            $localTimeZone = getEscortTimezone($item);
            $isExtended = $item->escort->isListingExtended();
            $mainPurchase = $item->escort->mainPurchase;
            $isBumpUped = $item->escort->activeBumpup;

            $item->is_bumpup = !empty($isBumpUped) ? true : false;
            $item->statusOriginal = $item->status;

            $item->escort_id = $item->escort_id;
            $item->member_id = $item->escort->member_id;
            $item->name = $item->escort->user->name;
            $item->profile_name = $item->escort->profile_name;
            $item->pro_name = $item->profile_name . '<br/>';
            $item->stage_name = $item->escort->gender == 'Transgender' ? 'TS - ' . $item->escort->name : $item->escort->name;
            $item->days_number = $item->days_number;
            $item->days_number = $item->days_number;
            $item->days_left = $item->days_left;
            // $item->status = $item->escort->enabled == 1 ?'Current':'Upcoming';
            // $statusText = $item->escort->enabled == 1 ? 'Current' : 'Upcoming';
            // $badgeClass = getStatusBadgeClass(strtolower($statusText));
            // $item->status = "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
            // $item->statusBtn = $statusBtn;
            $item->status = $statusBtn;
            $item->statusBtn = $statusBtn;

            $item->location = $locations[$item->escort->state_id]['stateAbbr'];
            $item->membership = getMembershipType($item->membership);
            $item->net_amount = getPurchaseNetAmount($item->id);

            $itemArray = $item->escort->toArray();
            //print_r($itemArray);die;
            $tagCount = 0;

            $endpoint = ['id' => $item->escort->id];
            $profileUrl = route('profile.description', $endpoint);
            $item->profileUrl = $profileUrl;


            if ($itemArray['brb']) {
                $item->pro_name = '<span id="brb_' . $item->escort->id . '">' . $item->escort->profile_name . " <br/><sup class='brb_icon listing-tag-tooltip'>BRB <small class='listing-tag-tooltip-desc'>Brb  " . date('d-m-Y h:i A', strtotime($itemArray['brb'][0]['selected_time'])) . "</small></sup>";
                $tagCount++;
            }

            if (!empty($item->escort->activeUpcomingSuspend) || $item->escort->user->status == "Suspended") {
                if ($item->escort->user->status == "Suspended") {
                    $item->pro_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
                </sup>';
                    $tagCount++;
                } else {
                    $item->pro_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($item->escort->activeUpcomingSuspend->start_date)) . " to " . date("d-m-Y", strtotime($item->escort->activeUpcomingSuspend->end_date)) . '</small>
                </sup>';
                    $tagCount++;
                }
            }

            if ($isExtended->count) {
                $item->pro_name .= '<sup class="extend_icon listing-tag-tooltip ml-1">Extended
                <small class="listing-tag-tooltip-desc">Extended from ' . date("d-m-Y", strtotime($isExtended->data->start_date)) . " to " . date("d-m-Y", strtotime($isExtended->data->end_date)) . '</small>
                </sup>';
                $tagCount++;
            }

            if ($mainPurchase && $mainPurchase->tour_location_id != null) {
                $item->pro_name .= '<sup class="tour_icon listing-tag-tooltip ml-1">Tour
                <small class="listing-tag-tooltip-desc">Listed from ' . date("d-m-Y", strtotime($item->start_date)) . " to " . date("d-m-Y", strtotime($item->end_date)) . '</small>
                </sup>';
                $tagCount++;
            }

            if ($item->is_bumpup) {
                $brTag = "";
                $tagClass = 'ml-1';
                if ($tagCount > 3) {
                    $brTag = "<br/>";
                    $tagClass = '';
                }
                $item->pro_name .=  $brTag . '<sup class="bumpup_icon listing-tag-tooltip ' . $tagClass . '">Bumped Up
                <small class="listing-tag-tooltip-desc">From ' . getEscortLocalTime($isBumpUped->utc_start_time, $localTimeZone)->format('d-m-Y h:i A') . " to " . getEscortLocalTime($isBumpUped->utc_end_time, $localTimeZone)->format('d-m-Y h:i A') . '</small>
                </sup>';
            }

            $i++;
        }

        return $result;
    }
}
