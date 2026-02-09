@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<style>
    .paging_simple_numbers {
        margin-top: 18px;
    }

    /* .dataTables_info{
    margin-top: 18px;
 } */
    .table-report-info tr td {
        border: 0;
    }

    .table-report-info th {
        border-top: 0px solid #dee2e6 !important;
    }

    .popu_heading_style {
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 29px;
        color: #0C223D;
    }
</style>
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Feedback</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="stats-container">
                            <div class="stat-card-wrapper">
                                <div class="stat-card">
                                    <div class="stat-top">
                                        <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                                        <div class="stat-label">New Today</div>
                                    </div>
                                    <div class="stat-number">{{$todayCount}}</div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-top">
                                        <div class="stat-icon"> <i class="far fa-clock" aria-hidden="true"></i></div>
                                        <!-- <div class="stat-icon"><i class="fas fa-calendar-week"></i></div> -->
                                        <div class="stat-label">Pending</div>
                                    </div>
                                    <div class="stat-number" id="pendingFeedback">{{$pendingCount}}</div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-top">
                                        <div class="stat-icon"><i class="fa fa-check"></i></div>
                                        <div class="stat-label">Completed</div>
                                    </div>
                                    <div class="stat-number" id="complatedFeedback">{{$completedCount}}</div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-top">
                                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                        <div class="stat-label">All Time</div>
                                    </div>
                                    <div class="stat-number">{{$totalCount}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Feedback is generated from the public Website.</li>
                                    <li>When Feedback is received, print and refer the Feedback to the Managing
                                        Director.</li>
                                    <li>No action is to be taken on Feedback without the Managing Director’s approval.
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel with-nav-tabs panel-warning">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="tab1warning">
                                        <div class="table-responsive-xl">
                                            <table class="table" id="feedbackReportTable">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">Ref </th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="print-feedback-report">
                        <div class="my-account-card">
                            <div class="card-head">
                                <h2 class="font-weight-bold">My Report Information </h2>
                                <button class="print-btns" type="button"><i class="fa fa-print"></i> Print Report</button>
                                <input type="hidden" id="printReportId" value="">
                            </div>
                            <table class="table  w-100 table-report-info">
                                <tr class="details-row">
                                    <td colspan="7">
                                        <div>
                                            <table class="table border-0 table-report-info">
                                                <tbody>
                                                    <tr>
                                                        <th>Ref:</th>
                                                        <td class="ref">#30</td>
                                                        <th>Date:</th>
                                                        <td class="report_member_id">14-05-2025</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Subject:</th>
                                                        <td class="report_type">14-05-2025</td>
                                                        <th>Option:</th>
                                                        <td class="report_viewer_id">14-05-2025</td>


                                                        {{-- <th>Status:</th>
                                  <td class="report_viewer_id">14-05-2025</td> --}}
                                                        {{-- <td class="report_escort_id">14-05-2025</td> --}}

                                                    </tr>

                                                    <tr>
                                                        <th>Email:</th>
                                                        <td class="report_advertiser_id">14-05-2025</td>
                                                        <th>Comment:</th>
                                                        <td class="report_stage_name">WA - Perth</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="notes-section">
                                <div class="notes-label">Notes:</div>
                                <div class="lines"></div>
                                <div class="lines"></div>
                                <div class="lines"></div>
                                <div class="lines"></div>
                                <div class="lines"></div>

                                <div class="mt-5 table-responsive">
                                    <table style="width:100%; border-collapse:collapse;">
                                        <tr>
                                            <td colspan="2" style="border:1px solid #000; padding:8px; font-weight:bold;">Management only:</td>
                                            <td colspan="2" style="border:1px solid #000; padding:8px;">
                                                <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                                    <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Action feedback</span>
                                                </label>
                                            </td>
                                            <td colspan="2" style="border:1px solid #000; padding:8px;">
                                                <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                                    <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Dismiss feedback</span>
                                                </label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1" style="border:1px solid #000; padding:25px 12px; font-weight:bold; width:110px;" colspan="1">Name:</td>
                                            <td colspan="2" style="border:1px solid #000; padding:25px 12px;"></td>
                                            <td colspan="1" style="border:1px solid #000; padding:25px 12px; font-weight:bold; width:120px">Signature:</td>
                                            <td colspan="2" style="border:1px solid #000; padding:25px 12px;"></td>
                                        </tr>
                                    </table>



                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- confirm modal here  -->

<div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel" aria-modal="true" style="padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <input type="hidden" id="status_data_id" value="334">
                <input type="hidden" id="status_data_value" value="7">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{asset('assets/dashboard/img/question-mark.png')}}" alt="resolved" class="custompopicon">
                    <span>Confirmation</span>
                </h5>
                <input type="hidden" id="status_data_id" name="status_data_id" value="">
                <input type="hidden" id="status_data_value" name="status_data_value" value="">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h5 class="popu_heading_style mt-2">
                    Are you sure you want to perform this action.
                </h5>

            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">

                <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
</div>

<!-- confirm modal end here -->

<!-- end -->
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
confirm-popup
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
</script>

<script>
    $(document).ready(function() {
        $("#print-feedback-report").slideUp();
        var table = $("#feedbackReportTable").DataTable({
            processing: true,
            serverSide: true,
            lengthChange: true,
            searching: true,
            bStateSave: false,

            ajax: {
                url: "{{ route('admin.feedback.dataTable') }}",
                type: 'GET',
                dataType: 'json'
            },

            columns: [{
                    data: 'ref_number',
                    name: 'ref_number',
                    defaultContent: 'NA'
                },
                {
                    data: 'date',
                    name: 'date',
                    defaultContent: 'NA'
                },
                {
                    data: 'subject',
                    name: 'subject',
                    defaultContent: 'NA'
                },
                {
                    data: 'email',
                    name: 'email',
                    defaultContent: 'NA'
                },
                {
                    data: 'status',
                    name: 'status',
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            order: [
                [0, 'desc']
            ],
            pageLength: 10
        });


        $('#feedbackReportTable').on('init.dt', function() {
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'Search by Ref, subject, email, or status');
        });

        $(document).off('click', '.completed_btn');
        let feedbackID = null;
        $(document).on('click', '.completed_btn', function() {
            feedbackID = $(this).attr('data-id');
            $('#confirm-popup').modal('show');
        });

        $('.saveStatus').click(function() {
            $.ajax({
                url: '{{route("admin.feedback.status.change")}}',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: feedbackID,
                    status: 2,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data.completed);
                    feedbackID = null;
                    $('#feedbackReportTable').DataTable().ajax.reload(null, false);
                    $(".head_modal_title").html("Feedback Updated");
                    $('.comman_msg').html("The feedback status has been successfully changed to Completed.");
                    $('#comman_modal').modal('show');
                    $('#pendingFeedback').text(data.pending);
                    $('#complatedFeedback').text(data.completed);
                }
            })
        });



        $(document).on('click', '.view-feedback-btn', function(e) {
            e.preventDefault();

            // Get the data-id value
            var feedbackId = $(this).data('id');
            $("#printReportId").val(feedbackId);
            let routeUrl = '{{route("admin.feedback-reports-ajax")}}';
            $("#print-feedback-report")
                .stop(true, true)
                .slideUp(0)
                .slideDown(800);

            $('html, body').animate({
                scrollTop: $("#print-feedback-report").offset().top
            }, 500);

            viewFeedbackReportAjax(feedbackId, routeUrl);

        });

        function viewFeedbackReportAjax(feedbackId, routeUrl) {
            $.ajax({
                url: routeUrl, // replace with your actual route
                method: 'GET',
                data: {
                    'feedback_id': feedbackId
                },
                success: function(response) {
                    if (response.error == false) {
                        let status = (response.data.report_status == 'pending') ? 'Current' : response.data.report_status;
                        $(".ref").text('#' + response.data.id + '' + response.data.escort_id);
                        $(".report_date").text(response.data.formatted_created_at);
                        $(".report_member_id").text(response.data.escort.user.member_id);
                        $(".report_escort_id").text(response.data.escort_id);
                        $(".report_viewer_id").text(response.data.viewer_id);
                        $(".report_status").text(capitalizeFirstLetter(status));
                        $(".report_home_state").text(response.data.escort.user.state_id);
                        $(".report_comment").text(capitalizeFirstLetter(response.data.report_desc));
                        $(".report_mobile").text(response.data.escort.user.phone);
                        $(".report_viewer_mobile").text(response.data.viewer.phone);
                        $(".report_stage_name").text(response.data.escort.name);
                        $(".report_type").text(response.data.report_tag);
                        $(".report_advertiser_id").text(response.data.escort_id);
                    }
                },
                error: function(xhr) {
                    console.error('Failed to fetch data');
                    $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                }
            });
        }
    });
</script>
@endpush