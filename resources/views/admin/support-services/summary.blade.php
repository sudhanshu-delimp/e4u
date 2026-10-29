@extends('layouts.admin')

@section('style')
@stop

@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Summary</h1>

            <span class="helpNoteLink font-weight-bold"
                data-toggle="collapse"
                data-target="#notes"
                aria-expanded="true">
                Help?
            </span>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>View transaction details using View Summary.</li>
                        <li>Use View Invoice to view and print the tax invoice.</li>
                        <li>All tax invoices should be attached to the confirmation email.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive common-card">
                <table class="table w-100" id="transactionSummaryTable">
                    <thead class="table-bg">
                        <tr>
                            <th>Ref</th>
                            <th>Service Type</th>
                            <th>Transaction Date</th>
                            <th>Transaction Value (Inc. GST)</th>
                            <th>Card</th>
                            <th>Completed By</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>2026061900113</td>

                            <td>
                                <div class="profile_list">
                                    <span class="text-ellipsis"
                                        style="max-width: 135px;">
                                        Complete Media Verification
                                    </span>

                                    <a class="badge badge-warning"
                                        href="javascript:void(0)"
                                        data-toggle="modal"
                                        data-target="#view-listing"
                                        id="selectedServices">
                                        6 more
                                    </a>
                                </div>
                            </td>

                            <td>19 Jun 2026, 06:00 PM</td>
                            <td>$44.41</td>
                            <td>XXXX-XXXX-XXXX-0000</td>
                            <td>E60511</td>

                            <td class="text-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>

                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">

                                        <a class="dropdown-item d-flex align-items-center"
                                            href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#view-listing">
                                            <i class="fa fa-eye mr-2"></i>
                                            View Summary
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#view-invoice">
                                            <i class="fa fa-file-invoice mr-2"></i>
                                            View Invoice
                                        </a>

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

<!-- Existing Transaction Summary modal: preserve existing functionality -->
@include('admin.support-services.modal.transaction-summary')



@endsection

@push('script')
<script>
    // Existing DataTable configuration preserved.
    var table = $("#transactionSummaryTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Ref, Service Type, Card"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,

        columns: [{
                data: 'ref_no',
                name: 'ref_no',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'service',
                name: 'service',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'transaction_at',
                name: 'created_at',
                searchable: false,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'amount',
                name: 'amount',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'card',
                name: 'card',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'completed_by_member_id',
                name: 'completed_by',
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
        order: [2, 'desc'],
    });

    addTooltip('#selectedServices', 'Click me to View More', 'top', 'center');


    $('#printInvoiceBtn').on('click', function() {
        $('body').addClass('invoice-printing');
        window.print();
    });

    window.addEventListener('afterprint', function() {
        $('body').removeClass('invoice-printing');
    });


    $('#view-invoice').on('hidden.bs.modal', function() {
        $('body').removeClass('invoice-printing');
    });
</script>
@endpush