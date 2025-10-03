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
               <h1 class="h1">Manage SIMs</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                        <li>Manage the allocation of SIMs here.</li>
                        <li>Renew the term of an Advertiser’s SIM.</li>
                        <li>When actioning a SIM, attend to the following:
                           <ol class="level-2">
                              <li>For a New service:
                                 <ol class="level-3">
                                    <li>acquire the Mobile number from the service provider and update the
                                       record.</li>
                                       <li>complete the transaction by debiting the Advertiser’s Card.</li>
                                       <li>dispatch the SIM via Australia Post, and update the record with the
                                          tracking number (Operations Console - Admin).</li>
                                 </ol>
                              </li>
                              <li>When Renewing a service update the online portal with the service provider
                                 (Telco).</li>
                              <li>When replacing a SIM, follow (a) above.</li>
                              <li>To Suspend a SIM, refer to Management.</li>
                           </ol>
                        </li>
                        </ol>
                     </div>
               </div>
            </div>
         </div> 
          <div class="row">
            <div class="col-md-12 col-sm-12 d-flex justify-content-end my-3 gap-20">
                  
               <div class="total_listing">
                   <div><span>Available SIMs : </span></div>
                   <div><span class="totalListing">05</span></div>
               </div>
               <div class="total_listing">
                  <div><span>Active SIMs : </span></div>
                  <div><span class="totalListing">02</span></div>
              </div>
           </div>
            <div class="col-md-12">
               <div class="table-responsive custom-badge">
                  <table class="table table-bordered " id="EmailRequestTable">
                     <thead class="table-bg">
                        <tr>
                           <th>Carrier</th>
                           <th>USIM</th>
                           <th>Number</th>
                           <th>Activation Date</th>
                           <th>Member ID</th>
                           <th>Term</th>
                           <th>Status</th>
                           <th class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <tr>
                           <td>Optus</td>
                           <td>57 23406 36429 2</td>
                           <td>-</td>
                           <td>11-06-2025</td>
                           <td>E60125</a></td>
                           <td>12 months</td>
                           <td><span class="badge badge-warning">Available</span></td>
                           <td class="text-center"> 
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-circle"></i> Activate</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#edit_req"> <i class="fa fa-pen "></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#renew_req"> <i class="fa fa-sync "></i> Renew</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#reject_popup"> <i class="fa fa-fw fa-ban"></i> Deactivate </a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                      
                     </tbody>
                  </table>
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


@endsection

<!-- Edit Modal -->
<div class="modal fade upload-modal" id="edit_req" tabindex="-1" aria-labelledby="edit_reqLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
       <div class="modal-header">
         <h5 class="modal-title" id="edit_reqLabel">
           <img src="{{ asset('assets/dashboard/img/edit-task.png')}}" alt="edit" class="custompopicon"> Edit SIM Record
         </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
       </div>
       <div class="modal-body pb-0">
         <form id="editForm">
           <div class="row">
             <div class="col-12 mb-3">
               <label for="editMobile" class="label">Mobile number</label>
               <input type="text" id="editMobile" class="form-control rounded-0" placeholder="Enter mobile number">
             </div>
             <div class="col-12 mb-3">
               <label for="editActivation" class="label">Activation Date</label>
               <input type="date" id="editActivation" class="form-control rounded-0">
             </div>
             <div class="col-12 mb-3">
               <label for="editMember" class="label">Member ID</label>
               <input type="text" id="editMember" class="form-control rounded-0" placeholder="Enter member ID">
             </div>
             <div class="col-12 mb-3">
               <label for="editTerm" class="label">Term (Months)</label>
               <input type="number" id="editTerm" class="form-control rounded-0" placeholder="e.g. 12">
             </div>
           </div>
         </form>
       </div>
       <div class="modal-footer pb-4 mb-2">
         <button type="submit" form="editForm" class="btn-success-modal">Save Changes</button>
       </div>
     </div>
   </div>
</div>
{{-- end --}}
<!-- Renew Modal -->
<div class="modal fade upload-modal" id="renew_req" tabindex="-1" aria-labelledby="renew_reqLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
       <div class="modal-header">
         <h5 class="modal-title" id="renew_reqLabel">
            <img src="{{ asset('assets/dashboard/img/renew.png')}}" alt="alert" class="custompopicon"> Renew SIM Record
         </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
       </div>
       <div class="modal-body pb-0">
         <form id="renewForm">
           <div class="row">
             <div class="col-12 mb-3">
               <label for="renewStatus" class="label">Status</label>
               <select id="renewStatus" class="form-control rounded-0">
                 <option value="active">Active</option>
                 <option value="inactive">Inactive</option>
               </select>
               <small class="text-muted">If status was inactive, it will be changed back to Active</small>
             </div>
             <div class="col-12 mb-3">
               <label for="renewTerm" class="label">Term (Months)</label>
               <input type="number" id="renewTerm" class="form-control rounded-0" placeholder="e.g. 12" required>
             </div>
             <div class="col-12 mb-3">
               <label for="renewActivation" class="label">Activation Date</label>
               <input type="date" id="renewActivation" class="form-control rounded-0" required>
             </div>
           </div>
         </form>
       </div>
       <div class="modal-footer pb-4 mb-2">
         <button type="submit" form="renewForm" class="btn-success-modal">Renew</button>
       </div>
     </div>
   </div>
</div>
<!-- End Renew Modal -->

{{-- confirm_popup --}}
<div class="modal fade upload-modal" id="confirm_popup" tabindex="-1" aria-labelledby="confirm_popupLabel" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content custome_modal_max_width">
   <div class="modal-header">
      <h5 class="modal-title" id="confirm_popup"><img src="{{ asset('assets/dashboard/img/unblock.png')}}" alt="alert" class="custompopicon"> Completed
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
               The order has been completed.
           </h5>
         </div>
         <div class="modal-footer pb-4 mb-2 justify-content-center">
            <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
{{-- end --}}

{{-- reject_popup --}}
<div class="modal fade upload-modal" id="reject_popup" tabindex="-1" aria-labelledby="reject_popupLabel" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content custome_modal_max_width">
   <div class="modal-header">
      <h5 class="modal-title" id="reject_popup"><img src="{{ asset('assets/dashboard/img/block.png')}}" alt="alert" class="custompopicon"> Rejected
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
               E4U has rejected the Request.
           </h5>
         </div>
         <div class="modal-footer pb-4 mb-2 justify-content-center">
            <button type="button" class="btn-success-modal" data-dismiss="modal">Confirm</button>
            <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
{{-- end --}}
@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#EmailRequestTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID..."
      },
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10
   });

 </script>
  
@endpush