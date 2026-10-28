<!-- Tax Invoice Modal -->
<div class="modal fade upload-modal" id="view-invoice" tabindex="-1" role="dialog" aria-labelledby="invoiceModalTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listing">
                    <img src="{{ asset('assets/dashboard/img/transaction.png')}}" alt="alert" class="custompopicon">
                    Tax Invoice
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body">
                <div id="invoicePrintArea">
                    <div class="invoice-paper">

                        <!-- Company details -->
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

                        <!-- Transaction / member details -->
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

                        <!-- Invoice items -->
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

                        <!-- Notes, card and totals -->
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
                    class="btn-success-modal  invoice-btn-primary"
                    id="printInvoiceBtn">
                    Print Invoice
                </button>
                <button type="button"
                    class="btn-cancel-modal invoice-btn-secondary"
                    data-dismiss="modal">
                    Cancel
                </button>

            </div>

        </div>
    </div>
</div>