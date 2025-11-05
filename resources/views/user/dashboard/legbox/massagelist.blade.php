@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .table td {
   vertical-align: middle;
   padding: 12px !important;
   font-size: 14px !important;
   }
   .table th{
   font-size: 14px !important;
   }
   #escortCenterlegboxTable_length {
   float: left;
   }
   #escortCenterlegboxTable_filter {
   float: right;
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Massage Center Legbox</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>The My Legbox feature is a list only of your favourite Massage Centres. Please note,
                     Notifications do not apply to Massage Centres.
                  </li>
                  <li>Use the <a href="#" class="custom_links_design">Notebox</a> feature to record your experience with a Massage Centre you have
                     added to My Legbox.
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Page Heading -->
   <!-- My Escort Legbox -->
   <div class="row my-2">
      <div class="col-md-12 mb-4">
         <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-10">
            <h2 class="h2">Massage Center Legbox</h2>
            <div class="total_listing">
               <div><span>Total Massage Centre Legbox: </span></div>
               <div><span>1</span></div>
            </div>
         </div>
         <table id="massagelistTable" class="table table-bordered">
            <thead class="bg-first">
               <tr>
                  <th>Massage Centre ID</th>
                  <th>Location</th>
                  <th>Business Name</th>
                  <th>Gender</th>
                  <th>Open Now</th>
                  <th>Rating</th>
                  <th>Contact Enabled</th>
                  <th>Contact Method</th>
                  <th>Massage Centre Communication</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>MC001</td>
                  <td>Delhi</td>
                  <td>Urban Spa</td>
                  <td>Female</td>
                  <td>Yes</td>
                  <td>4.5</td>
                  <td>Yes</td>
                  <td>Phone</td>
                  <td>WhatsApp Only</td>
                  <td class="text-center">
                     <div class="dropdown no-arrow text-center">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                        </a>
                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink1">
                           <div class="custom-tooltip-container">
                              <a class="dropdown-item align-item-custom toggle-contact" href="#" title="Click to disable contact" data-toggle="modal" data-target="#massageProfileModal"> 
                              <i class="fa fa-phone-slash me-1"></i> 
                              <span>Disable Contact</span>
                              </a>
                              <span class="tooltip-text">Viewer can’t contact this escort again</span>
                              <div class="dropdown-divider"></div>
                           </div>
                           <div class="custom-tooltip-container">
                              <a class="dropdown-item align-item-custom toggle-notification" href="#" title="Click to disable notification" data-toggle="modal" data-target="#notificationProfileModal"> 
                              <i class="fa fa-bell-slash me-1"></i> 
                              <span>Disable Notifications</span>
                              </a>
                              <span class="tooltip-text">Viewer will not get notifications from this escort</span>
                              <div class="dropdown-divider"></div>
                           </div>
                           <div class="custom-tooltip-container">
                              <a class="dropdown-item align-item-custom escortRating" href="#" title="Rate" data-toggle="modal" data-target="#rateProfileModal"> 
                              <i class="fa fa-star"></i> 
                              Rate
                              </a>
                              <span class="tooltip-text">Rate this Escort</span>
                              <div class="dropdown-divider"></div>
                           </div>
                           <div class="custom-tooltip-container">
                              <a class="dropdown-item align-item-custom escortProfileRemove" href="#" data-toggle="modal" data-toggle="modal" data-target="#removeProfileModal"> 
                              <i class="fa fa-trash"></i> 
                              Remove
                              </a>
                              <span class="tooltip-text">Viewer can’t contact this escort again</span>
                              <div class="dropdown-divider"></div>
                           </div>
                           <div class="custom-tooltip-container">
                              <a class="dropdown-item align-item-custom escortProfileView" href="#" data-toggle="modal" data-target="#viewProfileModal"> 
                              <i class="fa fa-eye"></i> 
                              View
                              </a>
                              <span class="tooltip-text">View the Escort’s Profile</span>
                           </div>
                        </div>
                     </div>
                  </td>
               </tr>
               <!-- Add more static rows as needed -->
            </tbody>
         </table>
      </div>
   </div>
   {{-- escort list legbox --}}
</div>
{{-- disable contact --}}
<div class="modal upload-modal fade" id="massageProfileModal" tabindex="-1" role="dialog" aria-labelledby="massageProfileModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">
               <img src="{{asset("assets/dashboard/img/no-phone.png")}}" style="width:40px; padding-right:10px;" class="modal_title_img">
               <span class="text-white modal_title_span">Massage Contact</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-12 my-4  text-center">
                  <h5 class=" body_text mb-2">Massage contact is disabled successfully!</h5>
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
{{-- disable contact end --}}
{{-- disable notification --}}
<div class="modal upload-modal fade" id="notificationProfileModal" tabindex="-1" role="dialog" aria-labelledby="notificationProfileModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">
               <img src="{{asset("assets/dashboard/img/disable_notification.png")}}" style="width:40px; padding-right:10px;" class="modal_title_img">
               <span class="text-white modal_title_span">Massage Notification</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-12 my-4  text-center">
                  <h5 class=" body_text mb-2">Viewer notification is disabled successfully!</h5>
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
{{-- disable notification end --}}
{{-- Rate Modal --}}
<div class="modal upload-modal fade" id="rateProfileModal" tabindex="-1" role="dialog" aria-labelledby="rateProfileModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">
               <img src="{{asset("assets/dashboard/img/rating.png")}}" style="width:40px; padding-right:10px;" class="modal_title_img">
               <span class="text-white modal_title_span">Rate Josey</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#" id="ratingForm">
               <div class="row mb-3">
                  <div class="col-md-12">
                     <h4><strong>Select Rating</strong></h4>
                     <div class=" d-flex align-items-center justify-content-start flex-wrap gap-10">
                        <input type="hidden" name="escort_id" id="escort_rate_id" value="69">
                        <input type="hidden" name="type" id="rating_type" value="rate">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="escort_rating" id="rate_good" value="good" checked="">
                           <label class="form-check-label" for="rate_good">Good</label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="escort_rating" id="rate_verygood" value="verygood">
                           <label class="form-check-label" for="rate_verygood">Very Good</label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="escort_rating" id="rate_great" value="great">
                           <label class="form-check-label" for="rate_great">Great</label>
                        </div>
                     </div>
                     <hr>
                     <small class="text-muted">Select one of the above options to rate the escort.</small>
                  </div>
               </div>
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
{{-- Rate Modal End--}}
{{-- Remove Modal --}}
<div class="modal upload-modal fade" id="removeProfileModal" tabindex="-1" role="dialog" aria-labelledby="removeProfileModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">
               <img src="{{asset("assets/dashboard/img/delete-user.png")}}" style="width:40px; padding-right:10px;" class="modal_title_img">
               <span class="text-white modal_title_span">Remove Josey</span>
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
                  <h4 class="mb-0">Remove permanently from your Legbox</h4>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 my-3">
                  <div class="form-group d-flex align-items-center justify-content-end gap-10">
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                     <button type="button" class="btn-success-modal removeEscortButton">Remove</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- Remove Modal End--}}
{{-- view Modal--}}
<div class="modal upload-modal fade" id="viewProfileModal" tabindex="-1" role="dialog" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">
               <img src="{{asset("assets/dashboard/img/unblock.png")}}" style="width:40px; padding-right:10px;" class="modal_title_img">
               <span class="text-white modal_title_span">Massage Center Profile :</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-12 my-4  text-center">
                  <h5 class=" body_text mb-2">This Massage Center Profile does not presently have any Listed Profiles.</h5>
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
{{-- view Modal End--}}
{{-- End Modal --}}
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
{{-- massage center legbox --}}
<script>
   $('#massagelistTable').DataTable({
   
       "language": {
           "zeroRecords": "No record(s) found.",
           searchPlaceholder: "Search by ID or Profile Name...",
       },
       bLengthChange: true,
       processing: false,
       serverSide: true,
       order: [0, 'asc'],
       searchable: true,
       searching: true,
       bStateSave: false,
   
       ajax: {
           url: "#",
           data: function(d) {
               d.type = 'player';
           }
       },
       columns: [{
               data: 'key',
               name: 'key',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
           },
           {
               data: 'name',
               name: 'name',
               searchable: false,
               orderable: false,
               defaultContent: 'NA'
           },
           {
               data: 'city_name',
               name: 'city_name',
               searchable: false,
               orderable: false,
               defaultContent: 'NA'
           },
         
           {
               data: 'action',
               name: 'action',
               searchable: false,
               orderable: false,
               defaultContent: 'NA'
           },
       ],
       aoColumnDefs: [
   
       ]
   });
   
   $('body').on('click', '.delete-center', function(e) {
       e.preventDefault();
       var id = $(this).data('id');
   
       var url = "{{ route('user.console.delete.legbox', ':id') }}";
       url = url.replace(':id', id);
       console.log("hiii" + id);
       $('#change_all').modal('show');
       var eid = $('#escortId').val(id);
       $('#save_change').click(function() {
           $.ajax({
               url: url,
               method: "GET",
               data: {
                   _token: '{{ csrf_token() }}',
                   id: id
               },
               success: function(response) {
                   window.location.reload();
               }
           });
       })
      
   })
</script>
@endpush