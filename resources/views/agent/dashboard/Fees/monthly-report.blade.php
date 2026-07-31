@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
    <style>
        .swal2-title {
            font-size: 1.145em !important;

        }
    </style>
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->

        <div class="row">
            {{-- Page Heading   --}}
            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Monthly Report</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>
                                The following definitions are from the Agent Agreement and apply for the purpose of
                                calculating the Fee:
                                <ol class="level-2">
                                    <li><b>Fees</b> mean the fees calculated pursuant to Item 5 of Schedule 1 and payable
                                        pursuant to clause 9.1.</li>
                                    <li><b>Monthly Report</b> means the online report summarising all the activities for
                                        that
                                        month for Signed Up Advertisers which the calculation of the Fees for that month
                                        will be based on.</li>
                                </ol>
                            </li>
                            <li>
                                The Fees will be paid to you, by the Operator, within seven Business Days of the
                                Monthly Report having been approved by you, provided:
                                <ol class="level-2">
                                    <li>you have confirmed the correctness of the Monthly Report within three days;</li>
                                    <li>where a query is raised in respect of the Monthly Report, the Fee corresponding
                                        to the Query will be separated from the Report and remain in escrow until the query
                                        is resolved (<b>Resolved Query</b>); and</li>
                                    <li>a Resolved Query will be included in the following Monthly Report.</li>
                                </ol>
                            </li>
                            <li>All Fees paid to you under the Agent Agreement will be paid into your nominated Bank
                                Account, by the Operator. Fees are inclusive of GST.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive-xl">
                    <table class="table " id="commissionStatementTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Report Date</th>
                                <th>Billing Period</th>
                                {{-- <th>Agent ID</th>
                     <th>Territory</th> --}}
                                <th>Spend</th>
                                <th>Fees</th>
                                <th>Status</th>
                                <th>Report Approved</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-content"></tbody>

                    </table>

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
                        <form action="{{ route('agent.print.monthly.fee') }}" method="post" target="_blank">
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
                         <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('script')
        <!-- file upload plugin start here -->
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
        </script>

        <script>
            $(document).ready(function() {
                var table = $('#commissionStatementTable').DataTable({
                    language: {
                        search: "Search: _INPUT_",
                        searchPlaceholder: "Search by status",
                    },
                    processing: true,
                    serverSide: true,
                    lengthChange: true,
                    searchable: false,
                    bStateSave: false,

                    ajax: {
                        url: "{{ route('agent.fees.monthly-report-ajax') }}",
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
                        /*{ data: 'agent_id', name: 'agent_id', searchable: true, orderable:true ,defaultContent: 'NA'},
                        { data: 'territory', name: 'territory', searchable: true, orderable:true ,defaultContent: 'NA'},*/
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
                    .off()
                    .on('keyup', function() {
                        var value = $(this).val();

                        if (value.length >= 2 || value.length === 0) {
                            table.search(value).draw();
                        }
                    });

                /*** call monthly detail */
                $(document).on('click', '#getMontlyViewReportPage', function() {
                    let id = $(this).data('id');
                    let agent_id = $(this).data('agent_id');
                    var url = "{{ route('agent.fees.view.detail') }}";
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
                    var url = "{{ route('agent.fees.view.query') }}";
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
            });

            async function submitStatus(table, id, status, note) {
                if (await isConfirm({
                        'action': 'Update',
                        'text': 'Are you sure you want to update status?'
                    })) {
                    var url = "{{ route('agent.fees.update.status.detail') }}";
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
