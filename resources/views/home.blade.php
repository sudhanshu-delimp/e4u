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
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                    <span class="home-sec-heading">
                        <svg fill="#ff3c5f" width="34px" height="34px" viewBox="0 0 512 512" version="1.1"
                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="_x31_002_x2C__australian_x2C__country_x2C__location_x2C__map_x2C__travel">
                                    <path
                                        d="M426.148,224.14c-1.704-2.771-3.03-4.926-3.774-6.158c-0.689-1.142-1.28-2.14-1.801-3.02 c-1.788-3.02-2.545-4.273-3.346-4.99c-0.852-0.763-2.519-1.541-5.544-2.953c-2.088-0.974-4.947-2.309-8.7-4.188 c-1.973-0.989-3.521-1.71-4.764-2.291c-5.761-2.688-6.989-3.73-8.136-9.66c-0.235-1.213-0.526-2.723-1.029-4.753 c-1.261-5.08-2.06-9.918-2.832-14.597c-1.961-11.864-3.437-19.262-8.835-21.762c-6.588-3.05-10.845-9.896-10.845-17.438v-22.028 c-0.632,0.005-1.337,0.028-2.12,0.052c-0.944,0.029-1.982,0.063-3.14,0.077c-0.775,1.672-1.562,5.484-2.059,7.893 c-0.319,1.548-0.649,3.148-1.016,4.618c-0.886,3.555-1.604,7.153-2.297,10.633c-2.021,10.134-3.93,19.707-9.659,28.065 c-3.555,5.183-9.479,8.278-15.853,8.278c-2.97,0-5.952-0.692-8.622-2.002l-27.644-13.56c-9.464-4.642-13.493-15.81-9.173-25.426 c5.582-12.423,5.006-16.457,4.165-17.756c-1.043-1.613-4.99-2.43-11.729-2.43c-4.323,0-9.487,0.308-15.466,0.665 c-7.732,0.461-16.449,0.982-26.296,1.028c-1.304,2.228-3.025,8.111-3.901,11.106c-0.478,1.633-0.929,3.176-1.352,4.456 c-0.374,1.118-0.818,2.617-1.288,4.206c-2.925,9.893-5.451,18.436-11.644,18.436c-12.708,0-20.676-4.376-26.494-7.572 c-3.071-1.687-5.496-3.019-7.354-3.019c-3.549,0-8.913,6.028-16.398,18.431c-1.073,1.758-1.993,3.299-2.931,4.869 c-0.741,1.239-1.491,2.496-2.329,3.88c-7.001,11.61-13.899,23.066-21.271,35.496l-0.11,0.185 c-5.116,8.558-5.937,9.584-13.655,12.148c-1.321,0.439-2.817,0.936-4.696,1.614c-3.667,1.32-7.483,2.464-11.173,3.572 c-3.527,1.058-7.175,2.152-10.762,3.416c-1.836,0.62-3.583,1.201-5.296,1.771c-17.764,5.913-31.794,10.583-35.817,20.29 c-3.153,7.607-0.625,19.425,7.727,36.129c0.814,1.623,2.305,4.545,4.21,8.277c26.036,51,27.983,56.484,27.983,59.031 c0,7.471-0.352,13.33-0.634,18.035c-0.295,4.91-0.629,10.475,0.231,11.387c1.266,1.346,9.661,1.346,17.779,1.346h1.569 c2.136-1.26,7.536-7.135,11.165-11.082c9.403-10.229,13.339-14.094,17.406-14.094c7.651,0,13.654,0.354,18.479,0.639 c2.978,0.176,5.55,0.326,7.548,0.326c3.489,0,4.185-0.49,4.315-0.643c0.349-0.402,0.971-1.83,1.206-6.859 c0.489-10.438,9.023-18.613,19.429-18.613h58.075c4.158,0,7.137,3.318,10.292,6.83c2.587,2.879,5.519,6.143,9.158,7.947 c3.068,1.533,6.048,2.988,8.997,4.426c1.432,0.699,2.855,1.393,4.276,2.092l0.526,0.266c2.146,1.086,4.293,2.172,6.462,3.281 c5.847,3.049,6.174,8.5,6.368,11.758c0.211,3.523,0.22,3.66,4.755,3.66c1.577,0,3.484-0.146,5.67-0.434 c0.716-0.096,1.445-0.146,2.157-0.146c7.189,0,16.631,4.771,20.79,27.492c0.88,4.807,5.066,8.295,9.955,8.295l5.765-0.002 c3.071,0,6.145,0.002,9.217,0.012c1.192,0.006,2.288,0.053,3.348,0.1c0.922,0.039,1.807,0.08,2.649,0.08 c2.293,0,3.023-0.336,3.472-0.699c3.684-3.002,5.156-5.004,6.232-6.467c3.151-4.283,5.381-5.15,13.249-5.15 c0.571,0,1.183,0.004,1.841,0.01c0.818,0.008,1.996,0.039,3.338,0.074c2.071,0.055,4.418,0.117,6.526,0.117 c2.604,0,3.636-0.102,3.986-0.15c1.845-0.945,5.665-7.104,7.515-10.084c0.869-1.398,1.688-2.721,2.469-3.891 c1.613-2.422,3.184-4.762,4.709-7.037c22.345-33.32,34.688-51.727,34.77-97.84C452.311,266.665,432.67,234.74,426.148,224.14z"
                                        id="XMLID_517_"></path>
                                </g>
                                <g id="Layer_1"></g>
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
                        <div class="padding">
                            <a class="btn btn_advertiser" style="border: 1px solid;"
                                href="{{ route('advertiser.register') }}" role="button">I am an Advertiser</a>
                            <a class="btn btn_viewer" style="border: 1px solid;" href="{{ route('register') }}"
                                role="button">I am a Viewer</a>
                            <a class="btn  btn_viewer" style="color:var(--peach);border: 1px solid var(--peach);"
                                href="{{ route('agent.register') }}" role="button">I am an Agent</a>
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
