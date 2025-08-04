@extends('layouts.admin')
@section('style')
<style>
   td,
   th {
       vertical-align: middle !important;
       text-align: center;
   }
   #agentRequestreportTable td {
    white-space: normal !important;
    word-break: break-word;
}
.avatar img {
   width: 60px; height: 60px;
   border-radius: 50%;
}
.d_request_agent_modal td{

   padding: 0px;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row mt-5">      
      <div class="custom-heading-wrapper col-md-12">
        <h1  class="h1"> Agent Requests Reports</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
     </div>
     <div class="col-md-12 ">
         <div class="card collapse  mb-4" id="notes">
             <div class="card-body">
                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                 <ol>
                     <li>Agent Requests logged by Advertisers are summarised here.</li>
                     <li>The Operations Team can action a Request.</li>
                 </ol>
             </div>
         </div>
     </div>
    <div class="col-md-12"> 
        <div class="row my-3">
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                {{-- <div class="total_listing"></div> --}}
                <div class="total_listing">
                                    <div><span>Total Appointments : </span></div>
                                    <div><span class="totalCompletedTask"></span></div>
                                </div>
            </div>
        </div>
        <div class="table-responsive membership--inner">
            <table class="table table-bordered text-center" id="agentRequestreportTable">
                 <thead id="table-sec" class="table-bg">
                   <tr>
                    <th>Ref</th>
                    <th>Request Date</th>
                    <th>Member ID</th>
                    <th>Mobile</th>
                    <th>Home State</th>
                    <!-- <th>Agents ID</th>
                    <th>Mobiles</th> -->
                    <th>Status</th>
                    <th>Accepted Date</th>
                    <th>Action</th>
                   </tr>
                </thead>
                
            </table>
        </div>
     </div>
   </div>
   
   
   <!--right side bar end-->
</div>

<div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>


<div class="modal fade upload-modal" id="confirmationPopup" tabindex="-1" role="dialog" aria-labelledby="confirmationPopup" aria-hidden="true" data-backdrop="static"></div>

 @endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   $(document).ready(function() {
      var table = $("#agentRequestreportTable").DataTable({
       language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by Member ID or Agent ID...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
         },
        processing: true,
        serverSide: true,
        lengthChange: true,
        searching: true,
        bStateSave: false,

        ajax: {
            url: "{{ route('admin.dataTable') }}",
            type: 'GET',
            data: function (d) {
                d.type = 'player';
            }
        },

        columns: [
            { data: 'ref_number', name: 'ref_number', orderable: true, defaultContent: 'NA' },
            { data: 'requested_at', name: 'requested_at', orderable: true, defaultContent: 'NA' },
            { data: 'user_member_id', name: 'user_member_id', orderable: true, defaultContent: 'NA' },
            { data: 'phone', name: 'phone', orderable: true, defaultContent: 'NA' },
            { data: 'country_code', name: 'country_code', orderable: true, defaultContent: 'NA' },
           
            { data: 'view_status', name: 'view_status', orderable: true, defaultContent: 'NA' },
            { data: 'accepted_date', name: 'accepted_date', orderable: true, defaultContent: 'NA' },
            { data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: 'NA' },
        ],

        order: [[1, 'desc']],

        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        pageLength: 10,
    });

    $('#agentRequestreportTable').on('init.dt', function () {
    $('.dataTables_filter input[type="search"]').attr('placeholder', 'Search by Member ID or Agent ID...');
    });

    table.on('xhr.dt', function (e, settings, json, xhr) {
    $('.totalCompletedTask').html( json.recordsFiltered);
    });

    



    ///////// View Status ///////////

     $(document).on('click', '.current_status', function(e) {
     e.preventDefault();
     var requestId = $(this).data('id');
     var rowData = table.row($(this).parents('tr')).data();
     let statusData = rowData.list_arr;
     let statusRows = [];

   
     console.log(statusData);
      for (let i = 0; i < statusData.agent_id.length; i++) {
              statusRows +=  `<tr>
                  <td>${statusData.agent_id[i]}</td>
                  <td>${statusData.agent_mobile[i]}</td>
                  <td>${statusData.agent_status[i]}</td>
                  </tr>
            `;
         }

     console.log(statusRows);
     var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="confirmationPopup"> <img src="{{asset('assets/dashboard/img/status.png')}}" style="width:40px; margin-right:10px;" alt="Current Status">  Current Status : Ref - ${rowData.ref_number}</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                 </button>
                              </div>
                              <div class="modal-body d_request_agent_modal pb-0">
                                    <div class="row">
                                       <div class="col-12 my-2 text-center">
                                             
                                          <table border="1" id="agentStatusTable" class="w-100">
                                             <thead>
                                                <tr>
                                                      <th>Agent ID</th>
                                                      <th>Mobile</th>
                                                      <th>Status</th>
                                                </tr>
                                             </thead>
                                             <tbody>${statusRows}</tbody>
                                          </table>
                                                                                          
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer text-center justify-content-center">             
                                 <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
                              </div>
                           </div>
                        </div>`;

         $('#confirmationPopup').html(modal_html);
         $('#confirmationPopup').modal('show');
       });

   

    var requestId = $(this).data('id');
    var rowData = table.row($(this).parents('tr')).data();


    ///////////////  View Agent Detail /////////////////////////


    $(document).on('click', '.notiification-confirmation', function(e) {

       e.preventDefault();
       var requestId = $(this).data('id');
       var rowData = table.row($(this).parents('tr')).data();
       let statusData = rowData.list_arr;
       let agent_user_id = [];
       for (let i = 0; i < statusData.agent_user_id.length; i++) {
              agent_user_id.push(statusData.agent_user_id[i]);
        }

        var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="confirmationPopup"> <img src="{{asset('assets/dashboard/img/create-notification.png')}}" style="width:40px; margin-right:10px;" alt="Request Accepted"> Follow-up Notification</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                 </button>
                              </div>
                              <div class="modal-body pb-0">
                                    <div class="row">
                                       <div class="col-12 my-2 text-center">
                                             <p>Notification Send successfully</p>
                                                
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer text-center justify-content-center">             
                                 <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
                              </div>
                           </div>
                        </div>`;


        ////////// Send Notification ////////////////////////
       
     let title = `A request to appoint an Agent in your Territory remains outstanding.
             Please visit <a href="{{ env('APP_URL') . '/agent-dashboard/Advertisers/new-requests' }}">New Requests</a> to acknowledge.`;
      
       ajaxRequest({
               url: "{{ route('admin.send-notiification') }}",
               method : 'POST',
               data: {
                  to_user: agent_user_id,
                  title:title,
                  message: (typeof message !== 'undefined' && message) ? message : '',
                  notification_listing_type: 2,
                  notification_type: 'agent_follow_up',
               },
               
               success: function(response) {
                  console.log(response);
                  if (response.success) {
                      $('#confirmationPopup').html(modal_html);
                      $('#confirmationPopup').modal('show');
                  }
                  else
                  {
                   Swal.fire('Error', response.message , 'error');
                  }
               },
               error: function(xhr) {
                 const response = xhr.responseJSON;
                  if (response && response.errors) {
                     const firstError = Object.values(response.errors)[0][0]; 
                     Swal.fire('Validation Error', firstError, 'error');
                  } else {
                     Swal.fire('Error', 'Something went wrong', 'error');
                  }
               }
            });


       ///////// End End Notification /////////////////////                
    });

    $(document).on('click', '.view-agent-details', function(e) {
    e.preventDefault();

    var requestId = $(this).data('id');
    var rowData = table.row($(this).parents('tr')).data();

    let contact_data = "";
    if(rowData.contact_by_mobile!=0)
    contact_data +=  'By Mobile';
    
     let user_img = "{{ asset('assets/img/default_user.png') }}";
     let avatar_base = "{{ asset('avatars') }}/";

    if (rowData.user.avatar_img !== "" && rowData.user.avatar_img !== null) 
    {
      user_img = avatar_base + rowData.user.avatar_img;
    }
      

    if(rowData.contact_by_email!=0)
    {
      if (contact_data != "") {
        contact_data += ' | ';
       } 

       contact_data +=  'By Email';
    }
    
    
    var modal_html = `<div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
           
             <h5 class="modal-title" id="viewAgentdetails"><img src="{{asset('assets/dashboard/img/data-listing.png')}}" style="width:40px; margin-right:10px;" alt="Request Accepted"> Agent Request</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
             <div class="card mb-4 border-0">
                <div class="card-body">
                   <div class="row">
                      <div class="col mt-0">
                         <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl pr-3 mt-1">
                               <img src="${user_img}">
                            </div>
                            <div class="ms-3 name">
                               <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>${rowData.first_name} ${rowData.last_name}</b></a></h5>
                               <h6 class="text-muted mb-0 small">Member ID: ${rowData.ref_number} <span class="ml-5 pl-3">Date: ${rowData.requested_at}</span></h6>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="card-body pt-4">
                      <div class="row">
                         <div class="col-md-6 list-sec pt-3">
                            <h6><b>Email :</b> <span>${rowData.email}</span></h6>
                            <h6><b>Mobile :</b> <span class="ml-2">${rowData.mobile_number}</span></h6>
                         </div>
                         <div class="col-md-6 list-sec pt-3">
                            <h6><b>Home State :</b> <span class="ml-2">${rowData.country_code}</span></h6>
                            <h6><b>Contact Method :</b> <span class="ml-2">${contact_data}</span></h6>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-12 list-sec pt-1 d-flex gap-10 align-items-center justify-content-start">
                            <h6><b>Comments :</b> </h6>
                            <h6>${rowData.comments}</h6>
                         </div>
                      </div>

                     <div class="row">
                        <div class="col-lg-12 text-right">
                           <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                     </div>

                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>`;
    $('#viewAgentdetails').html(modal_html);
    $('#viewAgentdetails').modal('show');
   });

   });
 </script>

         <script>
            // $(document).ready(function(){
            //   setInterval(function () {
            //       $('#agentRequestreportTable').DataTable().ajax.reload(function (json) {
            //          console.log("Returned JSON:", json);
            // }, false);
            // }, 15000);
            // });
          </script> 



@endsection
