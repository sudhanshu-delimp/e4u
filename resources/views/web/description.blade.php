@extends('layouts.web')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/lightbox/css/glightbox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/lightbox/css/lightbox.css') }}">
<style>
<style>
.tooltip-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
  }

  .let-talk-about{
    border: none;
  }
 
  .tooltip-wrapper .tooltip-text {
    visibility: hidden;
    background-color: #ff3c5f;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    font-size: 12px;
    padding: 2px 5px;
    position: absolute;
    z-index: 1;
    bottom: 110%; /* tooltip upar show ho */
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s;
  }
 
  /* Tooltip arrow */
  .tooltip-wrapper .tooltip-text::after {
    content: "";
    position: absolute;
    top: 100%; /* tooltip box ke bottom se */
    left: 50%;
    transform: translateX(-50%);
    border-width: 5px;
    border-style: solid;
    border-color: #ff3c5f transparent transparent transparent; /* top arrow */
  }
 
  .tooltip-wrapper:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }

.fa-thumbs-down, .fa-thumbs-up {
    pointer-events: none;
}

.save-my-legbox-btn {
         color: #fff;
    }

 .swal2-popup{
            width: auto !important;
        }

</style>


@if($escort->latestActiveBrb)
 <style>
    .overlay_parent {
        position: relative;
    }
    .overlay {
        position: absolute;
        background-color: #ff000026;
        width: 102%;
        margin-left: -1%;
        height: 101%;
        z-index: 1;
        border-radius: 20px;
        text-align: center;
    }
    .swal2-popup{
            width: auto !important;
        }
</style> 
@endif

@if(str_contains(url()->full(), '?no-next-page') || str_contains(url()->full(), '?no-next-page='))
    <style>
        .nextDisableButtonCss {
            background: gray;
            opacity: 0.2;
            cursor: not-allowed;
        }

        .nextDisableButtonCss a {
            cursor: not-allowed;
        }
    </style>
@endif

@if(str_contains(url()->full(), '?no-prev-page') || str_contains(url()->full(), '?no-prev-page='))
    <style>
        .previousDisableButtonCss {
            background: gray;
            opacity: 0.2;
            cursor: not-allowed;
        }

        .previousDisableButtonCss a {
            cursor: not-allowed;
        }
    </style>
@endif

@php
    $escortName = ($escort->gender == 'Transgender') ? 'TS-' . $escort->name : $escort->name;
@endphp

    
    <div class="profile_description_banner">
        <div class="back_to_list">
            {{-- back to search --}}
                @php

                if (str_contains($backToSearchButton, 'view=')) {
                        $finalUrl = preg_replace('/view=[^&]*/', 'view=' . $viewType, $backToSearchButton);
                    } else {
                        // If view param not present, append it properly
                        $separator = str_contains($backToSearchButton, '?') ? '&' : '?';
                        $finalUrl = $backToSearchButton . $separator . 'view=' . $viewType;
                    }
                    
                @endphp
                
                    <a href="{{ $finalUrl }}" class="back--search"> 
                        <span class="previous_icon">
                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <g opacity="0.4"> <path d="M9.00039 15.3802H13.9204C15.6204 15.3802 17.0004 14.0002 17.0004 12.3002C17.0004 10.6002 15.6204 9.22021 13.9204 9.22021H7.15039" stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                        </span> <span class="hide_ph">Back to Search</span>
                    </a>
                
            {{-- end --}}
        </div>
        <div class="container profile_pic_holder custom--profile"  style="background-color: #ff3c5f; background: url({{ $escort->imagePosition(9) ? asset($escort->imagePosition(9)) : asset('assets/app/img/profiledescrition.png')}}); background-repeat: no-repeat; background-size: cover;background-position:center;">
           
            <div class="row">
                <div class="col-12 p-0">

                    {{-- brb banner --}}
                    <div class="new_brb-banner">
                        @if($escort->latestActiveBrb)
                            <div class="brb_details">
                                <h1>BRB at {{date('h:i A d-m-Y',strtotime($escort->latestActiveBrb->selected_time) )}}</h1>
                                <h3>{{$escort->latestActiveBrb->brb_note}}</h3>
                            </div>
                        @endif
                    </div>
                    {{-- end brb --}}
                    <div class="profile_wrap p-3 position-relative">
                        <div class="profile_header">
                            
                            {{-- title --}}
                            <div class="profile_page_title">
                                @php 
                                $isPinupActive = $escort->currentActivePinup;
                                $membershipImage = match ($escort->membership) {
                                    '1' => $isPinupActive?asset('images/platinum_membership_pin.png'):asset('images/platinum_membership.png'),
                                    '2' => $isPinupActive?asset('images/gold_membership_pin.png'): asset('images/gold_membership.png'),
                                    '3' => $isPinupActive?asset('images/silver_membership_pin.png'):asset('images/silver_membership.png'),
                                    default => false
                                };


                                if($escort->gender =='Transgender')
                                {
                                        $escortName = 'TS-'.$escort->name;
                                }
                                else
                                {
                                        $escortName =  $escort->name;
                                }
                                

                                @endphp

                                @if($membershipImage)
                                <div class="{{($isPinupActive)?'pinup-wrapper':''}} member_type">
                                        <img src="{{ $membershipImage }}">
                                        <div class="pinup-tooltip">I am your Pin Up this week!</div>
                                </div> 
                                @endif

                                @if(strlen($escortName) <= 250)
                                    <h2 class="display_inline_block">  {{ $escortName }}</h2>
                                @else
                                    <h3 class="display_inline_block" style="color: white;">{{ $escortName }}</h3>
                                @endif
                            </div>
                            
                        </div>
                        {{-- profile phone --}}
                        <div class="profile_page_name_and_phno">
                            <p>{{$escort->city->name}} - {{  $escort->phone }}</p>                    
                        </div>
                        {{-- address --}}
                        <div class="profile_page_location_and_id mb-4">
                            <ul>
                                <li>
                                    <span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <p class="display_inline_block ">{{ $escort->address}}</p>
                                </li>
                            </ul>
                        </div>
                        {{-- address --}}
                        <div class="social_media_profile mt-3">                           

                            <div class="d-flex align-items-center justify-content-start">
                                <div class="d-flex align-items-center justify-content-start">
                                <div class="my-play-box-profile-icon">
                                    <a href="{{ url('playbox') }}" target="_blank">
                                        <img src="{{ asset('assets/app/img/MyPlaybox.png') }}" alt="My Playbox Icon">
                                    </a>
                                    <div class="custom-tooltip">I don't have any Playbox.</div>
                                </div>
                                @if(isset($escort->mainPurchase) && $escort->mainPurchase->tour_location_id!=null)
                                    <div class="my-play-box-profile-icon">
                                        <a href="#">
                                            <img src="{{ asset('assets/app/img/icon_tour_white.png') }}" alt="My Playbox Icon">
                                        </a>
                                        <div class="custom-tooltip">{{$escort->left_listing_days > 0 ? "On Tour, {$escort->left_listing_days} days left.":"On Tour, today is my last day."}}</div>
                                    </div>
                                @endif
                            </div>

                                <ul class="profile_page_social_profiles">
                            
                                    @if(!empty($escort->user->profile_creator) && in_array(3,$escort->user->profile_creator))
                                        @if($escort->user->social_links && $escort->user->social_links['facebook'] !== null)
                                            <li class="selected-from-profile">
                                                <a href="{{ ($escort->user->social_links && $escort->user->social_links['facebook'] != '') ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}" target="_blank">
                                                <img src="{{asset('assets/app/img/facebook.png')}}" class="twitter-x-logo" alt="logo"></a>
                                            </li>
                                        @endif
                                        @if($escort->user->social_links && $escort->user->social_links['insta'] !== null)
                                            <li class="selected-from-profile"><a href="{{ ($escort->user->social_links && $escort->user->social_links['insta'] != '') ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}" target="_blank"><img src="{{asset('assets/app/img/instagram.png')}}" class="twitter-x-logo" alt="logo"></a></li>
                                        @endif
                                        @if($escort->user->social_links && $escort->user->social_links['twitter'] !== null)
                                            <li class="selected-from-profile"><a href="{{ ($escort->user->social_links && $escort->user->social_links['twitter'] != '') ? $escort->user->social_links['twitter'] : 'https://x.com/' }}" target="_blank"><img src="{{asset('assets/app/img/twitter-x.png')}}" class="twitter-x-logo" alt="logo"></a></li>
                                        @else
                                            <li class="by-default"><a href="https://x.com/NMugs32853" target="_blank"><img src="{{asset('assets/app/img/twitter-x.png')}}" class="twitter-x-logo" alt="logo" ></a></li>
                                        @endif
                                    @else
                                        <li class="by-default"><a href="https://x.com/NMugs32853" target="_blank"><img src="{{asset('assets/app/img/twitter-x.png')}}" class="twitter-x-logo" alt="logo" ></a></li>
                                    @endif
                                </ul>
                            </div>

                            <div class="profile_page_location_and_id">
                                <ul>
                                    <li>
                                        <span class="profile_location_icon"> <i class="fa fa-id-card"></i></span>
                                        <p class="display_inline_block ">Member ID: {{ $escort->member_id}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!--- Pagination btn -->
    <div class="container-fluid px-0 next-preview-fixed position-relative">
        <div class="d-flex d-flex justify-content-between">
            <div class="previous_btn_profile next_previous_btn_pogision  previousDisableButtonCss">
                <a href="{{ str_contains(url()->full(), '?no-prev-page=') ? '#' : $previous}}" class="btn_ank">
                <span class="previous_icon">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M13.2602 15.5302L9.74023 12.0002L13.2602 8.47021" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </span>
                <span class="previous_text remove_in_sm">Previous</span>
                </a>
            </div>
            
            <div class="next_btn_profile next_previous_btn_pogision nextDisableButtonCss" >
                <a href="{{ str_contains(url()->full(), '?no-next-page=') ? '#' : $next}}" class="btn_ank">
                <span class="previous_text remove_in_sm">Next</span>
                <span class="previous_icon">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M10.7402 15.5302L14.2602 12.0002L10.7402 8.47021" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </span>
                </a>
            </div>
        </div>
    </div> 
    <!---! end -->
    <!--- profile Detials -->
    <div class="container profile_contain">
        <div class="row">
            <!--- col-8 -->        
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 col-12">
                <div class="row mb-3">
                    <div class="col-md-12 col-xl-12 col-sm-12 col-12">
                        <div class="row mess_row">
                            <div class="col-sm-12 d-flex align-items-center justify-content-between flex-wrap ">
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                        <p class="mc_rate_tooltip">You come to me.</p>
                                    </div>
                                
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                            @php  
                                            $massage_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price:0;
                                            @endphp
                                            {{ $massage_price ? '$'. number_format($massage_price).'/hr' : 'N/A' }}
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                        <p class="mc_rate_tooltip">You come to me.</p>
                                    </div>
                                
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Incalls</h4>
                                        </div>
                                        <div class="profile_hr">

                                        <h4>
                                        @php  
                                        $incall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->incall_price:0;
                                        @endphp
                                        {{ $incall_price ? '$'. number_format($incall_price).'/hr' : 'N/A' }}
                                        </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    
                                    <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                        <p class="mc_rate_tooltip">I come to you.</p>
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Outcalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                            @php  
                                            $outcall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price:0;
                                            @endphp
                                            {{ $outcall_price ? '$'. number_format($outcall_price).'/hr' : 'N/A' }}
                                            </h4>
                                        
                                        </div>
                                    </div>
                                </div>
                                {{-- button --}}
                                <button type="button" class="btn my_legbox all_btn_flx" id="legbox_btn">
                                    @if(auth()->user())
                                        @if(auth()->user()->type == 0)
                                            <span class="add_to_favrate @if(is_object($user_type) && in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif"
                                                id="legboxId_{{$escort->id}}" data-escortId="{{$escort->id}}"
                                                data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                                                @if(!empty($user_type))
                                                    @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                                                        <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                                    @else
                                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    @endif
                                                @endif
                                            </span>
                                        @else
                                            <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                        @endif
                                        @else
                                            <span class="add_to_favrate" data-escortId="{{$escort->id}}"
                                                data-name="{{$escort->name}}"><i class="fa fa-heart-o"
                                                                                aria-hidden="true"></i></span>
                                        @endif
                                        <span class="label save-my-legbox-btn">
                                            @if(is_object($user_type) && in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'Remove from Legbox'}}@else{{'Save to My Legbox'}}@endif
                                        </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-2 table-responsive-lg">
                        <table class="table table_striped">
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th scope="col">Service</th>
                                    <th scope="col">Massage</th>
                                    <th scope="col">Incalls</th>
                                    <th scope="col">Outcalls</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($escort->durations))
                                @foreach($escort->durations as $key => $duration)
                                <tr>
                                    <td>{{ $duration->name }}</td>
                                    <td>
                                        @if($duration->name == 'Blow & Go')  
                                        @else
                                            {!! ($duration->pivot->massage_price)
                                                ? "<div class='public-num-value-table'><span>$ </span>" . number_format($duration->pivot->massage_price) . "</div>"
                                                : "<span class='if_data_not_available'>N/A</span>" !!}
                                        @endif
                                    </td>
                                    </td>
                                    <td>{!! ($duration->pivot->incall_price) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($duration->pivot->incall_price) . "</div>" : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{!! ($duration->pivot->outcall_price) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($duration->pivot->outcall_price) . "</div>" : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            
                            </tbody>
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS):
                                        {{ config("escorts.profile.Payments.$escort->payment_type") }}
                                    </th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <div class="col-lg-6 col-md-12 table-width-dk">
                        <table class="table table_striped mb-0">
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th class="text-center" scope="col">Arriving</th>
                                    <th class="text-center" scope="col">Departing</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{Carbon\Carbon::parse($escort->start_date)->format('d-m-Y')/*->format('jS F Y ')*/ }}</td>
                                    <td class="text-center">{{Carbon\Carbon::parse($escort->end_date)->format('d-m-Y')/*->format('jS F Y ')*/}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table_striped custom-day-table">
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $days = [
                                'Monday' => 'monday',
                                'Tuesday' => 'tuesday',
                                'Wednesday' => 'wednesday',
                                'Thursday' => 'thursday',
                                'Friday' => 'friday',
                                'Saturday' => 'saturday',
                                'Sunday' => 'sunday'
                            ];
                            @endphp
                            @foreach($days as $cDay => $day)
                                <tr>
                                    <td>{{$cDay}}</td>
                                    <td>
                                        @if(!empty($availability->availability_time[$day]))
                                        
                                            @if($availability->availability_time[$day] == 'til_ate')

                                            {{ Carbon\Carbon::parse($availability->{$day.'_from'})->format('h:i A') }} ... Til Late
                                            @else
                                                {{ $availability->availability_time[$day]; }} 
                                            @endif
                                            

                                        @elseif(!empty($availability->{$day.'_from'}) && !empty($availability->{$day.'_to'}))
                                            {{ ($availability) ? Carbon\Carbon::parse($availability->{$day.'_from'})->format('h:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->{$day.'_to'})->format('h:i A') : ''}}
                                        @else
                                            Unavailable
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>About me</h2>
                    </div>
                    <div class="padding_20_tob_btm_side">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Gender:</span> <span class="about_box_small_heading_value">{{ $escort->gender}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Body type:</span> <span class="about_box_small_heading_value"> {{ config("escorts.profile.body-type.$escort->body_type")}}</span>
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                    <span class="about_box_small_heading">Age:</span> <span class="about_box_small_heading_value">{{ $escort->age}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Nationality:</span> <span class="about_box_small_heading_value"> {{ ($escort->nationality) ? $escort->nationality->name : ''}}</span>
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Orientation:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.orientation.$escort->orientation") }}</span>
                                </div>
                                
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Ethnicity:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.ethnicities.$escort->ethnicity")}}</span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Available to:</span>
                                    @if(!empty($escort->available_to))
                                    <span class="about_box_small_heading_value"> {{ implode(', ', array_map(fn($item) => config("escorts.profile.available-to.$item"), $escort->available_to)) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Statistics</h2>
                    </div>

                    
                    <div class="padding_20_tob_btm_side">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Height:</span> <span class="about_box_small_heading_value"> {{config("escorts.profile.heights.$escort->height") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Eyes:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.eye-colors.$escort->eyes") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Shaved:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.shaved-type.$escort->shaved") }}</span>
                                </div>

                                @if($escort->getRawOriginal('gender') != 6)
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Endowment:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.endowments.$escort->endowment") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Butt:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.butts.$escort->butt") }}</span>
                                </div>
                                @endif


                                <div class="mb-2">
                                    <span class="about_box_small_heading">Contact me:</span> <span class="about_box_small_heading_value">{{ strtoupper(config("escorts.profile.contact-me.$escort->contact")) }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Hair colour:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-colour.$escort->hair_color") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Skin tone:</span> <span class="about_box_small_heading_value">{{config("escorts.profile.skin-tone.$escort->skin_tone") }}</span>
                                </div>
                                @if($escort->getRawOriginal('gender') != 1)
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Breast:</span> <span class="about_box_small_heading_value">{{ $escort->breast }}</span>
                                </div>
                                @endif
                                @if($escort->getRawOriginal('gender') != 6)
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Thickness:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.thicknesses.$escort->thickness") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Preference:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.preferences.$escort->preference") }}</span>
                                </div>
                                @endif
                                <!-- <div class="mb-2">
                                    <span class="about_box_small_heading">Language:</span>
                                    @if(!empty($escort->language))  @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach @endif
                                    </div> -->
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Hair style:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-style.$escort->hair_style")}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Weight:</span> <span class="about_box_small_heading_value">{{ $escort->weight}} Kgs</span>
                                </div>
                                @if($escort->getRawOriginal('gender') != 1)
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Dress size:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.dress-size.$escort->dress_size")}}</span>
                                </div>
                                @endif
                                @if($escort->getRawOriginal('gender') != 6)
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Circumcised:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.circumcises.$escort->circumcised")}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Hormones:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hormones.$escort->hormones")}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span id="y" class="">Read more&gt;&gt;</span>
                            </div>
                        </div>
                        <div class="hide_data">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Piercing:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.piercing.$escort->piercing") }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Drugs:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.drugs.$escort->drugs") }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Tattoos:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.tattooes.$escort->tattoos") }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Smoke:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.smokes.$escort->smoke") }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                        <span class="about_box_small_heading">Play types:</span>
                                        @if(!empty($escort->play_type))
                                            <span class="about_box_small_heading_value">
                                                {{ implode(', ', array_map(fn($playtype) => config("escorts.profile.play-types.$playtype"), $escort->play_type)) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Payment:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.Payments.$escort->payment_type") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="padding_and_border_for_read_more_section mt-2">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-2">
                                            <span class="about_box_small_heading">Travel:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.travels.$escort->travel") }}</span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-12">
                                        
                                        <div class="mb-2">
                                            <span class="about_box_small_heading">SWA License:</span> <span class="about_box_small_heading_value">{{ $escort->license}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        
                                    <div class="mb-2">
                                            <span class="about_box_small_heading">Languages:</span> @if(!empty($escort->language)) @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="escortId" value="{{auth()->user() ? auth()->user()->id : null}}" id="eid">
                </div>
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Who Am I?</h2>
                    </div>
                    <div class="padding_20_tob_btm_side who-tittle">
                        
                        {!! $escort->about_title !!}
                        
                    </div>
                    <div class="padding_20_tob_btm_side text-justify">
                        {!! $escort->about !!}
                    </div>
                </div>
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>My Service</h2>
                    </div>
                    <div class="padding_20_tob_btm_side">
                        <p class="text-justify">Check out what I enjoy the most with you in private. Let's have some fun. Feel free to ask me any questions about my services.</p>
                        <div class="accordion-container">
                            <div class="set">
                                <a>
                                Fun Stuff - on You
                                <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table table-grid"  style="{{ empty($categoryOneServices) ? ' ' : ''}}">
                                                <div class="padding_none" style="{{ empty($categoryOneServices) ? 'padding: 1px;' : ''}}">
                                                    
                                                    <table class="table {{empty($categoryOneServices[0]) ? '': ' ' }}  ">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryOneServices[0]))
                                                                @foreach($categoryOneServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <td colspan="2" class="let-talk-about">Let's talk about it.</td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="padding_none" style="{{ empty($categoryOneServices[1]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryOneServices[1]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryOneServices[1]))
                                                                @foreach($categoryOneServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            <td colspan="2" style="padding-top: 15px;" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="padding_none" style="{{ empty($categoryOneServices[2]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryOneServices[2]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryOneServices[2]))
                                                                @foreach($categoryOneServices[2] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']). "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <td colspan="2" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="set">
                                <a>
                                Kinky Stuff - on You
                                <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table table-grid" style="{{ empty($categoryTwoServices) ? ' ' : ''}}">
                                                <div class="padding_none" style="{{ empty($categoryTwoServices) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryTwoServices[0]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryTwoServices[0]))
                                                                @foreach($categoryTwoServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>"  . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            <td colspan="2" style="padding-top: 15px;" class="let-talk-about">Let's talk about it.</td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="padding_none" style="{{ empty($categoryTwoServices[1]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryTwoServices[1]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryTwoServices[1]))
                                                                @foreach($categoryTwoServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            <td colspan="2" style="padding-top: 15px;" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="padding_none" style="{{ empty($categoryTwoServices[2]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryTwoServices[2]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryTwoServices[2]))
                                                                @foreach($categoryTwoServices[2] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <td colspan="2" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="set">
                                <a>
                                Fun Stuff - on Me
                                <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table table-grid" style="{{ empty($categoryThreeServices) ? ' ' : ''}}">
                                                <div class=" padding_none" style="{{ empty($categoryThreeServices) ? 'padding: 1px;' : ''}}">
                                                    <table class="table  {{ empty($categoryThreeServices[0]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(!empty($categoryThreeServices[0]))
                                                                @foreach($categoryThreeServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            <td colspan="2" style="padding-top: 15px;" class="let-talk-about">Let's talk about it.</td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class=" padding_none" style="{{ empty($categoryThreeServices[1]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{empty($categoryThreeServices[1]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryThreeServices[1]))
                                                                @foreach($categoryThreeServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            <td colspan="2" style="padding-top: 15px;" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class=" padding_none" style="{{ empty($categoryThreeServices[2]) ? 'padding: 1px;' : ''}}">
                                                    <table class="table {{ empty($categoryThreeServices[2]) ? '': ' ' }}">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col" style="width:75%">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryThreeServices[2]))
                                                                @foreach($categoryThreeServices[2] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "<div class='public-num-value-table'> <span>$ </span>"  . number_format($service['pivot']['price']) . "</div>" : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <td colspan="2" class="let-talk-about"></td>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--- col-4 -->
            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12 profile-sidebar-margin-top">
                <!-- crousal start -->
                <div class="profile_verify_icon ec-slider">                        
                    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">
                            
                            @if($escort->gallary->isNotEmpty())
                            @foreach($escort->gallary()->wherePivot('type',0)->wherePivotIn('position',[1,2,3,4,5,6,7])->get() as $key=>$media)
                            
                                <div class="carousel-item {{($key == 0) ? "active" : ""}} " data-interval="10000">
                            
                                    <div class="row">
                                        <div class="col-12 remove_padding_for_carousel  profile--thumb--sec">
                                            @php $status = $media->varified ?? "0"; @endphp
                                        
                                            <img src="{{ asset($media->path) }}" class="d-block w-100" title=" " alt="..." data-toggle="modal" data-target="#exampleModal" data-id="{{$media->id}}">
                                            <a href="" class="custom-tooltip text-decoration-none text-white" data-toggle="modal" data-target="#exampleModal">Click to view My Media</a>
                                            </div>
                                        </div>
                                        <div class="verify_icon">
                                            @switch($status)
                                                @case(0)
                                                    <img src="{{ asset('assets/app/img/pending_icon/e4u_pending_REV.png')}}">
                                                    <span class="common_shield_tooltip">Media Pending</span>
                                                @break
                                                @case(1)
                                                    <img src="{{ asset('assets/app/img/verify/e4u_verified_REV.png')}}">
                                                    <span class="common_shield_tooltip">Media Verified</span>
                                                @break
                                                @case(2)
                                                    <img src="{{ asset('assets/app/img/verify/unverified_light.png')}}">
                                                    <span class="common_shield_tooltip">Media Unverified</span>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="carousel-item active " data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel profile--thumb--sec">
                                                <img src="{{ asset('assets/app/img/service-provider/Frame-408.png') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                                <div class="custom-tooltip">I don't have any Playbox.</div>
                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- Modal -->
                                    @php 
                                        $galleryVideos = $escort->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();
                                    @endphp
                                    <div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        
                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-between align-items-center">                                       
                                                    <ul class="nav nav-tabs justify-content-center border-0">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="menu1-tab" data-toggle="tab" href="#menu3">My Photos</a>
                                                        </li>
                                                        @if ($galleryVideos->count()>0)
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu4">My Videos</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                    <button type="button" class="p-0" data-dismiss="modal" aria-label="Close">
                                                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="tab-content" id="myTabContent2">
                                                        <div class="tab-pane fade show active" id="menu3" role="tabpanel" aria-labelledby="profile-tab">
                                                        <div id="gallery" class="photos-grid-container gallery">

                                                                @if($escort->gallary->isNotEmpty())

                                                                    @php
                                                                        $allImages = $escort->gallary()
                                                                            ->wherePivot('type',0)
                                                                            ->wherePivotIn('position',[1,2,3,4,5,6,7])
                                                                            ->orderBy('position','asc')
                                                                            ->get();

                                                                        $firstImage = $allImages->first();

                                                                        $displayImages = $allImages->filter(function($item){
                                                                            return in_array($item->pivot->position,[2,3,4,5,6,7]);
                                                                        });
                                                                    @endphp

                                                                    {{-- Main Image (Position 1) --}}
                                                                    <div class="main-photo img-box">

                                                                        @php
                                                                            $item = $escort->gallary()
                                                                                ->wherePivotIn('position',[1])
                                                                                ->first();
                                                                        @endphp

                                                                        @if($item)

                                                                            <a href="{{ asset($item->path) }}"
                                                                            class="glightbox image-wrapper"
                                                                            data-gallery="escort-gallery">

                                                                                <img src="{{ asset($item->path) }}" title="View in large" alt="thumbnail">

                                                                                <div class="hover-overlay">
                                                                                    <span>Click me!</span>
                                                                                </div>
                                                                            </a>

                                                                            @php
                                                                                $media_status = getMediaVerificationDataBigIcon($item->varified ?? 0);
                                                                            @endphp

                                                                            @if($media_status)
                                                                                <div class="verify_icon" style="border-radius: 0px 0px 10px 0px;">
                                                                                    <img src="{{ $media_status['icon'] }}" >
                                                                                    <span class="common_shield_tooltip">
                                                                                        {{ $media_status['label'] }}
                                                                                    </span>
                                                                                </div>
                                                                            @endif
                                                                            
                                                                        @endif
                                                                    
                                                                    </div>

                                                                    <div class="sub">

                                                                        {{-- Images 2,3,4 --}}
                                                                        @foreach($displayImages as $media)

                                                                            <div class="img-box">

                                                                                <a href="{{ asset($media->path) }}"
                                                                                class="glightbox image-wrapper"
                                                                                data-gallery="escort-gallery">

                                                                                    <img src="{{ asset($media->path) }}" alt="others" title="View in large">
                                                                                        <div class="hover-overlay">
                                                                                        <span>Click me!</span>
                                                                                    </div>
                                                                                </a>

                                                                                @php
                                                                                    $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                                                                                @endphp

                                                                                @if($media_status)
                                                                                    <div class="verify_icon_sm">
                                                                                        <img src="{{ $media_status['icon'] }}">
                                                                                        <span class="gallery_shield_tooltip">
                                                                                            {{ $media_status['label'] }}
                                                                                        </span>
                                                                                    </div>
                                                                                @endif

                                                                            </div>

                                                                        @endforeach                                                              

                                                                    </div>
                                                                

                                                                    {{-- Hidden Images For Lightbox Navigation --}}
                                                                    <div style="display:none;">

                                                                        @foreach($allImages as $media)

                                                                            <a href="{{ asset($media->path) }}"
                                                                            class="glightbox"
                                                                            data-gallery="escort-gallery">
                                                                        
                                                                            </a>
                                                                            

                                                                        @endforeach

                                                                    </div>

                                                                @endif

                                                            </div>                      
                                                        </div> 
                                                        
                                                        
                                                        <div class="tab-pane fade" id="menu4" role="tabpanel" aria-labelledby="contact-tab">
                                                            <div class="swiper mySwiper" id="dvSource">
                                                                <div class="swiper-wrapper">
                                                                      @foreach($galleryVideos as $key=>$media)
                                                                        <div class="swiper-slide">
                                                                            <div id="dm_{{ $key }}" class="w-100">
                                                                                <a href="#">
                                                                                    <video style="z-index: 1" controls="" id="videoId_{{ $key }}" src="{{ asset($media->path) }}">
                                                                                        <source src="{{ asset($media->path) }}" type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                      @endforeach
                                                                </div>
                                                                    <div class="swiper-button-next"></div>
                                                                    <div class="swiper-button-prev"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                    </div>
                </div>
                <!-- crousal end -->

                <!-- message btn -->
                <div class="pt-2 eqal-bx">
                    <div class="mess_repo_btn_wrap">
                        <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#mysendmessage">
                        <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="image_20px_msg">Message Me</button>
                        <button type="button" class="btn profile_message_btn_cc" id="reportAdvertiserBtn" data-toggle="modal"><img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="image_20px_msg">Report Advertiser</button>
                    </div>   
                </div>

                <!-- like bar -->
                <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                    <div class="like_img">
                        <i id="dislike" class="{{ $escortLike && $escortLike->like == 0 ? 'fa fa-thumbs-down' : 'fa fa-thumbs-o-down'}} " title="Dislike" aria-hidden="true"></i>
                    <!-- <img class="likeImg" id="dislike" value='0' src="{{ asset('assets/app/img/dislike.png') }}"> -->
                    </div>
                    <div class="process_bar_width like_mjo">
                        <div id="vote_bar" class="progress" style="height: 25px;">
                            @if($lp || $dp)
                            <div class="progress-bar bg-danger progress-bar-stripped" style="width: {{$dp}}%">
                                {{$dp}}%
                            </div>
                            <div class="progress-bar bg-success" style="width: {{$lp}}%;">
                                {{$lp}}%
                            </div>
                            @else
                            <div class="progress-bar" style="width: 100%; background-color: grey;">
                                No votes
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="like_img">
                        {{-- {{ dd($escortLike)}} --}}
                        <i id="like" class="{{ $escortLike && $escortLike->like == 1 ? 'fa fa-thumbs-up' : 'fa fa-thumbs-o-up'}}" title="Like" aria-hidden="true"></i>

                    </div>
                </div>

                <!-- My Playmates-->
                <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="{{ asset('assets/app/img/icon_my-playmates.svg') }}" style="width: 36px">My Playmates</h2>
                    </div>
                    <div class="padding_20_tob_btm_side reduse_pad">
                        @if($escort->playmates->count() > 0 && $escort->activeSuspendProfile->count()==0)
                            <p class="profile_description_contect_pera">Message me to arrange a play date.</p>
                            <div class="d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                
                                @foreach($escort->playmates as $playmate)
                                    @php  
                                        $image = $playmate->gallary()->wherePivot('position', 1)->first();
                                    @endphp
                                    <div>
                                        
                                        <a href="{{ route('profile.description',$playmate->id)}}" target="_blank">
                                            <div class="playmates-pro-container">
                                                <img  alt="playmates Avatar" class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed custom-small-round-fixed" src="{{$image->path ? asset($image->path) : asset('assets/app/img/icons-profile.png') }}">
                                                <div class="custom-tooltip">
                                                    Hi, my name is {{ $playmate->name }}. <br>
                                                    Click to view my Profile.
                                                </div>
                                            </div>
                                        
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                        <p class="profile_description_contect_pera">{{$escortName}} does not have any Playmates.</p>
                        @endif
                    </div>
                </div>
                <!--  Contacting me -->
                <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting me</h2>
                    </div>
                    <div class="padding_20_tob_btm_side reduse_pad">
                        <div class="span_display_block connecting_me_chat_phone">You can contact me by:
                            @php
                                $contactType = $escort->contact != null ? $escort->contact : '';
                            @endphp
                            @if($contactType == 1)
                                <span class="tooltip-wrapper">
                                    <img src="{{ asset('assets/app/img/email-me.png') }}">
                                    <div class="tooltip-text">Email me</div>
                                </span>                              
                            
                            @endif

                            @if($contactType == 4 || $contactType == 5)
                                <span class="tooltip-wrapper">
                                    <img src="{{ asset('assets/app/img/phoneicon.svg') }}">
                                    <div class="tooltip-text">Call me</div>
                                    @if($contactType == 5)
                                        <span>or</span>
                                    @endif
                                </span>
                            @endif
                            @if($contactType == 2 || $contactType == 5)
                                <span class="tooltip-wrapper">
                                        <img src="{{ asset('assets/app/img/wechat.svg') }}">
                                        <div class="tooltip-text">Text me</div>
                                </span>
                            @endif
                        
                        </div> 
                                
                        @php


                            $from = $escort->phone;
                            $number = sprintf("%s-%s-%s",
                            substr($from, 0, 3),
                            substr($from, 3, 3),
                            substr($from, 6));
                            //dd($number);
                        @endphp
                        <p class="font-weight-bold mb-0 mt-2">When texting me please say:</p>
                        <p class="profile_description_contect_pera">
                            <b><i>Hi {{ $escortName }}, I found you on E4U ... </i></b> 
                            @php
                                $formattedNumber = $escort->phone;
                                $contactTypes = $escort->contact != null ? $escort->contact : '';
                            
                            @endphp
                        </p>    
                        <p style="line-height: 1;">
                            @if($contactTypes != '')
                                @if($contactTypes == 1)
                                    on my email {{ $escort->user->email ?? '' }}
                                @elseif($contactTypes == 4 || $contactTypes == 2 || $contactTypes == 5)
                                    on my number {{ $formattedNumber }}.
                                @else
                                    on my number --
                                @endif
                            @else
                                {{-- on my number {{$formattedNumber != '' ? $formattedNumber : '--'}}. --}}
                                on my number --
                            @endif
                        </p>
                    </div>
                </div>
                <!--  vax-btn -->
                <div class="vax-btn">
                    @if($escort->getRawOriginal('covidreport') == 2)
                        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, up to date</button>
                    @elseif($escort->getRawOriginal('covidreport') == 1)
                        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, not up to date</button>
                    @else
                        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vax.svg') }}">Not Vaccinated</button>
                    @endif
                </div>
                <!--  Deposit -->
                <div class="accordion-container-new">
                    <div class="set">
                        <a class="pb-1 pt-1 d-flex align-items-center d-flex justify-content-between">
                            Deposit <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">                        
                            <div class="accodien_manage_padding_content">
                                <p></p>
                                <table class="table text-center table-bordered">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>Incall</th>
                                            <th>Outcall</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center w-50"> @if($escort->incall_enabled)  <div class="public-num-value-table w-50 mx-auto"> <span>$ </span>{{$escort->incall_amount}}</div> @else NO @endif</td>
                                            <td class="text-center w-50"> @if($escort->outcall_enabled)  <div class="public-num-value-table w-50 mx-auto"> <span>$ </span>{{$escort->outcall_amount}}</div> @else NO @endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="set">
                        <a class="pb-1 pt-1 d-flex align-items-center d-flex justify-content-between">
                            My Pricing Policy <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">
                            <div class="accodien_manage_padding_content">
                                <p class="text-justify">
                                    Prices are all inclusive unless an extra is listed in My Services. For Outcalls, price is rate + taxi to and from my Location, and may require a Deposit.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="set">
                        <a class="pb-1 pt-1 d-flex align-items-center d-flex justify-content-between">
                            Disclaimer <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">
                            <div class="accodien_manage_padding_content">
                                <p class="text-justify">Donations are for my companionship and nothing else. It is not an offer or promise for prostitution or illegal activity.
                                    Anything that may occur between us is our choice as consenting adults.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tips -->
                <div class="box_shadow padding_twelve_px">
                    <div class="profile_card_border profile_description_contect position-relative">
                        <h2><img src="{{ asset('assets/app/img/tips.svg') }}">Tips</h2>
                    </div>
                    <div class="pt-2">
                        <div id="tipcrousal" class="carousel slide carousel_remove_in_tip" data-ride="carousel" data-interval="5000">
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="carousel-item tip_carousel_item_text active item-01">
                                    <p>Ask questions and become informed.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Protect your details, use our contact form.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>If it seems to good to be true, it probably is.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Report any suspicious Profiles.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Only meet Advertisers who seem trustworthy.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Trust your instincts.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Avoid using email, use our messaging centre.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Be cautious with external links.</p>
                                </div>
                                <div class="carousel-item tip_carousel_item_text item-01">
                                    <p>Do not offer any of your personal information.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--- Reviews -->
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2 class="custom--review"><img src="/assets/app/img/review-custom.png"> Reviews</h2>
                    </div>
                    @php
                        $reviewAlreadyExist = false;
                        $reviewExistsMessage = '';
                        $reviewExistsStarRating = 0;
                    @endphp
                    @if(count($reviews) > 0)
                        <div class="padding_20_tob_btm_side">
                            <!-- new-review-card -->
                            <div class="review-card mx-auto position-relative">
                                <!-- Carousel -->
                                <div id="reviewCarousel" class="carousel slide carousel-slide pb-0" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        
                                        @foreach($reviews as $key => $review)
                                            @php
                                                if($review->user && auth()->user() && auth()->user()->id == $review->user_id && $review->advertiser_id == $escort->id && $review->advertiser_type=='escort'){
                                                    $reviewAlreadyExist = true;
                                                    $reviewExistsMessage = $review->description;
                                                    $reviewExistsStarRating = $review->star_rating;
                                                }
                                            @endphp
                                            
                                            <div class="carousel-item carousel-custome-item {{$key == 0 ? 'active' : ''}}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span style="font-size: 14px;"> Reviewed By </span>
                                                    <span style="font-size: 14px;"> Review Date </span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5>
                                                        @if (!empty($review->user->name))
                                                            {{ Str::title($review->user->name) }}
                                                        @elseif (!empty($review->user->email))
                                                            {{ Str::title(explode('@', $review->user->email)[0]) }}
                                                        @else
                                                            Username
                                                        @endif
                                                    </h5>
                                                    <p class="custome-text-date mb-0">{{$review->created_at->format('d-m-Y')}}</p>
                                                </div>
                                                <ul class="list-inline mb-0">
                                                    @for($i=1; $i<= 5; $i++)
                                                        @if($i <= $review->star_rating)
                                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                        @else
                                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                    @endfor
                                                    {{--<li class="list-inline-item testi_icon_color"><b class="">{{$review->star_rating}}</b></li> --}}
                                                </ul>
                                                
                                                <div class="review-text">
                                                    {{ $review->description }}
                                                </div>
                                            </div>
                                            
                                        @endforeach

                                    </div>

                                    <!-- Custom Nav Buttons -->
                                    <div class="d-flex justify-content-start mt-3 carousel-nav-btn-wrapper flex-wrap">
                                        <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="prev"><i class="fa fa-angle-left text-white"></i></button>
                                        <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="next"><i class="fa fa-angle-right text-white"></i></button>
                                        <div class="row {{(auth()->user() && auth()->user()->type != 0) ? 'd-none': ''}}">
                                            <div class="col-md-12">
                                                @if(auth()->user())
                                                    @if(auth()->user()->type == 0)
                                                        @if(!$reviewAlreadyExist)
                                                            <button type="button" class="btn add_reviews_btn all_btn_flx disabled-button open_review_box" data-toggle="modal">
                                                            <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                                            Add Review
                                                        </button>
                                                        @else
                                                            <button type="button" class="btn add_reviews_btn all_btn_flx disabled-button open_review_box" data-toggle="modal">
                                                                <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                                                Edit Review
                                                            </button>
                                                        @endif

                                                    @endif
                                                    @else
                                                        <button type="button" class="btn add_reviews_btn all_btn_flx">
                                                            <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                                            <a href="{{route("viewer.login")}}" style="color: white;">Login to Add Review</a>
                                                        </button>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Carousel controls -->
                            </div>
                        </div>
                    @endif
                
                    <div class="py-3 row {{count($reviews) == 0 ? '': 'd-none'}}">
                        <div class="col-md-12">
                            @php
                                $mesageForViewer = true;
                                if(auth()->user() && auth()->user()->type != 0){
                                    $mesageForViewer = false;
                                }
                            @endphp
                            <p class="testimonial">
                                <strong>{{ $escortName }}</strong> has no Reviews. @php if($mesageForViewer != false){ @endphp Why don’t you give <strong>{{ $escortName}}</strong> their first Review? @php } @endphp
                            </p>
                        </div>
                        <div class="col-md-12 mb-4">
                            @if(auth()->user())
                                @if(auth()->user()->type == 0)
                                    <button type="button" class="btn add_reviews_btn all_btn_flx open_review_box disabled-button">
                                        <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                        Add Review
                                    </button>
                                @endif
                            @else
                                <button type="button" class="btn add_reviews_btn all_btn_flx">
                                    <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                    <a href="{{route("viewer.login")}}" style="color: white;">Login to Add Review</a>
                                </button>
                            @endif
                        </div>
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div>
    </div>
    <!--- end -->

<!-- model start here 1-->
<div class="modal fade upload-modal" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @if(auth()->check() && auth()->user()->type==0)
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
                
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Me </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                    <h5 class="custom_modal_text">
                                <span id="Lname">To message {{ $escort->name}} please go to your Dashboard and select
                                    Communications  Messages. </span>
                            </h5>
                    <hr style="background-color: #0C223D">
                    <p class="mb-1 mt-3"><b>Notes:</b></p>
                                <ol>
                                    <li>Make sure you have enabled Messaging in your settings. If you have added {{ $escort->name}} to your
                                        Legbox, they will appear in your Message list. Otherwise, you can search by Member ID.</li>
                                    <li>To message {{ $escort->name}}, they will also need to have Messaging enabled.</li>
                                </ol>   
            </div>
            <div class="modal-footer text-center justify-content-end">
                <a href="{{ route('user.viewer-messages') }}" type="button" class="site_btn_primary" id="loginUrl" style="text-decoration: none;">Go to Message</a>                
            </div>
            

        </div>
    </div>
    @else
     <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
                
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Me </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <!-- if viewer not login -->
            <div class="modal-body">
                <h5 class="custom_modal_text">
                    <span id="Lname">Message Me is only available to Viewers.
                        Please log in or Register to access Message Me.</span>
                </h5>
                
            </div>
            <div class="modal-footer pt-0 text-center justify-content-center">
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            
            <!--- end -->

        </div>
    </div>
    @endif
</div>
<!-- model end here 1-->
<!-- Report advertiser model start here 2-->

<div class="modal upload-modal fade" id="reportAdvertiserNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
                
                <h5 class="modal-title" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Advertiser </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <!-- if viewer not login -->
            <div class="modal-body" >
                <h5 class="custom_modal_text">
                    <span id="Lname">Report Advertiser is only available to Viewers. Please log in or Register to access Report Advertiser.</span>
                </h5>
                
            </div>
            <div class="modal-footer pt-0 text-center justify-content-center" >
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            <!--- end -->

        </div>
    </div>
</div>


<div class="modal fade ss upload-modal"  id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="custompopicon">
                <h5 class="modal-title" id="exampleModalLabel">Report  {{$escort->name}} to our team
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="sendReportForm" action="{{ route('advertiser.spam.report')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <p class="font-weight-bold">What is wrong:</p>
                                <textarea name="description" id="reportDesc" required class="form-control popup_massage_box p-2" id="exampleFormControlTextarea1" rows="5" placeholder="Message (500 characters)">{{-- isset($spamReportAdvertiser->report_desc) ? $spamReportAdvertiser->report_desc : '' --}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center">
                            <p class="diff_font_pera mb-0 mr-2">Why are you reporting this Profile:</p>
                            
                            <div class="form-check py-0 mr-2">
                                <input class="form-check-input" type="radio" name="report_tag" id="fake_media" value="fake_media" {{isset($spamReportAdvertiser->report_tag) && $spamReportAdvertiser->report_tag == 'fake_media' ? 'checked': '' }}>
                                <label class="form-check-label" for="fake_media">
                                    Fake Media
                                </label>
                            </div>

                            <div class="form-check py-0 mr-2">
                                <input class="form-check-input" type="radio" name="report_tag" id="spam" value="spam" {{isset($spamReportAdvertiser->report_tag) != null && $spamReportAdvertiser->report_tag == 'spam' ? 'checked': '' }} >
                                <label class="form-check-label" for="spam">
                                    Spam
                                </label>
                            </div>

                            <div class="form-check py-0">
                                <input class="form-check-input" type="radio" name="report_tag" id="other" value="other" value="other" {{isset($spamReportAdvertiser->report_tag) != null &&  $spamReportAdvertiser->report_tag == 'other'  ? 'checked': ($spamReportAdvertiser == null ? 'checked' : '') }} >
                                <label class="form-check-label" for="other">
                                    Other
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    
                    <hr style="background-color: #0C223D" />
                    <p class="mb-1 mt-3"><b>Notes :</b></p>
                    <div class="row">
                        <input type="hidden" name="escort_id" value="{{$escort->id}}">
                        <div class="col">
                            <ol>
                                <li>Only report if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reports, as it may result in your Account being suspended. Only
                                    genuine reports will be considered.</li>
                                <li>The Advertisers Membership Number will automatically attach to this report.</li>
                                <li>You will receive a notification when this report has been resolved.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer  pt-0">
                    <button type="submit" class="site_btn_primary" id="sendReportSubmitBtn">Send Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
{{-- <button data-target="#reportLogedIn" data-toggle="modal">review-submitted-popup</button> --}}
 
<!-- Report Advertiser Modal confirmation popup -->
<div class="modal fade upload-modal" id="reportLogedIn" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
 
            <!-- Header with navy background and [X] -->
            <div class="modal-header">
                
                <h5 class="modal-title" id="reportAdvertiserLabelNew">                    
                   <img src="{{ asset('assets/dashboard/img/request-submit.png') }}"
                                class="custompopicon">  Report Logged </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
 
            <!-- if logi Body content -->
           
            <div class="modal-body">
                <h5 class="custom_modal_text">
                    <span id="Lname">Thank you for your report. Someone from our team will be in
                touch shortly.</span>
                </h5>
             
            </div>
            <div class="modal-footer pt-0" style="justify-content: center; ">
                <button type="submit" class="btn-success-modal" data-dismiss="modal"
                    id="close">Ok</button>
            </div>
 
        </div>
    </div>
</div>
<!-- model start here 3 Review and Rating-->
<div class="modal fade upload-modal add_reviews" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            
        
        <div class="modal-header">
                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title" id="exampleModalLabel">{{$reviewAlreadyExist ? 'Edit' : "Add"}} review for {{ $escort->name }}
                </h5>
                <button type="button" @if($reviewAlreadyExist) data-bs-dismiss="modal" @else data-bs-dismiss="modal" @endif class="close" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>


            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post" data-parsley-validate>
                @csrf
                {{--  <input type="hidden" value="" name="star_rating">--}}
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <p class="font-weight-bold">Tell us about your experience:</p>
                                <textarea name="description" 
                                class="form-control popup_massage_box p-2" id="review_textarea" rows="5" 
                                placeholder="Message (500 characters)"
                                 required
                            data-parsley-required-message="Please enter your review"
                            data-parsley-maxlength="500"
                            data-parsley-maxlength-message="Maximum 500 characters allowed">
                                
                                {{$reviewExistsMessage}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="revew-myratings">
                        <p class="mb-0" style="font-size: 20px;">Rating:</p>
                        <div class="rating-stars">
                            <!-- Repeatable SVG stars -->
                            @for($i =1; $i <= 5; $i++)
                                @if($i<= $reviewExistsStarRating)
                                        <svg class="star filled" data-value="{{$i}}" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                    </svg>
                                @else
                                        <svg class="star" data-value="{{$i}}" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <input type="hidden" id="userRating" name="rating" value="{{$reviewExistsStarRating}}">
                    </div>
                    
                    <hr style="background-color: #0C223D">
                    <p class="mb-1 mt-3"><b>Notes:</b></p>
                            <ol>
                                <li>Only review if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reviews, as they will not be published.</li>
                                <li>To contact this Escort click on <a href="{{ route('user.viewer-messages') }}" style="color: #ff3c5f;" class="custom_links_design">Message Me</span></a>.</li>
                            </ol>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn-cancel-modal site_btn_primary" @if($reviewAlreadyExist) data-bs-dismiss="modal" @else data-bs-dismiss="modal" @endif>
                        Cancel
                    </button>

                    <button type="submit" class="btn-success-modal site_btn_primary">{{$reviewAlreadyExist ? 'Update' : "Submit"}} Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model start here 1-->
<div class="modal fade upload-modal" id="newmodal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title" id="exampleModalLabel">Send {{ $escort->name}} a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 teop-text">
                <p class="mb-1 mt-3"><b>Notes</b></p>
                <ol class="mb-0">
                    <li>The Escort needs to have this feature enabled in order to receive it.</li>
                    <li>You will receive a notification when thismessage is responded to.</li>
                </ol>
            </div>
            <form id="messageMe" action="{{ route('store.message',[$escort->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Mobile</label>
                                <input type="text" placeholder="Mobile number" maxlength="10" step="100"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-type="number" class="form-control" name="phone" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model end here 1-->

<!-- model start here 2-->
<div class="modal fade upload-modal ss" id="newmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title" id="exampleModalLabel">Report  {{$escort->name}} to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <!-- <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> -->
                    </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post" data-parsley-validate>
                @csrf
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes</b></p>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>Only report if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reports, as it may result in your Account being suspended. Only genuine reports will be considered.</li>
                                <li>The Profile page URL will automatically attach to this report.</li>
                                <li>You will receive a notification when this report has been resolved. </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">What is wrong:</label>
                                <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" placeholder="Message (250 characters)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="diff_font_pera mb-0">Why are you reporting this Profile:</p>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="1">
                                <span class="form-check-label" for="exampleRadios2">
                                Fake Media
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="0">
                                <span class="form-check-label" for="exampleRadios2">
                                Spam
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="2">
                                <span class="form-check-label" for="exampleRadios2">
                                Other
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary">Post Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model start here 3-->

<div class="modal fade upload-modal" id="my_legbox" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/my-legbox.png')}}" class="custompopicon"> My Legbox</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="custom_modal_text">
                    <span id="Lname">My Legbox is only available to Viewers. Please log in or Register to access your Legbox.</span>
                </h5>
            </div>
             <div class="modal-footer pt-0" style="justify-content: center; ">
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
            
            </div>
        </div>
    </div>
</div>

{{-- Message Me --}}
    <div class="modal fade upload-modal" id="messageMe" tabindex="-1" role="dialog" aria-labelledby="messageMe"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageMe"><img src="{{ asset('assets/app/img/replaysmsicon.png') }}" class=" "> Message Me</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body agent-tour">
                    <form method="post" action="#">
                        <h5 class="custom_modal_text">Are you sure you want to mark this Appointment as completed?</h5>
                        <div class="row">
                            <div class="col-md-12 my-3 text-center">
                                <div class="form-group">  
                                    <button type="button"
                                    class="btn btn-primary shadow-none ml-2  bg-danger"
                                    data-dismiss="modal" aria-label="Close">No</button>
                                    <button type="submit"
                                        class="btn btn-primary shadow-none ml-2 ">Yes</button>
                                  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}



<div class="modal fade upload-modal" id="review-submitted-popup" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
 
            <!-- Header with navy background and [X] -->
            <div class="modal-header">
                <img src="{{ asset('assets/app/img/tick.png')}}"
                                class="custompopicon">
                <h5 class="modal-title" id="reportAdvertiserLabelNew">Review Submitted</h5>
                <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;" >
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
 
            <!-- if logi Body content -->
           
            <div class="modal-body text-center">
                 <h5 class="custom_modal_text">Thank you for your Review. Your Review for <span id="review-escort-name"></span> has been submitted for approval.
                </h5>             
            </div>

            <div class="modal-footer pt-0" style="justify-content: center; ">
                <button type="submit" class="btn-success-modal site_btn_primary" data-dismiss="modal"
                    id="close">Ok</button>
            </div>
 
        </div>
    </div>
</div>




@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/app/lightbox/js/glightbox.min.js') }}"> </script>
<script src="{{ asset('assets/app/lightbox/js/script.js') }}"> </script>
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script>
let myCarousel = document.querySelector('#reviewCarousel');
let carousel = new bootstrap.Carousel(myCarousel, {
  interval: false, // stops auto scroll
  ride: false
});

</script>
<script type="text/javascript">
    $('#like, #dislike').click(function(e) {
        var vote = 0;
        if($(this).attr('id') == 'like') {
            vote = 1;
        }
        var currentDislikeClickBtn = $(this);

        var url = "{{ route('web.likeDislike') }}";
        $.ajax({
            method: 'POST',
            url: url,
            data: {'vote' : vote, 'escortId' : {{$escort->id}} },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if(data.error) {
                    Swal.fire(
                        'Error!',
                        'Something is wrong please try later.',
                        'error'
                    );
                } else {
                    if (data.like == 1) {
                        currentDislikeClickBtn.removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                        $("#dislike").removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
                    } else {
                        currentDislikeClickBtn.removeClass('fa-thumbs-o-down').addClass('fa-thumbs-down');
                        $("#like").removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-o-up');
                    }
                    var vote_bar = '<div class="progress-bar bg-danger progress-bar-stripped" style="width: '+data.dp+'%">' +
                        '                    '+data.dp+'%' +
                        '                </div>' +
                        '                <div class="progress-bar bg-success" style="width: '+data.lp+'%;">' +
                        '                    '+data.lp+'%' +
                        '                </div>';
                    $("#vote_bar").html(vote_bar);
                }
            }
        });

    });

</script>

<script>
        $(document).on('submit', '#reviewAdvertiser',function(e){
        e.preventDefault();
        var form = $(this);

        if (form.parsley().isValid()) {
            var url = form.attr('action');
            var data = new FormData($('#reviewAdvertiser')[0]);
            
            $.ajax({
                method: 'POST',
                url: url,

                data: data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    $('#reviewAdvertiser')[0].reset();
                    //$('#add_reviews').modal("hide");
                    $('#add_reviews').toggle(); 
                    $('#review-submitted-popup').modal("show");
                    $('#review-escort-name').text("{{ $escort->name }}");
                    
                    if(!data.error){
                        
                       
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully updated',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Failed to save the review',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });


$('#review-submitted-popup #close').on('click', function() {
    $('#review-submitted-popup').toggle();
    $('.modal-backdrop').remove();
});

// Close when X icon clicked
$('#review-submitted-popup .close').on('click', function() {
   $('#review-submitted-popup').toggle();
   $('.modal-backdrop').remove();
});
    
    
</script>
<script>
    $('#messageMe').parsley({

    });
    $('#messageMe').on('submit', function(e) {

        var form = $(this);
        if (form.parsley().isValid()) {
            var url = form.attr('action');
            var data = new FormData();
            data.append('_token',$('input[name="_token"]').val());
            e.preventDefault();

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#messageMe')[0].reset();
                        setTimeout(function(){
                        $('#mysendmessage').modal('hide');
                        }, 1000);

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#messageMe')[0].reset();
                        setTimeout(function(){
                        $('#mysendmessage').modal('hide');
                        }, 1000);
                    }
                }
            });
        }
    });

</script>
<script type="text/javascript">

    window.authUser = {
        isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
        auth_user_type: {{ auth()->check() ? auth()->user()->type : 'false' }},
        myLegboxDisabled: {{ auth()->check() && auth()->user()->viewer_settings?->features_enable_my_legbox == 0 ? 'true' : 'false'}},
        write_reviews_disable: {{ auth()->check() && auth()->user()->viewer_settings?->features_write_reviews == 0 ? 'true' : 'false' }},
    };

    console.log('window.authUser.write_reviews_disable',window.authUser.write_reviews_disable);


    if (window.authUser.write_reviews_disable && window.authUser.auth_user_type=='0') {

        $('.disabled-button').css({
        'background-color': '#ccc',
        'border-color': '#ccc',
        'color': '#646464',
        'opacity': '0.9',
       
    });
    }
    


    $(document).ready(function () {

        let review_box = $('#review_textarea').val().trim();
        $('#review_textarea').val(review_box);

        var totalItems = $('.item-01').length;
        var currentIndex = $('div.carousel-item').index() + 1;
        var currentIndex_active = $('div.carousel-item.active').index();
        let prev = totalItems + 1;
        $("body").on('click', '#prev', function () {
            prev -= 1;
            console.log(prev);
            if (prev >= 1) {
                $('.num-01').html('' + prev + '&nbsp;/&nbsp;' + totalItems + '');
            } else {
                console.log("els=" + prev);
                prev = totalItems;
                $('.num-01').html('' + prev + '&nbsp;/&nbsp;' + totalItems + '');
            }

        });

        $("body").on('click', '#next', function () {
            currentIndex += 1;
            console.log(prev);
            if (currentIndex <= 9) {
                $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
            } else {
                console.log("els=" + prev);
                currentIndex = 1;
                $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
            }

        });
        $("body").on('click', '.likeImg', function () {
            var value = $(this).attr('value');
            var id = "{{$escort->id}}";

            console.log("ok=" + url);


        });

    });
    $("#home-tab").click(function () {
        $('.tab2').hide();
        $('.tab3').hide();
        $('.tab1').show();
    });
    $("#menu1-tab").click(function () {
        $('.tab1').hide();
        $('.tab3').hide();
        $('.tab2').show();
    });
    $("#menu2-tab").click(function () {
        $('.tab1').hide();
        $('.tab2').hide();
        $('.tab3').show();
    });



     $(document).on('click', '.open_review_box', function (e) {
        e.preventDefault();
       if (window.authUser.write_reviews_disable && window.authUser.auth_user_type=='0') {
            swal_error_warning('Reviews','Please note you have disabled this feature. <br> To access this feature, go to your setting in My Account.');
            return false;
        } else {
            $('#add_reviews').modal('show');
        }
    });



    $(document).on('click', '#legbox_btn', function () {


          if (window.authUser.myLegboxDisabled && window.authUser.auth_user_type=='0') {
            swal_error_warning('My Legbox','Please note you have disabled this feature. <br> To access this feature, go to your setting in My Account.');
            return false;
        }

        var addToFebIcon = $(this).find('.add_to_favrate');
        var Eid = addToFebIcon.attr('data-escortId');
        var Uid = addToFebIcon.attr('data-userId');
        var cidcl = addToFebIcon.attr('class');
        var cid = cidcl.split(' ');
        if (cid[1] == 'fill') {
            addToFebIcon.removeClass('fill');
            addToFebIcon.addClass('null');
            $('#legboxId_' + Eid).html("<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>");
            $('#legbox_btn').find("span.label").text("Remove from Legbox");
            var url = "{{ route('user.save.legbox' ,':id')}} ";
            url = url.replace(':id', Eid);
            $.ajax({
                type: "post",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {

                }
            });
        } else if (cid[1] == 'null') {
            addToFebIcon.removeClass('null');
            addToFebIcon.addClass('fill');
            $('#legboxId_' + Eid).html("<i class='fa fa-heart-o' aria-hidden='true'></i>");
            $('#legbox_btn').find("span.label").text("Save to My Legbox");
            var url = "{{ route('user.delete.legbox' ,':id')}} ";
            url = url.replace(':id', Eid);
            $.ajax({
                type: "post",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {

                }
            });
        } else {
            $('#my_legbox').modal('show');
            var login_url = "{!! route('viewer.login',[':id','path'=>'escort-profile']) !!}";
            var loginurl = login_url.replace(':id', 'legboxId=' + Eid);
            // console.log(loginurl);


            var regurl = "{{ route('register',':id') }}";

            regurl = regurl.replace(':id', 'legboxId=' + Eid);
            $('#loginUrl').attr('href', loginurl);
            $('#regUrl').attr('href', regurl)
        }


        console.log(cid[1] + "-" + Eid);
        console.log(cidcl);
    });
</script>

<script>
  $('#myCarousel').carousel({
    interval: false
  });

  

  $(document).ready(function () {

  $('.rating-stars .star').on('click', function () {
    const rating = $(this).data('value');
    $('#userRating').val(rating);

    // Remove 'filled' class from all stars
    $('.rating-stars .star').removeClass('filled');

    // Add 'filled' class to selected stars
    $('.rating-stars .star').each(function () {
      if ($(this).data('value') <= rating) {
        $(this).addClass('filled');
      }
    });
  });
});

$(document).on('click', '.modal .close ', function () {
    $('#my_legbox').modal('hide');
    $('#reportAdvertiserNew').modal('hide');
    $('#sendcarlat').modal('hide');
    $('#reportLogedIn').modal('hide');
});

$(document).on('click', '#close ', function () {
    $('#reportLogedIn').modal('hide');
});

$(document).ready(function() {

    function sendReportAjaxCallback(formData, url, type)
    {
        $.ajax({
            method: type,
            url: url,
            data: formData,
            contentType: type === 'GET' ? 'application/x-www-form-urlencoded; charset=UTF-8' : false,
            processData: type === 'GET',
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function (response) {
                $('#sendReportForm')[0].reset();

                if(type == 'GET'){
                    if(response.data){
                        let desc = response.data.report_desc;
                        let tag = response.data.report_tag;
                        //$("#reportDesc").text(desc);
                         $("#reportDesc").text('');
                        $('input[name="report_tag"][value="' + response.data.report_tag + '"]').prop('checked', true);
                    }
                    
                }else{
                    if(!response.error){
                        /* $.toast({
                            heading: 'Success',
                            text: 'Your report for this advertiser has been submitted successfully.',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        }); */
                        $("#reportLogedIn").modal('show');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Failed to save the review',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                    $('#sendcarlat').modal('hide');
                }
                
            }
        });
    }

    $('#reportAdvertiserBtn').on('click', function(e) {
        e.preventDefault(); 

        @if(auth()->check() && auth()->user()->type == 0)
            $('#sendcarlat').modal('show');

            // if viewer already reported this escort

            var formData = {
                'escort_id' : '{{$escort->id}}',
                'viewer_id' : '{{auth()->user ?? auth()->user()->id}}',
                'type' : 'get',
                'url': "{{ route('advertiser.get.spam.report')}}"
            }
            sendReportAjaxCallback(formData, formData.url, 'GET');

        @else 
            $('#reportAdvertiserNew').modal('show');
        @endif
    });

    $('#sendReportForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(this);
        formData.append('type','post');

        sendReportAjaxCallback(formData, url, 'POST');
    });

    let videos = document.querySelectorAll("video");
    videos.forEach(video => {
        video.addEventListener("play", () => {
            videos.forEach(v => {
                if (v !== video) {
                    v.pause();
                }
            });
        });
    });
    
});

$('#exampleModal').on('hidden.bs.modal', function () {
    $(this).find('video').each(function() {
        this.pause();
        this.currentTime = 0; // reset to start
    });
});

$('#exampleModal').on('shown.bs.modal', function () {
    console.log("Modal opened:", $(this).attr('id'));
    // add media view count while open modal
    var formData = {
        'escort_id' : '{{$escort->id}}',
        'user_id' : '{{$escort->user->id}}'  
    };

    let url = "{{ route('save.escort.stats')}}";
    saveEscortAjaxStats(formData, url, 'GET');
});

function saveEscortAjaxStats(formData, url, type)
{
    $.ajax({
        method: type,
        url: url,
        data: formData,
        contentType: type === 'GET' ? 'application/x-www-form-urlencoded; charset=UTF-8' : false,
        processData: type === 'GET',
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function (response) {
            console.log(response);  
        }
    });
}

</script>
@endpush
