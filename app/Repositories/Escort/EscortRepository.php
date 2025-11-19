<?php

namespace App\Repositories\Escort;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Escort;
use App\Models\EscortLike;
use Illuminate\Support\Arr;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;

class EscortRepository extends BaseRepository implements EscortInterface
{
    use DataTablePagination;
    protected $escort;
    protected $user;

    public function __construct(Escort $escort, User $user)
    {
        $this->model = $escort;
        $this->user = $user;
    }
    public function limit($to, $from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function getlinks($escort_id, $city = null, $membershipId = null, $filterEscortsCollection = null)
    {
        $next = null;
        $previous = null;

        foreach ($filterEscortsCollection as $key => $profile) {
            $currentExists =  $profile->where('id', $escort_id)->first();

            if ($currentExists && $currentExists->id == $profile->id) {
                if ($key >= 0 && $key < count($filterEscortsCollection) - 1) {
                    $next = $filterEscortsCollection[$key + 1];
                }

                if ($key > 0) {
                    $previous = $filterEscortsCollection[$key - 1];
                }
            }
        }

        # Note : ?no-next-page query handle in blade file for disable buttons purpose
        return [
            $next ? route('profile.description', [$next->id, $city, $membershipId]) : '?no-next-page',
            $previous ? route('profile.description', [$previous->id, $city, $membershipId]) : '?no-prev-page',
        ];
    }


    public function paginatedByEscortId($start, $limit, $order_key, $dir, $columns, $search = null, $escort_id, $stateId = null)
    {

        $order = $this->getOrder($order_key);
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model

            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        if ($search) {
            foreach ($searchables as $column) {
                if (in_array($column, $this->getColumns())) {
                    $query = $query->orWhere($column, 'LIKE', "%{$search}%");
                }
            }
        }
        if ($stateId != null) {
            $query = $query->where('state_id', $stateId);
        }
        $result = $query->where('user_id', $escort_id)->where('default_setting', '!=', 1)->get();

        $result = $this->modifyPropertiesforArchives($result, $start);
        $count =  $this->model->where('user_id', $escort_id)->where('default_setting', '!=', 1)->where('state_id', $stateId)->count();

        return [$result, $count, $start];
    }

    protected function getOrderEscort($order_key)
	{
		$columns = ['id','profile_name','location','name','membership','phone','created_at','status'];
        return $columns[$order_key];
	}

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id, $conditions = [])
    {
        $order = $this->getOrderEscort($order_key);
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model
            ->offset($start)
            ->limit($limit)
            ->with([
                'latestActivePinup',
                'activeUpcomingSuspend',
                'brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                },
            ])
            ->orderBy($order, $dir);

        if ($search) {
            $query = $query->where($conditions)
                ->where('user_id', $user_id)
                ->where('default_setting', '!=', 1)
                ->where('profile_name', '!=', null)
                ->where(function ($query) use ($searchables, $search) {
                    $query->where('id', 'like', "%{$search}%");
                    foreach ($searchables as $column) {
                        if ($column == 'pro_name') {
                            $column = 'profile_name';
                        }
                        $query = $query->orWhere($column, 'LIKE', "%{$search}%");
                    }
                });
                $sql = $query->toSql();
                $bindings = $query->getBindings();
            $result = $query->get();

            $result = $this->modifyEscorts($result, $start);
            $count =  $result->count();
        } else {
            $result = $query->where('user_id', $user_id)
                ->where($conditions)
                ->where('profile_name', '!=', null)
                ->where('default_setting', '!=', 1);
                $sql = $result->toSql();
                $bindings = $result->getBindings();

            $result = $this->modifyEscorts($result->get(), $start);
      
            $count =  $this->model->where('user_id', $user_id)->where($conditions)->where('default_setting', '!=', 1)->where('profile_name', '!=', null)->count();
        }

        return [$result, $count, $sql, $bindings];
    }





    protected function modifyEscorts($result, $start)
    {
        $i = 1;
        foreach ($result as $key => $item) {
            $playmates = $item->playmates->count();
            $s = explode('/', $_SERVER['REQUEST_URI']);
            $item->sn = ($start + $i);
            $item->name = $item->name ? $item->name : "NA";

            $item->pro_name = $item->profile_name ? '<span id="brb_' . $item->id . '" >' . $item->profile_name : "NA";
            $item->city_name = $item->city ? $item->city->name : null;
            $item->state_name = $item->state ? $item->state->name : null;
            if ($item->enabled == 1) {
                $item->enabled = "Active";
            } elseif ($item->enabled == 0) {
                $item->enabled = "Inactive";
            } else {
                $item->enabled = "Draft";
            }



           

            if($item->gender=='Transgender')
            $item->stage_name = 'TS-'.$item->name;
            else
            $item->stage_name = $item->name;
            $item->phone = $item->phone ? $item->phone : "NA";
            $item->gender = $item->gender ? $item->gender : "NA";
            $item->membership = $item->membership ? $item->membershipType : "NA";
            $item->homeState = $item->user ? $item->user->state->iso2 : "NA";
            $item->vaccine = $item->covidreport ? $item->covidreport : "NA";
            $item->actionAgentEscortProfile = '<div class="dropdown no-arrow "> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="' . route('profile.description', $item->id) . '"  data-id="' . $item->id . '" target="_blank">View</a> <div class="dropdown-divider"></div><a class="dropdown-item" data-user_id="' . $item->user_id . '" href="profile/' . $item->id . '/' . $item->user_id . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '" target="_blank">Edit</a>   </div></div>';
            //end list advertiser manage profile data
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y H:i A') : null;
            $profileTimezone = config("escorts.profile.states.$item->state_id.cities.$item->city_id.timeZone");
            $item->timezone_created_at = $item->created_at ? $item->created_at->copy()->setTimezone($profileTimezone)->format('d M Y h:i A') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow text-center"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">';
            if($item->enabled=='Inactive'){
                $item->action .= '<a class="dropdown-item dropdown-item d-flex align-items-center justify-content-start gap-10" data-toggle="modal" data-target="#duplicate-profile-modal" href="#" data-id="' . $item->id . '" data-state="' . $item->state_id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '"><i class="fa fa-pen"></i>Duplicate</a><div class="dropdown-divider"></div>';
            } 
           
            $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete-center" href="' . route('escort.delete.profile', $item->id) . '" data-id="' . $item->id . '"><i class="fa fa-trash"></i>Delete</a><div class="dropdown-divider"></div>';
            $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('escort.update.profile', $item->id) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '"><i class="fa fa-pen"></i>Edit</a><div class="dropdown-divider"></div>';
            if($item->enabled=='Active'){
            $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('escort.update.profile', ['id' => $item->id, 'tab' => 'my-playmates']) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '"><i class="fa fa-pen"></i>Include Playmates</a><div class="dropdown-divider"></div>';
            }
            if($item->latestActivePinup && empty($item->activeUpcomingSuspend)){
                $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-id="' . $item->id . '"  data-toggle="modal" data-target="#pinupSummary"><i class="fa fa-hand-pointer"></i>Pin Up Summary</a><div class="dropdown-divider"></div>';
            }
            $item->action .= ' <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('profile.description', $item->id) . '" data-id="' . $item->id . '"><i class="fa fa-eye"></i>View Profile</a></div>';
            $item->action .= '</div>';

            $isExtended = $item->isListingExtended();

            $item->is_extended = $isExtended->count;

            $itemArray = $item->toArray();
           

            if ($itemArray['brb']) {
                $item->pro_name = '<span id="brb_' . $item->id . '">' . $item->profile_name . " <sup class='brb_icon listing-tag-tooltip'>BRB <small class='listing-tag-tooltip-desc'>Brb  " . date('d-m-Y h:i A', strtotime($itemArray['brb'][0]['selected_time']))."</small></sup>";
                $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">';
                
                $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 brb-inactivate" href="' . route('escort.brb.inactive', $itemArray['brb'][0]['id']) . '" data-id="' . $itemArray['brb'][0]['id'] . '" data-category="' . ($itemArray['brb'][0]['id']) . '"><i class="fa fa-ban" aria-hidden="true"></i>Cancel BRB</a><div class="dropdown-divider"></div>';
                $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('escort.update.profile', $item->id) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '"><i class="fa fa-pen"></i>Edit</a><div class="dropdown-divider"></div>';
                $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete-center" href="' . route('escort.delete.profile', $item->id) . '" data-id="' . $item->id . '"><i class="fa fa-trash"></i>Delete</a><div class="dropdown-divider"></div>';
                if($item->enabled=='Active'){
                    $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('escort.update.profile', ['id' => $item->id, 'tab' => 'my-playmates']) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '"><i class="fa fa-pen"></i>Include Playmates</a><div class="dropdown-divider"></div>';
                }
                if($item->latestActivePinup){
                    $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-id="' . $item->id . '"  data-toggle="modal" data-target="#pinupSummary"><i class="fa fa-hand-pointer" aria-hidden="true"></i>Pin Up Summary</a><div class="dropdown-divider"></div>';
                }
                $item->action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('profile.description', $item->id) . '?brb='.$itemArray['brb'][0]['id'].'" data-id="' . $item->id . '"><i class="fa fa-eye"></i>View Profile</a></div>';
                $item->action .= '</div></div>';
            }

            if($item->latestActivePinup){
                $item->pro_name .= '<sup class="pinup_icon listing-tag-tooltip ml-1">Pin Up
                <small class="listing-tag-tooltip-desc">Pinup from ' . date("d-m-Y", strtotime($item->latestActivePinup->start_date)) . " to ".date("d-m-Y", strtotime($item->latestActivePinup->end_date)).'</small>
                </sup>';
            }

            if(!empty($item->activeUpcomingSuspend)){
                $item->pro_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">SUS
                <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($item->activeUpcomingSuspend->start_date)) . " to ".date("d-m-Y", strtotime($item->activeUpcomingSuspend->end_date)).'</small>
                </sup>';
            }
            
            if($isExtended->count){
                $item->pro_name .= '<sup class="extend_icon listing-tag-tooltip ml-1">Extended
                <small class="listing-tag-tooltip-desc">Extended from ' . date("d-m-Y", strtotime($isExtended->data->start_date)) . " to ".date("d-m-Y", strtotime($isExtended->data->end_date)).'</small>
                </sup>';
            }
            
            if($playmates){
                $item->pro_name .= '<sup class="playmate_icon listing-tag-tooltip ml-1">'.$playmates;
                $item->pro_name .= $playmates == 1 ? ' Playmate':' Playmates';
                $item->pro_name .= '</sup>';
            }

            if($item->mainPurchase && $item->mainPurchase->tour_location_id!=null){
                $item->pro_name .= '<sup class="tour_icon listing-tag-tooltip ml-1">Tour
                <small class="listing-tag-tooltip-desc">Listed from ' . date("d-m-Y", strtotime($item->start_date)) . " to ".date("d-m-Y", strtotime($item->end_date)).'</small>
                </sup>';
                $item->tour = true;
            }
            $item->start_date_formatted = $item->start_date_formatted;
            $item->end_date_formatted = $item->end_date_formatted;
            $item->pro_name .= '</span>';
            $i++;
        }

        return $result;
    }
    protected function modifyProperties($result, $start)
    {
        $i = 1;
        foreach ($result as $key => $item) {
            $s = explode('/', $_SERVER['REQUEST_URI']);
            $item->sn = $i + $start;
            $item->key = $i + $start;
            $item->profile_name = $item->profile_name ? $item->profile_name : "NA";
            $item->name = $item->name ? $item->name : "NA";
            $item->enabled = $item->enabled ?  "Active" : "Inactive";
            $item->status = $item->status ?  "published" : "Draft";
            $item->gender;
            $item->membership = $item->membership ? $item->membershipType : null;
            $item->city_name = $item->city ? $item->city->name : null;
            $item->created_by_date = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y') : null;
            // $item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../escort-profile/' . $item->id . '" data-id="' . $item->id . '"> View Profile</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="profile/' . $item->id . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-id="' . $item->id . '" data-name="' . $item->name . '"  data-city="' . ($item->city ? $item->city->name : null) . '" data-url="playmates/' . $item->id . '" data-toggle="modal" data-target="#play-mates-modal">Playmates</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/' . $item->id . '" data-id="' . $item->id . '">Delete </a> <div class="dropdown-divider"></div></div></div>';
            $i++;
        }

        return $result;
    }
    protected function modifyPropertiesforArchives($result, $start)
    {   //dd($result);
        foreach ($result as $key => $item) {
            $s = explode('/', $_SERVER['REQUEST_URI']);
            $item->key = $key + 1 + $start;
            $item->profile_name = $item->profile_name ? $item->profile_name : "NA";
            $item->created_by_date = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y') : null;
            //dd( $item->membershipType);
            $item->membership = $item->membership ? $item->membershipType : null;

            $item->enabled = $item->enabled ? "<span class='text-success'>Active</span>" : "Inactive";
            // $item->country_code = $item->state->country_code;

            $item->status = $item->enabled ? "published" : "Draft";
            $item->action = '<div class="dropdown no-arrow show archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="../profile/' . $item->id . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>
            <a class="dropdown-item delete-center" href="delete-profile/' . $item->id . '" data-id="' . $item->id . '">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>

          </div>
        </div>';
        }
        //dd($result);
        return $result;
    }
    protected function paginateWithCondition($query)
    {
        $result = $query->where('user_id', auth()->user()->id);
        return $result;
    }
    public function FindByUsers($id)
    {
        $result = $this->model->where('user_id', $id)->get();
        return $result;
    }

    public function findProfiles($str = [], $user_id = null, $escort_id = [], $userId = null, $gen = null)
    {
        $str['enabled'] = '1';
        $str['membership'] = '1';
        $gold = $this->filter($this->model, $str, $user_id, $escort_id, $userId, $gen)->get();
        $str['membership'] = '2';
        $silver = $this->filter($this->model, $str, $user_id, $escort_id, $userId, $gen)->get();
        $str['membership'] = '3';
        $platinum = $this->filter($this->model, $str, $user_id, $escort_id, $userId, $gen)->get();
        $merged = $gold->concat($silver)->concat($platinum);
        return $merged;
    }

    public function findByPlan($count = null, $str = [], $user_id = null, $escort_id = [], $userId = null, $gen = null)
    {
        $profileDetails = false;
        if ($gen == 'profile_details') {
            $profileDetails = true;
            $gen = null;
        }


        $plan_type = $this->filter($this->model, $str, $user_id, $escort_id, $userId, $gen);
        // dd($plan_type->get());

        if ($user_id) {
            $plan_type = $plan_type->whereHas('shortListed', function ($q) use ($user_id) {
                $q->where('add_to_list.user_id', $user_id);
            });
        }

        if (!empty($escort_id)) {
            $plan_type = $plan_type
                ->whereIn('id', $escort_id);
        }


        $plan_type = $plan_type->whereHas('user', function ($q) use ($userId) {

            //$q->whereIn('plan_type', [1, 2, 3, 4]);
            if (!empty($userId)) {

                $q->where('id', $userId);
            }
            $q->orderBy('plan_type', 'asc');
        })
            ->with('user')
            // ->orderBy('membership', 'asc')
            ->orderBy('id', 'asc')
            ->paginate($count);
        // ->paginate($count ?? 25);
        //dd($plan_type);
        $collection = $plan_type->getCollection();

        $collection = $collection->map(function ($item, $key) {
            //dd($item);
            # get star rating on the bases on like and unlike
            $total = EscortLike::where('escort_id', $item->id)->count();
            if ($total > 0) {
                $likeCount = EscortLike::where('like', 1)->where('escort_id', $item->id)->count();
                $dislikeCount = EscortLike::where('like', 0)->where('escort_id', $item->id)->count();
                $lp = round($likeCount / $total * 100);
                $dp = round($dislikeCount / $total * 100);
            } else {
                $lp = 0;
                $dp = 0;
            }



            if ($lp == 100) {
                $item->star_rating = 5;
            } elseif ($lp < 100 && $lp > 80) {
                $item->star_rating = 4;
            } elseif ($lp <= 80 && $lp > 60) {
                $item->star_rating = 3;
            } elseif ($lp <= 60 && $lp > 40) {
                $item->star_rating = 2;
            } elseif ($lp <= 40 && $lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
            //$item->star_rating = $lp;
            return $item;
        })->collect();

        // dd($collection);

        $collection = $collection->groupBy(['user' => function ($item) {
            return $item->membership;
        }], $preserveKeys = true)->sortKeys();


        if ($profileDetails) {
            return  $collection->flatten(1);
        }



        $collection = $collection->map(function ($item, $key) {
            return $item;
        })->collect();

        //dd($collection);
        $pagination = $plan_type->setCollection($collection);
        return $pagination;
    }
    public function findByMyShortlist($count = null, $str = [], $user_id = null, $escort_id = [], $userId = null, $gen = null)
    {
        $plan_type = $this->filter($this->model, $str, $user_id, $escort_id, $userId, $gen);
        if ($user_id) {
            $plan_type = $plan_type->whereHas('shortListed', function ($q) use ($user_id) {
                $q->where('add_to_list.user_id', $user_id);
            });
        }

        $pagination = $plan_type->paginate($count ?? 50);



        return $pagination;
    }

    public function filter($collection, $str = [], $user_id, $escort_id, $userId, $gen)
    {
        $age[] = explode('-', $str['age']);
        if (!empty($str['age'])) {
            $age_min = $age[0][0];
            $age_max = $age[0][1];
        }


        $mytime = Carbon::now()->format('d-m-Y');

        $collection = $collection
            ->where('enabled', 1)->with('reviews');
        if (!empty($gen)) {
            $collection = $collection->where('gender', '=', $gen);
            //->orWhere('name','LIKE','%'.$str)
        }

        if (!empty($escort_id)) {
            $collection = $collection
                ->whereIn('id', $escort_id);
        }


        if (!empty($str['duration_price'])) {

            $duration_price = $str['duration_price'];

            $collection = $collection->where(function ($q) use ($duration_price) {
                $q->whereHas('durations', function ($q) use ($duration_price) {

                    //$q->with('pivot');
                    if ($duration_price == "incall_price") {
                        $q->Where('incall_price', '!=', null);
                    }
                    if ($duration_price == "outcall_price") {
                        $q->Where('outcall_price', '!=', null);
                    }
                    if ($duration_price == "massage_price") {
                        $q->Where('massage_price', '!=', null);
                    }
                });
            });
            //    dd($collection->get());
        }

        if (!empty($str['string'])) {
            $uid = $str['string'];
            $collection = $collection->where(function ($q) use ($uid) {
                $q->orWhere('name', $uid);
                $q->orWhere(function ($q) use ($uid) {
                    $q->whereHas('user', function ($q) use ($uid) {

                        $q->where('member_id', $uid);
                    });
                });
            });
        }

        // dd($collection->get());
        if (!empty($str['state_id'])) {
            $collection = $collection->where('state_id', $str['state_id']);
        }

        if (!empty($str['city_id'])) {
            $collection = $collection->where('city_id', '=', $str['city_id']);
        }

        if (isset($str['interest']) && $str['interest'] != null) // $params['interest']
        {
            $collection = $collection->whereIn('gender', json_decode($str['interest']));
        }

        if ($str['gender'] != null) {

            $collection = $collection->where('gender', '=', $str['gender']);
            //->orWhere('name','LIKE','%'.$str)
        }

        if (!empty($str['age'])) {

            $collection = $collection->whereBetween('age', [$age_min, $age_max]);
            //->orWhere('name','LIKE','%'.$str)
        }
        if (!empty($str['enabled'])/* && $str['enabled'] == 1*/) {
            $collection = $collection->where('enabled', $str['enabled']);
        } else {
            //$collection = $collection->where('enabled', 0);
        }
        if ($price = $str['price']) {
            $collection = $collection->whereHas('services', function ($q) use ($price) {
                if ($price <= 500) {
                    $q->where('price', '<=', $price);
                } else {
                    $q->where('price', '>', 500);
                }
            });
        }

        if ($services = $str['services']) {
            $collection = $collection->whereHas('services', function ($q) use ($services) {
                $q->whereIn('services.id', $services);
            });
        }

        return $collection;
    }
    public function findByMassageCentre($count = null, $str = null)
    {
        //dd($str['gender']);
        //dd($str['string']);
        $age[] = explode('-', $str['age']);
        //dd($age);
        if (!empty($str['age'])) {
            $age_min = $age[0][0];
            $age_max = $age[0][1];
        }


        $e4u = substr($str['string'], 0, 5);
        $userId = "";
        if ($e4u == "E4U20") {
            $userId = substr($str['string'], 5, 6);
            $str['string'] = "";
        }
        $play_type = $this->model->where('enabled', 1);


        if (!empty($str['string'])) {
            $play_type = $play_type->where('name', 'LIKE', "%$str[string]%");
            //->orWhere('name','LIKE','%'.$str)
        }

        if (!empty($str['city_id'])) {
            $play_type = $play_type->where('city_id', '=', $str['city_id']);
            //->orWhere('name','LIKE','%'.$str)
        }
        if ($str['gender'] != null) {

            $play_type = $play_type->where('gender', '=', $str['gender']);
            //->orWhere('name','LIKE','%'.$str)
        }
        if (!empty($str['age'])) {

            $play_type = $play_type->whereBetween('age', [$age_min, $age_max]);
            //->orWhere('name','LIKE','%'.$str)
        }

        if ($price = $str['price']) {
            $play_type = $play_type->whereHas('services', function ($q) use ($price) {
                if ($price <= 500) {
                    $q->where('price', '<=', $price);
                } else {
                    $q->where('price', '>', 500);
                }
            });
        }

        if ($services = $str['services']) {
            $play_type = $play_type->whereHas('services', function ($q) use ($services) {
                $q->whereIn('services.id', $services);
            });
        }

        $play_type = $play_type->whereHas('user', function ($q) use ($userId) {

            //$q->whereIn('plan_type', [1, 2, 3, 4]);
            if (!empty($userId)) {

                $q->where('id', $userId);
            }
            $q->orderBy('plan_type', 'asc');
        })
            ->with('user')
            ->orderBy('membership', 'asc')
            ->paginate($count ?? 50);

        $pagination = $play_type;

        return $pagination;
    }

    public function escortCity($str)
    {
        $city = $this->model
            ->whereHas('city', function ($q) use ($str) {
                $q->where('name', 'LIKE', "%{$str}%");
            })
            ->get();

        return $city;
    }

    public function escortsForPlaymates($user_id, $str)
    {
        //dd($str);
        $mates = $this->model
            ->where('name', 'LIKE', '%' . $str . '%')
            ->where('enabled', '=', 1)
            //                    ->where('playmate','=','Y')
            //->with(['city:id,name'])
            ->where(function ($query) use ($user_id) {
                //$query->where('name', 'LIKE', "%{$str}%")
                //->where('id', '!=', $escort_id)
                $query->whereHas('user', function ($q) use ($user_id) {
                    $q->where('id', '!=', $user_id)
                        ->where('available_playmate', 1);
                });
            })
            ->orWhere(function ($query) use ($str) {
                //$query->where('name', 'LIKE', "%{$str}%")
                //->where('id', '!=', $escort_id)
                $query->whereHas('user', function ($q) use ($str) {
                    $q->where('member_id', $str);
                });
            })
            ->whereNotNull('name')
            ->whereNotIn('id', function ($q) use ($user_id) {
                $q->select('playmate_id')
                    ->from('playmates')
                    ->where('user_id', $user_id);
            })

            ->get()->append(['default_image', 'member_id']);

        return $mates;
    }
    public function escortsForPlaymates__bkup($user_id, $str)
    {
        $users = $this->user->find($user_id);
        //dd($users);
        $user_id = $escort->user_id;

        $mates = $this->model
            //->with(['city:id,name'])
            ->whereNotIn('id', function ($q) use ($escort_id) {
                $q->select('playmate_id')
                    ->from('playmates')
                    ->where('escort_id', $escort_id);
            })
            ->where(function ($query) use ($user_id, $escort_id) {
                //$query->where('name', 'LIKE', "%{$str}%")
                //->where('id', '!=', $escort_id)
                $query->whereHas('user', function ($q) use ($user_id) {
                    $q->where('id', '!=', $user_id)
                        ->where('available_playmate', 1);
                });
            })

            ->get()->append(['default_image', 'member_id']);

        return $mates;
    }

    public function updateOrCreate(array $input, $user_id, $default_setting)
    {
        $result = $this->model->where('user_id', $user_id)
            ->where('default_setting', $default_setting)
            ->first();
        //dd($result);
        return ! $result ? $this->create($input) : $result->update($input);
    }
    public function findDefault($user_id, $default_setting)
    {
        $result = $this->model->where('user_id', $user_id)
            ->where('default_setting', $default_setting)
            ->first();
        return  $result;
    }
    public function findandfill() {}

    public function latest()
    {
        $result = $this->model->latest()->first();
        return  $result;
    }

    public function getExpiringListings($startDays = 0, $endDays = 0, $login=false)
    {
        $startDate = Carbon::now()->addDays($startDays)->startOfDay();
        $endDate = Carbon::now()->addDays($endDays)->endOfDay();
        if($login){
            return $this->model
            ->where('enabled', 1)
            ->where('user_id', auth()->id())
            ->whereBetween('utc_end_time', [$startDate, $endDate])
            ->whereDoesntHave('mainPurchase', function ($query) {
                $query->whereNotNull('tour_location_id');
            })
            ->whereHas('purchase', function ($query) {
                $query->where('utc_end_time', '>', Carbon::now());
            }, '<', 2)
            ->get();
        }
        else{
            return $this->model
            ->where('enabled', 1)
            ->whereBetween('utc_end_time', [$startDate, $endDate])
            ->whereDoesntHave('mainPurchase', function ($query) {
                $query->whereNotNull('tour_location_id');
            })
            ->whereHas('purchase', function ($query) {
                $query->where('utc_end_time', '>', Carbon::now());
            }, '<', 2)
            ->get();
        }
    }
}
