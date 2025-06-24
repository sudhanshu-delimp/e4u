@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js?v1.1') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0);
            padding: 0;
        }

        .parsley-errors-list li {
            font-size: 14px;
            line-height: 18px;
            margin-top: 6px;
        }
    </style>
    <script>
        function _displayGenderDependentFields(genderVal) {
            if (['1', '3'].indexOf(genderVal) <= -1) {
                $(".femaleFields").show();
                $(".maleFields").hide();
            } else if (['6', '3'].indexOf(genderVal) <= -1) {
                $(".maleFields").show();
                $(".femaleFields").hide();
            } else {
                $(".maleFields").show();
                $(".femaleFields").show();
            }
        }

        function formatEscortList(data) {
            return $(
                '<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="' +
                data.text + '"> ' + data.name + ' || ' + data.member_id + '</span>');
        }

        function selectEscortList(data) {
            return $('<span><i class="fas fa-search fa-sm" style="color: #999;"></i>  Search by name OR Member ID </span>');
        }
    </script>
@endsection
@section('content')
    <div class="d-flex flex-column container-fluid pl-3 pl-lg-5">
        <div class="row">
            <div class="col-md-12">
                @if (request()->getPathInfo() == '/escort-dashboard/create-profile')
                    <div class="v-main-heading h3" style="display:inline-block">New Profile</div>
                @else
                    <div class="v-main-heading h3" style="display:inline-block">Update Profile</div>
                @endif
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
            <div class="col-md-12 mt-4" id="profile_and_tour_options">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Use this feature to create your Profiles. You can create as many Profiles as you
                                        like for as many Locations as you like.</li>
                                    <li>The Profiles you create will be used to create Tours.</li>
                                    <li>Each time you create a Profile, it will be pre-populated with your <a
                                            href="/escort-dashboard/profile-informations"
                                            class="custom_links_design">Profile Information</a> you have set. Take the time
                                        to set up your <a href="/escort-dashboard/profile-informations"
                                            class="custom_links_design">Profile Information</a> and <a
                                            href="/escort-dashboard/archive-medias" class="custom_links_design">Media</a>.
                                        Any changes you make in the Profile Creator will only apply to that Profile unless
                                        you click the ‘Update’ button for the section you have changed. Otherwise your
                                        Profile Information settings will not change.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container-fluid">
                <!--middle content-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form_process">
                                    <div class="steps_to_filled_from">Step 1</div>
                                    <p>About me</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form_process">
                                    <div class="steps_to_filled_from">Step 2</div>
                                    <p>My Services & Rates</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form_process">
                                    <div class="steps_to_filled_from">Step 3</div>
                                    <p>My Availability</p>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3">
                            <div class="form_process">
                                <div class="steps_to_filled_from">Step 4</div>
                                <p>Check fee summary and pay</p>
                            </div>
                        </div> --}}
                            <div class="col-lg-1">
                                <div id="percent" style="font-size: 48px;font-weight: 700;">40%</div>
                            </div>
                        </div>
                        <div class="manage_process_bar_padding">
                            <div class="progress define_process_bar_width">
                                <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 40%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Page Content -->
                        <div class="row">
                            <div class="col-md-12 remove_padding_in_ph">
                                <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme"
                                            role="tab" aria-controls="home" aria-selected="true">About me</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services"
                                            role="tab" aria-controls="profile" aria-selected="false">My Services &
                                            Rates</a>
                                    </li>




                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available"
                                            role="tab" aria-controls="contact" aria-selected="false">My Availability</a>
                                </ul>
                                </li>
                                {{-- <li class="nav-item">
                                <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact" aria-selected="false">Check fee summary and pay</a>
                            </li> --}}
                                @if (request()->segment(2) == 'profile' && request()->segment(3))
                                    <form id="my_escort_profile"
                                        action="{{ route('escort.setting.profile', request()->segment(3)) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf</form>
                                    <input type="hidden" name="user_startDate" id="user_startDate"
                                        value="{{ date('Y-m-d', strtotime(auth()->user()->created_at)) }}">
                                    <div class="tab-content tab-content-bg" id="myTabContent">
                                        @include('escort.dashboard.profile.partials.aboutme-dash-tab', [
                                            'profile_type' => 'updated',
                                        ])
                                        @include('escort.dashboard.profile.partials.services-dash-tab')
                                        @include('escort.dashboard.profile.partials.available-dash-tab')
                                        {{-- @include('escort.dashboard.profile.partials.pricing-dash-tab') --}}
                                    </div>
                                @else
                                    <form id="my_escort_profile"
                                        action="{{ route('escort.setting.profile', request()->segment(3)) }}" method="post"
                                        enctype="multipart/form-data" data-parsley-validate>
                                        @csrf
                                        <input type="hidden" name="user_startDate" id="user_startDate"
                                            value="{{ date('Y-m-d', strtotime(auth()->user()->created_at)) }}">
                                        <div class="tab-content tab-content-bg" id="myTabContent">
                                            @include('escort.dashboard.profile.partials.aboutme-dash-tab', [
                                                'profile_type' => 'updated',
                                            ])
                                            @include('escort.dashboard.profile.partials.services-dash-tab')
                                            @include('escort.dashboard.profile.partials.available-dash-tab')
                                            {{-- @include('escort.dashboard.profile.partials.pricing-dash-tab') --}}
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Content Wrapper -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <!--<img src="..." class="rounded mr-2" alt="...">-->
            <strong class="mr-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">Hello, world! This is a toast message.</div>
    </div>
    <!-- <div class="modal show" id="add_wishlist" style="display: block;"> -->

    <div class="modal programmatic" id="change_all" style="display: none">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    {{-- <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5> --}}
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="current" name="current">
                    <input type="hidden" id="previous" name="previous">
                    <input type="hidden" id="label" name="label">
                    <input type="hidden" id="trigger-element">
                    <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
                    <h3 class="mb-4 mt-5"><span id="log"></span> </h3>
                    <div class="modal-footer">
                        <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                            value="close" id="close_change">No</button>
                        <button type="button" class="btn main_bg_color site_btn_primary" id="save_change">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal programmatic" id="change_all" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body text-center">
                <input type="hidden" id="current" name="current">
                <input type="hidden" id="previous" name="previous">
                <input type="hidden" id="label" name="label">
                <input type="hidden" id="trigger-element">
                <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
                <h3 class="mb-4 mt-5"><span id="log"></span> </h3>
                <button type="button" class="btn btn-danger" data-dismiss="modal" value="close" id="close_change">Close</button>
                <button type="button" class="btn btn-success" id="save_change">save</button>
                </div>
            </div>
        </div>
    </div> --}}

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@endsection
@push('script')
        <!-- <script>
            $('#select2-dropdown').select2({
                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // add additional parameters
                    }
                },
                tags: false,
                minimumInputLength: 2,
                tokenSeparators: [','],
                ajax: {
                    url: "{{ route('country.list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(params) {
                        var queryParameters = {
                            query: params.term
                        }
                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {

                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
            $('#select2_country').select2();
        </script> -->
        <script>
         // $(document).ready(function() {
            //     $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            //         var ckeditorGroup = $('#my_escort_profile').parsley().validate({
            //             group: 'ckeditor'
            //         });
            //         if ($('#my_escort_profile').parsley().validate({
            //                 group: 'ckeditor'
            //             }) == false) {
            //             e.target

            //             $('#home-tab').addClass('active');
            //             e.preventDefault();
            //         }
                    
            //         if ($('#my_escort_profile').parsley({
            //                 excluded: "input[type=number], input[type=hidden]"
            //             }).validate({
            //                 group: 'goup_one'
            //             })) {
            //             e.target
            //             if (e.target.id == "profile-tab" && ckeditorGroup != false) {
            //                 $('.define_process_bar_color').attr('style', 'width :80%'); //.percent
            //                 $('#percent').html('80%');
            //             } else if (e.target.id == "contact-tab" && ckeditorGroup != false) {
            //                 if ($(".draft").is(':checked')) {
            //                     $(".hideDraft").hide();
            //                     $("#show_draft").show();

            //                 } else {
            //                     $(".hideDraft").show();
            //                     $("#show_draft").hide();
            //                 }
            //                 $('.define_process_bar_color').attr('style', 'width :100%'); //.percent
            //                 $('#percent').html('100%');
            //             } else if (e.target.id == "massuers-tab" && ckeditorGroup != false) {

            //             } else if (e.target.id == "pricing-tab" && ckeditorGroup != false) {

            //                 $('.define_process_bar_color').attr('style', 'width :100%'); //.percent
            //                 $('#percent').html('100%');

            //                 var name = $("#profile_name").val();
            //                 $('#pro_name_tab').html(name);

            //                 var user_createdat = new Date($("#user_startDate").val());
            //                 var end = new Date($("#end_date").val());
            //                 var start = new Date($("#start_date").val());
            //                 var ss = start.setDate(start.getDate());
            //                 var first_date = moment(ss).format('YYYY-MM-DD');

            //                 var user_diff = end.getTime() - user_createdat.getTime();
            //                 var diff = end.getTime() - start.getTime();
            //                 var days = diff / (1000 * 3600 * 24);
            //                 var user_diff_days = user_diff / (1000 * 3600 * 24);
            //                 var plan = $("#membership").val();
            //                 $('#start_date_tab').html(first_date);
            //                 if (plan == 1) {
            //                     var actual_rate = 8;
            //                     if (days <= 21) {
            //                         var rate = 8;
            //                     } else {
            //                         var rate = 7.5;
            //                         var dis_rate = 0.5;
            //                     }
            //                     var plan_name = "Platinum";
            //                 } else if (plan == 2) {
            //                     var actual_rate = 6;
            //                     if (days <= 21) {
            //                         var rate = 6;
            //                     } else {
            //                         var rate = 5.7;
            //                         var dis_rate = 0.3;
            //                     }
            //                     var plan_name = "Gold";
            //                 } else if (plan == 3) {
            //                     var actual_rate = 4;
            //                     if (days <= 21) {
            //                         var rate = 4;
            //                     } else {
            //                         var rate = 3.8;
            //                         var dis_rate = 0.2;
            //                     }
            //                     var plan_name = "Silver";
            //                 } else {

            //                     var actual_rate = 0;
            //                     var rate = 0;
            //                     var dis_rate = 0;
            //                     var plan_name = "Free";
            //                     var payDays = days - 14;
            //                     var userPayDays = user_diff_days - 14;
            //                     days = userPayDays;
            //                     if (userPayDays < 1) {
            //                         var actual_rate = 0;
            //                         var rate = 0;
            //                         var dis_rate = 0;
            //                     } else if (userPayDays <= 21 && userPayDays >= 1) {
            //                         var rate = 4;
            //                     } else {
            //                         var rate = 3.8;
            //                         var dis_rate = 0.2;
            //                     }
            //                 }
            //                 $('#plan').html(plan_name);
            //                 if (days > 1) {
            //                     $('#duration_tab').html(days + " Days");
            //                 } else {
            //                     $('#duration_tab').html(days + " Day");
            //                 }

            //                 if (days !== null && days <= 21) {
            //                     var total_rate = days * rate;
            //                     var dis = 0;
            //                     $('#rate_tab').html("$ " + rate.toFixed(2));
            //                 } else {
            //                     var days_21 = 21 * actual_rate;
            //                     var above_day = days - 21;

            //                     var total_rate = (above_day * rate + days_21);

            //                     var dis = above_day * dis_rate;

            //                     $('#rate_tab').html("$ " + rate.toFixed(2));
            //                 }

            //                 $('#dis_tab').html("$ " + dis.toFixed(2));
            //                 var draft = $(".draft").val();
            //                 if (draft == 1) {
            //                     $('#total_rate').html("$ 0.00");
            //                 } else {
            //                     $('#total_rate').html("$ " + total_rate.toFixed(2));
            //                 }
            //                 $('#fee_tab').html("$ " + actual_rate.toFixed(2));

            //                 $("#poli_payment").click(function(e) {
            //                     $('#poli_payment').prop('disabled', true);
            //                     $('#poli_payment').html('<div class="spinner-border"></div>');
            //                     var escortId = $('#profile_id').val();
            //                     var url = "{{ route('escort.poli.paymentUrl', ':id') }}";
            //                     url = url.replace(':id', escortId);

            //                     $('<form/>', {
            //                         action: url,
            //                         method: 'POST'
            //                     }).append($('<input>', {
            //                         type: 'hidden',
            //                         name: '_token',
            //                         value: '{{ csrf_token() }}'
            //                     }), ).appendTo('body').submit();

            //                 })
            //             } else {
            //                 $('.define_process_bar_color').attr('style', 'width :25%'); //.percent
            //                 $('#percent').html('25%');
            //             }

            //         } else {
            //             $('#home-tab').addClass("active");
            //             $("#profile-tab").removeClass('active');
            //             e.preventDefault();

            //         }
            //     });
            // });
   
            
        </script>
    @endpush
