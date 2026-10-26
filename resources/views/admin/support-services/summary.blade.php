
@extends('layouts.admin')

@section('style')
<style>
    /* Invoice Modal - Navy Blue & White */
    #view-invoice .modal-dialog {
        max-width: 1050px;
        width: calc(100% - 30px);
    }

    #view-invoice .modal-content {
        border: 1px solid #0c223d;
        border-radius: 8px;
        overflow: hidden;
        background: #ffffff;
        color: #0c223d;
    }

    #view-invoice .modal-header {
        background: #0c223d;
        color: #ffffff;
        padding: 18px 24px;
        border-bottom: 0;
    }

    #view-invoice .modal-title {
        font-size: 19px;
        font-weight: 700;
        color: #ffffff;
    }

    #view-invoice .modal-header .close {
        color: #ffffff;
        opacity: 1;
        text-shadow: none;
        font-size: 27px;
    }

    #view-invoice .modal-body {
        background: #ffffff;
        padding: 24px;
        max-height: calc(100vh - 180px);
        overflow-y: auto;
    }

    #view-invoice .invoice-paper {
        background: #ffffff;
        border: 1px solid #0c223d;
        padding: 30px;
        color: #0c223d;
    }

    #view-invoice .invoice-company-name {
        color: #0c223d;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    #view-invoice .invoice-company-info {
        color: #0c223d;
        font-size: 12px;
        line-height: 1.85;
    }

    #view-invoice .invoice-title {
        color: #0c223d;
        font-size: 27px;
        font-weight: 800;
        text-align: right;
        margin-bottom: 16px;
    }

    #view-invoice .invoice-number-box {
        border: 1px solid #0c223d;
        padding: 13px;
        border-radius: 5px;
    }

    #view-invoice .invoice-number-box small {
        display: block;
        color: #0c223d;
        font-size: 11px;
        margin-bottom: 5px;
    }

    #view-invoice .invoice-number-box strong {
        display: block;
        color: #0c223d;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    #view-invoice .invoice-abn {
        text-align: right;
        font-size: 12px;
        margin-top: 12px;
        color: #0c223d;
    }

    #view-invoice .invoice-divider {
        border: 0;
        border-top: 2px solid #0c223d;
        margin: 22px 0;
    }

    #view-invoice .invoice-info-grid {
        border: 1px solid #0c223d;
        border-radius: 5px;
        padding: 18px 14px;
        margin-bottom: 26px;
    }

    #view-invoice .invoice-info-item {
        overflow-wrap: anywhere;
    }

    #view-invoice .invoice-info-label {
        display: block;
        color: #0c223d;
        font-size: 11px;
        margin-bottom: 6px;
    }

    #view-invoice .invoice-info-value {
        display: block;
        color: #0c223d;
        font-size: 13px;
        font-weight: 700;
    }

    #view-invoice .invoice-section-title {
        color: #0c223d;
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    #view-invoice .invoice-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    #view-invoice .invoice-table {
        width: 100%;
        border-collapse: collapse;
        color: #0c223d;
        margin-bottom: 0;
    }

    #view-invoice .invoice-table thead {
        background: #0c223d;
        color: #ffffff;
    }

    #view-invoice .invoice-table th {
        background: #0c223d;
        color: #ffffff;
        padding: 13px 10px;
        font-size: 11px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
        border: 1px solid #0c223d;
    }

    #view-invoice .invoice-table td {
        background: #ffffff;
        color: #0c223d;
        padding: 13px 10px;
        font-size: 12px;
        vertical-align: top;
        border: 1px solid #0c223d;
    }

    #view-invoice .invoice-table .text-right {
        text-align: right;
        white-space: nowrap;
    }

    #view-invoice .invoice-bottom {
        margin-top: 28px;
    }

    #view-invoice .invoice-notes {
        color: #0c223d;
        font-size: 12px;
        line-height: 1.9;
    }

    #view-invoice .invoice-card-info {
        border: 1px solid #0c223d;
        padding: 12px;
        margin-top: 18px;
        border-radius: 5px;
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    #view-invoice .invoice-totals {
        width: 100%;
        max-width: 340px;
        margin-left: auto;
    }

    #view-invoice .invoice-total-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 11px 12px;
        border-bottom: 1px solid #0c223d;
        color: #0c223d;
        font-size: 13px;
    }

    #view-invoice .invoice-total-row strong {
        white-space: nowrap;
    }

    #view-invoice .invoice-total-row.balance {
        background: #0c223d;
        color: #ffffff;
        font-size: 16px;
        font-weight: 800;
        margin-top: 10px;
        border: 1px solid #0c223d;
        border-radius: 4px;
        padding: 15px 12px;
    }

    #view-invoice .modal-footer {
        background: #ffffff;
        border-top: 1px solid #0c223d;
        padding: 15px 24px;
    }

    #view-invoice .invoice-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid #0c223d;
        border-radius: 4px;
        padding: 10px 18px !important;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    #view-invoice .invoice-btn-primary {
        background: #0c223d;
        color: #ffffff;
    }

    #view-invoice .invoice-btn-primary:hover {
        background: #ffffff;
        color: #0c223d;
    }

    #view-invoice .invoice-btn-secondary {
        background: #ffffff;
        color: #0c223d;
    }

    #view-invoice .invoice-btn-secondary:hover {
        background: #0c223d;
        color: #ffffff;
    }

    @media (max-width: 767px) {
        #view-invoice .modal-dialog {
            width: calc(100% - 16px);
            margin: 8px auto;
        }

        #view-invoice .modal-body {
            padding: 12px;
            max-height: calc(100vh - 150px);
        }

        #view-invoice .invoice-paper {
            padding: 16px;
        }

        #view-invoice .invoice-company-name {
            font-size: 19px;
        }

        #view-invoice .invoice-title {
            text-align: left;
            font-size: 23px;
            margin-top: 22px;
        }

        #view-invoice .invoice-abn {
            text-align: left;
        }

        #view-invoice .invoice-table {
            min-width: 700px;
        }

        #view-invoice .invoice-totals {
            max-width: 100%;
        }
    }

    @media print {
        body.invoice-printing * {
            visibility: hidden !important;
        }

        body.invoice-printing #invoicePrintArea,
        body.invoice-printing #invoicePrintArea * {
            visibility: visible !important;
        }

        body.invoice-printing #invoicePrintArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        body.invoice-printing #view-invoice .invoice-paper {
            border: 0;
            padding: 0;
        }

        body.invoice-printing #view-invoice .invoice-table thead th {
            background: #0c223d !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body.invoice-printing #view-invoice .invoice-total-row.balance {
            background: #0c223d !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @page {
            size: A4;
            margin: 12mm;
        }
        
    }
    
@media print {
    @page {
        size: A4;
        margin: 10mm;
    }

    html,
    body {
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
        overflow: visible !important;
    }

    body.invoice-printing * {
        visibility: hidden !important;
    }

    body.invoice-printing #view-invoice,
    body.invoice-printing #view-invoice .modal-dialog,
    body.invoice-printing #view-invoice .modal-content,
    body.invoice-printing #invoicePrintArea,
    body.invoice-printing #invoicePrintArea * {
        visibility: visible !important;
    }

    body.invoice-printing #view-invoice {
        display: block !important;
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
        background: #ffffff !important;
        opacity: 1 !important;
    }

    body.invoice-printing #view-invoice .modal-dialog {
        position: static !important;
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
        transform: none !important;
    }

    body.invoice-printing #view-invoice .modal-content {
        display: block !important;
        width: 100% !important;
        border: 0 !important;
        box-shadow: none !important;
        background: #ffffff !important;
    }

    body.invoice-printing #view-invoice .modal-header,
    body.invoice-printing #view-invoice .modal-footer,
    body.invoice-printing #view-invoice .close {
        display: none !important;
    }

    body.invoice-printing #view-invoice .modal-body {
        display: block !important;
        max-height: none !important;
        height: auto !important;
        overflow: visible !important;
        padding: 0 !important;
        margin: 0 !important;
        background: #ffffff !important;
    }

    body.invoice-printing #invoicePrintArea {
        display: block !important;
        position: static !important;
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }

    body.invoice-printing #view-invoice .invoice-paper {
        display: block !important;
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
        padding: 8px !important;
        border: 0 !important;
        color: #0c223d !important;
        background: #ffffff !important;
        box-shadow: none !important;
    }

    body.invoice-printing #invoicePrintArea * {
        color: #0c223d;
    }

    body.invoice-printing #view-invoice .invoice-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    body.invoice-printing #view-invoice .invoice-table-wrapper {
        overflow: visible !important;
    }

    body.invoice-printing #view-invoice .invoice-table th {
        background: #0c223d !important;
        color: #ffffff !important;
        border: 1px solid #0c223d !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    body.invoice-printing #view-invoice .invoice-table td {
        background: #ffffff !important;
        color: #0c223d !important;
        border: 1px solid #0c223d !important;
    }

    body.invoice-printing #view-invoice .invoice-total-row.balance {
        background: #0c223d !important;
        color: #ffffff !important;
        border: 1px solid #0c223d !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    body.invoice-printing #view-invoice .invoice-total-row.balance strong,
    body.invoice-printing #view-invoice .invoice-total-row.balance span {
        color: #ffffff !important;
    }

    body.invoice-printing #view-invoice .invoice-info-grid,
    body.invoice-printing #view-invoice .invoice-number-box,
    body.invoice-printing #view-invoice .invoice-card-info {
        border: 1px solid #0c223d !important;
        break-inside: avoid;
    }

    body.invoice-printing .modal-backdrop {
        display: none !important;
    }

    body.invoice-printing #view-invoice .row {
        break-inside: avoid;
    }
}

</style>
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

{{-- Existing Transaction Summary modal: preserve existing functionality --}}
@include('admin.support-services.modal.transaction-summary')


{{-- Tax Invoice Modal --}}
<div class="modal fade"
     id="view-invoice"
     tabindex="-1"
     role="dialog"
     aria-labelledby="invoiceModalTitle"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalTitle">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Tax Invoice
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="invoicePrintArea">
                    <div class="invoice-paper">

                        {{-- Company details --}}
                        <div class="row">
                            <div class="col-md-7">
                                <div class="invoice-company-name">
                                    Blackbox Tech Pty Ltd
                                </div>

                                <div class="invoice-company-info">
                                    t/as E4U<br>
                                    B: 168 Guildford Road<br>
                                    Maylands WA 6051<br>
                                    P: GPO Box T1756<br>
                                    Perth WA 6845<br>
                                    T: 1300 700 444<br>
                                    E: admin@e4u.com.au<br>
                                    W: www.e4u.com.au
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="invoice-title">Tax Invoice</div>

                                <div class="invoice-number-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <small>Invoice Date</small>
                                            <strong id="invoiceDate">19 Jun 2026</strong>
                                        </div>

                                        <div class="col-6">
                                            <small>Invoice No.</small>
                                            <strong id="invoiceNumber">2026061900113</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="invoice-abn">
                                    <strong>ABN:</strong> 88 664 919 975
                                </div>
                            </div>
                        </div>

                        <hr class="invoice-divider">

                        {{-- Transaction / member details --}}
                        <div class="invoice-info-grid">
                            <div class="row">
                                <div class="col-md-3 col-6 mb-3 mb-md-0">
                                    <div class="invoice-info-item">
                                        <span class="invoice-info-label">Completed By</span>
                                        <span class="invoice-info-value" id="invoiceCompletedBy">E60511</span>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6 mb-3 mb-md-0">
                                    <div class="invoice-info-item">
                                        <span class="invoice-info-label">Currency</span>
                                        <span class="invoice-info-value" id="invoiceCurrency">AUD ($)</span>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="invoice-info-item">
                                        <span class="invoice-info-label">Home State</span>
                                        <span class="invoice-info-value" id="invoiceHomeState">WA</span>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="invoice-info-item">
                                        <span class="invoice-info-label">Member ID</span>
                                        <span class="invoice-info-value" id="invoiceMemberId">E60511</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Invoice items --}}
                        <h6 class="invoice-section-title">Transaction Details</h6>

                        <div class="invoice-table-wrapper">
                            <table class="invoice-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Service Type</th>
                                        <th>Service Description</th>
                                        <th>Qty (1)</th>
                                        <th>Rate</th>
                                        <th>GST</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>

                                <tbody id="invoiceItems">
                                    <tr>
                                        <td>19-06-2026</td>
                                        <td>Listing</td>
                                        <td>Complete Media Verification</td>
                                        <td>1</td>
                                        <td>$40.37</td>
                                        <td>$4.04</td>
                                        <td class="text-right">$44.41</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Notes, card and totals --}}
                        <div class="row invoice-bottom">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <h6 class="invoice-section-title">Notes</h6>

                                <div class="invoice-notes">
                                    <div>1. Quantity can be either days or units.</div>
                                    <div>2. Card debited with your authority.</div>
                                </div>

                                <div class="invoice-card-info">
                                    <strong>Card:</strong>
                                    <span id="invoiceCard">XXXX-XXXX-XXXX-0000</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="invoice-totals">
                                    <div class="invoice-total-row">
                                        <span>Subtotal</span>
                                        <strong id="invoiceSubtotal">$40.37</strong>
                                    </div>

                                    <div class="invoice-total-row">
                                        <span>GST</span>
                                        <strong id="invoiceGst">$4.04</strong>
                                    </div>

                                    <div class="invoice-total-row balance">
                                        <span>Balance Due</span>
                                        <strong id="invoiceBalance">$44.41</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="invoice-btn invoice-btn-secondary"
                        data-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        class="invoice-btn invoice-btn-primary"
                        id="printInvoiceBtn">
                    <i class="fas fa-print"></i>
                    Print Invoice
                </button>
            </div>

        </div>
    </div>
</div>
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


$('#printInvoiceBtn').on('click', function () {
    $('body').addClass('invoice-printing');
    window.print();
});

window.addEventListener('afterprint', function () {
    $('body').removeClass('invoice-printing');
});


    // Also restore the page if the invoice modal is closed.
    $('#view-invoice').on('hidden.bs.modal', function () {
        $('body').removeClass('invoice-printing');
    });
</script>
@endpush
