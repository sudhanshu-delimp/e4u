@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   label.cabinet input.file{
	position: relative;
	height: 100%;
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	width: 250px;
	height: 250px;
  padding-bottom:25px;
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

    

    <div class="row">    

        

        <div class="custom-heading-wrapper col-md-12">
           <h1 class="h1">Notifications & Features</h1>
           <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>


        <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                      <li>Use this feature to enable and disable your notification and feature preferences.</li>
                      <li>Please note that for an Escort to receive any of your Requests or Notifications, the
                        Escort must have enabled the corresponding feature in their preference settings.</li>
                      <li>Note also the default setting for 2FA authentification.</li> 
                 </ol>
              </div>
           </div>
        </div>


        <div class="col-md-12 commanAlert"></div>

        <div class="col-md-12" id="profile_and_tour_options">
  
           <form class="v-form-design" id="notification_setting" name="notification_setting" action="{{route('agent.update_notifications')}}" method="POST">
            {{ csrf_field() }}
               <div class="row">
                   <div class="col-md-12">
                       <div class="form-group notification_checkbox_div">
                           <h3 class="h3">Features</h3>
                           <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"
                            name="advertiser_alert"
                            id="advertiser_alert"
                            {{ isset($setting->agent_settings)
                                && ($setting->agent_settings->advertiser_email == '1'
                                    || $setting->agent_settings->advertiser_text == '1')
                                ? 'checked'
                                : '' }}>
                             <label class="custom-control-label" for="advertiser_alert">Receive Alert Notifications from Advertisers</label>
                           </div>
  
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" name="direct_chatting_with_advertisers"  id="direct_chatting_with_advertisers"  {{ isset($setting->agent_settings) && $setting->agent_settings->direct_chatting_with_advertisers == '1' ? 'checked' : '' }}>
                             <label class="custom-control-label" for="direct_chatting_with_advertisers">Participate in direct chatting with Advertisers</label>
                           </div>
                           <div class="pt-1"><i>These features are enabled by default unless you disable them.</i></div>
                       </div>
  
                       <div class="form-group">
                          <h3 class="h3">Alert notifications</h3>

                          <p class="my-3">From an Advertiser:</p>
  
                          <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" name="advertiser_email" id="advertiser_email"  {{ isset($setting->agent_settings) && $setting->agent_settings->advertiser_email == '1' ? 'checked' : '' }}>
                             <label class="custom-control-label" for="advertiser_email">Email (A-Alert)</label>
                           </div>
  
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" name="advertiser_text" id="advertiser_text" {{ isset($setting->agent_settings) && $setting->agent_settings->advertiser_text == '1' ? 'checked' : '' }}>
                             <label class="custom-control-label" for="advertiser_text">Text</label>
                           </div>
                           <div class="pt-1"><i>How an Advertisers will communicate with you.</i></div>

                           <p class="my-3">By Escorts4U:</p>

                           <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="escort_email" name="escort_email"
                            {{ isset($setting->agent_settings) && $setting->agent_settings->escort_email == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="escort_email">Email</label>
                          </div>
 
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="escort_text" name="escort_text"
                            {{ isset($setting->agent_settings) && $setting->agent_settings->escort_text == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="escort_text">Text </label>
                          </div>

                          <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" name="call_access" id="call_access"
                            {{ isset($setting->agent_settings) && $setting->agent_settings->call == '1' ? 'checked' : '' }}>
                           <label class="custom-control-label" for="call_access">Call me</label>
                         </div>
                          <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>


                       </div>
                       
                       <div class="form-group">
                            <h3 class="h3">Idle Time Preference</h3>
                            @php
                                $idle = $setting->agent_settings->idle_preference_time ?? '60';
                            @endphp

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_15" value="15" {{ $idle == '15' ? 'checked' : '' }}>
                                <label class="form-check-label" for="idle_15">15 minutes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_30" value="30"  {{ $idle == '30' ? 'checked' : '' }}>
                                <label class="form-check-label" for="idle_30">30 minutes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_60" value="60"  {{ $idle == '60' ? 'checked' : '' }}>
                                <label class="form-check-label" for="idle_60">60 minutes</label>
                            </div>
                             <!-- Info -->
                             <div class="pt-1">
                                <i>Set the Idle time you want before you are logged out of your Console.</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 class="h3">2FA Authentication</h3>

                            @php
                                $twofa = $setting->agent_settings->twofa ?? '2';
                            @endphp
                        
                            <!-- Email Option -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="twofa" id="auth_email" value="1"  {{ $twofa == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="auth_email">Email</label>
                            </div>
                        
                            <!-- Text Option (default selected) -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="twofa" id="auth_text" value="2" {{ $twofa == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="auth_text">Text</label>
                            </div>
                        
                            <!-- Info -->
                            <div class="pt-1">
                                <i>How your authentication code will be sent to you.</i>
                            </div>
                        </div>
                        
                   </div>
               </div>
               <input type="submit" value="save" class="btn-common" name="submit">
               @csrf
           </form>
       </div>
    </div>
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
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <span style="color: white">Crop Photo</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    
                </button>
                
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block">
                    {{-- <div class="cr-boundary" aria-dropeffect="none">
                        <img src="{{ asset('assets/app/img/service-provider/Frame-408.png')}}" alt="" class="img-rounded" >
                    </div>
                    <div class="cr-slider-wrap"><input class="cr-slider" type="range" step="0.0001" aria-label="zoom" min="0.0000" max="1.5000" aria-valuenow="0.0913"></div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn main_bg_color site_btn_primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function() {
    $('#advertiser_alert').on('change', function() {
        if (!$(this).is(':checked')) {
            $('#advertiser_email, #advertiser_text').prop('checked', false);
        } else {
           $('#advertiser_email, #advertiser_text').prop('checked', true);
        }
    });


    $('#advertiser_email, #advertiser_text').on('change', function() {
        syncParentWithChildren();
    });

    function syncParentWithChildren() {
        const allOff = !$('#advertiser_email').is(':checked') && !$('#advertiser_text').is(':checked');
        $('#advertiser_alert').prop('checked', !allOff);
    }

    syncParentWithChildren();
});

 $(document).on('submit', 'form[name="notification_setting"]', function(e) 
      {
         e.preventDefault(); 
        $('#commanAlert').removeClass('alert-success');
        $('#commanAlert').removeClass('alert-error');
        let form = $('#notification_setting')[0];
        let formData = new FormData(form);
        let url = $('#notification_setting').attr('action');
         swal_waiting_popup({'title':'Updating Settings'});
         $.ajax({
               url: url,
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     Swal.close();
                     $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-success" >${response.message}</div>`);
                     setTimeout(function() {
                     location.reload();
                }, 3000);
               },
               error: function(xhr) {
                     Swal.close();
                     console.log(xhr);
                     $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-error">Error : Something went wrong</div>`);
               }
         });
      });
</script>
@endpush