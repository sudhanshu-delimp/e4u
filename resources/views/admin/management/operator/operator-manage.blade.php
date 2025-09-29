@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
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
                  <h1 class="h1">Manage Operator</h1>
                  <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                     <li>Manage the Operator from here.</li>
                     <li>Update the Operator’s details and status from here.</li>
                    </ol>
                </div>
                </div>
            </div>
        </div>
        {{-- end --}}
         <div class="row">
            <div class="col-md-12">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">  
                        <div class="tab-pane fade active show" id="tab3warning">
                           <div class="row pb-3">
                              
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                 <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#addOperator">Add Operator</button>
                                 </div>
                              </div>
                           </div>                                    
                           <div class="table-responsive-xl">
                              <table class="table mb-3" id="OperatorTable">
                                 <thead class="table-bg">
                                 <tr>
                                    <th scope="col">
                                    ID
                                       
                                    </th>
                                    <th scope="col">
                                       Operator
                                       
                                    </th>
                                    <th scope="col">
                                       Territory
                                    </th>
                                    <th scope="col">
                                       Contact
                                    </th>
                                    <th scope="col">
                                    Email
                                    </th>
                                    <th scope="col">
                                       Agents                                             
                                    </th>
                                    <th scope="col">
                                    Last Login
                                    </th>
                                    <th scope="col">
                                       Status
                                       </th>
                                    
                                    <th scope="col">Action</th>
                                 </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    <tr>
                                       <td width="10%" class="theme-color">O60458</td>
                                       <td class="theme-color">Agency Management
                                          (Australia) Pty Ltd</td>
                                       <td class="theme-color">Aus</td>
                                       <td class="theme-color">Wayne
                                          Primrose</td>
                                       <td class="theme-color">admin@agencymanagement.com.au </td>
                                       <td class="theme-color">13</td>
                                       <td class="theme-color">20-05-2025 09:12 am</td>
                                       <td class="theme-color">Active </td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#ViewOperator">  <i class="fa fa-eye "></i> View Account</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#Suspend-popup" data-toggle="modal">   <i class="fa fa-ban"></i> Suspend</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#updateOperator" data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>                                 
                                 <tfoot class="bg-first">
                                    <tr>
                                       <th colspan="3" class="text-left">Server time: <span class="serverTime">{{ getServertime() }}</span></th>
                                       <th colspan="3" class="text-center">Refresh time: <span class="refreshSeconds"> 15</span></th>
                                       <th colspan="3" class="text-right">Up time: <span class="uptimeClass">{{getAppUptime()}}</span></th>
                                    </tr>
                              </tfoot>
                              </table>
                              
                           </div>
                        </div>
                           
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>



<!-- add new Operator member popupform -->
<div class="modal fade upload-modal" id="addOperator" tabindex="-1" role="dialog" aria-labelledby="addOperatorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addOperator"><img src="{{ asset('assets/dashboard/img/add-member.png')}}" class="custompopicon"> Add New Operator</h5>
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
                     <input type="text" class="form-control rounded-0" placeholder="Operator ID" readonly>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Date Appointed" readonly>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Company Name" required>
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
                     <input type="email" class="form-control rounded-0" placeholder="Email" required>
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
                        <label class="form-check-label" for="contactText">Messaging</label>
                     </div>
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
                     <label class="form-check-label" for="contactCall">Call Us</label>
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
                     <input type="number" class="form-control rounded-0" placeholder="Fee" required>
                  </div>

                  <!-- Section: Commission -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising" required>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre (Registrations)" required>
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


<!-- update Operator member popupform -->
<div class="modal fade upload-modal" id="updateOperator" tabindex="-1" role="dialog" aria-labelledby="updateOperatorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="updateOperator"> <img src="{{ asset('assets/dashboard/img/add-member.png')}}" class="custompopicon"> Update Operator Details</h5>
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
                     <input type="text" class="form-control rounded-0" placeholder="Operator ID" readonly>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text"  class="form-control rounded-0"  required placeholder="Date Appointed (DD/MM/YYYY)" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Company Name" required>
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
                     <input type="email" class="form-control rounded-0" placeholder="Email" required>
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
                        <label class="form-check-label" for="contactText">Messaging</label>
                     </div>
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
                     <label class="form-check-label" for="contactCall">Call Us</label>
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
                     <input type="number" class="form-control rounded-0" placeholder="Fee" required>
                  </div>

                  <!-- Section: Commission -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising" required>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre (Registrations)" required>
                  </div>

               </div>
               <div class="modal-footer p-0 pl-2 pb-4">
                  <button type="submit" class="btn-success-modal mr-2">Update</button>
                  <button type="submit" class="btn-cancel-modal mr-2">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end -->


<!-- View Operator Member popupform -->
<div class="modal fade upload-modal" id="ViewOperator" tabindex="-1" role="dialog" aria-labelledby="ViewOperatorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content basic-modal">
         
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title" id="ViewOperatorLabel">
               <img src="{{ asset('assets/dashboard/img/add-member.png')}}" class="custompopicon"> 
               View Operator Details
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>

         <!-- Body -->
         <div class="modal-body custom-modal-height">
            <div class="row">
               <div class="col-12">
                  <div class="card mb-3 p-3">

                     <!-- Avatar + Name -->
                     <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/img/default_user.png')}}" alt="Avatar" class="rounded-circle mr-3" width="50" height="50">
                        <h6 class="mb-0">Agency Management (Australia) Pty Ltd</h6>
                     </div>

                     <!-- Personal Details -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Operator ID</th><td>123456</td></tr>
                        <tr><th>Date Appointed</th><td>2023-08-15</td></tr>
                        <tr><th>Company Name</th><td>XYZ Security Services</td></tr>
                        <tr><th>Business Name</th><td>XYZ Pty Ltd</td></tr>
                        <tr><th>ABN</th><td>12 345 678 910</td></tr>
                        <tr><th>Business Address</th><td>123 Street, City, State</td></tr>
                        <tr><th>Business Number</th><td>987654321</td></tr>
                        <tr><th>Point of Contact</th><td>John Doe</td></tr>
                        <tr><th>Mobile</th><td>0412 345 678</td></tr>
                        <tr><th>Email</th><td>john@example.com</td></tr>
                        <tr><th>Territory</th><td>North</td></tr>
                        <tr><th>Method of Contact</th><td>Messaging, Text, Email, Call Us</td></tr>
                     </table>

                     <!-- Agreement Details -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Agreement Date</th><td>2023-09-01</td></tr>
                        <tr><th>Term</th><td>12 months</td></tr>
                        <tr><th>Fee</th><td>$500</td></tr>
                     </table>

                     <!-- Commission -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Advertising</th><td>$150.00</td></tr>
                        <tr><th>Massage Centre (Registrations)</th><td>$75.00</td></tr>
                     </table>

                     <!-- Footer Buttons -->
                     <div class="d-flex justify-content-end mb-2">
                        <button class="btn-success-modal d-block mr-2" onclick="window.print();">
                           <i class="fa fa-print text-white"></i> Print
                        </button>
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">
                           Close
                        </button>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end -->

{{-- suspend popup --}}


<div class="modal fade upload-modal" id="Suspend-popup" tabindex="-1" role="dialog"
   aria-labelledby="SuspendPopupLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header border-0">
               <input type="hidden" id="status_data_id">
               <input type="hidden" id="status_data_value">
               <h5 class="modal-title d-flex align-items-center" id="SuspendPopupLabel">
                  <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                     class="custompopicon">
                  <span>Confirmation</span>
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                     <img src="{{ asset('assets/app/img/newcross.png') }}"
                           class="img-fluid img_resize_in_smscreen">
                  </span>
               </button>
         </div>

         <div class="modal-body pb-0 teop-text text-center">
               <h5 class="popu_heading_style mt-2">
                  Are you sure you want to perform this action.
               </h5>

         </div>

         <div class="modal-footer justify-content-center border-0 pb-4">

               <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                  aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal"
                  data-dismiss="modal" aria-label="Close">No</button>
         </div>
      </div>
   </div>
</div>

{{-- end --}}
@endsection

@push('script')
   <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
    "></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
   <script>
     $(document).ready(function () {
      var table = $('#OperatorTable').DataTable({
         paging: true,
         searching: true,
         ordering: true,
         info: true,
         responsive: true,
         language: {
            search: "Search:",
            searchPlaceholder: "Search by Staff ID or Name..."
         },
         columnDefs: [
            { orderable: false, targets: -1 } // Disable ordering on Action column
         ]
      });

   });

   $(document).ready(function(e) {
            // ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' '+countdown);

                if (countdown <= 0) {
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });
        })
</script>
   
@endpush