@if (empty($payment))
<div class="modal fade upload-modal" id="view-tax-invoice" tabindex="-1" role="dialog" aria-labelledby="view-tax-invoiceLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-tax-invoice"><img src="{{ asset('assets/dashboard/img/transaction.png') }}" alt="alert" style="width:29px;">
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
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" style="border: 0px;">

                                    <!-- Main Invoice Container (Max Width 700px for Email Clients) -->
                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 6px; overflow: hidden;">

                                        <!-- Top Blue Header -->
                                        <tr>
                                            <td style="background-color: #0c223d; padding:5px 18px;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td align="left" valign="middle" style="border: 0px;">
                                                            <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/images/escorts4u-logo.png" alt="E4U Logo" width="95" style="display: block; border: 0; outline: none; text-decoration: none; max-width: 95px; height: auto;" />
                                                        </td>
                                                        <td align="right" valign="middle" style="font-size: 18px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; text-transform: uppercase; border:0px; text-align:end;">
                                                            TAX INVOICE
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Main Header (Company Details + Stamp + Meta) -->
                                        <tr>
                                            <td style="padding: 18px 18px 14px 18px; border-bottom: 2px solid #e2e8f0;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <!-- Company Details -->
                                                        <td width="45%" valign="middle" align="left" style="border:0px; font-size: 11px; line-height: 1.5; color: #53657d;">
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

                                                        <!-- Paid Stamp (Email-safe badge) -->
                                                        <td width="15%" valign="middle" align="center" style="border:0px;">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td align="center" style="border: 0px;">
                                                                        <span style="display: inline-block;border: 2px dashed #1aa34d;border-radius: 50%; background-color: #f0fdf4; padding: 15px 16px;text-align: center; color: #1aa34d; font-size: 14px; font-weight: 800;letter-spacing: 1px; line-height: 1.2;">
                                                                            <span style="display: block;font-size: 8px;font-weight: 700; letter-spacing: 0.5px;">THANK YOU</span>
                                                                            PAID
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                        <!-- Invoice Meta -->
                                                        <td width="40%" valign="middle" align="right" style="border:0px;font-size: 11.5px; line-height: 1.5;">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="right">
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; border:0px; font-weight: 600; padding: 2px 6px;">Invoice Date:</td>
                                                                    <td align="right" style="color: #0c223d; border:0px; font-weight: 700; padding: 2px 0;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y') : '---' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; border:0px; font-weight: 600; padding: 2px 6px;">Invoice No:</td>
                                                                    <td align="right" style="color: #0c223d; border:0px; font-weight: 700; padding: 2px 0;">{{ $payment?->ref_no ?? '---' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; border:0px; font-weight: 600; padding: 2px 6px;">ABN:</td>
                                                                    <td align="right" style="color: #0c223d; border:0px; font-weight: 700; padding: 2px 0;">88 664 919 975</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Invoice Body Container -->
                                        <tr>
                                            <td style="padding: 16px 18px 20px 18px;">

                                                <!-- Metadata Table Section -->
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                                    <tr>
                                                        <td width="40%" valign="bottom" align="left" style="border:0px;font-size: 12px; line-height: 1.6; color: #0c223d; padding-bottom: 2px;">
                                                            <div><strong>Member ID:</strong> {{!empty($payment) ? $payment->user->member_id : '---'}}</div>
                                                            <div><strong>Location:</strong> {{!empty($payment) ? $payment->user->home_state : '---'}}</div>
                                                        </td>
                                                        <td width="60%" valign="bottom" align="right" style="border:0px;">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; text-align: center;">
                                                                <thead>
                                                                    <tr style="background-color: #0c223d;">
                                                                        <th style="padding: 5px; text-align:center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Completed By</th>
                                                                        <th style="padding: 5px; text-align:center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Currency</th>
                                                                        <th style="padding: 5px; text-align:center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Home State</th>
                                                                        <th style="padding: 5px; text-align:center; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Member ID</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr style="background-color: #fafbfc;">
                                                                        <td style="padding: 5px; text-align:center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{ $payment?->createdBy->member_id ?? '---' }}</td>
                                                                        <td style="padding: 5px; text-align:center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">AUS</td>
                                                                        <td style="padding: 5px; text-align:center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ? $payment->user->home_state : '---'}}</td>
                                                                        <td style="padding: 5px; text-align:center; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ?$payment->user->member_id : '---'}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Line Items Table -->
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; width: 100%;">
                                                    <thead>
                                                        <tr style="background-color: #0c223d;">
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 12%;">Date</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 14%;">Service Type</th>
                                                            <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: left; width: 34%;">Service Description</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 8%;">Qty<sup>(1)</sup></th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 10%;">Rate</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 10%;">GST</th>
                                                            <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 12%;">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($payment))
                                                            @include('escort.dashboard.Bookkeeping.modal.partials.tex-invoice-items', compact('payment'))
                                                        @endif
                                                        <!-- Subtotal Row -->
                                                        <tr>
                                                            <!-- Notes Box & Card details embedded in the left cells -->
                                                            <td colspan="4" rowspan="3" valign="top" style="border: 1px solid #cbd5e1; padding: 12px; background-color: #ffffff;">
                                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                    <tr>
                                                                        <td valign="top" style="border:0;padding:0px;">
                                                                            <div style="width:55%;border: 1px dashed #22c55e; border-radius: 4px; padding: 6px 10px; font-size: 10.5px; color: #15803d; line-height: 1.4; background-color: #ffffff;">
                                                                                <strong style="display: block; font-size: 11px; margin-bottom: 2px;">Notes:</strong>
                                                                                1. Quantity can be either days or units.<br />
                                                                                2. Card debited with your authority.
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top" style="border:0; padding-bottom:0px; padding-right:0px; padding-left:0px; padding-top: 8px; font-size: 11.5px; font-weight: 700; color: #dc2626;">
                                                                            Card<sup>(2)</sup>: {{ $payment?->card ?? '---' }}
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td colspan="2" align="center" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; font-weight: 700; color: #0c223d; background-color: #ffffff;text-align:center;">Subtotal:</td>
                                                            <td align="right" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; color: #132238; background-color: #ffffff; white-space: nowrap;text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
                                                        </tr>

                                                        <!-- GST Row -->
                                                        <tr>
                                                            <td colspan="2" align="center" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; font-weight: 700; color: #0c223d; background-color: #ffffff;text-align:center;">GST:</td>
                                                            <td align="right" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; color: #132238; background-color: #ffffff; white-space: nowrap;text-align:right;">{{ formatCurrency($payment?->gst_amount ?? 0) }}</td>
                                                        </tr>

                                                        <!-- Balance Due Row -->
                                                        <tr style="background-color: #fafbfc;">
                                                            <td colspan="2" align="left" style="padding: 9px 8px; border: 2px solid #0c223d; font-size: 13px; font-weight: 800; color: #0c223d;text-align:left;">Balance Due:</td>
                                                            <td align="right" style="padding: 9px 6px; border: 2px solid #0c223d; font-size: 13px; font-weight: 800; color: #0c223d; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->paid_amount ?? 0) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                        @if (empty($payment))
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn-success-modal nex_sterp_btn print_payment_summary text-white" target="_blank">🖨️ Print Summary</a>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
@endif