<div class="profile_list"><i class="fa fa-user" aria-hidden="true"></i> <span class="profile_label">Profile Name</span> {{$item->profile_name }}


</div>
<div class="profile_list">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    <span class="profile_label">Location</span>
    {{$item->state ? $item->state->name : null}}
</div>

{{-- tags --}}

<div style="margin-top:8px">
    <span>
        @if($currentPurchase && $currentPurchase->tour_location_id != null)
        <sup class="tour_icon listing-tag-tooltip mr-1">Tour
            <small class="listing-tag-tooltip-desc">Listed from {{$item->start_date->format('d-m-Y')}} to {{$item->end_date->format('d-m-Y')}}</small>
        </sup>
        @endif

        @if($item->latestActivePinup)
        <sup class="pinup_icon listing-tag-tooltip mr-1">Pin Up
            <small class="listing-tag-tooltip-desc">Pin Up from {{date("d-m-Y", strtotime($item->latestActivePinup->start_date))}} to {{date("d-m-Y", strtotime($item->latestActivePinup->end_date))}}</small>
        </sup>
        @endif

        @if($currentPurchase && $currentPurchase->parent_id > 0)
        <sup class="upgrade_icon listing-tag-tooltip mr-1">Upgraded
            <small class="listing-tag-tooltip-desc">Upgraded from {{$currentPurchase->previous_membership_type}} to {{$currentPurchase->membership_type}} on {{getEscortLocalTime($item->updated_at, $item->time_zone)->format('d-m-Y')}}</small>
        </sup>
        @endif

        @if($isExtended->count)
        <sup class="extend_icon listing-tag-tooltip mr-1">Extended
            <small class="listing-tag-tooltip-desc">Extended from {{date("d-m-Y", strtotime($isExtended->data->start_date))}} to {{date("d-m-Y", strtotime($isExtended->data->end_date))}}</small>
        </sup>
        @endif

        @if($item->is_bumpup)
        <sup class="bumpup_icon listing-tag-tooltip mr-1">Bumped Up
            <small class="listing-tag-tooltip-desc">From {{getEscortLocalTime($isBumpUped->utc_start_time, $localTimeZone)->format('d-m-Y h:i A')}} to {{getEscortLocalTime($isBumpUped->utc_end_time, $localTimeZone)->format('d-m-Y h:i A')}}</small>
        </sup>
        @endif

        @if (!empty($currentPurchase->activeUpcomingSuspend) || $item->user->status == "Suspended")
        @if ($item->user->status == "Suspended")
        <sup class="suspend_icon listing-tag-tooltip mr-1">Suspended
            <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
        </sup>
        @else
        <sup class="suspend_icon listing-tag-tooltip mr-1">Suspended
            <small class="listing-tag-tooltip-desc">Suspend from {{date("d-m-Y", strtotime($currentPurchase->activeUpcomingSuspend->start_date))}} to {{date("d-m-Y", strtotime($currentPurchase->activeUpcomingSuspend->end_date))}}</small>
        </sup>
        @endif
        @endif

        @if($itemArray['brb'])
        <sup class='brb_icon listing-tag-tooltip mr-1'>BRB <small class='listing-tag-tooltip-desc'>Brb {{date('d-m-Y h:i A', strtotime($itemArray['brb'][0]['selected_time']))}}</small></sup>
        @endif
    </span>

</div>