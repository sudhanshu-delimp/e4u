@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
        .brb_icon {
            color: white;
            background-color: #e5365a;
            border-radius: 15%;
            padding: 0 5px;
        }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">My Legbox - Escort List</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
       <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                     <li>The My Legbox feature is a list only of your favourite Escorts. Please note, the
                        Notifications feature is enabled, according to your settings, by default. You can enable
                        or disable Notifications exclusively with an Escort. Go to Action.</li>
                     <li>Use the <a href="{{ route('user.new') }}" class="custom_links_design">Notebox</a> feature to record your experience with an Escort you have added to
                        My Legbox.</li>
                 </ol>
              </div>
           </div>
       </div>
   </div>
   
   <div class="row">
       <!-- My Legbox -->
       <div class="col-md-12 mb-4">
           <div class="mb-3 d-flex align-items-center justify-content-end flex-wrap gap-10">           
               <div class="total_listing">
                   <div><span>Total Escorts Legbox: : </span></div>
                   <div><span>{{count($escorts)}}</span></div>
               </div>
           </div>
           <div class="table-responsive">
               <table id="escortCenterListTable" class="table table-bordered display" width="100%">
                   <thead class="bg-first">
                   <tr>
                       <th class="text-left">Escorts  ID</th>
                       <th class="text-left" >Profile Name</th>
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

                        @foreach ($escorts as $escort)
                            <tr>
                                @php
                                    $suspendedBadge = isset($escort->suspendProfile[0]->created_at);

                                    $escortLikes = isset($escort->likes[0]->id);
                                    $percentage = 0;

                                    if ($escortLikes) {
                                        $dislikeCount = 0;
                                        $totalLikes = count($escort->likes);

                                        foreach ($escort->likes as $like) {
                                            if ($like->like == 0) {
                                                $dislikeCount++;
                                            }
                                        }

                                        $likeCount = $totalLikes - $dislikeCount;

                                        // Calculate percentage of likes
                                        if ($totalLikes > 0) {
                                            $percentage = round(($likeCount / $totalLikes) * 100, 2);
                                        }
                                    }
                                @endphp
                                <td class="text-center">{{$escort->id}}</td>
                                <td class="text-center">
                                    <span>{{isset($escort->name) ? Str::title($escort->name) : '-'}}</span> 
                                    
                                     @if($suspendedBadge)
                                        <sup 
                                            title="Suspended on {{ \Carbon\Carbon::parse($escort->suspendProfile[0]->created_at, getEscortTimezone($escort))->format('d-m-Y h:i A') }}" 
                                            class="brb_icon" 
                                            style="background-color: #d2730a;">
                                            SUS
                                        </sup>
                                    @endif
                                    
                                </td>
                                <td class="text-center">{{isset($escort->city->name) ? $escort->city->name : '-'}}</td>
                                <td class="text-center">{{isset($escort->state->name) ? $escort->state->name : '-'}} </td>
                                <td class="text-center">{{$escort->gender}}</td>
                                <td class="text-center">{{ getRatingLabel($percentage) }}</td>
                                <td>Yes or No</td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">
                                    @php
                                        $defaultContact = 'Text';
                                        $escortCommunication = '';
                                        $contactEnabled = "No";
                                        $contactType = isset($escort->user->contact_type) ? $escort->user->contact_type : [];
                                    @endphp
                                    @if(in_array(3,$contactType))
                                        <span>Email</span><br>
                                        @php 
                                            $escortCommunication = $escortCommunication.'<span>'.$escort->user->email.'</span><br>';
                                            $contactEnabled = "Yes";
                                        @endphp
                                    @endif
                                    @if(in_array(4,$contactType))
                                        <span>Call</span><br>
                                        @php 
                                            $escortCommunication = $escortCommunication.'<span>'.$escort->phone.'</span><br>';
                                            $contactEnabled = "Yes";
                                        @endphp
                                    @endif
                                    @if(in_array(2,$contactType))
                                        <span>Text</span><br>
                                        @php 
                                            $escortCommunication = $escortCommunication.'<span>-</span><br>';
                                            $contactEnabled = "Yes";
                                        @endphp
                                    @endif
                                    @if(!(in_array(2,$contactType) || in_array(3,$contactType) || in_array(4,$contactType)))
                                        <span>Text</span><br>
                                        @php 
                                            $escortCommunication = $escortCommunication.'<span>-</span><br>';
                                        @endphp
                                    @endif


                                </td>
                                <td class="text-center">{!!Str::lower($escortCommunication)!!}</td>
                                <td class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                        </div>
                                    </td>
                                
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
                        @endforeach
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
       $('#escortCenterListTable').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by ID or Profile Name...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true,
       });
   });
 </script>
   
@endpush