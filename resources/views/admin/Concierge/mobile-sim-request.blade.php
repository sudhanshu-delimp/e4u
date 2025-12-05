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
@php
   $securityLevel = isset(auth()->user()->staff_detail->security_level) ? auth()->user()->staff_detail->security_level: 0;
   $editAccess = staffPageAccessPermission($securityLevel, 'edit');
   $editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
@endphp
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">SIM Requests </h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                   <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b> </h3>
                       <ol>
                        <li>A SIM request is to be actioned within 24 hours of receipt.</li>
                        <li>An email requesting the SIM has also been sent to <a href="mailto:admin@e4u.com.au" class="custom_links_design">admin@e4u.com.au</a>.</li>
                        <li>Ensure the SIM details are entered up in the SIM Register.</li>
                      </ol>
                   </div>
               </div>
           </div>
         </div>
         <div class="row mb-3">
           <div class="col-md-12">
               <div class="table-responsive custom-badge">
                  <table class="table table-bordered" id="MobileRequestTable">
                     <thead class="table-bg">
                        <tr>
                           <th>Ref</th>
                           <th>Member ID</th>
                           <th>Member</th>
                           <th>Order Date</th>
                           <th>Delivery Address</th>
                           <th>Order Number</th>
                           <th>Status</th>
                           <th class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <tr>
                           <td>123</td>
                           <td>E40161</td>
                           <td>Julie</td>
                           <td>04-05-2025</td>
                           <td>Level 2, 310 Main Street, Brisbane</td>
                           <td>E40161 04052025 04 003</td>
                           <td><span class="badge badge-warning">Pending</span></td>
                           <td class="text-center"> 
                               @if($editAccessEnabled)
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-hourglass-half "></i> Pending</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-pause-circle "></i> On Hold</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#active_req"> <i class="fa fa-check-circle "></i> Completed</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#reject_popup"> <i class="fa fa-fw fa-ban"></i> Rejected </a>
                                 </div>
                              </div>
                              @endif
                           </td>
                        </tr>
                        <tr>
                           <td>124</td>
                           <td>E50167</td>
                           <td>Mary</td>
                           <td>03-05-2025</td>
                           <td>Level 2, 310 Main Street, Adelaide</td>
                           <td>E50167 03052025 05 002</td>
                           <td><span class="badge badge-secondary">On Hold</span></td>
                           <td class="text-center"> 
                               @if($editAccessEnabled)
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-hourglass-half "></i> Pending</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-pause-circle "></i> On Hold</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#active_req"> <i class="fa fa-check-circle "></i> Completed</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#reject_popup"> <i class="fa fa-fw fa-ban"></i> Rejected </a>
                                 </div>
                              </div>
                              @endif
                           </td>
                        </tr>
                        <tr>
                           <td>125</td>
                           <td>E60112</td>
                           <td>Jane</td>
                           <td>02-05-2025</td>
                           <td>Level 2, 310 Main Street, Perth</td>
                           <td>E60112 02052025 06 001</td>
                           <td><span class="badge badge-success">Completed</span></td>
                           <td class="text-center"> 
                               @if($editAccessEnabled)
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-hourglass-half "></i> Pending</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-pause-circle "></i> On Hold</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#active_req"> <i class="fa fa-check-circle "></i> Completed</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#reject_popup"> <i class="fa fa-fw fa-ban"></i> Rejected </a>
                                 </div>
                              </div>
                              @endif
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
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>


<div class="modal fade upload-modal" id="active_req" tabindex="-1" aria-labelledby="active_reqLabel" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="active_req"><img src="{{ asset('assets/dashboard/img/order-tracking.png')}}" alt="alert" class="custompopicon"> Tracking Details
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <form>
               <div class="row">
                  
                  <div class="col-12 mb-3">
                     <label for="Traking ID" class="label">Traking ID</label>
                     <input type="text" class="form-control rounded-0" placeholder="Enter traking id ">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pb-4 mb-2">
            <button type="submit" class="btn-success-modal">save</button>
         </div>
      </div>
   </div>
</div>
{{-- end --}}
{{-- confirm_popup --}}
<div class="modal fade upload-modal" id=" " tabindex="-1" aria-labelledby="confirm_popupLabel" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content custome_modal_max_width">
   <div class="modal-header">
      <h5 class="modal-title" id="confirm_popup"><img src="{{ asset('assets/dashboard/img/unblock.png')}}" alt="alert" class="custompopicon"> Confirmation
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
            <button type="button" class="btn-success-modal" data-dismiss="modal">Yes</button>
            <button type="button" class="btn-cancel-modal" data-dismiss="modal">No</button>
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
@endsection


@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#MobileRequestTable").DataTable({
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