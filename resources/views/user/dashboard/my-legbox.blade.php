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

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>

                        <ol>
                            <li>The My Legbox feature is a list only for your favourite Escorts and Massage Centres.  Please
                                note that Notifications only applies to Escorts.</li>
                            <li>Use the <a href="{{ route('user.new') }}" class="custom_links_design">Notebox</a> feature to
                                record your experience with an Escort or Massage Centre you have added to My Legbox.</li>
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
                    <h2 class="h2">Escort Center Legbox</h2>
                    <div class="total_listing">
                        <div><span>Total Escort Center Legbox : </span></div>
                        <div><span>{{count($escorts)}}</span></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="escortCenterlegboxTable" class="table table-bordered display" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th class="text-left">Escorts ID</th>
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
                                <th class="text-center">Block Escort</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($escorts as $escort)
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
                                    <td class="text-center">{{$escort->id}} 
                                        @if($suspendedBadge)
                                            <sup 
                                                title="Suspended on {{ \Carbon\Carbon::parse($escort->suspendProfile[0]->created_at, getEscortTimezone($escort))->format('d-m-Y h:i A') }}" 
                                                class="brb_icon" 
                                                style="background-color: #d2730a;">
                                                SUS
                                            </sup>
                                        @endif
                                    </td>
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
                                    <td class="text-center">{{Str::substr($escort->gender, 0, 1)}}</td>
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
                            @endforeach --}}
                            {{-- <tr>

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
                                </td>

                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"> <i
                                                        class="fa fa-phone-slash"></i> Disable Contact</a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"> <i
                                                        class="fa fa-bell-slash" aria-hidden="true"></i>
                                                    Disable Notifications</a>
                                                <span class="tooltip-text">Viewer will not get notifications from this
                                                    escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#" title=""
                                                    data-toggle="modal" data-target="#rateEscortModal"> <i
                                                        class="fa fa-star" aria-hidden="true"></i>
                                                    Rate</a>
                                                <span class="tooltip-text">Rate this Escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#removeEscort"> <i
                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                    Remove</a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#escortProfileMissingModal"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Escort’s Profile</span>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- escort list legbox --}}

        <div class="row ">
            <div class="col-md-12 mb-4">
                <div class="my-3 d-flex align-items-center justify-content-between flex-wrap gap-10">
                    <h2 class="h2">Massage Center Legbox</h2>
                    <div class="total_listing">
                        <div><span>Total Massage Center Legbox: : </span></div>
                        <div><span>00</span></div>
                    </div>
                </div>
                <div class="table-responsive list-sec" id="sailorTableArea">
                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                        <table id="massagelistTable" class="table table-bordered display dataTable no-footer"
                            width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="
                             : activate to sort column descending"
                                        style="width: 21px;">
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox1">
                                        </div>
                                    </th>
                                    <th class="sorting_disabled" aria-label="Name">
                                        Name

                                    </th>
                                    <th class="sorting_disabled" aria-label="Date Created">Location</th>
                                    {{-- <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 149px;" aria-label="Subscription Type">Type </th>
                          <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 161px;" aria-label="Subscription Status">Mobile</th>
                          <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 79px;" aria-label="Status">Email</th> --}}
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 56px;"
                                        aria-label="Action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr role="row" class="odd">
                          <td class="sorting_1">1</td>
                          <td>Kathryn Murphy</td>
                          <td>SA</td>
                          <td>Female</td>
                          <td>09818 22 2222</td>
                          <td>test@gmail.com</td>
                          <td>
                             <div class="dropdown no-arrow archive-dropdown">
                                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                   <a class="dropdown-item" href="#" data-id="27" data-name="test one" data-category="27">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>
                                   <a class="dropdown-item delete-center" href="#" data-id="27">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>
                                </div>
                             </div>
                          </td>
                       </tr> --}}
                            </tbody>
                        </table>
                        {{-- <div class="dataTables_info" id="myTable_info" role="status" aria-live="polite">Showing 1 to 8 of 8 entries</div>
                 <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate"><a class="paginate_button previous disabled" aria-controls="myTable" data-dt-idx="0" tabindex="0" id="myTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="myTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="myTable" data-dt-idx="2" tabindex="0" id="myTable_next">Next</a></div> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- end massage list --}}
    </div>




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
                                    <h4><strong>Select Rating</strong></h4>
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
                            <div class="form-group d-flex align-items-center justify-content-end gap-10">
                                <input type="hidden" id="removeEscortId" value="">
                                <input type="hidden" id="removeEscortName" value="">
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn-success-modal removeEscortButton">Remove</button>
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
                    <h5 class="modal-title" id="emailReport">Escort Profile</h5>
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
                            <h5 class=" body_text mb-2">This Escort does not presently have any Listed Profiles.</h5>
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
                searchable: true,
                searching: true,
                ajax: {
                    url: "{{ route('user.my-legbox-escort-list') }}",
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
                    { data: 'escort_communication', name: 'escort_communication' },   // 8
                    { data: 'is_blocked', name: 'is_blocked' },                       // 9
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
                let profileurl = "{{route('profile.description','_id')}}";
                profileurl = profileurl.replace('_id',escortId);

                console.log(profileurl);

                $("#escortPopupModalBodyIframe").attr('src', profileurl)
                setTimeout(() => {
                    $("#escortProfileMissingModal").modal('show')
                }, 300);
                
                
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

                // Optional: disable button to prevent multiple submissions
                // $('#submitRatingBtn').prop('disabled', true).text('Submitting...');
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
        });

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
                url: "{{ route('user.legbox.massagedataTable') }}",
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
                //  { data: 'type', name: 'gender', searchable: false, orderable:false ,defaultContent: 'NA'},
                //  { data: 'phone', name: 'phone', searchable: false, orderable:false,defaultContent: 'NA' },
                //  { data: 'email', name: 'email', searchable: false, orderable:false,defaultContent: 'NA' },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA'
                },
            ],
            aoColumnDefs: [

                // {
                //    "aTargets":[0],
                //       "render": function (data) { return  "<a href='#'>"+data+"  </a>"; 
                //    }
                // },
                // {
                //    "aTargets": [0],
                //    "visible": false,
                //    "searchable": false
                // }

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
            // if(confirm("Are you sure want to remove?")) {
            //    
            // }
        })
    </script>
@endpush
