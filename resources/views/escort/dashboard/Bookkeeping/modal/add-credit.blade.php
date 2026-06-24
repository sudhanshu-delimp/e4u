
<!-- Modal -->
<div class="modal fade upload-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" role="dialog" aria-labelledby="extendBumpUpProfile" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">

            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"><img src="/assets/dashboard/img/add-credit.png"
                        class="custompopicon" alt="cross"> Add Credit to My Account</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body text-center">
                <p class="lead">You have opted to top up your Account in the amount of <strong class="display_amount"></strong>.</p>
                <p>Are you sure that is the correct amount? If the amount is correct click <strong>Proceed</strong> to
                    complete your payment.</p>

                <div class="mt-3 p-2 bg-light rounded">
                    <h5>Never Worry About Running Out of Credit</h5>
                    <p>Would you like to enable Auto-recharge?</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="autoRechargeCheck">
                        <label class="form-check-label" for="autoRechargeCheck">Yes</label>
                    </div>
                    <small class="d-block text-muted mt-2">If enabled, the recharge will occur automatically when
                        balance falls below AU$100.00.</small>
                </div>

            </div>

            <div class="modal-footer">
                <button id="modalPaymentButton" class="btn-success-modal text-white" type="button" data-toggle="modal" data-target="#process-payment-modal" data-backdrop="static" data-keyboard="false" name="action" value="wallet">Proceed to Payment</button>
            </div>

        </div>
    </div>
</div>