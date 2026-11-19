@if (empty($payment))
<div class="modal fade upload-modal" id="view-tax-invoice" tabindex="-1" role="dialog" aria-labelledby="view-tax-invoiceLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-tax-invoiceLabel"><img src="{{ asset('assets/dashboard/img/transaction.png') }}" alt="alert" style="width:29px;">
                    Tax Invoice
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div id="invoiceModalContent" class="col-lg-12">
@endif

                        <style type="text/css">
                            .e4u-invoice-wrap,
                            .e4u-invoice-wrap table,
                            .e4u-invoice-wrap td,
                            .e4u-invoice-wrap th,
                            .e4u-invoice-wrap div,
                            .e4u-invoice-wrap span,
                            .e4u-invoice-wrap a {
                                font-family: Helvetica, Arial, sans-serif !important;
                                -webkit-print-color-adjust: exact !important;
                                print-color-adjust: exact !important;
                                color-adjust: exact !important;
                            }
                            @page {
                                size: A4 portrait;
                                margin: 10mm;
                            }
                            @media print {
                                html, body {
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    background-color: #ffffff !important;
                                    width: 100% !important;
                                    font-family: Helvetica, Arial, sans-serif !important;
                                }
                                .e4u-invoice-wrap {
                                    width: 100% !important;
                                    max-width: 100% !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                }
                                .e4u-invoice-container {
                                    width: 100% !important;
                                    max-width: 100% !important;
                                    border: 1px solid #cbd5e1 !important;
                                    page-break-inside: avoid !important;
                                    break-inside: avoid !important;
                                }
                            }
                        </style>

                        <div class="e4u-invoice-wrap" style="font-family: Helvetica, Arial, sans-serif; width: 100%;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: Helvetica, Arial, sans-serif; border-collapse: collapse;">
                                <tr>
                                    <td align="center" style="border: 0px; padding: 0;">

                                        <!-- Main Invoice Container -->
                                        <table class="e4u-invoice-container" role="presentation" cellpadding="0" cellspacing="0" width="100%" style=" background-color: #ffffff; border: 1px solid #cbd5e1; border-collapse: collapse; font-family: Helvetica, Arial, sans-serif; margin: 0 auto;">

                                            <!-- Top Blue Header -->
                                            <tr>
                                                <td style="background-color: #0c223d; padding: 8px 18px; border: 0px;">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="left" valign="middle" style="border: 0px; padding: 0;">
                                                                <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/images/escorts4u-logo.png" alt="E4U Logo" width="95" style="display: block; border: 0; outline: none; text-decoration: none; max-width: 95px; height: auto;" />
                                                            </td>
                                                            <td align="right" valign="middle" style="font-size: 18px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; text-transform: uppercase; border: 0px; padding: 0; text-align: right;">
                                                                TAX INVOICE
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- Main Header (Company Details + Stamp + Meta) -->
                                            <tr>
                                                <td style="padding: 18px 18px 14px 18px; border-top: 0px; border-left: 0px; border-right: 0px; border-bottom: 2px solid #e2e8f0;">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <!-- Company Details -->
                                                            <td width="46%" valign="middle" align="left" style="border: 0px; padding: 0; font-size: 11px; line-height: 1.5; color: #53657d;">
                                                                <div style="font-size: 13.5px; font-weight: 700; color: #0c223d; margin-bottom: 3px;">
                                                                    Blackbox Tech Pty Ltd <span style="font-weight: 400; font-size: 11.5px; color: #53657d;">t/as E4U</span>
                                                                </div>
                                                                <div style="margin-bottom: 1px;"><strong style="color: #0c223d;">B:</strong> 168 Guildford Road Maylands WA 6051</div>
                                                                <div style="margin-bottom: 1px;"><strong style="color: #0c223d;">P:</strong> GPO Box T1756 Perth WA 6845</div>
                                                                <div>
                                                                    <strong style="color: #0c223d;">T:</strong> 1300 700 444 &nbsp;|&nbsp;
                                                                    <strong style="color: #0c223d;">E:</strong> <a href="mailto:admin@e4u.com.au" style="color: #1a5ea9; text-decoration: none;">admin@e4u.com.au</a><br />
                                                                    <strong style="color: #0c223d;">W:</strong> <a href="https://www.e4u.com.au" target="_blank" style="color: #1a5ea9; text-decoration: none;">e4u.com.au</a>
                                                                </div>
                                                            </td>

                                                           <!-- Paid Stamp (Replace this td block) -->
<td width="20%" valign="middle" align="center" style="border: 0px; padding: 0;">
    <div style="width: 82px; height: 82px; border: 2px dashed #1aa34d; border-radius: 50%; background-color: #f0fdf4; margin: 0 auto; padding: 0;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; height: 82px; border-collapse: collapse;">
            <tr>
                <td align="center" valign="middle" style="border: 0px; padding: 0; height: 82px; text-align: center; vertical-align: middle; color: #1aa34d; font-size: 14px; font-weight: 800; letter-spacing: 1px; line-height: 1.2;">
                    <span style="display: block; font-size: 8px; font-weight: 700; letter-spacing: 0.5px; line-height: 11px;">THANK YOU</span>
                    PAID
                </td>
            </tr>
        </table>
    </div>
</td>

                                                            <!-- Invoice Meta -->
                                                            <td width="34%" valign="middle" align="right" style="border: 0px; padding: 0; font-size: 11.5px; line-height: 1.5;">
                                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="right">
                                                                    <tr>
                                                                        <td align="right" style="color: #53657d; border: 0px; font-weight: 600; padding: 2px 6px; white-space: nowrap;">Invoice Date:</td>
                                                                        <td align="right" style="color: #0c223d; border: 0px; font-weight: 700; padding: 2px 0; white-space: nowrap;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y') : '---' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="right" style="color: #53657d; border: 0px; font-weight: 600; padding: 2px 6px; white-space: nowrap;">Invoice No:</td>
                                                                        <td align="right" style="color: #0c223d; border: 0px; font-weight: 700; padding: 2px 0; white-space: nowrap;">{{ $payment?->ref_no ?? '---' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="right" style="color: #53657d; border: 0px; font-weight: 600; padding: 2px 6px; white-space: nowrap;">ABN:</td>
                                                                        <td align="right" style="color: #0c223d; border: 0px; font-weight: 700; padding: 2px 0; white-space: nowrap;">88 664 919 975</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- Invoice Body Container -->
                                            <tr>
                                                <td style="padding: 16px 18px 20px 18px; border: 0px;">

                                                    <!-- Metadata Table Section -->
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                                        <tr>
                                                            <td width="40%" valign="bottom" align="left" style="border: 0px; padding: 0 0 2px 0; font-size: 12px; line-height: 1.6; color: #0c223d;">
                                                                <div><strong>Member ID:</strong> {{!empty($payment) ? $payment->user->member_id : '---'}}</div>
                                                                <div><strong>Location:</strong> {{!empty($payment) ? $payment->user->home_state : '---'}}</div>
                                                            </td>
                                                            <td width="60%" valign="bottom" align="right" style="border: 0px; padding: 0;">
                                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; text-align: center;">
                                                                    <thead>
                                                                        <tr style="background-color: #0c223d;">
                                                                            <th style="padding: 5px; text-align: center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Completed By</th>
                                                                            <th style="padding: 5px; text-align: center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Currency</th>
                                                                            <th style="padding: 5px; text-align: center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Home State</th>
                                                                            <th style="padding: 5px; text-align: center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Member ID</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr style="background-color: #fafbfc;">
                                                                            <td style="padding: 5px; text-align: center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{ $payment?->createdBy->member_id ?? '---' }}</td>
                                                                            <td style="padding: 5px; text-align: center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">AUS</td>
                                                                            <td style="padding: 5px; text-align: center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ? $payment->user->home_state : '---'}}</td>
                                                                            <td style="padding: 5px; text-align: center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ? $payment->user->member_id : '---'}}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <!-- Line Items Table (Total Width = 100%) -->
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; width: 100%;">
                                                        <thead>
                                                            <tr style="background-color: #0c223d;">
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 11%;">Date</th>
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 10%;">Service Type</th>
                                                                <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: left; width: 33%;">Service Description</th>
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 7%;">Qty<sup>(1)</sup></th>
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 9%;">Rate</th>
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 9%;">Discount</th>
                                                                <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 9%;">GST</th>
                                                                <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 12%;">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(!empty($payment))
                                                                @include('modal.payment.partials.tax-invoice-items', compact('payment'))
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                        </div>

@if (empty($payment))
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn-success-modal nex_sterp_btn print_payment_summary text-white" target="_blank">🖨️ Print</a>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@prepend('script')
<script>
    $('#view-tax-invoice').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        let id = button.data('item');
        let modal = $(this);
        modal.find('#listingModalContent').html(`<div class="text-center p-3">Loading...</div>`);
        $.ajax({
            url: `{{ route('common.payment.detail') }}`,
            type: 'POST',
            data: {
                id: id,
                action: 'tax-invoice',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                modal.find('#invoiceModalContent').html(response.html);
                modal.find('a.print_payment_summary').attr('href', response.print_url);
            },
            error: function() {
                modal.find('#invoiceModalContent').html(
                    `<div class="text-danger p-3">Failed to load data</div>`);
            }
        });

    });
</script>
@endprepend