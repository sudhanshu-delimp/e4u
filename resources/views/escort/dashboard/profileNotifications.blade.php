@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Notifications & Features</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        ><b>Help?</b> </span>
            </div>
            <div class="mb-4 col-md-12">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Enable and disable your notification and feature preferences.</li>
                            <li>For a Viewer or Agent to receive your Notifications, the Viewer or Agent must have
                                also enabled the feature.</li>
                                <li>Please note what features are enabled by default.</li>
                                <li>Your Auto-Recharge option is ‘No’ by default.
                                    <ol class="level-2">
                                        <li>select your preferred option. The preferred option will remain in place until you
                                            change it. The Top Up will occur when your Credit balance falls below
                                            $100.00. The Transaction will take place on the day you reach $100.00 or less.</li>
                                        <li>
                                            if the Top Up can not be processed, due to your bank rejecting the transaction,
                                            you will receive an A-Alert Email from us. Please be mindful that a rejection of
                                            the transaction by your bank may affect any Listing you have or Tour status.
                                        </li>
                                    </ol>
                                </li>
                                <li>Note also the default setting for 2FA authentification.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div id="globalAlert" class="alert d-none rounded " role="alert"></div>
            </div>
            <div class="col-md-12" id="profile_and_tour_options">

                <form class="v-form-design" id="profile_notification_options"
                    action="{{ route('escort.notification.update') }}" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group notification_checkbox_div">
                                <h3 class="h3">Features</h3>

                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="notification_feature1" name="notification_feature[]" value="viewer_notification"
                                        @if (!empty(auth()->user()->notification_features)) {{ in_array('viewer_notification', auth()->user()->notification_features) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="notification_feature1">Viewer notifications, forward V-Alerts</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="notification_feature2" name="notification_feature[]" value="viewer_ask_question"
                                        @if (!empty(auth()->user()->notification_features)) {{ in_array('viewer_ask_question', auth()->user()->notification_features) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="notification_feature2">Allow Viewers to ask you a question</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="notification_feature3" type="checkbox" name="notification_feature[]" value="viewer_send_text"
                                        @if (!empty(auth()->user()->notification_features)) {{ in_array('viewer_send_text', auth()->user()->notification_features) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="notification_feature3">Allow Viewers to send you a text message</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="notification_feature4" name="notification_feature[]" value="available_playmate" type="checkbox"
                                        @if (!empty(auth()->user()->notification_features)) {{ in_array('available_playmate', auth()->user()->notification_features) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="notification_feature4">I’m available as a playmate</label>
                                </div>
                                

                                <div class="mt-2"><i>Some features are enabled by default unless you disable them.</i></div>
                            </div>
                            <div class="form-group">
                                <h3 class="h3">Auto-Recharge options</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked
                                        name="alert_notifications[]" id="alert_notifications1" value="1">
                                    <label class="form-check-label" for="alert_notifications1">No</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="auto-recharge" type="checkbox"
                                        id="auto-recharge" value="2">
                                    <label class="form-check-label" for="auto-recharge">$100.00</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="auto-recharge" type="checkbox"
                                        id="auto-recharge" value="2">
                                    <label class="form-check-label" for="auto-recharge">$250.00</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="auto-recharge" type="checkbox"
                                        id="auto-recharge" value="2">
                                    <label class="form-check-label" for="auto-recharge">$500.00</label>
                                </div>
                                <div class="pt-1"><i>Select your preferred top up value to be applied to your Credit.</i></div>
                            </div>
                            <div class="form-group">
                                <h3 class="h3">Agent</h3>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="agent_communications1"
                                        value="1" name="agent_communications[]"
                                        @if (!empty(auth()->user()->agent_communications)) {{ in_array(1, auth()->user()->agent_communications) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="agent_communications1">Receive communications</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="agent_communications2"
                                        value="2" name="agent_communications[]"
                                        @if (!empty(auth()->user()->agent_communications)) {{ in_array(2, auth()->user()->agent_communications) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="agent_communications2">Send communications</label>
                                </div>
                                
                                <div class="mt-2"><i>Enable communications between you and your Escort Agency (if
                                        applicable).</i></div>
                            </div>
                            <div class="form-group">
                                <h3 class="h3">Alert notifications</h3>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="alert_notifications[]"
                                        id="alert_notifications1" value="1"
                                        @if (!empty(auth()->user()->alert_notifications)) {{ in_array(1, auth()->user()->alert_notifications) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="alert_notifications1">Email (A-Alert)</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="alert_notifications[]"
                                        id="alert_notifications2" value="2"
                                        @if (!empty(auth()->user()->alert_notifications)) {{ in_array(2, auth()->user()->alert_notifications) ? 'checked' : '' }} @endif>
                                    <label class="custom-control-label" for="alert_notifications2">Text</label>
                                </div>
                                
                                <div class="mt-2"><i>How Escorts4U will communicate with you.</i></div>
                            </div>
                            
                            <div class="form-group">
                                <h3 class="h3">Idle Time Preference</h3>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="idle_time" id="idle_15" value="15" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 15) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idle_15">15 minutes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="idle_time" id="idle_30" value="30" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 30) ? 'checked' : (auth()->user()->idle_preference_time == null ? 'checked' : '') }} >
                                    <label class="form-check-label" for="idle_30">30 minutes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="idle_time" id="idle_60" value="60" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 60) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idle_60">60 minutes</label>
                                </div>
                                <!-- Info -->
                                <div class="pt-1">
                                    <i>Set the Idle time you want before you are logged out of your Console.</i>
                                </div>
                            </div>
                            <div class="form-group">
                                <h3 class="h3">2FA Authentication</h3>
                            
                                <!-- Email Option -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="auth" id="auth_email" value="1">
                                    <label class="form-check-label" for="auth_email">Email</label>
                                </div>
                            
                                <!-- Text Option -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="auth" id="auth_text" value="2" checked>
                                    <label class="form-check-label" for="auth_text">Text</label>
                                </div>
                            
                                <!-- Info -->
                                <div class="pt-1">
                                    <i>How your authentication code will be sent to you.</i>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <h3 class="h3">Subscriptions</h3>
                            
                                <!-- G NUM Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="num" value="NUM">
                                    <label class="form-check-label" for="num">NUM</label>
                                </div>
                            
                                <!-- Coverage Options (Radio Buttons) -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subscription" id="home_state" value="HS">
                                    <label class="form-check-label" for="home_state">Home State</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subscription" id="aus_wide" value="AUS">
                                    <label class="form-check-label" for="aus_wide">Australia wide</label>
                                </div>
                            
                                <!-- Subscription Info -->
                                <div class="pt-1">
                                    <i>Monthly subscriptions. Your card will be automatically debited on the 1st of each month.</i>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <input type="submit" value="save" class="btn-common" name="submit">
                </form>
            </div>
        </div>
        <!--middle content end here-->
    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


    <script type="text/javascript">
        $('#userProfile').parsley({

        });



        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
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
                            $.toast({
                                heading: 'Success',
                                text: 'Details successfully saved',
                                icon: 'success',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Records Not update',
                                icon: 'error',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        }
                    },

                });
            }
        });

        $('#city').select2({
            allowClear: true,
            placeholder: 'Select City',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        state_id: $('#state').val()
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

        $('#state').select2({
            allowClear: true,
            placeholder: 'Select State',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        country_id: $('#country').val()
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


        $('#country').on('change', function(e) {
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });



        $('#method_Email_dummy').on('click', function(e) {
            var id = $(this).val();

            // var url = "{{ route('escort.playmate.check') }}";

            var url = "{{ route('escort.playmate.check') }}";
            if ($(this).is(":checked") == true) {
                console.log("true");

                //             $.post(url, function(response){
                //       alert("success");
                //     //   $("#mypar").html(response.amount);
                // });



                // console.log('jshjsj', url);

                $.post(
                    url,

                    {
                        available_playmate: id,

                        //membership: membership,

                    }
                    //headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                ).done(function(data) {
                    console.log(data);
                }).error(function(err) {
                    console.log(err)
                });

            }
            if ($(this).is(":checked") == false) {

                console.log("false");
                console.log(url);
                $.post(
                    url, {
                        available_playmate: null,

                        //membership: membership,

                    },
                    //headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                ).done(function(data) {
                    console.log(data);
                }).error(function(err) {
                    console.log(err)
                });
            }

        });


        function showGlobalAlert(message, type = 'success') {
            const alertBox = $('#globalAlert');
            alertBox
                .removeClass('d-none alert-success alert-danger')
                .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
                .html(message);

            setTimeout(() => {
                alertBox.addClass('d-none');
            }, 10000); // Hide after 4 seconds
        }
        $('#profile_notification_options').on('submit', function(e) {
            e.preventDefault();
            $("#modal-title").text('Notifications & Features');

            var form = $(this);
            var url = form.attr('action');
            var data = new FormData(form[0]);

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
                        showGlobalAlert("Notification settings saved successfully.", "success");
                    } else {
                        showGlobalAlert("Something went wrong. Please try again.", "danger");
                    }
                },
                error: function(xhr) {
                    showGlobalAlert("❌ Server error occurred.", "danger");
                    console.error("AJAX error: ", xhr.responseText);
                }
            });
        });

        // old
        // $('#profile_notification_options').on('submit', function(e) {
        //   e.preventDefault();
        //      $("#modal-title").text('Notifications & Features');
        //     var form = $(this);
        //     var url = form.attr('action');
        //     var data = new FormData(form[0]);
        //     $.ajax({
        //       method: form.attr('method'),
        //       url: url,
        //       data: data,
        //       contentType: false,
        //       processData: false,
        //       headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //       },
        //       success: function(data) {
        //         if (!data.error) {
        //           $('.comman_msg').html("Saved");
        //           //$("#my_account_modal").modal('show');
        //           //$("#my_account_modal").show();
        //           $("#comman_modal").modal('show');

        //         } else {
        //           $('.comman_msg').html("Oops.. sumthing wrong Please try again");
        //           $("#comman_modal").show();

        //         }
        //       },

        //     });

        // });
    </script>
@endpush
