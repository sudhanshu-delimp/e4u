<div class="accordion custom_accordian" id="accordionExample">
    <div class="card">
        <div class="card-header all_filter_accordain" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-block text-left btn-search" type="button" data-toggle="collapse"
                    data-target="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
                    Find Escorts
                    <i class="fa fa-angle-down"></i>
                </button>
            </h2>
        </div>

        <div id="collapseSearch" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="search_filters">
                    <div class="search_filters_inside">
                        <form id="filterForm" method="" action="">

                            {{-- Existing line --}}
                            <input type="hidden" name="view_type" id="view_type"
                                value='{{ isset($viewType) && $viewType == 'list' ? 'list' : 'grid' }}'>

                            {{-- ADD THIS LINE below it --}}
                            <input type="hidden" name="viewType" id="viewType_input"
                                value='{{ isset($viewType) && $viewType == 'list' ? 'list' : 'grid' }}'>
                            <div class="row">
                                <div
                                    class="col-lg-12 mb-2 d-flex align-items-center justify-content-between flex-wrap ">
                                    <div class="custom-search-help mb-2 ">
                                        <h5 class="normal_heading mb-0">Filters</h5>
                                        <div class="display_inline_block helpquation">
                                            <a href="#" data-toggle="modal" data-target="#forhelp">
                                                Help <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="reshuffle_tag">Listings reshuffle every
                                        30 minutes.</span>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2 location_items mb-1">
                                            {{-- location --}}
                                            <div class="location_radio_filter">
                                                <div class="d-flex align-items-start" style=" padding-top: 2px;">
                                                    <input type="radio" name="locationByRadio" value="your_location"
                                                        id="yourLocation">
                                                    <label for="yourLocation"
                                                        style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                        Your Location
                                                    </label>
                                                </div>

                                                <div class="d-flex align-items-start">
                                                    <input type="radio" name="locationByRadio" value="australia"
                                                        id="australia" checked>
                                                    <label for="australia"
                                                        style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7;">
                                                        Australia
                                                    </label>
                                                </div>
                                            </div>
                                            {{-- end --}}
                                        </div>
                                        <div class="col-lg-5 search_items mb-1">
                                            {{-- search --}}
                                            <div
                                                class="input-group custome_form_control managefilter_search_btn_style rounded  search_btn_profile custom_search_btn_profile">

                                                <input type="hidden" name="search_by_radio" id="search_by_radio"
                                                    value="0">
                                                <input type="hidden" name="lat" id="set_lat" value="">
                                                <input type="hidden" name="lng" id="set_lng" value="">

                                                <input type="search" name="search_by_member_id_and_name"
                                                    id="search_by_member_id_and_name"
                                                    class="form-control remove_border_btm rounded "
                                                    placeholder="Search by Member ID or Name" aria-label="Search"
                                                    aria-describedby="search-addon" value="">

                                                <button
                                                    class="input-group-text border-0 remove_bg_color_of_search_btn custom-profile-search-btn searchEscort"
                                                    id="searchEscort" type="submit">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            {{-- end --}}
                                        </div>
                                        <div class="col-lg-5 display_items mb-1">
                                            {{-- display list --}}
                                            <div class="item_dis">
                                                <span class="item-head">Display item</span>
                                                <select class="custome_form_control_border_radus padding_five_px"
                                                    name="limit" id="limit">

                                                    <option value="25"
                                                        {{ request()->get('limit') == 25 ? 'selected' : '' }}>25
                                                    </option>
                                                    <option value="50"
                                                        {{ request()->get('limit') == 50 ? 'selected' : '' }}>50
                                                    </option>
                                                    <option value="75"
                                                        {{ request()->get('limit') == 75 ? 'selected' : '' }}>75
                                                    </option>
                                                    <option value="100"
                                                        {{ request()->get('limit') == 100 ? 'selected' : '' }}>
                                                        100
                                                    </option>
                                                </select>

                                            </div>
                                            {{-- end --}}

                                            {{-- view short list btn --}}
                                            <button type="button" class="btn reset_filter filter-tooltip-wrap"
                                                id="v_wishlist">
                                                <a href="{{ route('web.show.showAddList') }}"
                                                    class="text-decoration-none">
                                                    <div
                                                        class="d-flex align-items-center justify-content-center gap-5">
                                                        <i class="fa fa-list" aria-hidden="true"
                                                            style="line-height: 22px;"></i>
                                                        <span class="badge badge-pill badge-danger"
                                                            id="session_count">{{ $count_session ?? '0' }}</span>
                                                    </div>
                                                    <span class="filter-tooltip">View Shortlist</span>
                                                </a>
                                            </button>
                                            {{-- end --}}

                                            {{-- clear short --}}
                                            @php
                                                $query = Arr::except(request()->query(), ['ipinfo']);

                                            @endphp
                                            <a type="submit" href="javascript:void(0)" id="clear_all_escort_list"
                                                class="btn reset_filter " data-toggle="tooltip">
                                                Clear Shortlist
                                            </a>
                                            {{-- end --}}
                                        </div>
                                    </div>
                                    {{-- row 2 --}}
                                </div>
                            </div>
                            {{-- row end 1 --}}

                            <div class="fiter_btns slect__btn_tab">
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px" id="escort_city"
                                        name="city">
                                        <option value="" selected>All Cities</option>
                                        @foreach (@config('escorts.profile.cities') as $key => $city)
                                            <option value="{{ $key }}"
                                                {{ $locationCityId == $key ? 'selected' : '' }}>
                                                {{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px"
                                        id="escort_gender" name="gender">
                                        <option value="" selected>All Genders</option>
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
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px" id="escort_age"
                                        name="age">
                                        <option value="" selected>All Ages</option>
                                        <option
                                            value="18-25"{{ request()->get('age') == '18-25' ? 'selected' : '' }}>
                                            18 - 25
                                        </option>
                                        <option
                                            value="26-35"{{ request()->get('age') == '26-35' ? 'selected' : '' }}>
                                            26 - 35
                                        </option>
                                        <option
                                            value="36-45"{{ request()->get('age') == '36-45' ? 'selected' : '' }}>
                                            36 - 45
                                        </option>
                                        <option
                                            value="46-80"{{ request()->get('age') == '46-80' ? 'selected' : '' }}>
                                            Over 45
                                        </option>
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px"
                                        id="escort_price" name="price" value="{{ request()->get('price') }}">
                                        <option value="" selected>Any Price</option>
                                        <option
                                            value="300"{{ request()->get('price') == '300' ? 'selected' : '' }}>
                                            Up to $ 300
                                        </option>
                                        <option
                                            value="500"{{ request()->get('price') == '500' ? 'selected' : '' }}>
                                            Up to $ 500
                                        </option>
                                        <option
                                            value="800"{{ request()->get('price') == '800' ? 'selected' : '' }}>
                                            Up to $ 800
                                        </option>
                                        <option
                                            value="800"{{ request()->get('price') == '800' ? 'selected' : '' }}>
                                            Over $ 800
                                        </option>
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                        id="escort_duration_price" name="duration_price"
                                        value="{{ request()->get('duration_price') }}">
                                        <option value="0">All Services</option>
                                        <option value="incall_price"
                                            {{ request()->get('duration_price') == 'incall_price' ? 'selected' : '' }}>
                                            In-calls</option>
                                        <option value="outcall_price"
                                            {{ request()->get('duration_price') == 'outcall_price' ? 'selected' : '' }}>
                                            Out-calls</option>
                                        <option value="massage_price"
                                            {{ request()->get('duration_price') == 'massage_price' ? 'selected' : '' }}>
                                            Massage</option>
                                    </select>
                                </div>

                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus with_eight_em"
                                        id="escort_playmate_status" name="playmate_status">
                                        <option value="">Playmates</option>
                                        <option value="with_playmates"
                                            {{ request()->get('playmate_status') == 'with_playmates' ? 'selected' : '' }}>
                                            With
                                        </option>
                                        <option value="without_playmates"
                                            {{ request()->get('playmate_status') == 'without_playmates' ? 'selected' : '' }}>
                                            Without</option>
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <select class="custome_form_control_border_radus padding_five_px with_eight_em"
                                        id="escort_varify_list"name="verify_list">
                                        <option value="all"
                                            {{ request()->get('verify_list') == 'all' ? 'selected' : '' }}>
                                            Verification</option>
                                        <option value="unverified"
                                            {{ request()->get('verify_list') == 'unverified' ? 'selected' : '' }}>
                                            Unverified</option>
                                        <option value="verified"
                                            {{ request()->get('verify_list') == 'verified' ? 'selected' : '' }}>
                                            Verified</option>
                                    </select>
                                </div>
                                <div class="display_inline_block mb-1 mr-2">
                                    <input type="hidden" name="filter_button_submit" value="1">
                                    <input type="hidden" name="view_type" id="view_type"
                                        value='{{ isset($viewType) && $viewType == 'list' ? 'list' : 'grid' }}'>
                                    <button type="submit" class="btn reset_filter apply-filter-btn"
                                        data-toggle="tooltip" id="applayFilter" title="">
                                        Search
                                    </button>
                                </div>
                                <div class="display_inline_block mb-1 ">
                                    <input type="hidden" name="apply_pagination_rule" id="apply_pagination_rule"
                                        value="0">
                                    <button type="submit"
                                        class="btn reset_filter apply_pagination_button   reset_form_filter"
                                        id="applayChange">
                                        Reset
                                    </button>
                                </div>
                            </div>

                            <!-- Service tags start -->
                            <div class="service_tagss">
                                <div class="row serve-row-one">
                                    <div class="col-md-12 custom--service-tag">
                                        <!-- accordien start here -->
                                        <div class="accordion-container-new mb-0">
                                            <div class="set mb-0">
                                                <a class=" py-lg-0 py-2 custom-accordion-title px-2">
                                                    Service Tags
                                                    <i class="fa fa-angle-down"></i>
                                                </a>

                                                <div class="content">
                                                    <div class="accodien_manage_padding_content">
                                                        <div class="display_inline_block mb-1 mr-1">
                                                            <select
                                                                class="custome_form_control_border_radus padding_five_px"
                                                                id="service_id_one">
                                                                <option value="">Fun Stuff - On Viewer
                                                                </option>
                                                                @foreach ($service_one as $key => $service)
                                                                    <option id="{{ $service->name }}"
                                                                        value="{{ $service->id }}"
                                                                        {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                        {{ $service->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="display_inline_block mb-1 mr-1">
                                                            <select
                                                                class="custome_form_control_border_radus padding_five_px"
                                                                id="service_id_two">
                                                                <option value="">Kinky Stuff - On Viewer
                                                                </option>
                                                                @foreach ($service_two as $key => $service)
                                                                    <option id="{{ $service->name }}"
                                                                        value="{{ $service->id }}"
                                                                        {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                        {{ $service->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="display_inline_block mb-1 mr-1">
                                                            <select
                                                                class="custome_form_control_border_radus padding_five_px"
                                                                id="service_id_three">
                                                                <option value="">Fun Stuff - On Escort
                                                                </option>
                                                                @foreach ($service_three as $key => $service)
                                                                    <option id="{{ $service->name }}"
                                                                        value="{{ $service->id }}"
                                                                        {{ request()->get('services') == $service->id ? 'selected' : '' }}>
                                                                        {{ $service->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="reset" id="resetAll" class="btn reset_filter"
                                                            value="Clear Tags">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- accordien end here -->

                                        <!-- Grid View -->

                                        <div class="grid_list_part " id="prosud aa" style="display: block;">

                                            @php
                                                $memberTitle = 'Total Listings';
                                                $memberTotalCountSum = array_sum($memberTotalCount);
                                                $memberTitleClass = '';

                                                if (request('membership_type') == '1') {
                                                    $memberTotalCountSum = $memberTotalCount[1];
                                                    $memberTitle = 'View Platinum Listings';
                                                    $memberTitleClass = 'selected-item';
                                                } elseif (request('membership_type') == '2') {
                                                    $memberTotalCountSum = $memberTotalCount[2];
                                                    $memberTitle = 'View Gold Listings';
                                                    $memberTitleClass = 'selected-item';
                                                } elseif (request('membership_type') == '3') {
                                                    $memberTotalCountSum = $memberTotalCount[3];
                                                    $memberTitle = 'View Silver Listings';
                                                    $memberTitleClass = 'selected-item';
                                                }
                                            @endphp
                                            <div class="last_filter_section">
                                                <div class="dropdown custom_total_list">
                                                    <span class="js-link {{ $memberTitleClass }}">
                                                        <div id="selectedListing"
                                                            class="d-flex justify-content-between align-items-center"
                                                            style="width: calc(100% - 20px); gap: 5px;">
                                                            <span id="">

                                                                {{ $memberTitle }} :

                                                            </span>
                                                            <span class="totalEscortListingCount">

                                                                {{ $memberTotalCountSum }}

                                                            </span>
                                                        </div>

                                                        <i class="fa fa-angle-down"></i>
                                                    </span>

                                                    <ul class="js-dropdown-list">

                                                        <!-- All Listings -->
                                                        <li
                                                            class="{{ !request()->has('membership_type') || request('membership_type') == '' ? 'active' : '' }}">
                                                            <a class="membership_list" href="javascript:void(0)"
                                                                onclick="getMemberWiseCount('all')">
                                                                <span class="firts-text">Total Listings
                                                                    :</span>
                                                                <span class="firts-text"
                                                                    class="totalEscortListingCount"
                                                                    id="totalEscortListingCount">{{ array_sum($memberTotalCount) }}</span>
                                                            </a>
                                                        </li>

                                                        <!-- Platinum -->
                                                        <li
                                                            class="{{ request('membership_type') == '1' ? 'active' : '' }}">
                                                            <a class="membership_list" href="javascript:void(0)"
                                                                onclick="getMemberWiseCount(1)">
                                                                <span>View Platinum Listings :</span>
                                                                <span
                                                                    id="p1_escort_count">{{ $memberTotalCount[1] }}</span>
                                                            </a>
                                                        </li>

                                                        <!-- Gold -->
                                                        <li
                                                            class="{{ request('membership_type') == '2' ? 'active' : '' }}">
                                                            <a class="membership_list" class="membership_list"
                                                                onclick="getMemberWiseCount(2)"
                                                                href="javascript:void(0)">
                                                                <span>View Gold Listings :</span>
                                                                <span
                                                                    id="g2_escort_count">{{ $memberTotalCount[2] }}</span>
                                                            </a>
                                                        </li>

                                                        <!-- Silver -->
                                                        <li
                                                            class="{{ request('membership_type') == '3' ? 'active' : '' }}">
                                                            <a class="membership_list" href="javascript:void(0)"
                                                                onclick="getMemberWiseCount(3)">
                                                                <span>View Silver Listings :</span>
                                                                <span
                                                                    id="s3_escort_count">{{ $memberTotalCount[3] }}</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                {{-- grid and list filter Btn --}}
                                                <div class="grd_lst_filter_btn">
                                                    <div class="grid_list_icon_box display_inline_block grid--btn"
                                                        data-toggle="modal1" data-target="#"
                                                        data-url="grid-escort-list">
                                                        <a href="javascript:void(0)" class="view-toggle"
                                                            class="{{ $viewType == 'grid' ? 'active' : '' }}"
                                                            id="grid-modal" data-toggle="tooltip">
                                                            <span class="custom-toltip">Grid View</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" viewBox="0 0 30 30" fill="none">
                                                                <path
                                                                    d="M25.625 2.11719H20.625C19.2443 2.11719 18.125 3.23648 18.125 4.61719V9.61719C18.125 10.9979 19.2443 12.1172 20.625 12.1172H25.625C27.0057 12.1172 28.125 10.9979 28.125 9.61719V4.61719C28.125 3.23648 27.0057 2.11719 25.625 2.11719Z"
                                                                    stroke="#0C223D" stroke-width="3"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.375 18.3672H4.375C2.99429 18.3672 1.875 19.4865 1.875 20.8672V25.8672C1.875 27.2479 2.99429 28.3672 4.375 28.3672H9.375C10.7557 28.3672 11.875 27.2479 11.875 25.8672V20.8672C11.875 19.4865 10.7557 18.3672 9.375 18.3672Z"
                                                                    stroke="#0C223D" stroke-width="3"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M25.625 18.3672H20.625C19.2443 18.3672 18.125 19.4865 18.125 20.8672V25.8672C18.125 27.2479 19.2443 28.3672 20.625 28.3672H25.625C27.0057 28.3672 28.125 27.2479 28.125 25.8672V20.8672C28.125 19.4865 27.0057 18.3672 25.625 18.3672Z"
                                                                    stroke="#0C223D" stroke-width="3"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.375 2.11719H4.375C2.99429 2.11719 1.875 3.23648 1.875 4.61719V9.61719C1.875 10.9979 2.99429 12.1172 4.375 12.1172H9.375C10.7557 12.1172 11.875 10.9979 11.875 9.61719V4.61719C11.875 3.23648 10.7557 2.11719 9.375 2.11719Z"
                                                                    stroke="#0C223D" stroke-width="3"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="grid_list_icon_box display_inline_block list-btn">
                                                        <a href="javascript:void(0)" class="view-toggle"
                                                            class="{{ $viewType == 'list' ? 'active' : '' }}"
                                                            id="grid-list" data-toggle="tooltip">
                                                            <span class="custom-toltip">List View</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="27"
                                                                height="24" viewBox="0 0 27 24" fill="none">
                                                                <path
                                                                    d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                                                    stroke="#0C223D" stroke-width="3"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>

                                        </div>

                                        <!-- Grid view end -->
                                    </div>

                                </div>
                                @php
                                    $services = request()->input('services') ?? [];
                                @endphp
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="selected_service_tag">
                                            <ul id="selectedService">
                                                {{-- @foreach ($all_services_tag as $key => $service_tag)
                                                    @if (in_array($service_tag->id, []))
                                                        @php $prev_services[] = $service_tag->id; @endphp
                                                        <li class='seleceted_service_text_and_icon' id='hideenclassOne_{{ $service_tag->id }}'>
                                                            <p>{{ $service_tag->name }}</p>
                                                            <i class='fa fa-times-circle-o akh1' data-sname='{{ $service_tag->name }}' data-val="{{ $service_tag->id }}" aria-hidden='true' id='id_{{ $service_tag->id }}'> </i>
                                                            <input type='hidden' name='services[]' value='{{ $service_tag->id }}'>
                                                        </li>
                                                    @endif
                                                @endforeach --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
