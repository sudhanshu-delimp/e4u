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
               <h1 class="h1">Manage Suppliers</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                  <div class="card-body">
                     <h3 class="NotesHeader"><b>Notes:</b> </h3>
                     <ol>
                        <li>Create and manage Suppliers here.</li>
                        <li>Manage status of Suppliers.</li>
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
                                    <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#addNewMerchant">Add New Merchant</button>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive-xl">
                              <table class="table mb-3 w-100" id="ManageSupplierTable">
                                 <thead class="table-bg">
                                    <tr>
                                    <th scope="col">Merchant ID</th>
                                    <th scope="col">Merchant</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                       <tr>
                                          <td>M60458</td>
                                          <td>Condom Man</td>
                                          <td>Western Australia</td>
                                          <td>0438 028 728</td>
                                          <td>info@condomma.com.au</td>
                                          <td>Pending</td>
                                          <td>
                                             <div class="dropdown no-arrow">
                                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                 </a>
                                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                   <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#view_merchant_data">  <i class="fa fa-eye "></i> View Account</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Suspend</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#edit_merchant_data" data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>
                                                </div>
                                             </div>
                                         </td>
                                       </tr>
                                 </tbody>
                                 <tfoot class="bg-first">
                                    <tr>
                                        <th colspan="2" class="text-left">Server time: <span>10:23:51 am</span></th>
                                        <th colspan="3" class="text-center">Refresh time:<span>seconds</span></th>
                                        <th colspan="2" class="text-right">Up time: <span>214 days & 09 hours 12 minutes</span></th>
                                    </tr>
                                </tfoot>
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

<!-- Add New Merchant member popupform -->
<div class="modal fade upload-modal" id="addNewMerchant" tabindex="-1" role="dialog" aria-labelledby="addNewMerchantLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addNewMerchant"> <img src="{{ asset('assets/dashboard/img/add-agent.png')}}" class="custompopicon"> Add New Merchant</h5>
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
                  <input type="text" class="form-control rounded-0" placeholder="Merchant ID" readonly>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Date Appointed" readonly>
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
                  <select class="form-control rounded-0" required>
                    <option>Select Location</option>
                    <option>North</option>
                    <option>South</option>
                    <option>East</option>
                    <option>West</option>
                  </select>
               </div>
               <div class="col-12 mb-3">
                  <select class="form-control rounded-0" required>
                     <option>Concierge Service</option>
                     <option value="email">Email</option>
                     <option value="product">Product</option>
                     <option value="sim">SIM</option>
                   </select>
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

              <!-- Section: Bank Account -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Bank Account</h6>
               </div>
               
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Bank" required>
               </div>
               
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Account Name" required>
               </div>
               
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="BSB" required>
               </div>
               
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Account Number" required>
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
 
<!-- Edit Merchant popupform -->
<div class="modal fade upload-modal" id="edit_merchant_data" tabindex="-1" role="dialog" aria-labelledby="edit_merchant_dataLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="edit_merchant_data"> 
               <img src="{{ asset('assets/dashboard/img/update-agent.png')}}" class="custompopicon"> 
               Update Merchant Details 
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">

                  <!-- Merchant Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Merchant Details</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Merchant ID (Auto)" readonly value="M10001">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Date Appointed" value="2024-03-01">
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
                     <select class="form-control rounded-0">
                        <option>Select Location</option>
                        <option selected>North</option>
                        <option>South</option>
                        <option>East</option>
                        <option>West</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Concierge Service</option>
                        <option selected>Email</option>
                        <option>Product</option>
                        <option>SIM</option>
                     </select>
                  </div>

                  <!-- Agreement Details -->
                  <div class="col-12 my-2">
                     <h6 class="pb-1 text-blue-primary">Agreement Details</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" value="2023-12-01">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Term" value="12 Months">
                  </div>

                  <!-- Bank Account -->
                  <div class="col-12 my-2">
                     <h6 class="pb-1 text-blue-primary">Bank Account</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Bank" value="ANZ">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Account Name" value="Wayne Primrose">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" class="form-control rounded-0" placeholder="BSB" value="123456">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" class="form-control rounded-0" placeholder="Account Number" value="987654321">
                  </div>

               </div>
               <div class="modal-footer p-0 pl-2 pb-4">
                  <button type="submit" class="btn-success-modal mr-2">Update</button>
                  <button type="button" class="btn-success-modal">Approve</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- view merchant modal popup --}}

<!-- View Merchant popupform -->
<div class="modal fade upload-modal" id="view_merchant_data" tabindex="-1" role="dialog" aria-labelledby="view_merchant_dataLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title" id="view_merchant_dataLabel">
               <img src="{{asset('assets/dashboard/img/view-merchant.png')}}" class="custompopicon" alt="View Merchant">
               View Account
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>

         <!-- Body -->
         <div class="modal-body pb-0 custom-merchant-modal">
            <div class="row">
               <div class="col-12">
                  
                  <div class="card mb-3 p-3">
                     <!-- Avatar + Name -->
                     <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/img/default_user.png')}}" alt="Avatar" class="rounded-circle mr-3" width="50" height="50">
                        <h6 class="mb-0">Wayne Pty Ltd</h6>
                     </div>

                     <!-- Merchant Details -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Merchant Details</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Merchant ID</th><td>M10001</td></tr>
                        <tr><th>Date Appointed</th><td>2024-03-01</td></tr>
                        <tr><th>ABN</th><td>12345678901</td></tr>
                        <tr><th>Business Address</th><td>123 King St, Melbourne</td></tr>
                        <tr><th>Business Number</th><td>028888999</td></tr>
                        <tr><th>Point of Contact</th><td>Wayne Primrose</td></tr>
                        <tr><th>Mobile</th><td>0438 028 728</td></tr>
                        <tr><th>Private Email</th><td>wayne.personal@gmail.com</td></tr>
                        <tr><th>Location</th><td>North</td></tr>
                        <tr><th>Concierge Service</th><td>Email</td></tr>
                     </table>

                     <!-- Agreement Details -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Agreement Date</th><td>2023-12-01</td></tr>
                        <tr><th>Term</th><td>12 Months</td></tr>
                     </table>

                     <!-- Bank Account -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Bank Account</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Bank</th><td>ANZ</td></tr>
                        <tr><th>Account Name</th><td>Wayne Primrose</td></tr>
                        <tr><th>BSB</th><td>123456</td></tr>
                        <tr><th>Account Number</th><td>987654321</td></tr>
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



{{-- end --}}
<div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div class="modal fade upload-modal" id="printAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>


@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#ManageSupplierTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Merchant ID"
      },
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      columns: [
               { data: 'merchant_id', name: 'merchant_id' },
               { data: 'merchant', name: 'merchant' },
               { data: 'location', name: 'location' },
               { data: 'mobile', name: 'mobile' },
               { data: 'email', name: 'email' },
               { data: 'status', name: 'status' },
               { data: 'action', name: 'action', orderable: false, class:'text-center' }
         ]
   });

 </script>
@endpush