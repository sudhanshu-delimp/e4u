@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fiter_btns select {
            text-transform: capitalize;
        }
    </style>
@endsection
@section('content')
    <section class="">
        <div class="container filter-contain mt-3">
            

            <div class="accordion custom_accordian" id="accordionExample">
                <div class="card">
                    <div class="card-header all_filter_accordain" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left btn-search" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
                                Find Massage Centre
                            <i class="fa fa-angle-down"></i>
                            </button>                        
                        </h2>
                    </div>

                    <div id="collapseSearch" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="search_filters">
                                <div class="search_filters_inside">

                                    <form method="" action="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-search-help mb-2 ">
                                                    <h5 class="normal_heading mb-0">Filters</h5>
                                                    <div class="display_inline_block helpquation">
                                                        <a href="#" data-toggle="modal" data-target="#forhelp">
                                                            Help <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <span style="color: var(--peach);font-size: 14px;">Listings reshuffle every 15 minutes.
                                                </span>
                                            </div>
                                            <div class="col-md-8 ryt_srch_btn">
                                                <div class="display_inline_block">
                                                    <div class="d-flex flex-column gap-2" style="width:105px;">
                                                        <div class="d-flex align-items-start" style="padding-top: 2px;">
                                                            <input type="radio" name="locationByRadio" checked="checked"
                                                                value="your_location" id="yourLocation">
                                                            <label for="yourLocation"
                                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                                Your Location
                                                            </label>
                                                        </div>

                                                        <div class="d-flex align-items-start">
                                                            <input type="radio" name="locationByRadio" value="australia" id="australia">
                                                            <label for="australia"
                                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7;">
                                                                Australia
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="display_inline_block">
                                                    <div
                                                        class="input-group custome_form_control managefilter_search_btn_style rounded search_btn_profile custom_search_btn_profile">

                                                        <!-- Hidden input to hold selected search type -->
                                                        <input type="hidden" name="search_by_radio" id="search_by_radio" value="0">

                                                        <!-- Search input -->
                                                        <input type="search" name="name" class="form-control remove_border_btm rounded"
                                                            placeholder="Search by Member ID or Name" aria-label="Search"
                                                            aria-describedby="search-addon" value="">

                                                        <!-- Search button -->
                                                        <button
                                                            class="input-group-text border-0 remove_bg_color_of_search_btn custom-profile-search-btn"
                                                            id="search-addon" type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="display_inline_block   item_dis">
                                                    <span class="item-head">Display item</span>
                                                    <select class="custome_form_control_border_radus padding_five_px" name="limit">
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="75">75</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                    <div class="display_inline_block custom-refreshbuton">
                                                        <div class="margin_btn_reset">
                                                            <input type="hidden" name="apply_pagination_rule" id="apply_pagination_rule"
                                                                value="0">
                                                            <button type="submit"
                                                                class="btn reset_filter filter-tooltip-wrap apply_pagination_button"
                                                                data-toggle="tooltip" title="" id="">
                                                                <span class="filter-tooltip">Apply Change</span>
                                                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="display_inline_block">
                                                    <div class="margin_btn_reset">
                                                        <button type="button" class="btn reset_filter filter-tooltip-wrap" id="v_wishlist">
                                                            <a href="{{ route('find.massage.centre') }}" data-toggle="tooltip"
                                                                class="text-decoration-none">
                                                                <div class="d-flex align-items-center justify-content-center gap-5">
                                                                    <i class="fa fa-list" aria-hidden="true" style="line-height: 23px;"></i>
                                                                    <span class="badge badge-pill badge-danger" id="session_count">0</span>
                                                                </div>
                                                                <span class="filter-tooltip">View Shortlist</span>
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="display_inline_block mb-1">
                                                    <a type="submit" href="{{ route('web.massage-show-list') }}" class="btn reset_filter "
                                                        data-toggle="tooltip" title="">
                                                        Clear Shortlist
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="fiter_btns slect__btn_tab pb-2">
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px" id=""
                                                    name="city">
                                                    <option value="" selected>All Cities</option>
                                                    @foreach (@config('escorts.profile.cities') as $key => $city)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('city') == $key ? 'selected' : '' }}>{{ $city }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown"
                                                    name="premises">
                                                    @foreach (@config('escorts.profile.premises') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('premises') == $key ? 'selected' : '' }}>{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown"
                                                    name="masseur_types">
                                                    @foreach (@config('escorts.profile.masseur-types') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('masseur_types') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown"
                                                    name="age">
                                                    <option value="" selected>All Ages</option>
                                                    <option value="18-25"{{ request()->get('age') == '18-25' ? 'selected' : '' }}>18 -
                                                        25</option>
                                                    <option value="26-35"{{ request()->get('age') == '26-35' ? 'selected' : '' }}>26 -
                                                        35</option>
                                                    <option value="36-45"{{ request()->get('age') == '36-45' ? 'selected' : '' }}>36 -
                                                        45</option>
                                                    <option value="46-80"{{ request()->get('age') == '46-80' ? 'selected' : '' }}>Over
                                                        45</option>
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown"
                                                    name="prices" value="{{ request()->get('prices') }}">
                                                    @foreach (@config('escorts.profile.prices') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('prices') == $key ? 'selected' : '' }}>{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                    id="" name="massage_services">
                                                    <option value="">All Massage Services</option>
                                                    @foreach (@config('escorts.profile.massage-services') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('massage_services') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                    id=""name="other_services">
                                                    <option value="">All Other Service Types</option>
                                                    @foreach (@config('escorts.profile.other-services') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('other_services') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1 mr-2">
                                                <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                    id="verification"name="verification">
                                                    <option value="all">Verification</option>
                                                    <option value="unverified">Unverified</option>
                                                    <option value="verified">Verified</option>
                                                </select>
                                            </div>
                                            <div class="display_inline_block mb-1">
                                                <button type="submit" class="btn reset_filter">
                                                    Apply Filters
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row grid_list_part p-0 m-0">
                                        <div class="col-12 custom--service-tag mc_tags d-flex justify-content-between align-items-center">
                                            <div class="total--list">
                                                <strong>Total Listings:</strong>
                                                <span>{{ count($escorts) }}</span>
                                            </div>
                                            <div>
                                                <div class="grid_list_icon_box display_inline_block grid--btn" data-toggle="modal1"
                                                data-target="#" data-url="grid-escort-list">
                                                <a href="#" class="active" id="grid-modal" data-toggle="tooltip">
                                                    <span class="custom-toltip">Grid View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        viewBox="0 0 30 30" fill="none">
                                                        <path
                                                            d="M25.625 2.11719H20.625C19.2443 2.11719 18.125 3.23648 18.125 4.61719V9.61719C18.125 10.9979 19.2443 12.1172 20.625 12.1172H25.625C27.0057 12.1172 28.125 10.9979 28.125 9.61719V4.61719C28.125 3.23648 27.0057 2.11719 25.625 2.11719Z"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.375 18.3672H4.375C2.99429 18.3672 1.875 19.4865 1.875 20.8672V25.8672C1.875 27.2479 2.99429 28.3672 4.375 28.3672H9.375C10.7557 28.3672 11.875 27.2479 11.875 25.8672V20.8672C11.875 19.4865 10.7557 18.3672 9.375 18.3672Z"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M25.625 18.3672H20.625C19.2443 18.3672 18.125 19.4865 18.125 20.8672V25.8672C18.125 27.2479 19.2443 28.3672 20.625 28.3672H25.625C27.0057 28.3672 28.125 27.2479 28.125 25.8672V20.8672C28.125 19.4865 27.0057 18.3672 25.625 18.3672Z"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.375 2.11719H4.375C2.99429 2.11719 1.875 3.23648 1.875 4.61719V9.61719C1.875 10.9979 2.99429 12.1172 4.375 12.1172H9.375C10.7557 12.1172 11.875 10.9979 11.875 9.61719V4.61719C11.875 3.23648 10.7557 2.11719 9.375 2.11719Z"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="grid_list_icon_box display_inline_block list-btn">
                                                <a href="#" id="grid-list">
                                                    <span class="custom-toltip">List View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24"
                                                        viewBox="0 0 27 24" fill="none">
                                                        <path d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
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
            <!-- ================     service provider start here     ========================= -->
            <div class="row grid_list_part">
                <div class="col-12">
                    <div class="grid_list_icon_box display_inline_block my-shortlist">
                        <ul class="m-0 p-0">
                            <li>
                                <h3 class="preChanges">MY SHORTLIST</h3>
                            </li>
                            <li class="fiter_btns slect__btn_tab">
                                <div class="display_inline_block mb-1 mr-2 ">
                                    <a type="submit" href="#" class="btn reset_filter p-1"
                                        data-toggle="tooltip">
                                        {{-- <i class="fa fa-back" aria-hidden="true"></i> --}}
                                        <i class="fa fa-arrow-left ml-0" aria-hidden="true"
                                            style="padding: 5px;font-size: 16px;"></i>
                                        Back To Listings
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="otherliste" style="display: block;">
                <div class="space_between_row" style="display: block;">
                    <div class="row responsive_colums_in_lg_five_col escost_list">
                        @foreach ($escorts as $key => $escort)
                            <?php $pName[] = explode(' ', $escort->name); ?>
                            @include('web.partials.grid.massage-gold')
                            {{-- <div class="col-lg col-md-6 col-sm-6 mb-5">
                        <div class="five_column_content_top d-flex justify-content-between wish_span" style="z-index: 1;width: 90%;">
                            
                            <span class="card_tit second">Juli test</span>
                            <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span>
                        </div>
                        <a class="card short-card card_box_style mb-0" href="{{ asset('center-profile/1')}}">
                            <div class="card2 card_box_style1">
                                <img class="card-img-top" src="{{ asset('escorts/attatchment/images/39/frame-410.png')}}" alt="Card image cap">
                                <div class="five_column_content_top d-flex justify-content-between wish_span"></div>
                                <div class="five_column_bottom_content">
                                    <div class="d-flex justify-content-between five_column_fonts">
                                        <span>Hope Valley</span>
                                        <span class="give_rating_after_get_servive">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between five_column_fonts">
                                        <span>Price:</span>
                                        <span>From $ 30 / hr</span>
                                    </div>
                                    <div class="d-flex justify-content-between five_column_fonts">
                                        <span>Services:</span>
                                        <span>
                                        <img src="{{ asset('assets/app/img/aerodownicon.svg')}}">
                                        <img src="{{ asset('assets/app/img/upaeroicon.svg')}}">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between five_column_fonts">
                                        <span>Gender:</span>
                                        <span>Female</span>
                                    </div>
                                    <div class="d-flex justify-content-between five_column_fonts">
                                        <span>Available to:</span>
                                        <span>
                                        <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}">
                                        <img src="{{ asset('assets/dashboard/img/male-user.png')}}">
                                        <img src="{{ asset('assets/dashboard/img/trans.png')}}">
                                        <img src="{{ asset('assets/dashboard/img/disabilities.png')}}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <button type="button" class="short-list btn btn-primary removeshortlist" id=" ">Remove from Shortlist</button>
                        <!--  <div class="uperbutton text-center mt-3">
                            <button href="#" class="btn btn-blue removeshortlist" data-name="Juli test" data-escortId="39">Remove from Shortlist</button>
                            </div> -->
                    </div> --}}
                        @endforeach






                    </div>
                </div>
            </div>

            <div class="grid list-view " style="display: none;">
                @foreach ($escorts as $key => $escort)
                    <?php $pName[] = explode(' ', $escort->name); ?>
                    @include('web.partials.list.massage-gold');
                @endforeach
                {{-- <div class="listview_each_section_border_btm">
                    <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view gold_list_frame">
                        <div class="row plat_num_row">
                            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 pr-3 pr-lg-0 self-w-73">
                                <div class="row plat-inner mr-0 ml-0">
                                    <div class="col-md-4 pl-0">
                                        <a href="{{ asset('center-profile/1')}}">
                                            <div class="section_wise_level_icon_img">
                                                <img src="{{ asset('assets/app/img/service-provider/Frame-408.png')}}" class="img-fluid height_for_platinum">
                                                
                                                <div class="verify_image">
                                                    <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 p-0">
                                        <div class="d-flex justify-content-between mb-3 flex_directiom_warp list_cruise pr-0">
                                            <div class="free_profile_name_and_color profile-text">Test2</div>
                                            <div class="age" style="text-align: end;">
                                                <span class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span class="free_profile_age_color_and_font">21</span>
                                            </div>
                                            <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">
                                                
                                                <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist font-size-sec" data-name="Sarah sumdsfs" data-escortid="10">
                                                Remove from Shortlist</button>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4 flex_directiom_warp_but_list_child_not_hundred_present list_gender_area  pr-0">
                                            <div class="gender">
                                                <span class="filter-pad">Gender:</span>
                                                <span>Transgender</span>
                                            </div>
                                            <div class="give_rating_after_get_servive">
                                                <span class="filter-pad">Noida</span>
                                                <span class="give_rating_after_get_servive">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <div class="available padding_top_ten_px">
                                                <span class="filter-pad">Available:</span>
                                                <span>                                     
                                                
                                                </span>
                                            </div>
                                            <div class="video_icon padding_top_ten_px">
                                                <a href="#">
                                                <img src="{{ asset('assets/app/img/video_play.svg')}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-2 margin_lft_rgt_one_five  pr-0">
                                            <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                    <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                                    <div class="div_contain_text">
                                                        <div class="profile_message">
                                                            <h4>Massage</h4>
                                                        </div>
                                                        <div class="profile_hr">
                                                            <h4>/hr</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                    <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                                    <div class="div_contain_text">
                                                        <div class="profile_message">
                                                            <h4>Incalls</h4>
                                                        </div>
                                                        <div class="profile_hr">
                                                            <h4>/hr</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                    <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                                    <div class="div_contain_text">
                                                        <div class="profile_message">
                                                            <h4>Outcalls</h4>
                                                        </div>
                                                        <div class="profile_hr">
                                                            <h4>/hr</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 self-w-26">
                                <table class="table table-striped">
                                    <thead class="table_heading_bgcolor_color">
                                        <tr>
                                            <th scope="col">Service</th>
                                            <th scope="col">Massage</th>
                                            <th scope="col">Incalls</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                        <tr>
                                            <td>Blow &amp; Go</td>
                                            <td>12
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>30 Minutes</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>45 Minutes</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>1 Hour</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                                                </tbody>
                                    <thead class="table_heading_bgcolor_color">
                                        <tr>
                                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">22/02/02</span>   to   <span class="date_from_available">22/02/28</span></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                    
                <div class="listview_each_section_border_btm"> 
                    <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view gold_list_frame">
                        <div class="row plat_num_row">
                            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 pr-3 pr-lg-0 self-w-73">
                                <div class="row plat-inner  mr-0 ml-0">
                                    <div class="col-md-4 featured-pic pl-0">
                                        <a href="{{ asset('center-profile/1')}}">
                                        <div class="section_wise_level_icon_img">
                                            <img src="{{ asset('escorts/attatchment/images/24/girl.jpg')}}" class="img-fluid height_for_gold">
                                            
                                            <div class="add_to_fab_list_view_each_sec">
                                        <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                                                                        </div>
                                            <div class="verify_image">
                                                <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 gold-seven">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="free_profile_name_and_color profile-text">Test2</div>
                                            <div class="age" style="text-align: end;">
                                            <span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font">21</span>
                                            <div class="d-inline video_icon">
                                                <a href="#">
                                                    <img src="{{ asset('assets/app/img/video_play.svg')}}">
                                                    </a>
                                            </div>
                                        </div>

                                        </div>
                                        <div class="d-flex justify-content-between mb-3 flex_warp gold_icon_list">
                                            <div class="gender">
                                                <span>Gender:</span>
                                                <span>Female</span>
                                            </div>
                                            <div class="perth">
                                                <span>New Delhi</span>
                                                <span class="give_rating_after_get_servive">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <div class="free_profile_avilabletoimg_size">
                                                <span>Available:</span>
                                                <span>                                     
                                            <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}">
                                            <img src="{{ asset('assets/dashboard/img/male-user.png')}}">
                                            <img src="{{ asset('assets/dashboard/img/couple.png')}}">
                                                                                
                                                </span>
                                            </div>
                                            
                                        </div>
                                        <div class="mt-3">
                                            <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2 padding_zero_in_desktop fifteen_left_right_padding">
                                        <div class="mb-3">                                           
                                            
                                                <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist">
                                                Remove from Shortlist</button>
                                                                        </div>
                                        <div class="icon-lis-col">
                                            <div class="mb-1">
                                            <div class="d-flex manage_gap_text_img-profile mb-2">
                                                <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                                <div class="div_contain_text">
                                                    <div class="profile_message">
                                                        <h4>Massage</h4>
                                                    </div>
                                                    <div class="profile_hr">
                                                        <h4>12/hr</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex manage_gap_text_img-profile mb-2">
                                                <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                                <div class="div_contain_text">
                                                    <div class="profile_message">
                                                        <h4>Incalls</h4>
                                                    </div>
                                                    <div class="profile_hr">
                                                        <h4>12/hr</h4>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex manage_gap_text_img-profile mb-2">
                                                    <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                                    <div class="div_contain_text">
                                                        <div class="profile_message">
                                                            <h4>Outcalls</h4>
                                                        </div>
                                                        <div class="profile_hr">
                                                            <h4>12/hr</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 self-w-26">
                                <table class="table table-striped">
                                    <thead class="table_heading_bgcolor_color">
                                        <tr>
                                            <th scope="col">Service</th>
                                            <th scope="col">Massage</th>
                                            <th scope="col">Incalls</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                        <tr>
                                            <td>Blow &amp; Go</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>30 Minutes</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>45 Minutes</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                        <tr>
                                            <td>1 Hour</td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                            <td><span class="if_data_not_available">N/A</span>
                                            </td>
                                        </tr>
                                                                                                                </tbody>
                                    <thead class="table_heading_bgcolor_color">
                                        <tr>
                                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">70/01/01</span>   to   <span class="date_from_available">70/01/01</span></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   --}}
            </div>

            {{-- 
        <div class="modal defult-modal" id="forhelp">
            --}}
            <div class="modal fade" id="forhelp">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0 custome_modal_max_width">
                        <div class="modal-header bg-first rounded-0">
                            <h4 class="modal-title"><img src="{{ asset('assets/dashboard/img/short-list-profile.png') }}"
                                    class="custompopicon">Managing your Short List</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <img src="{{ asset('assets/app/img/newcross.png') }}" class=" ">
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body p-0">
                            <div class="modal-sec">
                                <p><b class="mt-1 mb-3">You can manage your Short List by:</b></p>

                                <ol>
                                    <li>Adding and removing Profiles by clicking the Short List button attached to the
                                        Profiles
                                        and then refreshing the page.</li>
                                    <li>Remembering that your Short List presents the Profiles according to the search
                                        criteria
                                        you selected.</li>
                                    <li>Clicking the Profile card to view a detailed Profile of the Massage Centre and the
                                        Masseurs.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="grid-template" class="text-center"></div>
            <!--5 items column start here -->
        </div>
        </div>
        <div class="modal hh" id="my_legbox" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"><img
                                src="{{ asset('assets/app/img/my-legbox.png') }}" class="img-fluid"> My Legbox</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                            <span id="Lname">Please log in or Register to access your Legbox</span>
                        </h1>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <a href="{{ route('viewer.login') }}" type="button" class="btn main_bg_color site_btn_primary"
                            id="loginUrl">Login</a>
                        <a href="{{ route('register') }}" type="button" class="btn main_bg_color site_btn_primary"
                            id="regUrl" style="width: 26%;">Register</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal hh" id="add_wishlist" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"><img
                                src="{{ asset('assets/dashboard/img/short-list-profile.png') }}" class="custompopicon">
                            Add To Shortlist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                            <span id="Lname"></span>
                            <span class="class_msg"></span>
                        </h1>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                            id="close">Ok</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ================       service provider end here        ========================= -->
    <!-- ==============        pagination start here            ====================-->
    {{-- 
<section class="padding_ninty_btm_ninty_px">
    <div class="container">
        <div class="space_between_row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item change_pagination_style">
                        <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item change_pagination_style"><a class="page-link" href="#">1</a></li>
                    <li class="page-item change_pagination_style"><a class="page-link" href="#">2</a></li>
                    <li class="page-item change_pagination_style"><a class="page-link" href="#">3</a></li>
                    <li class="page-item change_pagination_style">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
--}}
    <!-- =============       pagination end here            ====================-->
@endsection
@push('scripts')

<script>
      document.addEventListener("DOMContentLoaded", function () {

            // Restore after refresh
            let opened = sessionStorage.getItem("accordionOpen");
            if (opened === "collapseSearch") {
                document.getElementById("collapseSearch").classList.add("show");
            }

            // When user clicks the accordion
            document.querySelector('[data-target="#collapseSearch"]').addEventListener("click", function () {

                let isOpen = document.getElementById("collapseSearch").classList.contains("show");

                if (!isOpen) {
                    sessionStorage.setItem("accordionOpen", "collapseSearch");
                } else {
                    sessionStorage.removeItem("accordionOpen");
                }
            });

        });

        $('.btn-search').on('click', function(){
            $('.btn-search i').toggleClass('rotate-180');
        })

    </script>
    <script>
        $('#grid-modal').on('click', function() {
            //var source = e.relatedTarget;
            var val = $('#grid-modal').attr('class');
            $('.preChanges').text('MY SHORTLIST')
            if (val != "active") {
                $('.grid').hide();
                $('#grid-template').html(
                    '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
                );

                setTimeout(function() {
                    $('.spinner-border').css('display', 'none');
                    $('.space_between_row').show();
                    $('#grid-modal').addClass('active');
                    $('#grid-list').removeClass('active');
                }, 1000);

            }

        });
        $('#grid-list').on('click', function() {
            var grid = $('#grid-list').attr('class');
            $('.preChanges').text('MY SHORTLIST')
            if (grid != "active") {
                console.log(grid);
                $('.space_between_row').hide();

                $('#grid-template').html(
                    '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
                );

                setTimeout(function() {
                    $('.spinner-border').css('display', 'none');
                    $('#grid-list').addClass('active');
                    $('#grid-modal').removeClass('active');
                    $('.grid').show();

                }, 1000);
            }




        });
        /////////////click event ///////////////
        $(document).ready(function() {
            $('body').on('click', '.akh1', function() {
                var id = $(this).attr('id');
                var val = $(this).data('val');
                var name = $(this).data('sname');
                $('#hideenclassOne_' + val).remove();

                $("#service_id_one").append("<option id='" + name + "' value='" + val + "'>" + name +
                    "</option>");
                console.log("click " + name);
            });
        });
        $(document).ready(function() {
            $('body').on('click', '.akh2', function() {
                var id = $(this).attr('id');
                var val = $(this).data('val');
                var name = $(this).data('sname');
                $('#hideenclassTwo_' + val).remove();

                $("#service_id_two").append("<option id='" + name + "' value='" + val + "'>" + name +
                    "</option>");
                console.log("click " + name);
            });
        });
        $(document).ready(function() {
            $('body').on('click', '.akh3', function() {
                var id = $(this).attr('id');
                var val = $(this).data('val');
                var name = $(this).data('sname');
                $('#hideenclassThree_' + val).remove();

                $("#service_id_three").append("<option id='" + name + "' value='" + val + "'>" + name +
                    "</option>");
                console.log("click " + name);
            });
        });
        ///////////////clear reset ////////////////////  
        $('#resetAll').click(function() {
            $("#selectedService li").remove();
            $("ul input").remove();
        });

        /////////////Change event///////////////////  

        $('body').on('change', '#service_id_one', function() {
            var selectedIdOne = $('#service_id_one').val();
            var getNameOne = $(this).children(":selected").attr("id");
            if (selectedIdOne) {
                $("#selectedService").append(" <li class='seleceted_service_text_and_icon' id='hideenclassOne_" +
                    selectedIdOne + "'><p>" + getNameOne +
                    "</p><i class='fa fa-times-circle-o akh1' data-sname='" + getNameOne + "' data-val=" +
                    selectedIdOne + " aria-hidden='true' id='id_" + selectedIdOne +
                    "'></i> <input type='hidden' name='services[]' value='" + selectedIdOne + "'></li> ");
                $("#service_id_one option[value=" + selectedIdOne + "]").attr('disabled', 'disabled');
                $("#service_id_one option[value=" + selectedIdOne + "]").remove();

                console.log('serviceOne=' + getNameOne);
            }
        });
        $('body').on('change', '#service_id_two', function() {
            $("#selectedService").show();
            var selectedIdOne = $('#service_id_two').val();
            var getNameOne = $(this).children(":selected").attr("id");
            if (selectedIdOne) {
                $("#selectedService").append(" <li class='seleceted_service_text_and_icon' id='hideenclassTwo_" +
                    selectedIdOne + "'><p>" + getNameOne +
                    "</p><i class='fa fa-times-circle-o akh2' data-sname='" + getNameOne + "' data-val=" +
                    selectedIdOne + " aria-hidden='true' id='id_" + selectedIdOne +
                    "'></i><input type='hidden' name='services[]' value='" + selectedIdOne + "'> </li> ");
                $("#service_id_two option[value=" + selectedIdOne + "]").attr('disabled', 'disabled');
                $("#service_id_two option[value=" + selectedIdOne + "]").remove();

                console.log('service_two=' + getNameOne);
            }
        });
        $('body').on('change', '#service_id_three', function() {
            var selectedIdOne = $('#service_id_three').val();
            var getNameOne = $(this).children(":selected").attr("id");
            if (selectedIdOne) {
                $("#selectedService").append(" <li class='seleceted_service_text_and_icon' id='hideenclassThree_" +
                    selectedIdOne + "'><p>" + getNameOne +
                    "</p><i class='fa fa-times-circle-o akh3' data-sname='" + getNameOne + "' data-val=" +
                    selectedIdOne + " aria-hidden='true' id='id_" + selectedIdOne +
                    "'></i><input type='hidden' name='services[]' value='" + selectedIdOne + "'> </li> ");
                $("#service_id_three option[value=" + selectedIdOne + "]").attr('disabled', 'disabled');
                $("#service_id_three option[value=" + selectedIdOne + "]").remove();

                console.log('service_three=' + getNameOne);
            }
        });
        ///////////////end event change //////////////////  
        $('body').on('change', '#service_id_two', function() {
            var selectedIdTwo = $('#service_id_two').val();
            var getNameTwo = $(this).children(":selected").attr("id");
            if (selectedIdTwo) {
                $("#selected_service_two").append(" <li id=" + selectedIdTwo +
                    "><div class='my_service_anal hideenclassTwo" + selectedIdTwo +
                    "'><span class='dollar-sign'>" + getNameTwo +
                    "</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)'><input type='hidden' name='service_id[]' value=" +
                    selectedIdTwo + " placeholder=''><span><i class='fas fa-times-circle' id='id_" +
                    selectedIdTwo + "' value=" + selectedIdTwo + "></i></span></div></li> ");
                $("#service_id_two option[value=" + selectedIdTwo + "]").attr('disabled', 'disabled');
                console.log('change=' + selectedIdTwo);
            }
        });

        $('body').on('change', '#service_id_three', function() {
            var selectedIdThree = $('#service_id_three').val();
            var getNameThree = $(this).children(":selected").attr("id");
            if (selectedIdThree) {
                $("#selected_service_three").append(" <li id=" + selectedIdThree +
                    "><div class='my_service_anal hideenclassThree" + selectedIdThree +
                    "'><span class='dollar-sign'>" + getNameThree +
                    "</span><input type='number' class='dollar-before  input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)'><input type='hidden' name='service_id[]' value=" +
                    selectedIdThree + " placeholder=''><span><i class='fas fa-times-circle' id='id_" +
                    selectedIdThree + "' value=" + selectedIdThree + "></i></span></div></li> ");
                $("#service_id_three option[value=" + selectedIdThree + "]").attr('disabled', 'disabled');
                console.log('change=' + selectedIdThree);
            }
        });
        $(document).on('click', '.removeshortlist', function() {
            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            console.log(name);
            $.ajax({
                method: "POST",
                url: "{{ route('web.remove.mcMyShortListCart') }}",
                data: {
                    escortId: Eid,
                    userId: Uid
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    console.log(data);
                    if (data.error == 1) {

                        $('#add_wishlist').modal('show');
                        $('.class_msg').text(name + ' has been remove from your Shortlist');
                        $('.myescort_' + Eid).text('Add to Shortlist');
                        $('#session_count').text(data.count_session);
                        $("#close").click(function() {
                            location.reload();
                        });
                        //location.reload();
                    }
                    // else {
                    //     $.ajax({
                    //         method: "POST",
                    //         url: "{{ route('web.remove.shortlist') }}",
                    //         data:{escortId : Eid,
                    //             userId : Uid},
                    //         headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                    //         //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    //         success: function (data) {
                    //             console.log(data);
                    //             if(data.error == 1)
                    //             {
                    //             $('#string1').text(name +' added to your Shortlist');
                    //             $('#add_wishlist').modal('show');
                    //             $('.myescort_'+Eid).text('Remove from Shortlist')
                    //             //location.reload();
                    //             }

                    //         }
                    //     });

                    // }

                }
            });
        });
        $(document).on('click', '.add_to_favrate', function() {

            var name = $(this).attr('data-name');

            var Eid = $(this).attr('data-escortId');
            console.log("name==" + Eid);
            var Uid = $(this).attr('data-userId');
            var cidcl = $(this).attr('class');
            var cid = cidcl.split(' ');
            if (cid[1] == 'fill') {
                $(this).removeClass('fill');
                $(this).addClass('null');
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' title='Remove from legbox' aria-hidden='true'></i>"
                );
                var url = "{{ route('user.save.massage.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                $('.class_msg').text(name + ' added to your Legbox');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);

                    }
                });
                console.log("fill");
            } else if (cid[1] == 'null') {
                $(this).removeClass('null');
                $(this).addClass('fill');
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart-o' title='Add to legbox' aria-hidden='true'></i>");
                var url = "{{ route('user.delete.massage.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                //$('.class_msg').text(name + ' Remove from Legbox ');
                $('.class_msg').text(name + ' has been removed from your Legbox ');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);

                    }
                });
                console.log("null");
            } else {
                $('#my_legbox').modal('show');
                var loginurl = "{{ route('viewer.login', ':id') }}";
                var regurl = "{{ route('register', ':id') }}";
                loginurl = loginurl.replace(':id', 'legboxId=' + Eid)
                regurl = regurl.replace(':id', 'legboxId=' + Eid)
                $('#loginUrl').attr('href', loginurl)
                $('#regUrl').attr('href', regurl)
            }



            console.log(cid[1] + "-" + Eid);
            console.log(cidcl);

        });
    </script>
@endpush
