@extends('layouts.admin')
@section('content')
@section('style')
@endsection


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
{{-- Payment Authorisation --}}

<div class="modal fade upload-modal" id="payAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="payAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->


            <div class="modal-header">
                
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/auth.png') }}" class="custompopicon"> Payment Authorisation</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/app/img/newcross.png')}}">
                </a>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 20px;">

                <table class="w-100 table opr_modal_table">
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Operator ID: </td>
                        <td>A600025</td>
                        <td style="font-weight: bold; color: #001f4d;">Date:</td>
                        <td>01-10-25</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Fee Total:</td>
                        <td>$237.45</td>
                        <td style="font-weight: bold; color: #001f4d;">Month:</td>
                        <td>Oct</td>
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

                <div style="text-align:right;">

                   

                    <button type="button" class="btn-success-modal">Print</button>
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end --}}

{{-- View Report --}}

<div class="modal fade upload-modal" id="viewAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="viewAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                 
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon">  Fee Report by Agent (Period Ending: 31-10-25)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/app/img/newcross.png')}}">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0 common_accordian_table">
                    <thead class="table-bg modal-thaed">
                        <tr>
                            <th>Agent ID</th>
                            <th>Name</th>
                            <th>Territory</th>
                            <th>Type</th>
                            <th>Days</th>
                            <th>Spend</th>
                            <th>Fee</th>
                        </tr>
                    </thead>

                   
                    <tbody id="accordionParent">

                        <!-- ========= MEMBER 1 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details1"
                            aria-expanded="false" aria-controls="details1">
                            <td class="text-left">A10044</td>
                            <td class="opr_expand_arrow">Business 01 <i class="fa fa-chevron-down"></i></td>
                            <td>ACT</td>
                            <td></td>
                            <td>65</td>
                            <td class="text-left">
                                <div class="num_value">$<span>1,583.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>79.15</span></div>
                            </td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left">
                                <div class="num_value">$<span>176.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.80</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left">
                                <div class="num_value">$<span>24.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>1.20</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>0.40</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left">
                                <div class="num_value">$<span>475.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>23.75</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                            <td style="border-top: 1px solid #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.00</div>
                            </td>
                            </td>
                        </tr>
                       
                         <tr class="detail-row" data-group="details1">
                             <td colspan="3"></td>
                            <td class="text-center">MC</td>
                            <td>30
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>900.00</div>
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>45.00</div>
                            </td>
                            </td>
                        </tr>
                         <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">65
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,583.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>79.15</div>
                            </td>
                            </td>
                        </tr>
                        {{-- end Member 1 --}}
                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>





                        <!-- ========= MEMBER 2 ========= -->
                        
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2"
                            aria-expanded="false" aria-controls="details2">
                            <td class="text-left">A10056</td>
                            <td class="opr_expand_arrow">Business 02 <i class="fa fa-chevron-down"></i></td>
                            <td>NSW</td>
                            <td></td>
                            <td>65</td>
                            <td class="text-left">
                                <div class="num_value">$<span>1,583.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>79.15</span></div>
                            </td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left">
                                <div class="num_value">$<span>176.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.80</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left">
                                <div class="num_value">$<span>24.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>1.20</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>0.40</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left">
                                <div class="num_value">$<span>475.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>23.75</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                            <td style="border-top: 1px solid #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.00</div>
                            </td>
                            </td>
                        </tr>
                       
                         <tr class="detail-row" data-group="details2">
                             <td colspan="3"></td>
                            <td class="text-center">MC</td>
                            <td>30
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>900.00</div>
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>45.00</div>
                            </td>
                            </td>
                        </tr>
                         <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">65
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,583.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>79.15</div>
                            </td>
                            </td>
                        </tr>
                        {{-- end Member 2 --}}

                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Agents:</strong></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">135
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>3,166.00</div>
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>158.30</div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <!-- ========= total ========= -->

                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="6" class="text-right"><strong>Operator Fee:</strong></td>
                            
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>158.30</div>
                            </td>
                        </tr>

                    </tfoot>
                </table>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Print</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- end --}}
@endsection
@push('script')
<!-- opr_accordian_table JS -->
        <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
        

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const target = toggle.getAttribute('data-target').replace('#', '');
            const openGroup = document.querySelectorAll(`.detail-row[data-group="${target}"]`);
            const isOpen = openGroup[0]?.classList.contains('show');

            // Close all open groups
            document.querySelectorAll('.detail-row.show').forEach(r => {
                r.classList.remove('show');
            });

            // Open current group if not already open
            if (!isOpen) {
                openGroup.forEach(r => r.classList.add('show'));
            }

            // Rotate arrow
            document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
            'rotated'));
            if (!isOpen) toggle.querySelector('i').classList.add('rotated');
        });
    });
</script>

<script>
            $(document).ready(function() {
                var table = $('#commissionStatementTable').DataTable({
                    language: {
                        search: "Search: _INPUT_",
                        searchPlaceholder: "Search by agent ID",
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
                    var url = "{{ route('admin.operator.view.detail') }}";
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
                    var url = "{{ route('admin.fees.view.query') }}";
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

                $(document).on('click', '#viewPayAgentreport', function() {
                    $('#queryForm')[0].reset();
                    let id = $(this).data('id');
                    let status = $(this).data('status');
                    $('#monthly_report_id').val(id);
                    //$('#fee_status').val(status);
                    var url = "{{ route('admin.fees.view.pay-detail') }}";

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
                                $('#payAgentId').text(response.data.payAgentId);
                                $('#payMonthlyReportDate').text(response.data.payMonthlyReportDate);
                                $('#payMonthlyReportMonth').text(response.data
                                    .payMonthlyReportMonth);
                                $('#payAgenFee').text(response.data.payAgenFee);

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
                    var url = "{{ route('admin.fees.update.status.detail') }}";
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
