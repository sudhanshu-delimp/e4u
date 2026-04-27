<div class="modal fade upload-modal" id="test_process-payment-modal" tabindex="-1" aria-labelledby="renew_discountLabel"
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
                <form action="{{ route('escort.payment.process') }}" class="pin" method="post" id="payment-form">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card p-3">
                                <!-- Order Summary -->
                                <p><strong>Order Summary</strong></p>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>$ 20.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Wallet Used:</span>
                                    <span>$ 25.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Loyalty Days:</span>
                                    <span>1 Day</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong>$ 50.00</strong>
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
                                          <h5><img src="{{asset('assets/dashboard/img/wallet.png')}}"> Wallet Money :  <span>$ 100.00</span></h5>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-body">
                                          <h5> <img src="{{asset('assets/dashboard/img/days.png')}}"> Loyalty Days :  <span>10</span></h5>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card p-3 " style="border-radius:0px;">
                                        <div class="form-row">
                                            <div class="form-group col-6">

                                                <label class="mb-0" for="Wallet">Wallet Money</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="10.00">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="mb-0" for="Days">Loyalty Days</label>                                               
                                                    <div class="input-group mb-3">
                                                   
                                                    <input type="text" class="form-control" placeholder="1">
                                                     <div class="input-group-prepend">
                                                        <span class="input-group-text">Day</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end w-100">
                                              <button class="apply-btn" type="button">Apply</button>
                                            </div>
                                        </div>
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
                            <div class="card p-3">

                                @csrf
                                <div class="errors alert alert-danger" style="display:none">
                                    <h5></h5>
                                    <ul></ul>
                                </div>

                                <!-- Billing -->
                                <h6 class="font-weight-bold mb-0">Billing Details</h6>
                                <hr class="mt-0">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add1">Address 1</label>
                                        <input id="address-line1" class="form-control" placeholder="Address 1">
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="mb-0" for="add2">Address 2</label>
                                        <input id="address-line2" class="form-control" placeholder="Address 2">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="mb-0" for="City">City</label>
                                        <input id="address-city" class="form-control" placeholder="City">
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
                                    <input id="address-country" class="form-control" placeholder="Country">
                                </div>



                                <!-- Card -->

                                <h6 class="font-weight-bold mb-0">Card Details</h6>
                                <hr class="mt-0">
                                <div class="form-group">
                                    <input id="cc-number" class="form-control" placeholder="Card Number">
                                </div>

                                <div class="form-group">
                                    <input id="cc-name" class="form-control" placeholder="Name on Card">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input id="cc-expiry-month" class="form-control" placeholder="MM">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-expiry-year" class="form-control" placeholder="YYYY">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input id="cc-cvc" class="form-control" placeholder="CVC">
                                    </div>
                                </div>

                                <button type="submit" class="btn-success-modal btn-block">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                errorList = errorContainer.find('ul'),
                errorHeading = errorContainer.find('h3');

            form.submit(function(e) {
                e.preventDefault();

                errorList.empty();
                errorHeading.empty();
                errorContainer.hide();

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
                        console.log(response);
                        submitButton.removeAttr('disabled');

                        // success UI
                        errorContainer
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .show();

                        errorHeading.text('Payment Successful');
                        errorList.html('<li>' + response.message + '</li>');
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

                        errorList.empty();

                        if (res && res.message) {
                            $('<li>').text(res.message).appendTo(errorList);
                        } else {
                            $('<li>').text('Something went wrong').appendTo(errorList);
                        }
                    }
                });
            }

            function handleError(response) {

                errorHeading.text(response.error_description);

                if (response.messages) {
                    $.each(response.messages, function(index, paramError) {
                        $('<li>')
                            .text(paramError.param + ": " + paramError.message)
                            .appendTo(errorList);
                    });
                }

                errorContainer
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .show();

                submitButton.removeAttr('disabled');
            }

        });
    </script>
@endpush
