@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   .slider-switch {
   width: 40px;
   height: 20px;
   position: relative;
   display: inline-block;
   }
   .slider-switch input {
   opacity: 0;
   width: 0;
   height: 0;
   }
   .slider-slider {
   position: absolute;
   cursor: pointer;
   background-color: #ccc;
   border-radius: 20px;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   transition: 0.4s;
   }
   .slider-slider:before {
   position: absolute;
   content: "";
   height: 14px;
   width: 14px;
   left: 3px;
   bottom: 3px;
   background-color: white;
   transition: .4s;
   border-radius: 50%;
   }
   .slider-switch input:checked + .slider-slider {
   background-color: #28a745;
   }
   .slider-switch input:checked + .slider-slider:before {
   transform: translateX(20px);
   }
   .total_listing{
    font-size: 14px;
   }

</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper">
        <h1 class="h1">My Legbox Viewers</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>Registered Viewers who have flagged you in their Legbox are listed here. You can
also see your Viewers <a href="{{ route('legbox-notification') }}" class="custom_links_design">here</a>.</li>
                  <li>The status for each Viewer is Summarised here and includes Contact.</li>
                  <li>The Viewer can set their preferences for Contact. You can also set your preferences
here, which will override the Viewer’s settings.</li>
                  <li>If you Block a Viewer, the Viewer will not be able to view any of your Profiles or
communicate with you, while logged onto the Website.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="row my-2">
      <!-- My Legbox -->
      <div class="col-md-12 mb-4">
         <div class="mb-3 d-flex align-items-center justify-content-end flex-wrap gap-10">
            <div class="total_listing">
               <div><span>Total Viewers Legbox : </span></div>
               <div><span id="totalViewerLegboxList">0</span></div>
            </div>
         </div>
         <div class="table-responsive list-sec">
            <table class="table table-bordered table-hover mb-0" id="legboxNotificationTable" style="width: 100%;">
               <thead>
                  <tr>
                     <th>Viewer ID</th>
                     <th>Business Name</th>
                     <th>Home State</th>
                     <th>Contact Enabled</th>
                     <th>Contact Method</th>
                     <th>Viewer Communication</th>
                     <th>Block Viewer</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  {{-- <tr>
                     <td>V60587</td>
                     <td>Western Australia</td>
                     <td>Yes</td>
                     <td>Text</td>
                     <td>0438 028 728</td>
                     <td>
                        <label class="slider-switch">
                        <input type="checkbox" checked="">
                        <span class="slider-slider"></span>
                        </label>
                     </td>
                     <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-phone-slash"></i> Disable Contact</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-bell-slash"></i> Disable Notifications</a>
                           </div>
                        </div>
                     </td>
                  </tr> --}}
                  <tr class="text-center">
                    <td colspan="7" class="text-center"><h5>No Record Found!</h5></td></tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!--middle content end here-->
   {{-- Massage operation Profile Success Modal --}}
    <div class="modal fade upload-modal" id="massageProfileModal" tabindex="-1" role="dialog"
        aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                            <img src="{{ asset('assets/dashboard/img/unblock.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">
                        <span class="text-white modal_title_span">Contact</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 agent-tour">
                    <div class="row">
                        <div class="col-md-12 my-4  text-center">
                            <h5 class=" body_text mb-2">This Massage does not presently have any Listed Profiles.</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-center">
                                <button type="button" class="btn-success-modal " data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function() {
    
     var legboxNotificationTable = $('#legboxNotificationTable').DataTable({
                responsive: false,
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID or Name...",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                paging: true,
                searchable: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('massage.viewer-legbox-list-ajax') }}",
                    dataSrc: function(json) {
                            // json is the response from server
                            console.log(json, 'response data');
                            $("#totalViewerLegboxList").text(json.recordsTotal);
                            return json.data; // MUST return the data array for DataTables
                        },
                    data: function(data) {
                    }
                },
                columns: [
                    { data: 'viewer_id', name: 'viewer_id'},                         // 0
                    { data: 'business_name', name: 'business_name'},                         // 0
                    { data: 'home_state', name: 'home_state' },  
                    { data: 'is_enabled_contact', name: 'is_enabled_contact' },       // 6
                    { data: 'contact_method', name: 'contact_method' },               // 7
                    {
                        data: 'viewer_communication',
                        name: 'viewer_communication',
                        orderable: false,
                        render: function (data, type, row) {
                            if (!data) return '';
                            let str = String(data); 
                            // Har 12 characters ke baad line break
                            return str.replace(/(.{12})/g, '$1<br>');
                        }
                    },
                    { data: 'block_viewer', name: 'block_viewer',orderable: false, searchable: false },                       // 9
                    { data: 'action', name: 'action', orderable: false, searchable: false } // 10
                ]
            });

             $(document).on('change', '.isBlockedButton', function() {
                let viewerId = $(this).attr('data-id');
                let massageId = $(this).attr('data-massage-id');
                let isBlocked = $(this).is(':checked') ? 1 : 0;
                let data = {
                    'viewer_id' : viewerId,
                    'is_blocked' : isBlocked,
                    'massage_id' : massageId,
                    'type' : 'block',
                    'message' : 'Viewer is '+(isBlocked ? 'Blocked' : 'UnBlocked')+' successfully!',
                }

                if(isBlocked){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/block.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/unblock.png")}}');
                }

                let url = '{{ route("massage-center.viewer-interaction.update") }}';
                return  ajaxCall(url, data, $(this));
                
            });

            $(document).on('click', '.toggle-massage-contact', function (e) {
                e.preventDefault();
                const $this = $(this);
                const viewerId = $this.data('id');
                let massageId = $(this).attr('data-massage-id');
                const currentStatus = $this.data('status'); // disable or enable
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("massage-center.viewer-interaction.update") }}';

                let data = {
                    'viewer_id' : viewerId,
                    'massage_id' : massageId,
                    'current_status' : currentStatus,
                    'massage_disabled_contact' : newStatus,
                    'type' : 'contact',
                    'message' : 'Viewer contact is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/no-phone.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/phone.png")}}');
                }

                return  ajaxCall(url, data, $this);
            });

            $(document).on('click', '.toggle-massage-notification', function (e) {
                e.preventDefault();
                const $this = $(this);
                const viewerId = $this.data('id');
                let massageId = $(this).attr('data-massage-id');
                const currentStatus = $this.data('status');
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("massage-center.viewer-interaction.update") }}';

                let data = {
                    'viewer_id' : viewerId,
                    'massage_id' : massageId,
                    'current_status' : currentStatus,
                    'massage_disabled_notification' : newStatus,
                    'type' : 'notification',
                    'message' : 'Viewer notification is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/disable_notification.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/enable_notification.png")}}');
                }

                return  ajaxCall(url, data, $this);
            });

            function ajaxCall(actionUrl,rowData,thisObj)
            {
                rowData.token = '{{ csrf_token() }}';
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: rowData,
                    success: function(response) {
                        
                        console.log('response');
                        console.log(response);
                        
                        $('#massageProfileModal').modal('show');
                        $('#legboxNotificationTable').DataTable().ajax.reload(null, false);
                        if(response.type == 'block'){
                            $(".modal_title_span").text('Viewer Block');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'contact'){
                            $(".modal_title_span").text('Viewer Contact');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'notification'){
                            $(".modal_title_span").text('Viewer Notification');
                            $(".body_text").text(response.message);
                        }
                    },
                    error: function(err) {
                        //showGlobalAlert("Something went wrong.", "danger");
                    }
                });
            }

});
   
</script>
@endpush