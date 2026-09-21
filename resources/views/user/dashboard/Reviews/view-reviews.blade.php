@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }

    /* #EscortReviewTable tbody td{
            text-align: center !important;
        } */
    .escort-ratings {
        justify-content: center;
    }

    .table.num_view_table th {
        font-weight: bold;
        color: var(--blue--text);
        padding: 5px !important;
    }

    .toggle-report i {
        display: inline-block;
        transition: transform 0.3s ease, color 0.3s ease;
    }


    .toggle-report-active {
        color: #e83e8c !important;
        transform: rotate(90deg);
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Reviews</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>

                    <ol>
                        <li>View your Reviews here.</li>
                        <li>Simply click the 'View' button to see what you have written about the advertisers.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--middle content end here-->
    <div class="col-md-12 common-card mb-3">
        <div class="stats-card-grid">
            <div class="stats-card">
                <div class="stats-details">
                    <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="stat-text">
                        <div class="stats-label ">Today</div>
                        <div class="stats-value today_report">{{ $reports['today'] }}</div>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-details">
                    <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="stat-text">
                        <div class="stats-label">This Month</div>
                        <div class="stats-value month_report">{{ $reports['month'] }}</div>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-details">
                    <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="stat-text">
                        <div class="stats-label ">This Year</div>
                        <div class="stats-value year_report">{{ $reports['year'] }}</div>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-details">
                    <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="stat-text">
                        <div class="stats-label">All Time</div>
                        <div class="stats-value all_time_report">{{ $reports['all_time'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 common-card mb-3">
        <div class="table-responsive custom-badge">
            <table class="table w-100" id="EscortReviewTable">
                <thead class="table-bg">
                    <tr>
                        <th>Member ID</th>
                        <th>Date</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-content">
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>

<!-- confirmation model -->
<div class="modal fade upload-modal" id="confirm_modal" style=" padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white">
                    <img src="/assets/dashboard/img/ban.png" class="custompopicon" id="modal-icon">
                    <span style="color:white" id="modal_suspend_title">Review Suspended</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="my-4 custom_modal_text">
                    Are you sure that you want to <span class="bodyMessageTitle">suspend</span> this <br> Review <span
                        class="bodyMessageSentence">from</span> all of your Profiles?
                </h5>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" id="close">No</button>
                <button type="submit" class="btn-success-modal" data-review-id="" data-review-status=""
                    data-dismiss="modal" id="saveReviewInfo">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->
<!-- success model -->
<div class="modal fade upload-modal" id="success_modal" style=" padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="/assets/dashboard/img/unblock.png" class="custompopicon" id="modal-icon">
                    <span style="color:white" id="modal-title">Review <span
                            class="modal_success_title">Suspended</span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="http://127.0.0.1:8000/assets/app/img/newcross.png"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                    <span id="comman_str"></span>
                    <span class="success_common_msg">Status updated succesfully.</span>
                </h5>
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
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>


    var escortReviewTable = $('#EscortReviewTable').DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID..."
        },
        processing: true,
        serverSide: false,
        paging: true,
        info: true,
        lengthChange: true,
        searching: true,
        bStateSave: false,
        ordering: true,
        lengthMenu: paginateRange,
        pageLength: paginateLength,
        ajax: {
            url: "{{ route('user.reviews-profile-by-ajax') }}",
            type: "GET",
            dataSrc: function(json) {
                return json.data;
            }
        },
        drawCallback: function(settings) {},
        order: [],
        columns: [{
                data: 'ref',
                name: 'ref'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'rating',
                name: 'rating',
                orderable: false,
                class: 'text-center'
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false,
                class: 'text-center'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                class: 'text-center'
            }
        ]
    });

    $(document).on('click', '.update-review-status', function(e) {
        e.preventDefault(); 
        const reviewId = $(this).attr('data-review-id');
        const status = $(this).attr('data-status');
        $("#saveReviewInfo").attr('data-review-id', reviewId);
        $("#saveReviewInfo").attr('data-review-status', status);
        var statusTitle = status == 'suspended' ? 'suspend' : 'publish';
        var bodyMessageSentence = status == 'suspended' ? 'from' : 'on';

        $("#modal_suspend_title").text('Review ' + capitalizeFirstLetter(statusTitle));
        $(".bodyMessageTitle").text(statusTitle);
        $(".bodyMessageSentence").text(bodyMessageSentence);
        $(".modal_success_title").text(capitalizeFirstLetter(statusTitle));
        var myModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
        myModal.show();
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    
    $('#EscortReviewTable tbody').on('click', '.toggle-report-hide', function(e) {
        console.log('hide report');
        $(this).parents('tr').hide();
    })

    // Toggle child rows
    // $('#EscortReviewTable tbody').on('click', '.toggle-report', function(e) {
    //     e.preventDefault();
    //     var tr = $(this).closest('tr');
    //     var row = escortReviewTable.row(tr);
    //     var dataId = $(this).data("id");
    //     let routeUrl = "{{ route('user.get-single-user-review-details', ':id') }}".replace(':id', dataId);
    //     let reviewId = dataId;

    //     viewReviewReportAjax(row, reviewId, routeUrl, $(this));
    //     console.log(row.id);

    // });

    // function viewReviewReportAjax(row, review_id, routeUrl, obj) {
    //     const reportId = $(this).data('id');

    //     $.ajax({
    //         url: routeUrl, // replace with your actual route
    //         method: 'GET',
    //         success: function(response) {

    //             var childHtml = ``;

    //             if (response.error == false) {
    //                 // if (row.child.isShown()) {
    //                 //     row.child.hide();
    //                 //     obj.html('<i class="fa fa-eye mr-2"></i> View');
    //                 // } else {
    //                 // Replace below with dynamic HTML if needed
    //                 if (response.data.advertiser_type == 'escort') {
    //                     childHtml = `
    //                 <div class="card p-3 border-0">
    //                     <div class="d-flex justify-content-between">
    //                         <h5 class="font-weight-bold text-blue-primary">Review Details</h5>
    //                         <button class="btn-cancel-modal toggle-report-hide" style="font-size: 12px; padding: 5px 10px;" > Close </button>
    //                     </div>
    //                     <table class="table mb-0 num_view_table">
    //                         <tr>
    //                             <th>Escort ID:</th><td class="border-0">` + response.data.escort.user
    //                         .member_id + `</td>
    //                             <th>Escort’s Name:</th>
    //                             <td class="border-0">` + response.data.escort.name + `</td>
    //                             <th>Mobile:</th>
    //                             <td class="border-0">` + response.data.escort.user.phone + `</td>
    //                         </tr>
    //                         <tr>

    //                             <th>Home State:</th>
    //                             <td class="border-0">` + response.data.escort.user.state.name + `</td>                                   
    //                             <th>Status:</th>
    //                             <td class="border-0">` + capitalizeFirstLetter(response.data.status) + `</td>
    //                             <th>Comments:</th>
    //                             <td class="border-0">` + response.data.description + `</td>
    //                         </tr>
    //                     </table>
    //                 </div>
    //             `;
    //                 } else {
    //                     childHtml = `
    //                 <div class="card p-3 border-0">
    //                     <div class="d-flex justify-content-between">
    //                         <h5 class="font-weight-bold text-blue-primary">Review Details</h5>
    //                         <button class="btn-cancel-modal toggle-report-hide" style="font-size: 12px; padding: 5px 10px;" > Close </button>
    //                     </div>
    //                     <table class="table mb-0 num_view_table">
    //                         <tr>
    //                             <th>Member ID:</th><td class="border-0">` + response.data.massage.user
    //                         .member_id + `</td>
    //                             <th>Business Name:</th>
    //                             <td class="border-0">` + response.data.massage.business_name + `</td>

    //                             <th>Mobile:</th>
    //                             <td class="border-0">` + response.data.massage.user.phone + `</td>

    //                         </tr>
    //                         <tr>
    //                             <th>Home State:</th>
    //                             <td class="border-0">` + response.data.massage.user.state.name + `</td>
    //                             <th>Status:</th>
    //                             <td class="border-0">` + capitalizeFirstLetter(response.data.status) + `</td>
    //                             <th>Comments:</th>
    //                             <td class="border-0">` + response.data.description + `</td>
    //                         </tr>
    //                     </table>
    //                 </div>
    //             `;
    //                 }
    //                 row.child(childHtml).show();
    //                 //obj.html('<i class="fa fa-times mr-2"></i> Close');
    //                 obj.html('<i class="fa fa-eye mr-2"></i> View');
    //                 // }
    //             }
    //         },
    //         error: function(xhr) {
    //             console.error('Failed to fetch data');
    //             $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
    //         }
    //     });
    // }


    $('#EscortReviewTable tbody').on('click', '.toggle-report', function(e) {
        e.preventDefault();

        var obj = $(this);
        var tr = obj.closest('tr');
        var row = escortReviewTable.row(tr);

        var dataId = obj.data('id');
        if (row.child.isShown()) {

            var childTr = tr.next('tr');

            childTr.find('td').stop(true, true).slideUp(250, function() {

                row.child.hide();
                tr.removeClass('shown');
                obj.find('i')
                    .removeClass('toggle-report-active')
                    .attr('title', 'View');
            });

            return;
        }

        let routeUrl = "{{ route('user.get-single-user-review-details', ':id') }}"
            .replace(':id', dataId);

        viewReviewReportAjax(row, dataId, routeUrl, obj);
    });


    function viewReviewReportAjax(row, review_id, routeUrl, obj) {

        $.ajax({
            url: routeUrl,
            method: 'GET',
            success: function(response) {
                if (response.error == false) {
                    var childHtml = '';
                    if (response.data.advertiser_type == 'escort') {
                        childHtml = `
                                    <div class="card p-3 border-0">

                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-weight-bold text-blue-primary">
                                                Review Details
                                            </h5>

                                          
                                        </div>

                                        <table class="table mb-0 num_view_table">
                                            <tr>
                                                <th>Escort ID:</th>
                                                <td class="border-0">
                                                    ${response.data.escort.user.member_id}
                                                </td>

                                                <th>Escort’s Name:</th>
                                                <td class="border-0">
                                                    ${response.data.escort.name}
                                                </td>

                                                <th>Mobile:</th>
                                                <td class="border-0">
                                                    ${response.data.escort.user.phone}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Home State:</th>
                                                <td class="border-0">
                                                    ${response.data.escort.user.state.name}
                                                </td>

                                                <th>Status:</th>
                                                <td class="border-0">
                                                    ${capitalizeFirstLetter(response.data.status)}
                                                </td>

                                                <th>Comments:</th>
                                                <td class="border-0">
                                                    ${response.data.description}
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                `;

                    } 
                    else 
                    {
                        childHtml = `
                                    <div class="card p-3 border-0">

                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-weight-bold text-blue-primary">
                                                Review Details
                                            </h5>

                                         
                                        </div>

                                        <table class="table mb-0 num_view_table">
                                            <tr>
                                                <th>Member ID:</th>
                                                <td class="border-0">
                                                    ${response.data.massage.user.member_id}
                                                </td>

                                                <th>Business Name:</th>
                                                <td class="border-0">
                                                    ${response.data.massage.business_name}
                                                </td>

                                                <th>Mobile:</th>
                                                <td class="border-0">
                                                    ${response.data.massage.user.phone}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Home State:</th>
                                                <td class="border-0">
                                                    ${response.data.massage.user.state.name}
                                                </td>

                                                <th>Status:</th>
                                                <td class="border-0">
                                                    ${capitalizeFirstLetter(response.data.status)}
                                                </td>

                                                <th>Comments:</th>
                                                <td class="border-0">
                                                    ${response.data.description}
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                `;
                    }

                    row.child(childHtml).show();

                    var childTr = row.child();

                    childTr.find('td')
                        .hide()
                        .stop(true, true)
                        .slideDown(250);

                   
                    obj.find('i')
                        .addClass('toggle-report-active')
                        .attr('title', 'Close');
                }
            },

            error: function(xhr) {
                console.error('Failed to fetch data');
            }
        });
    }


    $(document).on('click', '#saveReviewInfo', function(e) {
        e.preventDefault();

        var reviewId = $(this).attr('data-review-id');
        var status = $(this).attr('data-review-status');

        $.ajax({
            url: `{{ route('user.user-review-status-update ') }}`, 
            method: 'POST',
            data: {
                'review_id': reviewId,
                'status': status,
            },
            success: function(response) {
                console.log(response);
                if (response.error == false) {
                    if (response.review_status == 'suspended') {
                        $(".success-modal-title").text('Suspended');

                        $(".success-modal-text").text('The review has been successfuly suspended.');

                    } else {
                        $(".success-modal-title").text('Published');
                        $(".success-modal-text").text('The review has been successfuly published.');
                    }

                    $(".success_common_msg").text(response.message);

                    $('#EscortReviewTable').DataTable().ajax.reload(null, false);
                    var myModal = new bootstrap.Modal(document.getElementById('success_modal'));
                    myModal.show();
                }
            },
            error: function(xhr) {
                $('#view-listing .modal-body').html(
                    '<p class="text-danger">Error loading data...</p>');
            }
        });
    });
</script>
@endpush