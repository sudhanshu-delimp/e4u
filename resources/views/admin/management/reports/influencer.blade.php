@extends('layouts.admin')
@section('style')
<style>    
.total-value{
        border-top:2px solid #000 !important; 
        border-bottom:2px solid #000 !important; 
    }

    .flex_value{
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: center;
    }
.table-bordered{
    border-color: #000 !important;
}

.influencer_modal{    
    max-width: 800px;
    margin: auto;
}
.report-wrapper {
    max-height: 500px;
    min-height: 150px;
    overflow: auto;
}

.section-title {
    background: #0c223d;
    color: #fff;
    padding: 8px 10px;
    font-weight: bold;
    margin-top: 25px;
    text-align:left;
}
.sub-section-title{
    text-align: left !important
}
.report-table,
.assessment-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 5px;
}

.assessment-table th{
    text-align: left;
}
.report-table th,
.report-table td,
.assessment-table th,
.assessment-table td {
    border: 1px solid #000;
    padding: 6px 8px;
}

.report-table th {
    width: 20%;
    text-align: left;
    font-weight: bold;
}

.list {
    margin: 0;
    padding-left: 18px;
}

.total-row td,
.total-row th {
    font-weight: bold;
    border-top: 2px solid #000;
}

.assessment-table td {
    text-align: center;
}

.right {
    text-align: right;
    font-weight: bold;
}

.signature-table {
    width: 100%;
    margin-top: 30px;
    padding: 20px 0px;
}

.signature-table td {
    padding: 10px;
}

.comment-lines {
    border-bottom: 1px solid #000;
    height: 30px;
    margin-bottom: 10px;
}

    </style>
@stop
@section('content')
@php
   $securityLevel = isset(auth()->user()->staff_detail->security_level) ? auth()->user()->staff_detail->security_level: 0;
   $addAccess = staffPageAccessPermission($securityLevel, 'add');
   $addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

   $editAccess = staffPageAccessPermission($securityLevel, 'edit');
   $editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
@endphp
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Influencer Requests</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Applications to become an E4U Influencer (<b>Influencer</b>) are summarised here.
                                    </li>
                                    <li>Complete the Influencer data, Edit action, before the assessment is undertaken.</li>
                                    <li>Only the Managing Director can approve the status of an Influencer to an Escort.
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div id="table-sec" class="table-responsive-xl">
                                    <table class="table" id="InfluencerReportTable">
                                        <thead class="table-bg">
                                            <tr>
                                                <th>Ref</th>
                                                <th>Requested</th>
                                                <th>Member ID</th>
                                                <th>Mobile</th>
                                                <th>Home State</th>
                                                <th>Social Media</th>
                                                <th>Approved</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>123</td>
                                                <td>01-11-2025</td>
                                                <td>M40161</td>
                                                <td>1438 028 733</td>
                                                <td>Qld</td>
                                                <td>
                                                    <ul class="pl-3 mb-0">
                                                        <li class="mb-0">address</li>
                                                        <li class="mb-0">address</li>
                                                    </ul>
                                                </td>
                                                <td>28-12-2025</td>
                                                <td>Pending</td>
                                                <td>
                                                    
                                                    <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i
                                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                            aria-labelledby="dropdownMenuLink">
                                                            <div class="custom-tooltip-container">
                                                                <a
                                                                    class="dropdown-item align-item-custom toggle-massage-notification"
                                                                    href="#" title="Click to disable notification">
                                                                     @if($editAccessEnabled)
                                                                    <a class="dropdown-item align-item-custom"
                                                                        data-toggle="modal" data-target="#payAgentreport"
                                                                        href=""> <i class="fa fa-check-circle"
                                                                            aria-hidden="true"></i>
                                                                        Approve</a>
                                                                         <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewAgentreport"> <i
                                                                            class="fa fa-thumbs-down"
                                                                            aria-hidden="true"></i>
                                                                        Decline</a>
                                                                        <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#editSocialMediaAccount"> <i
                                                                            class="fa fa-pen" aria-hidden="true"></i>
                                                                        Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewAgentreport"> <i class="fa fa-ban"
                                                                            aria-hidden="true"></i>
                                                                        Suspend</a>
                                                                    <div class="dropdown-divider"></div>
                                                                     @endif
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewSummarydetails"> <i class="fa fa-eye"
                                                                            aria-hidden="true"></i>
                                                                        View Summary</a>
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


    <div class="modal fade upload-modal" id="editSocialMediaAccount" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/influencer.png') }}" alt="resolved" class="custompopicon">
                        <span class="success-modal-title">Edit Social Media Accounts</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body">
                    <form name="edit_social_media" id="edit_social_media" method="POST"
                        action=""
                        enctype="multipart/form-data">

                     <div class="row social_media_modal" >
                        <div class="col-lg-12" style="max-height: 500px; overflow:auto;">
                            <div class="row">
                                <!-- Section -->
                                <div class="col-lg-12 my-2">
                                    <h6 class="border-bottom pb-1 text-blue-primary">Social Media Account 1</h6>
                                </div>

                                <!-- Name -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="name" id="name"
                                            value="Monika Goswami" placeholder="Name">
                                    </div>
                                    <span class="text-danger error-name"></span>
                                </div>

                                <!-- URL Address -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">URL Address:</span>
                                        </div>
                                        <input type="url" class="form-control rounded-0"
                                            name="address" id="address"
                                            value="https://www.facebook.com"
                                            placeholder="URL Address">
                                    </div>
                                    <span class="text-danger error-address"></span>
                                </div>

                                <!-- Date Joined -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date Joined:</span>
                                        </div>
                                        <input type="date" class="form-control rounded-0"
                                            name="date_joined" id="date_joined">
                                    </div>
                                    <span class="text-danger error-date_joined"></span>
                                </div>

                                <!-- Followers -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Followers:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="followers" id="followers"
                                            value="2" placeholder="Followers">
                                    </div>
                                    <span class="text-danger error-followers"></span>
                                </div>

                                <!-- Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="posts" id="posts"
                                            value="02" placeholder="Posts">
                                    </div>
                                    <span class="text-danger error-posts"></span>
                                </div>

                                <!-- Re-Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Re-Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="re_posts" id="re_posts"
                                            value="02" placeholder="Re-Posts">
                                    </div>
                                    <span class="text-danger error-re_posts"></span>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Section -->
                                <div class="col-lg-12 my-2">
                                    <h6 class="border-bottom pb-1 text-blue-primary">Social Media Account 2</h6>
                                </div>

                                <!-- Name -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="name" id="name"
                                            value="Monika Goswami" placeholder="Name">
                                    </div>
                                    <span class="text-danger error-name"></span>
                                </div>

                                <!-- URL Address -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">URL Address:</span>
                                        </div>
                                        <input type="url" class="form-control rounded-0"
                                            name="address" id="address"
                                            value="https://www.facebook.com"
                                            placeholder="URL Address">
                                    </div>
                                    <span class="text-danger error-address"></span>
                                </div>

                                <!-- Date Joined -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date Joined:</span>
                                        </div>
                                        <input type="date" class="form-control rounded-0"
                                            name="date_joined" id="date_joined">
                                    </div>
                                    <span class="text-danger error-date_joined"></span>
                                </div>

                                <!-- Followers -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Followers:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="followers" id="followers"
                                            value="2" placeholder="Followers">
                                    </div>
                                    <span class="text-danger error-followers"></span>
                                </div>

                                <!-- Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="posts" id="posts"
                                            value="02" placeholder="Posts">
                                    </div>
                                    <span class="text-danger error-posts"></span>
                                </div>

                                <!-- Re-Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Re-Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="re_posts" id="re_posts"
                                            value="02" placeholder="Re-Posts">
                                    </div>
                                    <span class="text-danger error-re_posts"></span>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Section -->
                                <div class="col-lg-12 my-2">
                                    <h6 class="border-bottom pb-1 text-blue-primary">Social Media Account 3</h6>
                                </div>

                                <!-- Name -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="name" id="name"
                                            value="Monika Goswami" placeholder="Name">
                                    </div>
                                    <span class="text-danger error-name"></span>
                                </div>

                                <!-- URL Address -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">URL Address:</span>
                                        </div>
                                        <input type="url" class="form-control rounded-0"
                                            name="address" id="address"
                                            value="https://www.facebook.com"
                                            placeholder="URL Address">
                                    </div>
                                    <span class="text-danger error-address"></span>
                                </div>

                                <!-- Date Joined -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date Joined:</span>
                                        </div>
                                        <input type="date" class="form-control rounded-0"
                                            name="date_joined" id="date_joined">
                                    </div>
                                    <span class="text-danger error-date_joined"></span>
                                </div>

                                <!-- Followers -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Followers:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="followers" id="followers"
                                            value="2" placeholder="Followers">
                                    </div>
                                    <span class="text-danger error-followers"></span>
                                </div>

                                <!-- Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="posts" id="posts"
                                            value="02" placeholder="Posts">
                                    </div>
                                    <span class="text-danger error-posts"></span>
                                </div>

                                <!-- Re-Posts -->
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Re-Posts:</span>
                                        </div>
                                        <input type="text" class="form-control rounded-0"
                                            name="re_posts" id="re_posts"
                                            value="02" placeholder="Re-Posts">
                                    </div>
                                    <span class="text-danger error-re_posts"></span>
                                </div>
                            </div>
                        </div>
                        

                     </div>

                     <!-- Footer -->
                     <div class="modal-footer p-0">
                        <button type="submit" class="btn-success-modal">Save</button>
                     </div>
                  </form>


                </div>
            </div>
        </div>
    </div>


    {{-- view summary --}}

    <div class="modal fade upload-modal" id="viewSummarydetails" tabindex="-1" role="dialog"
        aria-labelledby="viewSummarydetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered influencer_modal" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center">
                        <img src="{{ asset('assets/dashboard/img/influencer.png') }}" alt="resolved" class="custompopicon">
                        <span class="success-modal-title">Influencer Application Summary - M40161</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="report-wrapper">

                        <!-- Member Details -->
                        <h5 class="section-title">Member Details</h5>
                        <table class="report-table">
                            <tr>
                                <th>Name</th><td>My Account name</td>
                                <th>Home State</th><td>My Account</td>
                            </tr>
                            <tr>
                                <th>Joined</th><td>My Account</td>
                                <th>Sex</th><td>My Account</td>
                            </tr>
                            <tr>
                                <th>Mobile</th><td>My Account mobile</td>
                                <th>Email</th><td>Online application</td>
                            </tr>
                            <tr>
                                <th>Social Media</th>
                                <td colspan="3">
                                    <ul class="list">
                                        <li>Online application</li>
                                        <li>Online application</li>
                                        <li>Online application</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <td colspan="3">Online application</td>
                            </tr>
                            <tr>
                                <th>Agent</th><td>Yes / No</td>
                                <th>Member ID</th><td>Agent Member ID</td>
                            </tr>
                        </table>

                        <!-- Member Listings -->
                        <h5 class="section-title">Member Listings</h5>
                        <table class="report-table">
                            <tr>
                                <th>Listings</th><td>No. of current listings</td>
                                <th>Spend</th><td>$ Value</td>
                            </tr>
                            <tr>
                                <th>Past Listings</th><td><div class="flex_value"><span>Platinum:</span> No.</div></td>
                                <th>Spend</th><td>$ Value (Avg: $)</td>
                            </tr>
                            <tr>
                                <th></th><td><div class="flex_value"><span>Gold:</span> No.</div> </td>
                                <th>Spend</th><td>$ Value (Avg: $)</td>
                            </tr>
                            <tr>
                                <th></th><td><div class="flex_value"><span>Silver:</span> No.</div> </td>
                                <th>Spend</th><td >$ Value (Avg: $)</td>
                            </tr>
                            <tr>
                                <th></th><td class="text-right total-value">Total: No.</td>
                                <th class="text-right total-value">Total</th><td class="total-value">$ Value (Avg: $)</td>
                            </tr>

                            <tr>
                                <th>Tours</th><td><div class="flex_value"><span>Current:</span> Yes or No</td>
                                <th>Spend</th><td>$ Value</td>
                            </tr>
                            <tr>
                                <th></th><td><div class="flex_value"><span>Past:</span> No.</td>
                                <th>Spend</th><td>$ Value</td>
                            </tr>
                        </table>

                        <!-- Member Statistics -->
                        <h5 class="section-title">Member Statistics</h5>
                        <table class="report-table">
                            <tr>
                                <th>Profile Views</th><td>YTD</td>
                                <th>Recommendations</th><td>YTD</td>
                            </tr>
                            <tr>
                                <td></td><td>Avg p/mth</td>
                                <td></td><td>Avg p/mth</td>
                            </tr>
                            <tr>
                                <th>Media Views</th><td>YTD</td>
                                <th>Reports</th><td>YTD</td>
                            </tr>
                            <tr>
                                <td></td><td>Avg p/mth</td>
                                <td></td><td>Avg p/mth</td>
                            </tr>
                            
                            <tr>
                                <th>Playbox Views</th><td>YTD</td>
                                <th>Reviews</th><td>YTD</td>
                            </tr>
                            <tr>
                                <td></td><td>Avg p/mth</td>
                                <td></td><td>Avg p/mth</td>
                            </tr>
                        </table>
                        <!-- Social Media Statistics (Nominated) -->
                        <h5 class="section-title">Social Media Statistics (Nominated)</h5>
                        <table class="report-table">
                            <tr>
                                <th colspan="4"> social media 1 name</th>
                            </tr>
                            <tr>
                                <th>Date joined:</th><td>edit data</td>
                                <th>Posts:</th><td>edit data</td>
                            </tr>
                            <tr>
                                
                                <th>Followers:</th><td>edit data</td>
                                <th>Re-Posts:</th><td>edit data</td>
                            </tr>
                        </table>
                        <!-- Data Assessment -->
                        <h5 class="section-title">Data Assessment</h5>
                        <table class="assessment-table">
                            <tr>
                                <th colspan="2" rowspan="2">Item</th>
                                <th colspan="2">Assessment</th>
                            </tr>
                            <tr>
                                <th>Benchmark</th>
                                <th>Score</th>
                            </tr>
                            <tr><th class="text-left">Membership Time</th><td>No.</td><td>10</td><td>—</td></tr>
                            <tr><th class="text-left">Listings</th><td>No.</td><td>10</td><td>—</td></tr>
                            <tr><th class="text-left">Tours</th><td>No.</td><td>10</td><td>—</td></tr>
                            <tr><th class="text-left">Views (Profile)</th><td>No.</td><td>5</td><td>—</td></tr>
                            <tr><th class="text-left">Views (Media)</th><td>No.</td><td>5</td><td>—</td></tr>
                            <tr><th class="text-left">Views (Playbox)</th><td>No.</td><td>5</td><td>—</td></tr>
                            <tr><th class="text-left">Recommendations</th><td>No.</td><td>5</td><td>—</td></tr>
                            <tr><th class="text-left">Reports</th><td>No.</td><td>5</td><td>—</td></tr>
                            <tr><th class="text-left">Reviews</th><td>No.</td><td>5</td><td>—</td></tr>

                            <!-- Followers -->
                            <tr>
                                <th colspan="4">Followers</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="inner-table" width="100%">
                                        <tr>
                                            <th>Social Media 1</th>
                                            <td>No.</td>
                                            <td rowspan="4">20</td>
                                            <td rowspan="4">—</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 2</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 3</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 4</th>
                                            <td>No.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Post -->
                            <tr>
                                <th colspan="4">Post</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="inner-table" width="100%">
                                        <tr>
                                            <th>Social Media 1</th>
                                            <td>No.</td>
                                            <td rowspan="4">10</td>
                                            <td rowspan="4">—</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 2</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 3</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 4</th>
                                            <td>No.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Re Post -->
                            <tr>
                                <th colspan="4">Re Post</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="inner-table" width="100%">
                                        <tr>
                                            <th>Social Media 1</th>
                                            <td>No.</td>
                                            <td rowspan="4">10</td>
                                            <td rowspan="4">—</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 2</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 3</th>
                                            <td>No.</td>
                                        </tr>
                                        <tr>
                                            <th>Social Media 4</th>
                                            <td>No.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2"  style="border:0px;text-align:right;">Total</th>
                                <td style="border-top:2px solid #000; border-left:0px; border-right:0px;border-bottom:0px;">100</td>
                                <td style="border-top:2px solid #000; border-left:0px; border-right:0px;border-bottom:0px;"></td>
                            </tr>
                            <tr>
                                <th colspan="2" style="border:0px;text-align:right;">Minimum</th>
                                <td  style="border:0px;"></td>
                                <td  style="border:0px;text-align:right;">80</td>
                            </tr>
                            <tr class="net-row">
                                <th colspan="2" style="border:0px; text-align:right;">Net</th>
                                <td style="border:0px;text-align:right;">+ / -</td>
                                <td style="border-top:2px solid #000; border-bottom: 6px double #000; border-left:0px; border-right:0px;text-align:right;">80</td>
                            </tr>
                        </table>

                        <!-- Approval -->
                        <table class="signature-table table-bordered">
                            <tr>
                                <td style="border:none;">Managing Director: __________________________</td>
                                <th style="border:none;">
                                    Approved <input type="checkbox">
                                    &nbsp;&nbsp;
                                    Declined <input type="checkbox">
                                </th>
                            </tr>
                        </table>

                        <!-- Comments -->
                        <h5 class="mt-3 font-weight-bold">Comments</h5>
                        <div class="comment-lines"></div>
                        <div class="comment-lines"></div>
                        <div class="comment-lines"></div>
                        <div class="comment-lines"></div>

                    </div>
                     <div class="modal-footer pb-0 pt-3">
                        <button type="submit" class="btn-success-modal">Print</button>
                        <button type="submit" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                     </div>


                </div>
            </div>
        </div>
    </div>

    {{-- end --}}

    


@endsection
@push('script')
    <script>
        var table = $("#InfluencerReportTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            columns: [{
                    data: 'Ref',
                    name: 'Ref',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'Requested',
                    name: 'Requested',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'home_state',
                    name: 'home_state',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'social_media',
                    name: 'social_media',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'approved',
                    name: 'approved',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'edit',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
        });
    </script>
@endpush
