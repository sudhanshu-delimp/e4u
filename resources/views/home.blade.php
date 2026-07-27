@extends('layouts.webHome')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/app/css/homepage.css?v1.01') }}">
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
                                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" class="icon_esc"
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
                            <span>
                                <svg width="25px" height="25px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
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
                    <div class="buttons">


                        <a class="hero-btn btn-light" id="view_btn_advertiser"
                            href="{{ route('public.web.escort.listing') }}" role="button">View Escorts <br><small
                                style="font-size: 70%">(Australia wide)</small></a>
                        <a class="hero-btn btn-dark" href="{{ route('find.massage.centre') }}" role="button">View Massage
                            Centres <br><small style="font-size: 70%">(Australia wide)</small></a>
                        <a class="hero-btn btn-outline" href="{{ route('page.become-pin-up') }}" role="button">Become a
                            Pin-Up</a>
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
    <section class="our-services-sec">

        <div class="container">

            <div class="heading">

                <h2>Everything You Need in One Place</h2>

                <p>
                    In addition to advertising services, we provide trusted information,
                    reviews, concierge services, and support for both Advertisers and
                    Viewers, all designed to deliver a safe and enjoyable experience.
                </p>

            </div>

            <div class="wrapper">

                <div class="left">

                    <h2>Our Services</h2>

                    <div class="why_cards">

                        <div class="why_card">
                            <div class="icon">
                                <svg height="35px" width="35px" version="1.1" id="_x32_"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css">
                                            .st0 {
                                                fill: #ff3c5a;
                                            }
                                        </style>
                                        <g>
                                            <path class="st0"
                                                d="M410.103,82.159c-14.833,13.139-33.056,27.312-50.761,30.906c-32.869,6.681-68.217-8.696-95.368-4.584 c-1.766,0.276-3.47,0.597-5.156,0.883c-4.638-1.196-9.517-2.195-14.672-2.98c-3.72-0.562-7.458-0.794-11.186-0.794 c-10.686,0.026-21.389,1.793-31.976,3.416c-10.597,1.641-21.059,3.175-30.933,3.175c-5.201,0-10.222-0.41-15.038-1.408 c-6.539-1.302-13.648-4.585-20.774-9.178c-7.145-4.559-14.28-10.41-21.042-16.386c-3.104-2.783-6.626-4.906-10.338-6.324 c-3.719-1.409-7.635-2.06-11.462-2.051c-6.083,0-11.943,1.57-17.464,4.014c-4.87,2.168-9.526,5.039-14.039,8.429 c-7.912,5.896-15.422,13.397-22.379,21.782c-10.418,12.594-19.614,27.196-26.34,41.601c-3.362,7.224-6.119,14.396-8.063,21.335 C1.168,180.935,0,187.624,0,194.064c0,3.39,0.32,6.725,1.142,9.972c0.82,3.274,2.149,6.484,4.157,9.383 c0.615,0.892,1.266,1.606,2.123,2.248c0.125,0.107,4.406,3.515,9.053,7.956c2.328,2.238,4.737,4.728,6.743,7.118 c1.989,2.319,3.541,4.638,4.121,5.932c2.63,5.575,9.329,19.169,18.222,34.376c4.459,7.599,9.472,15.6,14.85,23.235 c2.721,3.836,5.54,7.609,8.43,11.177c-7.876,9.757-7.831,24.082,0.784,33.778c9.598,10.846,26.152,11.836,36.981,2.23l0.749-0.67 c-4.664,9.304-3.532,20.899,3.79,29.158c9.589,10.829,26.152,11.827,36.99,2.221l4.255-3.872 c-5.816,9.553-5.04,22.184,2.765,30.996c9.615,10.81,26.17,11.81,37.007,2.239l6.547-5.941c-6.181,9.634-5.52,22.54,2.427,31.513 c9.588,10.829,26.152,11.836,36.989,2.231l10.596-9.098c0.999,0.481,1.972,0.918,2.873,1.337l7.243,4.228l-0.063-0.053 c3.622,2.158,7.368,3.906,11.266,5.128c3.889,1.222,7.93,1.936,12.042,1.936c4.451,0,8.991-0.856,13.254-2.748 c4.246-1.872,8.153-4.78,11.4-8.455c3.88-4.372,6.458-9.5,7.769-14.842c3.862,1.4,7.912,2.104,11.925,2.104 c4.826,0,9.652-0.999,14.155-2.978c4.496-1.98,8.662-4.95,12.113-8.848c4.282-4.816,6.984-10.552,8.152-16.493 c2.302,0.464,4.621,0.722,6.94,0.722c4.852,0,9.677-0.981,14.172-2.978c4.505-1.972,8.67-4.95,12.122-8.84 c4.691-5.28,7.466-11.658,8.411-18.187c1.017,0.089,2.024,0.125,3.014,0.125c5.798,0,11.489-1.25,16.769-3.479 c5.244-2.248,10.141-5.512,14.075-9.928c3.657-4.148,6.422-8.982,8.402-14.191c1.971-5.227,3.122-10.802,3.14-16.519 c0-2.087-0.179-4.192-0.535-6.279c20.184-22.46,30.87-59.868,35.5-69.68c5.334-11.346,25.483-27.455,25.483-27.455 C530.071,172.514,449.545,47.204,410.103,82.159z M425.15,316.405c-1.142,3.05-2.819,5.851-4.468,7.688 c-1.508,1.722-3.863,3.39-6.61,4.567c-2.738,1.16-5.833,1.793-8.563,1.793c-1.792,0-3.443-0.277-4.781-0.722 c-0.08-0.036-0.161-0.062-0.223-0.09l-29.898-28.846c-4.175-4.013-10.802-3.888-14.816,0.268 c-4.022,4.166-3.906,10.802,0.258,14.816l24.11,23.272c0.098,0.231,0.16,0.455,0.276,0.687c0.99,1.971,1.508,4.183,1.508,6.377 c0,3.371-1.142,6.636-3.56,9.348c-1.4,1.606-3.059,2.766-4.87,3.568c-1.793,0.802-3.755,1.213-5.726,1.213 c-3.354-0.018-6.618-1.16-9.348-3.568l-0.606-0.553c-0.134-0.125-0.205-0.268-0.33-0.41l-26.206-27.348 c-4.004-4.191-10.641-4.335-14.798-0.339c-4.183,3.996-4.335,10.65-0.348,14.825l22.236,23.209c0.045,0.08,0.08,0.178,0.125,0.249 c1.365,2.23,2.052,4.799,2.052,7.376c-0.009,3.381-1.151,6.655-3.56,9.375h0.009c-1.418,1.587-3.077,2.747-4.87,3.568 c-1.801,0.785-3.764,1.177-5.718,1.177c-3.371,0-6.662-1.142-9.383-3.54l-0.401-0.33l-8.1-6.512l-13.281-14.092 c-3.969-4.202-10.614-4.398-14.815-0.428c-4.211,3.96-4.407,10.614-0.438,14.816l12.604,13.37c1.293,2.195,1.989,4.674,1.989,7.189 c-0.027,3.354-1.16,6.636-3.55,9.33c-1.445,1.632-2.81,2.578-4.228,3.212c-1.418,0.616-2.926,0.945-4.745,0.954 c-1.686,0-3.604-0.295-5.744-0.973c-2.141-0.678-4.451-1.73-6.842-3.139l-0.062-0.054l-3.71-2.141 c10.248-9.669,11.05-25.786,1.64-36.41c-9.473-10.668-25.724-11.756-36.543-2.568l1.953-1.766 c10.846-9.588,11.836-26.152,2.23-36.98c-9.58-10.829-26.152-11.827-36.98-2.23l-6.423,5.789 c6.208-9.606,5.548-22.539-2.408-31.513c-9.607-10.828-26.152-11.836-36.99-2.23l-8.526,7.76 c3.996-9.062,2.675-20.042-4.344-27.945c-9.598-10.837-26.161-11.827-36.981-2.239l-18.043,16.002 c-2.275-2.846-4.55-5.888-6.779-9.045c-7.385-10.489-14.325-22.192-19.828-32.217c-5.495-10.026-9.607-18.41-11.4-22.236 c-0.946-2.007-2.069-3.844-3.283-5.61c-2.123-3.051-4.558-5.923-7.038-8.563c-3.692-3.988-7.545-7.502-10.489-10.062 c-1.409-1.231-2.605-2.257-3.496-2.979c-0.187-0.42-0.365-0.927-0.526-1.57c-0.303-1.23-0.518-2.88-0.518-4.887 c0-3.318,0.58-7.528,1.766-12.274c2.078-8.277,6.029-18.062,11.221-27.811c7.786-14.681,18.428-29.398,29.274-39.96 c5.423-5.307,10.864-9.544,15.806-12.3c2.461-1.364,4.79-2.381,6.867-3.006c2.078-0.642,3.925-0.927,5.512-0.927 c1.525,0.009,2.81,0.24,4.067,0.695c1.231,0.5,2.48,1.196,3.836,2.399c7.18,6.378,15.056,12.862,23.628,18.357 c8.544,5.468,17.803,10.017,27.908,12.086c6.485,1.32,12.907,1.801,19.214,1.801c11.96-0.009,23.476-1.765,34.135-3.407 c2.684-0.428,5.306-0.821,7.876-1.213c-8.001,5.512-15.744,12.05-23.976,19.73c-23.494,21.915-43.751,48.683-54.989,60.849 c-11.23,12.149,9.66,33.235,42.912,23.566c33.234-9.651,47.559-34.448,47.559-34.448l41.735-14.976l41.422,9.482l100.122,90.141 l17.304,16.733l0.339,0.286c0.695,0.642,1.23,1.391,1.694,2.604c0.446,1.213,0.75,2.854,0.75,4.817 C426.943,310.045,426.319,313.354,425.15,316.405z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3>Friendly Service</h3>
                            <p>Accessible support for both Advertisers and Viewers whenever you need assistance.</p>
                        </div>

                        <div class="why_card">
                            <div class="icon">
                                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <circle cx="12" cy="10" r="3" stroke="#ff3c5f" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></circle>
                                        <path
                                            d="M19 9.75C19 15.375 12 21 12 21C12 21 5 15.375 5 9.75C5 6.02208 8.13401 3 12 3C15.866 3 19 6.02208 19 9.75Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <h3>Accurate Information</h3>
                            <p>Reliable and up-to-date information about available services.</p>
                        </div>

                        <div class="why_card">
                            <div class="icon">
                                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M16 10H16.01M12 10H12.01M8 10H8.01M7 16V21L12 16H20V4H4V16H7Z"
                                            stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <h3>Dedicated Support</h3>
                            <p>Professional support services to ensure the best experience.</p>
                        </div>

                        <div class="why_card">
                            <div class="icon">
                                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.1507 2.3649C10.8306 0.713558 13.1694 0.713567 13.8494 2.3649L16.1856 8.0386L21.4255 8.34683C23.2632 8.45493 23.9912 10.7786 22.5437 11.916L18.1816 15.3433L19.9202 20.2694C20.5648 22.0955 18.497 23.6802 16.9012 22.5831L12 19.2135L7.09881 22.5831C5.50303 23.6802 3.43525 22.0955 4.07977 20.2694L5.81838 15.3433L1.45635 11.916C0.0087955 10.7787 0.736801 8.45493 2.57454 8.34683L7.81442 8.0386L10.1507 2.3649ZM12 3.1264L9.18559 9.9614L2.69199 10.3434L8.18164 14.6567L5.96575 20.935L12 16.7865L18.0343 20.935L15.8184 14.6567L21.308 10.3434L14.8144 9.9614L12 3.1264Z"
                                            fill="#ff3c5f"></path>
                                    </g>
                                </svg>
                            </div>
                            <h3>Trusted Reviews</h3>
                            <p>Read and share genuine reviews based on real experiences.</p>
                        </div>

                        <div class="why_card">
                            <div class="icon">
                                <svg width="35px" height="35px" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="none"> <path d="M93.46 39.45c6.71-1.49 15.45-8.15 16.78-11.43c.78-1.92-3.11-4.92-4.15-6.13c-2.38-2.76-1.42-4.12-.5-7.41c1.05-3.74-1.44-7.87-4.97-9.49s-7.75-1.11-11.3.47c-3.55 1.58-6.58 4.12-9.55 6.62c-2.17-1.37-5.63-7.42-11.23-3.49c-3.87 2.71-4.22 8.61-3.72 13.32c1.17 10.87 3.85 16.51 8.9 18.03c6.38 1.92 13.44.91 19.74-.49z" fill="#ff3c5f"> </path> <path d="M104.36 8.18c-.85 14.65-15.14 24.37-21.92 28.65l4.4 3.78s2.79.06 6.61-1.16c6.55-2.08 16.12-7.96 16.78-11.43c.97-5.05-4.21-3.95-5.38-7.94c-.61-2.11 2.97-6.1-.49-11.9zm-24.58 3.91s-2.55-2.61-4.44-3.8c-.94 1.77-1.61 3.69-1.94 5.67c-.59 3.48 0 8.42 1.39 12.1c.22.57 1.04.48 1.13-.12c1.2-7.91 3.86-13.85 3.86-13.85z" fill="#ff3c5f"> </path> <path d="M61.96 38.16S30.77 41.53 16.7 68.61c-14.07 27.08-2.11 43.5 10.55 49.48c12.66 5.98 44.56 8.09 65.31 3.17s25.94-15.12 24.97-24.97c-1.41-14.38-14.77-23.22-14.77-23.22s.53-17.76-13.25-29.29c-12.23-10.24-27.55-5.62-27.55-5.62z" fill="#ff3c5f"> </path> <path d="M74.76 83.73c-6.69-8.44-14.59-9.57-17.12-12.6c-1.38-1.65-2.19-3.32-1.88-5.39c.33-2.2 2.88-3.72 4.86-4.09c2.31-.44 7.82-.21 12.45 4.2c1.1 1.04.7 2.66.67 4.11c-.08 3.11 4.37 6.13 7.97 3.53c3.61-2.61.84-8.42-1.49-11.24c-1.76-2.13-8.14-6.82-16.07-7.56c-2.23-.21-11.2-1.54-16.38 8.31c-1.49 2.83-2.04 9.67 5.76 15.45c1.63 1.21 10.09 5.51 12.44 8.3c4.07 4.83 1.28 9.08-1.9 9.64c-8.67 1.52-13.58-3.17-14.49-5.74c-.65-1.83.03-3.81-.81-5.53c-.86-1.77-2.62-2.47-4.48-1.88c-6.1 1.94-4.16 8.61-1.46 12.28c2.89 3.93 6.44 6.3 10.43 7.6c14.89 4.85 22.05-2.81 23.3-8.42c.92-4.11.82-7.67-1.8-10.97z" fill="#ffd1e3"> </path> <path d="M71.16 48.99c-12.67 27.06-14.85 61.23-14.85 61.23" stroke="#ffd1e3" stroke-width="5" stroke-miterlimit="10"> </path> <path d="M81.67 31.96c8.44 2.75 10.31 10.38 9.7 12.46c-.73 2.44-10.08-7.06-23.98-6.49c-4.86.2-3.45-2.78-1.2-4.5c2.97-2.27 7.96-3.91 15.48-1.47z" fill="#ffd1e3"> </path> <path d="M81.67 31.96c8.44 2.75 10.31 10.38 9.7 12.46c-.73 2.44-10.08-7.06-23.98-6.49c-4.86.2-3.45-2.78-1.2-4.5c2.97-2.27 7.96-3.91 15.48-1.47z" fill="#ffd1e3"> </path> <path d="M96.49 58.86c1.06-.73 4.62.53 5.62 7.5c.49 3.41.64 6.71.64 6.71s-4.2-3.77-5.59-6.42c-1.75-3.35-2.43-6.59-.67-7.79z" fill="#ff3c5f"> </path> </g> </g></svg>
                            </div>
                            <h3>Affordable Advertising</h3>
                            <p>Cost-effective advertising solutions with maximum visibility.</p>
                        </div>

                        <div class="why_card">
                            <div class="icon">
                                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                            stroke="#ff3c5f" stroke-width="1.5"></path>
                                        <path d="M12 14V18" stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round">
                                        </path>
                                        <path d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10"
                                            stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <h3>Privacy Protection</h3>
                            <p>Your privacy and security remain our highest priority.</p>
                        </div>

                    </div>

                </div>

                <div class="right">

                    <h2>Why Choose Us?</h2>

                    <ul class="why-features">

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Verified Photos</li>

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Trusted Reviews</li>

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Industry Information</li>

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Concierge Services</li>

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Privacy First</li>

                        <li> <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="style=stroke">
                                        <g id="check">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Loyalty Program</li>

                    </ul>

                    <p>
                        Our platform was built after listening to Advertisers and Viewers.
                        We focus on trust, compliance, quality, and user experience to create
                        a safer and more enjoyable platform for everyone.
                    </p>

                    <a href="{{ url('escorts4U') }}" class="home-btn btn-why">Learn More</a>

                </div>

            </div>

        </div>

    </section>
    {{-- <div class="container custom--contain">
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
</div> --}}

    <section class="one-stop-bg">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="home_services">

                        <h2>E4U: <span>Your One-Stop Shop!</span></h2>

                        <p>Everything you need for Travel, Education & Digital Services.</p>

                        <div class="home_card-wrapper">

                            <a href="{{ url('accommodation') }}" class="home_card">
                                <div class="home_icon">
                                    <i class="fa-solid fa-hotel"></i>
                                </div>
                                <h3>Hotel Booking</h3>
                                <p>Book hotels and travel packages easily with the best prices.</p>
                            </a>

                            <a href="{{ url('professional-product') }}" class="home_card">
                                <div class="home_icon">
                                    <i class="fa-solid fa-box"></i>
                                </div>
                                <h3>Product Delivery</h3>
                                <p>Fast and secure delivery service for all your products.</p>
                            </a>

                            <a href="{{ url('mobile-read-sim') }}" class="home_card">
                                <div class="home_icon">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                </div>
                                <h3>Telecom</h3>
                                <p>Mobile SIM, Email Accounts and digital communication services.</p>
                            </a>

                            <a href="{{ url('visa-migration') }}" class="home_card">
                                <div class="home_icon">
                                    <i class="fa-solid fa-passport"></i>
                                </div>
                                <h3>Visa Support</h3>
                                <p>Professional visa guidance and education consultancy.</p>
                            </a>

                            <a href="javascript:void(0)" class="home_card">
                                <div class="home_icon">
                                    <i class="fa-solid fa-rocket"></i>
                                </div>
                                <h3>More Features</h3>
                                <p>Explore many premium services designed for Advertisers.</p>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="home_reg_bg">
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
                href="{{ url('help-for-escorts') }}" class="termsandconditions_text_color">Help for
                Escorts</a>.
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
</section> --}}

    <section class="register-section">

        <div class="containers">

            <div class="image-box">

                <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/app/img/shutterstock_338759729.png"
                    alt="Register">

                <div class="badge">
                    ⭐ Dedicated Profile
                </div>

            </div>

            <div class="reg-content">

                <small>JOIN OUR COMMUNITY</small>

                <h2>Register Now</h2>

                <p>
                    Create your account in just a few minutes. Registration is completely free.
                    You only pay when you decide to advertise your Profile or Tour according to
                    your selected membership plan.
                </p>

                <p>
                    Massage Centres can create a dedicated Profile and manage multiple Masseurs
                    from a single account, making profile management simple and efficient.
                </p>

                <div class="features">

                    <div class="feature">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=stroke">
                                    <g id="check">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                            fill="#0c223d"></path>
                                    </g>
                                </g>
                            </g>
                        </svg> Free Registration
                    </div>

                    <div class="feature">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=stroke">
                                    <g id="check">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                            fill="#0c223d"></path>
                                    </g>
                                </g>
                            </g>
                        </svg> Flexible Membership
                    </div>

                    <div class="feature">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=stroke">
                                    <g id="check">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                            fill="#0c223d"></path>
                                    </g>
                                </g>
                            </g>
                        </svg> Secure & Private
                    </div>

                    <div class="feature">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=stroke">
                                    <g id="check">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5303 7.21967C19.8232 7.51256 19.8232 7.98744 19.5303 8.28033L11.6112 16.1994C10.5373 17.2734 8.79607 17.2734 7.72212 16.1995L4.46967 12.947C4.17678 12.6541 4.17678 12.1792 4.46967 11.8863C4.76256 11.5934 5.23744 11.5934 5.53033 11.8863L8.78278 15.1388C9.27094 15.6269 10.0624 15.6269 10.5505 15.1388L18.4697 7.21967C18.7626 6.92678 19.2374 6.92678 19.5303 7.21967Z"
                                            fill="#0c223d"></path>
                                    </g>
                                </g>
                            </g>
                        </svg> Trusted Community
                    </div>

                </div>

                <div class="buttons">

                    <a href="{{ route('advertiser.register') }}" class="home-btn btn-light">
                        I'm an Advertiser
                    </a>

                    <a href="{{ route('register') }}" class="home-btn btn-dark">
                        I'm a Viewer
                    </a>

                    <a href="{{ route('agent.register') }}" class="home-btn btn-outline">
                        I'm an Agent
                    </a>

                </div>

            </div>

        </div>

    </section>
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
