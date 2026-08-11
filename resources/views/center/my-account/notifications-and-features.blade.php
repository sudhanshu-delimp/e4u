@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }

        form.v-form-design label {
            line-height: unset;
        }
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Notifications & Features</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>Enable and disable your notification and feature preferences.</li>
                                    <li>For a Viewer or Agent to receive your Notifications, the Viewer or Agent must have
                                        also enabled the feature.</li>
                                    <li>Please note what features are enabled by default.</li>
                                    <li>Note also the default setting for 2FA authentification.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="globalAlert"></div>
                    </div>
                </div>
                {{-- <div class="col-md-12 commanAlert"></div> --}}

                <div class="row">
                    <div class="col-md-12" id="profile_and_tour_options">

                        <form  id="profile_notification_options"
                            action="{{ route('centre.notifications-and-features') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="common-grid">
                                        <!-- Features Section -->
                                        <div class="form-group notification_checkbox_div common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor"
                                                            stroke-width="1.8" stroke-linecap="round" />

                                                        <circle cx="9" cy="6" r="2" fill="white"
                                                            stroke="currentColor" stroke-width="1.8" />

                                                        <circle cx="15" cy="12" r="2" fill="white"
                                                            stroke="currentColor" stroke-width="1.8" />

                                                        <circle cx="10" cy="18" r="2" fill="white"
                                                            stroke="currentColor" stroke-width="1.8" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Features</h2>
                                                </div>
                                            </div>

                                            <div class="option-list">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="features_viewer_notifications_forward_v_alerts" id="features1"
                                                        value="1"
                                                        {{ old('features_viewer_notifications_forward_v_alerts', $setting->features_viewer_notifications_forward_v_alerts ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="features1">Viewer
                                                        notifications,
                                                        forward V-Alerts</label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="features_allow_viewers_to_ask_you_a_question" id="features2"
                                                        value="1"
                                                        {{ old('features_allow_viewers_to_ask_you_a_question', $setting->features_allow_viewers_to_ask_you_a_question ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="features2">Allow Viewers to ask
                                                        you a
                                                        question</label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="features_allow_viewers_to_send_you_a_text_message"
                                                        id="features3" value="1"
                                                        {{ old('features_allow_viewers_to_send_you_a_text_message', $setting->features_allow_viewers_to_send_you_a_text_message ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="features3">Allow Viewers to
                                                        send you a
                                                        text message</label>
                                                </div>
                                            </div>
                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>Some features are enabled by default unless you disable
                                                        them.</i></p>
                                            </div>
                                        </div>


                                        <!-- Auto Recharge Section -->
                                        <div class="form-group common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M12 6C8.69 6 6 8.69 6 12H9L5 16L1 12H4C4 7.58 7.58 4 12 4C13.57 4 15.03 4.46 16.26 5.24L14.8 6.7C13.97 6.25 13.01 6 12 6ZM15 12L19 8L23 12H20C20 16.42 16.42 20 12 20C10.43 20 8.97 19.54 7.74 18.76L9.2 17.3C10.03 17.75 10.99 18 12 18C15.31 18 18 15.31 18 12H15Z"
                                                                fill="#ff3c5f"></path>
                                                        </g>
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Auto-Recharge Options</h2>
                                                </div>
                                            </div>
                                            <div class="option-list">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="auto_recharge_no" id="auto1" value="1"
                                                        {{ old('auto_recharge_no', $setting->auto_recharge_no ?? 0) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auto1">No</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="auto_recharge_500" id="auto2" value="1"
                                                        {{ old('auto_recharge_500', $setting->auto_recharge_500 ?? 0) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auto2">$500.00</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="auto_recharge_1000" id="auto3" value="1"
                                                        {{ old('auto_recharge_1000', $setting->auto_recharge_1000 ?? 0) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auto3">$1,000.00</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="auto_recharge_1500" id="auto4" value="1"
                                                        {{ old('auto_recharge_1500', $setting->auto_recharge_1500 ?? 0) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auto4">$1,500.00</label>
                                                </div>
                                            </div>

                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>Select your preferred top up value to be applied to your
                                                        Wallet.</i></p>
                                            </div>
                                        </div>


                                        <!-- Agent -->
                                        <div class="form-group common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <circle cx="12" cy="7" r="3.5"
                                                            stroke="currentColor" stroke-width="1.8" />

                                                        <path d="M5 20c0-3.5 2.7-6 7-6s7 2.5 7 6" stroke="currentColor"
                                                            stroke-width="1.8" stroke-linecap="round" />

                                                        <path d="M8 20h8" stroke="currentColor" stroke-width="1.8"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Agent</h2>
                                                </div>
                                            </div>
                                            <div class="option-list">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="agent_receive_communications" id="agent1" value="1"
                                                        {{ old('agent_receive_communications', $setting->agent_receive_communications ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="agent1">Receive
                                                        communications</label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="agent_send_communications" id="agent2" value="1"
                                                        {{ old('agent_send_communications', $setting->agent_send_communications ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="agent2">Send
                                                        communications</label>
                                                </div>
                                            </div>

                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>Enable communications between you and your Agent (if
                                                        applicable).</i></p>
                                            </div>
                                        </div>


                                        <!-- Alert Notifications -->
                                        <div class="form-group common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                                            stroke="currentColor" stroke-width="1.8"
                                                            stroke-linecap="round" stroke-linejoin="round" />

                                                        <path d="M10 21h4" stroke="currentColor" stroke-width="1.8"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Alert notifications</h2>
                                                </div>
                                            </div>
                                            <div class="option-list">

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="alert_notification_email" id="alert_email" value="1"
                                                        {{ old('alert_notification_email', $setting->alert_notification_email ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="alert_email">Email
                                                        (A-Alert)</label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="alert_notification_text" id="alert_text" value="1"
                                                        {{ old('alert_notification_text', $setting->alert_notification_text ?? 0) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="alert_text">Text</label>
                                                </div>
                                            </div>


                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>How Escorts4U will communicate with you.</i></p>
                                            </div>

                                        </div>


                                        <!-- Idle Time -->
                                        <div class="form-group common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <circle cx="12" cy="12" r="8.5"
                                                            stroke="currentColor" stroke-width="1.8" />

                                                        <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.8"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Idle Time Preference</h2>
                                                </div>
                                            </div>
                                            <div class="radio-options">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="idle_15" value="15"
                                                        {{ old('idle_preference_time', $setting->idle_preference_time ?? null) == 15 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="idle_15">15 minutes</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="idle_30" value="30"
                                                        {{ old('idle_preference_time', $setting->idle_preference_time ?? null) == 30 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="idle_30">30 minutes</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="idle_60" value="60"
                                                        {{ old('idle_preference_time', $setting->idle_preference_time ?? null) == 60 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="idle_60">60 minutes</label>
                                                </div>
                                            </div>


                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>Set the Idle time you want before you are logged out of
                                                        your
                                                        Console.</i></p>
                                            </div>
                                        </div>


                                        <!-- Two Factor Auth -->
                                        <div class="form-group common-card">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 3l8 3v5c0 5.2-3.2 8.7-8 10-4.8-1.3-8-4.8-8-10V6l8-3z"
                                                            stroke="currentColor" stroke-width="1.8"
                                                            stroke-linejoin="round" />

                                                        <path d="m8.5 11.8 2.2 2.2 4.8-5" stroke="currentColor"
                                                            stroke-width="1.8" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>2FA Authentication</h2>
                                                </div>
                                            </div>
                                            <div class="radio-options">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="auth_email" value="1"
                                                        {{ old('twofa', $setting->twofa ?? null) == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auth_email">Email</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="auth_text" value="2"
                                                        {{ old('twofa', $setting->twofa ?? null) == 2 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="auth_text">Text</label>
                                                </div>
                                            </div>


                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p><i>How your authentication code will be sent to you.</i></p>
                                            </div>
                                        </div>
                                        
                                        {{-- Show Entries --}}
                                        <div class="form-group common-card disabled-link">
                                                <div class="card-top">
                                                    <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M4 6h16M4 12h16M4 18h16"
                                                                stroke="currentColor"
                                                                stroke-width="1.8"
                                                                stroke-linecap="round"
                                                            />
                                                            <circle
                                                                cx="7"
                                                                cy="6"
                                                                r="1.5"
                                                                fill="currentColor"
                                                            />
                                                            <circle
                                                                cx="7"
                                                                cy="12"
                                                                r="1.5"
                                                                fill="currentColor"
                                                            />
                                                            <circle
                                                                cx="7"
                                                                cy="18"
                                                                r="1.5"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div class="card-heading">
                                                        <h2>Show Entries</h2>
                                                    </div>
                                                </div>

                                                <div class="entries-setting">

                                                    <span class="entries-label">
                                                        Your default setting is:
                                                    </span>

                                                    <select class="entries-select" name="entries">
                                                        <option value="25" selected>25</option>
                                                        <option value="50">50</option>
                                                        <option value="75">75</option>
                                                        <option value="100">100</option>
                                                    </select>

                                                </div> 

                                                <div class="card-note">
                                                    <span class="note-icon">i</span>
                                                    <p> <i>Select your preferred number of entries for Report pages.</i></p>
                                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                             <div class="common-footer">
                                <input type="submit" value="Save" class="common-save-btn" name="submit">
                            </div>              
                        </form>
                        
                    </div>     
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


    <script>
        $('#profile_notification_options').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);


            $('input[type=checkbox]').each(function() {
                if (!$(this).is(':checked')) {
                    formData.append($(this).attr('name'), '0');
                }
            });

            //  swal_waiting_popup({'title':'Updating Settings'});
            // $('#globalAlert').show();

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.close();
                    //swal_success_popup(response.message);
                    Swal.close();
                    $('#globalAlert').html(
                        `<div id="commanAlert" class="alert rounded alert-success" >${response.message}</div>`
                    );
                    //  setTimeout(function() {
                    //     $('#globalAlert').hide();
                    //   }, 3000);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                    // alert("Something went wrong!");
                }
            });
        });
    </script>
@endpush
