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
               <h1 class="h1">Manage Agent </h1>
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
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab3warning">
                           <div class="row pb-3">

                              <div class="col-md-12 col-sm-12">
                                 <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#addStaffnew">Add New Agent</button>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive-xl">
                              <table class="table mb-3" id="agent_data_table">
                                 <thead class="table-bg">
                                    <tr>
                                    <th scope="col">Agent ID</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">Territory</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Total Clients</th>
                                    <th scope="col">Last Login</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="timer_section">
                  <p>Server time: <span class="serverTime">{{ getServertime() }}</span></p>
                  <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                  <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
               </div>
            </div> -->
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

<!-- add new Agent member popupform -->
<div class="modal fade upload-modal" id="addStaffnew" tabindex="-1" role="dialog" aria-labelledby="addStaffnewLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addStaffnew"> <img src="{{ asset('assets/dashboard/img/add-agent.png')}}" class="custompopicon"> Add New Agent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
            <div class="row">
               <!-- Section: Personal Details -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
               </div>

               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Agent ID (Auto)" readonly>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Date Joined" readonly>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Name" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="ABN" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Address" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Number" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Point of Contact" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Mobile" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="email" class="form-control rounded-0" placeholder="Private Email" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="email" class="form-control rounded-0" placeholder="E4U Email" required>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required>
                    <option>Select Territory</option>
                    <option>North</option>
                    <option>South</option>
                    <option>East</option>
                    <option>West</option>
                  </select>
               </div>
               <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                  <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactText" value="text">
                    <label class="form-check-label" for="contactText">Text</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactEmail" value="email">
                    <label class="form-check-label" for="contactEmail">Email</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactCall" value="call">
                    <label class="form-check-label" for="contactCall">Call Me</label>
                  </div>
               </div>

               <!-- Section: Agreement Details -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
               </div>
               <div class="col-6 mb-3">
                  <input type="text"  class="form-control rounded-0"  required placeholder="Agreement Date (DD/MM/YYYY)" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Term" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Option Period" required>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required>
                    <option>Option Exercised?</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
               </div>

               <!-- Section: Commission -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
               </div>
               <div class="col-6 mb-3">
                  <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising Commission %" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre Commission %" required>
               </div>

            </div>
            <div class="modal-footer p-0 pl-2 pb-4">
               <button type="submit" class="btn-success-modal mr-2">Save</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
 <!-- end -->
 
<!-- Edit Agent member popupform -->
<div class="modal fade upload-modal" id="edit_agent_data" tabindex="-1" role="dialog" aria-labelledby="edit_agent_dataLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="edit_agent_data"> <img src="{{ asset('assets/dashboard/img/update-agent.png')}}" class="custompopicon"> Update Agent Details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <!-- Personal Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Agent ID (Auto)" readonly value="S60001">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Date Joined" readonly value="2024-03-01">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Name" value="Wayne Pty Ltd">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="ABN" value="12345678901">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Address" value="123 King St, Melbourne">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Number" value="028888999">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Point of Contact" value="Wayne Primrose">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Mobile" value="0438 028 728">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" class="form-control rounded-0" placeholder="Private Email" value="wayne.personal@gmail.com">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" class="form-control rounded-0" placeholder="E4U Email" value="wayne@blackboxtech.com.au">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Territory</option>
                        <option selected>North</option>
                        <option>South</option>
                        <option>East</option>
                        <option>West</option>
                     </select>
                  </div>

                  <!-- Method of Contact -->
                  <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                     <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactText" value="text" checked>
                        <label class="form-check-label" for="contactText">Text</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactEmail" value="email">
                        <label class="form-check-label" for="contactEmail">Email</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactCall" value="call" checked>
                        <label class="form-check-label" for="contactCall">Call Me</label>
                     </div>
                  </div>

                  <!-- Agreement Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" value="2023-12-01">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Term" value="12 Months">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Option Period" value="6 Months">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Option Exercised?</option>
                        <option selected>Yes</option>
                        <option>No</option>
                     </select>
                  </div>

                  <!-- Commission -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising Commission %" value="10.50">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre Commission %" value="15.00">
                  </div>
               </div>
            <div class="modal-footer p-0 pl-2 pb-4">
               <button type="submit" class="btn-success-modal mr-2">Update</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div class="modal fade upload-modal" id="printAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>


@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(e) {
   var table = $("#agent_data_table").DataTable({
            language: {
                  search: "Search: _INPUT_",
                  searchPlaceholder: "Search by Agent ID...",
                  lengthMenu: "Show _MENU_ entries",
                  zeroRecords: "No matching records found",
                  info: "Showing _START_ to _END_ of _TOTAL_ entries",
                  infoEmpty: "No entries available",
                  infoFiltered: "(filtered from _MAX_ total entries)"
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
               { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'name', name: 'name', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'territory ', name: 'territory', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'phone', name: 'phone', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'email', name: 'email', searchable: false, orderable:true ,defaultContent: 'NA'},
               { data: 'no_of_client', name: 'no_of_client', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'last_login', name: 'last_login', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
           ],
          
           order: [[1, 'desc']],
           lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
           pageLength: 10,
       });


      $(document).on('click', '.view-account-btn', function(e) {
      var requestId = $(this).data('id');
      var rowData = table.row($(this).parents('tr')).data();

      console.log(rowData);

      let user_img = "{{ asset('assets/img/default_user.png') }}";
      let avatar_base = "{{ asset('avatars') }}/";
      if (rowData.avatar_img !== "" && rowData.avatar_img !== null) 
      user_img = avatar_base + rowData.avatar_img;

      var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="confirmationPopup"> <img src="{{asset('assets/dashboard/img/view-listing.png')}}" style="width:40px; margin-right:10px;" alt="Request Accepted"> 
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
                                                <h6 class="mb-0">${(rowData.name ? rowData.name : 'NA')}</h6>
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
                                             <button class="btn-success-modal d-block" onclick="printAgent('account-row-S60001')">
                                                <i class="fa fa-print text-white"></i> Print
                                             </button>
                                              <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
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



      });




  
</script>
<script type="text/javascript">
   // $(document).ready(function(e) {
   //    // ajaxReload();
   //    let countdown = 15;
   //    setInterval(() => {
   //       countdown--;
   //       $(".refreshSeconds").text(' ' + countdown);

   //       if (countdown <= 0) {
   //          $('#listings').DataTable().ajax.reload(null, false);
   //          countdown = 15;
   //       }

   //    }, 1000);

   //    $('#customSearch').on('keyup', function() {
   //       $('#listings').DataTable().search(this.value).draw();
   //    });
   // })
</script>

<script>
   //  document.addEventListener("DOMContentLoaded", function () {
   //    document.querySelectorAll(".view-account-btn").forEach(function (btn) {
   //       btn.addEventListener("click", function (e) {
   //          e.preventDefault();
   //          const id = btn.getAttribute("data-id");
   //          const row = document.getElementById(`account-row-${id}`);
            
   //          // Toggle visibility
   //          if (row.style.display === "none") {
   //             row.style.display = "table-row";
   //          } else {
   //             row.style.display = "none";
   //          }
   //       });
   //    });
   // });

   
</script>
@endpush