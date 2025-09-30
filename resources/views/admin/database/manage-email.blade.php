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
               <h1 class="h1">Manage Emails</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                        <li>Manage the allocation of Email accounts here.</li>
                        <li>Renew the term of an Advertiser's Email.</li>
                        <li>When establishing a new Email account, attend to the following:
                           <ol class="level-2">
                              <li>determine the email account according to the protocol and update the record.</li>
                              <li>complete the transaction by debiting the Advertiser's Card (12 month account).</li>
                              <li>activate the email.</li>
                           </ol>
                        </li>
                        </ol>
                     </div>
               </div>
            </div>
         </div> 
          <div class="row">
            <div class="col-md-12 col-sm-12 d-flex justify-content-end my-3">
                  
               <div class="total_listing">
                   <div><span>Active Email Accounts : </span></div>
                   <div><span class="totalListing">02</span></div>
               </div>
           </div>
            <div class="col-md-12">
               <div class="table-responsive custom-badge">
                  <table class="table table-bordered " id="EmailRequestTable">
                     <thead class="table-bg">
                        <tr>
                           <th>Server</th>
                           <th>Email Account</th>
                           <th>Notification Address</th>
                           <th>Activation Date</th>
                           <th>Member ID</th>
                           <th>Term</th>
                           <th>Status</th>
                           <th class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <tr>
                           <td>ax.email</td>
                           <td><a href="mailto:julie@e4u.com.au">julie@e4u.com.au</a></td>
                           <td><a href="mailto:julie.1996@gmail.com">julie.1996@gmail.com</a></td>
                           <td>11-06-2025</td>
                           <td>E60125</a></td>
                           <td>12 months</td>
                           <td><span class="badge badge-warning">Pending</span></td>
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
                        <tr>
                           <td>ax.email</td>
                           <td><a href="mailto:mary@e4u.com.au">mary@e4u.com.au</a></td>
                           <td><a href="mailto:mary.1995@gmail.com">mary.1995@gmail.com</a></td>
                           <td>11-06-2025</td>
                           <td>E60125</a></td>
                           <td>12 months</td>
                           <td><span class="badge badge-secondary">On Hold</span></td>
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
                        <tr>
                           <td>ax.email</td>
                           <td><a href="mailto:jane@e4u.com.au">jane@e4u.com.au</a></td>
                           <td><a href="mailto:jane.1999@gmail.com">julie.1999@gmail.com</a></td>
                           <td>11-06-2025</td>
                           <td>E60125</a></td>
                           <td>12 months</td>
                           <td><span class="badge badge-success">Active</span></td>
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
           <img src="{{ asset('assets/dashboard/img/edit-task.png')}}" alt="edit" class="custompopicon"> Edit Email Record
         </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
       </div>
       <div class="modal-body pb-0">
         <form id="editForm">
           <div class="row">
             <div class="col-12 mb-3">
               <label for="editEmail" class="label">Email Address</label>
               <input type="email" id="editEmail" class="form-control rounded-0" placeholder="Enter email">
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
            <img src="{{ asset('assets/dashboard/img/renew.png')}}" alt="alert" class="custompopicon"> Renew Email Record
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