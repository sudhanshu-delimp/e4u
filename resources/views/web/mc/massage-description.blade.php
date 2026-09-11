@extends('layouts.web')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/lightbox/css/glightbox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/lightbox/css/lightbox.css?v1.01') }}">
<style>
.mc_profile_table .table th{
    padding: .8rem .55rem !important;
}
.timing_data tbody td{
    text-align: left !important;
}

.profile_img {
    border-radius: 100%;
    box-shadow: 0px 0px 3px 1px #ccc;
}
.our-masseurs {
    border-radius: 23px;

}

.tooltip-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
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
    top:-35px;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s;
}
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

.mc_avail_table table td {
    padding: 5px 0px !important;
}
.masseurs_modals{
    max-width: 1000px !important;
}

.masseur-modal {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.masseur-modal.show {
    opacity: 1;
}

.btn-disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}
.previousDisableButtonCss {
  background: gray;
  opacity: 0.5;
  cursor: not-allowed;
}


.overlay { 
  height: 101%;
  width: 100%;
  text-align: center;
  z-index: 1;
  border-radius: 20px;
  text-align: center;
}
.custom--overlay .overlay {
  background-color: transparent;
  width: 100%;
  position: unset;
  margin: unset; 
}
.brb_details {
  color: #fff;
  padding: 10px;
  max-width: 1200px;
  margin: 0 auto;
  background: var(--peach);
}

.location_class{
    display: flex;
    align-items: center;
    flex-direction: column;
    font-size: 13px;
    font-weight: 500;
    padding: 10px 0px 0px 0px;
}

.location_class img {
    width: 190px;
    height: 50px;
    padding-bottom: 5px;
    border-radius: 10px;
}
.gm-style-iw-ch {
    display: none !important;
}
.gm-style-iw-chr{
    display: none !important;
}

.star-rating {
    display: inline-flex;
    font-size: 18px;
    line-height: 1;
}

.star {
    position: relative;
    display: inline-block;
    width: 1em;
    height: 1em;
    margin-right: 2px;
}

.star::before {
    content: "★";
    color: #ddd; 
    position: absolute;
    left: 0;
}

.star.full::before {
    color: #f5c518; 
}

.star.half::before {
background: linear-gradient(90deg, #f5c518 50%, #ddd 50%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}
.location_rating{
font-size: 12px;
margin-top: 4px;
margin-right: 5px;
}
</style>
    @stop
    @section('content')

    @php 
        $baseUrl= url('/').'/';
        $massager_name = $listing->profile_name;
        $business_name = $listing->business_name;
        $other_services = "";
        $massage_services = "";

        


        $massage_price  = false;
        $incall_price   = false;
        $outcall_price  = false;


        $relativePath   =  $listing->imagePosition(9);
        $currentImage   = asset($relativePath);
        if($currentImage!= "" && is_file(public_path($relativePath)))
        $massage_banner  = $currentImage;
        else
        $massage_banner = asset('assets/app/img/massage/massage_2.jpg');


        $images = [];
        
        $validImages = [];

        $photo = 1;

        for ($i = 1; $i <= 7; $i++) {
            $image_detail = [];
            $img = get_massage_images($listing, $i);
            $image_data =  get_image_position_detail($listing, $i);
            if(!empty($image_data)){
                $image_detail['id'] = $image_data['id'];
                $image_detail['varified'] = $image_data['varified'];
            }
            $images[$i] = $img;

            if ($img !== false) {
                $validImages[$i]['url'] = $img;
                $validImages[$i]['image_data'] = $image_detail;
            }
        }


    $social_links = get_social_links($listing->user_id);
    if(isset($social_links['twitter']) && $social_links['twitter']!="")
    $twitter_link =   $social_links['twitter'];
    else
    $twitter_link = "https://x.com/NMugs32853"; 



    $rates_header = "";

    $payType = '';
    foreach(config('escorts.profile.Payments') as $key => $PaymentType) {
        if ($listing->payment == $key) {
            $payType = $PaymentType;
            break; 
        }
                                                    }
     
    $galleryVideos = $listing->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();
    
    $massage_user  = get_massage_parent_data($listing->user_id);
    $capital_city  = "";
    if($massage_user)
    {   $home_state = $massage_user->state_id;
        $capital_city = config("escorts.profile.states.$home_state.cityName");
    }
    @endphp


   <div class="container p-0 profile_description_banner custom--profile custommassage--profile--page"
     style="background-image: url('{{ $massage_banner }}');
            background-position: center;
            background-repeat: no-repeat; background-size:cover;">

        @if($prevList || $nextList)
        <div class="back_to_list">
             <a href="{{$baseUrl.config("constants.massage_list_base_slug")}}" class="back--search "> 
                <span class="previous_icon">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <g opacity="0.4"> <path d="M9.00039 15.3802H13.9204C15.6204 15.3802 17.0004 14.0002 17.0004 12.3002C17.0004 10.6002 15.6204 9.22021 13.9204 9.22021H7.15039" stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                
                </span> <span class="hide_ph">Back to Search</span>  
            </a>
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">                    
                    {{-- brb banner --}}
                    <div class="new_brb-banner">
                        @if($listing->latest_active_brb)
                            <div class="brb_details">
                                <h1>Closed until {{date('h:i A',strtotime($listing->latest_active_brb->selected_time))}}</h1>
                                <h3>{{$listing->latest_active_brb->brb_note}}</h3>
                            </div>
                        @endif
                    </div>

                    <div class="profile_wrap px-3 position-relative">
                        
                        <div class="profile_header">
                            <div class="profile_page_title">
                                <h2 class="display_inline_block">{{ $listing->business_name ?? 'N/A' }}</h2>                                
                            </div> 
                        </div>
                        

                        <div class="profile_page_name_and_phno">
                            <p> {{ get_massage_home_city($listing->user_id) .' - '.formatMobileNumber($listing->phone) }}   </p>
                        </div>

                        <div class="profile_page_location_and_id mb-4">
                            <ul>
                                <li>
                                    <span class="profile_location_icon">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </span>
                                    <p class="display_inline_block">{{  $listing->address ?? 'N/A' }}</p>
                                </li>
                            </ul>
                        </div>

                        <div class="social_media_profile my-3">
                            <ul class="profile_page_social_profiles ml-0">

                                @if(isset($social_links['facebook']) && $social_links['facebook']!="")
                                    <li class="social-media-profile">
                                        <a href="{{$social_links['facebook']}}" target="_blank">
                                            <img src="{{ asset('../assets/app/img/facebook.png') }}" class="facebook-logo" alt="logo">
                                        </a>
                                    </li>
                                @endif   

                                @if(isset($social_links['insta']) && $social_links['insta']!="")
                                    <li class="social-media-profile">
                                        <a href="{{$social_links['insta']}}" target="_blank">
                                            <img src="{{ asset('../assets/app/img/instagram.png') }}" class="instagram-logo" alt="logo">
                                        </a>
                                    </li>
                                @endif  


                        
                                <li class="social-media-profile">
                                    <a href="{{ $twitter_link  }}" target="_blank">
                                        <img src="{{ asset('../assets/app/img/twitter-x.png') }}" class="twitter-x-logo" alt="logo">
                                    </a>
                                </li>
                        
                                

                            </ul>
                             <div class="profile_page_location_and_id">
                                <ul>
                                    <li>
                                        <span class="profile_location_icon">
                                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                        </span>
                                        <p class="display_inline_block">Member ID: {{   get_massage_member_id($listing->user_id) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
             
            </div>   
        </div>
        
    </div>

    <div class="container-fluid px-0 next-preview-fixed position-relative">
        <div class="d-flex d-flex justify-content-between">
            <div class="previous_btn_profile next_previous_btn_pogision {{ $prevId ? '' : 'previousDisableButtonCss' }}">
            @if($prevList)
            <a href="{{ getEscortMassageDetailUrl($prevList, 'massage') }}" class="btn_ank">
            @else 
                <a  href="{{$baseUrl.config("constants.massage_list_base_slug")}}" class="btn_ank">
            @endif
                         <span class="previous_icon">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M13.2602 15.5302L9.74023 12.0002L13.2602 8.47021" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                
                    </span>
                    <span class="previous_text remove_in_sm">Previous</span>
                </a>
            </div>
            <div class="next_btn_profile next_previous_btn_pogision {{ $nextId ? '' : 'previousDisableButtonCss' }}">
                                
        @if($nextList)
            <a href="{{getEscortMassageDetailUrl($nextList, 'massage')}}" class="btn_ank">
        @else 
            <a  href="javascript:void(0)" class="btn_ank">
         @endif
                    <span class="previous_text remove_in_sm">Next</span>
                    <span class="previous_icon">
                        
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M10.7402 15.5302L14.2602 12.0002L10.7402 8.47021" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                
                    </span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="container profile_contain">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 col-12">
                <div class="row mb-3">
                    <div class="col-md-12 col-xl-12 col-sm-12 col-12">
                        <div class="row custom_message_types">

                            <div class="col-sm-12 d-flex align-items-center justify-content-between gap-10 flex-wrap">
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/dashboard/img/massage-only.png') }}" alt="Massage">
                                        <p class="mc_rate_tooltip">Massage only</p> 
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_massage"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}" alt="Masseur">
                                     <p class="mc_rate_tooltip">Massage with extras +2 hands.</p> 
                                    </div>    
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>+2 Hands</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_masseur"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="{{ asset('assets/dashboard/img/massage-with4.png')}}" alt="2+ Masseurs">
                                    <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>   
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>+4 Hands</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_two_masseur"></h4>
                                        </div>
                                    </div>
                                </div>
                                    <button type="button" class="btn my_legbox all_btn_flx" id="legbox_btn">
                                        @php 
                                            $user_type = auth()->user();
                                        @endphp
                                        @if(auth()->user())
                                    
                                            @if(auth()->user()->type == 0)
                                                <span class="add_to_favrate @if(is_object($user_type) && in_array($listing->id,$user_type->massageCenterLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif"
                                                    id="legboxId_{{$listing->id}}" data-escortId="{{$listing->id}}"
                                                    data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                                                    @if(!empty($user_type))
                                                        @if(in_array($listing->id,$user_type->massageCenterLegBox->pluck('id')->toArray()))
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
                                                <span class="add_to_favrate" data-escortId="{{$listing->id}}"
                                                    data-name="{{$listing->business_name}}"><i class="fa fa-heart-o"
                                                                                    aria-hidden="true"></i></span>
                                            @endif
                                            <span class="label save-my-legbox-btn">
                                                @if(is_object($user_type) && in_array($listing->id,$user_type->massageCenterLegBox->pluck('id')->toArray())){{'Remove from Legbox'}}@else{{'Save to My Legbox'}}@endif
                                            </span>
                                    </button>   
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mc_profile_table">
                    <div class="col-lg-6 col-md-12 table-responsive">
                        <table class="table table_striped">
                            <thead>
                                <tr>
                                    <th>Rates</th>
                                    <th>Massage</th>
                                    <th>Masseur</th>
                                    <th>2+ Masseurs</th>
                                </tr>
                            </thead>

                            <tbody>

                            

                            @foreach($durations->whereIn('id',[2,3,4,5,6,7]) as $duration)
                            @php
                            
                            if($duration->id!="")
                            {

                                if(!empty($massage_durations))
                                {
                                    foreach($massage_durations as $db_duration)  
                                    {
                                        if(isset($db_duration['pivot']['duration_id']) && $db_duration['pivot']['duration_id']==$duration->id)
                                        {
                                            
                                                $massage_price = isset($db_duration['pivot']['massage_price']) ? $db_duration['pivot']['massage_price'] : null;
                                                $incall_price = isset($db_duration['pivot']['incall_price']) ? $db_duration['pivot']['incall_price'] : null;
                                                $outcall_price = isset($db_duration['pivot']['outcall_price']) ? $db_duration['pivot']['outcall_price'] : null;

                                                
                                                if($duration->id==5)
                                                {
                                                    $rates_header = [
                                                        'massage'   => $massage_price,
                                                        'incall'    => $incall_price,
                                                        'outcall'   => $outcall_price,
                                                    ];
                                                }

                                            
                                            break;
                                            
                                        } 

                                        
                                    }   
                                }
                            }
                            @endphp

                                    


                                <tr>
                                    <td> {{$duration->name}} </td>
                                    <td>

                                           @if($massage_price !== null && floatval($massage_price) != 0.0) 
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $massage_price }}
                                                </div>
                                            @else
                                               <div class="text-center"><span class="na-label">N/A</span></div> 
                                            @endif

                                    </td>

                                    <td>
                                        @if($incall_price !== null && floatval($incall_price) != 0.0)
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $incall_price }}
                                                </div>
                                            @else
                                               <div class="text-center"><span class="na-label">N/A</span></div> 
                                            @endif
                                    </td>
                                    <td>

                                             @if($outcall_price !== null && floatval($outcall_price) != 0.0)
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $outcall_price }}
                                                </div>
                                            @else
                                               <div class="text-center"><span class="na-label">N/A</span></div> 
                                            @endif

                                    </td>
                                </tr>
                            @endforeach    
                                
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="4">
                                        Payment ($AUS) : {{ $payType }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>

                    <div class="col-lg-6 col-md-12 table-responsive">
                        <table class="table table_striped timing_data">
                            <thead>
                                <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php echo get_weakly_availibility($listing); ?>
                            </tbody>
                        </table>

                        
                    </div>

                    <div class="col-sm-12"> 
                        <div  id="map" style="width:100%; height:200px; border-radius:8px;">


                            <!-- <iframe 
                            width="100%" 
                            height="153" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{ urlencode($listing->address ?? 'Perth, Western Australia') }}&hl=en&z=14&output=embed"
                            style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                        </iframe> -->
                        <!-- <iframe
                            width="100%"
                            height="153"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCrDJA0TAg9Q9MThHqRe9tGCsNsU4vMrcQ&q={{ urlencode($listing->address ?? 'Perth, Western Australia') }}&zoom=16">
                        </iframe> -->
                        
                        </div>
                    </div>
                </div>

                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>About us</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <div class="row">

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Building:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Building.' . $listing->parking, 'N/A') }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Parking:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Parking.' . $listing->parking, 'N/A') }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Entry:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Entry.' . $listing->entry, 'N/A') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Type:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.furniture_types.' . $listing->furniture_types, 'N/A') }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Shower:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Shower.' . $listing->parking, 'N/A') }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Ambiance:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Ambiance.' . $listing->ambiance, 'N/A') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Security:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Security.' . $listing->security, 'N/A') }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Payment:</span>
                                    <span class="about_box_small_heading_value">{{ $payType }}</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Loyalty program:</span>
                                    <span class="about_box_small_heading_value">{{ config('escorts.profile.Loyalty.' . $listing->loyalty, 'N/A') }}</span>
                                </div>
                                
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 pt-2">
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Address:</span>
                                    <span class="about_box_small_heading_value">{{$listing->address}}</span>
                                </p>
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Languages:</span>
                                    <span class="about_box_small_heading_value">English, Spanish</span>
                                </p>
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Massage Service:</span>
                                    <span class="about_box_small_heading_value">
                                    @foreach ($listing->massage_services()->where('category_id', 1)->get() as $value)
                                    @php
                                    $massage_services .= config('escorts.profile.massage-services')[$value->service_id] . ', ';
                                    @endphp
                                    @endforeach

                                    {{ rtrim($massage_services, ', ') }}
                                    </span>
                                </p>
                                <p>
                                    <span class="about_box_small_heading">Other Service Types:</span>
                                    <span class="about_box_small_heading_value">
                                        @foreach ($listing->massage_services()->where('category_id', 2)->get() as $value)
                                        @php
                                        $other_services .= config('escorts.profile.other-services')[$value->service_id] . ', ';
                                        @endphp
                                        @endforeach

                                        {{ rtrim($other_services, ', ') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Who are we?</h2>
                    </div>
                    <div class="padding_20_tob_btm_side">
                        <div class="text-justify">
                            {!! $listing->about_us_box !!}
                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Our Masseurs</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <p class="text-justify">
                            Check out our experienced Masseurs. All services are conducted in private.
                            Feel free to ask us or any of our Masseurs any questions about our services.
                        </p>

                        <div class="row">
                            @if($listing->massagerMasseurs->count()>0)
                            @foreach($listing->massagerMasseurs as $index => $masseur)
                            @php

                                $masseur_services = $masseur->service ?? [];
                               
                                $imageUrl = asset($masseur->getImagePosition(1, $masseur->id));

                                if (Str::contains($imageUrl, 'mcc-default-thumbnail.png') || empty($imageUrl)) {
                                    $profile_img = asset('assets/app/img/def-masseur-therapy.avif');
                                } else {
                                    $profile_img = $imageUrl;
                                }


                                    $messure_images = [];
                                    $messure_validImages = [];
                                    $photo = 1;

                                    for ($i = 1; $i <= 4; $i++) {
                                        $img = get_messure_images($masseur, $i);
                                        $image_data = get_messure_images_details($masseur,$i);
                                        $images[$i] = $img;

                                        if ($img !== false) {
                                            $messure_validImages[$i]['url'] = $img;
                                            $messure_validImages[$i]['img_data'] = $image_data;
                                        }
                                    }

                            @endphp
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="d-flex align-items-center gap_between_text_and_img our-masseurs"
                                    data-toggle="modal" data-target="#product_view_{{$masseur->id}}" >
                                    <div><img src="{{ $profile_img }}" width="50" height="50"  class="profile_img"></div>
                                    <p class="mb-0 text_truncate">{{ $masseur->name}}</p>
                                </div>
                            </div>


                                <!-- Messeur Modal  -->
                                <div class="modal fade product_view upload-modal masseur-modal" data-page="masseur profile"  data-massure_id="{{$masseur->id}}" id="product_view_{{$masseur->id}}" data-index="{{ $loop->index }}" data-backdrop="static" data-keyboard="false"> 
                                    <div class="modal-dialog modal-dialog-centered max-modal" >
                                    <div class="modal-content">
                                        <div class="modal-header custom_header">
                                            <h5 class="mc_member_id"> <img src="{{ asset('../assets/app/img/Vector-31.png') }}" class="img-responsive"> Member ID: {{ $masseur->member_id ?? 'N/A' }} </h5>
                                            
                                            <div class="navigation_button">
                                                <button class="btn-prev"  data-massure_id="{{$masseur->id}}"><i class="fa fa-chevron-left text-white"></i> Previous </button> 
                                                <button class="btn-next"  data-massure_id="{{$masseur->id}}">Next <i class="fa fa-chevron-right text-white"></i> </button>
                                            </div>
                                            <button type="button" class="close_btn" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}"
                                                        class="img-fluid img_resize_in_smscreen"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="masseur_profile_wrapper">
                                               <div class="inner_img_wrapper">
                                                 <div class="mc_profile_img">

                                                    @foreach ($messure_validImages as $index => $image)
                                                        @if($loop->first)

                                                            @php
                                                                $status_detail = getMediaVerificationDataBigIcon($image['img_data']->varified);
                                                            @endphp

                                                            <a href="{{ $image['url'] }}"
                                                            class="glightbox main-gallery-image"  data-massure_id="{{$masseur->id}}"
                                                            data-gallery="masseure-gallery">

                                                                <img src="{{ $image['url'] }}"
                                                                    class="img-responsive"
                                                                    >
                                                                <div class="hover-overlay">
                                                                    <span>Click me!</span>
                                                                </div>
                                                            </a>

                                                        @endif
                                                    @endforeach

                                                    <div class="veryfy_img">
                                                        @if(isset($status_detail['icon']))
                                                            <img src="{{ $status_detail['icon'] }}">
                                                            <span class="common_shield_tooltip">
                                                                {{ $status_detail['label'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>

                                                <div class="masseur_extra_img">

                                                    @foreach ($messure_validImages as $index => $image)

                                                        @if(!$loop->first)

                                                            <div class="extra_img_wrapper">

                                                                <a href="{{ $image['url'] }}"
                                                                class="glightbox main-gallery-image"  data-massure_id="{{$masseur->id}}"
                                                                data-gallery="masseure-gallery">

                                                                    <img src="{{ $image['url'] }}"
                                                                        class="img-responsive ">
                                                                        <div class="hover-overlay">
                                                                            <span>Click me!</span>
                                                                        </div>
                                                                </a>

                                                                <div class="veryfy_img">
                                                                    @php
                                                                        $status_detail = getMediaVerificationDataSmallIcon($image['img_data']->varified);
                                                                    @endphp

                                                                    <img src="{{ $status_detail['icon'] }}">
                                                                    <h6 class="gallery_shield_tooltip">
                                                                        {{ $status_detail['label'] }}
                                                                    </h6>
                                                                </div>

                                                            </div>

                                                        @endif

                                                    @endforeach

                                                </div>
                                               </div>

                                                {{-- Hidden Images For Lightbox Navigation --}}
                                                <div style="display:none;">

                                                    @foreach ($messure_validImages as $image)

                                                        <a href="{{ $image['url'] }}"
                                                        class="glightbox"
                                                        data-gallery="masseure-gallery">
                                                        </a>

                                                    @endforeach

                                                </div>
                                                
                                                <div class="masseur_content" style="">
                                                     <div class="mc_tab_header">
                                                        <ul class="nav nav-tabs" id="profileTabs-{{ $masseur->id }}" role="tablist">

                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="profile-details-tab-{{ $masseur->id }}"
                                                                    data-toggle="tab" href="#profile-details-{{ $masseur->id }}" role="tab"
                                                                    aria-controls="profile-details-{{ $masseur->id }}" aria-selected="true">
                                                                    Profile Details
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a class="nav-link" id="services-tab-{{ $masseur->id }}" data-toggle="tab"
                                                                    href="#services-{{ $masseur->id }}" role="tab"
                                                                    aria-controls="services-{{ $masseur->id }}" aria-selected="false">

                                                                    Services
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a class="nav-link" id="open-times-tab-{{ $masseur->id }}" data-toggle="tab"
                                                                    href="#open-times-{{ $masseur->id }}" role="tab"
                                                                    aria-controls="open-times-{{ $masseur->id }}" aria-selected="false">

                                                                   My Availability
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                     <div class="tab-content" id="profileTabsContent-{{ $masseur->id }}">
                                                         <!-- Profile Details -->
                                                        <div class="tab-pane fade show active" id="profile-details-{{ $masseur->id }}" role="tabpanel"
                                                            aria-labelledby="profile-details-tab-{{ $masseur->id }}">
                                                            
                                                            <div class="mc_list_header">
                                                                <div class="mc_other_details">
                                                                <h6 class="mc_list_title">{{ $masseur->name ?? 'N/A' }}</h6>
                                                                    <span class="mc_list_rating">AGE : <span class="age">{{ $masseur->age ?? 'N/A' }}</span></span>
                                                                </div>                                                            
                                                                <div class="massage_type">
                                                                    
                                                                


                                                                    @if(in_array('massage', $masseur_services))
                                                                        <div class="massage_type_info">
                                                                            <img src="{{ asset('assets/dashboard/img/massage-only.png') }}">
                                                                            <p class="mc_rate_tooltip">Massage only</p>
                                                                        </div>
                                                                    @endif 

                                                                    @if(in_array('2_hand', $masseur_services))

                                                                        @if(in_array('massage', $masseur_services))
                                                                        <div class="massage_type_info">
                                                                            <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}">
                                                                            <p class="mc_rate_tooltip">Massage with extras +2 hands.</p>
                                                                        </div>
                                                                        @endif 

                                                                    @endif 
                                                                    
                                                                    
                                                                    @if(in_array('4_hand', $masseur_services))

                                                                        @if(in_array('massage', $masseur_services) && in_array('2_hand', $masseur_services))
                                                                        <div class="massage_type_info">
                                                                            <img src="{{ asset('assets/dashboard/img/massage-with4.png') }}">
                                                                            <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>
                                                                        </div>
                                                                        @endif 

                                                                    @endif   

                                                                    

                                                                    

                                                                

                                                                </div>
                                                            </div>
                                                            <div class="mc_list_meta">
                                                                
                                                                <div class="services_card">
                                                                    <spna class="icon">
                                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.05 6C15.0268 6.19057 15.9244 6.66826 16.6281 7.37194C17.3318 8.07561 17.8095 8.97326 18 9.95M14.05 2C16.0793 2.22544 17.9716 3.13417 19.4163 4.57701C20.8609 6.01984 21.7721 7.91101 22 9.94M18.5 21C9.93959 21 3 14.0604 3 5.5C3 5.11378 3.01413 4.73086 3.04189 4.35173C3.07375 3.91662 3.08968 3.69907 3.2037 3.50103C3.29814 3.33701 3.4655 3.18146 3.63598 3.09925C3.84181 3 4.08188 3 4.56201 3H7.37932C7.78308 3 7.98496 3 8.15802 3.06645C8.31089 3.12515 8.44701 3.22049 8.55442 3.3441C8.67601 3.48403 8.745 3.67376 8.88299 4.05321L10.0491 7.26005C10.2096 7.70153 10.2899 7.92227 10.2763 8.1317C10.2643 8.31637 10.2012 8.49408 10.0942 8.64506C9.97286 8.81628 9.77145 8.93713 9.36863 9.17882L8 10C9.2019 12.6489 11.3501 14.7999 14 16L14.8212 14.6314C15.0629 14.2285 15.1837 14.0271 15.3549 13.9058C15.5059 13.7988 15.6836 13.7357 15.8683 13.7237C16.0777 13.7101 16.2985 13.7904 16.74 13.9509L19.9468 15.117C20.3262 15.255 20.516 15.324 20.6559 15.4456C20.7795 15.553 20.8749 15.6891 20.9335 15.842C21 16.015 21 16.2169 21 16.6207V19.438C21 19.9181 21 20.1582 20.9007 20.364C20.8185 20.5345 20.663 20.7019 20.499 20.7963C20.3009 20.9103 20.0834 20.9262 19.6483 20.9581C19.2691 20.9859 18.8862 21 18.5 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Mobile Number</p>
                                                                        <span>{{ formatMobileNumber($masseur->mobile) ?? 'N/A' }}</span>
                                                                    </span>
                                                                </div>  

                                                                <div class="services_card">
                                                                    <spna class="icon">
                                                                        <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 374.292 374.292" xml:space="preserve" stroke="#ff3c5f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g id="Layer_5_42_"> <g> <path d="M372.237,2.05c-2.732-2.733-7.165-2.733-9.899,0l-35.971,35.971c-0.875,0.875-1.531,0.367-1.851,0.107 c-12.455-10.131-26.936-15.445-42.306-15.445c-20.41,0-41.367,9.28-59.379,26.202c-0.238,0.184-0.471,0.377-0.688,0.596 c-0.116,0.116-0.22,0.238-0.325,0.36c-0.58,0.558-1.157,1.123-1.73,1.696l-30.261,30.261c-0.002,0.002-0.004,0.003-0.006,0.005 s-0.004,0.004-0.006,0.006l-32.313,32.313c0,0-0.001,0.001-0.002,0.002s-0.001,0.001-0.002,0.002l-32.312,32.312 c-0.003,0.003-0.006,0.005-0.009,0.008s-0.005,0.006-0.008,0.009l-20.27,20.269l0,0c0,0-3.866,3.866-5.154,5.155 c-2.667,2.667-4.605-0.104-4.605-0.104l-3.516-3.517c-4.408-4.408-10.27-6.836-16.504-6.836s-12.096,2.428-16.505,6.836 c-9.1,9.1-9.1,23.907,0,33.007c0,0,35.358,35.356,47.143,47.144c1.407,1.408-0.219,2.661-0.219,2.661l-52.063,52.062 c0,0-1.438,1.063-2.688-0.187c-4.298-4.297-17.189-17.19-17.189-17.19c-3.718-3.718-8.661-5.765-13.918-5.765 c-5.258,0-10.201,2.047-13.92,5.766c-7.674,7.675-7.674,20.162,0,27.837l54.935,54.934c3.718,3.718,8.661,5.765,13.919,5.765 s10.201-2.047,13.919-5.765c7.674-7.675,7.674-20.163,0-27.837c0,0-12.911-12.91-17.213-17.213 c-1.438-1.438-0.166-2.667-0.166-2.667l52.532-52.53c0,0,0.949-0.995,2.043,0.099c11.823,11.823,47.293,47.292,47.293,47.292 c4.408,4.408,10.27,6.836,16.504,6.836c6.234,0,12.096-2.428,16.504-6.836c9.1-9.101,9.1-23.908,0-33.007l-4.473-4.472 c0,0-1.189-1.608,0.185-2.982c1.455-1.456,5.822-5.822,5.822-5.822l0,0l115.188-115.187c16.22-16.22,26.315-35.575,28.426-54.498 c2.041-18.296-3.171-35.421-15.079-49.986c-0.243-0.297-0.754-0.873,0.184-1.811l35.956-35.957 C374.97,9.216,374.97,4.784,372.237,2.05z M312.851,144.301c0,0-84.6,84.6-112.8,112.8c-2.625,2.625-4.503,0.271-4.503,0.271 l-78.541-78.542c0,0-2.237-2.177,0.388-4.802c2.455-2.456,8.7-8.701,11.427-11.427c1.438-1.437,2.647,0.037,2.647,0.037 l36.241,36.241c1.367,1.367,3.158,2.05,4.95,2.05c1.791,0,3.583-0.684,4.95-2.05c2.733-2.733,2.733-7.166,0-9.899 c0,0-27.567-27.562-36.752-36.752c-0.854-0.854,0.118-1.782,0.118-1.782s15.329-15.328,20.438-20.438 c0.938-0.938,1.866-0.203,1.866-0.203l20.984,20.985c1.367,1.367,3.159,2.05,4.95,2.05s3.583-0.684,4.95-2.05 c2.733-2.733,2.733-7.166,0-9.899l-21.257-21.256c0,0-0.619-0.502,0.1-1.221c5.44-5.44,15.914-15.914,21.219-21.219 c0.594-0.594,1.012-0.076,1.012-0.076l37.114,37.115c1.367,1.367,3.159,2.05,4.95,2.05s3.583-0.684,4.95-2.05 c2.733-2.733,2.733-7.166,0-9.899L205.26,87.342c0,0-0.581-0.601,0.091-1.272c4.78-4.781,17.969-17.969,21.078-21.078 c0.813-0.813,1.27-0.055,1.27-0.055l21.209,21.208c1.367,1.367,3.159,2.05,4.95,2.05s3.583-0.684,4.95-2.05 c2.733-2.733,2.733-7.166,0-9.899l-20.443-20.444c-1.031-1.031-0.276-1.656,0.104-1.961c13.861-11.122,29.082-17.16,43.74-17.16 c14.369,0,27.33,5.676,38.524,16.87C351.316,84.134,335.601,121.551,312.851,144.301z"></path> </g> </g> </g> </g></svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Vaccination</p>
                                                                        <span>
                                                                            @switch($masseur->vaccination)

                                                                                @case(1)
                                                                                    Vaccinated, not up to date
                                                                                    @break

                                                                                @case(2)
                                                                                    Vaccinated, up to date
                                                                                    @break

                                                                                @case(3)
                                                                                    Not Vaccinated
                                                                                    @break

                                                                                @default
                                                                                    Not Set

                                                                            @endswitch
                                                                        </span>
                                                                    </span>
                                                                </div>

                                                                <div class="services_card">
                                                                    <spna class="icon">
                                                                        <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ff3c5f" d="M32,0C15.776,0,2.381,12.077,0.292,27.729c-0.002,0.016-0.004,0.031-0.006,0.047 c-0.056,0.421-0.106,0.843-0.146,1.269c-0.019,0.197-0.029,0.396-0.045,0.594c-0.021,0.28-0.044,0.56-0.058,0.842 C0.014,30.983,0,31.49,0,32c0,17.673,14.327,32,32,32s32-14.327,32-32S49.673,0,32,0z M33.362,58.502 c-0.72,0.787-1.901,1.414-2.675,0.67c-0.653-0.644-0.099-1.44,0-2.353c0.125-1.065-0.362-2.345,0.666-2.676 c0.837-0.259,1.468,0.322,2.009,1.012C34.187,56.175,34.239,57.526,33.362,58.502z M43.446,49.87 c-1.18,0.608-2.006,0.494-3.323,0.673c-2.454,0.309-4.394,1.52-6.333,0c-0.867-0.695-0.978-1.451-1.65-2.341 c-1.084-1.364-1.355-3.879-3.01-3.322c-1.058,0.356-1.026,1.415-1.654,2.335c-0.81,1.156-0.607,2.793-2.005,2.993 c-0.974,0.138-1.499-0.458-2.321-1c-0.922-0.614-1.104-1.348-2.002-1.993c-0.934-0.689-1.69-0.693-2.654-1.334 c-0.694-0.463-0.842-1.304-1.673-1.334c-0.751-0.022-1.289,0.346-1.664,0.996c-0.701,1.214-0.942,4.793-2.988,4.665 c-1.516-0.103-4.758-3.509-5.994-4.327c-0.405-0.273-0.78-0.551-1.158-0.763c-1.829-3.756-2.891-7.952-2.997-12.385 c0.614-0.515,1.239-0.769,1.819-1.493c0.927-1.13,0.481-2.507,1.673-3.335c0.886-0.604,1.602-0.507,2.669-0.658 c1.529-0.222,2.491-0.422,3.988,0c1.459,0.409,2.016,1.246,3.326,1.992c1.415,0.81,2.052,1.766,3.66,2.001 c1.166,0.165,1.966-0.901,2.988-0.337c0.824,0.458,1.406,1.066,1.341,2.001c-0.1,1.218-2.522,0.444-2.659,1.662 c-0.183,1.558,2.512-0.194,3.992,0.33c0.974,0.355,2.241,0.294,2.325,1.334c0.081,1.156-1.608,0.837-2.657,1.335 c-1.162,0.541-1.771,0.996-3.004,1.329c-1.125,0.298-2.312-0.628-2.987,0.329c-0.53,0.742-0.343,1.489,0,2.335 c0.787,1.931,3.349,1.352,5.322,0.657c1.383-0.488,1.641-1.726,2.997-2.329c1.438-0.641,2.554-1.335,3.981-0.663 c1.178,0.556,0.849,2.05,2.006,2.663c1.253,0.668,2.432-0.729,3.663,0c0.957,0.569,0.887,1.521,1.655,2.327 c0.894,0.942,1.41,1.702,2.668,2c1.286,0.299,2.072-1.071,3.327-0.671c0.965,0.315,1.755,0.68,1.987,1.672 C46.465,48.634,44.744,49.198,43.446,49.87z M45.839,33.841c-1.154,1.16-2.156,1.539-3.771,1.893c-1.433,0.315-3.443,1.438-3.772,0 c-0.251-1.148,1.029-1.558,1.893-2.359c0.959-0.895,1.854-0.983,2.826-1.892c0.87-0.802,0.756-2.031,1.893-2.359 c1.109-0.32,2.182-0.019,2.825,0.947C48.652,31.438,47.006,32.681,45.839,33.841z M59.989,29.319 c-0.492,0.508-0.462,1.044-0.965,1.542c-0.557,0.539-1.331,0.307-1.738,0.968c-0.358,0.577-0.13,1.057-0.194,1.735 c-0.041,0.387-1.924,1.256-2.313,0.385c-0.214-0.481,0.281-0.907,0-1.353c-0.263-0.401-0.555-0.195-0.899,0.181 c-0.359,0.388-0.772,0.958-1.221,1.172c-0.589,0.273-0.196-2.25-0.395-3.088c-0.146-0.663,0.01-1.08,0.198-1.736 c0.25-0.91,0.938-1.206,1.155-2.125c0.194-0.806,0.033-1.295,0-2.123c-0.039-0.906-0.015-1.427-0.188-2.314 c-0.192-0.937-0.252-1.525-0.771-2.316c-0.418-0.624-0.694-1.001-1.354-1.352c-0.16-0.088-0.31-0.146-0.452-0.191 c-0.34-0.113-0.659-0.128-1.098-0.193c-0.888-0.132-1.522,0.432-2.314,0c-0.462-0.255-0.606-0.575-0.96-0.967 c-0.404-0.434-0.511-0.789-0.967-1.158c-0.341-0.276-0.552-0.437-0.965-0.581c-0.79-0.263-1.342-0.082-2.126,0.196 c-0.77,0.268-1.058,0.707-1.739,1.155c-0.522,0.303-0.893,0.371-1.348,0.774c-0.276,0.242-1.59,1.177-2.127,1.155 c-0.544-0.021-0.851-0.343-1.338-0.382c-0.065-0.008-0.13-0.008-0.204,0c0,0,0,0-0.005,0c-0.473,0.036-0.696,0.269-1.146,0.382 c-1.107,0.276-1.812-0.115-2.905,0.197c-0.712,0.2-0.993,0.766-1.73,0.771c-0.841,0.005-1.125-0.743-1.932-0.968 c-0.442-0.118-0.702-0.129-1.157-0.19c-0.749-0.108-1.178-0.119-1.926-0.191H24.86c-0.016,0.006-0.591,0.058-0.688,0 c-0.422-0.286-0.722-0.521-1.244-0.773c-0.575-0.283-0.919-0.428-1.547-0.584l0.026-0.381c0,0,0-0.847-0.121-1.207 c-0.115-0.361-0.24-0.361,0-1.086c0.248-0.722,0.679-1.182,0.679-1.182c0.297-0.228,0.516-0.305,0.769-0.58 c0.51-0.539,0.717-0.998,0.774-1.739c0.067-0.972-1.205-1.367-0.97-2.316c0.209-0.826,0.904-0.98,1.547-1.543 c0.779-0.67,1.468-0.758,2.12-1.542c0.501-0.593,0.911-0.965,0.97-1.738c0.053-0.657-0.23-1.068-0.57-1.538 C28.356,2.175,30.157,2,32,2c14.919,0,27.29,10.893,29.605,25.158c-0.203,0.352-0.001,0.796-0.27,1.193 C60.979,28.894,60.436,28.85,59.989,29.319z"></path> </g></svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Nationality</p>
                                                                        <span> {{ getCountryList()[$masseur->nationality] ?? 'N/A' }}</span>
                                                                    </span>
                                                                </div> 
                                                                
                                                                <div class="services_card">
                                                                    <spna class="icon">
                                                                        <svg width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5 7.5C15.5 9.433 13.933 11 12 11C10.067 11 8.5 9.433 8.5 7.5C8.5 5.567 10.067 4 12 4C13.933 4 15.5 5.567 15.5 7.5Z" fill="#ff3c5f"></path> <path opacity="0.4" d="M19.5 7.5C19.5 8.88071 18.3807 10 17 10C15.6193 10 14.5 8.88071 14.5 7.5C14.5 6.11929 15.6193 5 17 5C18.3807 5 19.5 6.11929 19.5 7.5Z" fill="#ff3c5f"></path> <path opacity="0.4" d="M4.5 7.5C4.5 8.88071 5.61929 10 7 10C8.38071 10 9.5 8.88071 9.5 7.5C9.5 6.11929 8.38071 5 7 5C5.61929 5 4.5 6.11929 4.5 7.5Z" fill="#ff3c5f"></path> <path d="M18 16.5C18 18.433 15.3137 20 12 20C8.68629 20 6 18.433 6 16.5C6 14.567 8.68629 13 12 13C15.3137 13 18 14.567 18 16.5Z" fill="#ff3c5f"></path> <path opacity="0.4" d="M22 16.5C22 17.8807 20.2091 19 18 19C15.7909 19 14 17.8807 14 16.5C14 15.1193 15.7909 14 18 14C20.2091 14 22 15.1193 22 16.5Z" fill="#ff3c5f"></path> <path opacity="0.4" d="M2 16.5C2 17.8807 3.79086 19 6 19C8.20914 19 10 17.8807 10 16.5C10 15.1193 8.20914 14 6 14C3.79086 14 2 15.1193 2 16.5Z" fill="#ff3c5f"></path> </g></svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Ethnicity</p>
                                                                        <span>{{  config('escorts.profile.ethnicities')[$masseur->ethnicity] ??  'N/A' }}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mc_list_about">
                                                                <strong>About Me</strong><br>

                                                                <p class="mc_list_desc">
                                                                    {!! $masseur->commentary ?? 'N/A' !!}
                                                                </p>
                                                            </div>
                                                        </div>
                                                         <!-- Services -->
                                                        <div class="tab-pane fade" id="services-{{ $masseur->id }}" role="tabpanel"
                                                            aria-labelledby="services-tab-{{ $masseur->id }}">

                                                            <div class="mc_list_meta">
                                                                

                                                                <div class="services_card w-100">
                                                                    <spna class="icon">
                                                                        <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                                            </g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <g>
                                                                                    <g>
                                                                                        <g>
                                                                                            <path d="M269.62,436.454H35.557c-9.948,0-18.013,8.065-18.013,18.013c0,9.948,8.065,18.013,18.013,18.013h234.064 c9.948,0,18.013-8.065,18.013-18.013C287.633,444.519,279.569,436.454,269.62,436.454z">
                                                                                            </path>
                                                                                            <path d="M467.635,413.673l-68.947-0.055L374.5,370.546c6.055,6.36,13.686,11.061,22.331,13.615 c4.76,1.406,9.615,2.101,14.442,2.101c8.358,0,16.635-2.088,24.182-6.194l15.469-8.415c11.909-6.479,20.581-17.206,24.419-30.206 c3.839-13,2.385-26.719-4.094-38.626l-8.414-15.467c-6.479-11.909-17.204-20.581-30.205-24.42 c-13-3.841-26.719-2.387-38.626,4.092l-15.468,8.415c-21.293,11.585-30.971,36.303-24.487,58.686l-2.602-4.634 c-0.919-1.636-1.971-3.251-3.127-4.806c-7.018-9.874-16.785-17.24-27.852-21.356c0.838-0.773,1.66-1.572,2.448-2.421 c16.656-17.927,15.624-46.063-2.294-62.727L208.672,133.931c-1.018-0.946-2.112-1.867-3.259-2.744 c-0.567-0.464-1.159-0.89-1.741-1.332c6.458-1.524,12.612-4.328,18.143-8.342c10.972-7.962,18.185-19.719,20.312-33.106 l2.764-17.393c4.39-27.635-14.522-53.691-42.157-58.083l-17.392-2.764c-27.63-4.393-53.691,14.521-58.083,42.157l-2.763,17.389 c-2.127,13.387,1.086,26.803,9.048,37.774c3.999,5.511,8.957,10.071,14.597,13.518c-5.437,1.899-10.627,4.602-15.419,8.079 c-12.874,9.344-21.339,23.141-23.844,38.91L88.412,299.599H59.554C26.716,299.599,0,326.314,0,359.152 c0,32.838,26.716,59.554,59.554,59.554l240.152-0.006l34.314,61.106c8.276,14.735,24.409,23.533,41.248,22.584l92.311,0.077 c0.01,0,0.017,0,0.025,0c24.466,0,44.381-19.898,44.396-44.367C512.016,433.62,492.114,413.691,467.635,413.673z M388.669,315.851c1.113-3.772,3.629-6.883,7.084-8.764l15.469-8.415c3.454-1.88,7.431-2.302,11.205-1.186 c3.772,1.113,6.883,3.63,8.764,7.085l8.415,15.468c1.879,3.455,2.302,7.434,1.188,11.206c-1.114,3.772-3.629,6.883-7.084,8.763 l-15.47,8.415c-3.454,1.878-7.434,2.3-11.204,1.188c-3.772-1.114-6.883-3.63-8.765-7.086l-8.415-15.468 C387.977,323.603,387.555,319.622,388.669,315.851z M160.074,75.368l2.763-17.389c1.275-8.018,8.832-13.505,16.85-12.232 l17.391,2.764c8.019,1.275,13.506,8.835,12.233,16.851l-2.764,17.393c-0.617,3.882-2.709,7.294-5.891,9.603 c-3.185,2.31-7.079,3.245-10.961,2.625l-17.391-2.763c-3.884-0.617-7.294-2.709-9.604-5.893S159.456,79.253,160.074,75.368z M144.467,173.588c0.986-6.206,4.329-11.658,9.416-15.349c5.086-3.69,11.302-5.179,17.513-4.196 c4.177,0.664,8.091,2.435,11.323,5.124c0.238,0.198,0.479,0.389,0.727,0.575c0.268,0.199,0.502,0.394,0.687,0.566L296.07,264.55 c0.005,0.005,0.011,0.01,0.016,0.014c3.382,3.143,3.577,8.449,0.436,11.831c-3.141,3.383-8.449,3.576-11.803,0.461 l-70.183-65.454c-4.883-4.554-11.882-6.032-18.189-3.845c-6.307,2.188-10.886,7.685-11.899,14.284l-11.94,77.759h-47.636 L144.467,173.588z M256.286,299.599h-47.333l5.929-38.614L256.286,299.599z M467.609,466.441c-0.001,0-0.004,0-0.005,0 l-92.891-0.077c-0.006,0-0.012,0-0.018,0c-0.443,0-0.886,0.017-1.328,0.049c-3.222,0.241-6.351-1.428-7.934-4.247l-39.476-70.298 c-3.188-5.679-9.194-9.192-15.706-9.192l-250.697,0.007c-12.974,0-23.529-10.555-23.529-23.529 c0-12.974,10.555-23.528,23.529-23.528h44.286h84.125H299.76c7.645,0,14.846,3.75,19.263,10.029 c0.118,0.168,0.238,0.334,0.363,0.497c0.257,0.34,0.476,0.67,0.651,0.983l52.399,93.306c3.186,5.674,9.184,9.188,15.691,9.192 l79.481,0.065c0,0,0,0,0.001,0c4.617,0.004,8.371,3.761,8.367,8.377C475.971,462.69,472.217,466.441,467.609,466.441z">
                                                                                            </path>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Massage Services:</p>
                                                                        <span>
                                                                            @if(!empty($masseur->massage_service_types) && count($masseur->massage_service_types) > 0)
                                                                            {{ collect($masseur->massage_service_types)
                                                                                ->map(fn($type) => config('escorts.profile.massage-services')[$type] ?? null)
                                                                                ->filter()
                                                                                ->implode(', ') }}
                                                                            @else
                                                                            {{ 'NA' }}
                                                                            @endif
                                                                        </span>
                                                                    </span>
                                                                </div>

                                                                <div class="services_card w-100">
                                                                    <spna class="icon">
                                                                        <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                                            </g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <metadata>
                                                                                    <sfw xmlns="&amp;ns_sfw;">
                                                                                        <slices> </slices>
                                                                                        <slicesourcebounds width="505" height="984" bottomleftorigin="true" x="0" y="-120">
                                                                                        </slicesourcebounds>
                                                                                    </sfw>
                                                                                </metadata>
                                                                                <g>
                                                                                    <g>
                                                                                        <g>
                                                                                            <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z">
                                                                                            </path>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g>
                                                                                        <g>
                                                                                            <circle cx="7" cy="12" r="2"></circle>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g>
                                                                                        <g>
                                                                                            <circle cx="12" cy="12" r="2"></circle>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g>
                                                                                        <g>
                                                                                            <circle cx="17" cy="12" r="2"></circle>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </spna>
                                                                    <span class="details">
                                                                        <p>Other Service Types</p>
                                                                        <span>
                                                                            @if(!empty($masseur->other_service_types) && count($masseur->other_service_types) > 0)
                                                                                        {{ collect($masseur->other_service_types)
                                                                                            ->map(fn($type) => config('escorts.profile.other-services')[$type] ?? null)
                                                                                            ->filter()
                                                                                            ->implode(', ') }}
                                                                                    @else
                                                                                        {{ 'NA' }}
                                                                                    @endif
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                
                                                            </div>

                                                        </div>
                                                        <!-- Open Times -->
                                                        <div class="tab-pane fade table-responsive p-2" id="open-times-{{ $masseur->id }}" role="tabpanel"
                                                            aria-labelledby="open-times-tab-{{ $masseur->id }}">

                                                            <div class="table-responsive-sm mc_avail_table">
                                                                <table class="table table-bordered">
                                                                    <thead class="bg-first">
                                                                        <tr>
                                                                            <th colspan="2" class="text-center">My Availability</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    {!! get_messure_weakly_avail($masseur) !!}
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
                                <!-- Messeur Modal  -->
                              @endforeach
                            @endif

                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Our Services</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <p class="text-justify">
                            Check out what services are available.
                            Feel free to ask us or your Masseur any questions about our services.
                        </p>

                        <div class="accordion-container">
                            <!-- All Massage Services -->
                            <div class="set">
                                <a>
                                    All Massage Services
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content" style="display: none;">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table table-grid">

                                                @if($listing->massage_services()->where('category_id', 1)->count()>0)
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Rate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                         @foreach ($listing->massage_services()->where('category_id', 1)->get()->values()->filter(fn($item, $index) => $index % 2 == 0) as $value)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{config('escorts.profile.massage-services')[$value->service_id]  }}</td>
                                                                <td class="table_border_solid_left">
                                                                   

                                                                    @if($value->price && $value->price!=0)
                                                                    <div class="public-num-value-table"> <span>$ </span> {{ number_format($value->price, 2) }}</div>
                                                                    @else
                                                                    <span class="if_data_not_available">N/A</span>
                                                                    @endif
                                                                
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                           
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        @php
                                                            $services = $listing->massage_services()
                                                                ->where('category_id', 1)
                                                                ->get()
                                                                ->values()
                                                                ->filter(fn($item, $index) => $index % 2 != 0);
                                                        @endphp
                                                            
                                                            @if($services->count() > 0)
                                                                @foreach($services as $value)
                                                                <tr>
                                                                    
                                                                        <td class="table_border_dash_left">{{config('escorts.profile.massage-services')[$value->service_id]  }}</td>
                                                                        <td class="table_border_solid_left">
                                                                        

                                                                           @if($value->price && $value->price!=0)
                                                                            <div class="public-num-value-table"> <span>$ </span>{{ number_format($value->price, 2) }}</div>
                                                                            @else
                                                                            <span class="if_data_not_available">N/A</span>
                                                                            @endif
                                                                        
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                            @else

                                                                <tr>
                                                                    <td class="table_border_dash_left">&nbsp;</td>
                                                                    <td class="table_border_solid_left">&nbsp;</td>
                                                                </tr>

                                                            @endif
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @else
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  All Other Service Types -->
                            <div class="set">
                                <a>
                                    All Other Service Types
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content" style="display: none;">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">

                                            <div class="row margin_zero_for_table table-grid">

                                                @if($listing->massage_services()->where('category_id', 2)->count()>0)
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Rate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                         @foreach ($listing->massage_services()->where('category_id', 2)->get()->values()->filter(fn($item, $index) => $index % 2 == 0) as $value)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{config('escorts.profile.other-services')[$value->service_id]  }}</td>
                                                                <td class="table_border_solid_left">
                                                                   

                                                                    @if($value->price && $value->price!=0)
                                                                    <div class="public-num-value-table"> <span>$ </span>{{ number_format($value->price, 2) }}</div>
                                                                    @else
                                                                    <span class="if_data_not_available">N/A</span>
                                                                    @endif
                                                                
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                           
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $services = $listing->massage_services()
                                                                    ->where('category_id', 2)
                                                                    ->get()
                                                                    ->values()
                                                                    ->filter(fn($item, $index) => $index % 2 != 0);
                                                            @endphp

                                                        @if($services->isNotEmpty())
                                                            
                                                                    @foreach($services as $value)

                                                                        <tr>
                                                                        
                                                                            <td class="table_border_dash_left">{{config('escorts.profile.other-services')[$value->service_id]  }}</td>
                                                                            <td class="table_border_solid_left">
                                                                            

                                                                                @if($value->price && $value->price!=0)
                                                                                <div class="public-num-value-table"> <span>$ </span>{{ number_format($value->price, 2) }}</div>
                                                                                @else
                                                                                <span class="if_data_not_available">N/A</span>
                                                                                @endif
                                                                            
                                                                            </td>
                                                                        </tr>

                                                                      @endforeach

                                                        @else
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left">&nbsp;</td>
                                                            </tr>

                                                        @endif
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @else
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                               <td class="table_border_dash_left" colspan="2">Let's talk about it.</td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="padding_none">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="table_border_dash_left" colspan="2">Let's talk about it.</td>
                                                                
                                                            </tr>
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
     
         


            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12 profile-sidebar-margin-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0 profile_verify_icon">
                            <div id="carouselExampleInterval" class="carousel slide mc_view_media" data-ride="carousel"
                                data-interval="false">
                                    
                                <span class="mc_tooltip" data-toggle="modal" data-target="#exampleModal">Click to view Our Media.</span>
                                <div class="carousel-inner">
                                    
                                    <!-- Carousel Item 1 -->
                                   
                                    @foreach ($validImages as $index => $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-interval="10000">
                                            <div class="row">
                                                <div class="col-12 remove_padding_for_carousel">
                                                    <img src="{{ $image['url'] }}" data-id="{{$image['image_data']['id']}}"
                                                        class="d-block w-100"
                                                        alt="Gallery Image"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal">  
                                                </div>
                                                
                                            </div>

                                            <div class="verify_icon">
                                                @php
                                                    $media_status = getMediaVerificationDataBigIcon($image['image_data']['varified'] ?? 0);
                                                @endphp
                                                <img src="{{$media_status['icon']}}">
                                                <span class="common_shield_tooltip">{{$media_status['label']}}</span>
                                            </div>
                                        </div>
                                    @endforeach

                                   

                                    

                                </div>

                                <!-- Carousel Controls -->
                                <a  class="carousel-control-prev" href="#carouselExampleInterval" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleInterval" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- video crousal end -->
                <div class="row py-0 eqal-bx">
                    <div class="col-12">
                        <div class="mess_repo_btn_wrap">
                            
                            <button type="button" class="btn profile_message_btn_cc" data-toggle="modal"
                                data-target="#mysendmessage">
                                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="image_20px_msg">Message Us
                            </button>
                            <button type="button" class="btn profile_message_btn_cc" id="reportAdvertiserBtn" data-toggle="modal">
                                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="image_20px_msg">Report Centre
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hidden input (static example) -->
                <input type="hidden" name="escortId" value="123" id="eid">

                <!-- Like / Dislike Bar -->
                 
                    <div class="like_and_process_bar_padding d-flex align-items-center gap-10">
                        <div class="like_img">
                            <i id="dislike" class="{{ $massageLike && $massageLike->like == 0 ? 'fa fa-thumbs-down' : 'fa fa-thumbs-o-down'}} " title="Dislike" aria-hidden="true"></i>
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
                       
                            <i id="like" class="{{ $massageLike && $massageLike->like == 1 ? 'fa fa-thumbs-up' : 'fa fa-thumbs-o-up'}}" title="Like" aria-hidden="true"></i>

                        </div>
                    </div>


                <!-- Playmates Section -->
                {{-- <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="{{ asset('assets/app/img/icon_my-playmates.svg') }}" style="width: 36px"> Playmates</h2>
                    </div>
                    <div class="padding_20_tob_btm_side reduse_pad">
                        <p class="profile_description_contect_pera">Alina does not have any Playmates.</p>
                    </div>
                </div> --}}

                <!-- Contacting Me Section -->
                <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting us</h2>
                    </div>
                        <div class="padding_20_tob_btm_side reduse_pad">
                            <span class="span_display_block connecting_me_chat_phone">
                                You can contact us by:

                                    @php
                                        $contactType = $listing->contact != null ? $listing->contact : '';
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
                                            <div class="tooltip-text">Call us</div>
                                            @if($contactType == 5)
                                                <span>or</span>
                                            @endif
                                        </div>
                                    @endif
                                    @if($contactType == 2 || $contactType == 5)
                                        <div class="tooltip-wrapper">
                                                <img src="{{ asset('assets/app/img/wechat.svg') }}">
                                                <div class="tooltip-text">Text us and Call us</div>
                                        </div>
                                    @endif
                            </br>
                                        @php
                                        $from = $listing->phone;
                                        $number = sprintf("%s-%s-%s",
                                        substr($from, 0, 3),
                                        substr($from, 3, 3),
                                        substr($from, 6));
                                        //dd($number);
                                        @endphp
                                        <p class="font-weight-bold mb-0 mt-2">When texting us please say :</p>
                                        <p class="profile_description_contect_pera">
                                            <b><i>Hi {{ $business_name }}, I found you on E4U ... </i></b>
                                            @php
                                                $formattedNumber = $listing->phone;
                                                $contactTypes = $listing->contact != null ? $listing->contact : '';
                                            
                                            @endphp
                                        </p>    
                                        <p style="line-height: 1;">
                                            @if($contactTypes != '')
                                                @if($contactTypes == 1)
                                                    on our email {{ $listing->user->email ?? '' }}
                                                @elseif($contactTypes == 4 || $contactTypes == 2 || $contactTypes == 5)
                                                    on our number {{ $formattedNumber }}.
                                                @else
                                                    on our number --++
                                                @endif
                                            @else
                                                {{-- on our number {{$formattedNumber != '' ? $formattedNumber : '--'}}. --}}
                                                on our number -=====.
                                            @endif
                                        </p>
                            </span>
                        </div>
                </div>

                <!-- Vaccination Status -->
                <div class="vax-btn">
                    <button type="button" class="btn my_legbox single-prof-btn">
                        <img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, up to date
                    </button>
                </div>

                <!-- Accordion: Pricing Policy & Disclaimer -->
                <div class="accordion-container-new">
                    <div class="set">
                        <a class="pb-1 pt-1 d-flex align-items-center d-flex justify-content-between">
                           Our Pricing Policy
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">
                            <div class="accodien_manage_padding_content">
                                <p class="text-justify">Prices are all inclusive unless an extra is listed in Our Services,
                                     or you reach an agreement separately with the Masseur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="set">
                        <a class="pb-1 pt-1 d-flex align-items-center d-flex justify-content-between">
                            Disclaimer
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">
                            <div class="accodien_manage_padding_content">
                                <p class="text-justify">Any companionship which is agreed to between the Masseur and the client is not an offer or promise for
                                    prostitution or illegal activity. Anything that may occur between the Masseur and the client is their choice as
                                    consenting adults.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Carousel -->
                <div class="box_shadow padding_twelve_px">
                    <div class="profile_card_border profile_description_contect position-relative">
                        <h2><img src="{{ asset('assets/app/img/tips.svg') }}">Tips</h2>
                    </div>
                    <div class="pt-2">
                        <div class="text-slider">
                            <div class="slider-track" id="sliderTrack">
                                <div class="slide_item">Be on time.</div>
                                <div class="slide_item">Do not offer any of your personal information.</div>
                                <div class="slide_item">Ask questions; it’s okay.</div>
                                <div class="slide_item">Maintain good hygiene.</div>
                                <div class="slide_item">Keep your conversation light and non-suggestive.</div>
                                <div class="slide_item">Be clear about the service you are looking for.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2 class="custom--review"><img src="{{ asset('assets/app/img/review-custom.png') }}"> Reviews</h2>
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
                                                if($review->user && auth()->user() && auth()->user()->id == $review->user_id && $review->advertiser_id == $listing->id && $review->advertiser_type=='massage'){
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



                    <div class="pt-3 row {{count($reviews) == 0 ? '': 'd-none'}}">
                            <div class="col-md-12">
                                @php
                                    $mesageForViewer = true;
                                    if(auth()->user() && auth()->user()->type != 0){
                                        $mesageForViewer = false;
                                    }
                                @endphp
                                <p class="testimonial">
                                    <strong>{{ $business_name }}</strong> has no Reviews. @php if($mesageForViewer != false){ @endphp Why don’t you give <strong>{{$business_name}}</strong> their first Review? @php } @endphp
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
                                    <a href="{{route('viewer.login')}}" style="color: white;">Login to Add Review</a>
                                </button>
                            @endif
                        </div>





                    </div>
                    
                    
                </div>


            </div>
            <!-- sssssssssssssssss -->
        </div>
    </div>

    <!-- model start here 1-->
    <div class="modal fade upload-modal" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         @if (auth()->check() && auth()->user()->type == 0)
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img
                                    src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Us </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                        class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            <h6 class="custom_modal_text">
                                <span id="Lname">To message Alina please go to your Dashboard and select
                                    Communications > Messages. </span>
                            </h6>
                            <hr style="background-color: #0C223D">
                            <p class="mb-1 mt-3"><b>Notes:</b></p>
                            <ol>
                                <li>Make sure you have enabled Messaging in your settings. If you have added Alina to your
                                    Legbox, they will appear in your Message list. Otherwise, you can search by Member ID.</li>
                                <li>To message Alina, they will also need to have Messaging enabled.</li>
                            </ol>
                        </div>
                        <div class="modal-footer text-center justify-content-end">
                            <a href="{{ route('user.viewer-messages') }}" type="button" class="btn-success-modal text-white"
                                id="loginUrl" style="text-decoration: none;">Go to Message</a>
                        </div>
                    </div>
                </div>    
                @else
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img
                                    src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Us </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                        class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                        <!-- if viewer not login -->
                        <div class="modal-body text-center">
                            <h5 class="custom_modal_text">
                                <span id="Lname">Message Us is only available to Viewers.
                                    Please log in or Register to access Message Us.</span>
                            </h5>
                            
                        </div>
                        <div class="modal-footer pt-0 text-center justify-content-center" >
                            <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                            <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                        </div>
                    </div>  
                </div>  
                @endif
                <!--- end -->
            </div>
    <!-- model end here 1-->
    <!-- model start here 2-->

    <div class="modal fade modal-upload" id="reportMcNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                
                    
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Centre </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <!-- if viewer not login -->
                <div class="modal-body" >
                    <h6 class="custom_modal_text">
                        <span id="Lname">Report Centre is only available to Viewers. Please log in or Register to access Report Centre.</span>
                    </h6>
                    <div class="modal-footer text-center justify-content-center" >
                    <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                    </div>
                </div>
                <!--- end -->

            </div>
        </div>
    </div>
    

    <div class="modal fade upload-modal" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header main_bg_color">
                    <img src="{{ asset('../assets/app/img/alert.png') }}" class="custompopicon">
                    <h5 class="modal-title" id="exampleModalLabel">Report {{-- [Name] --}} to
                        our team.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('../assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                
                <form id="sendReportForm" action="{{ route('massage-spam-report')}}" method="post">
                @csrf
                   
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group popup_massage_box">
                                    <p class="font-weight-bold">What is wrong:</p>
                                    <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="5"
                                        placeholder="Message (250 characters)" required></textarea>
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

                        <hr style="background-color: #0C223D">
                        <p class="mb-1 mt-3"><b>Notes:</b></p>
                        <ol>
                            <li>Only report if you had direct contact with the Massage Centre.</li>
                            <li>Do not write fake or abusive reports, as it may result in your Account being
                                suspended. Only genuine
                                reports will be considered.</li>
                            <li>The Massage Centre’s Member ID will automatically attach to this report.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="massage_id" value="{{$listing->id}}">
                        <button type="submit"  id="sendReportSubmitBtn" class="btn-success-modal">Send Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model start here 3-->
    <div class="modal fade add_reviews upload-modal" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                
            
            <div class="modal-header">
                    <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{$reviewAlreadyExist ? 'Edit' : "Add"}} review for {{ $business_name }}
                    </h5>
                    <button type="button" @if($reviewAlreadyExist) data-bs-dismiss="modal" @else data-bs-dismiss="modal" @endif class="close" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                    </button>
                </div>


            
                <form id="reviewAdvertiser" action="{{ route('web.review-massage',[$listing->id])}}" method="post" data-parsley-validate>
                
                
                    <div class="modal-body">                    
                        <div class="row">
                            <div class="col">
                                <div class="form-group popup_massage_box">
                                    <p class="font-weight-bold">Tell us about your experience:</p>
                                   <textarea name="description" class="form-control popup_massage_box p-2" id="review_textarea" rows="5" placeholder="Message (500 characters)" required data-parsley-required-message="Please enter your review" data-parsley-maxlength="500" data-parsley-maxlength-message="Maximum 500 characters allowed">{{ $review->description ?? '' }}</textarea>
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
                                    <li>Only review if you had direct contact with the Centre.</li>
                                    <li>Do not write fake or abusive reviews, as they will not be published.</li>
                                    <li>To contact this Centre click on <a href="{{ route('user.viewer-messages') }}" style="color: #ff3c5f;" class="custom_links_design">Message Us</span></a>.</li>
                                </ol>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn-cancel-modal" @if($reviewAlreadyExist) data-bs-dismiss="modal" @else data-bs-dismiss="modal" @endif>
                            Cancel
                        </button>

                        <button type="submit" class="btn-success-modal">{{$reviewAlreadyExist ? 'Update' : "Submit"}} Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- confirmation review modal --}}
        <div class="modal fade upload-modal" id="review-submitted-popup" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
        
                    <!-- Header with navy background and [X] -->
                    <div class="modal-header" style="background-color: #0e2346; color: white; display: flex; justify-content: space-between; align-items: center; border-radius:0px">
                        <img src="{{ asset('../assets/app/img/tick.png')}}"
                                        class="custompopicon">
                        <h5 class="modal-title" id="reportAdvertiserLabelNew">Review Submitted</h5>
                        <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;" >
                        <img src="{{ asset('../assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </button>
                    </div>
        
                    <!-- if logi Body content -->
                
                    <div class="modal-body text-center">
                        <h5 class="custom_modal_text">Thank you for your Review.
                        
                            Your Review for <span id="review-escort-name"></span> has been submitted for approval.
                        </h5>
                    
                    </div>
                    <div class="modal-footer pt-0" style="justify-content: center; ">
                        <button type="submit" class="btn-success-modal" data-dismiss="modal"
                            id="close">Ok</button>
                    </div>
        
                </div>
            </div>
        </div>
    {{-- end --}}


    <!-- model start here 1-->
    <div class="modal fade upload-modal" id="newmodal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="icustompopicon">
                    <h5 class="modal-title" id="exampleModalLabel"> Send New Harmony
                        Nature Massage a
                        message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form id="messageMe" action="#" method="post">
                    <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Mobile</label>
                                    <input type="text" placeholder="Mobile number" maxlength="10" step="100"
                                        data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                        data-parsley-type="number" class="form-control" name="phone">
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
                    <hr style="background-color: #0C223D" class="mt-3">
                    <div class="note">
                        <p class="font-weight-bold">Notes:</p>
                        <ol class="mb-0">
                            <li>The Escort needs to have this feature enabled in order to receive it.</li>
                            <li>You will receive a notification when thismessage is responded to.</li>
                        </ol>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-success-modal">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   

    {{-- My Photos --}}

    <div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
                <div class="modal-header d-flex justify-content-between align-items-center">                                       
                    <ul class="nav nav-tabs justify-content-center border-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1">Our Photos</a>
                        </li>
                        @if ($galleryVideos->count()>0) 
                            <li class="nav-item">
                                <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">Our Videos</a>
                            </li>
                        @endif
                    </ul>
                    <button type="button" class="p-0" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">                        
                        <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="profile-tab">

                            <div id="gallery" class="photos-grid-container gallery">

                                @if(count($validImages))

                                    {{-- Main Image --}}
                                    @foreach ($validImages as $index => $image)
                                        @if($loop->first)

                                            <div class="main-photo img-box">

                                                <a href="{{ $image['url'] }}"
                                                class="glightbox image-wrapper"
                                                data-gallery="escort-gallery">

                                                    <img src="{{ $image['url'] }}" alt="main" >

                                                   

                                                </a>
                                                 <div class="hover-overlay">
                                                        <span>Click me!</span>
                                                    </div>
                                                @php
                                                    $media_status = getMediaVerificationDataBigIcon($image['image_data']['varified'] ?? 0);
                                                @endphp

                                                @if($media_status)
                                                    <div class="verify_icon" style="border-radius:0px 0px 10px 0px;">
                                                        <img src="{{ $media_status['icon'] }}">
                                                        <span class="common_shield_tooltip">
                                                            {{ $media_status['label'] }}
                                                        </span>
                                                    </div>
                                                @endif

                                            </div>

                                        @endif
                                    @endforeach

                                    {{-- Sub Images --}}
                                    <div class="sub">

                                        @foreach ($validImages as $index => $image)

                                            @continue($loop->first)

                                            <div class="img-box">

                                                <a href="{{ $image['url'] }}"
                                                class="glightbox image-wrapper"
                                                data-gallery="escort-gallery">

                                                    <img src="{{ $image['url'] }}"
                                                        alt="gallery image"
                                                        >

                                                   

                                                </a>
                                                 <div class="hover-overlay">
                                                        <span>Click me!</span>
                                                    </div>
                                                @php
                                                    $media_status = getMediaVerificationDataSmallIcon($image['image_data']['varified'] ?? 0);
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

                                        @foreach ($validImages as $image)

                                            <a href="{{ $image['url'] }}"
                                            class="glightbox"
                                            data-gallery="escort-gallery">
                                            </a>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        </div>
                        <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                            
                            <div class="swiper mySwiper" id="dvSource">
                                <div class="swiper-wrapper">
                                        @foreach($galleryVideos as $key=>$media) 
                                           <div class="swiper-slide">
                                                <div id="dm_{{ $key }}" class="w-100 video-wrapper">
                                                    <a href="#">
                                                        <video style="z-index: 1" controls="" id="videoId_{{ $key }}" src="{{ asset($media->path) }}">
                                                            <source src="{{ asset($media->path) }}" type="video/mp4">
                                                        </video> 
                                                    </a>
                                                     {{-- Screenshot Button --}}
                                                    <span
                                                        type="button"
                                                        class="video-screenshot-btn"
                                                        data-video-id="videoId_{{ $key }}"
                                                    >
                                                        <svg width="24px" height="24px" class="screeenshot-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M3 8H2V4.5A2.5 2.5 0 0 1 4.5 2H8v1H4.5A1.5 1.5 0 0 0 3 4.5zm1.5 14A1.5 1.5 0 0 1 3 20.5V17H2v3.5A2.5 2.5 0 0 0 4.5 23H8v-1zM22 20.5a1.5 1.5 0 0 1-1.5 1.5H17v1h3.5a2.5 2.5 0 0 0 2.5-2.5V17h-1zM20.5 2H17v1h3.5A1.5 1.5 0 0 1 22 4.5V8h1V4.5A2.5 2.5 0 0 0 20.5 2zM14 7h4v4h1V6h-5zm-7 4V7h4V6H6v5zm11 3v4h-4v1h5v-5zm-7 4H7v-4H6v5h5z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
                                                        <p class="scr-tooltip">Take Screenshot</p>
                                                    </span>

                                                    {{-- Screenshot Preview --}}
                                                    <div
                                                        class="screenshot-preview"
                                                        id="screenshotPreview_{{ $key }}"                                                                                >

                                                        <img
                                                            class="screenshot-image"
                                                            id="screenshotImage_{{ $key }}"
                                                            src=""
                                                            alt="Screenshot Preview"
                                                        >

                                                        <div class="screenshot-actions">
                                                            <button
                                                                type="button"
                                                                class="screenshot-cancel"
                                                                data-key="{{ $key }}"
                                                            >
                                                                Cancel
                                                            </button>
                                                            {{-- Copy --}}
                                                                <button
                                                                    type="button"
                                                                    class="screenshot-copy"
                                                                    data-key="{{ $key }}"
                                                                >
                                                                    Copy
                                                                </button>
                                                            <button
                                                                type="button"
                                                                class="screenshot-save"
                                                                data-key="{{ $key }}"
                                                            >
                                                                Save
                                                            </button>
                                                            

                                                        </div>

                                                    </div>
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

    {{-- end --}}

    {{-- my legbox --}}

    <div class="modal fade upload-modal" id="my_legbox" style="display: none;" aria-labelledby="myLegbox" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title popup_modal_title_new" id="myLegbox"> <img src="{{ asset('assets/app/img/my-legbox.png')}}" class="custompopicon"> My Legbox</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                    </button>
                </div>
                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style my-4" style="text-align: center;">
                        <span id="Lname">My Legbox is only available to Viewers. Please log in or Register to access your Legbox.</span>
                    </h5>
                    <div class="modal-footer text-center justify-content-center" >
                        <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                        <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="reportLogedIn" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <img src="{{ asset('assets/dashboard/img/request-submit.png') }}"
                                    class="custompopicon">
                    <h5 class="modal-title font-weight-bold" id="reportAdvertiserLabelNew">
                        
                        Report Logged
                        </h5>
                    <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;" >
                    <img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
    
                <!-- if logi Body content -->
            
                <div class="modal-body text-left">
                    <h6 class="custom_modal_text">
                        <span id="Lname">Thank you for your report. Someone from our team will be in
                    touch shortly.</span>
                    </h6>
                
                </div>
                <div class="modal-footer pt-0" style="justify-content: center; ">
                    <button type="submit" class="btn main_bg_color site_btn_primary reportLogedIn_close" data-dismiss="modal"
                        id="close">Ok</button>
                </div>
    
            </div>
        </div>
    </div>
    
    {{-- end --}}

    <div class="modal fade upload-modal" id="reportAdvertiserNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    
                        
                        <h5 class="modal-title" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Centre </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <!-- if viewer not login -->
                    <div class="modal-body" >
                        <h6 class="custom_modal_text" style="text-align: center; color:#0C223D;">
                            <span id="Lname">Report Centre is only available to Viewers. Please log in or Register to access Report Centre.</span>
                        </h6>
                        <div class="modal-footer text-center justify-content-center" >
                        <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                        <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                        </div>
                    </div>
                    <!--- end -->

                </div>
            </div>
    </div>



@endsection
@push('scripts')




<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map.api_key') }}&libraries=places&callback=initMap" async defer></script>

<script src="{{ asset('assets/app/lightbox/js/glightbox.min.js') }}"> </script>
<script src="{{ asset('assets/app/lightbox/js/script.js') }}"> </script>

<script>
document.addEventListener('click', async function (e) {

    /*
    ==========================================
    TAKE SCREENSHOT
    ==========================================
    */

    if (e.target.closest('.video-screenshot-btn')) {

        const button = e.target.closest('.video-screenshot-btn');

        const videoId = button.getAttribute('data-video-id');
        const video = document.getElementById(videoId);

        if (!video) {
            return;
        }

        const wrapper = video.closest('.video-wrapper');

        const preview = wrapper.querySelector('.screenshot-preview');
        const image = wrapper.querySelector('.screenshot-image');

        if (!video.videoWidth || !video.videoHeight) {
            alert('Video is not ready yet.');
            return;
        }

        /*
        Create Canvas
        */
        const canvas = document.createElement('canvas');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');

        /*
        Capture current video frame
        */
        context.drawImage(
            video,
            0,
            0,
            canvas.width,
            canvas.height
        );

        /*
        Convert to PNG
        */
        const screenshot = canvas.toDataURL('image/png');

        /*
        Show screenshot preview
        */
        image.src = screenshot;

        preview.style.display = 'block';

        /*
        Store screenshot
        */
        preview.dataset.screenshot = screenshot;
    }


    /*
    ==========================================
    COPY SCREENSHOT
    ==========================================
    */

    if (e.target.closest('.screenshot-copy')) {

        const button = e.target.closest('.screenshot-copy');

        const wrapper = button.closest('.video-wrapper');

        const preview = wrapper.querySelector('.screenshot-preview');

        const screenshot = preview.dataset.screenshot;

        if (!screenshot) {
            return;
        }

        try {

            /*
            Convert Base64 image to Blob
            */
            const response = await fetch(screenshot);

            const blob = await response.blob();

            /*
            Copy image to clipboard
            */
            await navigator.clipboard.write([
                new ClipboardItem({
                    [blob.type]: blob
                })
            ]);

            /*
            Change button text temporarily
            */
            const originalText = button.innerText;

            button.innerText = 'Copied!';

            setTimeout(function () {
                button.innerText = originalText;
            }, 1500);

        } catch (error) {

            console.error('Copy failed:', error);

            alert('Unable to copy screenshot.');
        }
    }


    /*
    ==========================================
    SAVE SCREENSHOT
    ==========================================
    */

    if (e.target.closest('.screenshot-save')) {

        const button = e.target.closest('.screenshot-save');

        const wrapper = button.closest('.video-wrapper');

        const preview = wrapper.querySelector('.screenshot-preview');

        const screenshot = preview.dataset.screenshot;

        if (!screenshot) {
            return;
        }

        /*
        Create download link
        */
        const link = document.createElement('a');

        link.href = screenshot;

        link.download =
            'video-screenshot-' +
            Date.now() +
            '.png';

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

        /*
        Hide preview
        */
        preview.style.display = 'none';
    }


    /*
    ==========================================
    CANCEL SCREENSHOT
    ==========================================
    */

    if (e.target.closest('.screenshot-cancel')) {

        const button = e.target.closest('.screenshot-cancel');

        const wrapper = button.closest('.video-wrapper');

        const preview = wrapper.querySelector('.screenshot-preview');

        preview.style.display = 'none';

        preview.dataset.screenshot = '';

        const image =
            preview.querySelector('.screenshot-image');

        image.src = '';
    }




    /*
    ==========================================
    CLOSE LARGE VIEW
    ==========================================
    */

    if (e.target.closest('#closeScreenshotLightbox')) {

        closeScreenshotLightbox();
    }

});


/*
==========================================
CLOSE LIGHTBOX FUNCTION
==========================================
*/

function closeScreenshotLightbox() {

    const lightbox =
        document.getElementById('screenshotLightbox');

    const lightboxImage =
        document.getElementById('lightboxScreenshotImage');

    lightbox.classList.remove('active');

    lightboxImage.src = '';
}


/*
==========================================
CLICK OUTSIDE IMAGE TO CLOSE
==========================================
*/

document.getElementById('screenshotLightbox')
    .addEventListener('click', function (e) {

        if (e.target === this) {

            closeScreenshotLightbox();
        }

    });


/*
==========================================
ESC KEY TO CLOSE
==========================================
*/

document.addEventListener('keydown', function (e) {

    if (e.key === 'Escape') {

        closeScreenshotLightbox();
    }

});
</script>
 <script>

 window.authUser = {
        isLoggedIn: "{{ auth()->check() ? 'true' : 'false' }}",
        auth_user_type: "{{ auth()->check() ? auth()->user()->type : 'false' }}" ,
        myLegboxDisabled: "{{ auth()->check() && auth()->user()->viewer_settings?->features_enable_my_legbox == 0 ? 'true' : 'false'}}" ,
        write_reviews_disable: "{{ auth()->check() && auth()->user()->viewer_settings?->features_write_reviews == 0 ? 'true' : 'false' }}" ,
   };


$(document).on('click', '.open_review_box', function (e) {
        e.preventDefault();
       if (window.authUser.write_reviews_disable && window.authUser.auth_user_type=='0') {
            swal_error_warning('Reviews','Please note you have disabled this feature. <br> To access this feature, go to your setting in My Account.');
            return false;
        } else {
            $('#add_reviews').modal('show');
        }
    });

    if (window.authUser.write_reviews_disable && window.authUser.auth_user_type=='0') 
    {

            $('.disabled-button').css({
            'background-color': '#ccc',
            'border-color': '#ccc',
            'color': '#646464',
            'opacity': '0.9',
            });
    }   
    
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


   $(document).on('submit', '#reviewAdvertiser',function(e)
    {
        e.preventDefault();
        var form = $(this);

        if (form.parsley().isValid()) 
        {

            var url = form.attr('action');
            var data = new FormData($('#reviewAdvertiser')[0]);
            
            $.ajax({
                method: 'POST',
                url: url,
                data: data,
                contentType: false,
                processData: false,  
                success: function (data) {
                    $('#reviewAdvertiser')[0].reset();
                    //$('#add_reviews').modal("hide");
                    $('#add_reviews').toggle(); 
                    $('#review-submitted-popup').modal("show");
                    $('#review-escort-name').text("{{ $listing->profile_name  }}");
                    
                    if(!data.error){
                        
                       
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully updated',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',     
                            loaderBg: '#9EC600' 
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Failed to save the review',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',     
                            loaderBg: '#9EC600'  
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



    $(document).ready(function()
    {

            let ratesHeader = @json($rates_header);

            if(ratesHeader.outcall)
            {
                $('.header_rate_two_masseur').html('$'+ratesHeader.outcall+'/hr');
            }
            
            else
            {
                $('.header_rate_two_masseur').html('N/A ');    
            }

            if(ratesHeader.incall)
            {
                $('.header_rate_masseur').html('$'+ratesHeader.incall+'/hr');
            }
            
            else
            {
                $('.header_rate_masseur').html('N/A ');    
            }

            if(ratesHeader.massage)
            {
                $('.header_rate_massage').html('$'+ratesHeader.massage+'/hr');
            }
            
            else
            {
                $('.header_rate_massage').html('N/A ');    
            }



            $('#review_textarea').val($.trim($('#review_textarea').val()));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



        
    const track = document.getElementById('sliderTrack');
    const slides = document.querySelectorAll('.slide_item');

    // Clone first slide and append to end
    const firstClone = slides[0].cloneNode(true);
    track.appendChild(firstClone);

    let index = 0;
    const totalSlides = slides.length + 1;

    function slideNext() {
        index++;
        track.style.transform = `translateX(-${index * 100}%)`;

        if (index === totalSlides - 1) {
        setTimeout(() => {
            track.style.transition = 'none';
            index = 0;
            track.style.transform = `translateX(0%)`;
        }, 600);

        setTimeout(() => {
            track.style.transition = 'transform 0.6s ease-in-out';
        }, 650);
        }
    }



    
    $('#sendReportForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(this);
        formData.append('type','post');
        sendReportAjaxCallback(formData, url, 'POST');
    });


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


    setInterval(slideNext, 5000);



     $('#reportAdvertiserBtn').on('click', function(e) {
        e.preventDefault(); 

        @if(auth()->check() && auth()->user()->type == 0)
            $('#sendcarlat').modal('show');
            var formData = {
                'massage_id' : '{{$listing->id}}',
                'viewer_id' : '{{auth()->user ?? auth()->user()->id}}',
                'type' : 'get',
                'url': "{{ route('massage-spam-report')}}"
            }
            sendReportAjaxCallback(formData, formData.url, 'GET');

        @else 
            $('#reportAdvertiserNew').modal('show');
        @endif
    });

    $(document).on('click', '.reportLogedIn_close, .close', function () {
    $('#sendcarlat').modal('hide');
    $('#reportLogedIn').modal('hide');
    $('#reportAdvertiserNew').modal('hide');
    
    });


    ///////////// Like And Dislike  ///////////////////
    $('#like, #dislike').click(function(e) {
        var vote = 0;
        if($(this).attr('id') == 'like') {
            vote = 1;
        }
        var currentDislikeClickBtn = $(this);

        var url = "{{ route('web.massageLikeDislike') }}";
        $.ajax({
            method: 'POST',
            url: url,
            data: {'vote' : vote, 'massage_id' : {{$listing->id}} },
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

    });

   
   



$(document).ready(function () {
 
    function showModal(currentModal, nextIndex) {
        let modals = $('.masseur-modal');
        let total = modals.length;

        if (nextIndex < 0 || nextIndex >= modals.length) return;

        let nextModal = $(modals[nextIndex]);

        currentModal.removeClass('show');

        setTimeout(function () {

            currentModal.hide();
            nextModal.show();

            setTimeout(function () {
                nextModal.addClass('show');
                updateNavButtons(nextModal, nextIndex, total);
            }, 10);

            $('body').addClass('modal-open');

        }, 300);
    }

    

    
   $(document).on('click', '.btn-next', function () {
    let currentModal = $(this).closest('.masseur-modal');
    let index = parseInt(currentModal.data('index'));

    let newIndex = index + 1;

    showModal(currentModal, newIndex);

    // Get the new modal
    let newModal = $('.masseur-modal').eq(newIndex);

    let massure_id = newModal.data('massure_id');
    let page = "masseur profile";

    generateLog(massure_id, page);
});
    
  $(document).on('click', '.btn-prev', function () {

    let currentModal = $(this).closest('.masseur-modal');
    let index = parseInt(currentModal.data('index'));

    let newIndex = index - 1;

    showModal(currentModal, newIndex);

    // Get NEW modal
    let newModal = $('.masseur-modal').eq(newIndex);

    let massure_id = newModal.data('massure_id');
    let page = "masseur profile";

    generateLog(massure_id, page);
});

});

$(document).on('click', '.close_btn', function () {
    let currentModal = $(this).closest('.masseur-modal');
    currentModal.removeClass('show');

    setTimeout(function () {
        currentModal.hide();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

    }, 300);
});

let visitorUuid = localStorage.getItem('visitor_uuid');

if (!visitorUuid) {
    visitorUuid = crypto.randomUUID();
    localStorage.setItem('visitor_uuid', visitorUuid);
}

 
$(document).on('shown.bs.modal', '.masseur-modal', function () {

    let modal = $(this);
    let index = parseInt(modal.data('index'));
    let total = $('.masseur-modal').length;
 
    updateNavButtons(modal, index, total);

     let massure_id = $(this).data('massure_id');
    let page = $(this).data('page');
   generateLog(massure_id,page);
});



$(document).on('click', '.main-gallery-image', function () {
    let massure_id = $(this).data('massure_id');
    let page = "massure media";
   generateLog(massure_id,page);

});


function generateLog(massure_id, page)
{
    $.ajax({
        url: "{{ route('web.generate.log') }}",
        type: "POST",
        data: {
            masseur_id: massure_id,
            page: page,
            visitorUuid: visitorUuid,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            // console.log('Log generated successfully:', response);
        },
        error: function (xhr) {
            console.log('Error generating log:', xhr.responseText);
        }
    });
}
function updateNavButtons(modal, index, total) {

    let prevBtn = modal.find('.btn-prev');
    let nextBtn = modal.find('.btn-next');

    // PREV button
    if (index === 0) {
        prevBtn.addClass('btn-disabled');
    } else {
        prevBtn.removeClass('btn-disabled');
    }

    // NEXT button
    if (index === total - 1) {
        nextBtn.addClass('btn-disabled');
    } else {
        nextBtn.removeClass('btn-disabled');
    }
}

$(document).on('click', '.btn-prev, .btn-next', function (e) {
    if ($(this).hasClass('btn-disabled')) {
        e.preventDefault();
        return false;
    }
});



function initMap() 
{
    const capital_city = '{{ $capital_city }}';
    const address = @json($listing->address ?? $capital_city);
    const banner = "{{ $massage_banner }}";

    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ address: address }, function(results, status) {

        if (status === "OK") 
        {
            const location = results[0].geometry.location;

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: location,
            });

            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });

            
            const service = new google.maps.places.PlacesService(map);

            service.findPlaceFromQuery({
                query: address,
                fields: ["name", "photos", "rating"]
            }, function(placeResults, placeStatus) {

                let imageUrl = ''  //banner fallback image
                let placeName = capital_city;
                let ratingHtml = "";

                if (placeStatus === google.maps.places.PlacesServiceStatus.OK && placeResults[0]) 
                {
                    const place = placeResults[0];
                    // console.log('place',place);

                    placeName = place.name || placeName;

                    if (place.rating) {
                        ratingHtml = `<div style="margin:0; font-size:12px;"> ${getStars(place.rating)} </div>`;
                    }

                    if (place.photos && place.photos.length > 0) {
                        imageUrl = place.photos[0].getUrl({ maxWidth: 400 });
                    }
                }

               let g_image = "";
               if(imageUrl!="")
                g_image = `<img  style="width:100%; height:80px; object-fit:cover; border-radius:10px;" src=${imageUrl}  class="facebook-logo" alt="logo">`;
               
               const content = `<div class="location_class">  ${g_image}  ${address} ${ratingHtml} <i class="fa fa-star-half-alt"></i></div>`;
                const infowindow = new google.maps.InfoWindow({
                    content: content
                });

                infowindow.open(map, marker);
            });

          
            const lat = location.lat();
            const lng = location.lng();

            if (document.getElementById("lat")) {
                document.getElementById("lat").value = lat;
                document.getElementById("lng").value = lng;
            }

        } 
        else 
        {
            console.error("Geocode failed: " + status);
        }
    });
}

function getStars(rating) {
    let fullStars = Math.floor(rating);
    let halfStar = rating % 1 >= 0.5 ? 1 : 0;
    let emptyStars = 5 - fullStars - halfStar;

    let stars = '<div class="star-rating">'+'<span class="location_rating">'+rating+'</span>';

    for (let i = 0; i < fullStars; i++) {
        stars += ' <span class="star full"></span>';
    }

    if (halfStar) {
        stars += '<span class="star half"></span>';
    }

    for (let i = 0; i < emptyStars; i++) {
        stars += '<span class="star"></span>';
    }

    stars += '</div>';

    return stars;
}
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
            var url = "{{ route('user.save.massage.legbox' ,':id')}} ";
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
            var url = "{{ route('user.delete.massage.legbox' ,':id')}} ";
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


        // console.log(cid[1] + "-" + Eid);
        // console.log(cidcl);
    });

window.initMap = initMap;
</script>
@endpush


