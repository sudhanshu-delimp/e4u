@extends('layouts.web')
@section('style')
<style>
.mc_profile_table .table th{
    padding: .8rem .55rem !important;
}
.timing_data tbody td{
    text-align: left !important;
}

.profile_img {
    border-radius: 23px;
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
    bottom: 110%;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s;
}
.mc_avail_table table td {
    padding: 5px 0px !important;
}
</style>
    @stop
    @section('content')

    @php 
        $massager_name = $listing->profile_name;
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
            $img = get_massage_images($listing, $i);
            $images[$i] = $img;

            if ($img !== false) {
                $validImages[$i] = $img;
            }
        }


    $social_links = $listing->social_links;
    $rates_header = "";

    $payType = '';
    foreach(config('escorts.profile.Payments') as $key => $PaymentType) {
        if ($listing->payment == $key) {
            $payType = $PaymentType;
            break; 
        }
                                                    }
     
    $galleryVideos = $listing->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();
                        

    @endphp


   <div class="container profile_description_banner custom--profile custommassage--profile--page"
     style="background-image: url('{{ $massage_banner }}');
            background-position: center;
            background-repeat: no-repeat;">

        <div class="container-fluid back_to_search_btn pt-2">
            <a href="#" class="back--search">
                Back to Search
                <span class="previous_icon">
                    <i class="fa fa-chevron-up text-white" aria-hidden="true"></i>
                </span>
            </a>
        </div>

        <div class="container">
            <div class="profile_page_title">
                <h2 class="display_inline_block p-0">{{ $listing->profile_name ?? 'N/A' }}</h2>
            </div>

            <div class="profile_page_name_and_phno">
                <p> {{ get_massage_home_city($listing->user_id) .'-'.formatMobileNumber($listing->phone) }}   </p>
            </div>

            <div class="profile_page_location_and_id">
                <ul>
                    <li>
                        <span class="profile_location_icon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </span>
                        <p class="display_inline_block">{{  $listing->address ?? 'N/A' }}</p>
                    </li>
                    <li>
                        <span class="profile_location_icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <p class="display_inline_block">Member ID: {{   get_massage_member_id($listing->user_id) }}</p>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center justify-content-start gap-10">
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


                @if(isset($social_links['twitter']) && $social_links['twitter']!="")
                    <li class="social-media-profile">
                        <a href="{{$social_links['twitter']}}" target="_blank">
                            <img src="{{ asset('../assets/app/img/twitter-x.png') }}" class="twitter-x-logo" alt="logo">
                        </a>
                    </li>
                @endif  
                    

                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0 next-preview-fixed">
        <div class="d-flex d-flex justify-content-between">
            <div class="previous_btn_profile next_previous_btn_pogision preview-dk previousDisableButtonCss">
                <a href="" class="text-decoration-none d-flex">
                    <span class="previous_icon"><i class="fa fa-chevron-left text-white" aria-hidden="true"></i></span>
                    <span class="previous_text remove_in_sm">Previous</span>
                </a>
            </div>
            <div class="next_btn_profile next_previous_btn_pogision next-dk nextDisableButtonCss">
                <a href="" class="text-decoration-none">
                    <span class="previous_text remove_in_sm">Next</span>
                    <span class="previous_icon"><i class="fa fa-chevron-right text-white" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container profile_contain">
        <div class="row">
            <div class="col-md-8 col-xl-8 col-sm-12 col-12">
                <div class="row mb-3">
                    <div class="col-md-12 col-xl-12 col-sm-12 col-12">
                        <div class="row custom_message_types">

                            <div class="col-sm-12 d-flex align-items-center justify-content-between gap-10 flex-wrap">
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                        <img src="../assets/dashboard/img/massage-only.png" alt="Massage">
                                        <p class="mc_rate_tooltip">Massage only</p> 
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_massage">$100/hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="../assets/dashboard/img/massage-with2.png" alt="Masseur">
                                     <p class="mc_rate_tooltip">Massage with extras +2 hands.</p> 
                                    </div>    
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Masseur</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_masseur">$120/hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="../assets/dashboard/img/massage-with4.png" alt="2+ Masseurs">
                                    <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>   
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4 >2+ Masseurs</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4 class="header_rate_two_masseur">$150/hr</h4>
                                        </div>
                                    </div>
                                </div>
                                 <button type="button" class="btn mc_my_legbox_btn" data-target="#my_legbox" data-toggle="modal">
                                    <span class="add_to_favrate">
                                        <i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i>
                                    </span>
                                    Save to My Legbox
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mc_profile_table">
                    <div class="col-lg-6 col-md-12">

                        

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

                                           @if($massage_price)
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $massage_price }}
                                                </div>
                                            @else
                                                <span class="na-label">N/A</span>
                                            @endif

                                    </td>

                                    <td>
                                        @if($incall_price)
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $incall_price }}
                                                </div>
                                            @else
                                                <span class="na-label">N/A</span>
                                            @endif
                                    </td>
                                    <td>

                                            @if($outcall_price)
                                                <div class="public-num-value-table">
                                                    <span>$ </span>{{ $outcall_price }}
                                                </div>
                                            @else
                                                <span class="na-label">N/A</span>
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

                    <div class="col-lg-6 col-md-12">
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
                        <div style="width: 100%">
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
                        <iframe 
                            width="100%" 
                            height="153" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{ urlencode('Perth, Western Australia') }}&hl=en&z=14&output=embed"
                            style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                        </iframe>
                        
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
                             @foreach($listing->massagerMasseurs as $masseur)

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
                                        $images[$i] = $img;

                                        if ($img !== false) {
                                            $messure_validImages[$i] = $img;
                                        }
                                    }

                            @endphp

                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="d-flex align-items-center gap_between_text_and_img our-masseurs"
                                    data-toggle="modal" data-target="#product_view_{{$masseur->id}}">
                                    <div><img src="{{ $profile_img }}" width="50" height="50"  class="profile_img"></div>
                                    <p class="mb-0 text_truncate">{{ $masseur->name}}</p>
                                </div>
                            </div>


                                <!-- /////////// Messeur Modal //////////////// -->
                                <div class="modal fade product_view" id="product_view_{{$masseur->id}}">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="mc_member_id"> <img src="{{ asset('../assets/app/img/Vector-31.png') }}" class="img-responsive"> Member ID: {{ $masseur->member_id ?? 'N/A' }} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}"
                                                        class="img-fluid img_resize_in_smscreen"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body pb-4 mb-2 pt-1">
                                            <div class="row">

                                                <div class="col-md-4 product_img mc_profile_img pr-0">

                                                            @foreach ($messure_validImages as $index => $image)
                                                                @if($loop->first)
                                                                <img src="{{  $image }}" class="img-responsive"
                                                                style="width: 305px;height: 374px;object-fit: cover;">
                                                                @endif
                                                            @endforeach

                                                    <div class="veryfy_img">
                                                        <img src="{{ asset('../assets/app/img/verify/unverified_light.png') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-1 product_img pl-0" style="display: flex; flex-direction: column;  gap: 8px;justify-content: flex-start;">

                                                        @foreach ($messure_validImages as $index => $image)
                                                            @if(!$loop->first)
                                                            <img src="{{ $image }}" class="img-responsive"  style="width: 108px;height: 119px;object-fit: cover;">
                                                            @endif
                                                        @endforeach
                                                </div>

                                                <div class="col-md-7 product_content pl-5 pt-1 d-flex flex-column justify-content-between" style="">

                                                    <div>
                                                        <div class="mc_profile_info">
                                                            <h3 class="mb-0">{{ $masseur->name ?? 'N/A' }}</h3>
                                                            <span>AGE : <b>{{ $masseur->age ?? 'N/A' }}</b></span>

                                                            <div class="massage_type">
                                                               
                                                            


                                                            @if(in_array('massage', $masseur_services))
                                                                <div class="massage_type_info">
                                                                    <img src="{{ asset('assets/dashboard/img/massage-only.png') }}">
                                                                    <p class="mc_rate_tooltip">Massage only</p>
                                                                </div>
                                                            @endif    

                                                            @if(in_array('2_hand', $masseur_services))
                                                                <div class="massage_type_info">
                                                                    <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}">
                                                                    <p class="mc_rate_tooltip">Massage with extras +2 hands.</p>
                                                                </div>
                                                             @endif       

                                                            @if(in_array('4_hand', $masseur_services))
                                                                <div class="massage_type_info">
                                                                    <img src="{{ asset('assets/dashboard/img/massage-with4.png') }}">
                                                                    <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>
                                                                </div>
                                                             @endif   

                                                            </div>
                                                        </div>
                                                        <div class="mc_profile_modal">
                                                            <span><b>Mobile Number :</b> <span class="about_box_small_heading_value">{{ formatMobileNumber($masseur->mobile) ?? 'N/A' }}</span></span>
                                                            <span><b>Vaccination :</b> <span class="about_box_small_heading_value">
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
                                                            </span></span>

                                                        </div>
                                                        <div class="mc_profile_modal">
                                                            <span><b>Nationality :</b> <span class="about_box_small_heading_value">

                                                                {{ getCountryList()[$masseur->nationality] ?? 'N/A' }}

                                                            </span></span>
                                                            
                                                            <span><b>Ethnicity :</b> <span class="about_box_small_heading_value">
                                                                 {{  config('escorts.profile.ethnicities')[$masseur->ethnicity] ??  'N/A' }}
                                                            </span></span>
                                                        </div>
                                                        <div class="mc_profile_modal d-block">
                                                            <span><b>Massage Services:</b> <span class="about_box_small_heading_value">
                                                                    {{ rtrim($massage_services, ', ') }}
                                                            </span></span>
                                                        </div>

                                                        <div class="mc_profile_modal d-block">
                                                            <span><b>Other Service Types :</b> <span class="about_box_small_heading_value">
                                                                    {{ rtrim($other_services, ', ') }}

                                                            </span></span>
                                                        </div>


                                                    </div>

                                                    <div>
                                                        <h5 class="mb-0" style="color: #000">About Me : </h5>
                                                        <p class=" mt-0 text-justify">{!! $masseur->commentary ?? 'N/A' !!}</p>
                                                    </div>
                                                </div>




                                            </div>

                                            <div class="col-lg-12 mt-2 p-0">
                                                <div class="table-responsive-sm mc_avail_table">
                                                    <table class="table table-bordered">
                                                        <thead class="bg-first">
                                                            <tr>
                                                                <th colspan="7" class="text-center">My Availability</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:14.2%">Monday</th>
                                                                <th style="width:14.2%">Tuesday</th>
                                                                <th style="width:14.2%">Wednesday</th>
                                                                <th style="width:14.2%">Thursday</th>
                                                                <th style="width:14.2%">Friday</th>
                                                                <th style="width:14.2%">Saturday</th>
                                                                <th style="width:14.2%">Sunday</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          {!! get_messure_weakly_availibility($masseur) !!}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- /////////// Messeur Modal //////////////// -->





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
                                                                   

                                                                    @if($value->price)
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
                                                            
                                                         @foreach (
                                                                    $listing->massage_services()
                                                                        ->where('category_id', 1)
                                                                        ->get()
                                                                        ->values()
                                                                        ->filter(fn($item, $index) => $index % 2 != 0)
                                                                    as $value
                                                                )
                                                           <tr>
                                                               
                                                                <td class="table_border_dash_left">{{config('escorts.profile.massage-services')[$value->service_id]  }}</td>
                                                                <td class="table_border_solid_left">
                                                                   

                                                                    @if($value->price)
                                                                    <div class="public-num-value-table"> <span>$ </span>{{ number_format($value->price, 2) }}</div>
                                                                    @else
                                                                    <span class="if_data_not_available">N/A</span>
                                                                    @endif
                                                                
                                                                </td>
                                                            </tr>

                                                            @endforeach
                                                            </tr>
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
                                                                   

                                                                    @if($value->price)
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
                                                            
                                                         @foreach (
                                                                    $listing->massage_services()
                                                                        ->where('category_id', 2)
                                                                        ->get()
                                                                        ->values()
                                                                        ->filter(fn($item, $index) => $index % 2 != 0)
                                                                    as $value
                                                                )
                                                           <tr>
                                                               
                                                                <td class="table_border_dash_left">{{config('escorts.profile.other-services')[$value->service_id]  }}</td>
                                                                <td class="table_border_solid_left">
                                                                   

                                                                    @if($value->price)
                                                                    <div class="public-num-value-table"> <span>$ </span>{{ number_format($value->price, 2) }}</div>
                                                                    @else
                                                                    <span class="if_data_not_available">N/A</span>
                                                                    @endif
                                                                
                                                                </td>
                                                            </tr>

                                                            @endforeach
                                                            </tr>
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
     
         


            <div class="col-md-4 profile-sidebar-margin-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div id="carouselExampleInterval" class="carousel slide mc_view_media" data-ride="carousel"
                                data-interval="false">
                                <span class="mc_tooltip" data-toggle="modal" data-target="#exampleModal">Click to view My Media.</span>
                                <div class="carousel-inner">
                                    
                                    <!-- Carousel Item 1 -->
                                   
                                    @foreach ($validImages as $index => $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-interval="10000">
                                            <div class="row">
                                                <div class="col-12 remove_padding_for_carousel">
                                                    <img src="{{ $image }}"
                                                        class="d-block w-100"
                                                        alt="Gallery Image"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                   

                                    

                                </div>

                                <!-- Carousel Controls -->
                                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button"
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
                <div class="row pt-2 eqal-bx">
                    <div class="col-5">
                        <button type="button" class="btn profile_message_btn_cc" data-toggle="modal"
                            data-target="#mysendmessage">
                            <img src="../assets/app/img/smallsmsicon.png" class="image_20px_msg">Message Us
                        </button>
                    </div>
                    <div class="col-7 text-right">
                        <button type="button" class="btn profile_message_btn_cc" data-toggle="modal"
                            data-target="#reportMcNew">
                            <img src="../assets/app/img/smallsmsicon.png" class="image_20px_msg">Report Centre
                        </button>
                    </div>
                </div>

                <!-- Hidden input (static example) -->
                <input type="hidden" name="escortId" value="123" id="eid">

                <!-- Like / Dislike Bar -->
                <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                    <div class="like_img">
                        <i id="dislike" class="fa fa-thumbs-o-down" title="Dislike" aria-hidden="true"></i>
                    </div>
                    <div class="process_bar_width like_mjo">
                        <div id="vote_bar" class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger progress-bar-stripped" style="width: 0%">0%</div>
                            <div class="progress-bar bg-success" style="width: 100%;">100%</div>
                        </div>
                    </div>
                    <div class="like_img">
                        <i id="like" class="fa fa-thumbs-o-up" title="Like" aria-hidden="true"></i>
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
                        <h2><img src="../assets/app/img/contact_me.svg"> Contacting us</h2>
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
                                        $from = $listing->phone;
                                        $number = sprintf("%s-%s-%s",
                                        substr($from, 0, 3),
                                        substr($from, 3, 3),
                                        substr($from, 6));
                                        //dd($number);
                                        @endphp
                                        <p class="font-weight-bold mb-0 mt-2">When texting us please say :</p>
                                        <p class="profile_description_contect_pera">
                                            <b><i>Hi {{ $massager_name }}, I found you on Escorts4U ... </i></b>
                                            @php
                                                $formattedNumber = $listing->phone;
                                                $contactTypes = $listing->contact != null ? $listing->contact : '';
                                            
                                            @endphp

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
                                                on our number --====
                                            @endif
                                        </p>
                            </span>
                        </div>
                </div>

                <!-- Vaccination Status -->
                <div class="vax-btn">
                    <button type="button" class="btn my_legbox single-prof-btn">
                        <img src="../assets/app/img/vaccinated.svg">Vaccinated, up to date
                    </button>
                </div>

                <!-- Accordion: Pricing Policy & Disclaimer -->
                <div class="accordion-container-new">
                    <div class="set">
                        <a class="pb-1 pt-1">
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
                        <a class="pb-1 pt-1">
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
                        <h2><img src="../assets/app/img/tips.svg">Tips</h2>
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
                        <h2 class="custom--review"><img src="../assets/app/img/review-custom.png"> Reviews</h2>
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
                                            @php
                                                if($review->user && auth()->user() && auth()->user()->id == $review->user_id && $review->escort_id == $listing->id){
                                                    $reviewAlreadyExist = true;
                                                    $reviewExistsMessage = $review->description;
                                                    $reviewExistsStarRating = $review->star_rating;
                                                }
                                            @endphp
                                            
                                            <div class="carousel-item carousel-custome-item {{$key == 0 ? 'active' : ''}}">
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
                                                    <p class="custome-text-date mb-0">Reviewed: {{$review->created_at->format('d-m-Y')}}</p>
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
                                    <strong>{{ $massager_name }}</strong> has no Reviews. @php if($mesageForViewer != false){ @endphp Why don’t you give <strong>{{ $massager_name}}</strong> their first Review? @php } @endphp
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

        
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel"> <img
                            src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Us  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                @if (auth()->check() && auth()->user()->type == 0)
                    <div class="modal-body">
                        <h5 class="my-4 custom_modal_text">
                            <span id="Lname">To message Alina please go to your Dashboard and select
                                Communications > Messages. </span>
                        </h5>
                        <hr style="background-color: #0C223D">
                        <p class="mb-1 mt-3"><b>Notes:</b></p>
                        <ol>
                            <li>Make sure you have enabled Messaging in your settings. If you have added Alina to your
                                Legbox, they will appear in your Message list. Otherwise, you can search by Member ID.</li>
                            <li>To message Alina, they will also need to have Messaging enabled.</li>
                        </ol>
                    </div>
                    <div class="modal-footer justify-content-end pt-0">
                        <a href="{{ route('user.viewer-messages') }}" type="button" class="btn-success-modal text-white"
                            id="loginUrl" style="text-decoration: none;">Go to Message</a>
                    </div>
                @else
                    <!-- if viewer not login -->
                    <div class="modal-body text-center">
                        <h5 class="popu_heading_style mb-4 mt-4">
                            <span id="Lname">Message Us is only available to Viewers.
                                Please log in or Register to access Message Us.</span>
                        </h5>
                        <a href="{{ route('viewer.login') }}" type="button" class=" btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                        <a href="{{ route('register') }}" type="button" class="btn-success-modal" id="regUrl" style="text-decoration: none;">Register</a>
                       
                    </div>
                @endif
                <!--- end -->

            </div>
        </div>
    </div>
    <!-- model end here 1-->
    <!-- model start here 2-->

    <div class="modal fade upload-modal" id="reportMcNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header main_bg_color">
                
                    
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Masseur </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <!-- if viewer not login -->
                <div class="modal-body pb-0">
                    <h6 class="my-4 custom_modal_text">
                        <span id="Lname">Report Masseur is only available to Viewers. Please log in or Register to access Report Masseur.</span>
                    </h6>
                    <div class="modal-footer text-center justify-content-center pt-0">
                    <a href="{{ route('viewer.login') }}" type="button" class="btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" type="button" class="btn-success-modal" id="regUrl" style="text-decoration: none;">Register</a>
                    </div>
                </div>
                <!--- end -->

            </div>
        </div>
    </div>

    <div class="modal fade upload-modal ss" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
                
                <form id="reviewAdvertiser_OLD" action="#" method="post">
                    <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group popup_massage_box">
                                    <p class="font-weight-bold">What is wrong:</p>
                                    <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="5"
                                        placeholder="Message (250 characters)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex  align-items-center">
                                    <p class="diff_font_pera mb-0 mr-2">Why are you reporting this Profile:</p>
                                    <div class="form-check py-0 mr-2">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="1">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Fake Media
                                        </span>
                                    </div>
                                    <div class="form-check py-0 mr-2">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="0">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Spam
                                        </span>
                                    </div>
                                    <div class="form-check py-0">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="2">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Other
                                        </span>
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
                        <button type="submit" class="btn-success-modal">Send Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model start here 3-->
<div class="modal fade upload-modal add_reviews" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        
        <div class="modal-header">
                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">{{$reviewAlreadyExist ? 'Edit' : "Add"}} review for {{ $massager_name }}
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
                    <div class="modal-header">
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
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="custompopicon">
                    <h5 class="modal-title" id="exampleModalLabel"> <img
                            src="{{ asset('../assets/app/img/smallsmsicon.png') }}" class="img-fluid"> Send New Harmony
                        Nature Massage a
                        message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('../assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <p class="popu_heading_style">Note:-</p>
                    <ol class="mb-0">
                        <li>The Escort needs to have this feature enabled in order to receive it.</li>
                        <li>You will receive a notification when thismessage is responded to.</li>
                    </ol>
                </div>
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
                    <div class="modal-footer">
                        <button type="submit" class="btn-success-modal">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   

    {{-- My Photos --}}

    <div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
                <div class="modal-header d-flex justify-content-between align-items-center">                                       
                    <ul class="nav nav-tabs justify-content-center border-0 ec_media_tab">
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
                
                <div class="modal-body p-1">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="gallery">

                                @foreach ($validImages as $index => $image)
                                    @if($loop->first )
                                    <div class="gallery__item gallery__item--lg"><img src="{{  $image }}" alt="main"></div>
                                    @endif    
                                  @endforeach    

                                <div class="small-images">

                                        @foreach ($validImages as $index => $image)

                                            @continue($loop->first)

                                            <div class="gallery__item">
                                                <img src="{{ $image }}" alt="gallery image">
                                            </div>

                                        @endforeach   
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                            
                            <div class="row px-3 pb-2" id="dvSource">
                                
                                        @foreach($galleryVideos as $key=>$media) 
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

    {{-- end --}}

    {{-- my legbox --}}
    
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
                    <h5 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                        <span id="Lname">My Legbox is only available to Viewers. Please log in or Register to access your Legbox.</span>
                    </h5>
                    <a href="{{ route('viewer.login') }}" type="button" class="btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" type="button" class="btn-success-modal" id="regUrl" style="text-decoration: none;">Register</a>
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

 window.authUser = {
        isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
        auth_user_type: {{ auth()->check() ? auth()->user()->type : 'false' }},
        myLegboxDisabled: {{ auth()->check() && auth()->user()->viewer_settings?->features_enable_my_legbox == 0 ? 'true' : 'false'}},
        write_reviews_disable: {{ auth()->check() && auth()->user()->viewer_settings?->features_write_reviews == 0 ? 'true' : 'false' }},
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



            $('#review_textarea').val('');

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

    setInterval(slideNext, 5000);





    });
</script>
@endpush
