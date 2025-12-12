@extends('layouts.admin')
@section('style')

@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <!--middle content-->
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Manage Agents</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                  <div class="card-body">
                     <h3 class="NotesHeader"><b>Notes:</b> </h3>
                     <ol>
                        <li>Create and manage Agents here.</li>
                        <li>Manage status of Agents.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                           <div class="row pb-3">

                              <div class="col-md-12 col-sm-12">
                                 <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="create-tour-sec dctour add-agent-btn" data-toggle="modal">Add New Agent</button>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive-xl">
                              <table class="table mb-3 w-100" id="agent_data_table">
                                 <thead class="table-bg">
                                    <tr>
                                    <th>Agent ID</th>
                                    <th>Agent</th>
                                    <th>Territory</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Clients</th>
                                    <th>Last Login</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    
                                 </tbody>
                              </table>
                           </div>
            </div>
         </div>
      </div>
      <!--middle content end here-->
   </div>
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
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

 



<div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div class="modal fade upload-modal" id="printAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div class="modal fade upload-modal" id="addNewAgent" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div id="print-container" style="display:none;"></div>

@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(e) 
   {
      var table = $("#agent_data_table").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Agent ID",
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.agent_list_data_table') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
      { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
      { data: 'business_name', name: 'business_name', searchable: true, orderable:false ,defaultContent: 'NA'},
      { data: 'territory', name: 'territory', searchable: true, orderable:true ,defaultContent: 'NA'},
      { data: 'phone', name: 'phone', searchable: true, orderable:true ,defaultContent: 'NA'},
      { data: 'email', name: 'email', searchable: false, orderable:true ,defaultContent: 'NA'},
      { data: 'no_of_client', name: 'no_of_client', searchable: true, orderable:false,defaultContent: 'NA' },
      { data: 'last_login', name: 'last_login', searchable: false, orderable:false,defaultContent: 'NA' },
      { data: 'status', name: 'status', searchable: false, orderable:false,defaultContent: 'NA' },
      { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],

      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


     
       
      ///////// Suspend Agent //////////////////////////////
      $(document).on('click', '.account-suspend-btn', async function(e) 
      {
          if (await isConfirm({'action': 'Suspend','text':' Suspend This Account.'})) { 
            ajaxRequest({
               url: "{{ route('admin.suspend-agent') }}",
               method : 'POST',
               data: {
                  id: $(this).data('id'),
                  request_type: 'suspend'
               },
               success: function(response) {
                  console.log(response)
                  if (response.status) {
                   swal_success_popup(response.message);
                   table.ajax.reload(null, false); 
                  }
                  else
                  {
                   swal_error_popup(response.message);
                  }
               },
               error: function(xhr) {
                  swal_error_popup('Error occured whiile making request');
               }
            });

          }
      })

      ///////// View Agent //////////////////////////////
      $(document).on('click', '.view-account-btn', function(e) 
      {
         var requestId = $(this).data('id');
         var rowData = table.row($(this).parents('tr')).data();
         const safeData = JSON.stringify(rowData).replace(/'/g, "&apos;").replace(/"/g, "&quot;");

         console.log(rowData);

         let user_img = "{{ asset('assets/img/default_user.png') }}";
         let avatar_base = "{{ asset('avatars') }}/";
         if (rowData.avatar_img !== "" && rowData.avatar_img !== null) 
         user_img = avatar_base + rowData.avatar_img;
         

         var modal_html =`<div id="account-row-${requestId}" class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationPopup"> <img src="{{asset('assets/dashboard/img/view-merchant.png')}}" style="width:40px; margin-right:10px;" alt="Request Accepted"> 
                                    View Account
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                    </button>
                                 </div>
                                 <div class="modal-body pb-0">
                                       <div class="row">
                                          <div class="col-12">
                                                
                                          <div class="card mb-3 p-3">
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center mb-3">
                                                   <img src="${user_img}" alt="Avatar" class="rounded-circle mr-3" width="50" height="50">
                                                   <h6 class="mb-0">${(rowData.contact_person ? rowData.contact_person : 'NA')}</h6>
                                                </div>
                                       
                                                <!-- Details Table -->
                                                <table class="table table-bordered mb-3">
                                                   <tr><th>Business Name</th><td>${(rowData.business_name) ? rowData.business_name : 'NA'}</td></tr>
                                                   <tr><th>Mobile</th><td>${(rowData.business_number) ? rowData.business_number : 'NA'}</td></tr>
                                                   <tr><th>Email</th><td>${(rowData.email) ? rowData.email : 'NA'}</td></tr>
                                                   <tr><th>ABN</th><td>${(rowData.abn) ? rowData.abn : 'NA'}</td></tr>
                                                   <tr><th>Address</th><td>${(rowData.business_address) ? rowData.business_address : 'NA'}</td></tr>
                                                </table>
                                       
                                                <div class="d-flex justify-content-end mb-2">
                                                   <!-- Print Button -->

                                                    <button class="btn-success-modal d-block btn-print" data-agent='${safeData}'>
                                                         <i class="fa fa-print text-white"></i> Print
                                                   </button>

                                                
                                                <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                             </div>
                                                   
                                          </div>
                                       </div>
                                 </div>
                              
                              </div>
                           </div>`;


               $('#printAgentdetails').html(modal_html);
               $('#printAgentdetails').modal('show');
               
               

      });

      ///////// Edit Agent //////////////////////////////
      $(document).on('click', '.edit-agent-btn', function(e) 
      {
                  var requestId = $(this).data('id');
                  var rowData = table.row($(this).parents('tr')).data();
                  const states = @json(config('escorts.profile.states'));
                  const savedStateId = rowData.state_id;
                  let viewerContactType = rowData.viewer_contact_type || []; 

                  


                  let optionsHtml = '<option>Select Territory</option>';
                  Object.entries(states).forEach(([key, state]) => {
                     const selected = (String(key) === String(savedStateId)) ? 'selected' : '';
                     optionsHtml += `<option value="${key}" ${selected}>${state.stateName}</option>`;
                  });
               
                  if (!viewerContactType) {
                     viewerContactType = [];
                  } else if (typeof viewerContactType === "string") {
                     try {
                        viewerContactType = JSON.parse(viewerContactType);
                     } catch (e) {
                        viewerContactType = [];
                     }
                  }

               const update_button = rowData.status === 'Pending' ? '<button type="button" class="btn-success-modal mr-2 mt-3 approve_account" data-id='+rowData.id+'>Approve</button>' : '';

               const selectedValues = Array.isArray(viewerContactType) ? viewerContactType.map(String) : [];
               const agent_details = (rowData.agent_detail && Object.keys(rowData.agent_detail).length > 0) ? rowData.agent_detail : null; 
               const agreement_file = agent_details?.agreement_file 
                    ? `<a href="{{ asset('storage') }}/${agent_details.agreement_file}" target="_blank">Download Agreement</a>` 
                  : '';
               
                  let viewer_contact_type_1 = false;
                  let viewer_contact_type_2 = false;
                  let viewer_contact_type_3 = false;

                  if (Array.isArray(selectedValues) && selectedValues.length > 0) {
                     selectedValues.forEach(val => {
                        switch(val) {
                              case "1":
                                 viewer_contact_type_1 = true;
                                 break;
                              case "2":
                                 viewer_contact_type_2 = true;
                                 break;
                              case "3":
                                 viewer_contact_type_3 = true;
                                 break;
                        }
                     });
                  }
               
                  

                  var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content basic-modal">
                     <div class="modal-header">
                        <h5 class="modal-title" id="edit_agent_data"> <img src="{{ asset('assets/dashboard/img/update-agent.png')}}" class="custompopicon"> Update Agent (${rowData.member_id}) </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form name="update_agent" method="POST" action="{{ route('admin.update-agent') }}" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-12 my-2">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                              </div>

                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Business Name" name="business_name" id="business_name" value="${(rowData.business_name ? rowData.business_name : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="ABN" name="abn" id="abn" value="${(rowData.abn ? rowData.abn : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Business Address" name="business_address" id="business_address" value="${(rowData.business_address ? rowData.business_address : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Business Number" name="business_number" id="business_number" value="${(rowData.business_number ? rowData.business_number : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Contact Person" name="contact_person" id="contact_person" value="${(rowData.contact_person ? rowData.contact_person : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone" id="phone" value="${(rowData.	phone ? rowData.	phone : '')}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="email" class="form-control rounded-0" placeholder="Private Email"  name="email" id="email" value="${(rowData.email ? rowData.email : '')}">
                                 <span class="text-danger error-email"></span>
                                 </div>
                              <div class="col-6 mb-3">
                                 <input type="email" class="form-control rounded-0" placeholder="E4U Email" name="email2" id="email2" value="${(rowData.email2 ? rowData.	email2 : '')}">
                                 <span class="text-danger error-email2"></span>
                                 </div>
                              <div class="col-6 mb-3">
                                 <select class="form-control rounded-0" name="state_id" id="state_id">${optionsHtml}</select>
                                 
                              </div>

                           
                              <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                 <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="viewer_contact_type[]" value="1" ${viewer_contact_type_1 ? 'checked' : ''}>
                                    <label class="form-check-label" for="contactText">Text</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="viewer_contact_type[]" value="2" ${viewer_contact_type_2 ? 'checked' : ''}>
                                    <label class="form-check-label" for="contactEmail">Email</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="viewer_contact_type[]" value="3" ${viewer_contact_type_3 ? 'checked' : ''}>
                                    <label class="form-check-label" for="contactCall">Call Me</label>
                                 </div>
                              </div>

                              <!-- Agreement Details -->
                              <div class="col-12 my-2">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="date" class="form-control rounded-0"  name="agreement_date" id="agreement_date" value="${agent_details?.agreement_date ??  ''}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Term"  name="term" id="term" value="${agent_details?. term ?? ''}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Option Period"  name="option_peroid" id="option_peroid" value="${agent_details?. option_peroid ?? ''}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control rounded-0" placeholder="Option Exercised"  name="option_exercised" id="option_exercised" value="${agent_details ?. option_exercised ?? ''}">
                              </div>

                              <!-- Commission -->
                              <div class="col-12 my-2">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                              </div>
                              <div class="col-6 mb-3">
                                 <input class="form-control rounded-0" placeholder="Advertising Commission %" name="commission_advertising_percent" id="commission_advertising_percent" value="${agent_details ?. commission_advertising_percent ?? ''}">
                              </div>
                              <div class="col-6 mb-3">
                                 <input  class="form-control rounded-0" placeholder="Massage Centre Commission %" name="commission_registration_amount" id="commission_registration_amount" value="${agent_details ?. commission_registration_amount ?? ''}">
                              </div>


                                 <div class="col-6 mb-3">
                              <h6 class=" pb-1 text-blue-primary">Agreement File</h6>
                              <input type="file" name="agreement_file" id="agreement_file">
                                 <div id="file_preview" class="mt-2"></div>
                                 </div>

                                 <div class="col-6 mb-3 my-auto text-right">${agreement_file}</div>

                              

                           </div>
                           <div class="modal-footer p-0 pl-2 pb-4">
                              <input type="hidden" name="user_id" value="${(rowData.id ? rowData.id : '')}" >
                              
                              ${update_button}
                              <button type="submit" class="btn-success-modal mr-2 mt-3">Update</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>`;

                  $('#viewAgentdetails').html(modal_html);
                  $('#viewAgentdetails').modal({backdrop: 'static',  keyboard: false});          

      });


      ///////// Update Agent //////////////////////////////
      $(document).on('submit', 'form[name="update_agent"]', function(e) 
      {
            e.preventDefault(); 

            let form = $(this);
            let formData = new FormData(this);

            $('.error-email2').text('');
            $('.error-email').text('');

            swal_waiting_popup({'title':'Validating email..'});
            $.ajax({
               url: "{{ route('admin.check-agent-email') }}", 
               method: "POST",
               data: formData,
               contentType: false,
               processData: false,
               success: function(res) {
                     if (res.status) {
                        swal_waiting_popup({'title':'Updating agent details..'});
                        $.ajax({
                           url: "{{ route('admin.update-agent') }}",
                           method: 'POST',
                           data: formData,
                           contentType: false,
                           processData: false, 
                           success: function(response) {
                                 table.ajax.reload(null, false); 
                                 Swal.close();
                                 $('#viewAgentdetails').modal('hide');
                                 swal_success_popup(response.message);
                           },
                           error: function(xhr) {
                              
                                 Swal.close();
                                 $('#viewAgentdetails').modal('hide');
                                 swal_error_popup(xhr.responseJSON.message);
                           }
                        });
                     }
               },
                  error: function(xhr) {
                     Swal.close();
                     if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.email) {
                              $('.error-email').text(errors.email[0]);
                        }
                        if (errors.email2) {
                              $('.error-email2').text(errors.email2[0]);
                        }
                     }
                  }
            });
      });

      ///////// Approve Agent //////////////////////////////
      $(document).on('click', '.approve_account', function(e) 
      {

         swal_waiting_popup({'title':'Approving Account'});
         $.ajax({
               url: "{{ route('admin.approve-agent-account') }}",
               method: 'POST',
               data: {'user_id':$(this).attr('data-id'),'status': '1'},
               success: function(response) {
                  table.ajax.reload(null, false); 
                  Swal.close();
                  $('#viewAgentdetails').modal('hide');
                  swal_success_popup(response.message);
               },
               error: function(xhr) {
                  
                  Swal.close();
                  $('#viewAgentdetails').modal('hide');
                  swal_error_popup(xhr.responseJSON.message);
               }
            });
      })

      //////// Activate Account ////////////////////////////
      $(document).on('click', '.active-account-btn', async function(e) 
      {

         if (await isConfirm({'action': 'Activate','text':' Activate This Account.'})) { 
         swal_waiting_popup({'title':'Activating Account'});
         $.ajax({
               url: "{{ route('admin.active-agent-account') }}",
               method: 'POST',
               data: {'user_id':$(this).attr('data-id'),'status': '1'},
               success: function(response) {
                  table.ajax.reload(null, false); 
                  Swal.close();
                  swal_success_popup(response.message);
               },
               error: function(xhr) {
                  Swal.close();
                  swal_error_popup(xhr.responseJSON.message);
               }
            });
         }
      })




       ///////// Add New Agent //////////////////////////////
      $(document).on('click', '.add-agent-btn', function(e) 
      {
                 
            const states = @json(config('escorts.profile.states'));
            let optionsHtml = '<option>Select Territory</option>';
            Object.entries(states).forEach(([key, state]) => {
                  optionsHtml += `<option value="${key}" >${state.stateName}</option>`;
            });
               
               
            var new_agent_modal =`<div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
            <div class="modal-header">
            <h5 class="modal-title" id="edit_agent_data"> <img src="{{ asset('assets/dashboard/img/update-agent.png')}}" class="custompopicon"> New Agent Details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
            </div>
            <div class="modal-body">
            <form name="add_agent" method="POST" action="{{ route('admin.add-agent') }}" enctype="multipart/form-data">
            <div class="row">
            <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
            </div>

            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Name" name="business_name" id="business_name">
            <span class="text-danger error-business_name"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="ABN" name="abn" id="abn">
               <span class="text-danger error-abn"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Address" name="business_address" id="business_address">
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Number" name="business_number" id="business_number">
             <span class="text-danger error-business_number"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Contact Person" name="contact_person" id="contact_person">
             <span class="text-danger error-contact_person"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone" id="phone">
             <span class="text-danger error-phone"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="email" class="form-control rounded-0" placeholder="Private Email"  name="email" id="email">
            <span class="text-danger error-email"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="email" class="form-control rounded-0" placeholder="E4U Email" name="email2" id="email2">
            <span class="text-danger error-email2"></span>
            </div>
            <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="state_id" id="state_id">${optionsHtml}</select>
            <span class="text-danger error-state_id"></span>
            </div>


            <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
            <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="viewer_contact_type[]" value="1">
            <label class="form-check-label" for="contactText">Text</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="viewer_contact_type[]" value="2">
            <label class="form-check-label" for="contactEmail">Email</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="viewer_contact_type[]" value="3">
            <label class="form-check-label" for="contactCall">Call Me</label>
            </div>
            </div>

            <!-- Agreement Details -->
            <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
            </div>
            <div class="col-6 mb-3">
            <input type="date" class="form-control rounded-0"  name="agreement_date" id="agreement_date">
            <span class="text-danger error-agreement_date"></span>
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Term"  name="term" id="term" >
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Option Period"  name="option_peroid" id="option_peroid">
            </div>
            <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Option Exercised"  name="option_exercised" id="option_exercised">
            </div>

            <!-- Commission -->
            <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
            </div>
            <div class="col-6 mb-3">
            <input class="form-control rounded-0" placeholder="Advertising Commission %" name="commission_advertising_percent" id="commission_advertising_percent">
            </div>
            <div class="col-6 mb-3">
            <input  class="form-control rounded-0" placeholder="Massage Centre Commission %" name="commission_registration_amount" id="commission_registration_amount" >
            </div>


            <div class="col-6 mb-3">
            <h6 class=" pb-1 text-blue-primary">Agreement File</h6>
            <input type="file" name="agreement_file" id="agreement_file">
            </div>

            <div class="col-6 mb-3 my-auto text-right" id="file_preview"></div>

            </div>
            <div class="modal-footer p-0 pl-2 pb-4">
            <button type="submit" class="btn-success-modal mr-2 mt-3">Save</button>
            </div>
            </form>
            </div>
            </div>
            </div>`;

            $('#addNewAgent').html(new_agent_modal);
            $('#addNewAgent').modal({backdrop: 'static',  keyboard: false});          
      });

      $(document).on('submit', 'form[name="add_agent"]', function(e) 
      {
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         $('span.text-danger').text('');

         swal_waiting_popup({'title':'Saving Agent Details'});
         //  return false
       
         $.ajax({
               url: "{{ route('admin.add-agent') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     table.ajax.reload(null, false); 
                     Swal.close();
                     $('span.text-danger').text('');
                     $('#addNewAgent').modal('hide');
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                  
                     Swal.close();
                     console.log(xhr);
                     if (xhr.status === 422) {
                     $('span.text-danger').text('');
                     let errors = xhr.responseJSON.errors;
                     $.each(errors, function(field, messages) {
                     $('.error-' + field).text(messages[0]); 
                     });
                     } else {
                     swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                     }
               }
         });
      });
    

   // $(document).on('change', '#agreement_file', function(e) {
   //  const file = e.target.files[0];
   //  const preview = $('#file_preview');
   //  preview.html(''); 
   //  if (!file) return;
   //  const fileType = file.type;

   //  if (fileType.startsWith('image/')) {
   //      const reader = new FileReader();
   //      reader.onload = function(e) {
   //          preview.append('<img src="' + e.target.result + '" style="max-width:200px; max-height:200px;" />');
   //      };
   //      reader.readAsDataURL(file);
   //  } else if (fileType === 'application/pdf') {
   //      const fileURL = URL.createObjectURL(file);
   //      preview.append('<iframe src="' + fileURL + '" style="width:100%; height:400px;" frameborder="0"></iframe>');
   //  } else {
   //      preview.append('<p>File selected: ' + file.name + '</p>');
   //  }
   // });

    ////////// End Submit Form ////////////////////////



   

   });

   
$(document).on('click', '.btn-print', function() {
    var avatarsPath = "{{ asset('avatars') }}";
    var defaultUser = "{{ asset('assets/img/default_user.png') }}";
    var rowData = $(this).data('agent');
    let user_img = rowData.avatar_img ? avatarsPath + '/' + rowData.avatar_img : defaultUser;

   var printContent = `
    <div style="font-family:Arial; max-width:100%; overflow:hidden; box-sizing:border-box;">
        <table style="border:none; border-collapse:collapse; width:auto; margin-bottom:5px;">
            <tr>
                <td style="vertical-align:middle; border:none;">
                    <img src="${user_img}" style="margin-right:10px; max-height:50px; max-width:50px; object-fit:cover;">
                </td>
                <td style="vertical-align:middle; border:none;">
                    <h4 style="margin:0; font-size:16px;">${rowData.contact_person || 'NA'}</h4>
                </td>
            </tr>
        </table>
        <table style="width:100%; border-collapse:collapse; table-layout:fixed; font-size:14px;" border="1">
            <tr>
                <th style="width:30%; font-weight:bold; padding:6px;">Business Name</th>
                <td style="width:70%; padding:6px; white-space:nowrap;">${rowData.business_name || 'NA'}</td>
            </tr>
            <tr>
                <th style="font-weight:bold; padding:6px;">Mobile</th>
                <td style="padding:6px; white-space:nowrap;">${rowData.business_number || 'NA'}</td>
            </tr>
            <tr>
                <th style="font-weight:bold; padding:6px;">Email</th>
                <td style="padding:6px;"><div style="word-wrap:break-word; overflow-wrap:anywhere;">${rowData.email || 'NA'}</div></td>
            </tr>
            <tr>
                <th style="font-weight:bold; padding:6px;">ABN</th>
                <td style="padding:6px; white-space:nowrap;">${rowData.abn || 'NA'}</td>
            </tr>
            <tr>
                <th style="font-weight:bold; padding:6px;">Address</th>
                <td style="padding:6px;"><div style="word-wrap:break-word; overflow-wrap:anywhere;">${rowData.business_address || 'NA'}</div></td>
            </tr>
        </table>
    </div>`;


      $.ajax({
         url: "{{ route('admin.generate-agent-info-pdf') }}",
         method: 'POST',
         data: {
            _token: '{{ csrf_token() }}',
            html: printContent.trim()
         },
         xhrFields: {
            responseType: 'blob'
         },
         success: function(response) {
            var blob = new Blob([response], {type: 'application/pdf'});
            var blobUrl = URL.createObjectURL(blob);
            window.open(blobUrl); 
         },
         error: function(xhr, status, error) {
            alert('PDF generation failed: ' + error);
         }
      });
});

</script>
@endpush

