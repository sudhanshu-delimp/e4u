@extends('layouts.admin')
@section('content')
@section('style')
@endsection
@section('content')

<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    {{-- Page Heading --}}
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Monthly Fee Reports</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="notes"><b>Notes:</b> </p>

                    <ol>
                        <li>This report is a summary of the Operator’s Fee.</li>
                        <li>Agent summary can be viewed here.</li>
                        <li>Payment authorisation procedure must be followed, for Operator to be paid:
                            <ol class="level-2">
                                <li>if report is correct, change status to Paid.
                                </li>
                                <li>produce Payment Authorisation summary. Managing Director to sign off.
                                </li>
                                <li>Payment Authorisation summary processed (by accounts staff).</li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 mt-2">
                    <div id="table-sec" class="table-responsive-xl">
                        <table class="table" id="commissionStatementTable">
                            <thead class="table-bg">
                                <tr>
                                    <th>Date Issued</th>
                                    <th>Billing Period</th>
                                    <th>Territory</th>
                                    <th>Operator</th>
                                    <th>Spend</th>
                                    <th>Fees</th>
                                    <th>Status</th>
                                    <th>Date Approved</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-content"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- View Report --}}
<div class="modal fade upload-modal" id="viewMonthlyReportModel" tabindex="-1" role="dialog"
    aria-labelledby="viewMonthlyReportModelLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                        class="custompopicon"><span id="reportendDate">Fee Report<span></h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>
            <div class="modal-body">
                <!-- content area -->
                <div id="renderMonthlyViewDetail"></div>
                <!-- End content area -->
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.print.monthly.operator.report') }}" method="post" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="fee_print_id" id="fee_print_id" value="">
                    <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </form>
                {{--  <button type="button" class="btn-success-modal" data-dismiss="modal">Query</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal">Approve</button> --}}
            </div>
        </div>
    </div>
</div>
{{-- Raise query --}}
<div class="modal fade upload-modal" id="raiseQueryModel" tabindex="-1" role="dialog"
    aria-labelledby="raiseQueryModelLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                        class="custompopicon"><span id="reportendDate">Query<span></h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>
            <div class="modal-body">
                <form name="queryForm" id="queryForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="fee_id" id="fee_id" value="">
                    <input type="hidden" name="fee_status" id="fee_status" value="">
                    <label class="form-check-label" for="query_note">Query</label>
                    <textarea name="query_note" id="query_note" class="form-control" cols="4" rows="4"></textarea>

                </form>
                <div class="modal-footer">
                    <button type="button" class="print-btn m-0" id="submitQuery">Submit</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- view query --}}
<div class="modal fade upload-modal" id="viewMonthlyQueryModel" tabindex="-1" role="dialog"
    aria-labelledby="viewMonthlyQueryModelLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                        class="custompopicon"><span id="reportendDate">Query<span></h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>
            <div class="modal-body">
                <!-- content area -->
                <div id="renderMonthlyRaiseQuery"></div>
                <!-- End content area -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                    aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Payment Authorisation --}}

<div class="modal fade upload-modal" id="payAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="payAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->


            <div class="modal-header">

                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/auth.png') }}"
                        class="custompopicon"> Payment Authorisation</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}">
                </a>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 20px;">

                <table class="w-100 table opr_modal_table">
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Operator ID: </td>
                        <td><span id="payOperatorId"></span></td>
                        <td style="font-weight: bold; color: #001f4d;">Date:</td>
                        <td><span id="payMonthlyReportDate"></span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Fee Total:</td>
                        <td>$<span id="payOperatorFee"></span></td>
                        <td style="font-weight: bold; color: #001f4d;">Month:</td>
                        <td><span id="payMonthlyReportMonth"></span></td>
                    </tr>
                </table>

                <p>
                    The Fee for the month is authorised for payment into the
                    Operator’s nominated Bank Account.
                </p>

                <p style="margin-top: 25px;">
                    Managing Director: <span
                        style="display: inline-block; border-bottom: 1px solid #000; width: 200px;"></span>
                </p>

                <hr style="margin: 20px 0;">

                <div style="text-align: right;">
                            <form action="{{ route('admin.operator.print.pay-detail') }}" method="post" target="_blank">
                                {{ csrf_field() }}
                                <input type="hidden" name="monthly_report_id" id="monthly_report_id" value="">
                                <button type="submit" class="btn-success-modal">Print</button>
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                                    Close
                                </button>
                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>

{{-- end --}}
@endsection
@push('script')
<!-- opr_accordian_table JS -->

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
</script>

<script>
    $(document).ready(function() {
        var table = $('#commissionStatementTable').DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Operator ID",
            },
            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: false,
            bStateSave: false,

            ajax: {
                url: "{{ route('admin.operator.monthly-report-ajax') }}",
                data: function(d) {
                    d.type = 'player';
                }
            },
            order: [
                [0, 'DESC']
            ],
            columns: [{
                    data: 'reportDate',
                    name: 'reportDate',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'billing_period',
                    name: 'billing_period',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },

                {
                    data: 'territory',
                    name: 'territory',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                 {
                    data: 'operator_member_id',
                    name: 'operator_member_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'total_spend',
                    name: 'total_spend',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'total_fees',
                    name: 'total_fees',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'status_name',
                    name: 'status_name',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'report_pproved_date',
                    name: 'report_pproved_date',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
        });

        $('#commissionStatementTable_filter input')
            //.off()
            .on('keyup', function() {
                var value = $(this).val();

                if (value.length >= 2 || value.length === 0) {
                    table.search(value).draw();
                }
            });

        /*** call monthly detail */
        $(document).on('click', '#getMontlyViewReportPage', function() {
            let id = $(this).data('id');
            var url = "{{ route('admin.operator.view.monthly.detail') }}";
            $('#viewMonthlyReportModel').modal('show');
             $.ajax({
                 url: url,
                 method: 'POST',
                 data: {
                     id: id,
                     _token: '{{ csrf_token() }}'
                 },
                 success: function(response) {
                     if ($.trim(response) === "") {
                         swal_error_popup("Monthly fee report data not found.");
                     } else {
                         $("#fee_print_id").val(id);
                         $('#renderMonthlyViewDetail').html(response);
                         $('#viewMonthlyReportModel').modal('show');
                     }
                 },
                 error: function() {
                     alert("Error loading form");
                 }
             });
        });

        $(document).on('click', '#openQueryModel', function() {
            $('#queryForm')[0].reset();
            let id = $(this).data('id');
            let status = $(this).data('status');
            $('#fee_id').val(id);
            $('#fee_status').val(status);
            $('#raiseQueryModel').modal('show');
        });

        /*** call monthly detail */
        $(document).on('click', '#updateMonthlyReportStatus', async function(e) {

            let id = $(this).data('id');
            let status = $(this).data('status');
            note = "";
            submitStatus(table, id, status, note);

        });

        /*** call monthly detail */
        $(document).on('click', '#submitQuery', async function(e) {

            let id = $('#fee_id').val();
            let status = $('#fee_status').val();
            let note = $('#query_note').val();
            submitStatus(table, id, status, note);

        });

        /*** Query detail */
        $(document).on('click', '.getSubmittedQuery', function() {
            let id = $(this).data('id');
            let agent_id = $(this).data('agent_id');
            var url = "{{ route('admin.operator.view.query') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                    agent_id: agent_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if ($.trim(response) === "") {
                        swal_error_popup("Query not found.");
                    } else {

                        $('#renderMonthlyRaiseQuery').html(response);
                        $('#viewMonthlyQueryModel').modal('show');
                    }
                },
                error: function() {
                    alert("Error loading form");
                }
            });
        });

        $(document).on('click', '#viewPayOperatorRreport', function() {
            $('#queryForm')[0].reset();
            let id = $(this).data('id');
            let status = $(this).data('status');
            $('#monthly_report_id').val(id);
            var url = "{{ route('admin.operator.view.pay-detail') }}";

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    report_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.error == 1) {
                        swal_error_popup("Data not found.");
                    } else {
                        $('#payOperatorId').text(response.data.operatorId);
                        $('#payMonthlyReportDate').text(response.data.payMonthlyReportDate);
                        $('#payMonthlyReportMonth').text(response.data.payMonthlyReportMonth);
                        $('#payOperatorFee').text(response.data.payOperatorFee);

                        $('#payAgentreport').modal('show');
                    }
                },
                error: function() {
                    swal_error_popup("Error occurred while fetching the data.");
                }
            });

        });
    });

    async function submitStatus(table, id, status, note) {
        if (await isConfirm({
                'action': 'Update',
                'text': 'Are you sure you want to update status?'
            })) {
            var url = "{{ route('admin.operator.update.status.detail') }}";
            url = url.replace(':id', id);
            url = url.replace(':status', status);
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                    status: status,
                    note: note,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.close();
                    $('#raiseQueryModel').modal('hide');
                    if (response.status) {
                        table.ajax.reload(null, false);
                        swal_success_popup(response.message);
                    } else {
                        swal_error_popup(response.message);
                    }
                },
                error: function() {
                    alert("Error occurred while updating the status.");
                }
            });
        }
    }
</script>
@endpush
