@extends('layouts.userDashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .table td {
            vertical-align: middle;
            padding: 12px !important;
            font-size: 13px !important;
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
        .escortCenterlegboxTableClass.dataTable thead>tr>th.sorting {
            padding-right: 27px !important;
        }
        td:has(.escortDropMenuPopup.show) {
            z-index: 9 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper justify-content-between">
               <div class="d-flex align-items-center">
                <h1 class="h1">My Legbox</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
                
                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
            </div>
        </div>

        @php
            $escortDisplayType = 'block';
            $massageDisplayType = 'block';

            if($dashboardType == 'escort'){
                $escortDisplayType = 'block';
                $massageDisplayType = 'none';
            }
            
            if ($dashboardType == 'massage') {
                $escortDisplayType = 'none';
                $massageDisplayType = 'block';
            }
        @endphp

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>

                        <ol>
                            @if($escortDisplayType == 'block')
                                <li>The My Legbox feature is a list only of your favourite Escorts. Please note, the Notifications feature is enabled, according to your settings, by default. You can enable or disable Notifications exclusively with an Escort. Go to ‘Action’.</li>
                                <li>Use the <a href="{{ route('user.new') }}" class="custom_links_design">Notebox</a> feature to
                                record your experience with an Escort you have added to My Legbox.</li>
                            
                                
                            @else
                                <li>The My Legbox feature is a list only of your favourite Massage Centres. Please note Notifications do not apply to Massage Centres.</li>
                                <li>Use the <a href="{{ route('user.new') }}" class="custom_links_design">Notebox</a> feature to
                                record your experience with a Massage Centre you have added to My Legbox.</li>
                                
                            @endif
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->

        <!-- My Escort Legbox -->
        <div class="row my-2" style="display: {{ $escortDisplayType }}">
            <div class="col-md-12 mb-4">
                <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-10">
                    <h2 class="h2">Escort Legbox</h2>
                    <div class="total_listing">
                        <div><span>Total Escort Legbox : </span></div>
                        <div><span id="totalEscortList">{{count($escorts)}}</span></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="escortCenterlegboxTable" class="table table-bordered display escortCenterlegboxTableClass" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th class="text-left" style="background-color: #0c223d;">Escorts ID</th>
                                <th class="text-left">Location</th>
                                <th class="text-left">Stage Name</th>
                                <th class="text-left">Gender</th>
                                <th class="text-left">Rating</th>
                                <th class="text-center">Notifications
                                    Enabled</th>
                                <th class="text-center">Contact
                                    Enabled</th>
                                <th class="text-center">Contact
                                    Method</th>
                                <th class="text-center">Escort <br>
                                    Communication</th>
                                <th class="text-center" style="background-color: #0c223d;">Block Escort</th>

                                <th class="text-center" style="background-color: #0c223d;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- escort list legbox --}}

        <!-- My massage Legbox -->
    <div class="row my-2" style="display: {{ $massageDisplayType }}">
      <div class="col-md-12 mb-4">
         <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-10">
            <h2 class="h2">Massage Center Legbox</h2>
            <div class="total_listing">
               <div><span>Total Massage Centre Legbox: </span></div>
               <div><span id="totalMassageList">1</span></div>
            </div>
         </div>
         <table id="massagelistTable" class="table table-bordered">
            <thead class="bg-first">
               <tr>
                  <th>Massage Centre ID</th>
                  <th>Location</th>
                  <th>Business Name</th>
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
                  <td>Yes</td>
                  <td>4.5</td>
                  <td>Yes</td>
                  <td>Phone</td>
                  <td>WhatsApp Only</td>
                  <td class="text-center">
                     <div class="dropdown no-arrow">
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
        {{-- end massage list --}}
    </div>




    <div class="modal" id="change_all" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body text-center">
                    <h3 class="mb-4 mt-5"><span id="Lname"><img src="{{ asset('assets/app/img/alert.png') }}" class="img-fluid">Are you sure want to remove?</span> </h3>
                    <input type="hidden" id="escortId" value="">
                    <button type="button" class="btn btn-success" id="save_change">OK</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Rate Escort Modal --}}
    <div class="modal fade upload-modal" id="rateEscortModal" tabindex="-1" role="dialog"
        aria-labelledby="rateEscortLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/rating.png') }}" style="width:45px; padding-right:10px;">
                        <span class="text-white rateTitle">Rate this Escort</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#" id="ratingForm">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                    <label class="label">Select Rating</label>
                                    <div class=" d-flex align-items-center justify-content-start flex-wrap gap-10">

                                        <input type="hidden" name="escort_id" id="escort_rate_id">
                                        <input type="hidden" name="type" id="rating_type">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="escort_rating"
                                                id="rate_good" value="good" checked>
                                            <label class="form-check-label" for="rate_good">Good</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="escort_rating"
                                                id="rate_verygood" value="verygood">
                                            <label class="form-check-label" for="rate_verygood">Very Good</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="escort_rating"
                                                id="rate_great" value="great">
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

    {{-- Start Massage center rate Modal --}}
    <div class="modal fade upload-modal" id="rateMassageModal" tabindex="-1" role="dialog"
        aria-labelledby="rateEscortLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/rating.png') }}" style="width:45px; padding-right:10px;">
                        <span class="text-white massageRateTitle">Rate this Massage Center</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#" id="massageCenterRatingForm">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                    <label class="label">Select Rating</label>
                                    <div class=" d-flex align-items-center justify-content-start flex-wrap gap-10">
 
                                        <input type="hidden" name="massage_id" id="massage_rate_id">
                                        <input type="hidden" name="type" id="massage_rating_type">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="massage_rating"
                                                id="massage_rate_good" value="good" checked>
                                            <label class="form-check-label" for="massage_rate_good">Good</label>
                                        </div>
 
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="massage_rating"
                                                id="massage_rate_verygood" value="verygood">
                                            <label class="form-check-label" for="massage_rate_verygood">Very Good</label>
                                        </div>
 
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="massage_rating"
                                                id="massage_rate_great" value="great">
                                            <label class="form-check-label" for="massage_rate_great">Great</label>
                                        </div>
 
                                    </div>
                                    <hr>
                                    <small class="text-muted">Select one of the above options to rate the massage center.</small>
                            </div>
                        </div>
 
                        {{-- Save Button --}}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn-success-modal " id="submitMassageRatingBtn">
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
    {{-- End Massage center rate Modal --}}

    {{-- Remove Escort Profile  Modal --}}
    <div class="modal fade upload-modal" id="removeEscort" tabindex="-1" role="dialog"
        aria-labelledby="removeEscortLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/delete-user.png') }}"
                            style="width:45px; padding-right:10px;">
                        <span class="text-white removeEscortTitle">Remove Escort</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
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
                            <div class="form-group d-flex align-items-center justify-content-center gap-10">
                                <input type="hidden" id="removeEscortId" value="">
                                <input type="hidden" id="removeEscortName" value="">
                                <div class="d-flex align-items-center justify-content-center gap-10 ">
                                    
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn-success-modal removeEscortButton">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}

    {{-- Remove Massage Profile  Modal --}}
    <div class="modal fade upload-modal" id="removeMassage" tabindex="-1" role="dialog"
        aria-labelledby="removeMassageLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/delete-user.png') }}"
                            style="width:45px; padding-right:10px;">
                        <span class="text-white removeMassageTitle">Remove Massage Center</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
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
                            <div class="form-group d-flex align-items-center justify-content-center gap-10">
                                <input type="hidden" id="removeMassageId" value="">
                                <input type="hidden" id="removeMassageName" value="">
                                 <div class="d-flex align-items-center justify-content-center gap-10 ">
                                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn-success-modal removeMassageButton">Remove</button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}

    {{-- Escort Profile Not Found Modal --}}
    {{-- <div class="modal fade upload-modal" id="escortProfileMissingModal" tabindex="-1" role="dialog"
        aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/not-allowed.png') }}"
                            style="width:45px; padding-right:10px;">
                        <span class="text-white">Profile Not Found</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
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
    </div> --}}



    <div class="modal fade upload-modal bd-example-modal-lg" id="escortProfileMissingModal" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content basic-modal modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailReport">
                        <img src="{{ asset('assets/dashboard/img/view.png') }}" style="width:40px; margin-right:10px;" alt="Request Rejected">
                        <span class="iframeEscortTitle">Escort Profile</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body" id="escortPopupModalBody">
                    <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
    {{-- Escort operation Profile Success Modal --}}
    <div class="modal fade upload-modal" id="escortProfileModal" tabindex="-1" role="dialog"
        aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        {{-- <img src="{{ asset('assets/dashboard/img/not-allowed.png') }}"
                            style="width:45px; padding-right:10px;"> --}}
                            <img src="{{ asset('assets/dashboard/img/unblock.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">
                        <span class="text-white modal_title_span">Contact</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 agent-tour">
                    <div class="row">
                        <div class="col-md-12 my-4  text-center">
                            <h4 class=" body_text mb-2">This Escort does not presently have any Listed Profiles.</h4>
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
    {{-- End Modal --}}
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    {{-- massage center legbox --}}
    <script>

        $(document).ready(function() {
            var escortTable = $('#escortCenterlegboxTable').DataTable({
                responsive: false,
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID or Stage Name...",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                paging: true,
                searchable: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('user.my-legbox-escort-list') }}",
                    dataSrc: function(json) {
                            // json is the response from server
                            console.log(json, 'response data');
                            $("#totalEscortList").text(json.recordsTotal);
                            return json.data; // MUST return the data array for DataTables
                        },
                    data: function(data) {
                    }
                },
                columns: [
                    { data: 'escort_id', name: 'escort_id' },                         // 0
                    { data: 'location', name: 'location' },                        // 2
                    { data: 'name', name: 'name' },                        // 2
                    { data: 'gender', name: 'gender' },                               // 3
                    { data: 'rating_label', name: 'rating_label' },                   // 4
                    { data: 'is_notification_enabled', name: 'is_notification_enabled' }, // 5
                    { data: 'is_enabled_contact', name: 'is_enabled_contact' },       // 6
                    { data: 'contact_method', name: 'contact_method' },               // 7
                    {
                        data: 'escort_communication',
                        name: 'escort_communication',
                        orderable: false,
                        render: function (data, type, row) {
                            if (!data) return '';
                            let str = String(data); 
                            // Har 12 characters ke baad line break
                            return str.replace(/(.{12})/g, '$1<br>');
                        }
                    },
                    { data: 'is_blocked', name: 'is_blocked',orderable: false, searchable: false },                       // 9
                    { data: 'action', name: 'action', orderable: false, searchable: false } // 10
                ],
                columnDefs: [
                    {
                        targets: 8,            // column index (e.g., 'id' column)
                        width: "15%",          // set width here
                    }
                ]
            });

            $(document).on('click', '.escortRating', function(e) {
                e.preventDefault();
                console.log('dfdgvf');
                // data-target="#rateEscortModal"
                
                let escortId = $(this).attr('data-id');
                let rate = $(this).attr('data-rate');
                let stagename = $(this).attr('data-escort-name');
                let isBlocked = $(this).is(':checked') ? 1 : 0;
                let data = {
                    'escort_id' : escortId,
                    'is_blocked' : isBlocked,
                    'type' : 'rate',
                    'rating' : rate,
                    'message' : 'Escort rating is updated successfully!',
                }

                let url = '{{ route("viewer.escort-interaction.update") }}';

                $("#ratingForm").attr('action',url);
                $("#escort_rate_id").val(escortId);
                $("#rating_type").val('rate');
                $(".rateTitle").text('Rate '+strTitle(stagename));

                switch (rate) {
                    case 'great':
                        $('#rate_great').prop('checked', true)
                        break;
                    case 'verygood':
                        $('#rate_verygood').prop('checked', true)
                        break;
                
                    default:
                        $('#rate_good').prop('checked', true)
                        break;
                }

                $('#rateEscortModal').modal('show');
                
            });

            $(document).on('click', '.escortProfileView', function(e) {
                e.preventDefault();
                
                let escortId = $(this).attr('data-id');
                let escortProfileIsEnabled = $(this).attr('data-profile-enable');
                let profileurl = "{{route('profile.description','_id')}}";
                profileurl = profileurl.replace('_id',escortId);

                console.log(escortProfileIsEnabled, ' jite');

                if(escortProfileIsEnabled == '0'){
                    let htmlData = '<div class="col-md-12 my-4  text-center"><h5 class=" body_text mb-2">This Escort does not presently have any Listed Profiles.</h5></div>';

                    $(".modal_title_span").text('Escort Profile : ');
                    $("#escortProfileModal").modal('show')
                }else{
                    let htmlData = '<iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>';
                    $(".iframeEscortTitle").text('Escort Profile');
                    $("#escortPopupModalBody").html(htmlData);
                    $("#escortPopupModalBodyIframe").attr('src', profileurl);

                    setTimeout(() => {
                        $("#escortProfileMissingModal").modal('show')
                    }, 300);  
                }

                
                
            });

            $(document).on('click', '.escortProfileRemove', function(e) {
                e.preventDefault();
                
                let escortId = $(this).attr('data-id');
                let stagename = $(this).attr('data-escort-name');
                // let data = {
                //     'escort_id' : escortId,
                //     'type' : 'remove',
                //     'message' : 'Escort '+stagename+' is removed successfully!',
                // }

                $(".removeEscortTitle").text('Remove '+stagename)
                $("#removeEscortId").val(escortId);
                $("#removeEscortName").val(stagename);
                $("#removeEscort").modal('show')
                //return  ajaxCall(url, data, $(this));
                
            });

            $(document).on('click', '.removeEscortButton', function(e) {
                e.preventDefault();
                
                let escortId = $("#removeEscortId").val();
                let stagename = $("#removeEscortName").val();
                let data = {
                    'escort_id' : escortId,
                    'type' : 'remove',
                    'message' : stagename+' removed from your legbox successfully!',
                }

                let url = '{{ route("viewer.escort-remove") }}';
                return  ajaxCall(url, data, $(this));
                
            });

            function strTitle(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return txt.charAt(0).toUpperCase() + txt.substring(1).toLowerCase();
                });
            }

            $('#ratingForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
                // Get form data
                var formData = $(this).serialize();
                let url = '{{ route("viewer.escort-interaction.update") }}';

                return  ajaxCall(url, formData, $(this));
            });

            $(document).on('change', '.isBlockedButton', function() {
                let escortId = $(this).attr('id').replace('customSwitch', '');
                let isBlocked = $(this).is(':checked') ? 1 : 0;
                let data = {
                    'escort_id' : escortId,
                    'is_blocked' : isBlocked,
                    'type' : 'block',
                    'message' : 'Escort is '+(isBlocked ? 'Blocked' : 'UnBlocked')+' successfully!',
                }

                if(isBlocked){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/block.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/unblock.png")}}');
                }

                let url = '{{ route("viewer.escort-interaction.update") }}';
                return  ajaxCall(url, data, $(this));
                
            });

            $(document).on('click', '.toggle-contact', function (e) {
                e.preventDefault();
                const $this = $(this);
                const escortId = $this.data('id');
                const currentStatus = $this.data('status'); // disable or enable
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("viewer.escort-interaction.update") }}';

                let data = {
                    'escort_id' : escortId,
                    'current_status' : currentStatus,
                    'viewer_disabled_contact' : newStatus,
                    'type' : 'contact',
                    'message' : 'Escort contact is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/no-phone.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/phone.png")}}');
                }

                return  ajaxCall(url, data, $this);
            });

            $(document).on('click', '.toggle-notification', function (e) {
                e.preventDefault();
                const $this = $(this);
                const escortId = $this.data('id');
                const currentStatus = $this.data('status');
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("viewer.escort-interaction.update") }}';

                let data = {
                    'escort_id' : escortId,
                    'current_status' : currentStatus,
                    'viewer_disabled_notification' : newStatus,
                    'type' : 'notification',
                    'message' : 'Viewer notification is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/disable_notification.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/enable_notification.png")}}');
                }

                return  ajaxCall(url, data, $this);
            });

            function ajaxCall(actionUrl,rowData,thisObj)
            {
                rowData.token = '{{ csrf_token() }}';
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: rowData,
                    success: function(response) {
                        
                        console.log('response');
                        console.log(response);
                        
                        $('#escortProfileModal').modal('show');
                        $('#escortCenterlegboxTable').DataTable().ajax.reload(null, false);
                        if(response.type == 'block'){
                            $(".modal_title_span").text('Escort Block');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'contact'){
                            $(".modal_title_span").text('Escort Contact');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'notification'){
                            $(".modal_title_span").text('Escort Notification');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'rate'){
                            $('#rateEscortModal').modal('hide');
                            $(".modal_title_span").text('Escort Rating');
                            let message = 'Rating successfully added for this escort';
                            $(".body_text").text(message);
                        }

                        if(response.type == 'remove'){
                            $("#removeEscort").modal('hide');
                            $(".modal_title_span").text('Escort Removed');
                            $(".body_text").text(response.message);
                        }

                        
                    },
                    error: function(err) {
                        //showGlobalAlert("Something went wrong.", "danger");
                    }
                });
            }

            // massage center code start from here 

            $('#massagelistTable').DataTable({
                responsive: false,
                    language: {
                        search: "Search: _INPUT_",
                        searchPlaceholder: "Search by ID or Business Name...",
                        lengthMenu: "Show _MENU_ entries",
                        zeroRecords: "No matching records found",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        infoFiltered: "(filtered from _MAX_ total entries)"
                    },
                    paging: true,
                    searchable: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('user.my-legbox-massage-list') }}",
                        dataSrc: function(json) {
                            // json is the response from server
                            console.log(json, 'response data');
                            $("#totalMassageList").text(json.recordsTotal);
                            return json.data; // MUST return the data array for DataTables
                        },
                        data: function(data) {
                            //
                        }
                    },
                    columns: [
                        { data: 'massage_id', name: 'massage_id' },                         // 0
                        { data: 'location', name: 'location' },                        // 2
                        { data: 'business_name', name: 'business_name' },                        // 2
                        { data: 'open_now', name: 'open_now' },                               // 3
                        { data: 'rating_label', name: 'rating_label' },
                        { data: 'is_enabled_contact', name: 'is_enabled_contact' },       // 6
                        { data: 'contact_method', name: 'contact_method' },               // 7
                        { data: 'massage_communication', name: 'massage_communication' },                    // 9
                        { data: 'action', name: 'action', orderable: false, searchable: false } // 10
                    ]
            });

            $(document).on('click', '.toggle-massage-contact', function (e) {
                e.preventDefault();
                const $this = $(this);
                const massageId = $this.data('id');
                const currentStatus = $this.data('status'); // disable or enable
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("viewer.massage-interaction.update") }}';

                let data = {
                    'massage_id' : massageId,
                    'current_status' : currentStatus,
                    'viewer_disabled_contact' : newStatus,
                    'type' : 'contact',
                    'message' : 'Massage contact is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/no-phone.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/phone.png")}}');
                }

                return  massageAjaxCallback(url, data, $this);
            });

            $(document).on('click', '.toggle-massage-notification', function (e) {
                e.preventDefault();
                const $this = $(this);
                const massageId = $this.data('id');
                const currentStatus = $this.data('status');
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("viewer.massage-interaction.update") }}';

                let data = {
                    'massage_id' : massageId,
                    'current_status' : currentStatus,
                    'viewer_disabled_notification' : newStatus,
                    'type' : 'notification',
                    'message' : 'Massage notification is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/disable_notification.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/enable_notification.png")}}');
                }

                return  massageAjaxCallback(url, data, $this);
            });

            $(document).on('click', '.massageProfileView', function(e) {
                e.preventDefault();
                
                let massageId = $(this).attr('data-id');
                let massageProfileIsEnabled = $(this).attr('data-profile-enable');
                let profileurl = "{{route('center.profile.description','_id')}}";
                profileurl = profileurl.replace('_id',massageId);

                if(massageProfileIsEnabled == '0'){
                    let htmlData = '<div class="col-md-12 my-4  text-center"><h5 class=" body_text mb-2">This Massage Centre does not presently have a Listed Profile.</h5></div>';

                    $(".modal_title_span").text('Massage Centre : ');
                    
                    $("#escortProfileModal").modal('show')
                }else{
                    let htmlData = '<iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>';
                    $(".iframeEscortTitle").text('Massage Centre');
                    $("#escortPopupModalBody").html(htmlData);
                    $("#escortPopupModalBodyIframe").attr('src', profileurl);

                    setTimeout(() => {
                        $("#escortProfileMissingModal").modal('show')
                    }, 300);  
                }

                
                
            });

            $('#massageCenterRatingForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
                // Get form data
                var formData = $(this).serialize();
                let url = '{{ route("viewer.massage-interaction.update") }}';

                return  massageAjaxCallback(url, formData, $(this));
            });

            $(document).on('click', '.massageRating', function(e) {
                e.preventDefault();
                console.log('dfdgvf');
                // data-target="#rateEscortModal"
                
                let massageId = $(this).attr('data-id');
                let rate = $(this).attr('data-rate');
                let massageName = $(this).attr('data-massage-name');
                //let isBlocked = $(this).is(':checked') ? 1 : 0;
                let data = {
                    'massage_id' : massageId,
                    'is_blocked' : 0,
                    'type' : 'rate',
                    'rating' : rate,
                    'message' : 'Massage rating is updated successfully!',
                }

                let url = '{{ route("viewer.massage-interaction.update") }}';

                $("#massageCenterRatingForm").attr('action',url);
                $("#massage_rate_id").val(massageId);
                $("#massage_rating_type").val('rate');
                $(".massageRateTitle").text('Rate '+strTitle(massageName));

                switch (rate) {
                    case 'great':
                        $('#rate_great').prop('checked', true)
                        break;
                    case 'verygood':
                        $('#rate_verygood').prop('checked', true)
                        break;
                
                    default:
                        $('#rate_good').prop('checked', true)
                        break;
                }

                $('#rateMassageModal').modal('show');
                // $('#rateEscortModal').modal('show');
                
            });

            $(document).on('click', '.massageProfileRemove', function(e) {
                e.preventDefault();
                
                let massageId = $(this).attr('data-id');
                let stagename = $(this).attr('data-massage-name');
                // let data = {
                //     'escort_id' : escortId,
                //     'type' : 'remove',
                //     'message' : 'Escort '+stagename+' is removed successfully!',
                // }

                $(".removeMassageTitle").text('Remove '+stagename)
                $("#removeMassageId").val(massageId);
                $("#removeMassageName").val(stagename);
                $("#removeMassage").modal('show')
                //return  ajaxCall(url, data, $(this));
                
            });

            $(document).on('click', '.removeMassageButton', function(e) {
                e.preventDefault();
                
                let massageId = $("#removeMassageId").val();
                let stagename = $("#removeMassageName").val();
                let data = {
                    'massage_id' : massageId,
                    'type' : 'remove',
                    'message' : stagename+' removed from your legbox successfully!',
                }

                let url = '{{ route("viewer.massage-remove") }}';
                return  massageAjaxCallback(url, data, $(this));
                
            });

            function massageAjaxCallback(actionUrl,rowData,thisObj) 
            {
                rowData.token = '{{ csrf_token() }}';
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: rowData,
                    success: function(response) {
                        
                        console.log('response jiten');
                        console.log(response);
                        // i am using same modal for massage just change the text, title, message here
                        $('#escortProfileModal').modal('show');
                        $('#massagelistTable').DataTable().ajax.reload(null, false);
                        if(response.type == 'block'){
                            $(".modal_title_span").text('Massage Center Block');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'contact'){
                            $(".modal_title_span").text('Massage Center Contact');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'notification'){
                            $(".modal_title_span").text('Massage Center Notification');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'rate'){
                            $('#rateMassageModal').modal('hide');
                            $(".modal_title_span").text('Massage Center Rating');
                            let message = 'Rating successfully added for this Massage Center';
                            $(".body_text").text(message);
                        }

                        if(response.type == 'remove'){
                            $("#removeMassage").modal('hide');
                            $(".modal_title_span").text('Massage Center Removed');
                            $(".body_text").text(response.message);
                        }

                        
                    },
                    error: function(err) {
                        //showGlobalAlert("Something went wrong.", "danger");
                    }
                });    
            }
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
            // if(confirm("Are you sure want to remove?")) {
            //    
            // }
        })
    </script>
@endpush
