@extends('layouts.admin')
@section('style')
<style type="text/css">
    .table td,
    .table th {
        vertical-align: baseline !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Punterbox Reports</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                </h6>
            </div>

        </div>

        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>Punterbox Reports is a consolidation of reports made by Viewers (<b>Report</b>) on
                            Advertisers. Reports are to be actioned within 24 hours.</li>
                        <li>To action a Report, other than approval (publish) or rejected, the Viewer’s consent
                            must be obtained. Where a Report, in the view of administration staff, needs to be
                            amended, the Report can be amended and the amendment forwarded to the Viewer
                            for approval (Support Ticket). The Member can not be contacted by phone.</li>
                    </ol>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="stats-container">
                <div class="stat-card-wrapper">
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                            <div class="stat-label">Today</div>
                        </div>
                        <div class="stat-number today_report">2</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                            <div class="stat-label">This Month</div>
                        </div>
                        <div class="stat-number month_report">25</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="stat-label">This Year</div>
                        </div>
                        <div class="stat-number year_report">125</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-label">All Time</div>
                        </div>
                        <div class="stat-number all_time_report">1258</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="table-responsive">
                <table class="table" id="PunterboxReportTable">
                    <thead class="table-bg">
                        <tr>
                            <th>Ref</th>
                            <th>Member ID</th>
                            <th>Member</th>
                            <th>Incident Date</th>
                            <th>Incident Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tr>
                        <th colspan="7" class="border-0"></th>
                    </tr>
                    <tfoot class="bg-first t-foot">
                        <tr>
                            <th colspan="3" class="text-left border-0">Server time: <span class="serverTime">{{date('d-m-Y h:i a')}}</span></th>
                            <th colspan="1" class="text-center border-0">Refresh time:<span class="refreshSeconds"> 15</span></th>
                            <th colspan="3" class="text-right border-0" style="text-align: right!important;">Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade upload-modal" id="success_popup" tabindex="-1" role="dialog"
    aria-labelledby="confirmPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved" class="custompopicon">
                    <span class="success-modal-title">Resolved</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h6 class="popu_heading_style mt-2">
                    <span class="Lname success-modal-text">We're happy to inform you that your query has been <br>
                        successfully resolved.</span>
                </h6>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>


{{-- add notes  --}}
<div class="modal fade upload-modal" id="add-note-popup" tabindex="-1" role="dialog"
    aria-labelledby="confirmPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/add-task.png') }}" alt="resolved"
                        class="custompopicon">
                    Add Note
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <!-- Notes -->
                    <div class="form-group mb-3">
                        <label for="notes"><strong>Notes:</strong></label>
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter notes here..."></textarea>
                    </div>


                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Enter name">
                    </div>

                    <!-- Signature -->
                    <div class="form-group mb-3">
                        <label for="signature"><strong>Signature:</strong></label>
                        <input type="text" id="signature" name="signature" class="form-control"
                            placeholder="Enter signature">
                    </div>
                    <!-- Management Only Section -->
                    <div class="form-group mb-3 d-flex align-items-center justify-content-start gap-10">
                        <label><strong>Management Only:</strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="cancelMembership"
                                name="management_action" value="cancel">
                            <label class="form-check-label" for="cancelMembership">Cancel Membership</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="reinstateMembership"
                                name="management_action" value="reinstate">
                            <label class="form-check-label" for="reinstateMembership">Re-instate Membership</label>
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-cancel-modal px-4" data-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal"
                    aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade upload-modal" id="viewMemberdetails" tabindex="-1" role="dialog"
    aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
<div class="modal fade upload-modal" id="rejectRegReason" tabindex="-1" role="dialog"
    aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>

<!-- ****** for reject registration confirm pop-up*********** -->
<div class="modal fade upload-modal" id="reject-registration-confirm-popup" tabindex="-1" role="dialog"
    aria-labelledby="confirmPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <input type="hidden" id="status_data_value">
                <input type="hidden" id="user_id">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                        class="custompopicon">
                    <span>Confirmation</span>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h5 class="popu_heading_style mt-2" id="popu_heading_style">
                    Are you sure you want to perform this action.
                </h5>

            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">

                <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                    aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal"
                    data-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
</div>

{{-- end notes --}}

{{-- confirm modal --}}
<div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <input type="hidden" id="status_data_id">
                <input type="hidden" id="status_data_value">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved" class="custompopicon">
                    <span>Confirmation <span class="ref_clas"></span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body teop-text text-center">
                <h5 class="custom_modal_text">
                    <span id="Lname">Are you sure you want to <span class="add_review_title"></span> this Report?</span>
                    <div class="mx-auto w-75 my-3 action_reason_div" style="display: none;">
                        <select name="action_reason" class="form-control " id="action_reason" style="color: #525a64;">
                            <option value="Report is not factual" selected>Report is not factual</option>
                            <option value="Report does not comply with Code of Conduct">Report does not comply with Code of Conduct</option>
                            <option value="Inappropriate language">Inappropriate language</option>
                            <option value="Report is slanderous">Report is slanderous</option>
                        </select>
                    </div>

                </h5>

            </div>

            <div class="modal-footer justify-content-center pt-0">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div>


{{-- published modal --}}
<div class="modal fade upload-modal" id="confirm_publish_popup" tabindex="-1" role="dialog"
    aria-labelledby="confirmPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center " id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/published.png') }}" id="custompopicon" alt="published"
                        class="custompopicon">
                    <span class="success-modal-title">Published</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body text-center">
                <h6 class="popu_heading_style mt-2">
                    <span id="" class="success-modal-text">We’re happy to inform you that your query
                        has been <br> successfully resolved.</span>
                </h6>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal"
                    aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')

<script>
    $(document).ready(function() {
        let countdown = 15;
        setInterval(() => {
            countdown--;
            $(".refreshSeconds").text(' ' + countdown);

            if (countdown <= 0) {
                $('#PunterboxReportTable').DataTable().ajax.reload(null, false);
                countdown = 15;

            }

        }, 1000);

        $('#customSearch').on('keyup', function() {
            $('#PunterboxReportTable').DataTable().search(this.value).draw();
        });

        // Initialize DataTable
        var table = $('#PunterboxReportTable').DataTable({

            "language": {
                "zeroRecords": "No Record Found!",
                searchPlaceholder: "Search by Member ID"
            },
            paging: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            order: [],
            lengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100]
            ],
            ordering: true,
            columnDefs: [{
                targets: 5,
                type: "status"
            }, ],
            ajax: {
                url: "{{ route('admin.punterbox.ajax') }}",
                type: "GET",
                dataSrc: function(json) {
                    console.log("Received Data:", json); // Debug here
                    $(".today_report").text(json.counts.today);
                    $(".month_report").text(json.counts.this_month);
                    $(".year_report").text(json.counts.this_year);
                    $(".all_time_report").text(json.counts.all_time);
                    $('.serverTime').text(json.server_time);
                    $('.uptimeClass').html(json.server_up_time);
                    return json.data; // Return the data array for DataTables to render
                }
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'member_id',
                    name: 'member_id'
                },
                {
                    data: 'escorts_name',
                    name: 'escorts_name'
                },
                {
                    data: 'incident_date',
                    name: 'incident_date'
                },
                {
                    data: 'location',
                    name: 'location',
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    type: 'status',
                    orderable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                }
            ]
        });

        // Handle expand/collapse
        $('#PunterboxReportTable tbody').on('click', '.view_report', function(e) {
            e.preventDefault();

            const tr = $(this).closest('tr');
            const row = table.row(tr);

            if (row.child.isShown()) {
                row.child().find('.child-wrapper').slideUp(250, function() {
                    row.child.hide();
                    tr.removeClass('shown');
                });

                $(this).removeClass('open');
            } else {
                row.child(
                    '<div class="child-wrapper" style="display:none;">' +
                    format(row.data()) +
                    '</div>'
                ).show();

                row.child().find('.child-wrapper').slideDown(250);

                tr.addClass('shown');
                $(this).addClass('open');
            }
        });

        // CLOSE BUTTON HANDLER (only closes, no toggle)
        $(document).on('click', '.close_report_btn', function(e) {
            e.preventDefault();

            const childTr = $(this).closest('tr');
            const parentTr = childTr.prev();
            const row = table.row(parentTr);

            childTr.find('.child-wrapper').slideUp(250, function() {
                row.child.hide();
                parentTr.removeClass('shown');
                parentTr.find('.view_report').removeClass('open');
            });
        });

        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function format(data) {
            return `
                    <div class="details-content p-3 bg-light border rounded">
                        <div class="mb-3 d-flex justify-content-end">
                            <button class="btn-sm btn-cancel-modal close_report_btn" type="button"> Close</button>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Ref:</th>
                                    <td class="border-0">${data.ref ?? 'N/A'}</td>
                                    <th>Incident Date:</th>
                                    <td class="border-0">${data.incident_date ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Member ID:</th>
                                    <td class="border-0">${data.user.member_id ?? 'N/A'}</td>
                                    <th>Member Name:</th>
                                    <td class="border-0">${data.user.name ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Type:</th>
                                    <td class="border-0">${data.incident_nature ?? 'N/A'}</td>
                                    <th>Location:</th>
                                    <td class="border-0">${data.location ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Create:</th>
                                    <td class="border-0">${formatDate(data.created_at) ?? 'N/A'}</td>
                                    <th>Status:</th>
                                    <td class="border-0">
                                        ${data.status ? data.status.replace(/<[^>]*>/g, '') : 'N/A'}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Summary of Incident:</th>
                                    <td colspan="3" class="border-0">${data.what_happened ?? 'N/A'}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
        }

        $(document).on('click', '.update_status', function(e) {
            e.preventDefault();
            let reportId = $(this).data('id');
            let status = $(this).data('status');
            let ref = $(this).data('ref');
            //let st = status == 'published' ? 'publish' : 'reject';
            $(".action_reason_div").css('display', 'none');
            if (status == 'on_hold') {
                st = 'mark as on hold';
            } else if (status == 'rejected') {
                st = 'reject';
                $(".action_reason_div").css('display', 'block');
            } else if (status == 'pending') {
                st = 'pending';
            } else {
                st = 'publish';
            }

            $('#status_data_id').val(reportId);
            $('#status_data_value').val(status);
            $('.add_review_title').text(st);
            console.log(reportId, status);

        });

        $(document).on('click', '.saveStatus', function(e) {
            e.preventDefault();
            let reviewId = $('#status_data_id').val();
            let status = $('#status_data_value').val();
            let action_reason = $('#action_reason').val();
            var reviewData = {
                'id': reviewId,
                'status': status,
                'action_reason': action_reason,
            }

            $(".action_reason_div").css('display', 'none');

            let imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
            if (status == 'published') {
                $(".success-modal-title").text('Published');
                imageUrl = '{{ asset("assets/dashboard/img/published.png") }}';
                $("#custompopicon").attr('src', imageUrl);

                $(".success-modal-text").text('This report is now Published');

            } else if (status == 'rejected') {
                $(".success-modal-title").text('Rejected');
                imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
                $("#custompopicon").attr('src', imageUrl);
                $(".success-modal-text").text('This report is now Rejected.');
                $(".action_reason_div").css('display', 'block');
            } else if (status == 'on_hold') {
                $(".success-modal-title").text('On Hold');
                $("#custompopicon").attr('src', imageUrl);
                $(".success-modal-text").text('This report is now On Hold.');
            } else {
                $(".success-modal-title").text('Pending');
                $("#custompopicon").attr('src', imageUrl);
                $(".success-modal-text").text('We’re sorry to inform you that your report has been updated to pending.');
            }

            var url = "{{route('admin.punterbox.status.ajax')}}";
            updateMemberReportStatus(reviewData, url);
        });

        function updateMemberReportStatus(reportData, routeUrl) {
            const reportId = $(this).data('id');

            $.ajax({
                url: routeUrl, // replace with your actual route
                method: 'POST',
                data: {
                    'id': reportData.id,
                    'status': reportData.status,
                    'action_reason': reportData.action_reason,
                },
                success: function(response) {
                    if (response.error == false) {

                        $('#PunterboxReportTable').DataTable().ajax.reload(null, false);
                        $("#confirm_publish_popup").modal('show');
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