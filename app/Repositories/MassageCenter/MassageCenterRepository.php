<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepository;
use App\Models\MassageProfile;
use App\Models\User;
use App\Repositories\MassageCenter\MassageCenterInterface;
use App\Traits\DataTablePagination;
use Carbon\Carbon;

class MassageCenterRepository extends BaseRepository implements MassageCenterInterface
{
    use DataTablePagination;
    protected $massage;
    protected $user;

    public function __construct(MassageProfile $massage, User $user)
    {
        $this->model = $massage;
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


    public function paginatedByMassageId($start, $limit, $order_key, $dir, $columns, $search = null, $escort_id, $stateId = null)
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

    protected function modifyEscorts($result, $start)
    {
        $i = 1;
        foreach ($result as $key => $item) {
            $playmates = $item->playmates->count();
            $s = explode('/', $_SERVER['REQUEST_URI']);
            $item->sn = ($start + $i);
            $item->name = $item->name ? $item->name : "NA";
            $item->member_id = $item->user->member_id;
            $item->days_number = $item->days_number;
            $item->days_left = $item->days_left;
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

    protected function getOrder(int $key)
	{
		$columns = $this->getColumns();
		return $columns[$key];
	}

	protected function getColumns()
	{

		return Schema::getColumnListing($this->model->getTable());
	}


}
