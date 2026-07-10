@extends('layouts.webHome')
@section('content')

    @php
        $escortName =
            $escort->gender == 'Transgender' ? 'TS-' . substr($escort->name, 0, 15) : substr($escort->name, 0, 15);
    @endphp


    <section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly homebanner_bg js_pinup_summary">
        <div class="container-fluid banner_width">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-5 col-sm-12">
                    <div href="#" class="tip mb-2 pinup-summary-img d_custom_pinup_img lg_icon_wrapper">
                        <img
                            src="{{ !empty($user->defaultPinupImage) ? asset($user->defaultPinupImage->path) : asset('assets/app/img/home/home-demo.png') }}">
                        @if ($escort->latestActiveBrb)
                            <p class="pinup_brb_strip">BRB at <span>
                                    {{ date('h:i A d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }} <br>
                                    {{ $escort->latestActiveBrb->brb_note }}</span></p>
                        @endif
                        <span class="memmber_info"><i class="fa fa-user"></i> Member ID: {{ $escort->user->member_id }}</span>
                        @php
                            $pinup_data = get_escort_media_id_by_path($escort->user->defaultPinupImage->path);
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


                    <div class="pin-up-content py-3 px-5">
                        
                           
                            <div class="go-to-index">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/app/img/newcross.png') }}" alt="cross">
                                </a>
                            </div>
                        <div class="pin-head-custom">
                            <div class="pp-head">
                                <span class="svg_icon">
                                    <svg width="70px" height="70px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </svg>
                                </span>
                                <div class="pp-info">
                                    <h1>
                                        {{ $escortName }}
                                        
                                    </h1>
                                    


                                    <div class="v-path">
                                        <div class="pp-other-info">
                                            <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.37892 10.2236L8 16L12.6211 10.2236C13.5137 9.10788 14 7.72154 14 6.29266V6C14 2.68629 11.3137 0 8 0C4.68629 0 2 2.68629 2 6V6.29266C2 7.72154 2.4863 9.10788 3.37892 10.2236ZM8 8C9.10457 8 10 7.10457 10 6C10 4.89543 9.10457 4 8 4C6.89543 4 6 4.89543 6 6C6 7.10457 6.89543 8 8 8Z"
                                                        fill="#ff3c5f"></path>
                                                </g>
                                            </svg>
                                            <span>{{ $escort->city->name }}</span>
                                        </div>
                                        <span class="seperatot"></span>
                                        <ul class="meet-with custom-meet-pin">
                                            <span class="mw">Meet with:</span>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(1, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img
                                                        src="{{ asset('assets/app/img/woman-avatar-big.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Female</span>
                                                </a>
                                            </li>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(2, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img src="{{ asset('assets/app/img/male-user.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Male</span>
                                                </a>
                                            </li>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(3, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img
                                                        src="{{ asset('assets/app/img/transgender-big.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Transgender</span>
                                                </a>
                                            </li>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(4, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img src="{{ asset('assets/app/img/couple.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Couples</span>
                                                </a>
                                            </li>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(5, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img
                                                        src="{{ asset('assets/app/img/icon_disabled.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Disabled</span>
                                                </a>
                                            </li>
                                            <li
                                                class="{{ !empty($escort->available_to) && in_array(6, $escort->available_to) ? '' : 'd-none' }}">
                                                <a href="#"><img src="{{ asset('assets/app/img/icon_groups.png') }}"
                                                        class="" alt="logo">
                                                    <span class="custom-icon-hover-tooltip">Groups/Parties</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pp-av-wrap">
                                           
                                                @php
                                                 $galleryVideos = $escort
                                                    ->gallary()
                                                    ->wherePivot('type', 1)
                                                    ->orderBy('position', 'asc')
                                                    ->get();
                                                @endphp
                                                @if ($galleryVideos->count() > 0)
                                                    <div class="custom-video-wraper pp-video-icon">
                                                        <div class="video--icon">
                                                            <a href="#">
                                                                <img src="/assets/app/img/video_play.svg" class="" alt="logo">
                                                                <small class="video-tooltip">I have Video</small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                         <span class="pinup_age">
                                            <div class="pin-age"> Age: <span>{{ $escort->age }}</span></div>
                                        </span>
                            </div>
                        </div>
                    <hr>
                        @php
                            $about = html_entity_decode(strip_tags($escort->about));
                            $massage_price = $escort->durations()->where('name', '1 Hour')->first()
                                ? $escort->durations()->where('name', '1 Hour')->first()->pivot->massage_price
                                : 0;
                            $incall_price = $escort->durations()->where('name', '1 Hour')->first()
                                ? $escort->durations()->where('name', '1 Hour')->first()->pivot->incall_price
                                : 0;
                            $outcall_price = $escort->durations()->where('name', '1 Hour')->first()
                                ? $escort->durations()->where('name', '1 Hour')->first()->pivot->outcall_price
                                : 0;
                        @endphp
                        <div>
                            <h5 class="mb-0"><strong>About Me</strong></h5>
                            <p class="pin-description text-justify mb-0">{{ $about }}</p>
                        </div>
                        <hr>
                        <div class="pp-av-wrap">
                            <div class="pp-media">
                                <div class="mc_tooltip_wrap">
                                    <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                    <span class="mc_rate_tooltip">You come to me.</span>
                                </div>

                                <div class="media-body">
                                    <h4>Massage</h4>
                                    <p class="mb-0">
                                        {{ $massage_price ? '$' . number_format($massage_price) . '/hr' : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="pp-media">
                                <div class="mc_tooltip_wrap">
                                    <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                    <span class="mc_rate_tooltip">You come to me.</span>
                                </div>
                                <div class="media-body">
                                    <h4>Incalls</h4>
                                    <p class="mb-0">
                                        {{ $incall_price ? '$' . number_format($incall_price) . '/hr' : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="pp-media">
                                <div class="mc_tooltip_wrap">
                                    <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                    <span class="mc_rate_tooltip">I come to you.</span>
                                </div>
                                <div class="media-body">
                                    <h4>Outcalls</h4>
                                    <p class="mb-0">
                                        {{ $outcall_price ? '$' . number_format($outcall_price) . '/hr' : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pp-av-wrap">
                            

                        <div class="pp-av-wrap">
                            <div class="pp-av-wrap">
                                <div class="my-play-box-profile-icon">
                                    <a href="{{ url('playbox') }}" target="_blank">
                                        <img src="{{ asset('assets/app/img/MyPlaybox.png') }}" alt="My Playbox Icon">
                                    </a>
                                    <div class="custom-tooltip">My Playbox</div>
                                </div>
                                @if (isset($escort->mainPurchase) && $escort->mainPurchase->tour_location_id != null)
                                    <div class="my-play-box-profile-icon">
                                        <a href="#">
                                            <img src="{{ asset('assets/app/img/icon_tour_white.png') }}"
                                                alt="My Playbox Icon">
                                        </a>
                                        <div class="custom-tooltip">
                                            {{ $escort->left_listing_days > 0 ? "On Tour, {$escort->left_listing_days} days left." : 'On Tour, today is my last day.' }}
                                        </div>
                                    </div>
                                @endif
                                    
                            @if ($escort->address)
                                <div class="pinup_address">
                                    <p><img src="{{ asset('assets/app/img/gps.png') }}" alt="location"
                                            class="custompopicon"> {{ $escort->address }}</p>
                                </div>
                                @endif
                                
                            </div>
                            
                        </div>
                                <div class="">
                                    <a href="{{ route('profile.description', $escort->id) }}" class="btn-common">View
                                        Profile</a>
                                </div>
                        </div>
                        
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
                    <p class="text-white">Welcome to the preferred website where Private Escorts and erotic Massage Centres
                        advertise their companionship and services to Viewers who are looking for company.</p>
                    <p class="text-white">Advertisers set out a detailed and informative Profile or Tour where they propose
                        their time and companionship, enabling Viewers to make direct contact. A Massage Centre has its own
                        unique Profile designed to bring detailed Profile information about their business premises,
                        Masseurs and their services directly to you.</p>
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
                            <p>In addition to providing advertising services, we also assist with industry information for
                                Advertisers and Viewers,<br> located in the footer, together with our My Playbox and
                                Concierge Services.</p>
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
                        <p class="text-white">It became apparent to us after talking with Advertisers and Viewers that
                            there were a number of concerns about the quality and integrity of the services and offerings
                            websites brought to Private Escorts and Massage Centres.</p>
                        <p class="text-white">Those discussions helped bring about this Website, ensuring also that it
                            complies with the Local Laws. Features such as verified photos, reviews, guides, concierge
                            services, notes and Alerts are designed to make your experience a pleasant one.</p>
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
                                <a href="{{ url('accommodation') }}" class="termsandconditions_text_color"><img
                                        src="{{ asset('assets/app/img/home/live-booking.png') }}"></a>
                                <p>Live booking services for accommodation and travel </p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border my-auto">
                                <a href="{{ url('professional-product') }}" class="termsandconditions_text_color"><img
                                        src="{{ asset('assets/app/img/home/product-delivery.png') }}"></a>
                                <p>Product delivery</p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border">
                                <a href="{{ url('mobile-read-sim') }}" class="termsandconditions_text_color"><img
                                        src="{{ asset('assets/app/img/home/telecommunication.png') }}"></a>
                                <p>Telecommunication services - Mobile SIM & Email account</p>
                            </div>
                        </div>
                    </div>
                    <div class="shop-box">
                        <div class="text-center">
                            <div class="shops_border">
                                <a href="{{ url('visa-migration') }}" class="termsandconditions_text_color"><img
                                        src="{{ asset('assets/app/img/home/visa1.png') }}"></a>
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
                            <p class="  pt-3">There are no fees when your create an Account. Fees only apply when you post
                                a Profile or Tour where you are charged according to the number of days and the Membership
                                Type you select (Book by the day!). See also <a href = "help-for-escorts"
                                    class="termsandconditions_text_color">Help for Escorts</a></p>
                            <p class="">Massage Centres are also looked after with a uniquely designed Profile just
                                for them.  List up to eight Masseurs on the one Profile.</p>
                        </div>
                        </br>
                        <div class="padding">
                            <a class="btn btn_advertiser" style="border: 1px solid;"
                                href="{{ route('advertiser.register') }}" role="button">I am an Advertiser</a>
                            <a class="btn btn_viewer" style="border: 1px solid;" href="{{ route('register') }}"
                                role="button">I am a Viewer</a>
                            <a class="btn  btn_viewer" style="color:red;border: 1px solid;"
                                href="{{ route('agent.register') }}" role="button">I am an Agent</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
