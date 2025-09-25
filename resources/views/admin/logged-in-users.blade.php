@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }


        #cke_1_contents {
            height: 150px !important;
        }

        #listings_paginate span {
            display: contents;
        }

        .d-none {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1"> Logged in Users</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b>
                </span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>All logged in Users are displayed in this table. Visitors to the Website are displayed under
                                ‘Visitors’.</li>
                            <li>You have limited Action access according to your security level.</li>
                            <li>Legend:</li>
                            <p>E: Escort &nbsp;&nbsp;M: Massage Centre &nbsp;&nbsp;A: Agent &nbsp;&nbsp;V: Viewer
                                &nbsp;&nbsp;S: Staff. &nbsp;&nbsp;</p>
                            <li>Prefixes:</li>
                            <p>1. ACT &nbsp;&nbsp;2. NSW &nbsp;&nbsp;3. Vic &nbsp;&nbsp;4. Qld &nbsp;&nbsp;5. SA
                                &nbsp;&nbsp;6. WA &nbsp;&nbsp;7. Tas &nbsp;&nbsp;8. NT.</p>

                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">

                <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">

                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span class="totalListing">4,456</span></div>
                    </div>
                </div>
            </div>
            <div class="logged_in_table_class">
                <table class="table table-bordered" id="listings" style="width:100%;">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                                Member ID

                            </th>
                            <th scope="col">
                                Member

                            </th>
                            <th scope="col">
                                IP Adrress
                            </th>
                            <th scope="col">
                                Platform
                            </th>
                            <th scope="col">Idle Preference<br/> Time (Minutes)</th>
                            {{-- <th scope="col">Idle Time <br/> (Minutes)</th> --}}
                            <th scope="col">Page</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td colspan="10" class="theme-color text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>

                <div class="timer_section">
                    <p>Server time: <span class="serverTime">10:23:51 am</span></p>
                    <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                    <p>Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></p>
                </div>
                <div class="customPaginationContainer mt-4 d-flex justify-content-between"></div>
                <nav aria-label="Page navigation example" class="customPagination">
                </nav>
            </div>
        </div>

        {{-- <div class="col-md-12 " id="printArea">
            <div class="my-account-card" style="display: none;">
                <div class="card-head">

                    <h2>My Account details </h2>
                    <input type="hidden" id="user_type">
                    <form action="{{ route('print.logged.user.single-details') }}" method="post">
                        {{ csrf_field() }}
                        <input name="user_id" type="hidden" id="user_print_id">
                        <input name="user_data" type="hidden" id="user_print_data">
                        <input name="common_print_data" type="hidden" id="common_print_data">
                        <button type="submit" class="print-btn">🖨️ Print Report</button>
                        <button type="button" class="btn-cancel-modal" id="cancel_print_report">Close</button>
                    </form>
                    

                </div>
                <div class="info-grid">
                    <div class="info-item d-none">
                        <label>Member ID</label>
                        <span class="account_member_id">M60178</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Member</label>
                        <span class="account_member_name">Lins Massage</span>
                    </div>
                    <div class="info-item d-none">
                        <label>IP Address</label>
                        <span class="account_ip_address">123.176.113.164</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Platform</label>
                        <span class="account_platform">Firefox</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Page</label>
                        <span class="account_visit_page">/escort-dashboard</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Listed Profiles (Escort)</label>
                        <span class="account_listed_profile_count">08</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Published Masseurs (Massage Centre)</label>
                        <span class="account_masseurs_count">02</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Massage Legboxes (Massage Centre)</label>
                        <span class="account_massage_legbox">02</span>
                    </div>
                    <div class="info-item d-none">
                        <label>List Advertisers (Escort)</label>
                        <span class="account_list_adervtiser_count">01</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Escort Legboxes (Viewer)</label>
                        <span class="account_legbox_count">04</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Playmates</label>
                        <span class="account_escort_playmates">04</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Reffered By Advertisers</label>
                        <span class="account_refer_by_advertiser_agent">04</span>
                    </div>
                    <div class="info-item d-none">
                        <label>Reffered By Massage Centers</label>
                        <span class="account_refer_by_massage_center_agent">04</span>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
    </div>

    <!--middle content end here-->
    <!--right side bar start from here-->
    </div>
    <!--right side bar end-->
    </div>

    <!-- See Email Report popup -->


    <div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog"
        aria-labelledby="emailReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content basic-modal modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailReport"> <img
                            src="{{ asset('assets/dashboard/img/view-listing.png') }}" class="custompopicon"> Listing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body" id="escortPopupModalBody">
                    <div class="col-md-12 " id="printArea">
                        <div class="my-account-card" style="display: none; margin:10px;">
                            <div class="card-head">

                                <h2><b>My Account details </b></h2>
                                <input type="hidden" id="user_type">
                            </div>
                            <div class="info-grid">
                                <div class="info-item d-none">
                                    <label>Member ID</label>
                                    <span class="account_member_id">M60178</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Member</label>
                                    <span class="account_member_name">Lins Massage</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>IP Address</label>
                                    <span class="account_ip_address">123.176.113.164</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Platform</label>
                                    <span class="account_platform">Firefox</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Page</label>
                                    <span class="account_visit_page">/escort-dashboard</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Listed Profiles (Escort)</label>
                                    <span class="account_listed_profile_count">08</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Published Masseurs (Massage Centre)</label>
                                    <span class="account_masseurs_count">02</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Massage Legboxes (Massage Centre)</label>
                                    <span class="account_massage_legbox">02</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>List Advertisers (Escort)</label>
                                    <span class="account_list_adervtiser_count">01</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Escort Legboxes (Viewer)</label>
                                    <span class="account_legbox_count">04</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Playmates</label>
                                    <span class="account_escort_playmates">04</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Reffered By Advertisers</label>
                                    <span class="account_refer_by_advertiser_agent">04</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Reffered By Massage Centers</label>
                                    <span class="account_refer_by_massage_center_agent">04</span>
                                </div>
                                <div class="info-item d-none">
                                    <label>Idle Preference Time (Minutes)</label>
                                    <span class="account_idle_prefrence_time">04</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('print.logged.user.single-details') }}" method="post">
                            {{ csrf_field() }}
                            <input name="user_id" type="hidden" id="user_print_id"  class="user_print_id" value="">
                            <input name="user_data" type="hidden" id="user_print_data"  class="user_print_data" value="">
                            <input name="common_print_data" type="hidden" id="common_print_data"  class="common_print_data" value="">
                            <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                            <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- confirmation model -->
    <div class="modal " id="confirm_modal" style=" padding-right: 15px;" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="/assets/dashboard/img/ban.png" class="custompopicon" id="modal-icon">
                        <span style="color:white" id="modal_suspend_title">Profile Suspended</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                        Are you sure you want to <span class="bodyMessageTitle">suspend</span> this profile?
                    </h5>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" id="close">No</button>
                    <button type="submit" class="btn-success-modal" data-user-id="" data-dismiss="modal" id="saveSuspendPfileInfo" >Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <!-- success model -->
    <div class="modal " id="success_modal" style=" padding-right: 15px;" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="/assets/dashboard/img/unblock.png" class="custompopicon" id="modal-icon">
                        <span style="color:white" id="modal-title">Profile <span class="modal_success_title">Suspended</span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="http://127.0.0.1:8000/assets/app/img/newcross.png"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                        <span id="comman_str"></span>
                        <span class="comman_msg">Status updated succesfully.</span>
                    </h4>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="submit" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
        "></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });
        })

        function ajaxReload() {
            var table = $('#listings').DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Member ID or Name"
                },
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: true,
                info: true,
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
                ajax: {
                    url: "{{ route('admin.get-logged-in-users-by-ajax') }}",
                    type: "GET",
                    dataSrc: function(json) {
                        var totalRows = json.recordsTotal || json.recordsFiltered;
                        $(".totalListing").text(totalRows);
                        return json.data;
                    }
                },
                drawCallback: function(settings) {
                    // Move dynamic elements below .timer_section
                    const $info = $('#listings_info');
                    const $paginate = $('#listings_paginate');
                    const $timerSection = $('.customPaginationContainer');

                    if ($info.length && $paginate.length && $timerSection.length) {
                        $info.appendTo($timerSection);
                        $paginate.appendTo($timerSection);
                    }
                },
                columns: [{
                        data: 'member_id',
                        name: 'member_id'
                    },
                    {
                        data: 'member',
                        name: 'member'
                    },
                    {
                        data: 'ip_adress',
                        name: 'ip_adress'
                    },
                    {
                        data: 'platform',
                        name: 'platform'
                    },
                    {
                        data: 'idle_preference_time',
                        name: 'idle_preference_time'
                    },
                    // {
                    //     data: 'idle_time',
                    //     name: 'idle_time'
                    // },
                    {
                        data: 'page',
                        name: 'page'
                    },
                    
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

        }

        $(document).on('click', '#cancel_print_report', function(e) {
            $(".my-account-card").slideUp();
        });

        $(document).on('click', '.suspendLoggedUser', function(e) {
            e.preventDefault(); // prevent default link behavior

            const userId = $(this).attr('data-user-id');
            const status = $(this).attr('data-status') == 'Suspended' ? 'Active' : 'Suspend';
            $("#saveSuspendPfileInfo").attr('data-user-id',userId);

            $("#modal_suspend_title").text('Profile '+status);
            $(".bodyMessageTitle").text(status);
            $(".modal_success_title").text(status == 'Suspend' ? 'Suspended' : 'active' );

            var myModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
            myModal.show();
        });

        $(document).on('click', '#saveSuspendPfileInfo', function(e) {
            e.preventDefault(); 

            var userId = $("#saveSuspendPfileInfo").attr('data-user-id');

            $.ajax({
                url: '{{ route("logged-user-status-update", "_id") }}'.replace('_id',userId), // replace with your actual route
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if(response.status == 'success'){
                        console.log('suspened succesfully')
                        $('#listings').DataTable().ajax.reload(null, false);
                        var confirmModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
                        confirmModal.hide();

                        var successModal = new bootstrap.Modal(document.getElementById('success_modal'));
                        successModal.show();
                    }
                },
                error: function(xhr) {
                    $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                }
            });
        });

        $(document).on('click', '.view-listing', function(e) {
            e.preventDefault(); // prevent default link behavior

            const escortId = $(this).data('id');

            $.ajax({
                url: '{{ route('escort.current.single-list.dataTableListing') }}/' +
                escortId, // replace with your actual route
                method: 'GET',
                success: function(response) {

                    $("#escortPopupModalBodyIframe").attr('src', response.profileurl)
                },
                error: function(xhr) {
                    $('#view-listing .modal-body').html(
                        '<p class="text-danger">Error loading data...</p>');
                }
            });
        });

        $(document).on('click', '.viewLoggedUserDetails', function(e) {
            e.preventDefault(); // prevent default link behavior

            const userId = $(this).attr('data-user-id');
            console.log('View Logged User Details clicked ', userId);
            $(".user_print_id").val(userId);

            const myModal = new bootstrap.Modal(document.getElementById('view-listing'));
            myModal.show();

            viewSingleLoggedUserAjaxRequest(userId);

        });

        function viewSingleLoggedUserAjaxRequest(userId) {
            $.ajax({
                url: '{{ route("admin.get-logged-in-single-user-detail-with-ajax", "_id") }}'.replace('_id',
                    userId), // replace with your actual route
                method: 'GET',
                success: function(response) {
                    console.log('Response from server: ', response);
                    $(".my-account-card").slideDown();

                    if (response.status == 'success') {

                        viewSpecificLoggedUserDetails(response.userDetails);
                        
                    }
                },
                error: function(xhr) {
                    $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                }
            });
        }

        function viewSpecificLoggedUserDetails(user) {
            $(".info-item").addClass('d-none');

            console.log('user details new : ', user);
            var userDetails = user;
            var loginAttempts = userDetails.login_attempts;

            $(".account_member_id").text(userDetails.member_id ?? '-');
            $(".account_member_name").text(userDetails.name);
            $(".account_ip_address").text(loginAttempts.ip_address);
            $(".account_platform").text(loginAttempts.device);
            $(".account_visit_page").text(loginAttempts.page);
            $(".account_idle_prefrence_time").text(userDetails.idle_preference_time ?? '30');

            $("#user_print_id").val(user.id);
            $("#user_type").val(user.type);

            // document.getElementById("user_print_id").value = user.id;
            // document.getElementById("user_type").value = user.type;

            var commonData = {
                'account_member_id': userDetails.member_id ?? '-',
                'account_member_name': userDetails.name ?? '-',
                'account_ip_address': loginAttempts.ip_address ?? '-',
                'account_platform': loginAttempts.device ?? '-',
                'account_visit_page': loginAttempts.page ?? '-',
            };

            $(".common_print_data").val(JSON.stringify(commonData));

            $(".account_member_id").parent().removeClass('d-none');
            $(".account_member_name").parent().removeClass('d-none');
            $(".account_ip_address").parent().removeClass('d-none');
            $(".account_platform").parent().removeClass('d-none');
            $(".account_visit_page").parent().removeClass('d-none');
            
            let userType = parseInt(user.type);

            switch (userType) {
                case 0:
                    // user
                    var myLegBox = userDetails.my_leg_box;
                    var escortsMylegbox = userDetails.escorts;
                    var massageMylegbox = userDetails.massage_center_leg_box;
                    var shortlistedMassage = '4';

                    let veiwerData = {
                        'account_legbox_count': myLegBox.length,
                        'account_massage_legbox': massageMylegbox.length,
                        'account_idle_prefrence_time': userDetails.idle_preference_time ?? '30',
                    }

                    $(".user_print_data").val(JSON.stringify(veiwerData))

                    $(".account_legbox_count").text(myLegBox.length);
                    $(".account_massage_legbox").text(massageMylegbox.length);

                    $(".account_legbox_count").parent().removeClass('d-none');
                    $(".account_massage_legbox").parent().removeClass('d-none');
                    $(".account_idle_prefrence_time").parent().removeClass('d-none')

                    break;
                // case 1:
                //     // user
                //     var myLegBox = userDetails.my_leg_box;
                //     var escortsMylegbox = userDetails.escorts;
                //     var massageMylegbox = userDetails.massage_center_leg_box;
                //     var shortlistedMassage = '4';

                //     let veiwerData = {
                //         'account_legbox_count': myLegBox.length,
                //         'account_massage_legbox': massageMylegbox.length,
                //     }

                //     $("#user_print_data").val(JSON.stringify(veiwerData))

                //     $(".account_legbox_count").text(myLegBox.length);
                //     $(".account_massage_legbox").text(massageMylegbox.length);

                //     $(".account_legbox_count").parent().removeClass('d-none');
                //     $(".account_massage_legbox").parent().removeClass('d-none');

                //     break;
                case 2:
                    // sub-admin
                    break;
                case 3:
                    // escort
                    var escorts = userDetails.escorts;
                    var escortsListedProfile = userDetails.listed_escorts;
                    var playmates = userDetails.playmates;
                    var legboxViewer = userDetails.viewerLegBoxCount;

                    let escortData = {
                        'account_list_adervtiser_count': userDetails.advertiserProfileCount,
                        'account_listed_profile_count': userDetails.listedProfileCount,
                        'account_escort_playmates': playmates.length,
                        'account_legbox_count': userDetails.viewerLegBoxCount,
                        'account_idle_prefrence_time': userDetails.idle_preference_time ?? '30',
                    }

                    $(".user_print_data").val(JSON.stringify(escortData));

                    $(".account_list_adervtiser_count").text(userDetails.advertiserProfileCount);
                    $(".account_listed_profile_count").text(userDetails.listedProfileCount);
                    $(".account_escort_playmates").text(playmates.length);
                    $(".account_legbox_count").text(userDetails.viewerLegBoxCount);

                    $(".account_list_adervtiser_count").parent().removeClass('d-none');
                    $(".account_listed_profile_count").parent().removeClass('d-none');
                    $(".account_escort_playmates").parent().removeClass('d-none');
                    $(".account_legbox_count").parent().removeClass('d-none');
                    $(".account_idle_prefrence_time").parent().removeClass('d-none')

                    break;
                case 4:
                    // masssage center
                    var massageCenterLegBox = userDetails.massage_center_leg_box;
                    var masseursProfile = userDetails.refer_by_massage_center;

                    let massageData = {
                        'account_masseurs_count': massageCenterLegBox.length,
                        'account_idle_prefrence_time': userDetails.idle_preference_time ?? '30',
                    }

                    $(".user_print_data").val(JSON.stringify(massageData));

                    $(".account_masseurs_count").text(massageCenterLegBox.length);


                    $(".account_masseurs_count").parent().removeClass('d-none');
                    $(".account_idle_prefrence_time").parent().removeClass('d-none')

                    break;
                case 5:
                    // agent
                    var agentCount = userDetails.refer_by_agent;
                    var masseursCount = userDetails.refer_by_massage_center;

                    let agentData = {
                        'account_refer_by_advertiser_agent': agentCount.length,
                        'account_refer_by_massage_center_agent': masseursCount.length,
                        'account_idle_prefrence_time': userDetails.idle_preference_time ?? '30',
                    }

                    $(".user_print_data").val(JSON.stringify(agentData));

                    $(".account_refer_by_advertiser_agent").text(agentCount.length);
                    $(".account_refer_by_massage_center_agent").text(masseursCount.length);

                    $(".account_refer_by_advertiser_agent").parent().removeClass('d-none');
                    $(".account_refer_by_massage_center_agent").parent().removeClass('d-none');
                    $(".account_idle_prefrence_time").parent().removeClass('d-none')
                    break;

                default:
                    // its user deafult 0
                    break;
            }
        }

        $(document).ready(function() {
            function checkAndApplyResponsive() {
                if ($(window).width() < 1500) {
                    if (!$('.massage_table_class').hasClass('table-responsive')) {
                        $('.massage_table_class').addClass('table-responsive');
                    }
                } else {
                    $('.massage_table_class').removeClass('table-responsive');
                }
            }

            // Initial check
            checkAndApplyResponsive();

            // Recheck on window resize
            $(window).resize(function() {
                checkAndApplyResponsive();
            });
        });
    </script>
@endpush
