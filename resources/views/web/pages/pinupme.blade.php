@extends('layouts.webHome')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/app/css/homepage.css?v1.04') }}">

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
                                    <svg width="70px" height="70px" viewBox="0 0 24 24" fill="none" class="svg_icon"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"
                                                fill="#ff3c5f"></path>
                                        </g>
                                    </svg>
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
                                    
                            {{-- @if ($escort->address)
                                <div class="pinup_address">
                                   <a href="{{ $escort->address }}">
                                     <p><img src="{{ asset('assets/app/img/gps.png') }}" alt="location"
                                            class="custompopicon"> {{ $escort->address }}</p>
                                   </a>
                                </div>
                                @endif --}}
                                @if ($escort->address)
                                    <div class="pinup_address">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($escort->address) }}"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                                <span class="pin-location-pinup">
                                                    <img src="{{ asset('assets/app/img/gps.png') }}" alt="location" class="custompopicon">
                                                    <div class="custom-tooltip">Open Maps</div>
                                                </span>
                                                {{ $escort->address }}
                                                
                                        </a>
                                    </div>
                                @endif                               
                            </div>
                            
                        </div>
                                <div class="my-2">
                                    <a href="{{ route('profile.description', $escort->id) }}" class="btn-common">View
                                        Profile</a>
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </section>



    {{-- <section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly angle_bg_image">
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
    </section> --}}
    
    <section class="welcome-modern angle_bg_image">
        
        <div class="container">

            <span class="welcome-tag">
                Australia's Trusted Platform
            </span>

            <h2>
                Welcome to Escorts4U
            </h2>

            <h5>
                IT IS ALL ABOUT THE COMPANIONSHIP
            </h5>

            <p class="intro">

                Welcome to the preferred website where Private Escorts and Massage Centres advertise their companionship and services to Viewers looking for company.

            </p>

            <div class="wel_features">

                <div class="wel_feature_item">
                    <span class="wel_feature_icon">
                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 166.964 166.964" xml:space="preserve" stroke="#ff3c5f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon points="75.1,159.95 75.115,159.938 75.088,159.938 "></polygon> <path d="M71.791,96.415h-0.179l-6.848-7.849c3.31,1.188,6.759,1.906,10.336,1.906c3.581,0,7.024-0.706,10.328-1.9l-6.848,7.843 h-0.167l16.779,40.578l15.332-20.361l17.001,12.787l10.669-16.027c-10.078-12.787-25.952-24.198-44.658-28.938 c13.518-9.097,22.834-27.033,22.834-43.181C116.369,18.478,97.883,0,75.1,0S33.837,18.478,33.837,41.272 c0,16.148,9.307,34.084,22.828,43.181c-32.324,8.199-56.282,36.258-56.282,57.059c0,12.288,37.351,18.426,74.705,18.413 l-20.919-20.91L71.791,96.415z"></path> <path d="M75.115,159.938c10.924-0.013,21.848-0.523,31.828-1.583l-17.269-12.982L75.115,159.938z"></path> <polygon points="152.605,108.63 129.826,142.845 112.381,129.724 102.279,143.138 133.967,166.964 166.58,117.94 "></polygon> </g> </g> </g></svg>
                    </span>
                    <span>Verified Profiles</span>
                </div>

                <div class="wel_feature_item">
                    <span class="wel_feature_icon">
                        <svg width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.25 10.0546V8C5.25 4.27208 8.27208 1.25 12 1.25C15.7279 1.25 18.75 4.27208 18.75 8V10.0546C19.8648 10.1379 20.5907 10.348 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.40931 10.348 4.13525 10.1379 5.25 10.0546ZM6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.8995 2.75 17.25 5.10051 17.25 8V10.0036C16.867 10 16.4515 10 16 10H8C7.54849 10 7.13301 10 6.75 10.0036V8ZM8 17C8.55228 17 9 16.5523 9 16C9 15.4477 8.55228 15 8 15C7.44772 15 7 15.4477 7 16C7 16.5523 7.44772 17 8 17ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17ZM17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z" fill="#ff3c5f"></path> </g></svg>
                    </span>
                    <span>Private Contact</span>
                </div>

                <div class="wel_feature_item">
                    <span class="wel_feature_icon">
                        <svg width="34px" height="34px" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2501 3C21.4925 3 21.7176 3.11688 21.8574 3.30983L21.9119 3.39706L25.9186 10.9098L25.9615 11.0122L25.9731 11.05L25.9901 11.1273L25.9994 11.2153L25.9973 11.3147L26.0001 11.25C26.0001 11.3551 25.9785 11.4552 25.9394 11.5461L25.9106 11.6057L25.87 11.6723L25.8173 11.7408L14.6 24.7047C14.4999 24.8391 14.3628 24.9277 14.2139 24.9703L14.1559 24.9844L14.0585 24.9979L13.9999 25L13.8993 24.9932L13.8142 24.9771L13.7109 24.9432L13.6852 24.931C13.5949 24.8911 13.5119 24.8316 13.4425 24.7535L2.17081 11.7263L2.1087 11.6387L2.06079 11.5456L2.02611 11.4463L2.00297 11.3152L2.00269 11.1878L2.01755 11.0891L2.02714 11.0499L2.06104 10.9538L2.08838 10.8971L6.08838 3.39706C6.20243 3.18321 6.41149 3.0396 6.64753 3.00704L6.75014 3H21.2501ZM17.9061 12H10.0911L14.0011 22.16L17.9061 12ZM8.48514 12H4.38914L11.7621 20.518L8.48514 12ZM23.6081 12H19.5151L16.2421 20.511L23.6081 12ZM10.0241 4.499H7.19914L3.99814 10.5H8.42314L10.0241 4.499ZM16.4231 4.499H11.5761L9.97514 10.5H18.0231L16.4231 4.499ZM20.8001 4.499H17.9751L19.5761 10.5H23.9991L20.8001 4.499Z" fill="#ff3c5f"></path> </g></svg>
                    </span>
                    <span>Premium Listings</span>
                </div>

                <div class="wel_feature_item">
                    <span class="wel_feature_icon">
                        <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 260 240" enable-background="new 0 0 260 240" xml:space="preserve" stroke="#ff3c5f">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M257.229,117.41l-4.888-11.82L239.54,90.716l-5.631-17.505l-13.546-8.606l-5.605-31.236l-8.844-3.081l-7.49-28.262 l-8.234,12.616l-7.437,35.434l-5.844,1.567l-31.05-20.904l3.107-11.794l7.65-7.012L134.037,7.02l-22.949,5.631l-10.97,18.141 l-16.362-7.039L66.6,33.976l-1.263,10.743l-9.338,2.914l-9.084,21.462L2.663,91.034L2,110.478l6.959,9.376l-3.533,5.525 l16.379,33.043l-1.195,19.124l12.36,4.223l18.859-10.518l21.01-1.966l3.054-6.135l12.06-7.224l30.227-6.694l16.229,5.313 l8.181,11.846l19.31,6.136l6.853,18.3l21.063,13.494l8.818-6.269l10.305,6.428l18.621-6.162l15.405-31.714l4.675-2.365L258,139.987 L257.229,117.41z M199.777,237.973l11.98-1.939l3.48-13.52l-18.912-3.931L199.777,237.973z">
                                </path>
                            </g>
                        </svg>
                    </span>
                    <span>Australia Wide</span>
                </div>

            </div>


            <div class="bottom-note">

                <span><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm6.32-5.094A8 8 0 0 0 7.094 5.68L18.32 16.905zm-1.414 1.414L5.68 7.094A8 8 0 0 0 16.906 18.32z" fill="#ff3c5f"></path></g></svg> </span>
                <span class="text-shine">Absolutely no banner advertising, third-party marketing or spam.</span>

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
@push('scripts')
@endpush
