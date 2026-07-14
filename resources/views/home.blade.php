@extends('layouts.webHome')
@section('content')
    <style>
        #parsley-id-5 li {
            margin-left: 0 !important;
        }

        .d_custom_home_img {
            position: relative;
        }

        .d_custom_home_img .memmber_info {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #fff;
            background: #ff3c5a;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .d_custom_home_img .memmber_info i {
            color: #fff;
            font-size: 14px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly homebanner_bg">
        <div class="container-fluid banner_width">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 js_pinup_profile">
                    <div href="#" class="tip mb-2 d_custom_home_img">

                        @if (config('constants.app_env') != 'local')
                            <img style="" class="img-fluid" src="{{ asset('assets/app/img/home/home-demo.png') }}">
                        @else
                            <img style="" class="img-fluid"
                                src="{{ asset('assets/app/img/local_img/home-demo.png') }}">
                        @endif
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 home-right-half">
                    <span class="home-sec-heading">
                        <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 260 240"
                            enable-background="new 0 0 260 240" xml:space="preserve" stroke="#ff3c5f">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M257.229,117.41l-4.888-11.82L239.54,90.716l-5.631-17.505l-13.546-8.606l-5.605-31.236l-8.844-3.081l-7.49-28.262 l-8.234,12.616l-7.437,35.434l-5.844,1.567l-31.05-20.904l3.107-11.794l7.65-7.012L134.037,7.02l-22.949,5.631l-10.97,18.141 l-16.362-7.039L66.6,33.976l-1.263,10.743l-9.338,2.914l-9.084,21.462L2.663,91.034L2,110.478l6.959,9.376l-3.533,5.525 l16.379,33.043l-1.195,19.124l12.36,4.223l18.859-10.518l21.01-1.966l3.054-6.135l12.06-7.224l30.227-6.694l16.229,5.313 l8.181,11.846l19.31,6.136l6.853,18.3l21.063,13.494l8.818-6.269l10.305,6.428l18.621-6.162l15.405-31.714l4.675-2.365L258,139.987 L257.229,117.41z M199.777,237.973l11.98-1.939l3.48-13.52l-18.912-3.931L199.777,237.973z">
                                </path>
                            </g>
                        </svg>
                        australia's sexiest and most accessible escorts</span>
                    <h1 class="home_heading_first">ESCORTS4U DIRECTORY OF:</h1>
                    <div class="pvt_and_msg">
                        <h2 class="home-head-icon">
                            <span>
                                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7Z"
                                            stroke="#ff3c5f" stroke-width="2"></path>
                                        <path
                                            d="M5 19.5C5 15.9101 7.91015 13 11.5 13H12.5C16.0899 13 19 15.9101 19 19.5V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V19.5Z"
                                            stroke="#ff3c5f" stroke-width="2"></path>
                                    </g>
                                </svg>
                            </span>
                            Private Escorts
                        </h2>
                        <h2 class="home-head-icon">
                            <span><svg width="25px" height="25px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                    xmlns="http://www.w3.org/2000/svg" fill="#ff3c5f" stroke="#ff3c5f">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                    stroke: #ff3c5f;
                                                    stroke-miterlimit: 10;
                                                    stroke-width: 1.91px;
                                                }
                                            </style>
                                        </defs>
                                        <path class="cls-1"
                                            d="M16.41,12.13a3.32,3.32,0,0,0-.9-.13H4.67A3.17,3.17,0,0,0,1.5,15.17v.34a3.17,3.17,0,0,0,3.17,3.17h6.38">
                                        </path>
                                        <rect class="cls-1" x="3.41" y="6.27" width="13.36" height="5.73" rx="2.86">
                                        </rect>
                                        <rect class="cls-1" x="5.32" y="1.5" width="9.55" height="4.77" rx="2.39">
                                        </rect>
                                        <path class="cls-1"
                                            d="M20.59,16.77H22.5a0,0,0,0,1,0,0v1.91a3.82,3.82,0,0,1-3.82,3.82H16.77a0,0,0,0,1,0,0V20.59A3.82,3.82,0,0,1,20.59,16.77Z">
                                        </path>
                                        <path class="cls-1"
                                            d="M19,17.13a3.81,3.81,0,0,0-.89-4l-1.35-1.35-.36.36-1,1a3.79,3.79,0,0,0-.89,4">
                                        </path>
                                        <path class="cls-1"
                                            d="M14.86,16.77h1.91a0,0,0,0,1,0,0v1.91A3.82,3.82,0,0,1,13,22.5H11a0,0,0,0,1,0,0V20.59A3.82,3.82,0,0,1,14.86,16.77Z"
                                            transform="translate(-5.73 33.55) rotate(-90)"></path>
                                    </g>
                                </svg>
                            </span>
                            Massage Centres
                        </h2>
                    </div>
                    <p>The easiest platform to view Escorts and Massage Centres from, without all the
                        fuss. Escorts4U prides itself on integrity, honesty and value. The only platform where you pay by
                        the day!
                    </p>
                    @php
                        $states = config('escorts.profile.states');
                        $url = route('find.all');
                        if (auth()->check()) {
                            $stateId = auth()->user()->current_state_id ?? null;
                            $cities = $states[$stateId]['cities'] ?? [];

                            if ($cities) {
                                $url .= (request()->getQueryString() ? '&' : '?') . 'city=' . array_key_first($cities);
                            }
                        }

                    @endphp
                    <div class="home-btn">
                        <a class="btn btn_advertiser" id="view_btn_advertiser" href="{{ $url }}"
                            role="button">View Escorts <br><small style="font-size: 70%">(Australia wide)</small></a>
                        <a class="btn btn_center" href="{{ route('find.massage.centre') }}" role="button">View Massage
                            Centres <br><small style="font-size: 70%">(Australia wide)</small></a>
                        <a class="btn  btn_become_pin_up" href="become-a-pin-up" role="button">Become a Pin-Up</a>
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
                    <p class="text-white">Advertisers set out a detailed and informative Profile, where they propose their
                        time and companionship, enabling Viewers to make direct contact. The only platform where a Massage
                        Centre has its own unique Profile designed to bring detailed Profile information about their
                        business premises, Masseurs and their services directly to you.</p>
                </div>
                <div class="welcome_msg_peratwo">
                    <h5 class="text-white font-weight-bold fs-3">




                        Escort Platinum listing pay only
                        {{ isset($pricing[0]['price']) ? '$' . $pricing[0]['price'] : 'NA' }}
                        per day and Massage Centre pay only
                        {{ isset($pricing[4]['price']) ? '$' . $pricing[4]['price'] : 'NA' }} per day.
                    </h5>
                </div>
                <br>
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
                                Advertisers and Viewers,<br> located in the footer, together with our Concierge Services and
                                My Playbox.</p>
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
                            <p>A cost effective service for Advertisers (pay by the day)</p>
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
                            there
                            were a number of concerns about the quality and integrity of the services and offerings websites
                            brought to Private Escorts and Massage Centres.</p>
                        <p class="text-white">Those discussions helped bring about this Website, ensuring also that it
                            complies with the Local Laws. Features such as verified photos, reviews, guides, concierge
                            services, notes and Alerts are designed to make your experience a pleasant and easy one.</p>
                        <p class="text-white"> We also offer a generous loyalty program to Advertisers.</p>
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
                            <p class="  pt-3">There are no fees when your create an Account. Fees only apply when you List
                                a Profile or create a Tour where you are charged according to the number of days and the
                                Membership Type you select (Book and pay by the day!). See also <a
                                    href = "help-for-escorts" class="termsandconditions_text_color">Help for Escorts</a>.
                            </p>
                            <p class="">Massage Centres are also looked after with a uniquely designed Profile just
                                for them.  A world first, set out your business information and list up to eight Masseurs
                                all on the one Profile.</p>
                        </div>

                        </br>
                        <div class="home-btn">
                            <a class="btn home-btn-common" href="{{ route('advertiser.register') }}" role="button">I am
                                an Advertiser</a>
                            <a class="btn home-btn-common" href="{{ route('register') }}" role="button">I am a
                                Viewer</a>
                            <a class="btn home-btn-common" href="{{ route('agent.register') }}" role="button">I am an
                                Agent</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script></script>

    </div>
    <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#onloadpopup">
                        Open modal
                        </button> -->
@endsection
@section('enable_navigator')
@endsection
@push('scripts')
    <script>
        let getPinupProfile = function(latitude, longitude) {
            $.ajax({
                url: `{{ route('web.get_pinup_profile') }}`,
                method: `POST`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                data: {
                    latitude,
                    longitude,
                    view: 'pinup_home'
                },
                dataType: `JSON`,
                beforeSend: function() {
                    //$("#preloader").addClass('pre-active');
                },
                success: function(response) {
                    if (response.success) {
                        sessionStorage.setItem('pinup_id', response.pinupDetail.id);
                        $(".js_pinup_profile").html(response.html);
                    }
                    $("#preloader").removeClass('pre-active');
                },
                error: function(xhr) {
                    $("#preloader").removeClass('pre-active');
                }
            });
        }
    </script>
@endpush
