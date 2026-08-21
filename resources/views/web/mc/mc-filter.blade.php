 <div class="container filter-contain mt-3">
     <div class="accordion custom_accordian" id="accordionExample">
         <div class="card">
             <div class="card-header public_filter_accordian" id="headingOne">

                 <div class="pub_heading " data-toggle="collapse" data-target="#collapseSearch" aria-expanded="true"
                     aria-controls="collapseSearch">
                     <h2>
                         <span class="pub_filter_icon">
                             <svg width="20px" height="20px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
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
                                     <rect class="cls-1" x="3.41" y="6.27" width="13.36" height="5.73"
                                         rx="2.86">
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
                         </span> Find Massage Centre
                     </h2>

                     <i class="fa fa-angle-down"></i>
                 </div>

             </div>

             <div id="collapseSearch" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                 <div class="card-body">
                     <div class="search_filters">
                         <div class="search_filters_inside">
                             <form method="" action="" id="filterForm">
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
                                         <span class="reshuffle_tag"> <svg width="15px" height="15px"
                                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <path
                                                         d="M4.51555 7C3.55827 8.4301 3 10.1499 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3V6M12 12L8 8"
                                                         stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round"></path>
                                                 </g>
                                             </svg> Listings reshuffle every
                                             30 minutes. </span>
                                     </div>

                                     <div class="col-lg-12">
                                         <div class="row align-items-center">
                                             <div class="col-lg-2 location_items mb-1">
                                                 <div class="location_radio_filter">
                                                     <div class="d-flex align-items-start" style="padding-top: 2px;">
                                                         <input type="radio" name="locationByRadio"
                                                             value="your_location" id="yourLocation"
                                                             class="location-radio">
                                                         <label for="yourLocation"
                                                             style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                             Your Location
                                                         </label>
                                                     </div>

                                                     <div class="d-flex align-items-start">
                                                         <input type="radio" name="locationByRadio" value="australia"
                                                             class="location-radio" checked id="australia">
                                                         <label for="australia"
                                                             style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7;">
                                                             Australia
                                                         </label>
                                                     </div>
                                                 </div>
                                             </div>
                                             {{-- search --}}
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

                                                     <input type="hidden" name="lat" id="set_lat"
                                                         value="">
                                                     <input type="hidden" name="lng" id="set_lng"
                                                         value="">
                                                 </div>
                                             </div>


                                             <div class="col-lg-5 display_items mb-1">
                                                 <div class="item_dis">
                                                     <span class="item-head">Display item</span>
                                                     <select class="custome_form_control_border_radus padding_five_px"
                                                         name="per_page" id="per_page" name="limit">
                                                         <option value="25">25</option>
                                                         <option value="50">50</option>
                                                         <option value="75">75</option>
                                                         <option value="100">100</option>
                                                     </select>
                                                 </div>


                                                 <div>
                                                     <button type="button"
                                                         class="pub_view_shortlist filter-tooltip-wrap" id="v_wishlist">
                                                         <a href="{{ route('find.massage.shortlist') }}"
                                                             class="text-decoration-none">
                                                             <div
                                                                 class="d-flex align-items-center justify-content-center gap-5">
                                                                 <i class="fa fa-list" aria-hidden="true"
                                                                     style="line-height: 23px;"></i>
                                                                 <span class="badge badge-pill badge-danger"
                                                                     id="session_count">

                                                                     @if (count(session('wishlist', [])) > 0)
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
                                                     <a type="submit" href="javascript:void(0);"
                                                         class="pub_secondary_btn clear_short_list"
                                                         data-toggle="tooltip" title="">
                                                         <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 8L16 16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 8L8 16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> Clear Shortlist
                                                     </a>
                                                 </div>

                                             </div>
                                         </div>






                                     </div>
                                 </div>
                                 {{-- row end --}}

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


                                     <div class="display_inline_block mb-1 mr-2">
                                         <select class="custome_form_control_border_radus padding_five_px"
                                             id="profile_age" name="profile_age">
                                             <option value="" selected>All Ages</option>
                                             <option value="18-25"
                                                 {{ request()->get('age') == '18-25' ? 'selected' : '' }}>
                                                 18 -
                                                 25</option>
                                             <option value="26-35"
                                                 {{ request()->get('age') == '26-35' ? 'selected' : '' }}>
                                                 26 -
                                                 35</option>
                                             <option value="36-45"
                                                 {{ request()->get('age') == '36-45' ? 'selected' : '' }}>
                                                 36 -
                                                 45</option>
                                             <option value="46-80"
                                                 {{ request()->get('age') == '46-80' ? 'selected' : '' }}>
                                                 Over
                                                 45</option>
                                         </select>
                                     </div>


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
                                     <div class="display_inline_block mb-1 mr-2 ">
                                         <input type="hidden" name="apply_pagination_rule"
                                             id="apply_pagination_rule" value="0">
                                         <button type="button"
                                             class="pub_primary_btn lower_filter reset_form_filter">
                                             <svg width="18px" height="18px" viewBox="0 0 21 21"
                                                 xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"
                                                 stroke-width="1.365">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <g fill="none" fill-rule="evenodd" stroke="#FF3C5F"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         transform="matrix(0 1 1 0 2.5 2.5)">
                                                         <path
                                                             d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8">
                                                         </path>
                                                         <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)"></path>
                                                     </g>
                                                 </g>
                                             </svg> Reset
                                         </button>
                                     </div>

                                     <div class="display_inline_block mb-1">
                                         <button type="button" class=" pub_secondary_btn  lower_filter">
                                             <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <path d="M15 15L21 21" stroke="#FF3C5F" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"></path>
                                                     <path
                                                         d="M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                                         stroke="#FF3C5F" stroke-width="2"></path>
                                                 </g>
                                             </svg> Search
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
                                     <div class="mc_type_btn">
                                         <div class="grid_list_icon_box display_inline_block grid--btn"
                                             id="view_grid">
                                             <span class="custom-toltip">Grid View</span>
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                  viewBox="0 0 30 30" fill="none">
                                                 <path
                                                     d="M25.625 2.11719H20.625C19.2443 2.11719 18.125 3.23648 18.125 4.61719V9.61719C18.125 10.9979 19.2443 12.1172 20.625 12.1172H25.625C27.0057 12.1172 28.125 10.9979 28.125 9.61719V4.61719C28.125 3.23648 27.0057 2.11719 25.625 2.11719Z"
                                                     stroke="#526174" stroke-width="3" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                                 <path
                                                     d="M9.375 18.3672H4.375C2.99429 18.3672 1.875 19.4865 1.875 20.8672V25.8672C1.875 27.2479 2.99429 28.3672 4.375 28.3672H9.375C10.7557 28.3672 11.875 27.2479 11.875 25.8672V20.8672C11.875 19.4865 10.7557 18.3672 9.375 18.3672Z"
                                                     stroke="#526174" stroke-width="3" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                                 <path
                                                     d="M25.625 18.3672H20.625C19.2443 18.3672 18.125 19.4865 18.125 20.8672V25.8672C18.125 27.2479 19.2443 28.3672 20.625 28.3672H25.625C27.0057 28.3672 28.125 27.2479 28.125 25.8672V20.8672C28.125 19.4865 27.0057 18.3672 25.625 18.3672Z"
                                                     stroke="#526174" stroke-width="3" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                                 <path
                                                     d="M9.375 2.11719H4.375C2.99429 2.11719 1.875 3.23648 1.875 4.61719V9.61719C1.875 10.9979 2.99429 12.1172 4.375 12.1172H9.375C10.7557 12.1172 11.875 10.9979 11.875 9.61719V4.61719C11.875 3.23648 10.7557 2.11719 9.375 2.11719Z"
                                                     stroke="#526174" stroke-width="3" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                             </svg>

                                         </div>
                                         <div class="grid_list_icon_box display_inline_block list-btn" id="view_list">

                                             <span class="custom-toltip">List View</span>
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                  viewBox="0 0 27 24" fill="none">
                                                 <path
                                                     d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                                     stroke="#526174" stroke-width="3" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                             </svg>

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
                                     <li class="help_icons">
                                         <div><span><img
                                                     src="{{ asset('assets/app/img/verify/verified_icon_dark.png') }}"
                                                     alt="verified icon" /></span> Represents that the Advertiser's
                                             Media has been Verified by E4U. </div>
                                     </li>
                                     <li class="help_icons">
                                         <div><span><img
                                                     src="{{ asset('assets/app/img/verify/e4u_pending-icon.png') }}"
                                                     alt="verified icon" /> </span> Represents that the Advertiser's
                                             Media has been submitted for verification and is pending with E4U. </div>
                                     </li>
                                     <li class="help_icons">
                                         <div><span><img
                                                     src="{{ asset('assets/app/img/verify/unverified_icon_dark.png') }}"
                                                     alt="verified icon" /> </span> Represents that the Advertiser's
                                             Media has not been submitted to E4U for verification, or has been rejected.
                                         </div>
                                     </li>
                                 </ol>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
