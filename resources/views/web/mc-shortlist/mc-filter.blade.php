 <div class="container filter-contain mt-3">
        <div class="accordion custom_accordian" id="accordionExample">
            <div class="card">
                <div class="card-header all_filter_accordain" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left btn-search" type="button" data-toggle="collapse"
                            data-target="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
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
                                        <div class="col-lg-12 mb-2 d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="custom-search-help mb-2 ">
                                                <h5 class="normal_heading mb-0">Filters</h5>
                                                <div class="display_inline_block helpquation">
                                                    <a href="#" data-toggle="modal" data-target="#forhelp">
                                                        Help <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <span class="reshuffle_tag">Listings reshuffle every
                                                30 minutes. </span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row align-items-center">                                                
                                                <div class="col-lg-2 location_items mb-1">
                                                    <div class="location_radio_filter">
                                                        <div class="d-flex align-items-start" style="padding-top: 2px;">
                                                            <input type="radio" name="locationByRadio" 
                                                                value="your_location" id="yourLocation">
                                                            <label for="yourLocation"
                                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                                Your Location
                                                            </label>
                                                        </div>

                                                        <div class="d-flex align-items-start">
                                                            <input type="radio" name="locationByRadio" value="australia" checked="checked"
                                                                id="australia">
                                                            <label for="australia"
                                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7;">
                                                                Australia
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-5 search_items mb-1">
                                                    <div
                                                        class="input-group custome_form_control managefilter_search_btn_style rounded search_btn_profile custom_search_btn_profile">

                                                        <!-- Hidden input to hold selected search type -->
                                                        <input type="hidden" name="search_by_radio" id="search_by_radio"
                                                            value="0">

                                                        <!-- Search input -->
                                                        <input type="search" name="by_name_member" id="by_name_member"
                                                            class="form-control remove_border_btm rounded"
                                                            placeholder="Search by Member ID or Name" aria-label="Search"
                                                            aria-describedby="search-addon" value="">

                                                        <!-- Search button -->
                                                        <button
                                                            class="input-group-text border-0 remove_bg_color_of_search_btn custom-profile-search-btn upper_filter"
                                                            id="search-addon" type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>

                                                            <input type="hidden" name="lat" id="set_lat" value="">
                                                            <input type="hidden" name="lng" id="set_lng" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 display_items mb-1">                                                        
                                                    <div class="item_dis">
                                                        <span class="item-head">Display item</span>
                                                        <select class="custome_form_control_border_radus padding_five_px" name="per_page" id="per_page"
                                                            name="limit">
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="75">75</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>
                                                    
                                                    {{-- <div class="custom-refreshbuton">
                                                        <div>
                                                            <input type="hidden" name="apply_pagination_rule"
                                                                id="apply_pagination_rule" value="0">
                                                            <button type="button"
                                                                class="btn reset_filter filter-tooltip-wrap apply_pagination_button upper_filter"
                                                                data-toggle="tooltip" title="" id="">
                                                                <span class="filter-tooltip">Apply Change</span>
                                                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div> --}}
                                                    
                                                    <div>
                                                        <button type="button" class="btn reset_filter filter-tooltip-wrap"
                                                            id="v_wishlist">
                                                            <a href="{{ route('find.massage.shortlist') }}"
                                                                class="text-decoration-none">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center gap-5">
                                                                    <i class="fa fa-list" aria-hidden="true"
                                                                        style="line-height: 23px;"></i>
                                                                    <span class="badge badge-pill badge-danger" id="session_count">

                                                                        @if(count(session('wishlist', [])) > 0)
                                                                            {{ count(session('wishlist', [])) }} 
                                                                        @else
                                                                        {{ 0 }}    
                                                                        @endif

                                                                    </span>
                                                                </div>
                                                                <span class="filter-tooltip">View Shortlist</span>
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <a type="submit" href="{{ route('web.massage-show-list') }}"
                                                            class="btn reset_filter " data-toggle="tooltip" title="">
                                                            Clear Shortlist
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="fiter_btns slect__btn_tab pb-2">
                                        <div class="display_inline_block mb-1 mr-2">
                                            <select class="custome_form_control_border_radus padding_five_px"
                                                id="profile_city" name="profile_city">
                                                <option value="" selected>All Cities</option>
                                                @foreach (@config('escorts.profile.cities') as $key => $city)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('city') == $key ? 'selected' : '' }}>
                                                    {{ $city }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- <div class="display_inline_block mb-1 mr-2">
                                            <select class="custome_form_control_border_radus padding_five_px"
                                                id="profile_state"  name="profile_state">
                                                @foreach (@config('escorts.profile.premises') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('premises') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <!-- <div class="display_inline_block mb-1 mr-2">
                                            <select class="custome_form_control_border_radus padding_five_px"
                                                id="masseur_types" name="masseur_types">
                                                @foreach (@config('escorts.profile.masseur-types') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('masseur_types') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div> -->


                                        <div class="display_inline_block mb-1 mr-2">
                                            <select class="custome_form_control_border_radus padding_five_px"
                                                id="profile_age" name="profile_age">
                                                <option value="" selected>All Ages</option>
                                                <option
                                                    value="18-25" {{ request()->get('age') == '18-25' ? 'selected' : '' }}>
                                                    18 -
                                                    25</option>
                                                <option
                                                    value="26-35" {{ request()->get('age') == '26-35' ? 'selected' : '' }}>
                                                    26 -
                                                    35</option>
                                                <option
                                                    value="36-45" {{ request()->get('age') == '36-45' ? 'selected' : '' }}>
                                                    36 -
                                                    45</option>
                                                <option
                                                    value="46-80" {{ request()->get('age') == '46-80' ? 'selected' : '' }}>
                                                    Over
                                                    45</option>
                                            </select>
                                        </div>

                                        <!-- <div class="display_inline_block mb-1 mr-2">
                                            <select class="custome_form_control_border_radus padding_five_px"
                                                id="profile_price" name="profile_price"
                                                value="{{ request()->get('prices') }}">
                                                @foreach (@config('escorts.profile.prices') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('prices') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <div class="display_inline_block mb-1 mr-2">
                                            <select
                                                class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                id="massage_services" name="massage_services">
                                                <option value="">All Massage Services</option>
                                                @foreach (@config('escorts.profile.massage-services') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('massage_services') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="display_inline_block mb-1 mr-2">
                                            <select
                                                class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                id="other_services" name="other_services">
                                                <option value="">All Other Service Types</option>
                                                @foreach (@config('escorts.profile.other-services') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ request()->get('other_services') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="display_inline_block mb-1 mr-2">
                                            <select
                                                class="custome_form_control_border_radus padding_five_px with_eight_em"
                                                id="verification" name="verification">
                                                <option value="all">Verification</option>
                                                <option value="unverified">Unverified</option>
                                                <option value="verified">Verified</option>
                                            </select>
                                        </div>
                                        <div class="display_inline_block mb-1 mr-2">
                                            <button type="button" class="btn reset_filter lower_filter">
                                                Search
                                            </button>
                                        </div>
                                        <div class="display_inline_block mb-1">
                                        <input type="hidden" name="apply_pagination_rule"
                                                             id="apply_pagination_rule" value="0">
                                         <button type="button" class="btn reset_filter lower_filter reset_form_filter">
                                             Reset
                                         </button>
                                     </div>
                                    </div>
                                </form>
                                <div class="row grid_list_part p-0 m-0">
                                    <div
                                        class="col-12 custom--service-tag mc_tags d-flex justify-content-between align-items-center">
                                        <div class="total--list">
                                            <strong>Total Listings:</strong>
                                            <span class="total_count"></span>
                                        </div>
                                        <div class="grd_lst_filter_btn">
                                            <div class="grid_list_icon_box display_inline_block grid--btn">
                                                <a href="javascript:void(0)" class="" id="view_grid">
                                                    <span class="custom-toltip">Grid View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 30 30" fill="none">
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
                                                <a href="javascript:void(0)" id="view_list">
                                                    <span class="custom-toltip">List View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="27"
                                                        height="24" viewBox="0 0 27 24" fill="none">
                                                        <path
                                                            d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
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
        <div class="modal fade defult-modal" id="forhelp">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content rounded-0">
                    <!-- Modal body -->
                    <div class="modal-body p-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class=" ">
                        </button>
                        <h3><img src="{{ asset('assets/app/img/help.png') }}" class="custompopicon">Help</h3>
                        <div class="modal-sec help--filter">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">Search Filters</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">Search Field</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                        aria-selected="false">Shortlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab"
                                        aria-selected="false">Service Tags</a>
                                </li>
                                
                             <li class="nav-item">
                                 <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab"
                                     aria-selected="false">Verification</a>
                             </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-3 active show" id="tabs-1" role="tabpanel">
                                    <p>Your Geolocation will automatically determine your Location and list Profiles
                                        according to that Location. You can:</p>
                                    <ol class="pl-3">
                                        <li>Filter the search criteria by selecting your preferred filter and then
                                            selecting the refresh button ‘Apply Filters’.</li>
                                        <li>Change your Location by selecting your preferred city.</li>
                                        <li>Change the number of listings displayed by changing the ‘Displayed item’
                                            filter to your
                                            preferred value.</li>
                                    </ol>
                                </div>
                                <div class="tab-pane p-3" id="tabs-2" role="tabpanel">
                                    <ol class="pl-3">
                                        <li>You can undertake a search for an Massage Centre within your Location, which
                                            is the default, or Australia wide
                                            by selecting ‘Australia’.</li>
                                        <li>Searching by Member ID is the most efficient manner. </li>
                                    </ol>
                                </div>
                                <div class="tab-pane p-3" id="tabs-3" role="tabpanel">
                                    <p>The Shortlist feature will only remain current for the session. You can:</p>
                                    <ol class="pl-3">
                                        <li>Add or remove Profiles by clicking the Short List button displayed on the
                                            Profile.</li>
                                        <li>To view your Shortlist, click the List tally that is located in the Search
                                            Filters panel.</li>
                                        <li>To clear the Shortlist, click the ‘Clear Shortlist’ button in the Search
                                            Filters panel.</li>
                                    </ol>
                                </div>
                                <div class="tab-pane p-3" id="tabs-4" role="tabpanel">
                                    <ol class="pl-3">
                                        <li>Your selected Service Tags will be listed below the Service Tag selection
                                            list in the panel.</li>
                                        <li>You can remove any Service Tag you selected by clicking the ‘X’ located on
                                            the tag, or all of
                                            the Service Tags you selected by clicking the ‘Clear Tags’ link in the
                                            panel.</li>
                                    </ol>
                                </div>
                                                            
                             <div class="tab-pane p-3" id="tabs-5" role="tabpanel">
                                <ol class="pl-3">
                                    <li class="help_icons"> <div><span><img src="{{ asset('assets/app/img/verify/verified_icon_dark.png') }}"  alt="verified icon" /></span>  Represents that the Advertiser's Media has been Verified by E4U. </div></li>
                                    <li class="help_icons"> <div><span><img src="{{ asset('assets/app/img/verify/e4u_pending-icon.png') }}"  alt="verified icon" /> </span> Represents that the Advertiser's Media has been submitted for verification and is pending with E4U. </div></li>
                                    <li class="help_icons"> <div><span><img src="{{ asset('assets/app/img/verify/unverified_icon_dark.png') }}"  alt="verified icon" /> </span> Represents that the Advertiser's Media has not been submitted to E4U for verification, or has been rejected. </div></li>
                                </ol>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>