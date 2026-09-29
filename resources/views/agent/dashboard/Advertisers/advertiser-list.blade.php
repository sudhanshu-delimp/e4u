@extends('layouts.agent')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style type="text/css">
        .select2-container .select2-choice,
        .select2-result-label {
            font-size: 1.5em;
            height: 52px !important;
            overflow: auto;
        }

        .select2-arrow,
        .select2-chosen {
            padding-top: 6px;
        }

        span.select2.select2-container.select2-container--default>span.selection>span {
            height: 52px !important;
        }

        .table-responsive {
            overflow: visible;
        }
    </style>
@endsection

@section('content')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5" id="replace-item">

                    {{-- Page Heading --}}
                    <div class="row">
                        <div class="d-flex align-items-center justify-content-between col-md-12">
                            <div class="custom-heading-wrapper">
                                <h1 class="h1">Advertiser List</h1>
                                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                                    aria-expanded="true"><b>Help?</b></span>
                            </div>
                            @if (request('from') == 'dashboard')
                                <div class="back-to-dashboard">
                                    <a href="{{ route('agent.dashboard') }}">
                                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Notes Accordion --}}
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                                    <ol>
                                        <li>
                                            You can access all of your Advertisers here. The report 'Earnings' column is
                                            Commission paid to you by E4U according to the Advertiser's spend.
                                        </li>
                                        <li>
                                            Click the <b>'Action'</b> button and select from the range of options available
                                            to you including Messaging to an Advertiser.
                                        </li>
                                        <li>
                                            The Action dropdown includes: Profile, Tour, Media, Masseur, Account, and
                                            Message options. Pop-ups will be used where necessary.
                                        </li>
                                        <li>
                                            You can print the advertiser list summary by selecting from All Advertisers,
                                            Escorts, or Massage Centres in the Print menu.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Heading --}}
                    <div class="row my-3">
                        <div class="col-lg-12 d-flex justify-content-end" style="gap: 20px;">
                        
                            <div class="d-flex justify-content-end" style="gap: 20px;">

                                <div class="total_listing">
                                    <div><span>Escorts : </span></div>
                                    <div><span class="">01</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Centres : </span></div>
                                    <div><span class="">0</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Total Advertisers : </span></div>
                                    <div><span class="">01</span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="table-responsive common-card">
                                <table class="table" id="myAdvertisersList">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th style="width:78px;!important;">Mobile</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                            <th>Appointed</th>
                                            <th>Earnings</th>
                                            <th>Home State</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Action Modals (Frontend Design Only) -->

    <!-- Create Profile Modal -->
    <div class="modal upload-modal fade" id="createProfileModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/add-profile.png') }}"
                            class="custompopicon"> Create Profile</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Profile Name</label>
                            <input type="text" class="form-control" placeholder="Enter profile name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn-success-modal m-0">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal upload-modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/edit-profile.png') }}"
                            class="custompopicon">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Profile Name</label>
                            <input type="text" class="form-control" value="Carla Brasil">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control">Current description...</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-success-modal m-0">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Tour Modal -->
    <div class="modal upload-modal fade" id="createTourModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/travel.png') }}"
                            class="custompopicon"> Create Tour</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal">Save Tour</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tour Modal -->
    <div class="modal upload-modal fade" id="editTourModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/travel.png') }}"
                            class="custompopicon"> Edit Tour</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" value="Sydney">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal">Update Tour</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Media Modal -->
    <div class="modal upload-modal fade" id="manageMediaModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/manage-media.png') }}"
                            class="custompopicon"> Manage Media</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group text-center">
                            <label class="upload_media" for="fileInput">

                                <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                    viewBox="0 0 32 32" xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css">
                                            .flatshadows_een {
                                                fill: #fcfcfc;
                                            }

                                            .flatshadows_twee {
                                                fill: #E1E5E5;
                                            }

                                            .flatshadows_drie {
                                                fill: #C4CCCC;
                                            }

                                            .st0 {
                                                fill: #A3AFAF;
                                            }

                                            .st1 {
                                                fill: #8D9999;
                                            }

                                            .st2 {
                                                fill: #8C9898;
                                            }
                                        </style>
                                        <g>
                                            <path class="flatshadows_twee"
                                                d="M28,13h-1c0-3.314-2.686-6-6-6h-0.587C19.226,4.069,16.357,2,13,2c-4.418,0-8,3.582-8,8v1 c-2.209,0-4,1.791-4,4c0,2.209,1.791,4,4,4h23c1.657,0,3-1.343,3-3S29.657,13,28,13z">
                                            </path>
                                            <polygon class="flatshadows_drie" points="14,9 24,19 11,19 11,17 8,17 ">
                                            </polygon>
                                            <polygon class="flatshadows_een"
                                                points="8,17 14,9 20,17 17,17 17,30 11,30 11,17 "></polygon>
                                        </g>
                                    </g>
                                </svg>
                                <p>Upload New Image</p>
                            </label>
                            <input type="file" class="form-control-file d-none" id="fileInput" accept="image/*">
                            <p id="fileName" class="upl_file_name"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal">Update Media</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Masseurs Modal -->
    <div class="modal upload-modal fade" id="manageMasseursModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img
                            src="{{ asset('assets/dashboard/img/manage-masseuse.png') }}" class="custompopicon"> Manage
                        Masseurs</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Ravi</span> <button class="btn-sm btn-danger">Remove</button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Akash</span> <button class="btn-sm btn-danger">Remove</button>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

 
    <!-- Edit Account Modal -->
    <div class="modal upload-modal fade" id="editAccountModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/edit-task.png') }}"
                            class="custompopicon"> Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="Carla Brasil">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="carla@gmail.com">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Summary Modal -->
    <div class="modal upload-modal fade" id="printSummaryModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/printer.png') }}"
                            class="custompopicon"> Print Advertiser Summary</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Select Print Type</label>
                            <select class="form-control">
                                <option>All Advertisers</option>
                                <option>Escorts</option>
                                <option>Massage Centres</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-success-modal" onclick="window.print()">Print</button>
                </div>
            </div>
        </div>
    </div>

    <!--- Summary Modal --->


    <div class="modal fade upload-modal" id="viewAccountModal" tabindex="-1" role="dialog"
        aria-labelledby="viewAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAccountModal">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                    </g>

                                                    <g id="SVGRepo_iconCarrier">

                                                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>

                                                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>

                                                    </g>

                                                </svg>
                        Summary
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div id="listingModalContent">
                                 {{-- @endif
                            @if (!empty($print))
                            <h3>Transaction Summary</h3>
                            @endif --}}
                                <table
                                    style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                                    <tbody>
                                        <tr style="text-align:left; border: 1px solid #ccc; padding: 8px;">
                                            <td colspan="2">
                                                <img src="{{ asset('assets/dashboard/img/no-image-light.png') }}" alt="thumbnail" style="width:100px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;">
                                                <strong>Member ID</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">E20118</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Name</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">Kendra Kayy</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Mobile</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">1438 028 740</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Email</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">Kendra740@e4u.com.au</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Home State</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">NSW</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Appointed</strong></td>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">12-01-2026</td>
                                        </tr>

                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn-success-modal nex_sterp_btn print_payment_summary text-white"
                        target="_blank">🖨️ Print Summary</a>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#myAdvertisersList").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Member ID or Profile Name"

                },
                processing: true,
                serverSide: true,
                lengthChange: true,
                searching: true,
                bStateSave: false,
                lengthMenu: paginateRange,
                pageLength: paginateLength,
                ajax: {
                    url: "{{ route('agent.accepted_advertiser_datatable') }}",
                    type: 'GET',
                    data: function(d) {
                        d.type = 'player';
                    }
                },

                columns: [{
                        data: 'member_id',
                        name: 'member_id',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'joined_date',
                        name: 'joined_date',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'appointed_date',
                        name: 'appointed_date',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'earnings',
                        name: 'earnings',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'home_state',
                        name: 'home_state',
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'status_name',
                        name: 'status_name',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center',
                        render: function(data, type, row) {
                            if (row.status == 'Active') {
                                return `
                <div class="dropdown no-arrow archive-dropdown text-center">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" style="height:auto !important;">
                  <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)"  onclick="return switchAccount('${row.switch_account_route}', '${row.switch_confirm_message}');">
                    <i class="fa fa-random"></i> Switch To</a>
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#viewAccountModal"><i class="fa fa-eye"></i>Summary</a>
                   <!--a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#createProfileModal"><i class="fa fa-plus"></i> Create Profile</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editProfileModal"><i class="fa fa-pen"></i> Edit Profile</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/agent/profile/list/${row.member_id}"><i class="fa fa-list"></i> List Profile</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#createTourModal"><i class="fa fa-plus"></i> Create Tour</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editTourModal"><i class="fa fa-pen"></i> Edit Tour</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#manageMediaModal"><i class="fa fa-play-circle"></i> Manage Media</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#manageMasseursModal"><i class="fa fa-user"></i> Manage Masseurs</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editAccountModal"><i class="fa fa-pen"></i> Edit Account</a>
                   
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#printSummaryModal"><i class="fa fa-print"></i> Print</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/agent/message/send?member_id=${row.member_id}"><i class="fa fa-comment"></i> Message</a -->
                </div>
             </div>`;
                            } else {
                                return '';
                            }
                        }
                    }
                ],

                order: [
                    [0, 'desc']
                ],

            });
        });

        // Action handler
        function openActionModal(action, memberId) {
            console.log("Action Triggered:", action, "| Member ID:", memberId);
            // Add modal or route logic here
        }


        document.getElementById("fileInput").addEventListener("change", function() {
            let fileName = this.files[0] ? this.files[0].name : "No file selected";
            document.getElementById("fileName").textContent = fileName;
        });

        async function switchAccount(url, msg) {
            const result = await Swal.fire({
                title: "Are you sure?",
                text: msg,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes Switch",
                cancelButtonText: "Cancel",
                showDenyButton: false,
            });

            if (result.isConfirmed) {
                window.location.href = url;
            }
            return false;
        }
    </script>
@endpush
