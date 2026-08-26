@extends('layouts.web')
@section('style')
    <style>
        #view_list svg path,
        #view_grid svg path {
            stroke: #000;
            transition: stroke 0.3s;
        }


        #view_list:hover svg path,
        #view_grid:hover svg path {
            stroke: #fff;
        }


        .view-active svg path {
            stroke: #ff3c5f !important;
        }

        #page_loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(12, 34, 61, 0.7);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #ff3c5f;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 0.8s linear infinite;
        }


        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .page-link-custom {
            background: #0C223d;
            color: #fff;
            padding: 6px 12px;
            display: inline-block;
            border-radius: 4px;
            text-decoration: none;
        }

        .page-link-custom.active-page {
            background: #F2F2F2;
            color: #ff3c5f;
            font-weight: bold;
        }


        .brb--content {
            background: #ff3c5f85;
            position: absolute;
            top: 9rem;
            padding: 10px;
            width: 100%;
            z-index: 2;
        }

        .brb--wrappr {
            color: #fff;
            font-size: 12px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <section class="">

        @include('web.mc.mc-filter')

        <div class="container my-5">

            <div class="row">


                <!-- ////// Include the Skeleton Grid Type ////////// -->
                @include('web.mc.mc-grid-skeleton')


                <!-- ////// Include the Skeleton List Type ////////// -->
                @include('web.mc.mc-list-skeleton')

                <!-- ////// Grid View ///////////////// -->
                <div class="col-sm-12" id="grid_view">
                    <h2 class="mc_view_title">

                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                                <path d="M25.625 2.11719H20.625C19.2443 2.11719 18.125 3.23648 18.125 4.61719V9.61719C18.125 10.9979 19.2443 12.1172 20.625 12.1172H25.625C27.0057 12.1172 28.125 10.9979 28.125 9.61719V4.61719C28.125 3.23648 27.0057 2.11719 25.625 2.11719Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.375 18.3672H4.375C2.99429 18.3672 1.875 19.4865 1.875 20.8672V25.8672C1.875 27.2479 2.99429 28.3672 4.375 28.3672H9.375C10.7557 28.3672 11.875 27.2479 11.875 25.8672V20.8672C11.875 19.4865 10.7557 18.3672 9.375 18.3672Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M25.625 18.3672H20.625C19.2443 18.3672 18.125 19.4865 18.125 20.8672V25.8672C18.125 27.2479 19.2443 28.3672 20.625 28.3672H25.625C27.0057 28.3672 28.125 27.2479 28.125 25.8672V20.8672C28.125 19.4865 27.0057 18.3672 25.625 18.3672Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.375 2.11719H4.375C2.99429 2.11719 1.875 3.23648 1.875 4.61719V9.61719C1.875 10.9979 2.99429 12.1172 4.375 12.1172H9.375C10.7557 12.1172 11.875 10.9979 11.875 9.61719V4.61719C11.875 3.23648 10.7557 2.11719 9.375 2.11719Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Grid View
                    </h2>
                    <div class="mc_card_container"></div>

                </div>

                <!-- ////// List View ///////////////// -->
                <div class="col-sm-12" id="list_view">
                    <h2 class="mc_view_title">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 27 24">
                                <path d="M1.83301 1.53516H25.1663M1.83301 11.7435H25.1663M1.83301 21.9518H25.1663"
                                     stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        List View
                    </h2>
                    <div class="mc_list_container"></div>
                </div>

                <div class="col-sm-12">
                    <div class="no--listing" style="display:none;">
                        <p><i>There are no listings for your search criteria.</i></p>
                    </div>
                </div>





                {{-- <div id="page_loader">
                    <div class="loader"></div>
                </div> --}}

            </div>

            <!-- ////// Pagination ///////////////// -->
            @include('web.partials.pagination-skelton')
            <div id="common_pagination"></div>
            <!-- ////// End Pagination ///////////////// -->

        </div>



        <div class="modal fade upload-modal hh" id="add_wishlist" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><img
                                src="{{ asset('assets/app/img/my-legbox.png') }}" class="custompopicon"> <span
                                class="popup_modal_title_new">Add To Shortlist</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0" style="padding: 15px 0px;">
                        <h1 class="custom_modal_text user_short_list" style="text-align: center;">
                            <span id="Lname">[MC Name]</span>
                            has been added to your Shortlist.
                        </h1>
                    </div>
                    <div class="modal-footer pt-0" style="justify-content: center;">
                        <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                            id="close">Ok</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade upload-modal hh" id="clear_wishlist" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <img src="{{ asset('assets/dashboard/img/short-list-profile.png') }}" class="custompopicon">
                            <span class="popup_modal_title_new"> Clear Shortlist</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <h1 class="my-4 custom_modal_text" style="text-align: center;">
                            Are you sure you want to clear the shortlist?
                        </h1>
                    </div>
                    <div class="modal-footer pt-0" style="justify-content: center;">
                        <button type="button" class="btn-success-modal  yes_clear_short_list" id="close">Yes</button>
                        <button type="button" class="btn-success-modal " data-dismiss="modal" id="close">No</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade upload-modal hh" id="clear_wishlist_confirmation" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <img src="{{ asset('assets/dashboard/img/short-list-profile.png') }}" class="custompopicon">
                            <span class="popup_modal_title_new"> Clear Shortlist</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <h5 class="my-4 custom_modal_text clear_wishlist_confirmation_text">

                        </h5>
                    </div>
                    <div class="modal-footer pt-0" style="justify-content: center;">
                        <button type="button" class="btn-success-modal" data-dismiss="modal"id="close">ok</button>
                    </div>
                </div>

            </div>
        </div>




        <div class="modal fade upload-modal hh" id="my_legbox" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <img
                                src="{{ asset('assets/app/img/my-legbox.png') }}" class="custompopicon"> <span
                                class=" popup_modal_title_new">My Legbox</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="custom_modal_text">
                            <span id="Lname">My Legbox is only available to Viewers. Please
                                log in
                                or Register to access your Legbox.</span>
                        </h5>
                    </div>
                    <div class="modal-footer my_legbox_footer pt-0" style="justify-content: center;">
                        <a href="{{ route('viewer.login') }}" type="button"
                            class="btn-cancel-modal text-decoration-none text-white" id="loginUrl">Login</a>
                        <a href="{{ route('register') }}" type="button"
                            class="btn-success-modal text-decoration-none text-white" id="regUrl">Register</a>
                    </div>

                </div>
            </div>
        </div>
        <input type="hidden" id="activeView">
    </section>
@endsection
@php
    $listingsPreferencesView =
        auth()->check() && auth()->user()->viewer_settings?->listings_preferences_view == 2 ? 'list' : 'grid';
@endphp


@push('scripts')
    <script>
        window.authUser = {
            isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
            auth_user_type: {{ auth()->check() ? auth()->user()->type : 'false' }},
            myLegboxDisabled: {{ auth()->check() && auth()->user()->viewer_settings?->features_enable_my_legbox == 0 ? 'true' : 'false' }},
        };

        //This is Global Massage Request for use resuffling
        const viewType = "{{ $listingsPreferencesView }}";
        var globalMassageRequest = {
            page: 1,
            filter_by_location: {},
            filter_by_feild: {},
            view_type: 'null',
            url_param: {},
        };


        $(document).on('click', '.add_to_favrate', function() {
            if (window.authUser.myLegboxDisabled && window.authUser.auth_user_type == '0') {
                swal_error_warning('My Legbox',
                    'Please note you have disabled this feature. <br> To access this feature, go to your setting in My Account.'
                );
                return false;
            }

            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-massageId');
            var Uid = $(this).attr('data-userId');
            var cidcl = $(this).attr('class');
            var cid = cidcl.split(' ');

            if (cid.includes('fill')) {
                $(this).removeClass('fill');
                $(this).addClass('null');
                $('.legboxClass_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i><span class='custom-heart-text remove-tool'>Remove from My Legbox</span>"
                );
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i><span class='custom-heart-text'>Remove from My Legbox</span>"
                );

                $('#legboxIdList_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i><span class='custom-heart-text'>Remove from My Legbox</span>"
                );

                var url = "{{ route('user.save.massage.legbox', ':id') }}";
                url = url.replace(':id', Eid);
                $('.user_short_list').html(`<span id="Lname">${name}</span> has been added to your Legbox.`);
                $('#add_wishlist').find('.popup_modal_title_new').text('My Legbox');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                    }
                });

            } else if (cid.includes('null')) {
                $(this).removeClass('null');
                $(this).addClass('fill');

                $('.legboxClass_' + Eid).html(
                    "<i class='fa fa-heart-o' aria-hidden='true'></i><span class='custom-heart-text list-tool'>Add to My Legbox</span>"
                );
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart-o' aria-hidden='true'></i><span class='custom-heart-text'>Add to My Legbox</span>"
                );
                $('#legboxIdList_' + Eid).html(
                    "<i class='fa fa-heart-o' aria-hidden='true'></i><span class='custom-heart-text'>Add to My Legbox</span>"
                );

                var url = "{{ route('user.delete.massage.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                $('.user_short_list').html(`<span id="Lname">${name}</span> has been removed from your Legbox.`);
                $('#add_wishlist').find('.popup_modal_title_new').text('My Legbox');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);

                    }
                });

            } else {

                @if (auth()->user() && auth()->user()->type != 0)
                    $(".my_legbox_title").text(
                        'My Legbox is only available to Viewers. Please log in or Register to access your Legbox.'
                    );
                    $(".my_legbox_footer").show();
                @else
                    $(".my_legbox_title").text(
                        'My Legbox is only available to Viewers. Please log in or Register to access your Legbox.'
                    );
                    $(".my_legbox_footer").show();
                @endif
                $('#my_legbox').modal('show');

                var login_url = "{{ route('viewer.login', ':id') }}";
                var loginurl = login_url.replace(':id', 'legboxId=' + Eid);
                var loginurl2 = loginurl.replace(':path', 'path=' + window.location.pathname);



                var regurl = "{{ route('register', ':id') }}";
                //{{-- loginurl = loginurl.replace(':id','legboxId='+Eid) --}}
                regurl = regurl.replace(':id', 'legboxId=' + Eid)
                $('#loginUrl').attr('href', loginurl2)
                $('#regUrl').attr('href', regurl)
            }


        });


        //SHS

        var activeView = '{{ $listingsPreferencesView }}';
        globalMassageRequest.view_type = activeView;

        if (globalMassageRequest.view_type == 'list') {
            $('#view_grid').removeClass('view-active');
            $('#view_list').addClass('view-active active');
            $('#activeView').val(activeView);
        }

        if (globalMassageRequest.view_type == 'grid') {
            $('#view_list').removeClass('view-active');
            $('#view_grid').addClass('view-active active');
            $('#activeView').val(activeView);
        }

        async function fetchLocationFromServer(lat, lng) {
            try {
                const data = await $.ajax({
                    url: "{{ route('web.user_location') }}",
                    type: "GET",
                    data: {
                        latitude: lat,
                        longitude: lng
                    }
                });
                return data;

            } catch (error) {
                console.error(error);
                return {
                    state: null,
                    city: null
                };
            }
        }

        function toggleSkeleton(grid = false, list = false, pagination = false, cusPagi = false) {
            $('#grid-skeleton').toggle(grid);
            $('#list-skeleton').toggle(list);
            $('#skl-pagination').toggle(pagination);
            $('.custom-pagination').toggle(cusPagi);
        }

        function toggleViewTitle(show = true) {
            $('#grid_view .mc_view_title, #list_view .mc_view_title').toggle(show);
        }

        function toggleView(grid = true, list = false) {
            $('#grid_view').toggle(grid);
            $('#list_view').toggle(list);
        }

        function toggleContainer(grid = true, list = false) {
            $('.mc_card_container').toggle(grid);
            $('.mc_list_container').toggle(list);
        }


        $('#view_grid').on('click', function() {
            activeView = 'grid';

            $('#activeView').val('grid');
            toggleContainer(grid = true, list = false);
            toggleSkeleton(grid = true, list = false, pagination = true, cusPagi = false);

            //set view type in global varaiable
            globalMassageRequest.view_type = 'grid';

            setTimeout(async function() {
                toggleSkeleton(grid = false, list = false, pagination = false, cusPagi = true);
                toggleViewTitle(true);
                toggleView(grid = true, list = false);

            }, 500);
            $('.view-active').removeClass('view-active');
            $(this).addClass('view-active active');

        });

        $('#view_list').on('click', function() {
            activeView = 'list';
            $('#activeView').val('list');

            toggleContainer(grid = false, list = true);
            //hide show 
            toggleSkeleton(grid = false, list = true, pagination = true, cusPagi = false);

            //set view type in global varaiable
            globalMassageRequest.view_type = 'list';

            setTimeout(async function() {
                toggleSkeleton(grid = false, list = false, pagination = false, cusPagi = true);
                toggleViewTitle(true);
                toggleView(grid = false, list = true);

            }, 500);
            $('.view-active').removeClass('view-active active');
            $(this).addClass('view-active active');

        });

        $(document).on('click', '.custom-pagination a', async function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            if (!url || url === '#') return;

            let page = getParameterByName('page', url);
            if (!page) page = 1;
            globalMassageRequest.page = page;
            await loadData();
        });


        const massageRouteStates = escortRouteStates = @json(config('escorts.profile.states'));

        const massageBaseUrl = "{{ config('constants.massage_list_base_slug') }}";
        let preserveInitialMassageLocationUrl = true;

        function getMassageRouteMemberId(selectedCity) {
            const segments = window.location.pathname.split('/').filter(Boolean);
            const lastSegment = segments[segments.length - 1] || '';
            const routeOffset = String(segments[1] || '').toLowerCase() === 'australia' ? 2 : 1;
            const currentState = segments[routeOffset] || '';
            const currentCity = segments[routeOffset + 1] || '';


            if (!/^M[\w-]+$/i.test(lastSegment) || !selectedCity) {
                return null;
            }

            if (currentState !== selectedCity.state || currentCity !== selectedCity.city) {
                return null;
            }

            return lastSegment;
        }

        function getMassageListingPath() {
            const segments = window.location.pathname.split('/').filter(Boolean);

            const hasCountrySegment = String(segments[1] || '').toLowerCase() === 'australia';
            const routeOffset = hasCountrySegment ? 2 : 1;
            const urlState = String(segments[routeOffset] || '').toLowerCase();
            const urlCity = String(segments[routeOffset + 1] || '').toLowerCase();
            const selectedCityId = String($('#profile_city').val() || '');
            const currentMemberId = segments[routeOffset + 2] || '';


            const pathSegments = [massageBaseUrl];

            let selectedState = null;
            let selectedCity = null;
            let cityIds = null;

            Object.entries(massageRouteStates).some(function([stateId, state]) {

                const stateAbbr = String(state.stateAbbr || '').toLowerCase();
                const cities = state.cities || {};

                if (selectedCityId) {
                    return Object.entries(cities).some(function([cityId, city]) {
                        if (String(cityId) !== selectedCityId) {
                            return false;
                        }

                        selectedState = {
                            id: stateId,
                            abbr: stateAbbr
                        };
                        selectedCity = {
                            stateId: stateId,
                            cityId: cityId,
                            state: stateAbbr,
                            city: String(city.cityName || '').toLowerCase()
                        };
                        cityIds = cityId;

                        return true;
                    });
                }

                if (!preserveInitialMassageLocationUrl) {
                    return false;
                }

                // Match state from URL
                if (stateAbbr !== urlState) {
                    return false;
                }

                selectedState = {
                    id: stateId,
                    abbr: stateAbbr
                };

                if (urlCity) {
                    Object.entries(cities).some(function([cityId, city]) {

                        const cityName = String(city.cityName || '').toLowerCase();

                        if (cityName === urlCity) {
                            selectedCity = {
                                stateId: stateId,
                                cityId: cityId,
                                state: stateAbbr,
                                city: cityName
                            };
                            cityIds = cityId;

                            return true;
                        }

                        return false;
                    });
                }

                if (!selectedCity) {
                    cityIds = Object.keys(cities)[0] || null;
                }


                return true;
            });

            if (selectedCity || (preserveInitialMassageLocationUrl && hasCountrySegment)) {
                pathSegments.push('australia');
            }

            if (selectedCity || (preserveInitialMassageLocationUrl && selectedState)) {
                pathSegments.push(selectedState.abbr);

                if (selectedCity) {
                    pathSegments.push(selectedCity.city);
                }

                const memberId = getMassageRouteMemberId(
                    selectedCity || {
                        state: selectedState.abbr
                    }
                );

                if (memberId) {
                    pathSegments.push(memberId);
                }
            }


            // ==========================================
            // Backend filter
            // ==========================================

            globalMassageRequest.filter_by_feild = Object.assign({}, globalMassageRequest.filter_by_feild, {
                profile_city: cityIds,
                massage_id: currentMemberId
            });

            return '/' + pathSegments.join('/');
        }


        /* ===============================
           AJAX LOAD FUNCTION
        =============================== */

        async function loadData(requestParam = globalMassageRequest, showLoader = true) {

            let requestUrl = getMassageListingPath();


            let ajaxReq = null;
            let currentUrl = window.location.href;


            if (ajaxReq) {
                ajaxReq.abort();
            }

            history.replaceState({}, '', requestUrl);

            ajaxReq = $.ajax({
                url: "{{ route('mc-ajax-list') }}",
                data: requestParam,
                beforeSend: function() {
                    toggleViewTitle(false);
                    toggleContainer(grid = false, list = false);
                    if (requestParam.view_type == 'grid') {
                        toggleSkeleton(grid = true, list = false, pagination = true, cusPagi = false);

                    } else {
                        toggleSkeleton(grid = false, list = true, pagination = true, cusPagi = false);
                    }

                },
                success: function(res) {
                    $('.mc_card_container').html(res.grid);
                    $('.mc_list_container').html(res.list);
                    $('.total_count').html(res.total_count);
                    if (res.total_count == 0) {
                        $('.no--listing').show();
                    } else {
                        $('.no--listing').hide();
                    }

                    $('#common_pagination').html(res.pagination);

                    //show heading
                    toggleViewTitle(true);


                    if (requestParam.view_type == 'grid') {
                        toggleContainer(grid = true, list = false);
                        toggleView(grid = true, list = false);
                    } else {
                        toggleContainer(grid = false, list = true);
                        toggleView(grid = false, list = true);
                    }
                },
                complete: function() {
                    toggleSkeleton(grid = false, list = false, pagination = false, cusPagi = true);
                }
            });
        }



        ///////  Short List /////////////

        $(document).on('click', '.m_wishlist', function() {
            $('#page_loader').show();
            var wishlist_id = $(this).data('id');
            var wishlist_footer_id = 'wishlist_footer_id' + wishlist_id;
            var list_button_wrap_id = 'list_button_wrap_id' + wishlist_id;

            var listbuton = `<button type="button" class="m_removelist btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_1887" data-id="${wishlist_id}">
                                <img class="listiconprofilelistview" src="../assets/app/img/filter_view.png"> Remove from Shortlist
                                </button>`;

            $.ajax({
                url: "{{ route('web.store-short-list') }}",
                type: 'POST',
                data: {
                    wishlist_id: wishlist_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $('#page_loader').hide();
                    let response = res;
                    if (response.status) {
                        $('#session_count').html(response.session_count);
                        $('#' + list_button_wrap_id).html(listbuton);
                        $('#' + wishlist_footer_id).html(
                            '<a href="javascript:void(0)" data-id="' + wishlist_id +
                            '" class="m_removelist"  >Remove to Shortlist</a>');
                        $('.user_short_list').html(
                            `<span id="Lname">${response.data.profile_name}</span> has been added to your Shortlist.`
                        );
                        $('#add_wishlist').modal('show');

                    }
                }
            });

        });

        $(document).on('click', '.m_removelist', function() {
            $('#page_loader').show();
            var wishlist_id = $(this).data('id');

            var wishlist_footer_id = 'wishlist_footer_id' + wishlist_id;
            var list_button_wrap_id = 'list_button_wrap_id' + wishlist_id;

            var listbuton = `<button type="button" class="m_wishlist btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_1887" data-id="${wishlist_id}">
                                    <img class="listiconprofilelistview" src="../assets/app/img/filter_view.png"> Add to Shortlist
                                </button>`;

            $.ajax({
                url: "{{ route('web.remove-short-list') }}",
                type: 'POST',
                data: {
                    wishlist_id: wishlist_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $('#page_loader').hide();
                    let response = res;
                    if (response.status) {
                        $('#session_count').html(response.session_count);
                        $('#' + wishlist_footer_id).html(
                            '<a href="javascript:void(0)" data-id="' + wishlist_id +
                            '" class="m_wishlist">Add to Shortlist</a>');
                        $('#' + list_button_wrap_id).html(listbuton);
                        $('.user_short_list').html(
                            `<span id="Lname">${response.data.profile_name}</span> has been remove from your Shortlist.`
                        );
                        $('#add_wishlist').modal('show');

                    }
                }
            });

        });



        /////// Short List ///////////////
        $(document).on('click', '.upper_filter', async function(e) {
            e.preventDefault();
            preserveInitialMassageLocationUrl = false;
            globalMassageRequest.filter_by_location = {
                locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                by_name_member: $('#by_name_member').val(),
                set_lat: $('#set_lat').val(),
                set_lng: $('#set_lng').val(),
                per_page: $('#per_page').val()
            }

            await loadData();
        });


        /////// Per Page ///////////////
        $(document).on('change', '#per_page', async function(e) {
            e.preventDefault();
            preserveInitialMassageLocationUrl = false;
            let val = $(this).val();
            globalMassageRequest.filter_by_location = {
                locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                set_lat: $('#set_lat').val(),
                set_lng: $('#set_lng').val(),
                per_page: val,
            }

            await loadData();
        });


        $(document).on('click', '.lower_filter', async function(e) {
            e.preventDefault();
            preserveInitialMassageLocationUrl = false;

            globalMassageRequest.filter_by_feild = {
                profile_state: $('#profile_state').val(),
                profile_city: $('#profile_city').val(),
                masseur_types: $('#masseur_types').val(),
                profile_age: $('#profile_age').val(),
                profile_price: $('#profile_price').val(),
                massage_services: $('#massage_services').val(),
                other_services: $('#other_services').val(),
                verification: $('#verification').val()
            };

            await loadData();
        });

        //reset the filter
        $(document).on('click', '.reset_form_filter', async function(e) {
            e.preventDefault();
            preserveInitialMassageLocationUrl = false;
            let locByRad = $('input[name="locationByRadio"]:checked').val();
            let letVal = $('#set_lat').val();
            let lngVal = $('#set_lng').val();
            $('#filterForm')[0].reset();
            //again set the location radio button to previous value
            $(`input[name="locationByRadio"][value="${locByRad}"]`).prop('checked', true);
            $('#profile_city').val('');
            globalMassageRequest = {
                filter_by_feild: {
                    profile_state: '',
                    profile_city: '',
                    masseur_types: '',
                    profile_age: '',
                    profile_price: '',
                    massage_services: '',
                    other_services: '',
                    verification: ''
                },
                filter_by_location: {
                    locationByRadio: locByRad,
                    by_name_member: $('#by_name_member').val(),
                    set_lat: letVal,
                    set_lng: lngVal,
                    per_page: $('#per_page').val()
                },
                view_type: activeView,
                page: 1
            };

            //fetch data after reset serach feature.
            await loadData();
        });

        const TEN_MINUTES = 10 * 60 * 1000; // 2 min
        setInterval(async function() {
            await loadData(globalMassageRequest, false);
        }, TEN_MINUTES);


        //////// Clear Short List /////////
        $(document).on('click', '.clear_short_list', async function(e) {
            var count = parseInt($('#session_count').text().trim(), 10);
            if (count > 0) {
                $('#clear_wishlist').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });

        $(document).on('click', '.yes_clear_short_list', async function(e) {
            $.ajax({
                url: "{{ route('web.clear-short-list') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $('#clear_wishlist').modal('hide');
                    $('#session_count').html('0');
                    let response = res;
                    if (response.status) {
                        $('.clear_wishlist_confirmation_text').html(response.message);
                        $('#clear_wishlist_confirmation').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                }
            });
        })

        function getParameterByName(name, url) {
            name = name.replace(/[\[\]]/g, '\\$&');
            let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            let results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        async function updateLocationFields() {
            let selectedLocation = $('input[name="locationByRadio"]:checked').attr('id');

            if (selectedLocation === 'yourLocation') {
                //make disable all city
                $('#profile_city').val('').prop('disabled', true);
                //get storage location.
                const location = await getLocation();

                if (location) {
                    $("#set_lat").val(location?.lat || '');
                    $("#set_lng").val(location?.lng || '');
                }

                globalMassageRequest.filter_by_location = {
                    set_lat: $('#set_lat').val(),
                    set_lng: $('#set_lng').val(),
                    locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                    per_page: $('#per_page').val(),
                };
            } else {
                //make emable all city
                $('#profile_city').prop('disabled', false);

                $("#set_lat").val('');
                $("#set_lng").val('');

                globalMassageRequest.filter_by_location = {
                    set_lat: '',
                    set_lng: '',
                    locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                    per_page: $('#per_page').val(),
                };
            }

            //fetch first time data.
            await loadData();
        }
        // Run on page load (default selected radio)
        (async function() {
            await updateLocationFields();
            // Save location in background
            updateLocation();
        })();

        // Run when radio changes
        $(document).on('change', 'input[name="locationByRadio"]', async function() {
            preserveInitialMassageLocationUrl = false;
            await updateLocationFields();
            let selectValue = $(this).val();
        });

        /////// Accordion’s open-close state in local storage ////////
        document.addEventListener('DOMContentLoaded', function() {
            const collapseEl = document.getElementById('collapseSearch');
            const savedState = localStorage.getItem('collapseSearchState');
            if (savedState === 'open') {
                collapseEl.classList.add('show');
            } else {
                collapseEl.classList.remove('show');
            }
            $(collapseEl).on('shown.bs.collapse', function() {
                localStorage.setItem('collapseSearchState', 'open');
            });

            $(collapseEl).on('hidden.bs.collapse', function() {
                localStorage.setItem('collapseSearchState', 'closed');
            });

        });

        //local manage latitude and longitude.
        const LOCATION_KEY = 'user_location';
        const LOCATION_EXPIRE = 30 * 60 * 1000; // 30 Minutes


        function getCurrentLocation() {
            return new Promise((resolve, reject) => {

                if (!navigator.geolocation) {
                    return reject('Geolocation not supported');
                }

                navigator.geolocation.getCurrentPosition(
                    position => resolve({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    }),
                    error => reject(error), {
                        enableHighAccuracy: false,
                        timeout: 5000,
                        maximumAge: LOCATION_EXPIRE
                    }
                );

            });
        }

        //update locaiton Background
        async function updateLocation() {
            try {
                const location = await getCurrentLocation();

                localStorage.setItem(LOCATION_KEY, JSON.stringify({
                    ...location,
                    updated_at: Date.now()
                }));

            } catch (e) {
                console.log(e);
            }
        }

        //Get Stored Location
        async function getLocation() {
            let location = JSON.parse(localStorage.getItem(LOCATION_KEY));
            // No location found
            if (!location) {
                updateLocation(); // background
                return null;
            }
            // Expired
            if ((Date.now() - location.updated_at) > LOCATION_EXPIRE) {
                updateLocation(); // refresh in background
            }
            return location;
        }

        $('.btn-search').on('click', function() {
            $('.btn-search i').toggleClass('rotate-180');
        })
    </script>
@endpush
