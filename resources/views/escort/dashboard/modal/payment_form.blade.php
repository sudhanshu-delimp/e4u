<div class="modal fade upload-modal" id="process-payment-modal" tabindex="-1" aria-labelledby="renew_discountLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/set-commission.png') }}" class="custompopicon"
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
                                    <span class="paymentSubtotal">AU$ 0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                    <span>Wallet Used:</span>
                                    <span>AU$ 0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                    <span>Loyalty Discount:</span>
                                    <span>AU$ 0.00</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong class="paymentTotal">AU$ 0.00</strong>
                                    </div>
                                </div>

                                <hr>

                                <a style="color: #000;" data-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    <p class="apply_benefits"><strong>Apply Benefits</strong> <i
                                            class="fa fa-chevron-down"></i></p>
                                </a>


                                <div class="collapse" id="collapseExample">
                                    <div class="wallet_details">
                                      <div class="card">
                                        <div class="card-body">
                                          <h5><img src="{{asset('assets/dashboard/img/wallet.png')}}"> Wallet Money :  <span>AU$ {{Auth::user()->wallet->balance}}</span></h5>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-body">
                                          <h5> <img src="{{asset('assets/dashboard/img/days.png')}}"> Loyalty Days :  <span>{{Auth::user()->wallet->earn_days}}</span></h5>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card p-3 " style="border-radius:0px;">
                                        <form action="{{ route('payment.adjustment') }}" method="post" id="adjustment-form">
                                            <div class="form-row benefit_section">
                                                <div class="form-group col-6">
                                                    <label class="mb-0" for="Wallet">Wallet Money</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text">AU$</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="wallet_amount" placeholder="Enter amount.">
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label class="mb-0" for="Days">Loyalty Days</label>                                               
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="loyalty_day" placeholder="Enter days.">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text">Day</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end w-100 gap-10">
                                                    <button type="reset" class="reset-btn btn-cancel-modal">Reset</button>
                                                    <button type="submit" class="apply-btn">Apply</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="support mt-3">
                                    <p class="mb-0"><strong>Note:</strong></p>
                                    <p class="small mb-0">
                                        Users can apply benefits by selecting available wallet money and loyalty days to
                                        reduce the total payable amount.
                                    </p>
                                </div>

                            </div>



                        </div>

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            
                <form action="{{ route('escort.payment.process') }}" class="pin" method="post" id="payment-form">
                    
                            <div class="card p-3">

                                @csrf
                                <div class="errors alert alert-danger" style="display:none">
                                    <h3></h3>
                                </div>

                                <!-- Billing -->
                                <h6 class="font-weight-bold mb-0">Billing Details</h6>
                                <hr class="mt-0">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add1">Address 1</label>
                                        <input id="address-line1" class="form-control address_line1" placeholder="Address 1">
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add2">Address 2</label>
                                        <input id="address-line2" class="form-control" placeholder="Address 2">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="mb-0" for="City">City</label>
                                        <input id="address-city" class="form-control address_city" placeholder="City">
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
                                    <input id="address-country" class="form-control address_country" placeholder="Country">
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
                                        <input id="cc-expiry-month" class="form-control expiry_month" placeholder="MM">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-expiry-year" class="form-control expiry_year" placeholder="YYYY">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-cvc" class="form-control cvc" placeholder="CVC">
                                    </div>
                                </div>

                                <button type="submit" class="btn-success-modal btn-block">
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
@push('script')
    <script src='https://cdn.pinpayments.com/pin.v2.js'></script>
    <script>
        $(function() {

            var pinApi = new Pin.Api('{{ config('app.payment.publish_key') }}', 'test');

            var form = $('form.pin'),
                submitButton = form.find(":submit"),
                errorContainer = form.find('.errors'),
                errorHeading = errorContainer.find('h3');

            form.submit(function(e) {
                e.preventDefault();
                errorHeading.empty();
                errorContainer.hide();

                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                submitButton.attr({
                    disabled: true
                });

                var card = {
                    number: $('#cc-number').val(),
                    name: $('#cc-name').val(),
                    expiry_month: $('#cc-expiry-month').val(),
                    expiry_year: $('#cc-expiry-year').val(),
                    cvc: $('#cc-cvc').val(),
                    address_line1: $('#address-line1').val(),
                    address_line2: $('#address-line2').val(),
                    address_city: $('#address-city').val(),
                    address_state: $('#address-state').val(),
                    address_postcode: $('#address-postcode').val(),
                    address_country: $('#address-country').val()
                };

                pinApi.createCardToken(card).then(handleSuccess, handleError).done();
            });

            function handleSuccess(card) {
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pin_token: card.token
                    },
                    success: function(response) {
                        submitButton.removeAttr('disabled');

                        // success UI
                        errorContainer
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .show();

                        errorHeading.text(response.message);
                        location.assign(response.redirect_url);

                        // close modal after delay
                        setTimeout(function() {
                            $('#paymentModal').modal('hide');
                        }, 1500);
                    },
                    error: function(xhr) {

                        submitButton.removeAttr('disabled');

                        let res = xhr.responseJSON;

                        errorContainer
                            .removeClass('alert-success')
                            .addClass('alert-danger')
                            .show();

                        errorHeading.text('Payment Failed');
                        if (res && res.message) {
                            $('<li>').text(res.message).appendTo(errorList);
                        } else {
                            $('<li>').text('Something went wrong').appendTo(errorList);
                        }
                    }
                });
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
                submitButton.removeAttr('disabled');
            }

        });

        $("#process-payment-modal").on('show.bs.modal', function(){
            let amount = parseFloat($('.listing_total_fees').text().replace(/[^0-9.]/g, '')).toFixed(2);
            $(".order_summary_adjustment .paymentSubtotal, .order_summary_adjustment .paymentTotal").text(`AU$ ${amount}`);
        });

        var adjustmentForm = $('#adjustment-form');
        var submitAdjustmentForm = function(){
            $.ajax({
                url: adjustmentForm.attr('action'),
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: adjustmentForm.serialize(),
                beforeSend: function () {
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
                success: function (res, textStatus, xhr) {
                    Swal.close();
                    let option = getStatusOption(xhr);
                    if (res.status) {
                        $(".order_summary_adjustment").html(res.html);
                        if(res.total_amount){
                            $("#payment-form").find('input, button, select, textarea').prop('disabled', false);
                        }
                        else{
                            $("#payment-form").find('input, button, select, textarea').prop('disabled', true);
                        }
                    }
                    else{
                        Swal.fire({
                            icon: option.icon,
                            title: option.title,
                            text: option.message
                        });
                    }
                },
                error: function (xhr) {
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

        adjustmentForm.on('click', '.reset-btn', function (e) {
            adjustmentForm[0].reset();
            submitAdjustmentForm();
        });
    </script>
@endpush
