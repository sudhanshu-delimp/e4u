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
                    <div class="col-md-12" id="profile_and_tour_options">

                        <form class="v-form-design" id="profile_notification_options"
                            action="{{route('centre.update.notifications-and-features')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group notification_checkbox_div">
                                        <h3 class="h3">Features</h3>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                            <label class="custom-control-label" for="customSwitch1">Viewer notifications,
                                                forward V-Alerts</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                            <label class="custom-control-label" for="customSwitch2">Allow Viewers to ask you
                                                a question</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                            <label class="custom-control-label" for="customSwitch3">Allow Viewers to send
                                                you a text message</label>
                                        </div>
                                        <div class="pt-1"><i>Some features are enabled by default unless you disable them
                                                .</i></div>
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
                                            <label class="form-check-label" for="auto-recharge">$500.00</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="auto-recharge" type="checkbox"
                                                id="auto-recharge" value="2">
                                            <label class="form-check-label" for="auto-recharge">$1,000.00</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="auto-recharge" type="checkbox"
                                                id="auto-recharge" value="2">
                                            <label class="form-check-label" for="auto-recharge">$1,500.00</label>
                                        </div>
                                        <div class="pt-1"><i>Select your preferred top up value to be applied to your
                                                Credit.</i></div>
                                    </div>

                                    <div class="form-group">
                                        <h3 class="h3">Agent</h3>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="rec-communication">
                                            <label class="custom-control-label" for="rec-communication">Receive
                                                communications</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="send-communication">
                                            <label class="custom-control-label" for="send-communication">Send
                                                communications</label>
                                        </div>
                                        <div class="pt-1"><i>Enable communications between you and your Agent (if
                                                applicable).</i></div>
                                    </div>

                                    <div class="form-group">
                                        <h3 class="h3">Alert notifications</h3>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="alert-email">
                                            <label class="custom-control-label" for="alert-email">Email (A-Alert)</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="alert-text" checked>
                                            <label class="custom-control-label" for="alert-text">Text</label>
                                        </div>
                                        <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>
                                    </div>
                                    <div class="form-group">
                                        <h3 class="h3">Idle Time Preference</h3>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="idle_time"
                                                id="idle_15" value="15" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 15) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="idle_15">15 minutes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="idle_time"
                                                id="idle_30" value="30" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 30) ? 'checked' : (auth()->user()->idle_preference_time == null ? 'checked' : '') }}>
                                            <label class="form-check-label" for="idle_30">30 minutes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="idle_time"
                                                id="idle_60" value="60" {{ (auth()->user() && auth()->user()->idle_preference_time != null && auth()->user()->idle_preference_time == 60) ? 'checked' : '' }}>
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
                                    
                                        <!-- Text Option (default selected) -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="auth" id="auth_text" value="2" checked>
                                            <label class="form-check-label" for="auth_text">Text</label>
                                        </div>
                                    
                                        <!-- Info -->
                                        <div class="pt-1">
                                            <i>How your authentication code will be sent to you.</i>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <input type="submit" value="save" class="btn-common"
                                name="submit">
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
    <!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


    <script type="text/javascript">
    @endpush
