@extends('layouts.web')
@section('content')
<style>
.tooltip-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
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

@if($brb)
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

</style>

@if(str_contains(url()->full(), '?no-next-page='))
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

@if(str_contains(url()->full(), '?no-prev-page='))
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
    <div class="overlay">
        @if($escort->latestActiveBrb)
            <div class="brb_details">
                <h1>BRB at {{date('h:i A d-m-Y',strtotime($escort->latestActiveBrb->selected_time))}}</h1>
                <h3>{{$brb['brb_note']}}</h3>
            </div>
        @endif
    </div>
    {{--
    <div class="profile_description_banner" style="background: url({{$escort->banner_image ? $escort->banner_image : asset('assets/app/img/profiledescrition.png')}});">
        --}}
        <div class="container profile_pic_holder custom--profile"  style="background-color: #ff3c5f; background: url({{ $escort->imagePosition(9) ? asset($escort->imagePosition(9)) : asset('assets/app/img/profiledescrition.png')}}); background-repeat: no-repeat; background-size: 100%;">
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
                <div class="profile_page_title">
                    @if($escort->membership == 1)
                    <img src="{{ asset('assets/app/img/profile/image36.png') }}">
                    @elseif($escort->membership == 2)
                    <img src="{{ asset('assets/app/img/img_gold.png') }}">
                    @elseif($escort->membership == 3)
                    <img src="{{ asset('assets/app/img/img_silver.png') }}">
                    @else
                    @endif

                    @if(strlen($escort->name) <= 250)
                            <h2 class="display_inline_block">{{ $escort->name}}</h2>
                    @else
                            <h3 class="display_inline_block" style="color: white;">{{ $escort->name}}</h3>
                        @endif
                </div>
                <div class="profile_page_name_and_phno">
                <p>{{$escort->city->name}} - {{ preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $escort->phone)) }}</p>


                    
                </div>
            </div>
            <div class="profile_page_location_and_id">
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
            <ul class="profile_page_social_profiles">
                @if(!empty($escort->user->profile_creator) && in_array(3,$escort->user->profile_creator))
                <li>
                    <a href="//{{ ($escort->user->social_links && $escort->user->social_links['facebook'] != '') ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}" target="_blank">
                    <i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li><a href="//{{ ($escort->user->social_links && $escort->user->social_links['insta'] != '') ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="//{{ ($escort->user->social_links && $escort->user->social_links['twitter'] != '') ? $escort->user->social_links['twitter'] : 'https://x.com/' }}" target="_blank"><img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png" class="twitter-x-logo" alt="logo" style="width:15px"></a></li>
                @else
                <li>
                    <a href="https://www.facebook.com/" target="_blank">
                    <i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://x.com/" target="_blank"><img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png" class="twitter-x-logo" alt="logo" style="width:15px"></a></li>
                @endif
            </ul>
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
            <!-- ffffffffff -->
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
                                            {{--
                                            <h4>{{$escort->durations->pluck('pivot')->max('massage_price')}}/hr</h4>
                                            --}}
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
                                            {{--
                                            <h4>{{$escort->durations->pluck('pivot')->max('incall_price')}}/hr</h4>
                                            --}}
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
                                            {{--
                                            <h4>{{$escort->durations->pluck('pivot')->max('outcall_price')}}/hr</h4>
                                            --}}
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
                            <span class="label">
                                @if(is_object($user_type) && in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'Remove from Legbox'}}@else{{'Save to My Legbox'}}@endif
                            </span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 table-width-dk mb-2">
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
                                    <td>{!! ($duration->pivot->massage_price) ? number_format($duration->pivot->massage_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{!! ($duration->pivot->incall_price) ? number_format($duration->pivot->incall_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{!! ($duration->pivot->outcall_price) ? number_format($duration->pivot->outcall_price) : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            <thead class="table_heading_bgcolor_color">
                                <tr>
                                    <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS):
                                        {{ config("escorts.profile.Security.$escort->payment_type")}}
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
                        <table class="table table_striped">
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
                                            {{ $availability->availability_time[$day]; }}
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
<!--                    --><?php
//                    dd($escort->user->contact_type);
//                    ?>
                    
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
                    <div class="padding_20_tob_btm_side">
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
                                            <div class="row margin_zero_for_table">
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <?php
                                                    $tableData = [
                                                        1 => '', 2 => '', 3 => ''
                                                    ];
                                                    if(!empty($cat1_services_one)){
                                                        $i = 1;
                                                        foreach($cat1_services_one as $service) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">'.$service->name.'</td>
                                                                    <td class="table_border_solid_left">'. ($service->pivot->price ? '$'. number_format($service->pivot->price) : '<span class="if_data_not_available">N/A</span>') .'</td>
                                                                </tr>';
                                                            ($i == 3) ? $i=1 : $i++;
                                                        }
                                                        if($i == 2) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        } elseif($i == 3) {
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        }
                                                    }
                                                    ?>
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        {!! $tableData[1] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        {!! $tableData[2] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        {!! $tableData[3] !!}
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
                                            <div class="row margin_zero_for_table">
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <?php
                                                    $tableData = [
                                                        1 => '', 2 => '', 3 => ''
                                                    ];
                                                    if(!empty($cat2_services_one)){
                                                        $i = 1;
                                                        foreach($cat2_services_one as $service) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">'.$service->name.'</td>
                                                                    <td class="table_border_solid_left">'. ($service->pivot->price ? '$'. number_format($service->pivot->price) : '<span class="if_data_not_available">N/A</span>') .'</td>
                                                                </tr>';
                                                            ($i == 3) ? $i=1 : $i++;
                                                        }
                                                        if($i == 2) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        } elseif($i == 3) {
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        }
                                                    }
                                                    ?>
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {!! $tableData[1] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {!! $tableData[2] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {!! $tableData[3] !!}
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
                                On Me
                                <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table">
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <?php
                                                    $tableData = [
                                                        1 => '', 2 => '', 3 => ''
                                                    ];
                                                    if(!empty($cat3_services_one)){
                                                        $i = 1;
                                                        foreach($cat3_services_one as $service) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">'.$service->name.'</td>
                                                                    <td class="table_border_solid_left">'. ($service->pivot->price ? '$'. number_format($service->pivot->price) : '<span class="if_data_not_available">N/A</span>') .'</td>
                                                                </tr>';
                                                            ($i == 3) ? $i=1 : $i++;
                                                        }
                                                        if($i == 2) {
                                                            $tableData[$i] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        } elseif($i == 3) {
                                                            $tableData[3] .= '<tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>';
                                                        }
                                                    }
                                                    ?>
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {!! $tableData[1] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           {!! $tableData[2] !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                    <table class="table table_border_dash">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {!! $tableData[3] !!}
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
                                    {{-- @if(count($escort->medias) == 0 || $escort->membership == 4)
                                    <div class="carousel-item active " data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="{{asset('assets/app/img/service-provider/Frame-408.png') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($escort->membership != 4)
                                    @foreach($escort->medias as $key=>$media)
                                    @if($media->type == 0)
                                    <div class="carousel-item {{($key == 0) ? "active" : ""}}" data-interval="10000">
                                    <div class="row">
                                        <div class="col-12 remove_padding_for_carousel">
                                            <img src="{{ asset($media->path) }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="carousel-item {{($key == 0) ? "active" : ""}}" data-interval="10000">
                                <div class="row">
                                    <div class="col-12 remove_padding_for_carousel">
                                        <video width="100%" height="144" controls>
                                            <source  src="{{ asset($media->path) }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif --}}
                            @if($escort->gallary->isNotEmpty())
                            @foreach($escort->gallary()->wherePivotIn('position',[1,2,3,4,5,6,7])->get() as $key=>$media)
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
                                    <div class="modal-header border-0">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen pt-3 mt-1 pr-4"></span>
                                        </button>
                                        <div class="col-12">
                                            {{--
                                            <div class="popup-tab-heading">
                                                --}}
                                                <ul class="nav nav-tabs justify-content-center border-0">
                                                    <!--  <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">All</a>
                                                        </li> -->
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1">Photos</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">Videos</a>
                                                    </li>
                                                </ul>
                                                {{--
                                            </div>
                                            --}}
                                        </div>
                                    </div>
                                    <div class="modal-body p-1">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="gallery">
                                                    @if($escort->gallary->isNotEmpty())


                                                            <div class="gallery__item gallery__item--lg">
                                                                <img src="{{ ($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()) ? asset($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()->path) : ''}}" alt="">
                                                                {{-- <img src="{{ asset('assets/app/img/profile/profile-2.jpg') }}" alt=""> --}}
                                                            </div>
                                                            @foreach($escort->gallary()->wherePivotIn('position',[2,3,4,5,6,7])->orderBy('position','asc')->get() as $key=>$media)
                                                            <div class="gallery__item">
                                                                <img src="{{ asset($media->path) }}" alt="">
                                                            </div>

                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                                                <div class="row pl-0 ml-0 pr-1 pb-3" id="dvSource">
                                                    <div class="col-md-4" id="dm_2">
                                                        <a href="#">
                                                            <video style="z-index: 1" controls="" id="videoId_2" src="{{ asset('escorts/videos/8/mov-bbb.mp4') }}">
                                                                <source src="{{ asset($path) }}" type="video/mp4">
                                                            </video>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="col-md-4" id="dm_3">
                                                        <a href="#">
                                                            <video style="z-index: 1" controls="" data-id="3" data-position="" id="videoId_3" src="{{ asset('escorts/videos/8/shuttle.mp4') }}">
                                                                <source src="{{ asset('escorts/videos/8/shuttle.mp4') }}" type="video/mp4">
                                                            </video>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4" id="dm_4">
                                                        <a href="#">
                                                            <video style="z-index: 1" controls="" data-id="4" data-position="" id="videoId_4" src="{{ asset('escorts/videos/8/movie.mp4') }}">
                                                                <source src="{{ asset('escorts/videos/8/movie.mp4') }}" type="video/mp4">
                                                            </video>
                                                        </a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab1">
                                                <div class="row tab-pane fade  active show" id="home">
                                                    @foreach($escort->medias as $key=>$media)
                                                    @if($media->type == 0)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                    </div>
                                                    @else
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div>
                                                            <video width="248" height="250" controls>
                                                            <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab2">
                                                <div class="row tab-pane fade" id="menu1">
                                                    @foreach($escort->medias as $key=>$media)
                                                    @if($media->type == 0)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                    </div>

                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab3">
                                                <div class="row tab-pane fade" id="menu2">
                                                    @foreach($escort->medias as $key=>$media)


                                                    @if($media->type == 1)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div>
                                                            <video width="248" height="250" controls>
                                                            <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                {{-- <div class="row" id="home">
                                                    @foreach($escort->medias as $key=>$media)
                                                    @if($media->type == 0)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                    </div>
                                                    @else
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div>
                                                            <video width="248" height="250" controls>
                                                            <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                                <div class="row" id="menu1">
                                                    @foreach($escort->medias as $key=>$media)
                                                    @if($media->type == 0)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                    </div>

                                                    @endif
                                                    @endforeach
                                                </div>
                                                <div class="row" id="menu2">
                                                    @foreach($escort->medias as $key=>$media)


                                                    @if($media->type == 1)
                                                    <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                        <div>
                                                            <video width="248" height="250" controls>
                                                            <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div> --}}
                                            </div>
                                            </div> -->
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
        <div class="col-5">
            <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#mysendmessage">
            <img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Message Me</button>
        </div>
        <div class="col-7 text-right">
            <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#sendcarlat"><img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Report Advertiser</button>
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
        <!-- <img class="likeImg" id="like" value='1' src="{{ asset('assets/app/img/like.png') }}"> -->
        </div>
    </div>

    @if($escort->user->available_playmate)
    <div class="box_shadow manage_padding_margin_bg_color">
        <div class="profile_card_border profile_description_contect">
            <h2><img src="{{ asset('assets/app/img/bedroom.svg') }}"> Playmates</h2>
        </div>
        <div class="padding_20_tob_btm_side reduse_pad">
            @if(!is_null($escort->user->playmates) && $escort->user->playmates->count() > 0)
                <p class="profile_description_contect_pera">Message me to arrange a play date.</p>
                <div class="row play_grid">
                    {{-- @if(!auth()->user()->playmates->isEmpty()) --}}
                    @foreach($escort->user->playmates as $playmate)
                    <div class="col-6">
                        <a href="{{ route('profile.description',$playmate->id)}}" target="_blank">
                            <div class="d-flex align-items-center five_px_gap_img_text">
                                <img title="Click to view my Profile" alt="Avatar" class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="{{$playmate->default_image ? asset($playmate->default_image) : asset('assets/app/img/icons-profile.png') }}">
                                <p class="suggase_profile_name">{{ $playmate->name }}</p>
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
    @endif
    <!-- jkjkgjkhf -->
    <div class="box_shadow manage_padding_margin_bg_color">
        <div class="profile_card_border profile_description_contect">
            <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting me</h2>
        </div>
        <div class="padding_20_tob_btm_side reduse_pad">
            <span class="span_display_block connecting_me_chat_phone">
                You can contact me by:
               <!-- Tooltip for WeChat Icon -->
                    @php
                        $contactType = isset($user->contact_type) ? json_decode($user->contact_type) : [];
                    @endphp
                    @if(in_array(3,$contactType))
                    <div class="tooltip-wrapper">
                        <img src="{{ asset('assets/app/img/email-me.png') }}">
                        <div class="tooltip-text">Email me</div>
                    </div>
                    
                    
                    @endif
 
                    @if(in_array(4,$contactType))
                        @if(in_array(3,$contactType))
                            or
                        @endif
                        <div class="tooltip-wrapper">
                            <img src="{{ asset('assets/app/img/phoneicon.svg') }}">
                            <div class="tooltip-text">Call me</div>
                        </div>
                    @endif
                    @if(in_array(2,$contactType))
                        @if(in_array(4,$contactType))
                            or
                        @endif
                        <div class="tooltip-wrapper">
                                <img src="{{ asset('assets/app/img/wechat.svg') }}">
                                <div class="tooltip-text">Text me</div>
                        </div>
                    @endif
            </br>
            @php

            //print_r($escort->user->viewer_contact_type);
            $from = $escort->phone;
            //$to = sprintf("%s-%s-%s",
            $number = sprintf("%s-%s-%s",
            substr($from, 0, 3),
            substr($from, 3, 3),
            substr($from, 6));
            //dd($number);
            @endphp
            <b>When texting me please say:</b>
            <p class="profile_description_contect_pera">
                <b><i>Hi {{ $escort->name }}, I found you on Escorts4u ...</i></b>
                @php
                    $contactTypes = $escort->user->viewer_contact_type ?? [];
                    $hasPhone = in_array(1, $contactTypes) || in_array(2, $contactTypes);
                    $hasEmail = in_array(3, $contactTypes);
                    $formattedNumber = preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $number));
                    //dd($formattedNumber);
                @endphp

                @if(!empty($contactTypes))
                    @if($hasPhone && $hasEmail)
                        on my number {{ $formattedNumber }} or email {{ $escort->user->email ?? '' }}
                    @elseif($hasPhone)
                        on my number {{ $formattedNumber }}
                    @elseif($hasEmail)
                        on my email {{ $escort->user->email ?? '' }}
                    @else
                        on my number --
                    @endif
                @else
                    on my number {{$formattedNumber != '' ? $formattedNumber : '--'}}
                @endif
            </p>
            {{-- <p class="profile_description_contect_pera">
                    "<b><i>Hi {{ $escort->name }}, I found you on Escorts4u ...</i></b>" 
                    @if(!empty($escort->user->viewer_contact_type)) 
                    @if(in_array(1, $escort->user->viewer_contact_type) || in_array(2, $escort->user->viewer_contact_type)) @if(in_array(3,
                    $escort->user->viewer_contact_type)) on my number {{ preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $number)) }} or email {{ $escort->user->email ?? '' }} @else on my number {{
                    preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', preg_replace('/\D/', '', $number)) }} @endif @elseif(in_array(3, $escort->user->viewer_contact_type)) on my email {{ $escort->user->email ?? '' }} @else on my number -- @endif @else
                    on my number -- @endif
            </p> --}}
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

    <!-- accordien start here -->
    <div class="accordion-container-new">
        <div class="set">
            <a class="pb-1 pt-1">
            My Pricing Policy
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
                <div class="accodien_manage_padding_content">
                    {{--{!! $escort->pricing_policy !!} --}}
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
    <!-- accordien end here -->
    <!-- tip section start here -->
    <div class="box_shadow padding_twelve_px">
        <div class="profile_card_border profile_description_contect position-relative">
            <h2><img src="{{ asset('assets/app/img/tips.svg') }}">Tips</h2>
            <!-- Carousel controls start-->
        {{--
        <div class="arroww_tip_crousal">
            <a class="carousel-control-prev manage_oprcity next-01" href="#tipcrousal" data-slide="prev" id="prev">
            <i class="fa fa-arrow-left text-white" aria-hidden="true"></i>
            </a>
            <!--number indicatert start here -->
            <div class="num-01 indicator_align_between_aero_center"></div>
            <!--number indicatert end here -->
            <a class="carousel-control-next manage_oprcity prev-01" href="#tipcrousal" data-slide="next" id="next">
            <i class="fa fa-arrow-right text-white" aria-hidden="true"></i>
            </a>
        </div>
        --}}
        <!-- Carousel controls end-->
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

    {{--- Ye Old wala hai 
    <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
        <div class="profile_card_border profile_page_box_heading">
            <h2 class="custom--review"><img src="/assets/app/img/review-custom.png"> Reviews</h2>
        </div>
        <div class="padding_20_tob_btm_side">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="carousel-item carousel-item-next carousel-item-left">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 d-none">
                                            <div class="d-flex align-items-center gap_between_text_and_img">
                                                <div class="manage_testimonials_profile_img">
                                                    <img src="{{ asset('assets/app/img/profile/testmonialbyimg.png') }}">
                                                </div>
                                                <div class="testimonial_by">Sierra-1</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="star-rating">
                                                <div class="testimonial_by">Sierra-1</div>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><b class="">3.5</b></li>
                                                </ul>
                                                <p class="mb-0">Reviewed [19-05-2025]</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum idac nisl bibendum scelerisque non non.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item active carousel-item-left">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 d-none">
                                            <div class="d-flex align-items-center gap_between_text_and_img">
                                                <div class="manage_testimonials_profile_img d-none">
                                                    <img src="{{ asset('assets/app/img/profile/testmonialbyimg.png') }}">
                                                </div>
                                                <div class="testimonial_by">Sierra</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="star-rating">
                                                <div class="testimonial_by">Sierra</div>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                                    <li class="list-inline-item testi_icon_color"><b class="">3.5</b></li>
                                                </ul>
                                                <p class="mb-0">Reviewed [19-05-2025]</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum idac nisl bibendum scelerisque non non.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <div class="row">
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
                                <div class="col-md-12 custom-review-arrow">
                                    <div class="arroww next_prev">
                                        <a class="carousel-control-prev manage_oprcity custom-prev" href="#myCarousel" data-slide="prev">
                                        <img src="{{ asset('assets/app/img/prev.svg') }}">
                                        </a>
                                        <a class="carousel-control-next manage_oprcity custom-next" href="#myCarousel" data-slide="next">
                                        <img src="{{ asset('assets/app/img/next.svg') }}"> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- if escort has no review then show this section -->
                    <div class="py-3 row d-none">
                        <div class="col-md-12">
                            <p class="testimonial">
                                <strong>Sierra</strong> has no Reviews. Why don’t you give <strong>Sierra</strong> their first Review?’ 
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
                </div>
                 end --}}

                <!---  new review card -->
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2 class="custom--review"><img src="/assets/app/img/review-custom.png"> Reviews</h2>
                    </div>
                    <div class="padding_20_tob_btm_side">
                        <!-- new-review-card -->
                        <div class="review-card mx-auto position-relative">
                            <!-- Carousel -->
                            <div id="reviewCarousel" class="carousel slide carousel-slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item carousel-custome-item active">
                                        <h5>Sierra-1</h5>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star-half"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                            <li class="list-inline-item testi_icon_color"><b class="">3.5</b></li>
                                        </ul>
                                        <p class="custome-text-date">Reviewed [19-05-2025]</p>
                                        <div class="review-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui.
                                        </div>
                                    </div>

                                    <div class="carousel-item carousel-custome-item">
                                        <h5>Sierra-2</h5>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><b class="">5</b></li>
                                        </ul>
                                        <p class="custome-text-date">Reviewed [19-05-2025]</p>
                                        <div class="review-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui.
                                        </div>
                                    </div>
                                    <div class="carousel-item carousel-custome-item">
                                        <h5>Sierra-3</h5>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                            <li class="list-inline-item testi_icon_color"><b class="">4</b></li>
                                        </ul>
                                        <p class="custome-text-date">Reviewed [19-05-2025]</p>
                                        <div class="review-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui.
                                        </div>
                                    </div>
                                </div>

                                <!-- Custom Nav Buttons -->
                                <div class="d-flex justify-content-start my-3 carousel-nav-btn-wrapper">
                                    <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="prev"><i class="fa fa-angle-left text-white"></i></button>
                                    <button class="carousel-nav-btn" data-bs-target="#reviewCarousel" data-bs-slide="next"><i class="fa fa-angle-right text-white"></i></button>
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <div class="row">
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

                        </div>
                    </div>
                    <!--- if escort has no review then show this section -->
                    <div class="py-3 row d-none">
                        <div class="col-md-12">
                            <p class="testimonial">
                                <strong>Sierra</strong> has no Reviews. Why don’t you give <strong>Sierra</strong> their first Review?’
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
<!-- sssssssssssssssss -->
</div>
</div>
<!-- model start here 1-->
<div class="modal fade" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <li>You will receive a notification when this message is responded to.</li>
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
<!-- Report advertiser model start here 2-->
<div class="modal fade ss" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  {{$escort->name}} to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes :</b></p>
                    <div class="row">
                        <div class="col">
                            <ol>
                                <li>Only report if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reports, as it may result in your Account being suspended.
                                Only genuine reports will be considered.</li>
                                <li>The Advertisers Membership Number will automatically attach to this report.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">What is wrong:</label>
                                <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" placeholder="Message (500 characters)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex  align-items-center">
                                <p class="diff_font_pera mb-0 mr-2">Why are you reporting this Profile:</p>
                                <div class="form-check py-0 mr-2">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="1">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Fake Media
                                    </span>
                                </div>
                                <div class="form-check py-0 mr-2">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="0">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Spam
                                    </span>
                                </div>
                                <div class="form-check py-0">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="2">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Other
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary rounded">Send Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Report Advertiser Modal login popup if not login-->
<div class="modal fade" id="reportAdvertiserNew" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
 
            <!-- Header with navy background and [X] -->
            <div class="modal-header" style="background-color: #0e2346; color: white; display: flex; justify-content: space-between; align-items: center; border-radius:0px">
                <h5 class="modal-title font-weight-bold" id="reportAdvertiserLabelNew">Report Advertiser</h5>
                <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;">
                <img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/newcross.png" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
 
            <!-- Body content -->
            <!-- Body content -->
            <div class="modal-body text-center">
                <p class="font-weight-bold">Please log in or Register to report Advertiser</p>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('login') }}" class="mx-3 font-weight-bold" style="color:#0C223D; text-decoration:none;">[Login]</a>
                    <a href="{{ route('register') }}" class="mx-3 font-weight-bold" style="color:#0C223D; text-decoration:none;">[Register]</a>
                </div>
            </div>
 
        </div>
    </div>
</div>
 
 
<!-- Report Advertiser Modal confirmation popup -->
<div class="modal fade" id="reportLogedIn" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
 
            <!-- Header with navy background and [X] -->
            <div class="modal-header" style="background-color: #0e2346; color: white; display: flex; justify-content: space-between; align-items: center; border-radius:0px">
                <h5 class="modal-title font-weight-bold" id="reportAdvertiserLabelNew">Report Loged</h5>
                <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;">
                <img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/newcross.png" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
 
            <!-- if logi Body content -->
           
            <div class="modal-body text-left">
                <p class="font-weight-bold">Thank you for your report. Someone from our team will be in
                touch shortly.</p>
             
            </div>
 
        </div>
    </div>
</div>
 
<!-- Trigger Button -->
<!--- <button type="button" class="btn btn-outline-danger mt-3" data-toggle="modal" data-target="#reportLogedIn">
   Viewer Loged In
</button>

 <button type="button" class="btn btn-outline-danger mt-3" data-toggle="modal" data-target="#reportAdvertiserNew">
 login popup
 </button> -->





<!-- model start here 3-->
<div class="modal fade add_reviews" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Add review for {{ $escort->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
{{--                <input type="hidden" value="" name="star_rating">--}}
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes</b></p>
                    <div class="row">
                        <div class="col teop-text">
                            <ul>
                                <li>Only review if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reviews, as they will not be published.</li>
                                <li>To contact this Escort click on <span style="color: #FF3C5F; ">Message Me</span>.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">Tell us about your experience:</label>
                                <textarea name="description" class="form-control popup_massage_box" id="review_textarea" rows="3" placeholder="Message (500 characters)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="revew-myratings">
                        <p class="mb-0" style="font-size: 20px;">Rating:</p>
                        <div class="rating-stars">
                            <!-- Repeatable SVG stars -->
                            <svg class="star" data-value="1" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                            </svg>
                            <svg class="star" data-value="2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                            </svg>
                            <svg class="star" data-value="3" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                            </svg>
                            <svg class="star" data-value="4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                            </svg>
                            <svg class="star" data-value="5" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                            </svg>
                        </div>
                        <input type="hidden" id="userRating" name="rating" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary rounded">Submit Review</button>
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
{{--<div class="modal fade add_reviews" id="newmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content custome_modal_max_width">--}}
{{--            <div class="modal-header main_bg_color">--}}
{{--                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">--}}
{{--                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Add review for Carla Brasil--}}
{{--                </h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                <span aria-hidden="true">--}}
{{--                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">--}}
{{--                </span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}
{{--                    <p class="popu_heading_style">Notes</p>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col teop-text">--}}
{{--                            <ul>--}}
{{--                                <li>Only review if you had direct contact with the Escort.</li>--}}
{{--                                <li>Do not write fake or abusive reviews, as they will not be published.</li>--}}
{{--                                <li>To contact this Escort click on Message Me.</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="form-group popup_massage_box">--}}
{{--                                <label for="exampleFormControlTextarea1">Tell us about your experience:</label>--}}
{{--                                <textarea id="review_textarea" name="description" class="form-control popup_massage_box" rows="3" placeholder="Message (250 characters)"></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="revew-myratings">--}}
{{--                        <p class="mb-0">Rating:</p>--}}
{{--                        <div class="rating">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">--}}
{{--                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">--}}
{{--                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">--}}
{{--                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">--}}
{{--                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">--}}
{{--                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="submit" class="btn main_bg_color site_btn_primary">Post Reviews</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="modal" id="my_legbox" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width rounded-0">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">My Legbox</h5>
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
                <a href="{{ route('viewer.login') }}" type="button" class="btn btn-danger site_btn_primary" id="loginUrl" >Login</a>
                <a href="{{ route('register') }}" type="button" class="btn btn-danger site_btn_primary" id="regUrl">Register</a>
            </div>
        </div>
    </div>
</div>
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
        //var url = '/escort-dashboard/escort-like/vote';
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
                // dataType: "json",
                // data: {'review' : $("#review_textarea").val(), 'rating' : $('#star_rating').val()},
                data: data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#reviewAdvertiser')[0].reset();
                    $('#add_reviews').modal("hide");
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
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


</script>
@endpush
