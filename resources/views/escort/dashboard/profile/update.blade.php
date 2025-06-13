@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">


    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.new.min.js') }}"></script>
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
                                        action="{{ route('escort.setting.profile', request()->segment(3)) }}"
                                        method="post" enctype="multipart/form-data">
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
    @push('script')
        <script>
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
        </script>
        <script>
            $('#read_more').parsley({

            });
            $('#myability').parsley({

            });
            $('#myPolicy').parsley({

            });
            $('#update_about_me').parsley({});

            jQuery(document).ready(function() {
                $('#state_id').change(function() {
                    var stateId = $(this).val();
                    if (stateId == 3903) {
                        $('[name="license"]').attr('required', true);
                    } else {
                        $('[name="license"]').attr('required', false);
                    }
                    var url = "{{ route('escort.stateByCity', ':id') }}";
                    url = url.replace(':id', stateId);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            stateId: stateId
                        },
                        contentType: "application/json",
                        success: function(data) {
                            optionString = '';
                            $.each(data.data, function(index, elem) {
                                optionString += '<option value=' + index + '>' + elem +
                                    '</option>';
                            });
                            $('#city_id').html(optionString);
                        },
                    });
                });

                var url = $(location).attr('pathname');

                if ($("#state_id").val() == 3903) {
                    $('[name="license"]').attr('required', true);
                } else {
                    $('[name="license"]').attr('required', false);
                }
                $('#language').change(function() {
                    var languageValue = $('#language').val();
                    $("#show_language").show();
                    $(".select_lang").hide();
                    $(".select_lang").remove();
                    $(".lang").val('');
                    var selectedLanguage = $(this).children("option:selected", this).data("name");
                    $("#show_language").append(
                        "  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>" +
                        selectedLanguage + " </span> </div> ");
                    $("#container_language").append(
                        "<input class='languageInput' type='hidden' name='language[]' value=" +
                        languageValue + ">");
                    $("#language option[value='" + languageValue + "']").remove();
                });

                $('body').on('click', '.akh1', function() {
                    var id = $(this).attr('id');
                    var val = $(this).data('val');
                    var name = $(this).data('sname');
                    $('#hideenclassOne_' + val).remove();

                    $("#service_id_one").append("<option id='" + name + "' value='" + val + "'>" + name +
                        "</option>");

                });
                $('body').on('click', '.akh2', function() {
                    var id = $(this).attr('id');
                    var val = $(this).data('val');
                    var name = $(this).data('sname');
                    $('#hideenclassTwo_' + val).remove();

                    $("#service_id_two").append("<option id='" + name + "' value='" + val + "'>" + name +
                        "</option>");
                });
                $('body').on('click', '.akh3', function() {
                    var id = $(this).attr('id');
                    var val = $(this).data('val');
                    var name = $(this).data('sname');
                    $('#hideenclassThree_' + val).remove();

                    $("#service_id_three").append("<option id='" + name + "' value='" + val + "'>" + name +
                        "</option>");
                });
                /** Save My service form data when open in edit mode */
                jQuery('#myServicesForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    var data = new FormData($('#myServicesForm')[0]);

                    $('#my_services').prop('disabled', true);
                    $('#my_services').html('<div class="spinner-border"></div>');

                    $.ajax({
                        method: form.attr('method'),
                        url: url,
                        data: data,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (!data.error) {
                                Swal.fire('Updated', '', 'success');
                                $('#my_services').prop('disabled', false);
                                $('#my_services').html('Updated');
                            } else {
                                 Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                                $('#my_services').prop('disabled', false);
                                $('#my_services').html('Updated');
                            }
                        },
                        error: function(data) {
                             Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                            $('#my_services').prop('disabled', false);
                            $('#my_services').html('Updated');
                        }
                    }); 
                });

            }); // end (document).ready


            $('#service_id_one').on('change', function() {
                var selectedIdOne = $('#service_id_one').val();
                var getNameOne = $(this).children(":selected").attr("id");
                if (selectedIdOne) {
                    $("#selected_service_one").append(" <li id='hideenclassOne_" + selectedIdOne +
                        "'><div class='my_service_anal' ><span class='dollar-sign'>" + getNameOne +
                        "</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step='10' max=200><input type='hidden' name='service_id[]' value=" +
                        selectedIdOne + " placeholder=''><span><i class='fas fa-times-circle akh1' data-sname='" +
                        getNameOne + "' data-val=" + selectedIdOne + "  id='id_" + selectedIdOne + "' value=" +
                        selectedIdOne + "></i></span></div></li> ");
                    $("#service_id_one option[value=" + selectedIdOne + "]").attr('disabled', 'disabled');
                    $("#service_id_one option[value=" + selectedIdOne + "]").remove();

                }
            });

            $('#service_id_two').on('change', function() {
                var selectedIdTwo = $('#service_id_two').val();
                var getNameTwo = $(this).children(":selected").attr("id");
                if (selectedIdTwo) {
                    $("#selected_service_two").append(" <li id='hideenclassTwo_" + selectedIdTwo +
                        "'><div class='my_service_anal hideenclassTwo" + selectedIdTwo +
                        "'><span class='dollar-sign'>" + getNameTwo +
                        "</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step='10' max=200><input type='hidden' name='service_id[]' value=" +
                        selectedIdTwo + " placeholder=''><span><i class='fas fa-times-circle akh2'  data-sname='" +
                        getNameTwo + "' data-val=" + selectedIdTwo + "  id='id_" + selectedIdTwo + "' value=" +
                        selectedIdTwo + "></i></span></div></li> ");
                    $("#service_id_two option[value=" + selectedIdTwo + "]").attr('disabled', 'disabled');
                    $("#service_id_two option[value=" + selectedIdTwo + "]").remove();
                }
            });

            $('#service_id_three').on('change', function() {
                var selectedIdThree = $('#service_id_three').val();
                var getNameThree = $(this).children(":selected").attr("id");
                if (selectedIdThree) {
                    $("#selected_service_three").append(" <li id='hideenclassThree_" + selectedIdThree +
                        "'><div class='my_service_anal hideenclassThree" + selectedIdThree +
                        "'><span class='dollar-sign'>" + getNameThree +
                        "</span><input type='number' class='dollar-before  input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step='10' max=200><input type='hidden' name='service_id[]' value=" +
                        selectedIdThree +
                        " placeholder=''><span><i class='fas fa-times-circle akh3'  data-sname='" + getNameThree +
                        "' data-val=" + selectedIdThree + "  id='id_" + selectedIdThree + "' value=" +
                        selectedIdThree + "></i></span></div></li> ");
                    $("#service_id_three option[value=" + selectedIdThree + "]").attr('disabled', 'disabled');
                    $("#service_id_three option[value=" + selectedIdThree + "]").remove();
                }
            });


            //start available //
            $('.available_to').click(function() {
                var val = $(this).val();
                $(this).is(':checked') ? $('#' + val).show() : $('#' + val).hide();
            });
            $('.draft').click(function() {
                var val = $(this).val();
                $("#total_rate").html('');
                $(this).is(':checked') ? $(this).val(1) : $(this).val(2);

                if ($(this).is(':checked')) {
                    $("#start_date").attr({
                        'disabled': true,
                        'required': false
                    });
                    $("#end_date").attr({
                        'disabled': true,
                        'required': false
                    });
                    $("#membership").attr({
                        'disabled': true,
                        'required': false
                    });

                    $('#pricing-tab').attr('id', 'pricing-tab-1')
                    $('#pricing-tab-1').hide()
                    $("#show_draft").show();
                } else {
                    $("#start_date").attr({
                        'disabled': false,
                        'required': true
                    });
                    $("#end_date").attr({
                        'disabled': false,
                        'required': true
                    });
                    $("#membership").attr({
                        'disabled': false,
                        'required': true
                    });
                    $('#pricing-tab-1').attr('id', 'pricing-tab')
                    $("#pricing-tab").show();
                    $("#show_draft").hide();
                }
            });
            $('.playType').click(function() {
                var val = $(this).val();
                var name = $(this).data('name');
                $(".show_playType").show();
                if ($(this).is(':checked')) {
                    $("#show_playType").append(
                        "<div class='selecated_languages playT' style='display: inline-block' id='" + val +
                        "'><span class='languages_choosed_from_drop_down'>" + name + " </span> </div> ")
                } else {
                    $('#show_playType #' + val).remove();
                }
            });


            $('#banner-image-upload').on('change', function(e) {
                $('#banner-image-preview').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#banner-video-upload').on('change', function(e) {
                $('#banner-video-preview').show();
                $('#banner-video-preview').attr('src', URL.createObjectURL(e.target.files[0]));
            });



            $('#play-mates-modal').on('shown.bs.modal', function(e) {

                var name, city, source = e.relatedTarget;

                $('#hidden_escort_id').val($(source).data('id'));

                if (name = $(source).data('name')) {
                    $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
                }

                if (city = $(source).data('city')) {
                    $('#playmate-modal-location').html(
                        '<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' +
                        $(source).data('city'));
                }

                $.ajax({
                    url: $(source).data('url'),
                    success: function(data) {
                        $('#playmate-template').html(data);
                    }
                });
            });

            $('#play-mates-modal').on('hidden.bs.modal', function() {
                $('#playmate-template').html(
                    '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
                );
                $('#playmate-modal-name').html('');
                $('#playmate-modal-location').html('');
            });


            $('#add-playmate-form').on('submit', function(e) {
                e.preventDefault();
                $('#playmate_submit_button').attr('disabled', true);
                $('#playmate_submit_button').html(
                    '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
                var $this = $(this);
                var escort_id = $('#hidden_escort_id').val();
                var member_id = $('#search-playmate-input').val();
                var url = $this.attr('action');

                $.post({
                    type: $this.attr('method'),
                    url: url,
                    data: {
                        escort_id: escort_id,
                        playmate_id: member_id
                    },
                    success: function(data) {
                        $('#search-playmate-input').val('');
                        $('#playmate_submit_button').hide();
                        $('#playmate-template').html(data);
                    },
                    error: function(data) {},
                }).done(function(data) {
                    $('#playmate_submit_button').attr('disabled', false);
                    $('#playmate_submit_button').html('Add Playmate');

                    //$("#search-playmate-input").select2("val", "");

                    $("#search-playmate-input").empty().trigger('change')

                });
            });

            $(document).on('click', '.remove-playmate', function(e) {
                e.preventDefault();

                var $this = $(this);
                var escort_id = $this.data('escort_id');
                var playmate_id = $this.data('playmate_id');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Remove',
                    cancelButtonText: 'Cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post({
                            type: 'POST',
                            url: "{{ route('escort.playmates.remove') }}",
                            data: {
                                escort_id: escort_id,
                                playmate_id: playmate_id
                            },
                        }).done(function(data) {
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message
                                });
                            } else {
                                swalWithBootstrapButtons.fire({
                                    icon: 'success',
                                    title: '',
                                    text: data.message
                                });
                                $('#playmate-template').html(data.template);
                            }
                        });
                    }
                });
            });

            $("body").on('click', '.nex_sterp_btn', function(e) {
                // e.preventDefault();
                var id = $(this).attr('id');
                $(this).removeClass('active');
                $(".nav-link").removeClass('active');
                $("#" + id).addClass('active');
                if (profile_selected_images.length > 0) {
                    $("#setAsDefaultForMainAccount").modal('show');
                }
            });

            $('.covidreport').on('change', function(e) {
                if ($(this).val() == 1 || $(this).val() == 2) {
                    $('#covid-file-block').show();
                } else {
                    $('#covid-file-block').hide();
                }
            })




            //TODO::WIP we need to enable this for both create and edit and clicking ok will update data in the users table
            @if (request()->segment(2) == 'profile' || request()->segment(2) == 'create-profile')
                $(function() {
                    var previous;

                    $(".change_default").focus(function() {
                        previous = this.value;

                    }).on('change paste', function() {
                        // Do soomething with the previous value after the change
                        var Current = $(this).val();

                        var original = $(this).parent().prev().text();
                        let label = original.substring(0, original.lastIndexOf(":"));
                        $('#trigger-element').val($(this).attr('name'));
                        $('#label').val(label);
                        $('#current').val(Current);
                        $('#previous').val(previous);

                        if (label == 'stageName' && Current === 'new') {

                            return true;
                        }

                        if (this.id == 'language') {
                            $('#trigger-element').val('language');
                            let values = $(".languageInput").map(function() {
                                return $(this).val();
                            }).get();
                            $('#current').val(values);
                        }

                        if ($(this).attr('name') == 'available_to[]' || $(this).attr('name') ==
                            'available_to') {
                            $('#trigger-element').val('available_to');
                            let checkedValues = $(".available_to:checked").map(function() {
                                return $(this).val();
                            }).get();
                            $('#current').val(checkedValues);
                        }

                        if ($(this).attr('name') == 'play_type[]' || $(this).attr('name') == 'play_type') {
                            $('#trigger-element').val('play_type');
                            let checkedValues = $(".playType:checked").map(function() {
                                return $(this).val();
                            }).get();
                            $('#current').val(checkedValues);
                        }
                        $("#Lname").html("<p>Would you like to update <b>" + label +
                            "</b> in your My Information page for future Profiles?</p>");

                        if ($(this).attr('name') != 'license' || ($(this).attr('name') == 'license' &&
                                Current != '')) {
                            $('#change_all').modal('show');
                        }
                        previous = this.value;
                    });
                });
            @endif

            $("#change_all").on("hidden.bs.modal", function(e) {

                if ($('#change_all').hasClass('programmatic')) {
                    var trigger_elem = $('#trigger-element').val();
                }
            });
            $(document).ready(function() {

                $('#save_change').on("click", function(e) {
                    $('#change_all').removeClass('programmatic');
                    if ($('#label').val() == 'Gender') {
                        _displayGenderDependentFields($('#current').val());
                    }
                    $('#change_all').modal('hide');
                });
                $.each($("input[name^='availability_time']"), function(index, value) {
                    if ($(value).is(':checked')) {
                        $(value).closest('.parent-row').find('select').attr('disabled', true);
                    }
                });

                $(document).on('change',
                    'input.monday, input.tuesday, input.wednesday, input.thursday, input.friday, input.saturday, input.sunday',
                    function() {
                        var p_element = $(this).attr('id');
                        if ($('#' + p_element).is(":checked")) {
                            $('#' + p_element).closest('.parent-row').find('select').attr('disabled', true).val(0);
                        } else {
                            $('#' + p_element).closest('.parent-row').find('select').attr('disabled', false);
                        }
                    });


                $('.resetdays').click(function() {
                    var p_element = $(this);
                    var id = $(this).attr('id');
                    var element_class = p_element.attr('data-day');

                    $('select.' + element_class).prop('selectedIndex', 0);
                    $('select.' + element_class).attr('disabled', false)
                    var ch = $('input.' + element_class + ":checked").val();
                    $('input.' + element_class + ":checked").prop('checked', false);
                });
            });
            $("#close").click(function() {
                $("#comman_modal").modal('hide');
            });

            $("body").on("click", "#defaultImg", setDefaults);

            $(document).ready(function(e) {
                @if (request()->getPathInfo() == '/escort-dashboard/create-profile')
                    setDefaults();
                @endif
            });

            function setDefaults() {
                var url = "{{ route('escort.get.default.images') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.error == true) {

                            $("#blah1").attr('src', data.path[1]['path']);
                            $("#blah2").attr('src', data.path[2]['path']);
                            $("#blah3").attr('src', data.path[3]['path']);
                            $("#blah4").attr('src', data.path[4]['path']);
                            $("#blah5").attr('src', data.path[5]['path']);
                            $("#blah6").attr('src', data.path[6]['path']);
                            $("#blah7").attr('src', data.path[7]['path']);
                            $("#blah8").attr('src', data.path[8]['path']);
                            $("#blah9").attr('src', data.path[9]['path']);
                            $(".cl_blash8").attr('src', data.path[8]['path']);
                            $("#blahx").attr('src', data.path[10]['path']);
                            $("#akhVideo").attr('src', data.path[10]['path']);

                            $("#img1").attr('src', data.path[1]['path']);
                            $("#img2").attr('src', data.path[2]['path']);
                            $("#img3").attr('src', data.path[3]['path']);
                            $("#img4").attr('src', data.path[4]['path']);
                            $("#img5").attr('src', data.path[5]['path']);
                            $("#img6").attr('src', data.path[6]['path']);
                            $("#img7").attr('src', data.path[7]['path']);
                            $("#img9").attr('src', data.path[9]['path']);
                            $("#imgx").attr('src', data.path[10]['path']);

                            $("#mediaId1").val(data.path[1]['id']);
                            $("#mediaId2").val(data.path[2]['id']);
                            $("#mediaId3").val(data.path[3]['id']);
                            $("#mediaId4").val(data.path[4]['id']);
                            $("#mediaId5").val(data.path[5]['id']);
                            $("#mediaId6").val(data.path[6]['id']);
                            $("#mediaId7").val(data.path[7]['id']);
                            $("#mediaId8").val(data.path[8]['id']);
                            $("#mediaId9").val(data.path[9]['id']);
                            $("#mediaIdx").val(data.path[10]['id']);
                        } else {

                        }
                    }

                });
            }

            $("body").on("click", "#defaultImg2", setDefaults2);

            function setDefaults2() {
                var url = "{{ route('escort.get.default.images') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.error == true) {

                            $("#img9").attr('src', data.path[9]['path']);
                            $("#blah9").attr('src', data.path[9]['path']);
                            $("#mediaId9").val(data.path[9]['id']);
                            $("#blah0").attr('src', data.path[8]['path']);

                        } else {

                        }
                    }
                });
            }

            $("body").on('click', '#manageImgId', function() {
                $(".pic").each(function(e) {
                    var id = $(this).data('id');
                    var src = $(this).attr('src');
                    $("#img" + id).attr('src', src);
                });
                $("#upload-sec").modal('hide');
                $("#upload-sec-banner").modal('hide');

            });

            $(document).ready(function() {
                $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                    var ckeditorGroup = $('#my_escort_profile').parsley().validate({
                        group: 'ckeditor'
                    });
                    if ($('#my_escort_profile').parsley().validate({
                            group: 'ckeditor'
                        }) == false) {
                        e.target

                        $('#home-tab').addClass('active');
                        e.preventDefault();
                    }
                    if ($('#my_escort_profile').parsley({
                            excluded: "input[type=number], input[type=hidden]"
                        }).validate({
                            group: 'goup_one'
                        })) {
                        e.target
                        if (e.target.id == "profile-tab" && ckeditorGroup != false) {
                            $('.define_process_bar_color').attr('style', 'width :80%'); //.percent
                            $('#percent').html('80%');
                        } else if (e.target.id == "contact-tab" && ckeditorGroup != false) {
                            if ($(".draft").is(':checked')) {
                                $(".hideDraft").hide();
                                $("#show_draft").show();

                            } else {
                                $(".hideDraft").show();
                                $("#show_draft").hide();
                            }
                            $('.define_process_bar_color').attr('style', 'width :100%'); //.percent
                            $('#percent').html('100%');
                        } else if (e.target.id == "massuers-tab" && ckeditorGroup != false) {

                        } else if (e.target.id == "pricing-tab" && ckeditorGroup != false) {

                            $('.define_process_bar_color').attr('style', 'width :100%'); //.percent
                            $('#percent').html('100%');

                            var name = $("#profile_name").val();
                            $('#pro_name_tab').html(name);

                            var user_createdat = new Date($("#user_startDate").val());
                            var end = new Date($("#end_date").val());
                            var start = new Date($("#start_date").val());
                            var ss = start.setDate(start.getDate());
                            var first_date = moment(ss).format('YYYY-MM-DD');

                            var user_diff = end.getTime() - user_createdat.getTime();
                            var diff = end.getTime() - start.getTime();
                            var days = diff / (1000 * 3600 * 24);
                            var user_diff_days = user_diff / (1000 * 3600 * 24);
                            var plan = $("#membership").val();
                            $('#start_date_tab').html(first_date);
                            if (plan == 1) {
                                var actual_rate = 8;
                                if (days <= 21) {
                                    var rate = 8;
                                } else {
                                    var rate = 7.5;
                                    var dis_rate = 0.5;
                                }
                                var plan_name = "Platinum";
                            } else if (plan == 2) {
                                var actual_rate = 6;
                                if (days <= 21) {
                                    var rate = 6;
                                } else {
                                    var rate = 5.7;
                                    var dis_rate = 0.3;
                                }
                                var plan_name = "Gold";
                            } else if (plan == 3) {
                                var actual_rate = 4;
                                if (days <= 21) {
                                    var rate = 4;
                                } else {
                                    var rate = 3.8;
                                    var dis_rate = 0.2;
                                }
                                var plan_name = "Silver";
                            } else {

                                var actual_rate = 0;
                                var rate = 0;
                                var dis_rate = 0;
                                var plan_name = "Free";
                                var payDays = days - 14;
                                var userPayDays = user_diff_days - 14;
                                days = userPayDays;
                                if (userPayDays < 1) {
                                    var actual_rate = 0;
                                    var rate = 0;
                                    var dis_rate = 0;
                                } else if (userPayDays <= 21 && userPayDays >= 1) {
                                    var rate = 4;
                                } else {
                                    var rate = 3.8;
                                    var dis_rate = 0.2;
                                }
                            }
                            $('#plan').html(plan_name);
                            if (days > 1) {
                                $('#duration_tab').html(days + " Days");
                            } else {
                                $('#duration_tab').html(days + " Day");
                            }

                            if (days !== null && days <= 21) {
                                var total_rate = days * rate;
                                var dis = 0;
                                $('#rate_tab').html("$ " + rate.toFixed(2));
                            } else {
                                var days_21 = 21 * actual_rate;
                                var above_day = days - 21;

                                var total_rate = (above_day * rate + days_21);

                                var dis = above_day * dis_rate;

                                $('#rate_tab').html("$ " + rate.toFixed(2));
                            }

                            $('#dis_tab').html("$ " + dis.toFixed(2));
                            var draft = $(".draft").val();
                            if (draft == 1) {
                                $('#total_rate').html("$ 0.00");
                            } else {
                                $('#total_rate').html("$ " + total_rate.toFixed(2));
                            }
                            $('#fee_tab').html("$ " + actual_rate.toFixed(2));

                            $("#poli_payment").click(function(e) {
                                $('#poli_payment').prop('disabled', true);
                                $('#poli_payment').html('<div class="spinner-border"></div>');
                                var escortId = $('#profile_id').val();
                                var url = "{{ route('escort.poli.paymentUrl', ':id') }}";
                                url = url.replace(':id', escortId);

                                $('<form/>', {
                                    action: url,
                                    method: 'POST'
                                }).append($('<input>', {
                                    type: 'hidden',
                                    name: '_token',
                                    value: '{{ csrf_token() }}'
                                }), ).appendTo('body').submit();

                            })
                        } else {
                            $('.define_process_bar_color').attr('style', 'width :25%'); //.percent
                            $('#percent').html('25%');
                        }

                    } else {
                        $('#home-tab').addClass("active");
                        $("#profile-tab").removeClass('active');
                        e.preventDefault();

                    }
                });
            });

            function update_escort(updateButton, form_data) {
                updateButton.prop('disabled', true).html('<div class="spinner-border"></div>');
                var url = "{{ route('escort.update_escort', $escort->id) }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.error == true) {
                            Swal.fire('Error! Unable to update', '', 'error');
                            updateButton.prop('disabled', false).html('Update');
                        } else {
                            Swal.fire('Updated', '', 'success');
                            updateButton.prop('disabled', false).html('Update');
                        }
                    }
                });
            }

            function update_escort_default(updateButton, form_data) {
                updateButton.prop('disabled', true).html('<div class="spinner-border"></div>');
                var url = "{{ route('escort.update_escort_default') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.error == true) {

                            updateButton.prop('disabled', false).html('Yes');
                        } else {
                            updateButton.prop('disabled', false).html('Yes');
                        }
                    }
                });
            }
            var textarea = document.getElementById('editor1');

            CKEDITOR.editorConfig = function(config) {
                config.toolbarGroups = [{
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    '/',
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    }
                ];

                config.removeButtons =
                    'Underline,Subscript,Superscript,PasteText,PasteFromWord,Scayt,Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,Maximize,About,RemoveFormat,Strike';
            };
            let editor = CKEDITOR.replace(textarea);
            editor.on('instanceReady', function() {
                $.each(CKEDITOR.instances, function(instance) {
                    CKEDITOR.instances[instance].on("change", function(e) {
                        var desc = CKEDITOR.instances['editor1'].getData();
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();

                            let validateee = $('#my_escort_profile').parsley().validate({
                                group: 'ckeditor'
                            });
                            if (validateee != true) {
                                $(".who_am_i").attr('id', "who_am_i");
                            }
                            if (validateee == true) {
                                $(".who_am_i").attr('id', "update_who_am_i");
                            }
                        }
                    });
                });
            });
            let deleteKey = 46;
            let backspaceKey = 8;
            let leftArrowKey = 37;
            let rightArrowKey = 38;
            let topArrowKey = 39;
            let bottomArrowKey = 40;
            let charLimit = 2500;
            window.onload = function() {
                CKEDITOR.instances.editor1.on('key', function(event) {
                    let keyCode = event.data.keyCode;
                    var str = CKEDITOR.instances.editor1.getData();
                    if (str.length > charLimit) {
                        return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                            .includes(keyCode);
                    }
                });
                CKEDITOR.instances.editor1.on('paste', function(event) {
                    var keyCode = event.data.keyCode;
                    var str = CKEDITOR.instances.editor1.getData();
                    if (str.length > charLimit) {
                        return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                            .includes(keyCode);
                    }
                });
            };
        </script>
    @endpush
