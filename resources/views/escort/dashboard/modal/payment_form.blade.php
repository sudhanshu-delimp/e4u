<div class="modal fade upload-modal" id="process-payment-modal" tabindex="-1" aria-labelledby="renew_discountLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/secure-payment.png') }}" class="custompopicon"
                        alt="View Centre">
                    Secure Payment
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card p-3">
                            <!-- Order Summary -->
                            <div class="order_summary_adjustment">
                                <p><strong>Order Summary</strong></p>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span class="paymentSubtotal">{{ formatCurrency(0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Wallet Used:</span>
                                    <span>{{ formatCurrency(0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Loyalty Discount:</span>
                                    <span>{{ formatCurrency(0) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total Fee:</strong>
                                    <strong class="paymentTotal">{{ formatCurrency(0) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>GST:</strong>
                                    <strong class="taxAmount">{{ formatCurrency(0) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total Due:</strong>
                                    <strong class="paymentTotal totalDue">{{ formatCurrency(0) }}</strong>
                                </div>
                            </div>

                            <hr>

                            <a class="payment_wallet_option" style="color: #000;" data-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                <p class="apply_benefits"><strong>Apply Benefits</strong> <i
                                        class="fa fa-chevron-down"></i></p>
                            </a>


                            <div class="collapse" id="collapseExample">
                                <div class="wallet_details">
                                    <div class="card payment_wallet_option">
                                        <div class="card-body">
                                            <h5><img src="{{ asset('assets/dashboard/img/wallet.png') }}"> Wallet Money
                                                : <span>{{ formatCurrency(Auth::user()->wallet->balance) }}</span></h5>
                                        </div>
                                    </div>
                                    <div class="card payment_loyalty_option">
                                        <div class="card-body">
                                            <h5> <img src="{{ asset('assets/dashboard/img/days.png') }}"> Loyalty Days
                                                : <span>{{ Auth::user()->wallet->earn_days ?? 0 }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-3 " style="border-radius:0px;">
                                    <form action="{{ route('payment.adjustment') }}" method="post"
                                        id="adjustment-form">
                                        <div class="form-row benefit_section">
                                            <div class="form-group col-6 payment_wallet_option">
                                                <label class="mb-0" for="Wallet">Wallet Money</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">AU$</span>
                                                    </div>
                                                    <input type="text" class="form-control only_digits_decimal" name="wallet_amount"
                                                        placeholder="Enter amount.">
                                                </div>
                                            </div>
                                            <div class="form-group col-6 payment_loyalty_option">
                                                <label class="mb-0" for="Days">Loyalty Days</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control only_digits" name="loyalty_day"
                                                        placeholder="Enter days.">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Day</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end w-100 gap-10">
                                                <button type="reset" class="reset-btn btn-cancel-modal" name="action"
                                                    value="reset">Reset</button>
                                                <button type="submit" class="apply-btn" name="action"
                                                    value="">Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="finish-payment-form d-none mt-2">
                                <form action="{{ route('escort.payment.process') }}" method="post"
                                    id="finish-payment-form">
                                    <button type="submit" name="action" value="finish_payment"
                                        class="btn-success-modal btn-block">
                                        Complete Payment
                                    </button>
                                </form>
                            </div>
                            <div class="support mt-3 payment_note payment_wallet_option">
                                <p class="mb-0"><strong>Notes:</strong></p>
                                <ol>
                                    <li>You can apply any portion of your benefits by selecting from your Wallet, to
                                        reduce the total Fee payable for this Service.</li>
                                    <li>By selecting 'Pay Now', 2FA will be activated to verify it is you.</li>
                                    <li>For a detailed summary of this transaction, go to <a
                                            href="{{ route('escort.payment.transaction_summary') }}"
                                            class="custom_links_design" target="_blank"> Transaction Summary</a>.</li>
                                </ol>
                            </div>

                        </div>



                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <form action="{{ route('escort.payment.process') }}" class="pin" method="post"
                            id="payment-form">

                            <div class="card p-3">

                                @csrf
                                <div class="errors alert alert-danger" style="display:none">
                                </div>

                                <!-- Billing -->
                                <h6 class="font-weight-bold mb-0">Billing Details</h6>
                                <hr class="mt-0">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add1">Address 1</label>
                                        <input id="address-line1" class="form-control address_line1"
                                            placeholder="Address 1">
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add2">Address 2</label>
                                        <input id="address-line2" class="form-control" placeholder="Address 2">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="mb-0" for="City">City</label>
                                        <input id="address-city" class="form-control address_city"
                                            placeholder="City">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="mb-0" for="State">State</label>
                                        <input id="address-state" class="form-control" placeholder="State">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="mb-0" for="Postcode">Postcode</label>
                                        <input id="address-postcode" class="form-control" placeholder="Postcode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="mb-0" for="Country">Country</label>
                                    <input id="address-country" class="form-control address_country"
                                        placeholder="Country">
                                </div>



                                <!-- Card -->

                                <h6 class="font-weight-bold mb-0">Card Details</h6>
                                <hr class="mt-0">
                                <div class="form-group">
                                    <input id="cc-number" class="form-control number" placeholder="Card Number">
                                </div>

                                <div class="form-group">
                                    <input id="cc-name" class="form-control name" placeholder="Name on Card">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input id="cc-expiry-month" class="form-control expiry_month"
                                            placeholder="MM">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-expiry-year" class="form-control expiry_year"
                                            placeholder="YYYY">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-cvc" class="form-control cvc" placeholder="CVC">
                                    </div>
                                </div>

                                <button type="submit" name="action" value="pay_now"
                                    class="btn-success-modal btn-block">
                                    Pay Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- end --}}
@prepend('script')
<script src='https://cdn.pinpayments.com/pin.v2.js'></script>
<script>
    let card = {};
    let paymentFormData = {};
    let form = $('form.pin');
    let submitPaymentButton = form.find(":submit");
    $(function() {

        var pinApi = new Pin.Api(`{{ config('app.payment.publish_key') }}`, 'test');

        errorContainer = form.find('.errors'),
            errorHeading = errorContainer.find('h3');

        form.submit(function(e) {
            e.preventDefault();
            errorContainer.hide();

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            submitPaymentButton.attr({
                disabled: true
            });

            card['number'] = $('#cc-number').val();
            card['name'] = $('#cc-name').val();
            card['expiry_month'] = $('#cc-expiry-month').val();
            card['expiry_year'] = $('#cc-expiry-year').val();
            card['cvc'] = $('#cc-cvc').val();
            card['address_line1'] = $('#address-line1').val();
            card['address_line2'] = $('#address-line2').val();
            card['address_city'] = $('#address-city').val();
            card['address_state'] = $('#address-state').val();
            card['address_postcode'] = $('#address-postcode').val();
            card['address_country'] = $('#address-country').val();
            pinApi.createCardToken(card).then(handleSuccess, handleError).done();
        });

        function handleSuccess(card) {

            paymentFormData['_token'] = `{{ csrf_token() }}`;
            paymentFormData['pin_token'] = card.token;

            if ($("input[name='benefit_token']").length > 0) {
                paymentFormData['benefit_token'] = $("input[name='benefit_token']").val();
            }

            $("#sendOtp_modal").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });

            form.closest('.modal').modal('hide');
        }

        function handleError(response) {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            if (response.messages) {
                $.each(response.messages, function(index, paramError) {
                    const fieldName = paramError.param;
                    const message = paramError.message;

                    const field = $(`.${fieldName}`);

                    if (field.length) {
                        field.addClass('is-invalid');

                        $('<div class="invalid-feedback">')
                            .text(message)
                            .insertAfter(field);
                    } else {
                        console.warn("Field not found:", fieldName);
                    }
                });
            }
            submitPaymentButton.removeAttr('disabled');
        }

    });


    var processPaymentForm = function() {
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: paymentFormData,
            beforeSend: function() {
                Swal.fire({
                    title: 'Processing Payment',
                    text: 'Do not refresh or close this page.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response, textStatus, xhr) {
                Swal.close();
                paymentFormData = {};
                //submitPaymentButton.removeAttr('disabled');
                let otherModalForm;
                if (!response.redirect_url || response.redirect_url.trim() === '') {
                    form.closest('.modal').modal('hide');
                    otherModalForm = $(`.modal-form-${response.action}`).find('form');
                    otherModalForm.append('<input type="hidden" name="payment_token" value="' + response.payment_id + '">');
                }
                switch (response.action) {

                    case 'pinup': {
                        displaySwal(xhr, false);
                        otherModalForm.attr('action', `{{route('pinup.register')}}`);
                        setTimeout(() => {
                            otherModalForm.trigger('submit');
                        }, 2000); // 2 seconds
                    }
                    break;
                    case 'bumpUp': {
                        displaySwal(xhr, false);
                        setTimeout(() => {
                            otherModalForm.trigger('submit');
                        }, 2000); // 2 seconds
                    }
                    break;
                    case 'upgrade': {
                        displaySwal(xhr, false);
                        setTimeout(() => {
                            otherModalForm.trigger('submit');
                        }, 2000); // 2 seconds
                    }
                    break;

                    default: {
                        displaySwal(xhr).then((result) => {
                            if (result.isConfirmed) {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                }
                            }
                        });
                    }
                    break;
                }
            },
            error: function(xhr) {
                submitPaymentButton.removeAttr('disabled');
                Swal.close();
                let option = getStatusOption(xhr);
                console.log(submitPaymentButton);
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            }
        });
    }

    $("#sendOtp_modal").on('show.bs.modal', function() {
        $.ajax({
            url: `{{ route('send.opt.notification', ['user' => Auth::user()->id]) }}`,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                action: 'payment'
            },
            success: function(res, textStatus, xhr) {
                console.log(res);
            },
            error: function(xhr) {
                Swal.close();
                let option = getStatusOption(xhr);
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message
                });
            }
        });
    });

    var adjustmentForm = $('#adjustment-form');
    var finishPaymentForm = $('#finish-payment-form');
    var submitAdjustmentForm = function(checkAmount = true) {
        let submitPaymentButton = adjustmentForm.find('button[type="submit"]');
        $.ajax({
            url: adjustmentForm.attr('action'),
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: `${adjustmentForm.serialize()}&${submitPaymentButton.attr('name')}=${submitPaymentButton.attr('value')}&checkAmount=${checkAmount}`,
            beforeSend: function() {
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Applying adjustment',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(res, textStatus, xhr) {
                Swal.close();
                let option = getStatusOption(xhr);
                if (res.status) {
                    $(".order_summary_adjustment").html(res.html);
                    addOrUpdateHiddenInput('adjustment-form', 'benefit_token', res.benefit_token)

                    if (res.totalDueAmount > 0) {
                        $("#payment-form").find('input, button, select, textarea').prop('disabled',
                            false);
                        finishPaymentForm.find('input, button, select, textarea').prop('disabled',
                            true);
                        finishPaymentForm.parent().addClass('d-none');
                    } else {
                        $("#payment-form").find('input, button, select, textarea').prop('disabled',
                            true);
                        finishPaymentForm.find('input, button, select, textarea').prop('disabled',
                            false);
                        finishPaymentForm.parent().removeClass('d-none');
                    }
                } else {
                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                    });
                }
                if (!checkAmount) {
                    adjustmentForm.find('[name="wallet_amount"]').val('');
                }
            },
            error: function(xhr) {
                Swal.close();
                let option = getStatusOption(xhr);
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message
                });
            }
        });
    }

    adjustmentForm.submit(function(e) {
        e.preventDefault();
        submitAdjustmentForm();
    });

    finishPaymentForm.submit(function(e) {
        e.preventDefault();
        let submitPaymentButton = finishPaymentForm.find(":submit");
        submitPaymentButton.attr({
            disabled: true
        });
        let data = {};
        data['_token'] = `{{ csrf_token() }}`;
        data['pin_token'] = `{{ encrypt('without_pay_now') }}`;
        if ($("input[name='benefit_token']").length > 0) {
            data['benefit_token'] = $("input[name='benefit_token']").val();
        }
        $.ajax({
            url: finishPaymentForm.attr('action'),
            method: 'POST',
            data: data,
            beforeSend: function() {
                Swal.fire({
                    title: 'Processing Payment',
                    text: 'Do not refresh or close this page.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response, textStatus, xhr) {
                // console.log(response);
                Swal.close();
                submitPaymentButton.removeAttr('disabled');
                let option = getStatusOption(xhr);
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = response.redirect_url;
                    }
                });
            },
            error: function(xhr) {
                Swal.close();
                let option = getStatusOption(xhr);
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
                submitPaymentButton.removeAttr('disabled');
            }
        });
    });

    adjustmentForm.on('click', '.reset-btn', function(e) {
        adjustmentForm[0].reset();
        submitAdjustmentForm(false);
    });

    let initLoyaltySection = function(action = 'show') {
        (action == 'hide') ? $(".payment_loyalty_option").hide(): $(".payment_loyalty_option").show();
    }

    let initWalletSection = function(action = 'show') {
        (action == 'hide') ? $(".payment_wallet_option").hide(): $(".payment_wallet_option").show();
    }

    $("#process-payment-modal").on('show.bs.modal', function(event) {
        if (event.relatedTarget) {
            let paymentButton = $(event.relatedTarget);
            let primaryModalId = paymentButton.parents('.modal').attr('id');
            $(`#${primaryModalId}`).modal('hide');
            let fee_token = paymentButton.attr('fee_token');
            if (fee_token) {
                addOrUpdateHiddenInput('adjustment-form', 'fee_token', fee_token);
            }

            ['listing', 'tour', 'extend'].includes(paymentButton.attr('value')) ? initLoyaltySection('show') : initLoyaltySection('hide');
            !['wallet'].includes(paymentButton.attr('value')) ? initWalletSection('show') : initWalletSection('hide');
            adjustmentForm.find('button[type="submit"]').attr('value', paymentButton.attr('value'));
            adjustmentForm.find('[name="wallet_amount"]').val(0);
            submitAdjustmentForm(false);
        }
    });
</script>
@endprepend