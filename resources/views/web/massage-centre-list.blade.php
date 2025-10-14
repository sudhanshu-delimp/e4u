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

        .list-view {
            padding-top: 25px;
            padding-bottom: 30px;
        }

        .custom--service-tag {
            display: flex !important;
            gap: 10px !important;
        }
    </style>
@endsection
@section('content')
    <section class="">
        <div class="container filter-contain">
            <div class="search_filters">
                <div class="search_filters_inside">
                    <form method="" action="">
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
                                <span style="color:#FF3349">Listings reshuffle every 15 minutes. </span>
                            </div>
                            <div class="col-md-8 ryt_srch_btn">
                                <div class="display_inline_block">
                                    <div class="d-flex flex-column gap-2" style="width:105px;">
                                        <div class="d-flex align-items-start" style="padding-top: 2px;"
                                            title="Undertake a search within your Location only">
                                            <input type="radio" name="locationByRadio" checked="checked"
                                                value="your_location" id="yourLocation">
                                            <label for="yourLocation"
                                                style="margin-left: 8px; font-size: 12px; margin-top: -3px; color: #90a0b7; margin-bottom: 7px;">
                                                Your Location
                                            </label>
                                        </div>

                                        <div class="d-flex align-items-start" title="Undertake a search Australia wide">
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
                                                class="btn reset_filter toltip-parent apply_pagination_button"
                                                data-toggle="tooltip" title="" id="">
                                                <span class="custom-toltip">Apply Change</span>
                                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="display_inline_block">
                                    <div class="margin_btn_reset">
                                        <button type="button" class="btn reset_filter toltip-parent" id="v_wishlist">
                                            <a href="{{ route('find.massage.centre') }}" data-toggle="tooltip"
                                                title=""> <i class="fa fa-list" aria-hidden="true"></i>
                                                <span class="custom-toltip">View Shortlist</span>
                                                <span class="badge badge-pill badge-danger" id="session_count">0</span>
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
                                    <option value="">All massage services</option>
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
                                    <option value="">All other service types</option>
                                    @foreach (@config('escorts.profile.other-services') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request()->get('other_services') == $key ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="display_inline_block mb-1 mr-2">
                                <button type="button" class="btn verified_btn_bg_color verified_text_color"
                                    data-toggle="tooltip" title="View Verified Photos only">
                                    <img src="{{ asset('assets/img/e4u-verified-dark.png') }}">
                                </button>
                            </div>
                            <div class="display_inline_block mb-1">
                                <button type="submit" class="btn reset_filter" data-toggle="tooltip"
                                    title="Apply filters - Search
                                ">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                        {{-- <div class="row pr-3" style="float: right;">
                        <div class="display_inline_block mb-1 mr-2">
                            <button type="button" class="btn verified_btn_bg_color verified_text_color" data-toggle="tooltip" title="View Verified Photos only">
                            <img src="{{ asset('assets/img/e4u-verified-dark.png')}}">
                            </button>
                        </div>
                        <div class="display_inline_block mb-1 mr-2">
                            <button type="submit" class="btn reset_filter" data-toggle="tooltip" title="Apply filters - Search
                                ">
                            Apply Filters
                            </button>
                        </div>
                    </div> --}}

                    </form>
                    <div class="row grid_list_part p-0 m-0">
                        <div class="col-12 custom--service-tag mb-3">
                            <div class="total--list">
                                <strong>Total Listings:</strong>
                                <span>{{count($escorts)}}</span>
                            </div>
                            <div class="grid_list_icon_box display_inline_block grid--btn" data-toggle="modal1"
                                data-target="#" data-url="grid-escort-list">
                                <a href="#" class="active" id="grid-modal" data-toggle="tooltip"
                                    title="Grid view">
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
                                    <!--  <img src="{{ asset('assets/app/img/grid-pic.svg') }}"> -->
                                </a>
                            </div>
                            <div class="grid_list_icon_box display_inline_block list-btn">
                                <a href="#" class=" " id="grid-list" data-toggle="tooltip"
                                    title="List view">
                                    <span>List view</span>
                                    <!-- <img src="{{ asset('assets/app/img/line.svg') }}"> -->
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
            <!-- ================     service provider start here     ========================= -->

            {{-- <div class="modal defult-modal" id="forhelp"> --}}
            <div class="modal fade defult-modal" id="forhelp"> 
                <div class="modal-dialog modal-dialog-centered">
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
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane p-3 active show" id="tabs-1" role="tabpanel">
                                        <p>Your Geolocation will automatically determine your Location and list Profiles according to that Location. You can:</p>
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
                                            <li>You can undertake a search for an Massage Centre within your Location, which is the default, or Australia wide
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="grid-template" class="text-center"></div>

            <div class="space_between_row" style="display:block">
                <div class="row responsive_colums_in_lg_five_col escost_list">
                    @foreach ($escorts as $key => $escort)
                        {{-- @if ($key <= 4) --}}
                        <?php $pName[] = explode(' ', $escort->name); ?>
                        @include('web.partials.grid.massage-gold')
                        {{-- @endif --}}
                    @endforeach
                </div>
            </div>
            <div class="grid list-view " style="display: none">
                @foreach ($escorts as $key => $escort)
                    {{-- @if ($key <= 2) --}}
                    <?php $pName[] = explode(' ', $escort->name); ?>
                    @include('web.partials.list.massage-gold')
                    {{-- @endif --}}
                @endforeach
            </div>
        </div>

        </div>
        </div>
        <div class="modal hh" id="add_wishlist" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/dashboard/img/short-list-profile.png') }}"
                            class="custompopicon"> Add To Shortlist</h5>
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
        <div class="modal hh" id="my_legbox" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"><img src="{{ asset('assets/app/img/my-legbox.png') }}"
                            class="custompopicon"> My Legbox</h5>
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
{{-- {!! $escorts->links('pagination::bootstrap-4') !!} --}}

         {{-- <nav aria-label="Page navigation" class="custom-pagination">
                <ul class="d-flex justify-content-center list-unstyled">

                    <li class="mx-1 {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->url(1) }}"
                        style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                            <i class="fa fa-angle-double-left"></i> First
                        </a>
                    </li>

                    <li class="mx-1 {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}"
                        style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                            <i class="fa fa-angle-left"></i> Previous
                        </a>
                    </li>

                    @php
                        $total = $paginator->lastPage();
                        $current = $paginator->currentPage();
                        $start = max(1, $current - 2);
                        $end = min($total, $current + 2);
                    @endphp

                    @if($start > 1)
                        <li class="disabled mx-1"><span>...</span></li>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        <li>
                            <a href="{{ $paginator->url($i) }}"
                                        style="background-color: {{ $i == $paginator->currentPage() ? '#F2F2F2' : '#0C223d'}}; font-weight: {{ $i == $paginator->currentPage() ? 'bold' : 'normal' }}; color: {{ $i == $paginator->currentPage() ? '#ff3c5f' : '#fff' }};">
                                            {{ $i }}
                                        </a>
                        </li>
                    @endfor
                    @if($end < $total)
                        <li class="disabled mx-1"><span>...</span></li>
                    @endif

                    <li class="mx-1 {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                        <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}"
                        style="{{ !$paginator->hasMorePages() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                            Next <i class="fa fa-angle-right"></i>
                        </a>
                    </li>

                    <li class="mx-1 {{ $current == $total ? 'disabled' : '' }}">
                        <a href="{{ $current == $total ? '#' : $paginator->url($total) }}"
                        style="{{ $current == $total ? 'pointer-events:none; opacity:0.5;' : '' }}">
                            Last <i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>

                </ul>
            </nav> --}}

    </section>
@endsection
@push('scripts')
    <script>
        $('#grid-modal').on('click', function() {

            var val = $('#grid-modal').attr('class');
            $('.preChanges').text('MASSAGE CENTRE GRID VIEW')
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
            //    

        });
        $('#grid-list').on('click', function() {
            var grid = $('#grid-list').attr('class');
            $('.preChanges').text('MASSAGE CENTRE List VIEW')
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

        $('#resetAll').click(function() {
            $("#selectedService li").remove();
            $("ul input").remove();
        });

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
            var url = "{{ route('web.save.mcMyShortListCart', ':id') }}";
            url = url.replace(':id', Eid);

            console.log(Uid);
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    escortId: Eid,
                    userId: Uid
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data) {
                    console.log("count = " + data.count_session);
                    console.log(data);
                    if (data.error == 1) {

                        $('.class_msg').text(name + ' has been added to your Shortlist');
                        $('#add_wishlist').modal('show');
                        $('.myescort_' + Eid).html(
                            '<img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}"> Remove from Shortlist'
                            )
                        $('#session_count').text(data.count_session);
                        //

                    } else {

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
                            success: function(data) {
                                console.log(data);
                                if (data.error == 1) {
                                    $('.class_msg').text(name +
                                        ' has been remove from your Shortlist');
                                    $('#add_wishlist').modal('show');
                                    $('.myescort_' + Eid).html(
                                        '<img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}"> Add to Shortlist'
                                        )
                                    $('#session_count').text(data.count_session);
                                }

                            }
                        });

                    }
                }
            });


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

                    }


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

                var login_url = "{!! route('viewer.login', [':id', ':path']) !!}";
                var regurl = "{{ route('register', ':id') }}";
                var loginurl = login_url.replace(':id', 'MclegboxId=' + Eid);
                var loginurl2 = loginurl.replace(':path', 'path=' + window.location.pathname);
                console.log(loginurl2);
                regurl = regurl.replace(':id', 'MclegboxId=' + Eid)
                $('#loginUrl').attr('href', loginurl2)
                $('#regUrl').attr('href', regurl)
            }



            console.log(cid[1] + "-" + Eid);
            console.log(cidcl);

        });
    </script>
@endpush
