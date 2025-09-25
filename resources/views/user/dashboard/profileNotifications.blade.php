
@extends('layouts.userDashboard')
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
    <!-- Page Heading -->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12"><h1 class="h1">Notifications</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>Use this feature to enable and disable your notification preferences..</li>
                        <li>Please note that for an Advertiser to receive any of your Requests, the Advertiser
                            must have enabled the corresponding feature in their preference settings.</li>
                            <li>Legbox Notifications from Escorts are an Alert that the Escort is on Tour and will be
                                visiting your Location the day after you receive the Notification. To receive the
                                Notification you must have this feature enabled.</li>
                            <li>Note also the default setting for 2FA authentification.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">  
        
    
   <form class="v-form-design" 
      id="notificationForm"  
      name="notification_setting"  
      method="post" 
      action="{{ route('user.update_notification_setting') }}">
    @csrf

    <div class="col-md-12">

        <!-- Alert Notifications -->
        <div class="form-group">
            <h3 class="h3">Alert notifications</h3>

            <p class="my-3">From an Advertiser:</p>
            <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="advertiser_email"   
                       name="advertiser_email" 
                       value="1"
                       {{ $setting->viewer_settings?->advertiser_email == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="advertiser_email">Email</label>
            </div>

            <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="advertiser_text"   
                       name="advertiser_text" 
                       value="1"
                       {{ $setting->viewer_settings?->advertiser_text == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="advertiser_text">Text</label>
            </div>

            <div class="mt-2">
                <i>How an Escort or Massage Centre will communicate with you, including when on Tour.</i>
            </div>

            <p class="my-3">By Escorts4U:</p>
            <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="escort_email"   {{-- ✅ unique ID --}}
                       name="escort_email" 
                       value="1"
                       {{ $setting->viewer_settings?->escort_email == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="escort_email">Email</label>
            </div>

            <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="escort_text"   
                       name="escort_text" 
                       value="1"
                       {{ $setting->viewer_settings?->escort_text == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="escort_text">Text</label>
            </div>

            <div class="mt-2">
                <i>How Escorts4U will communicate with you.</i>
            </div>
        </div>

        <!-- Idle Time Preference -->
        <div class="form-group">
            <h3 class="h3">Idle Time Preference</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                       type="radio" 
                       name="idle_time" 
                       id="idle_time_15"  
                       value="15"
                       {{ $setting->viewer_settings?->idle_preference_time == '15' ? 'checked' : '' }}>
                <label class="form-check-label" for="idle_time_15">15 minutes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                       type="radio" 
                       name="idle_time" 
                       id="idle_time_30"  
                       value="30"
                       {{ $setting->viewer_settings?->idle_preference_time == '30' ? 'checked' : '' }}>
                <label class="form-check-label" for="idle_time_30">30 minutes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                       type="radio" 
                       name="idle_time" 
                       id="idle_time_60"   
                       value="60"
                       {{ $setting->viewer_settings?->idle_preference_time == '60' ? 'checked' : '' }}>
                <label class="form-check-label" for="idle_time_60">60 minutes</label>
            </div> 
        </div>

        <!-- 2FA Authentication -->
        <div class="form-group">
            <h3 class="h3">2FA Authentication</h3>
            <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="twofa" 
                       id="twofa_email"   {{-- ✅ unique ID --}}
                       value="1"
                       {{ $setting->viewer_settings?->twofa == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="twofa_email">Email</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="twofa" 
                       id="twofa_text"   {{-- ✅ unique ID --}}
                       value="2"
                       {{ $setting->viewer_settings?->twofa == '2' ? 'checked' : '' }}>
                <label class="form-check-label" for="twofa_text">Text</label>
            </div>

            <div class="pt-1">
                <i>How your authentification code will be sent to you.</i>
            </div>
        </div>

        <input type="submit" id="saveNotificationBtn" value="Save" class="btn btn-primary shadow-none" name="submit">
    </div>
</form>
</div>



    <div class="row mt-5">
        <div class="col-lg-12">
            <h3 class="h3 mb-4">Set Legbox Notifications </h3>
            <div class="table-responsive">
                <table id="userNotificationList" class="table table-bordered display" width="100%">
                    <thead class="bg-first">
                    <tr>
                        <th>Member ID</th>
                        <th>Stage Name / Business name</th>
                        <th>Notification</th>                       
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <td>E60587</td>
                        <td>Western Australia</td>
                        <td>Joanne </td>
                        
                        <td class="theme-color text-center bg-white">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i
                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                     aria-labelledby="dropdownMenuLink">
                                     
                                     <div class="custom-tooltip-container">
                                         <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-bell"></i> Enable</a>
                                        
                                         <div class="dropdown-divider"></div>
                                     </div>
                                     <div class="custom-tooltip-container">
                                         <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-bell-slash" aria-hidden="true"></i>
                                            Disable</a>
                                     </div>
                                 </div>
 
                            </div>
                        </td> 
                    
                    </tbody>
              </table>
            </div>
        </div>
    </div>
</div>



@endsection
@push('script')
<!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#userNotificationList').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by Member ID...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true,
       });
   });
 </script>


<script>
  $(document).on('submit', 'form[name="notification_setting"]', function(e) 
      {
         e.preventDefault(); 
        let form = $('#notificationForm')[0];
        let formData = new FormData(form);
        let url = $('#notificationForm').attr('action');
         swal_waiting_popup({'title':'Updating Settings'});
         $.ajax({
               url: url,
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                     Swal.close();
                     console.log(xhr);
                    swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });
</script>    

@endpush
