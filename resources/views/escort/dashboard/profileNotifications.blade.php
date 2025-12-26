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
                <div id="globalAlert"></div>
            </div>
            <div class="col-md-12" id="profile_and_tour_options">

        

    <form class="v-form-design" id="profile_notification_options"
    action="{{ route('escort.profile.notifications') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-12">

            {{-- FEATURES --}}
            <div class="form-group notification_checkbox_div">
                <h3 class="h3">Features</h3>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="notification_feature1"
                        name="features_viewer_notifications_forward_v_alerts" value="1"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->features_viewer_notifications_forward_v_alerts == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="notification_feature1">
                        Viewer notifications, forward V-Alerts
                    </label>
                </div>
                
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="notification_feature2"
                        name="features_allow_viewers_to_ask_you_a_question" value="1"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->features_allow_viewers_to_ask_you_a_question == '1') ? 'checked' : '' }}>
                       
                    <label class="custom-control-label" for="notification_feature2">
                        Allow Viewers to ask you a question
                    </label>
                </div>
                
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="notification_feature3" type="checkbox"
                        name="features_allow_viewers_to_send_you_a_text_message" value="1"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->features_allow_viewers_to_send_you_a_text_message == '1') ? 'checked' : '' }}>
        
                    <label class="custom-control-label" for="notification_feature3">
                        Allow Viewers to send you a text message
                    </label>
                </div>
                
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="notification_feature4"
                        name="features_i_am_available_as_a_playmate" type="checkbox" value="1"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->features_i_am_available_as_a_playmate == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="notification_feature4">
                        I’m available as a playmate
                    </label>
                </div>

                <div class="mt-2">
                    <i>Some features are enabled by default unless you disable them.</i>
                </div>
            </div>


            {{-- AUTO RECHARGE --}}
            <div class="form-group">
                <h3 class="h3">Auto-Recharge options</h3>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="auto_recharge_no" id="auto_no" value="1"
                         {{  (isset($setting->escort_settings) &&  $setting->escort_settings->auto_recharge_no == '1') ? 'checked' : '' }}>
                    <label class="form-check-label" for="auto_no">No</label>
                </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            name="auto_recharge_100" id="auto_100" value="1"
                             {{  (isset($setting->escort_settings) &&  $setting->escort_settings->auto_recharge_100 == '1') ? 'checked' : '' }}>
                           
                        <label class="form-check-label" for="auto_100">$100.00</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            name="auto_recharge_250" id="auto_250" value="1"
                           {{  (isset($setting->escort_settings) &&  $setting->escort_settings->auto_recharge_250 == '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="auto_250">$250.00</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            name="auto_recharge_500" id="auto_500" value="1"
                          {{  (isset($setting->escort_settings) &&  $setting->escort_settings->auto_recharge_500 == '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="auto_500">$500.00</label>
                    </div>
                
                <div class="pt-1">
                    <i>Select your preferred top up value to be applied to your Credit.</i>
                </div>
            </div>


            {{-- AGENT --}}
            <div class="form-group">
                <h3 class="h3">Agent</h3>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox"
                        id="agent_communications1" value="1"
                        name="agent_receive_communications"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->agent_receive_communications == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="agent_communications1">
                        Receive communications
                    </label>
                </div>
                
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox"
                        id="agent_communications2" value="1"
                        name="agent_send_communications"
                       {{  (isset($setting->escort_settings) &&  $setting->escort_settings->agent_send_communications == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="agent_communications2">
                        Send communications
                    </label>
                </div>

                <div class="mt-2">
                    <i>Enable communications between you and your Escort Agency (if applicable).</i>
                </div>
            </div>


            {{-- ALERT --}}
            <div class="form-group">
                <h3 class="h3">Alert notifications</h3>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox"
                        name="alert_notification_email" id="alert_email" value="1"
                         {{  (isset($setting->escort_settings) &&  $setting->escort_settings->alert_notification_email == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="alert_email">Email (A-Alert)</label>
                </div>
                
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox"
                        name="alert_notification_text" id="alert_text" value="1"
                         {{  (isset($setting->escort_settings) &&  $setting->escort_settings->alert_notification_text == '1') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="alert_text">Text</label>
                </div>

                <div class="mt-2">
                    <i>How Escorts4U will communicate with you.</i>
                </div>
            </div>


            {{-- IDLE TIME --}}
            <div class="form-group">
                <h3 class="h3">Idle Time Preference</h3>
                
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="idle_preference_time" id="idle_15" value="15"
                        
                            {{  (isset($setting->escort_settings) &&  $setting->escort_settings->idle_preference_time == '15') ? 'checked' : '' }}>
                        <label class="form-check-label" for="idle_15">15 minutes</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="idle_preference_time" id="idle_30" value="30"
                        {{  (isset($setting->escort_settings) &&  $setting->escort_settings->idle_preference_time == '30') ? 'checked' : '' }} >
                           
                        <label class="form-check-label" for="idle_30">30 minutes</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="idle_preference_time" id="idle_60" value="60"
                           {{  (isset($setting->escort_settings) &&  $setting->escort_settings->idle_preference_time == '60') ? 'checked' : '' }}>
                        <label class="form-check-label" for="idle_60">60 minutes</label>
                    </div>

                <div class="pt-1">
                    <i>Set the Idle time before you are logged out of your Console.</i>
                </div>
            </div>


            {{-- 2FA --}}
            <div class="form-group">
                <h3 class="h3">2FA Authentication</h3>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="twofa" id="auth_1" value="1"
                           {{  (isset($setting->escort_settings) &&  $setting->escort_settings->twofa == '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="auth_1">Email</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="twofa" id="auth_2" value="2"
                         {{  (isset($setting->escort_settings) &&  $setting->escort_settings->twofa == '2') ? 'checked' : '' }}>
                          
                        <label class="form-check-label" for="auth_2">Text</label>
                    </div>

                <div class="pt-1">
                    <i>How your authentication code will be sent to you.</i>
                </div>
            </div>


            {{-- SUBSCRIPTIONS --}}
            <div class="form-group">
                <h3 class="h3">Subscriptions</h3>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="subscriptions_num" id="num" value="1"
                          {{  (isset($setting->escort_settings) &&  $setting->escort_settings->subscriptions_num == '1') ? 'checked' : '' }}>
                        
                    <label class="form-check-label" for="num">NUM</label>
                </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="subscriptions_state" id="sub_1" value="1"
                          {{  (isset($setting->escort_settings) &&  $setting->escort_settings->subscriptions_state == '1') ? 'checked' : '' }}>
                           
                        <label class="form-check-label" for="sub_1">Home State</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="subscriptions_state" id="sub_2" value="2"
                            {{  (isset($setting->escort_settings) &&  $setting->escort_settings->subscriptions_state == '2') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sub_2">Australia wide</label>
                    </div>

                <div class="pt-1">
                    <i>Monthly subscriptions. Your card will be automatically debited.</i>
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
<script>
$('#profile_notification_options').on('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);


    swal_waiting_popup({'title':'Updating Settings'});
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
         success: function(response) {

                Swal.close();
                swal_success_popup(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);

                console.log(response);
                     //Swal.close();
                    //  $('#globalAlert').html(`<div id="commanAlert" class="alert rounded alert-success" >${response.message}</div>`);
                    //  setTimeout(function() {
                    //  location.reload();
                    //   }, 3000);
               },
               error: function(xhr) {
                     Swal.close();
                     console.log(xhr);
                     swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                    //  $('#globalAlert').html(`<div id="commanAlert" class="alert rounded alert-error">Error : Something went wrong</div>`);
               }
    });
});

</script>
@endpush
