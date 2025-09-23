@extends('layouts.web')
@section('content')
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
    background-color: #2B3D50;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    font-size: 12px;
    padding: 5px 8px;
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
    border-color: #2B3D50 transparent transparent transparent; /* top arrow */
  }
 
  .tooltip-wrapper:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }

@if($escort->latestActiveBrb)
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
    .brb_details {
        color: red;
        padding-top: 5%;
    }

  
@endif


.fa-thumbs-down, .fa-thumbs-up {
    pointer-events: none;
}

.save-my-legbox-btn {
         color: #fff;
    }

</style>

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

<div class="profile_description_banner overlay_parent custom--overlay custom--brb-overlay" style="background: none;">
   

        <div class="container profile_pic_holder p-0 custom--profile"  style="background-color: #ff3c5f; background: url({{ $escort->imagePosition(9) ? asset($escort->imagePosition(9)) : asset('assets/app/img/profiledescrition.png')}}); background-repeat: no-repeat; background-size: cover;background-position:center;">
        <div class="container">
            <div class="row">
                <div class="overlay">
                    @if($escort->latestActiveBrb)
                        <div class="brb_details">
                            <h1>BRB at {{date('h:i A d-m-Y',strtotime($escort->latestActiveBrb->selected_time) )}}</h1>
                            <h3>{{$escort->latestActiveBrb->brb_note}}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container-fluid back_to_search_btn pt-2" style="text-align: right;">
            
            <div class="row">
                @php

                   if (str_contains($backToSearchButton, 'view=')) {
                        $finalUrl = preg_replace('/view=[^&]*/', 'view=' . $viewType, $backToSearchButton);
                    } else {
                        // If view param not present, append it properly
                        $separator = str_contains($backToSearchButton, '?') ? '&' : '?';
                        $finalUrl = $backToSearchButton . $separator . 'view=' . $viewType;
                    }
                    
                @endphp
                <div class="col-12">
                    <a href="{{ $finalUrl }}" class="back--search"> Back to Search <span class="previous_icon"><i class="fa fa-chevron-up text-white" aria-hidden="true"></i></span></a>
                </div>
            </div>
        </div>
            <div>
                <div class="profile_page_title px-3">
                    @php 
                    $isPinupActive = $escort->currentActivePinup;
                    $membershipImage = match ($escort->membership) {
                        '1' => $isPinupActive?asset('images/platinum_membership_pin.png'):asset('images/platinum_membership.png'),
                        '2' => $isPinupActive?asset('images/gold_membership_pin.png'): asset('images/gold_membership.png'),
                        '3' => $isPinupActive?asset('images/silver_membership_pin.png'):asset('images/silver_membership.png'),
                        default => false
                    };
                    @endphp

                    @if($membershipImage)
                       <div class="{{($isPinupActive)?'pinup-wrapper':''}}">
                            <img src="{{ $membershipImage }}">
                            <div class="pinup-tooltip">I am your Pin Up this week!</div>
                       </div> 
                    @endif

                    @if(strlen($escort->name) <= 250)
                            <h2 class="display_inline_block">{{ $escort->name}}</h2>
                    @else
                            <h3 class="display_inline_block" style="color: white;">{{ $escort->name}}</h3>
                        @endif
                </div>
                <div class="profile_page_name_and_phno px-3">
                <p>{{$escort->city->name}} - {{ preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $escort->phone)) }}</p>


                    
                </div>
            </div>
            <div class="profile_page_location_and_id px-3">
                <ul>
                    <li>
                        <span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <p class="display_inline_block ">{{ $escort->address}}</p>
                    </li>
                    <li>
                        <span class="profile_location_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <p class="display_inline_block ">Member ID: {{ $escort->member_id}}</p>
                    </li>
                </ul>
            </div>
<div class="d-flex align-items-center justify-content-start gap-10 px-3">
               

<div class="my-play-box-profile-icon">
    <a href="{{ url('playbox') }}" target="_blank">
        <img src="{{ asset('assets/app/img/MyPlaybox.png') }}" alt="My Playbox Icon">
    </a>
    <div class="custom-tooltip">I don't have any Playbox.</div>
</div>
                <ul class="profile_page_social_profiles">
                    @if(!empty($escort->user->profile_creator) && in_array(3,$escort->user->profile_creator))
                    <li class="selected-from-profile">
                        <a href="{{ ($escort->user->social_links && $escort->user->social_links['facebook'] != '') ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li class="selected-from-profile"><a href="{{ ($escort->user->social_links && $escort->user->social_links['insta'] != '') ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li class="selected-from-profile"><a href="{{ ($escort->user->social_links && $escort->user->social_links['twitter'] != '') ? $escort->user->social_links['twitter'] : 'https://x.com/' }}" target="_blank"><img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png" class="twitter-x-logo" alt="logo" style="width:15px"></a></li>
                    @else
                    
                    
                    <li class="by-default"><a href="https://x.com/Escorts46919U/" target="_blank"><img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png" class="twitter-x-logo" alt="logo" style="width:15px"></a></li>
                    @endif
                </ul>

            </div>
        </div>
</div>
    <div class="container-fluid px-0 next-preview-fixed">
        <div class="d-flex d-flex justify-content-between">
            <div class="previous_btn_profile next_previous_btn_pogision preview-dk previousDisableButtonCss">
                <a href="{{ str_contains(url()->full(), '?no-prev-page=') ? '#' : $previous}}" class="text-decoration-none d-flex ">
                <span class="previous_icon"><i class="fa fa-chevron-left text-white" aria-hidden="true"></i></span>
                <span class="previous_text remove_in_sm">Previous</span>
                </a>
            </div>
            
            <div class="next_btn_profile next_previous_btn_pogision next-dk nextDisableButtonCss" >
                <a href="{{ str_contains(url()->full(), '?no-next-page=') ? '#' : $next}}" class="text-decoration-none ">
                <span class="previous_text remove_in_sm">Next</span>
                <span class="previous_icon"><i class="fa fa-chevron-right text-white" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
    </div> 
    <div class="container profile_contain">
        <div class="row">
           
            <div class="col-md-8 col-xl-8 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-xl-8 col-sm-12 col-12">
                        <div class="row mess_row">
                            <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                                {{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->massage_price : '' }}/hr
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Incalls</h4>
                                        </div>
                                        <div class="profile_hr">

                                            <h4>{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->incall_price : ''}}/hr</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4 mx-auto">
                                <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Outcalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price : ''}}/hr</h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4 col-sm-12 text-center">
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
                <div class="row">
                    <div class="col-lg-6 col-md-12 table-width-dk mb-2 table-responsive">
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
                                    <td>{{isset($duration->pivot->massage_price) && $duration->pivot->massage_price != 0 ? '$' : ''}}{!! ($duration->pivot->massage_price) ? number_format($duration->pivot->massage_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{{isset($duration->pivot->incall_price) ? '$' : ''}}{!! ($duration->pivot->incall_price) ? number_format($duration->pivot->incall_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{{isset($duration->pivot->outcall_price) ? '$' : ''}}{!! ($duration->pivot->outcall_price) ? number_format($duration->pivot->outcall_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS):
                                        {{ config("escorts.profile.Payments.$escort->payment_type") }}
                                    </th>
                                </tr>
                            </thead>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-lg-6 col-md-12 table-width-dk">
                        <table class="table table_striped mb-0">
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th scope="col">Arriving</th>
                                    <th scope="col">Departing</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{Carbon\Carbon::parse($escort->start_date)->format('d-m-Y')/*->format('jS F Y ')*/ }}</td>
                                    <td>{{Carbon\Carbon::parse($escort->end_date)->format('d-m-Y')/*->format('jS F Y ')*/}}</td>
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
                                            ... Til Late
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
                                                <span class="about_box_small_heading">Available to:</span> @if(!empty($escort->available_to)) @foreach($escort->available_to as $available_to) <span class="about_box_small_heading_value">{{ config("escorts.profile.available-to.$available_to") }}</span>@endforeach @endif
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
                                    <span class="about_box_small_heading">Contact me:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.contact-me.$escort->contact") }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Hair Colour:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-colour.$escort->hair_color") }}</span>
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
                                <span id="y" class="about_box_small_heading_value">Read more&gt;&gt;</span>
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
                                        <span class="about_box_small_heading">Play types:</span> @if(!empty($escort->play_type)) @foreach($escort->play_type as $playtype)<span class="about_box_small_heading_value">{{ config("escorts.profile.play-types.$playtype") }} </span>@endforeach @endif
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
                        <p>Check out what I enjoy the most with you in private. Let's have some fun. Feel free to ask me any questions about my services.</p>
                        <div class="accordion-container">
                            <div class="set">
                                <a>
                                On You - Fun Stuff
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryOneServices[0]))
                                                                @foreach($categoryOneServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryOneServices[1]))
                                                                @foreach($categoryOneServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                On You - Kinky Stuff
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryTwoServices[0]))
                                                                @foreach($categoryTwoServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryTwoServices[1]))
                                                                @foreach($categoryTwoServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                On me - Fun Stuff
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(!empty($categoryThreeServices[0]))
                                                                @foreach($categoryThreeServices[0] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryThreeServices[1]))
                                                                @foreach($categoryThreeServices[1] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($categoryThreeServices[2]))
                                                                @foreach($categoryThreeServices[2] as $service)
                                                                    <tr>
                                                                        <td class="table_border_dash_left">{!!$service['name']!!}</td>
                                                                        <td class="table_border_solid_left">{!! ($service['pivot']['price']!=0) ? (is_numeric($service['pivot']['price']) ? "$" . number_format($service['pivot']['price']) : ''):"<span class='if_data_not_available'>N/A</span>" !!}</td>
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
            <div class="col-md-4 profile-sidebar-margin-top">
                <!-- video crousal start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">

                            @if($escort->gallary->isNotEmpty())
                            @foreach($escort->gallary()->wherePivot('type',0)->wherePivotIn('position',[1,2,3,4,5,6,7])->get() as $key=>$media)
                            <div class="carousel-item {{($key == 0) ? "active" : ""}} " data-interval="10000">
                            {{-- @if($media->pivot->position != 9 && $media->pivot->position != 8 && $media->pivot->position != 10) --}}
                            <div class="row">
                                <div class="col-12 remove_padding_for_carousel">
                                    <img src="{{ asset($media->path) }}" class="d-block w-100" title="Click to view Media" alt="..." data-toggle="modal" data-target="#exampleModal" data-id="">
                                </div>
                            </div>
                            {{-- @endif --}}
                        </div>
                        @endforeach
                        @else
                        <div class="carousel-item active " data-interval="10000">
                            <div class="row">
                                <div class="col-12 remove_padding_for_carousel">
                                    <img src="{{ asset('assets/app/img/service-provider/Frame-408.png') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-0">
                                    <div class="modal-header d-flex justify-content-between align-items-center">                                       
                                        <ul class="nav nav-tabs justify-content-center border-0">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1">Photos</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">Videos</a>
                                            </li>
                                        </ul>
                                        <button type="button" class="p-0" data-dismiss="modal" aria-label="Close">
                                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                                        </button>
                                    </div>
                                    <div class="modal-body p-1">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="gallery">
                                                    @if($escort->gallary->isNotEmpty())


                                                            <div class="gallery__item gallery__item--lg">
                                                                <img src="{{ ($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()) ? asset($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()->path) : ''}}" alt="">
                                                                
                                                            </div>
                                                            @foreach($escort->gallary()->wherePivot('type',0)->wherePivotIn('position',[2,3,4,5,6,7])->orderBy('position','asc')->get() as $key=>$media)
                                                            <div class="gallery__item">
                                                                <img src="{{ asset($media->path) }}" alt="">
                                                            </div>

                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                                                <div class="row pl-0 ml-0 pr-1 pb-3" id="dvSource">
                                                    
                                                            @foreach($escort->gallary()->wherePivot('type',1)->orderBy('position','asc')->get() as $key=>$media)
                                                                <div class="col-md-4" id="dm_2">
                                                                    <a href="#">
                                                                        <video style="z-index: 1" controls="" id="videoId_2" src="{{ asset($media->path) }}">
                                                                            <source src="{{ asset($media->path) }}" type="video/mp4">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                      

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
        </div>
    </div>
    <!-- video crousal end -->
    <div class="row pt-2 eqal-bx">
        <div class="col-xl-5 col-sm-12 my-1 text-center">
            <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#mysendmessage">
            <img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Message Us</button>
        </div>
        <div class="col-xl-7 col-sm-12 my-1 text-center">
            <button type="button" class="btn profile_message_btn_cc" id="reportAdvertiserBtn" data-toggle="modal"><img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Report Advertiser</button>
        </div>
    </div>
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

    <div class="box_shadow manage_padding_margin_bg_color">
        <div class="profile_card_border profile_description_contect">
            <h2><img src="{{ asset('assets/app/img/bedroom.svg') }}"> Playmates</h2>
        </div>
        <div class="padding_20_tob_btm_side reduse_pad">
            @if($escort->user->available_playmate && !is_null($escort->user->playmates) && $escort->user->playmates->count() > 0)
                <p class="profile_description_contect_pera">Message me to arrange a play date.</p>
                <div class="d-flex align-items-center justify-content-start gap-10 flex-wrap">
                    {{-- @if(!auth()->user()->playmates->isEmpty()) --}}
                    @foreach($escort->user->playmates as $playmate)
                    <div>
                        
                        <a href="{{ route('profile.description',$playmate->id)}}" target="_blank">
                            <div class="playmates-pro-container">
                                <img  alt="playmates Avatar" class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed custom-small-round-fixed" src="{{$playmate->default_image ? asset($playmate->default_image) : asset('assets/app/img/icons-profile.png') }}">
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
            <p class="profile_description_contect_pera">{{$escort->name}} does not have any Playmates.</p>
            @endif
        </div>
    </div>
    <!-- jkjkgjkhf -->
    <div class="box_shadow manage_padding_margin_bg_color">
        <div class="profile_card_border profile_description_contect">
            <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting me</h2>
        </div>
        <div class="padding_20_tob_btm_side reduse_pad">
            <span class="span_display_block connecting_me_chat_phone">
                You can contact me by:

                    @php
                        $contactType = $escort->contact != null ? $escort->contact : '';
                    @endphp
                    @if($contactType == 1)
                    <div class="tooltip-wrapper">
                        <img src="{{ asset('assets/app/img/email-me.png') }}">
                        <div class="tooltip-text">Email me</div>
                    </div>
                    
                    
                    @endif
 
                    @if($contactType == 4 || $contactType == 5)
                        <div class="tooltip-wrapper">
                            <img src="{{ asset('assets/app/img/phoneicon.svg') }}">
                            <div class="tooltip-text">Call me</div>
                            @if($contactType == 5)
                                <span>or</span>
                            @endif
                        </div>
                    @endif
                    @if($contactType == 2 || $contactType == 5)
                        <div class="tooltip-wrapper">
                                <img src="{{ asset('assets/app/img/wechat.svg') }}">
                                <div class="tooltip-text">Text me</div>
                        </div>
                    @endif
            </br>
            @php


            $from = $escort->phone;
            $number = sprintf("%s-%s-%s",
            substr($from, 0, 3),
            substr($from, 3, 3),
            substr($from, 6));
            //dd($number);
            @endphp
            <b>When texting me please say:</b>
            <p class="profile_description_contect_pera">
                <b><i>Hi {{ $escort->name }}, I found you on Escorts4U ...</i></b>
                @php
                    $formattedNumber = preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $number));
                    $contactTypes = $escort->contact != null ? $escort->contact : '';
                @endphp

                @if($contactTypes != '')
                    @if($contactTypes == 1)
                        on my email {{ $escort->user->email ?? '' }}
                    @elseif($contactTypes == 4 || $contactTypes == 2 || $contactTypes == 5)
                        on my number {{ $formattedNumber }}
                    @else
                        on my number --
                    @endif
                @else
                    on my number {{$formattedNumber != '' ? $formattedNumber : '--'}}
                @endif
            </p>

        </div>
    </div>
    <div class="vax-btn">
        @if($escort->getRawOriginal('covidreport') == 2)
        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, up to date</button>
        @elseif($escort->getRawOriginal('covidreport') == 1)
        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, not up to date</button>
        @else
        <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vax.svg') }}">Not Vaccinated</button>
        @endif
    </div>

    <div class="accordion-container-new">
        <div class="set">
            <a class="pb-1 pt-1">
            My Pricing Policy
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
                <div class="accodien_manage_padding_content">
                    <p>
                        Prices are all inclusive unless an extra is listed in My Serices. For Outcalls, price is rate + taxi to and from my location.
                    </p>
                </div>
            </div>
        </div>
        <div class="set">
            <a class="pb-1 pt-1">
            Disclaimer
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
                <div class="accodien_manage_padding_content">
                    <p>Donations are for my companionship and nothing else. It is not an offer or promise for prostitution or illegal activity.
                        Anything that may occur between us is our choice as consenting adults.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="box_shadow padding_twelve_px">
        <div class="profile_card_border profile_description_contect position-relative">
            <h2><img src="{{ asset('assets/app/img/tips.svg') }}">Tips</h2>

        </div>
        <div class="pt-2">
            <div id="tipcrousal" class="carousel slide carousel_remove_in_tip" data-ride="carousel" data-interval="2500">
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
    <!-- tip section end here -->

                <!---  new review card -->
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
                <div id="reviewCarousel" class="carousel slide carousel-slide " data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($reviews as $key => $review)
                        <div class="carousel-item carousel-custome-item {{$key == 0 ? 'active' : ''}}">
                            @php
                                if($review->user && auth()->user() && auth()->user()->id == $review->user_id){
                                    $reviewAlreadyExist = true;
                                    $reviewExistsMessage = $review->description;
                                    $reviewExistsStarRating = $review->star_rating;
                                }
                            @endphp
                            <h5>
                                @if (!empty($review->user->name))
                                    {{ Str::title($review->user->name) }}
                                @elseif (!empty($review->user->email))
                                    {{ Str::title(explode('@', $review->user->email)[0]) }}
                                @else
                                    Username
                                @endif
                            </h5>
                            <ul class="list-inline mb-0">
                                @for($i=1; $i<= 5; $i++)
                                    @if($i <= $review->star_rating)
                                        <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                    @else
                                        <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                    @endif
                                @endfor
                                <li class="list-inline-item testi_icon_color"><b class="">{{$review->star_rating}}</b></li>
                            </ul>
                            <p class="custome-text-date">Reviewed [{{$review->created_at->format('d-m-Y')}}]</p>
                            <div class="review-text">
                                {{ $review->description }}
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Custom Nav Buttons -->
                    <div class="d-flex justify-content-start my-3 carousel-nav-btn-wrapper">
                        <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="prev"><i class="fa fa-angle-left text-white"></i></button>
                        <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="next"><i class="fa fa-angle-right text-white"></i></button>
                    </div>
                </div>
                <!-- Carousel controls -->
                <div class="row {{(auth()->user() && auth()->user()->type != 0) ? 'd-none': ''}}">
                    <div class="col-md-12 mb-4">
                    @if(auth()->user())
                            @if(auth()->user()->type == 0)
                                @if(!$reviewAlreadyExist)
                                    <button type="button" class="btn add_reviews_btn all_btn_flx" data-toggle="modal" data-target="#add_reviews">
                                    <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                    Add Reviews
                                </button>
                                @else
                                    <button type="button" class="btn add_reviews_btn all_btn_flx" data-toggle="modal" data-target="#add_reviews">
                                        <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                        Edit Reviews
                                    </button>
                                @endif

                            @endif
                        @else
                            <button type="button" class="btn add_reviews_btn all_btn_flx">
                                <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                                <a href="{{route("viewer.login")}}" style="color: white;">Login to Add Reviews</a>
                            </button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endif
        <!--- if escort has no review then show this section -->
        <div class="py-3 row {{count($reviews) == 0 ? '': 'd-none'}}">
            <div class="col-md-12">
                @php
                    $mesageForViewer = true;
                    if(auth()->user() && auth()->user()->type != 0){
                        $mesageForViewer = false;
                    }
                @endphp
                <p class="testimonial">
                    <strong>{{ $escort->name}}</strong> has no Reviews. @php if($mesageForViewer != false){ @endphp Why don’t you give <strong>{{ $escort->name}}</strong> their first Review?’ @php } @endphp
                </p>
            </div>
            <div class="col-md-12 mb-4">
            @if(auth()->user())
                    @if(auth()->user()->type == 0)
                        <button type="button" class="btn add_reviews_btn all_btn_flx" data-toggle="modal" data-target="#add_reviews">
                            <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                            Add Reviews
                        </button>
                    @endif
                @else
                    <button type="button" class="btn add_reviews_btn all_btn_flx">
                        <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                        <a href="{{route("viewer.login")}}" style="color: white;">Login to Add Reviews</a>
                    </button>
                @endif
            </div>
        </div>
        <!-- end -->
    </div>
</div>

</div>
</div>
<!-- model start here 1-->
<div class="modal fade" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
               
                
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Us </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            @if(auth()->check() && auth()->user()->type==0)
            <div class="modal-body">
                    <h6 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                                <span id="Lname">To message {{ $escort->name}} please go to your Dashboard and select
                                    Communications > Messages. </span>
                            </h6>
                    <hr style="background-color: #0C223D">
                    <p class="mb-1 mt-3"><b>Notes:</b></p>
                                <ol>
                                    <li>Make sure you have enabled Messaging in your settings. If you have added {{ $escort->name}} to your
                                        Legbox, they will appear in your Message list. Otherwise, you can search by Member ID.</li>
                                    <li>To message {{ $escort->name}}, they will also need to have Messaging enabled.</li>
                                </ol>   
            </div>
            <div class="modal-footer text-center justify-content-center">
                <a href="{{ route('user.viewer-messages') }}" type="button" class="site_btn_primary" id="loginUrl" style="text-decoration: none;">Go to Message</a>                
            </div>
            @else
            <!-- if viewer not login -->
            <div class="modal-body pb-0 teop-text" >
                <h6 class="popu_heading_style mb-4 mt-4 " style="text-align: center; color:#0C223D;">
                    <span id="Lname">Message Me is only available to Viewers.
                        Please log in or Register to access Message Us.</span>
                </h6>
                <div class="modal-footer text-center justify-content-center pt-0" >
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            </div>
            @endif
            <!--- end -->

        </div>
    </div>
</div>
<!-- model end here 1-->
<!-- Report advertiser model start here 2-->

<div class="modal fade" id="reportAdvertiserNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
               
                
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Advertiser </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <!-- if viewer not login -->
            <div class="modal-body pb-0 teop-text" >
                <h6 class="popu_heading_style mb-4 mt-4 " style="text-align: center; color:#0C223D;">
                    <span id="Lname">Report Advertiser is only available to Viewers. Please log in or Register to access Report Advertiser.</span>
                </h6>
                <div class="modal-footer text-center justify-content-center" >
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            </div>
            <!--- end -->

        </div>
    </div>
</div>


<div class="modal fade ss" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="custompopicon">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  {{$escort->name}} to our team
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
                                <textarea name="description" id="reportDesc" required class="form-control popup_massage_box p-2" id="exampleFormControlTextarea1" rows="5" placeholder="Message (500 characters)">{{isset($spamReportAdvertiser->report_desc) ? $spamReportAdvertiser->report_desc : '' }}</textarea>
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
                                <li>Do not write fake or abusive reports, as it may result in your Account being suspended Only genuine reports will be considered.</li>
                                <li>The Escort’s Member ID will automatically attach to this report.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="site_btn_primary" id="sendReportSubmitBtn">Send Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
 
<!-- Report Advertiser Modal confirmation popup -->
<div class="modal fade" id="reportLogedIn" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
 
            <!-- Header with navy background and [X] -->
            <div class="modal-header" style="background-color: #0e2346; color: white; display: flex; justify-content: space-between; align-items: center; border-radius:0px">
                <img src="{{ asset('assets/dashboard/img/request-submit.png') }}"
                                class="custompopicon">
                <h5 class="modal-title font-weight-bold" id="reportAdvertiserLabelNew">
                    
                    Report Logged
                    </h5>
                <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;" >
                <img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/newcross.png" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
 
            <!-- if logi Body content -->
           
            <div class="modal-body text-left">
                <h6 class="popu_heading_style  mt-2 " style="text-align: center; color:#0C223D;">
                    <span id="Lname">Thank you for your report. Someone from our team will be in
                touch shortly.</span>
                </h6>
             
            </div>
            <div class="modal-footer pt-0" style="justify-content: center; ">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                    id="close">Ok</button>
            </div>
 
        </div>
    </div>
</div>

<!-- model start here 3-->
<div class="modal fade add_reviews" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">{{$reviewAlreadyExist ? 'Edit' : "Add"}} review for {{ $escort->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                {{--  <input type="hidden" value="" name="star_rating">--}}
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <p class="font-weight-bold">Tell us about your experience:</p>
                                <textarea name="description" class="form-control popup_massage_box p-2" id="review_textarea" rows="5" placeholder="Message (500 characters)">{{$reviewExistsMessage}}</textarea>
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
                    <button type="submit" class="btn main_bg_color site_btn_primary rounded">{{$reviewAlreadyExist ? 'Update' : "Submit"}} Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model start here 1-->
<div class="modal fade" id="newmodal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send {{ $escort->name}} a message</h5>
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
<div class="modal fade ss" id="newmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  {{$escort->name}} to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <!-- <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> -->
                    </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
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
                    <button type="submit" class="btn main_bg_color site_btn_primary">Post Reviews</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model start here 3-->

<div class="modal" id="my_legbox" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width rounded-0">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/my-legbox.png')}}" class="custompopicon"> My Legbox</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h1 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                    <span id="Lname">My Legbox is only available to Viewers. Please log in or Register to access your Legbox.</span>
                </h1>
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
            </div>
        </div>
    </div>
</div>

{{-- Message Me --}}
    <div class="modal fade upload-modal" id="messageMe" tabindex="-1" role="dialog" aria-labelledby="messageMe"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageMe"><img src="{{ asset('assets/app/img/replaysmsicon.png') }}" class=" "> Message Me</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <h4 class="text-center">Are you sure you want to mark this Appointment as completed?</h4>
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
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                        'Oops!',
                        'Error while saving your feedback',
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
                    $('#add_reviews').modal("hide");
                    
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
    $(document).ready(function () {
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


    $(document).on('click', '#legbox_btn', function () {
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
                        $("#reportDesc").text(desc);
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


</script>
@endpush
