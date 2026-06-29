@extends('layouts.webHome')
@section('content')

@php
    $escortName = ($escort->gender == 'Transgender')
        ? 'TS-' . substr($escort->name, 0, 15)
        : substr($escort->name, 0, 15);
@endphp


    <section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly homebanner_bg js_pinup_summary">
    <div class="container-fluid banner_width">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-5 col-sm-12">
                <div href="#" class="tip mb-2 pinup-summary-img d_custom_pinup_img lg_icon_wrapper">
                    <img 
                    src="{{ !empty($user->defaultPinupImage)?asset($user->defaultPinupImage->path):asset('assets/app/img/home/home-demo.png') }}">
                     @if ($escort->latestActiveBrb)
                        <p class="pinup_brb_strip">BRB at <span>
                                {{ date('h:i A d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }} <br>
                                {{ $escort->latestActiveBrb->brb_note }}</span></p>
                    @endif
                    <span class="memmber_info"><i class="fa fa-user"></i> Member ID: {{$escort->user->member_id}}</span>
                    @php 
                        $pinup_data  = get_escort_media_id_by_path($escort->user->defaultPinupImage->path);
                        $status = $pinup_data->varified ?? 0; 
                        $status_icon = getMediaVerificationDataBigIcon($status);
                    @endphp
                     <div class="lg_verify_icon">                          
                        <img src="{{ $status_icon['icon'] }}">
                        <span class="common_shield_tooltip">{{ $status_icon['label'] }}</span>

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7 col-sm-12">
    
                
                <div class="pin-up-content pl-lg-5">
                    <div class="pin-head-custom">
                         <h1 class="home_heading_first ">{{$escortName}} 
                            @php 
                            $galleryVideos = $escort->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();
                            @endphp
                            @if($galleryVideos->count()>0)
                                <div class="custom-video-wraper">
                                    <div class="video--icon">
                                        <a href="#">
                                            <img src="/assets/app/img/video_play.svg" class="" alt="logo">
                                            <small class="video-tooltip">I have Video</small>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </h1>
                        <span class="pinup_age">
                            <div class="pin-age">Age: <span>{{$escort->age}}</span></div>
                        </span>
                         <div class="go-to-index">
                             <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/app/img/newcross.png') }}" alt="cross">
                            </a>
                        </div>
                    </div>
                   
                    <div class="v-path">
                        <h3 class="mb-0">{{$escort->city->name}}</h3>
                        <ul class="meet-with custom-meet-pin">
                            <h5 class="mb-0"><strong>Meet with:</strong></h5>
                            <li class="{{!empty($escort->available_to) && in_array(1 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/woman-avatar-big.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Female</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(2 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/male-user.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Male</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(3 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/transgender-big.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Transgender</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(4 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/couple.png') }}" class=""
                                        alt="logo">
                                    <span class="custom-icon-hover-tooltip">Couples</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(5 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/icon_disabled.png') }}" class=""
                                    alt="logo">
                                <span class="custom-icon-hover-tooltip">Disabled</span>
                            </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(6 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/icon_groups.png') }}" class=""
                                    alt="logo">
                                <span class="custom-icon-hover-tooltip">Groups/Parties</span>
                            </a></li>
                        </ul>
                    </div>
                    @php
                        $about = html_entity_decode(strip_tags($escort->about));
                        $massage_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price:0;
                        $incall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->incall_price:0;
                        $outcall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price:0;
                    @endphp
                    <div>
                         <h5 class="mb-0"><strong>About Me</strong></h5>
                         <p class="pin-description text-justify mb-0">{{ $about }}</p>
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-20 flex-wrap ">
                        <div class="media align-items-center justify-content-start gap-20">
                            <div class="mc_tooltip_wrap">
                                <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                <span class="mc_rate_tooltip">You come to me.</span>
                            </div>

                            <div class="media-body">
                                <h4>Massage</h4>
                                <p class="mb-0">{{ $massage_price ? '$'. number_format($massage_price).'/hr' : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="media align-items-center justify-content-start gap-20">
                            <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                    <span class="mc_rate_tooltip">You come to me.</span>
                                    </div>
                            <div class="media-body">
                                <h4>Incalls</h4>
                                <p class="mb-0">{{ $incall_price ? '$'. number_format($incall_price).'/hr' : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="media align-items-center justify-content-start gap-20">
                            <div class="mc_tooltip_wrap">
                                        <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                    <span class="mc_rate_tooltip">I come to you.</span>
                                    </div>
                            <div class="media-body">
                                <h4>Outcalls</h4>
                                <p class="mb-0">{{ $outcall_price ? '$'. number_format($outcall_price).'/hr' : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-20 flex-wrap">
                        <div class="d-flex align-items-center justify-content-between gap-10 flex-wrap">
                                <div class="my-play-box-profile-icon">
                                <a href="{{ url('playbox') }}" target="_blank">
                                    <img src="{{ asset('assets/app/img/MyPlaybox.png') }}" alt="My Playbox Icon">
                                </a>
                                <div class="custom-tooltip">My Playbox</div>
                            </div>
                                @if(isset($escort->mainPurchase) && $escort->mainPurchase->tour_location_id!=null)
                                <div class="my-play-box-profile-icon">
                                    <a href="#">
                                        <img src="{{ asset('assets/app/img/icon_tour_white.png') }}" alt="My Playbox Icon">
                                    </a>
                                    <div class="custom-tooltip">{{$escort->left_listing_days > 0 ? "On Tour, {$escort->left_listing_days} days left.":"On Tour, today is my last day."}}</div>
                                </div>
                            @endif

                            <ul class="profile_page_social_profiles mb-lg-0 mb-1">
            
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
                        <div class="">
                            <a href="{{ route('profile.description', $escort->id) }}" class="btn-common">View Profile</a>
                        </div>
                    </div>
                    
                    @if($escort->address)
                        <div class="pinup_address">
                            <p><img src="{{ asset('assets/app/img/gps.png') }}" alt="location"  class="custompopicon"> {{$escort->address}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

</div>
    </section>


    <section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly angle_bg_image">
        <div class="container">
            <div class="home_welcome text-center">
                <div class="site_second_heading">
                    <h2 class="text-white text-uppercase">Welcome to Escorts4U</h2>
                </div>
                <div class="welcome_msg_sub_heading">
                    <p class="text-white text-uppercase normal_heading">It is all about the companionship</p>
                </div>
                <div class="welcome_msg_peraone">
                    <p class="text-white">Welcome to the preferred website where Private Escorts and erotic Massage Centres advertise their companionship and services to Viewers who are looking for company.</p>
                    <p class="text-white">Advertisers set out a detailed and informative Profile or Tour where they propose their time and companionship, enabling Viewers to make direct contact. A Massage Centre has its own unique Profile designed to bring detailed Profile information about their business premises, Masseurs and their services directly to you.</p>
                </div>
                <div class="welcome_msg_peratwo">
                    <p class="welcome_text_color">Absolutely no banner advertising, third party marketing or spam!</p>
                </div>
            </div>
        </div>
    </section>
    <div class="container custom--contain">
        <div class="row justify-content-center text-center">
            <div class="col-md-9">
                <div class="padding_ninty_top_ninty_px">
                    <div class="text-center">
                        <div class="site_second_heading">
                            <h2 class="text-uppercase our">Our services to you</h2>
                        </div>
                        <div class="our_service_peragraph">
                            <p>In addition to providing advertising services, we also assist with industry information for Advertisers and Viewers,<br> located in the footer, together with our My Playbox and Concierge Services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h5 class="normal_heading primery_color">Our aim is to provide:</h5>
                <div class="our_aim">
                    <ul id="our_aim_list">
                        <li>
                            <img src="{{ asset('assets/app/img/home/high-five.png') }}">
                            <p>A friendly and accessible service for Advertisers and Viewers</p>
                        </li>
                        <li>
                            <img src="{{ asset('assets/app/img/home/accuracy1.png') }}">
                            <p>Viewers with accurate information about the Services on offer</p>
                        </li>
                        <li>
                            <img src="{{ asset('assets/app/img/home/customer-service.png') }}">
                            <p>Good "Support" services for both Advertisers and Viewers</p>
                        </li>
                        <li>
                            <img src="{{ asset('assets/app/img/home/rating.png') }}">
                            <p>The opportunity for Viewers to post “Reviews” about their experiences</p>
                        </li>
                        <li>
                            <img src="{{ asset('assets/app/img/home/profits.png') }}">
                            <p>A cost effective service for Advertisers</p>
                        </li>
                        <li>
                            <img src="{{ asset('assets/app/img/home/encrypted.png') }}">
                            <p>Assurance about privacy for both Advertisers and Viewers</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="point_of_diff">
                    <h3 class="text-white">What is our point of difference?</h3>
                    <div class="point_of_diff_peragrapg">
                        <p class="text-white">It became apparent to us after talking with Advertisers and Viewers that there were a number of concerns about the quality and integrity of the services and offerings websites brought to Private Escorts and Massage Centres.</p>
                        <p class="text-white">Those discussions helped bring about this Website, ensuring also that it complies with the Local Laws. Features such as verified photos, reviews, guides, concierge services, notes and Alerts are designed to make your experience a pleasant one.</p>
                        <p class="text-white"> We also offer a loyalty program.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="one-stop-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="one_stop_shop">
                        <div class="text-center">
                            <div class="site_second_heading pb-4 ">
                                <h2 class="text-uppercase color-white">E4U: YOUR ONE-STOP SHOP!</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 shop-box-col">
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border lign-items-center">
                                <a href="{{ url('accommodation')}}" class="termsandconditions_text_color"><img src="{{ asset('assets/app/img/home/live-booking.png') }}"></a>
                                <p>Live booking services for accommodation and travel </p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border my-auto">
                                <a href="{{ url('professional-product')}}" class="termsandconditions_text_color"><img src="{{ asset('assets/app/img/home/product-delivery.png') }}"></a>
                                <p>Product delivery</p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border">
                                <a href="{{ url('mobile-read-sim')}}" class="termsandconditions_text_color"><img src="{{ asset('assets/app/img/home/telecommunication.png') }}"></a>
                                <p>Telecommunication services - Mobile SIM & Email account</p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border">
                                <a href="{{ url('visa-migration')}}" class="termsandconditions_text_color"><img src="{{ asset('assets/app/img/home/visa1.png') }}"></a>
                                <p>Visa & education advice</p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border">
                                <img src="{{ asset('assets/app/img/home/extensive.png') }}">
                                <p>An extensive range of new features for Advertisers and Viewers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home_reg_bg">
        <div class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="register-img">
                            <img src="{{ asset('assets/app/img/shutterstock_338759729.png') }}">
                        </div>
                    </div>
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <div class="normal_heading pt-5">
                            <p class="primery-color">NOT A MEMBER YET?</p>
                        </div>
                        <div class="site_second_heading">
                            <h2 class="primery-color" style="line-height: 30px;">REGISTER NOW!</h2>
                        </div>
                        <div class="reg_now_pera">
                            <p class="  pt-3">There are no fees when your create an Account. Fees only apply when you post a Profile or Tour where you are charged according to the number of days and the Membership Type you select (Book by the day!). See also <a href = "help-for-escorts" class="termsandconditions_text_color" >Help for Escorts</a></p>
                            <p class="" >Massage Centres are also looked after with a uniquely designed Profile just for them.  List up to eight Masseurs on the one Profile.</p>
                        </div>
                        </br>
                        <div class="padding">
                            <a class="btn btn_advertiser"  style="border: 1px solid;" href="{{ route('advertiser.register') }}" role="button">I am an Advertiser</a>
                            <a class="btn btn_viewer" style="border: 1px solid;" href="{{ route('register') }}" role="button">I am a Viewer</a>
                            <a class="btn  btn_viewer" style="color:red;border: 1px solid;" href="{{ route('agent.register')}}" role="button">I am an Agent</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush