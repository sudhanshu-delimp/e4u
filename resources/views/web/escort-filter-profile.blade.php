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

        .fiter_btns select {
            text-transform: capitalize;
        }

        .swal2-popup {
            width: auto !important;
        }


        /* Page loader CSS */
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
    <section class="">
        <div class="container filter-contain mt-3">

            @include('web.escort.partials.escort-filter')

            <!-- ================     service provider start here     ========================= -->

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
                                            <li>You can undertake a search for an Escort within your Location, which is the
                                                default, or Australia wide
                                                by selecting ‘Australia’.</li>
                                            <li>Searching by the Member ID is the most efficient way to find the Escort you
                                                are looking for. </li>
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
            <div id="grid-template" class="text-center"></div>
            <!--5 items column start here -->
            <div class="wislist-filster" style="display: none;">
                <div class="my-wishlist px-0 px-lg-4 mx-0 mx-lg-2" style="display: block;">
                    <div class="row responsive_colums_in_lg_five_col escost_list">

                    </div>
                </div>

            </div>
            @include('web.escort.partials.escort-grid-skeleton')
            @include('web.escort.partials.escort-list-skeleton')
            <div id="escortListing">

                {{-- Grid view using ajax --}}
                <div class="otherliste" id="appendGridView" style="display: none;">

                </div>

                {{-- List view using ajax --}}
                <div class="grid list-view list-view-div" id="appendListView" style="display: none;">

                </div>

            </div>

           <div class="no--listing">
                        <div class="no-listing-icon">
                            <img src="{{ asset('assets/app/img/no-results.png') }}" alt="">
                        </div>

                        <div class="no-listing-content">
                            <h3>No Listings Found</h3>
                            <p>
                                We couldn't find any listings matching your search criteria.
                                Try adjusting your filters or search options.
                            </p>                            
                        </div>
                    </div>

        </div>


        {{-- OR use fully custom pagination --}}
        @include('web.partials.pagination-skelton')
        <div id='custom_pagenation'></div>

        </div>
        </div>
    </section>

    <div class="modal fade upload-modal hh" id="my_legbox" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/my-legbox.png') }}"
                            class="custompopicon"> <span class=" popup_modal_title_new">My Legbox</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="custom_modal_text" style="text-align: center;">
                        <span id="Lname ">My Legbox is only available to Viewers. Please log in
                            or Register to access your Legbox.</span>
                    </h5>
                </div>
                <div class="modal-footer my_legbox_footer" style="justify-content: center;">
                    <a href="{{ route('viewer.login') }}" type="button"
                        class="btn-cancel-modal text-decoration-none text-white" id="loginUrl">Login</a>
                    <a href="{{ route('register') }}" type="button"
                        class="btn-success-modal text-decoration-none text-white" id="regUrl">Register</a>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade upload-modal hh" id="add_wishlist" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('assets/app/img/my-legbox.png') }}"
                            class="custompopicon"> <span class="popup_modal_title_new">Add To Shortlist</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body pb-0" style="padding: 15px 0px;">
                    <h1 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                        <span id="Lname"></span>
                        <span class="class_msg"></span>
                    </h1>
                </div>
                <div class="modal-footer pt-0" style="justify-content: center;">
                    <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                        id="close">Ok</button>
                </div>
            </div>

        </div>
    </div>





    <div class="modal fade upload-modal" id="add_wishlist1" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
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
    <div class="modal fade upload-modal" id="withoutLogin" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
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


    <div class="modal fade upload-modal" id="viewerPreferences" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title text-white">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="12" fill="#FF3B57" />
                            <text x="12" y="17" text-anchor="middle" font-size="16" font-weight="bold" fill="white"
                                font-family="Arial, sans-serif">!</text>
                        </svg>
                        Viewer Preferences
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="previous" name="url" value="delete-escort-bank/40">
                    <input type="hidden" id="label" name="label">
                    <input type="hidden" id="trigger-element">
                    <h5 class="mb-2 mt-3"><span id="Lname">By changing the Location filter your Preference Settings
                            for Advertisers will be cancelled for this session.</span> </h5>
                    <h3 class="mb-4 mt-2"><span id="log"></span> </h3>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-cancel-modal">Proceed</button>
                    <button type="button" class="btn-success-modal" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    {{-- viewer Preferences End modal here --}}

    <!-----------------  Page Loader  --------------------->

    {{-- <div id="page_loader">
        <div class="loader"></div>
    </div> --}}



    @php
        $listingsPreferencesView =
            auth()->check() && auth()->user()->viewer_settings?->listings_preferences_view == 2 ? 'list' : 'grid';
    @endphp
@endsection
@push('scripts')
    <script>
        //This is Global Escort Request for use re-suffling
        var escortRequest = {
            page: 1,
            membership_type: null,
            view_type: 'null',

            filter_by_field: {
                services: [],
                city: null,
                gender:null,
                age: null,
                price: null,
                duration_price:null,
                playmate_status: null,
                varify_list: null,
            },

            filter_by_location: {
                locationByRadio: null,
                lat: null,
                lng: null,
                search_by_radio: null,
                by_name_member: null,
                limit: null,
            }
        };

        //local manage latitude and longitude.
        const LOCATION_KEY = 'escort_location';
        const LOCATION_EXPIRE = 30 * 60 * 1000; // 30 Minutes
        let ajaxReq = null;
        const viewType = "{{ $listingsPreferencesView }}";
        escortRequest.view_type = viewType;

        const escortRouteStates = @json(config('escorts.profile.states'));
        const escortRouteGenders = @json(config('escorts.gender'));

        const escortBaseUrl = "{{config('constants.escort_list_base_slug')}}";
        let preserveInitialLocationUrl = true;

        function getEscortRouteMemberId(selectedCity, genderId) {
            const segments = window.location.pathname.split('/').filter(Boolean);
            const lastSegment = segments[segments.length - 1] || '';
            const currentState = segments[2] || '';
            const currentCity = segments[3] || '';
            const currentGender = segments[4] || '';
            const selectedGender = escortRouteGenders[genderId] || '';

            if (!/^E[\w-]+$/i.test(lastSegment) || !selectedCity) {
                return null;
            }

            if (currentState !== selectedCity.state || currentCity !== selectedCity.city) {
                return null;
            }

            if (selectedGender && currentGender !== selectedGender.toLowerCase().replace(/\s+/g, '_')) {
                return null;
            }

            return lastSegment;
        }

        function getEscortListingPath() {
            const segments = window.location.pathname.split('/').filter(Boolean);
            const cityId = String($('#escort_city').val() || '');
            const genderId = String($('#escort_gender').val() || '');
            const pathSegments = [escortBaseUrl];
            let selectedCity = null;
            const currentCountry = (segments[1] || '').toLowerCase();
            const currentState = (segments[2] || '').toLowerCase();

            Object.values(escortRouteStates).some(function(state) {
                return Object.entries(state.cities || {}).some(function([id, city]) {
                    if (String(id) === cityId) {
                        selectedCity = {
                            state: state.stateAbbr.toLowerCase(),
                            city: city.cityName.toLowerCase()
                        };
                        return true;
                    }

                    return false;
                });
            });
           
            if (selectedCity) {
                pathSegments.push('australia');
                pathSegments.push(selectedCity.state, selectedCity.city);

                const genderSlug = escortRouteGenders[genderId];

                if (genderSlug) {
                    pathSegments.push(genderSlug.toLowerCase().replace(/\s+/g, '_'));
                }

                const memberId = getEscortRouteMemberId(selectedCity, genderId);
                if (memberId) {
                    pathSegments.push(memberId);
                }

            } else if (escortRouteGenders[genderId]) {
                pathSegments.push('australia');
                pathSegments.push(escortRouteGenders[genderId].toLowerCase().replace(/\s+/g, '_'));
            } else if (preserveInitialLocationUrl && currentCountry === 'australia') {
                pathSegments.push('australia');
                if (currentState &&
                    Object.values(escortRouteStates).some(function(state) {
                        return state.stateAbbr.toLowerCase() === currentState;
                    })) {
                    pathSegments.push(currentState);
                }
            }

            return '/' + pathSegments.join('/');
        }

  


        async function updateLocationFields() {
            let selectedLocation = $('input[name="locationByRadio"]:checked').attr('id');

            if (selectedLocation === 'yourLocation') {
                //make disable all city
                $('#escort_city').val('').prop('disabled', true);
                //get storage location.
                const location = await getLocation();
                if (location) {
                    $("#set_lat").val(location?.lat || '');
                    $("#set_lng").val(location?.lng || '');
                }

                escortRequest.filter_by_location = {
                    lat: $('#set_lat').val(),
                    lng: $('#set_lng').val(),
                    locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                    limit: $('#limit').val(),
                    search_by_radio : getSearchByRadioValue(),
                };
            } else {
                //make emable all city
                $('#escort_city').prop('disabled', false);

                //re-select value
                $('#escort_city').each(function () {
                    var selectedValue = $(this).val();
                    $(this).val(selectedValue).trigger('change');
                });

                $("#set_lat").val('');
                $("#set_lng").val('');

                escortRequest.filter_by_location = {
                    set_lat: '',
                    set_lng: '',
                    locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                    limit: $('#limit').val(),
                    search_by_radio : getSearchByRadioValue(),
                };
                
            }

            //fetch first time data.
            await loadEscort();
        }
        // Run on page load (default selected radio)
        (async function() {

            setProfileView(escortRequest.view_type);

            await updateLocationFields();
            // Save location in background
            updateLocation();
        })();

        // Run when radio changes
        $(document).on('change', 'input[name="locationByRadio"]', async function() {
             await updateLocationFields();

        });

        function getCurrentPage() {
            return localStorage.getItem('page') || 1;
        }

        //click on grid view
        $(document).on('click', '#grid-modal', function() {
            // Active class
            //action = 'client_action'
            toggleSkeleton(grid = true, list = false);
            setProfileView('grid');
            escortRequest.view_type = 'grid';
            loadEscort();
            
        });
        // when click on list button
        $(document).on('click', '#grid-list', function() {
            //action = 'client_action'
            toggleSkeleton(grid = false, list = true);
            setProfileView('list');
            escortRequest.view_type = 'list';
            loadEscort();
        });


        //reset the filter
        $(document).on('click', '.reset_form_filter', async function(e) {
            e.preventDefault();
            preserveInitialLocationUrl = false;
            let locByRad = $('input[name="locationByRadio"]:checked').val();
            let letVal = $('#set_lat').val();
            let lngVal = $('#set_lng').val();
            let perPage = $('#per_page').val();
            $('#filterForm')[0].reset();
            //again set the location radio button to previous value
            $(`input[name="locationByRadio"][value="${locByRad}"]`).prop('checked', true);
            $('#escort_city').val('');
            $('#escort_gender').val('');
            $('#search_by_member_id_and_name').val('');
            escortRequest = {
                filter_by_field: {
                    city: '',
                    gender: '',
                    age: '',
                    price: '',
                    duration_price: '',
                    playmate_status: '',
                    verify_list: '',
                    verification: ''
                },
                filter_by_location: {
                    locationByRadio: locByRad,
                    by_name_member: '',
                    lat: letVal,
                    lng: lngVal,
                    per_page: perPage,
                    search_by_radio : getSearchByRadioValue(),
                },
                view_type: escortRequest.view_type,
                page: 1
            };

            //reset services
            $("#selectedService li").remove();
            $("ul input").remove();

            //applay the ajax and append again services value
            reAppendServices();

            await loadEscort();
        });

        function toggleSkeleton(grid = false, list = false, pagination = true, cusPagi = false) {
            $('#grid-skeleton').toggle(grid);
            $('#list-skeleton').toggle(list); 
            $('#skl-pagination').toggle(pagination);
            $('.custom-pagination').toggle(cusPagi);
        }

        //Load Card data with loadEscort function

        let currentPage = getCurrentPage();

        function loadEscort(reequestParam = escortRequest, showLoader = true) {
            let reequestUrl = getEscortListingPath();
            let formData = $('#escortFilterForm').serializeArray();
            //push current page number
            formData.push({
                name: 'page',
                value: reequestParam.page
            });

            formData.push({
                name: 'view_type',
                value: reequestParam.view_type,
            });

            //Member Type

            if (reequestParam.membership_type) {
                formData.push({
                    name: 'membership_type',
                    value: reequestParam.membership_type
                });
            }


            $.each(reequestParam.filter_by_location, function(key, value) {
                if (value !== null && value !== '') {
                    formData.push({
                        name: key,
                        value: value
                    });
                }
            });

            $.each(reequestParam.filter_by_field, function(key, value) {
                if (value !== null && value !== '') {
                    formData.push({
                        name: key,
                        value: value
                    });
                }
            });

            if (ajaxReq) {
                ajaxReq.abort();
            }
            // Update the browser URL with the clean route only.
            history.replaceState({}, '', reequestUrl);

            ajaxReq = $.ajax({
                url: reequestUrl,
                type: 'GET',
                data: $.param(formData), 
                dataType: 'json',

                beforeSend: function() {
                    if(reequestParam.view_type == 'grid'){
                        toggleSkeleton(grid = true, list = false, pagination = true, cusPagi = false);
                       
                    }else{
                        toggleSkeleton(grid = false, list = true, pagination = true, cusPagi = false);
                    }

                    if (showLoader) {
                        $('#appendGridView').hide();
                        $('#appendListView').hide();
                        $('.no--listing').hide();
                    }
                },
                success: function(response) {

                         // Update membership counts from AJAX response
                        const memberCounts = response.memberTotalCount || {1: 0, 2: 0, 3: 0, 4: 0};
                        const totalMemberCount = Object.values(memberCounts).reduce((sum, count) => sum + (Number(count) || 0), 0);

                        $('.totalEscortListingCount').text(totalMemberCount || 0);
                        $('#totalEscortListingCount').text(totalMemberCount || 0);
                        $('#p1_escort_count').text(memberCounts[1] || 0);
                        $('#g2_escort_count').text(memberCounts[2] || 0);
                        $('#s3_escort_count').text(memberCounts[3] || 0);

                    if (response.total_count > 0) {
                        const isGrid = response.view_type === 'grid';
                        $('#appendGridView').html(isGrid ? response.data : '').toggle(isGrid);
                        $('#appendListView').html(!isGrid ? response.data : '').toggle(!isGrid);
                        $('#custom_pagenation').html(response.pagination);
                        $('.no--listing').hide();



                        //update page number
                        localStorage.setItem('page', response.page);
                        //update selected shortlist count

                    } else {
                        $('#appendGridView').html(" ");
                        $('#appendListView').html(" ");
                        $('#custom_pagenation').html(" ");
                        $('.no--listing').show();
                    }

            

                },
                error: function(xhr, status) {
                    if (status === 'abort') {
                        return;
                    }
                },
                complete: function() {
                    toggleSkeleton(grid = false, list = false, pagination = false, cusPagi = true);
                    $('#appendGridView').show();
                    $('#appendListView').show();
                    
                    ajaxReq = null;
                }
            });

        }


        //Pagenation action
        $(document).on('click', '.custom-pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if (!url || url === '#') return;
            let page = getParameterByName('page', url);
            if (!page) {
                page = 1;
            }
            escortRequest.page = page;
            loadEscort();
        });

        function getParameterByName(name, url) {
            name = name.replace(/[\[\]]/g, '\\$&');
            let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            let results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        //set profile view
        function setProfileView(viewType) {
            // Save in localStorage
            // Active Icon
            $('.view-toggle').removeClass('active');
            if (viewType === 'grid') {
                $('#grid-modal').addClass('active');
            } else {
                $('#grid-list').addClass('active');
            }
            localStorage.setItem('profileViewType', viewType);

        }

        function getSearchByRadioValue() {
            return $('#search_by_radio').val() === 'australia' ? 0 : 1;
        }

        // filter data for use search by member id or name
        $(document).on('click', '.searchEscort', function(e) {
            e.preventDefault();
            preserveInitialLocationUrl = false;
            // let checkRadioVal = $('#search_by_radio').val();
            // const radioValue = checkRadioVal == 'australia' ? 0 : 1;



            escortRequest.page = 1;
            escortRequest.filter_by_location = {
                locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                by_name_member: $('#search_by_member_id_and_name').val(),
                lat: $('#set_lat').val(),
                lng: $('#set_lng').val(),
                limit: $('#limit').val(),
                search_by_radio: getSearchByRadioValue(),
            };
            loadEscort();
        });
        //Filter data for use search by category and service

        $(document).on('click', '#applayFilter', function(e) {
            e.preventDefault();
            preserveInitialLocationUrl = false;
            Object.assign(escortRequest, {
                page: 1
            });

            let service = $('#selectedService input[name="services[]"]').map(function() {
                    return $(this).val();
                }).get();

           escortRequest.filter_by_field = {
                services:service,
                city: $('#escort_city').val(),
                gender: $('#escort_gender').val(),
                age: $('#escort_age').val(),
                price: $('#escort_price').val(),
                duration_price: $('#escort_duration_price').val(),
                playmate_status: $('#escort_playmate_status').val(),
                varify_list: $('#escort_varify_list').val(),
            };

            loadEscort();

        });


        $(document).on('change', '#limit', function(e) {
             e.preventDefault();
            preserveInitialLocationUrl = false;
            let limitVal = $(this).val();

            escortRequest.page = 1;
            escortRequest.filter_by_location = {
                locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                lat: $('#set_lat').val(),
                lng: $('#set_lng').val(),
                limit: $('#limit').val(),
                search_by_radio: getSearchByRadioValue(),
            };
            loadEscort();
            
        });

        function getMemberWiseCount(membership_type) {
            escortRequest.page = 1;
            escortRequest.membership_type = membership_type;
            loadEscort();
        }

        // call every 2 min
        const TEN_MINUTES = 10 * 60 * 1000; // 10 min
        setInterval(function() {
            loadEscort(escortRequest, false);

            //update location
            updateLocation();
        }, TEN_MINUTES);





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
    </script>


    <script>
        window.authUser = {
            isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
            auth_user_type: {{ auth()->check() ? auth()->user()->type : 'false' }},
            myLegboxDisabled: {{ auth()->check() && auth()->user()->viewer_settings?->features_enable_my_legbox == 0 ? 'true' : 'false' }},
        };

        $(function() {
            var list = $('.js-dropdown-list');
            var link = $('.js-link');

            link.click(function(e) {
                e.preventDefault();
                list.slideToggle(200);
            });

            list.find('li').click(function() {

                list.find('li').removeClass('active');
                $(this).addClass('active');

                var text = $(this).html();
                var icon = '<i class="fa fa-angle-down"></i>';

                // Add class to the parent A
                link.addClass('selected-item');

                // Put selected text inside the A
                link.html(text + icon);

                list.slideToggle(200);

                if (text === '* Reset') {
                    link.removeClass('selected-item');
                    link.html('Select one option' + icon);
                }
            });
        });
    </script>

    <script>
        // save logged user details on escord dashboard on page load
        document.addEventListener("DOMContentLoaded", function() {
            let platform = navigator.platform;
            let browser = navigator.userAgent;
            let lastPage = document.referrer;
            let lastVisitedPage = window.location.pathname;

            fetch("{{ route('user.log-details') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        platform: platform,
                        browser: browser,
                        last_page: lastPage,
                        lastVisitedPage: lastVisitedPage
                    })
                }).then(response => response.json())
                .then(data => console.log("Log Saved:"))
                .catch(error => console.error("Error:"));
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Restore after refresh
            let opened = sessionStorage.getItem("accordionOpen");
            if (opened === "collapseSearch") {
                document.getElementById("collapseSearch").classList.add("show");
            }

            // When user clicks the accordion
            document.querySelector('[data-target="#collapseSearch"]').addEventListener("click", function() {
                let isOpen = document.getElementById("collapseSearch").classList.contains("show");

                if (!isOpen) {
                    sessionStorage.setItem("accordionOpen", "collapseSearch");
                } else {
                    sessionStorage.removeItem("accordionOpen");
                }
            });

        });

        $('.btn-search').on('click', function() {
            $('.btn-search i').toggleClass('rotate-180');
        })
    </script>

    <script>
        /////////////click event ///////////////
        $(document).ready(function() {
            $('body').on('click', '.akh1', function() {
                var id = $(this).attr('id');
                var val = $(this).data('val');
                var name = $(this).data('sname');
                $('#hideenclassOne_' + val).remove();
                $("#service_id_one").append("<option id='" + name + "' value='" + val + "'>" + name +
                    "</option>");
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
            });
        });
        ///////////////clear reset ////////////////////
        $('#resetAll').click(function() {
            $("#selectedService li").remove();
            $("ul input").remove();

            //applay the ajax and append again services value
            reAppendServices();
        });

        let ajaxServices = null;

        function reAppendServices() {
            if (ajaxServices) {
                ajaxServices.abort();
            }
            ajaxServices = $.ajax({
                url: '{{ route('public.web.fecth.services') }}',
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                        $('#page_loader').show();
                           
                },
                success: function(response) {
                    if (response.status == true) {
                        $('#service_id_one').html(response.data.service_one);
                        $('#service_id_two').html(response.data.service_two);
                        $('#service_id_three').html(response.data.service_three);
                    }
                },
                error: function(xhr, status) {
                    if (status === 'abort') {
                        return;
                    }

                },
                complete: function() {
                    $('#page_loader').hide();
                    ajaxServices = null;
                }
            });
        }

        /////////////Change event///////////////////

        $('body').on('change', '#service_id_one', function() {
            const selectedIdOne = $('#service_id_one').val();
            const getNameOne = $(this).children(':selected').attr('id');
            if (selectedIdOne) {
                $('#selectedService').append(`
                    <li class="seleceted_service_text_and_icon" id="hideenclassOne_${selectedIdOne}">
                        <p>${getNameOne}</p>

                        <i
                            class="fa fa-times-circle-o akh1"
                            data-sname="${getNameOne}"
                            data-val="${selectedIdOne}"
                            aria-hidden="true"
                            id="id_${selectedIdOne}"
                        ></i>

                        <input
                            type="hidden"
                            name="services[]"
                            value="${selectedIdOne}"
                        >
                    </li>
                `);

                $(`#service_id_one option[value="${selectedIdOne}"]`)
                    .prop('disabled', true)
                    .remove();
            }
        });



        $('body').on('change', '#service_id_two', function() {
            $('#selectedService').show();

            const selectedIdOne = $('#service_id_two').val();
            const getNameOne = $(this).children(':selected').attr('id');

            if (selectedIdOne) {
                $('#selectedService').append(`
                    <li class="seleceted_service_text_and_icon" id="hideenclassTwo_${selectedIdOne}">
                        <p>${getNameOne}</p>
                        <i
                            class="fa fa-times-circle-o akh2"
                            data-sname="${getNameOne}"
                            data-val="${selectedIdOne}"
                            aria-hidden="true"
                            id="id_${selectedIdOne}"
                        ></i>

                        <input
                            type="hidden"
                            name="services[]"
                            value="${selectedIdOne}"
                        >
                    </li>
                `);

                $(`#service_id_two option[value="${selectedIdOne}"]`)
                    .prop('disabled', true)
                    .remove();
            }
        });



        $('body').on('change', '#service_id_three', function() {
            const selectedIdOne = $('#service_id_three').val();
            const getNameOne = $(this).children(':selected').attr('id');

            if (selectedIdOne) {
                $('#selectedService').append(`
                    <li class="seleceted_service_text_and_icon" id="hideenclassThree_${selectedIdOne}">
                        <p>${getNameOne}</p>
                        <i
                            class="fa fa-times-circle-o akh3"
                            data-sname="${getNameOne}"
                            data-val="${selectedIdOne}"
                            aria-hidden="true"
                            id="id_${selectedIdOne}"
                        ></i>

                        <input
                            type="hidden"
                            name="services[]"
                            value="${selectedIdOne}"
                        >
                    </li>
                `);

                $(`#service_id_three option[value="${selectedIdOne}"]`)
                    .prop('disabled', true)
                    .remove();
            }
        });


        ///////////////end event change //////////////////


        //--------------Remove ther shortlist and removeshortlist function code --------------//
        $(document).on('click', '.shortlist', function() {
            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            var url = "{{ route('web.public.save.addtocart', ':id') }}";
            url = url.replace(':id', Eid);
            $('#add_wishlist').find('.popup_modal_title_new').text('Add To Shortlist');

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    escortId: Eid,
                    userId: Uid
                },
                beforeSend: function() {
                    $('#page_loader').show();
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data) {

                    if (data.error == 1) {
                        $('.class_msg').text(name + ' has been added to your Shortlist');
                        $('#add_wishlist').modal('show');
                        $('.myescort_' + Eid).html(
                            '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.75 3.25H8.24999C7.52064 3.25 6.82117 3.53973 6.30545 4.05546C5.78972 4.57118 5.49999 5.27065 5.49999 6V20C5.49898 20.1377 5.53587 20.2729 5.60662 20.391C5.67738 20.5091 5.77926 20.6054 5.90112 20.6695C6.02298 20.7335 6.16012 20.7627 6.2975 20.754C6.43488 20.7453 6.56721 20.6989 6.67999 20.62L12 16.91L17.32 20.62C17.4467 20.7063 17.5967 20.7516 17.75 20.75C17.871 20.7486 17.9903 20.7213 18.1 20.67C18.2203 20.6041 18.3208 20.5072 18.3911 20.3894C18.4615 20.2716 18.499 20.1372 18.5 20V6C18.5 5.27065 18.2103 4.57118 17.6945 4.05546C17.1788 3.53973 16.4793 3.25 15.75 3.25Z" fill="#ffffff"></path> </g></svg> Remove from Shortlist'
                        );

                        $('#session_count').text(data.count_session);

                    } else {

                        $.ajax({
                            method: "POST",
                            url: "{{ route('web.public.remove.shortlist') }}",
                            data: {
                                escortId: Eid,
                                userId: Uid
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function(data) {
                                if (data.error == 1) {
                                    $('.class_msg').text(name +
                                        ' has been remove from your Shortlist');
                                    $('#add_wishlist').modal('show');
                                    $('.myescort_' + Eid).html(
                                        '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17.75 20.75C17.5974 20.747 17.4487 20.702 17.32 20.62L12 16.91L6.68 20.62C6.56249 20.6915 6.42757 20.7294 6.29 20.7294C6.15243 20.7294 6.01751 20.6915 5.9 20.62C5.78491 20.5607 5.68741 20.4722 5.61722 20.3634C5.54703 20.2546 5.50661 20.1293 5.5 20V6C5.5 5.27065 5.78973 4.57118 6.30546 4.05546C6.82118 3.53973 7.52065 3.25 8.25 3.25H15.75C16.4793 3.25 17.1788 3.53973 17.6945 4.05546C18.2103 4.57118 18.5 5.27065 18.5 6V20C18.5005 20.1362 18.4634 20.2698 18.3929 20.3863C18.3223 20.5027 18.2209 20.5974 18.1 20.66C17.9927 20.7189 17.8724 20.7498 17.75 20.75ZM12 15.25C12.1532 15.2484 12.3033 15.2938 12.43 15.38L17 18.56V6C17 5.66848 16.8683 5.35054 16.6339 5.11612C16.3995 4.8817 16.0815 4.75 15.75 4.75H8.25C7.91848 4.75 7.60054 4.8817 7.36612 5.11612C7.1317 5.35054 7 5.66848 7 6V18.56L11.57 15.38C11.6967 15.2938 11.8468 15.2484 12 15.25Z" fill="#fff"></path> </g></svg> Add to Shortlist'
                                    )
                                    $('#session_count').text(data.count_session);

                                }

                            }
                        });
                    }
                },
                error: function(xhr, status) {
                    if (status === 'abort') {
                        return;
                    }
                },
                complete: function() {

                    $('#page_loader').hide();
                    ajaxReq = null;
                }
            });

        });
        $(document).on('click', '.removeshortlist', function() {
            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            $('#add_wishlist').find('.popup_modal_title_new').text('Add To Shortlist');
            $.ajax({
                method: "POST",
                url: "{{ route('web.public.remove.shortlist') }}",
                data: {
                    escortId: Eid,
                    userId: Uid
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                beforeSend: function() {
                    $('#page_loader').show();
                },
                success: function(data) {
                    if (data.error == 1) {
                        $('#add_wishlist').modal('show');
                        $('.class_msg').text(name + ' has been remove from your Shortlist');
                        $('.myescort_' + Eid).text('Add to Shortlist');
                        $('#session_count').text(data.count_session);
                        $("#close").click(function() {
                            location.reload();
                        });
                    }

                },
                error: function(xhr, status) {
                    if (status === 'abort') {
                        return;
                    }
                },
                complete: function() {
                    $('#page_loader').hide();
                    ajaxReq = null;
                }
            });
        });

        $(document).on('click', '#clear_all_escort_list', function() {
            $.ajax({
                method: 'GET',
                url: "{{ route('web.public.shortlist.clear') }}",
                beforeSend: function() {
                    $('#page_loader').show();
                },
                success: function(response) {
                    if (response.status === true) {
                        response.data.forEach(function(val) {
                            $(`#escort_${val}`).html('Add to Shortlist');
                        });

                        $('#session_count').html(0);
                    }
                },
                error: function(xhr, status) {
                    if (status === 'abort') {
                        return;
                    }
                },
                complete: function() {
                    $('#page_loader').hide();
                }
            });
        });

        //--------------Remove ther shortlist and removeshortlist function code --------------//

        $(document).on('click', '.add_to_favrate', function() {
            if (window.authUser.myLegboxDisabled && window.authUser.auth_user_type == '0') {
                swal_error_warning('My Legbox',
                    'Please note you have disabled this feature. <br> To access this feature, go to your setting in My Account.'
                );
                return false;
            }

            var name = $(this).attr('data-name');
            var Eid = $(this).attr('data-escortId');
            var Uid = $(this).attr('data-userId');
            var cidcl = $(this).attr('class');
            var cid = cidcl.split(' ');


            // if (cid[1] == 'fill') {
            if (cid.includes('fill')) {
                $(this).removeClass('fill');
                $(this).addClass('null');
                $('.legboxClass_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i><span class='custom-heart-text remove-tool'>Remove from My Legbox</span>"
                );
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i><span class='custom-heart-text'>Remove from My Legbox</span>"
                );

                var url = "{{ route('user.save.legbox', ':id') }}";
                url = url.replace(':id', Eid);
                $('.class_msg').text(name + ' added to your Legbox');
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

                var url = "{{ route('user.delete.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                //$('.class_msg').text(name + ' Remove from Legbox ');
                $('.class_msg').text(name + ' has been removed from your Legbox ');
                $('#add_wishlist').find('.popup_modal_title_new').text('My Legbox');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {}
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

        $(document).ready(function() {
            // When this specific button is clicked
            $('.custom-profile-search-btn').on('click', function() {
                $('#search_by_radio').val(1); // Set value to 1 when this button is used
            });

            // Optional: Reset to 0 if any other button submits the form
            $('form').on('submit', function(e) {
                if (!$(document.activeElement).hasClass('custom-profile-search-btn')) {
                    $('#search_by_radio').val(0);
                }
            });
        });

        $(document).ready(function() {
            // When this specific button is clicked
            $('.apply_pagination_button').on('click', function() {
                $('#apply_pagination_rule').val(1); // Set value to 1 when this button is used
            });

            // Optional: Reset to 0 if any other button submits the form
            $('form').on('submit', function(e) {
                if (!$(document.activeElement).hasClass('apply_pagination_button')) {
                    $('#apply_pagination_rule').val(0);
                }
            });
        });


    </script>
@endpush
