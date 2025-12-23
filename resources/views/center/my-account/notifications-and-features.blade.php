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
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
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

                    <div class="col-md-12 commanAlert"></div>


                        <div class="col-md-12" id="profile_and_tour_options">
                            
                            <form class="v-form-design" id="profile_notification_options"
    action="{{ route('centre.notifications-and-features') }}" method="POST">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">

            <!-- Features Section -->
            <div class="form-group notification_checkbox_div">
                <h3 class="h3">Features</h3>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="features_viewer_notifications_forward_v_alerts"
                        id="features1" value="1"
                        {{ old('features_viewer_notifications_forward_v_alerts', $setting->features_viewer_notifications_forward_v_alerts ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="features1">Viewer notifications, forward V-Alerts</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="features_allow_viewers_to_ask_you_a_question"
                        id="features2" value="1"
                        {{ old('features_allow_viewers_to_ask_you_a_question', $setting->features_allow_viewers_to_ask_you_a_question ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="features2">Allow Viewers to ask you a question</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="features_allow_viewers_to_send_you_a_text_message"
                        id="features3" value="1"
                        {{ old('features_allow_viewers_to_send_you_a_text_message', $setting->features_allow_viewers_to_send_you_a_text_message ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="features3">Allow Viewers to send you a text message</label>
                </div>

                <div class="pt-1"><i>Some features are enabled by default unless you disable them.</i></div>
            </div>


            <!-- Auto Recharge Section -->
            <div class="form-group">
                <h3 class="h3">Auto-Recharge Options</h3>

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

                <div class="pt-1"><i>Select your preferred top up value to be applied to your Credit.</i></div>
            </div>


            <!-- Agent -->
            <div class="form-group">
                <h3 class="h3">Agent</h3>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="agent_receive_communications" id="agent1" value="1"
                        {{ old('agent_receive_communications', $setting->agent_receive_communications ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="agent1">Receive communications</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="agent_send_communications" id="agent2" value="1"
                        {{ old('agent_send_communications', $setting->agent_send_communications ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="agent2">Send communications</label>
                </div>

                <div class="pt-1"><i>Enable communications between you and your Agent (if applicable).</i></div>
            </div>


            <!-- Alert Notifications -->
            <div class="form-group">
                <h3 class="h3">Alert notifications</h3>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="alert_notification_email" id="alert_email" value="1"
                        {{ old('alert_notification_email', $setting->alert_notification_email ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="alert_email">Email (A-Alert)</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        name="alert_notification_text" id="alert_text" value="1"
                        {{ old('alert_notification_text', $setting->alert_notification_text ?? 0) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="alert_text">Text</label>
                </div>

                <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>
            </div>


            <!-- Idle Time -->
            <div class="form-group">
                <h3 class="h3">Idle Time Preference</h3>

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

                <div class="pt-1"><i>Set the Idle time you want before you are logged out of your Console.</i></div>
            </div>


            <!-- Two Factor Auth -->
            <div class="form-group">
                <h3 class="h3">2FA Authentication</h3>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="twofa" id="auth_email" value="1"
                        {{ old('twofa', $setting->twofa ?? null) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="auth_email">Email</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="twofa" id="auth_text" value="2"
                        {{ old('twofa', $setting->twofa ?? null) == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="auth_text">Text</label>
                </div>

                <div class="pt-1"><i>How your authentication code will be sent to you.</i></div>
            </div>

        </div>
    </div>

    <input type="submit" value="Save" class="btn-common" name="submit">
</form>



                        </div>
                </div>


                <!--middle content end here-->
            </div>
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
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
        $('#profile_notification_options').on('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            
            $('input[type=checkbox]').each(function () {
                if(!$(this).is(':checked')) {
                    formData.append($(this).attr('name'), '0');
                }
            });

             swal_waiting_popup({'title':'Updating Settings'});

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.close();
                    swal_success_popup(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                    swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                    // alert("Something went wrong!");
                }
            });
        });
        </script>



@endpush

