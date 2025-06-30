@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   
   .table td{
        vertical-align: middle;        
        padding: 12px !important;
    }
    #myTable_length{
        float: left;
        padding: 10px 0px;
    }
    #myTable_filter{
        float:right;
        padding: 10px 0px;
    }
    #myTable_filter input[type='search']{
        width:280px !important;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div class="container-fluid pl-lg-4">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">My Legbox - Escort List</h1>
           <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
       </div>
   </div>        
   <div class="row">
       <div class="col-md-12 my-2">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                     <li>The My Legbox feature is a list only of your favourite Escorts. Please note, the
                        Notifications feature is enabled, according to your settings, by default. You can enable
                        or disable Notifications exclusively with an Escort. Go to Action.</li>
                     <li>Use the <a href="{{ route('user.list') }}" class="custom_links_design">Notebox</a> feature to record your experience with an Escort you have added to
                        My Legbox.</li>
                 </ol>
              </div>
           </div>
       </div>
   </div>
   
   <div class="row my-2">
       <!-- My Legbox -->
       <div class="col-md-12 mb-4">
           <div class="mb-2 d-flex align-items-center justify-content-end flex-wrap gap-10">           
               <div class="total_listing">
                   <div><span>Total Escorts Legbox: : </span></div>
                   <div><span>01</span></div>
               </div>
           </div>
           <div class="table-responsive">
               <table id="myTable" class="table table-bordered display" width="100%">
                   <thead class="bg-first">
                   <tr>
                       <th class="text-left">Escorts  ID</th>
                       <th class="text-left">Location</th>
                       <th class="text-left">State Name</th>
                       <th class="text-left">Gender</th>
                       <th class="text-left">Rating</th>
                       <th class="text-center">Notifications
                           Enabled</th>
                       <th class="text-center">Contact
                           Enabled</th>
                       <th class="text-center">Contact
                           Method</th>
                       <th class="text-center">Viewer
                           Communication</th>
                       <th class="text-center">Block Escort</th>
                      
                       <th class="text-center">Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr>
                       
                       <td class="text-center">E60587</td>
                       <td class="text-center">Western Australia</td>
                       <td class="text-center">Joanne </td>
                       <td class="text-center">F </td>
                       <td class="text-center">Good </td>
                       <td>Yes or No</td>
                       <td class="text-center">Yes</td>
                       <td class="text-center">Text</td>
                       <td class="text-center">0438 028 728</td>
                       <td class="text-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                          </div>
                      </div></td>
                       
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
                                        <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-phone-slash"></i> Disable Contact</a>
                                        <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="custom-tooltip-container">
                                        <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-bell-slash" aria-hidden="true"></i>
                                            Disable Notifications</a>
                                            <span class="tooltip-text">Viewer will not get notifications from this escort</span>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="custom-tooltip-container">
                                    <a class="dropdown-item align-item-custom" href="#" title="" data-toggle="modal" data-target="#rateEscortModal"> <i class="fa fa-star" aria-hidden="true"></i>
                                         Rate</a>
                                         <span class="tooltip-text">Rate this Escort</span>
                                    <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="custom-tooltip-container">    
                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#removeEscort"> <i class="fa fa-trash" aria-hidden="true"></i>
                                         Remove</a>
                                         <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                    <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="custom-tooltip-container">
                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#escortProfileMissingModal"> <i class="fa fa-eye" aria-hidden="true"></i>
                                         View</a>
                                         <span class="tooltip-text">View the Escort’s Profile</span>
                                    </div>
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
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

   <div class="modal" id="change_all" style="display: none">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded-0">
            <div class="modal-body text-center">
                  <h3 class="mb-4 mt-5"><span id="Lname">Are you sure want to remove?</span> </h3>
                  <input type="hidden" id="escortId" value="">
                  <button type="button" class="btn btn-success" id="save_change">OK</button>
                  
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cancel</button>
            </div>
         </div>
      </div>
   </div>


   {{-- Rate Escort Modal --}}
<div class="modal fade upload-modal" id="rateEscortModal" tabindex="-1" role="dialog" aria-labelledby="rateEscortLabel"
   aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         
         <div class="modal-header">
               <h5 class="modal-title">
                  <img src="{{ asset('assets/dashboard/img/rating.png')}}" style="width:45px; padding-right:10px;">
                  <span class="text-white">Rate this Escort</span>                        
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                     <img src="{{ asset('assets/app/img/newcross.png') }}"
                           class="img-fluid img_resize_in_smscreen">
                  </span>
               </button>
         </div>
         
         <div class="modal-body pb-0 agent-tour">
               <form method="post" action="#">
                  {{-- Rating Options --}}
                  <div class="row mb-3">
                     <div class="col-md-12">
                        <h4><strong>Select Rating</strong></h4>
                           <div class=" d-flex align-items-center justify-content-start flex-wrap gap-10">
                           

                              <div class="form-check">
                                 <input class="form-check-input" type="radio" name="escort_rating" id="rate_good" value="Good">
                                 <label class="form-check-label" for="rate_good">Good</label>
                              </div>

                              <div class="form-check">
                                 <input class="form-check-input" type="radio" name="escort_rating" id="rate_verygood" value="Very Good">
                                 <label class="form-check-label" for="rate_verygood">Very Good</label>
                              </div>

                              <div class="form-check">
                                 <input class="form-check-input" type="radio" name="escort_rating" id="rate_great" value="Great">
                                 <label class="form-check-label" for="rate_great">Great</label>
                              </div>

                           </div>
                           <hr>
                           <small class="text-muted">Select one of the above options to rate the escort.</small>
                     </div>
                  </div>

                  {{-- Save Button --}}
                  <div class="row">
                     <div class="col-md-12 mb-3">
                           <div class="form-group d-flex align-items-center justify-content-end">
                              <button type="submit" class="btn-success-modal " id="submitRatingBtn">
                                 Confirm
                              </button>
                           </div>
                     </div>
                  </div>
               </form>
         </div>
      
      </div>
   </div>
</div>
{{-- End Rate Modal --}}

{{-- Remove Escort Profile  Modal --}}
<div class="modal fade upload-modal" id="removeEscort" tabindex="-1" role="dialog" aria-labelledby="removeEscortLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/delete-user.png') }}" style="width:45px; padding-right:10px;">
                    <span class="text-white">Remove Escort</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                <div class="row">
                    <div class="col-md-12 my-3 text-center">
                        <p class="mb-0">Remove permanently from your Legbox</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 my-3">
                        <div class="form-group d-flex align-items-center justify-content-end gap-10">
                            <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn-success-modal">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
{{-- End Modal --}}

{{-- Escort Profile Not Found Modal --}}
<div class="modal fade upload-modal" id="escortProfileMissingModal" tabindex="-1" role="dialog" aria-labelledby="escortProfileMissingLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/not-allowed.png') }}" style="width:45px; padding-right:10px;">
                    <span class="text-white">Profile Not Found</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                <div class="row">
                    <div class="col-md-12 mb-3 text-center">
                        <p class="mb-0">This Escort does not presently have any Listed Profiles.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group d-flex align-items-center justify-content-end">                           
                            <button type="button" class="btn-success-modal " data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
{{-- End Modal --}}

@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#myTable').DataTable({
           responsive: true,
           language: {
               search: "<label>Search:</label> _INPUT_",
               searchPlaceholder: "Search by ID or Profile Name...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true
       });
   });
 </script>
   
@endpush