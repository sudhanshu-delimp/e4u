@extends('layouts.web')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
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

        .apply-filter-btn {
            font-size: 16px;
        }
    </style>
@endsection
@php
    $cityId = 0;
    $genderId = 0;
    function checkCommonCityAndGender($cityId, $genderId, $escort)
    {
        if ($cityId == $escort['city_id'] || $cityId == 0) {
            $cityId = $escort['city_id'];
        } else {
            $cityId = -1;
        }
        if ($genderId == $escort->getRawOriginal('gender') || $genderId == 0) {
            $genderId = $escort->getRawOriginal('gender');
        } else {
            $genderId = -1;
        }
        return [$cityId, $genderId];
    }
@endphp
@section('content')

    @php
        //dd($escorts);
        $grouped = $paginator->getCollection()->groupBy('membership');
    @endphp
    <section class="">
        <div class="container filter-contain">
            <div class="search_filters">
                <div class="search_filters_inside">
                    <form id="allfilters" method="" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-search-help mb-2 ">
                                    <h5 class="normal_heading mb-0">Search Filters</h5>
                                    <div class="display_inline_block helpquation">
                                        <a href="#" data-toggle="modal" data-target="#forhelp"
                                            title="Filters explained">
                                            Help <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <span style="color:#FF3349">Membership Type reshuffles every 2 hours. </span>
                            </div>
                            <div class="col-md-8 ryt_srch_btn">
                                <div class="display_inline_block ">
                                    <div
                                        class="input-group custome_form_control managefilter_search_btn_style rounded  search_btn_profile">
                                        <button class="input-group-text border-0 remove_bg_color_of_search_btn"
                                            id="search-addon" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <input type="search" name="name" class="form-control remove_border_btm rounded "
                                            placeholder="Search by Member ID or Name" aria-label="Search"
                                            aria-describedby="search-addon" value="{{ request()->get('name') }}">
                                    </div>
                                </div>
                                <div class="display_inline_block">
                                    <div class="d-flex flex-column gap-2" style="width:105px">
                                        <div class="d-flex align-items-start"
                                            @php
                                                $myLocation = false;
                                                if(request()->filled('lat')){
                                                    $myLocation = true; 
                                                }
                                            @endphp
                                            style=" padding-top: 2px;" title="Undertake a search within your Location only">
                                            <input type="radio" name="locationByRadio" {{ ($radio_location_filter != null || $myLocation) ? 'checked':'' }} value="your_location" id="yourLocation">
                                            <label for="yourLocation"
                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                Your Location
                                            </label>
                                        </div>

                                        <div class="d-flex align-items-start" title="Undertake a search Australia wide">
                                            <input type="radio" name="locationByRadio" value="australia" id="australia" {{ ($radio_location_filter == null && $myLocation == false ) ? 'checked' : ''}}>
                                            <label for="australia"
                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7;">
                                                Australia
                                            </label>
                                        </div>
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

                                            <a type="reset" class="btn reset_filter" href="{{ route('find.all') }}"
                                                data-toggle="tooltip" title="Refresh page">
                                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="display_inline_block">
                                    <div class="margin_btn_reset">
                                        <button type="button" class="btn reset_filter" id="v_wishlist">
                                            <a href="{{ route('web.show.showAddList') }}" data-toggle="tooltip"
                                                title="View Shortlist"> <i class="fa fa-list" aria-hidden="true"></i>
                                                <span class="badge badge-pill badge-danger"
                                                    id="session_count">{{ count((array) session('cart')) }}</span>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                                <div class="display_inline_block mb-1">
                                    @php
                                        $query = Arr::except(request()->query(), ['ipinfo']);
                                    @endphp
                                    <a type="submit" href="{{ route('shortlist.clear-list', $query) }}"
                                        class="btn reset_filter " data-toggle="tooltip" title="clear shortlist button">
                                        Clear Shortlist
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="fiter_btns slect__btn_tab">
                            <div class="display_inline_block mb-1 mr-2">
                                <select class="custome_form_control_border_radus padding_five_px" id=""
                                    name="city">
                                    <option value="" selected>All Cities</option>
                                    @foreach (@config('escorts.profile.cities') as $key => $city)
                                        {{-- <option value="{{$key}}" {{ (request()->get('city') == $key) ? 'selected' : '' }}>{{$city}}</option> --}}
                                        <option value="{{ $key }}" {{ $locationCityId == $key ? 'selected' : '' }}>
                                            {{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="display_inline_block mb-1 mr-2">
                                <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown"
                                    name="gender">

                                    <option value="" selected>Gender</option>
                                    <option value="1"
                                        {{ $filterGenderId == '1' || request()->segment(2) == 'Male' ? 'selected' : '' }}>
                                        Male</option>
                                    <option
                                        value="6"{{ $filterGenderId == '6' || request()->segment(2) == 'Female' ? 'selected' : '' }}>
                                        Female</option>
                                    <option
                                        value="2"{{ $filterGenderId == '2' || request()->segment(2) == 'Couples' ? 'selected' : '' }}>
                                        Couples</option>
                                    <option
                                        value="3"{{ $filterGenderId == '3' || request()->segment(2) == 'Transgender' ? 'selected' : '' }}>
                                        Transgender</option>
                                    <option
                                        value="4"{{ $filterGenderId == '4' || request()->segment(2) == 'Cross Dresser' ? 'selected' : '' }}>
                                        Cross Dresser</option>
                                    <option
                                        value="5"{{ $filterGenderId == '5' || request()->segment(2) == 'Massage Centres' ? 'selected' : '' }}>
                                        Massage Centres</option>
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
                                    name="price" value="{{ request()->get('price') }}">
                                    <option value="" selected>Any Price</option>
                                    <option value="300"{{ request()->get('price') == '300' ? 'selected' : '' }}>Up to
                                        $ 300</option>
                                    <option value="500"{{ request()->get('price') == '500' ? 'selected' : '' }}>Up to
                                        $ 500</option>
                                    <option value="800"{{ request()->get('price') == '800' ? 'selected' : '' }}>Up to
                                        $ 800</option>
                                    <option value="800"{{ request()->get('price') == '800' ? 'selected' : '' }}>Over
                                        $ 800</option>
                                </select>
                            </div>
                            <div class="display_inline_block mb-1 mr-2">
                                <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                    id="" name="duration_price" value="{{ request()->get('duration_price') }}">
                                    <option value="0">All services</option>
                                    <option value="incall_price"
                                        {{ request()->get('duration_price') == 'incall_price' ? 'selected' : '' }}>
                                        In-calls</option>
                                    <option value="outcall_price"
                                        {{ request()->get('duration_price') == 'outcall_price' ? 'selected' : '' }}>
                                        Out-calls</option>
                                    <option value="massage_price"
                                        {{ request()->get('duration_price') == 'massage_price' ? 'selected' : '' }}>
                                        Massage</option>
                                    {{-- @foreach ($services as $key => $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach --}}
                                </select>
                            </div>
                            <div class="display_inline_block mb-1 mr-2">
                                <button type="button" class="btn verified_btn_bg_color verified_text_color"
                                    data-toggle="tooltip" title="View Verified Photos only">
                                    <img src="{{ asset('assets/img/e4u-verified-dark.png') }}">
                                </button>
                            </div>
                            <div class="display_inline_block mb-1 ">
                                <input type="hidden" name="filter_button_submit" value="1">
                                <button type="submit" class="btn reset_filter apply-filter-btn" data-toggle="tooltip"
                                    title="Apply filters - Search">
                                    Apply Filters
                                </button>
                            </div>
                        </div>

                        <!-- Service tags start -->
                        <div class="service_tagss">
                            <div class="row serve-row-one">
                                <div class="col-md-12 custom--service-tag">
                                    <!-- accordien start here -->
                                    <div class="accordion-container-new">
                                        <div class="set mb-0">
                                            <a class=" py-lg-0 py-2"
                                                style="font-weight:500;display: flex; align-items: center;justify-content: space-between;">
                                                Service Tags
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="content">
                                                <div class="accodien_manage_padding_content">
                                                    <div class="display_inline_block mb-1 mr-1">
                                                        <select class="custome_form_control_border_radus padding_five_px"
                                                            id="service_id_one">
                                                            <option value="">Fun Stuff - On Viewer</option>
                                                            @foreach ($service_one as $key => $service)
                                                                <option id="{{ $service->name }}"
                                                                    value="{{ $service->id }}"
                                                                    {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                    {{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="display_inline_block mb-1 mr-1">
                                                        <select class="custome_form_control_border_radus padding_five_px"
                                                            id="service_id_two">
                                                            <option value="">Kinky Stuff - On Viewer</option>
                                                            @foreach ($service_two as $key => $service)
                                                                <option id="{{ $service->name }}"
                                                                    value="{{ $service->id }}"
                                                                    {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                    {{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="display_inline_block mb-1 mr-1">
                                                        <select class="custome_form_control_border_radus padding_five_px"
                                                            id="service_id_three">
                                                            <option value="">Fun Stuff - On Escort</option>
                                                            @foreach ($service_three as $key => $service)
                                                                <option id="{{ $service->name }}"
                                                                    value="{{ $service->id }}"
                                                                    {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                    {{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="reset" id="resetAll" class="btn reset_filter"
                                                        title="Reset Service Tags" value="Clear Tags">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- accordien end here -->
                                    <!-- Grid View -->
                                    @php
                                        $viewType = 'grid';
                                        if (request()->get('view') === 'list') {
                                            $viewType = 'list';
                                        }
                                    @endphp

                                    <div class="row grid_list_part" id="prosud aa" style="display: block;">

                                        <div class="col-12 align-items-center">
                                            <div class="grid_list_icon_box display_inline_block grid--btn"
                                                data-toggle="modal1" data-target="#" data-url="grid-escort-list">
                                                <a href="#" class="{{$viewType == 'grid' ? 'active' : ''}}" id="grid-modal" data-toggle="tooltip">
                                                    <span>Grid view</span>
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
                                                <a href="#" class="{{$viewType == 'list' ? 'active' : ''}}" id="grid-list"
                                                    data-toggle="tooltip">
                                                    <span>List view</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24"
                                                        viewBox="0 0 27 24" fill="none">
                                                        <path
                                                            d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                                            stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- Grid view end -->
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="selected_service_tag">
                                        <ul id="selectedService">
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end -->
                    </form>
                </div>
            </div>
            <!-- ================     service provider start here     ========================= -->
            @if ($user != '1')
                <div class="row grid_list_part grid_wishlist_part mb-5" id="v_li_wishlist" style="display: block;">
                    <div class="col-12 align-items-center">
                        <div class="grid_list_icon_box display_inline_block " data-toggle="modal1" data-target="#"
                            data-url="grid-escort-list">
                            <a href="#" class="active" id="grid-modal">
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
                                <!--  <img src="{{ asset('assets/app/img/grid-pic.svg') }}"> -->
                            </a>
                        </div>
                        <div class="grid_list_icon_box display_inline_block">
                            <a href="#" class=" " id="grid-list">
                                <!-- <img src="{{ asset('assets/app/img/line.svg') }}"> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24"
                                    viewBox="0 0 27 24" fill="none">
                                    <path d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                        stroke="#0C223D" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="grid_list_icon_box display_inline_block my-shortlist">
                            <ul class="mb-0 mt-1 pt-1">
                                <li>
                                    <h3>My Shortlist</h3>
                                </li>
                                <li><a href="#" data-toggle="modal" data-target="#forhelp"
                                        title="Filters explained">Help <i class="fa fa-question-circle-o"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
            @endif
            <div class="modal defult-modal" id="forhelp">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                        <!-- Modal body -->
                        <div class="modal-body p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <img src="{{ asset('assets/app/img/newcross.png') }}" class=" ">
                            </button>
                            <h3>Help</h3>
                            <div class="modal-sec">
                                <p><b class="pb-4">Search Filters</b></p>
                                <p>
                                    Your Geolocation will automatically determine your Location and list
                                    Profiles according to that Location. You can:
                                </p>
                                <ol class="pl-3">
                                    <li>&nbsp;Filter the search criteria by selecting your preferred filter and then
                                        selecting the ‘Refresh’ &nbsp;button.
                                    </li>
                                    <li>&nbsp;Change your Location by selecting your preferred city.</li>
                                    <li>&nbsp;Change the number of listings displayed by changing the ‘Displayed
                                        &nbsp;item’ filter to your preferred value.
                                    </li>
                                </ol>

                                <p><b>Service Tags</b></p>
                                <p> Selected Service Tags will be listed in the Service Tag list which will
                                    appear below the tags. You can remove any Service Tag by clicking the
                                    ‘X’ located on the tag, or all of the Service Tags by clicking the ‘Clear Tags’
                                    link.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="grid-template" class="text-center"></div>
            <!--5 items column start here -->
            <div class="wislist-filster" style="display: none;">
                <div class="my-wishlist px-0 px-lg-4 mx-0 mx-lg-2" style="display: block;">
                    <div class="row responsive_colums_in_lg_five_col escost_list">

                    </div>
                </div>

            </div>
            @if (!$grouped->isEmpty())
                <div class="otherliste" style="display: block;">
                    @if ($grouped->has('1'))
                        <div class="space_between_row" style="display:{{$viewType == 'grid' ? 'block' : 'none'}}">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/silver_platinum.png') }}"
                                    data-toggle="tooltip"
                                    title="Platinum Members - {{ $memberTotalCount[1] }} {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[1] }}
                                <span class="bordertopp">
                                    {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row responsive_colums_in_lg_five_col escost_list">
                                @if ($grouped->has('1'))
                                    @foreach ($grouped['1'] as $escort)
                                        @include('web.partials.grid.platinum')
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endif
                    @if ($grouped->has('2'))
                        <div class="space_between_row" style="display:{{$viewType == 'grid' ? 'block' : 'none'}}">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/gold_dis.png') }}"
                                    data-toggle="tooltip"
                                    title="Gold Members - {{ $memberTotalCount[2] }} {{ $memberTotalCount[2] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[2] }}
                                <span class="bordertopp">
                                    {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row responsive_colums_in_lg_five_col escost_list">
                                @if ($grouped->has('2'))
                                    @foreach ($grouped['2'] as $escort)
                                        @include('web.partials.grid.gold')
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endif
                    @if ($grouped->has('3'))
                        <div class="space_between_row" style="display:{{$viewType == 'grid' ? 'block' : 'none'}}">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/dark_silver.png') }}"
                                    data-toggle="tooltip"
                                    title="Silver Members - {{ $memberTotalCount[3] }} {{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[3] }}
                                <span class="bordertopp">
                                    {{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row responsive_colums_in_lg_five_col escost_list">
                                @if ($grouped->has('3'))
                                    @foreach ($grouped['3'] as $escort)
                                        @include('web.partials.grid.silver')
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endif
                    @if ($grouped->has('4'))
                        <div class="space_between_row" style="display:{{$viewType == 'grid' ? 'block' : 'none'}}">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/Group 153.png') }}"
                                    data-toggle="tooltip"
                                    title="Free Members -{{ $memberTotalCount[4] }} {{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[4] }}
                                <span class="bordertopp">
                                    {{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row responsive_colums_in_lg_five_col escost_list">
                                @if ($grouped->has('4'))
                                    @foreach ($grouped['4'] as $escort)
                                        @include('web.partials.grid.free')
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endif
                </div>
                <div class="grid list-view " style="display: {{$viewType == 'list' ? 'block' : 'none'}}">
                    @if ($grouped->has('1'))
                        <div class="platinum-sec">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/silver_platinum.png') }}"
                                    data-toggle="tooltip"
                                    title="Platinum Members - {{ $memberTotalCount[1] }} {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[1] }}
                                <span class="bordertopp">
                                    {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="text">
                                {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}
                            </div>
                            @if ($grouped->has('1'))
                                @foreach ($grouped['1'] as $escort)
                                    @include('web.partials.list.platinum')
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @if ($grouped->has('2'))
                        <div class="platinum-sec gold">
                            <div class="bod_image"><img src="{{ asset('assets/app/img/gold_dis.png') }}"
                                    data-toggle="tooltip"
                                    title="Gold Members - {{ $memberTotalCount[2] }} {{ $memberTotalCount[2] == 1 ? 'Listing' : 'Listings' }}">
                                {{ $memberTotalCount[2] }}
                                <span class="bordertopp">{{ $memberTotalCount[2] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="text gold">
                                {{ $memberTotalCount[2] == 1 ? 'Listing' : 'Listings' }}
                            </div>
                            @if ($grouped->has('2'))
                                @foreach ($grouped['2'] as $escort)
                                    @include('web.partials.list.gold')
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @if ($grouped->has('3'))
                        <div class="listview_each_section_border_btm silver_card">
                            <div class="bod_image custom-mb"><img src="{{ asset('assets/app/img/dark_silver.png') }}"
                                    data-toggle="tooltip"
                                    title="Silver Members - {{ $memberTotalCount[3] }} {{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}">{{ $memberTotalCount[3] }}<span
                                    class="bordertopp">{{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row  mx-md-n2">
                                @if ($grouped->has('3'))
                                    @foreach ($grouped['3'] as $escort)
                                        @include('web.partials.list.silver')
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                    @if ($grouped->has('4'))
                        <div class="manage_listview_margin_siliver_section free_card">
                            <div class="bod_image custom-mb"><img src="{{ asset('assets/app/img/Group 153.png') }}"
                                    data-toggle="tooltip"
                                    title="Free Members - {{ $memberTotalCount[4] }} {{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}">{{ $memberTotalCount[4] }}<span
                                    class="bordertopp">{{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}</span>
                            </div>
                            <div class="row">
                                @if ($grouped->has('4'))
                                    @foreach ($grouped['4'] as $escort)
                                        @include('web.partials.list.free')
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="no--listing">
                    <p><i>There are no listings for your search criteria.</i></p>
                </div>
            @endif
        </div>

        <!-- <div class="page-sec mb-5 mt-4">{!! $escorts->links('pagination::bootstrap-4') !!}</div> -->

        {{-- Custom Pagination with Bootstrap --}}
        <div class="page-sec mb-5 mt-4">
            {{ $paginator->links('pagination::custom-bootstrap') }}
        </div>


        </div>
        </div>
    </section>
    <!-- ================       service provider end here        ========================= -->
    <!-- ==============        pagination start here            ====================-->
    {{-- <section class="padding_ninty_btm_ninty_px">
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
                    <li class="page-item change_pagination_style"><a class="page-link" href="{#}">1</a></li>
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
</section> --}}
    <!-- <div class="modal show" id="add_wishlist" style="display: block;"> -->
    <div class="modal hh" id="my_legbox" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">My Legbox</h5>
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
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Add To Shortlist</h5>
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





    <div class="modal" id="add_wishlist1" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/app/img/check-box.png') }}">

                    <form id="modalFORM" action="{{ route('web.show.showAddList') }}">
                        <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
                        <button type="submit" class="btn btn-danger" id="close">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="withoutLogin" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/app/img/check-box.png') }}">
                    <h3 class="mb-4 mt-5"><span id="string"></span> </h3>
                    <form id="modalFORM1" action="{{ route('advertiser.login') }}">
                        <button type="submit">Login</button>
                        <button type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =============       pagination end here            ====================-->
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script>
        // var skipSliderage = document.getElementById("skipstepage");
        // var skipValuesage = [
        // document.getElementById("skip-value-lower-age"),
        // document.getElementById("skip-value-upper-age")
        // ];

        // noUiSlider.create(skipSliderage, {
        // start: [0, 30],
        // connect: true,
        // behaviour: "drag",
        // step: 1,
        // range: {
        //    min: 18,
        //    max: 60
        // },
        // format: {
        //    from: function (value) {
        //       return parseInt(value);
        //    },
        //    to: function (value) {
        //       return parseInt(value);
        //    }
        // }
        // });

        // skipSliderage.noUiSlider.on("update", function (values, handle) {
        // skipValuesage[handle].innerHTML = values[handle];
        // });
    </script>

    <script>
        // $('#grid-modal').on('shown.bs.modal', function (e) {
        //    var source = e.relatedTarget;
        //    console.log($(source).data('url'));
        //     $.ajax({
        //         url: $(source).data('url'),
        //         success: function (data) {
        //             $('#grid-template').html(data);
        //         }
        //     });
        // });

        // $('#grid-modal').on('hidden.bs.modal', function (e) {
        //     $('#grid-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');

        // });

        // $('#grid-modal').on('click', function (e) {
        //    var source = e.relatedTarget;
        //    console.log($(source).data('url'));
        //     $.ajax({
        //         url: $(source).data('url'),
        //         success: function (data) {
        //             $('#grid-template').html(data);
        //         }
        //     });
        // });

        $('#grid-modal').on('click', function() {
            //var source = e.relatedTarget;
            $('.preChanges').html('<h3>Escorts Grid View</h3>');
            var val = $('#grid-modal').attr('class');
            if (val != "active") {
                $('.grid').hide();
                $('.my-wishlist').hide();
                $('#grid-template').html(
                    '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
                );

                setTimeout(function() {
                    $('.spinner-border').css('display', 'none');
                    $('.my-wishlist').css('display', 'none');
                    $('.space_between_row').show();
                    $('#grid-modal').addClass('active');
                    $('#grid-list').removeClass('active');
                }, 1000);

            }
            //

        });
        $('#grid-list').on('click', function() {
            $('.preChanges').html('<h3>Escorts List View</h3>');
            var grid = $('#grid-list').attr('class');
            if (grid != "active") {
                console.log(grid);
                $('.space_between_row').hide();
                $('.my-wishlist').hide();

                $('#grid-template').html(
                    '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
                );

                setTimeout(function() {
                    $('.spinner-border').css('display', 'none');
                    $('.my-wishlist').css('display', 'none');
                    $('#grid-list').addClass('active');
                    $('#grid-modal').removeClass('active');
                    $('.grid').show();

                }, 1000);
            }
        });



        // $('#v_wishlist').on('click', function () {
        //    var grid = $('#v_wishlist').attr('class');
        //    if(grid != "active") {
        //         console.log(grid);
        //         $('.space_between_row').hide();
        //         $('.grid_list_part').hide();
        //         $('.otherliste').hide();

        //         $('#grid-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');

        //         setTimeout(function(){
        //         $('.spinner-border').css('display', 'none');
        //         $('.grid_list_part').css('display', 'none');
        //         $('.otherliste').css('display', 'none');
        //         $('.list-wishlist-view').css('display', 'none');
        //         $('.grid_wishlist_part').show();
        //         $('.wislist-filster').show();
        //         $('.my-wishlist').show();

        //         }, 1000);

        //    }
        // });


        // $('#grid-wishlist-modal').on('click', function () {
        //    var grid = $('#grid-wishlist-modal').attr('class');
        //    if(grid != "active") {
        //         console.log(grid);

        //         $('.space_between_row').hide();
        //         $('.grid_list_part').hide();
        //         $('.list-wishlist-view').hide();
        //         $('.otherliste').hide();

        //         $('#grid-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');

        //         setTimeout(function(){
        //         $('.spinner-border').css('display', 'none');
        //         $('.grid_list_part').css('display', 'none');
        //         $('.list-wishlist-view').css('display', 'none');
        //         $('.otherliste').css('display', 'none');
        //         $('#grid-wishlist-modal').addClass('active');
        //         $('#grid-wishlist-list').removeClass('active');
        //         $('.grid_wishlist_part').show();
        //         $('.wislist-filster').show();
        //         $('.my-wishlist').show();

        //         }, 1000);

        //    }
        // });


        // $('#grid-wishlist-list').on('click', function () {
        //    var grid = $('#grid-wishlist-list').attr('class');
        //    if(grid != "active") {
        //         console.log(grid);
        //         $('.space_between_row').hide();
        //         $('.grid_list_part').hide();
        //         $('.my-wishlist').hide();
        //         $('.otherliste').hide();

        //         $('#grid-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');

        //         setTimeout(function(){
        //         $('.spinner-border').css('display', 'none');
        //         $('.grid_list_part').css('display', 'none');
        //         $('.my-wishlist').css('display', 'none');
        //         $('.list-wishlist-view').css('display', 'none');
        //         $('.otherliste').css('display', 'none');
        //         $('#grid-wishlist-list').addClass('active');
        //         $('#grid-wishlist-modal').removeClass('active');
        //         $('.grid_wishlist_part').show();
        //         $('.wislist-filster').show();
        //         $('.list-wishlist-view').show();

        //         }, 1000);
        //    }
        // });


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

            <?php
            if ($cityId > 0) {
                /*echo "if($('[name=\"city\"]').val() == '') {
                    $('[name=\"city\"]').val($cityId);
                }"; */
            
                if (request()->get('city') == null && $locationCityId == null) {
                    echo "$('[name=\"city\"]').val()";
                }
            }
            
            if ($genderId > 0 && $filterGenderId != null) {
                echo "if($('[name=\"gender\"]').val() == '') {
                                                                                            $('[name=\"gender\"]').val($genderId);
                                                                                        }";
            }
            ?>
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

        $(document).on('click', '.shortlist', function() {
            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            var url = "{{ route('web.save.addtocart', ':id') }}";
            url = url.replace(':id', Eid);

            console.log(Uid);
            // if(Uid != "NA") {
            $.ajax({
                method: "POST",
                // url: "{{ route('web.save.shortlist') }}",
                url: url,
                data: {
                    escortId: Eid,
                    userId: Uid
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    console.log("count = " + data.count_session);
                    console.log(data);
                    if (data.error == 1) {

                        //$('#Lname').text(name + ' has been added to your Shortlist');
                        $('.class_msg').text(name + ' has been added to your Shortlist');
                        $('#add_wishlist').modal('show');
                        $('.myescort_' + Eid).html(
                            '<img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}"> Remove from Shortlist'
                        )
                        $('#session_count').text(data.count_session);
                        //

                    } else {

                        $.ajax({
                            method: "POST",
                            url: "{{ route('web.remove.shortlist') }}",
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
                                    //$('#Lname').text(name +' has been removed from your Shortlist');
                                    $('.class_msg').text(name +
                                        ' has been remove from your Shortlist');
                                    $('#add_wishlist').modal('show');
                                    $('.myescort_' + Eid).html(
                                        '<img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}"> Add to Shortlist'
                                    )
                                    $('#session_count').text(data.count_session);
                                    //location.reload();
                                }

                            }
                        });

                    }
                }
            });
            // } else {

            //     $('#withoutLogin').modal('show');
            //     $('#string').text(name + ' Please login first');
            // }


        });
        $(document).on('click', '.removeshortlist', function() {
            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            console.log(name);
            $.ajax({
                method: "POST",
                url: "{{ route('web.remove.shortlist') }}",
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
            var Uid = $(this).attr('data-userId');
            var cidcl = $(this).attr('class');
            var cid = cidcl.split(' ');
            if (cid[1] == 'fill') {
                $(this).removeClass('fill');
                $(this).addClass('null');
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' title='Remove from legbox' aria-hidden='true'></i>"
                );
                var url = "{{ route('user.save.legbox', ':id') }} ";
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
                var url = "{{ route('user.delete.legbox', ':id') }} ";
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
                var login_url = "{{ route('viewer.login', ':id') }}";
                var loginurl = login_url.replace(':id', 'legboxId=' + Eid);
                var loginurl2 = loginurl.replace(':path', 'path=' + window.location.pathname);
                console.log(loginurl2);




                var regurl = "{{ route('register', ':id') }}";
                //{{-- loginurl = loginurl.replace(':id','legboxId='+Eid) --}}
                regurl = regurl.replace(':id', 'legboxId=' + Eid)
                $('#loginUrl').attr('href', loginurl2)
                $('#regUrl').attr('href', regurl)
            }



            console.log(cid[1] + "-" + Eid);
            console.log(cidcl);

        });

        $(document).ready(function () {
            $('input[name="locationByRadio"]').on('change', function () {
                let selectedLocation = {};
                selectedLocation.location = $(this).attr('id'); // "yourLocation" or "australia"
                $('input[name="locationByRadio"]').prop('disabled', true);

                //console.log(selectedLocation.location, ' out if')
                if(selectedLocation.location == 'yourLocation'){

                    navigator.geolocation.getCurrentPosition(async function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        selectedLocation.lat = latitude;
                        selectedLocation.lng = longitude;

                        console.log(longitude, latitude, ' jitendera')
                        sendLocationData(selectedLocation);
                       
                    });
                    
                }else{
                    selectedLocation.lat = '';
                    selectedLocation.lng = '';
                    sendLocationData(selectedLocation);
                }

                
            });

            function sendLocationData(data) {
                $.ajax({
                    url: '{{ route("location.filter") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data
                    },
                    success: function (response) {
                        if(response.status){
                            $("#"+data.location).attr('checked', true);
                            window.location.href = response.location;
                        }
                        console.log('Location filter updated:', response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error in location filter:', error);
                    }
                });
            }
        });

        // disable the radio buttons when the page is not fully loaded added
        $('input[name="locationByRadio"]').prop('disabled', true); 
        $(document).ready(function () {
            // Enable the radio buttons when the page is fully loaded
            $('input[name="locationByRadio"]').prop('disabled', false); 
        });
    </script>
@endpush
