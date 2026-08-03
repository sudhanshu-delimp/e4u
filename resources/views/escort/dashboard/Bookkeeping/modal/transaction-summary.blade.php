@if (empty($payment))
<div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listing"><img
                        src="{{ asset('assets/dashboard/img/transaction.png') }}" alt="alert"
                        style="width:29px;">
                    Transaction Summary
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div id="listingModalContent">
                            @endif
                            @if (!empty($print))
                            <h3>Transaction Summary</h3>
                            @endif
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                                <tbody>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Reference No.</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $payment?->ref_no ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Transaction
                                                Date</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ !empty($payment->created_at) ? convert_aus_date_time_format($payment->created_at) : '---' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Service Type</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $payment?->service ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Member ID</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $payment?->user->member_id ?? '---' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Completed
                                                By</strong></td>

                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ $payment?->createdBy->member_id ?? '---' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Card</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $payment?->card ?? '---' }}</td>
                                    </tr>


                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Total Fee</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ formatCurrency($payment?->amount ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>GST</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ formatCurrency($payment?->gst_amount ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Wallet Amount</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            -{{ formatCurrency($payment?->wallet_amount ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Loyalty Amount</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            -{{ formatCurrency($payment?->loyalty_amount ?? 0) }}
                                        </td>
                                    </tr>

                                    <?php $service = $payment?->service ?? 'Other'; ?>
                                    @if ($service == 'Product Purchase')
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Delivery Charge</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ formatCurrency($payment?->delivery_charge ?? 0) }}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Payment</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ formatCurrency($payment?->paid_amount ?? 0) }}
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                            @if (empty($payment))
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn-success-modal nex_sterp_btn print_payment_summary text-white">🖨️ Print Summary</a>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
@endif