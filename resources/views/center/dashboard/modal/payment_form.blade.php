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
                                    <span class="wallet_amount">{{ formatCurrency(0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Loyalty Discount:</span>
                                    <span class="loyalty_amount">{{ formatCurrency(0) }}</span>
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

                            <a style="color: #000;" data-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                <p class="apply_benefits"><strong>Apply Benefits</strong> <i
                                        class="fa fa-chevron-down"></i></p>
                            </a>


                            <div class="collapse" id="collapseExample">
                                <div class="wallet_details">
                                    <div class="card">
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
                                    <form action="{{ route('center.payment.adjustment') }}" method="post"
                                        id="adjustment-form">
                                        <div class="form-row benefit_section">
                                            <div class="form-group col-6">
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
                                               
                                                <button type="reset" class="reset-btn btn-cancel-modal reset_benifit" name="action"
                                                    value="reset">Reset</button>
                                                <button type="submit" class="apply-btn" name="action"
                                                    value="">Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="finish-payment-form d-none mt-2">
                                <form action="{{ route('center.payment.process') }}" method="post"
                                    id="finish-payment-form">
                                    <button type="submit" name="action" value="finish_payment"
                                        class="btn-success-modal btn-block">
                                        Complete Payment
                                    </button>
                                </form>
                            </div>
                            <div class="support mt-3 payment_note">
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
                        <form action="{{ route('center.payment.process') }}" class="pin" method="post"
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
                                    <input id="cc-number" maxlength="16" class="form-control number" placeholder="Card Number">
                                </div>

                                <div class="form-group">
                                    <input id="cc-name" maxlength="100" class="form-control name" placeholder="Name on Card">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">

                                        <select name="month" id="cc-expiry-month" class="form-control expiry_month">
                                            @for($i = 1; $i <= 12; $i++)
                                                    @php $month = sprintf('%02d', $i); @endphp
                                                    <option value="{{ $month }}" {{ $month == now()->format('m') ? 'selected' : '' }}>
                                                        {{ $month }}
                                                    </option>
                                            @endfor
                                        </select>
                                        
                                    </div>
                                    <div class="form-group col-md-4">

                                        <select id="cc-expiry-year" class="form-control expiry_year">
                                            @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    
                                    <div class="form-group col-md-4">
                                        <input id="cc-cvc" maxlength="3" class="form-control cvc" placeholder="CVC">
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


 $(function() {

        var pinApi = new Pin.Api(`{{ config('app.payment.publish_key') }}`, 'test');
        var submitButton = form.find(":submit"),
        errorContainer = form.find('.errors'),
        errorHeading = errorContainer.find('h3');


        form.submit(async function(e) 
        {

            e.preventDefault();

            try {

                const response = await checkSessionData();
                if (!response.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Session Expired',
                        text: response.message
                    });
                    return;
                }

                swal_waiting_popup('Please wait...');
                errorContainer.hide();

                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                submitButton.attr({ disabled: true });

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

                pinApi.createCardToken(card)
                    .then(handleSuccess, handleError)
                    .done();

            } catch (error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to verify session.'
                });

            }
        });   

            

        async function handleSuccess(card) 
        {

            paymentFormData['_token'] = `{{ csrf_token() }}`;
            paymentFormData['pin_token'] = card.token;
            if (updatedPlanSummary?.data?.pay_data) {

                const encrypted =  encryptBenefitData(
                    updatedPlanSummary.data.pay_data
                );

                paymentFormData['benefit_token'] = encrypted;
                paymentFormData['payload_data'] =  JSON.stringify(updatedPlanSummary.data);
                Swal.close();
            }

                console.log('paymentFormData',paymentFormData)
                
                $("#sendOtp_modal").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });

                form.closest('.modal').modal('hide');
        }

        function handleError(response) 
        {
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
            Swal.close();
            submitButton.removeAttr('disabled');
        }

    });


    var processPaymentForm = function() {

       
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: paymentFormData,
            beforeSend: function() {
            swal_waiting_popup({'title': 'Processing Payment. do not refresh or close this page'});
            },
            success: function(response, textStatus, xhr) {
                Swal.close();
                paymentFormData = {};
                //submitButton.removeAttr('disabled');
                console.log('response',response);
                let option = getStatusOption(xhr);
                console.log('response.action',response.action);
                switch (response.action) {

                    case 'listing': 
                    displaySwal(xhr).then((result) => {
                            if (result.isConfirmed) {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                }
                            }
                        });

                     break;   
                    
                
                    case 'extend': 
                    displaySwal(xhr).then((result) => {
                            if (result.isConfirmed) {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                }
                            }
                        });
                    break; 

                    case 'bumpup': 
                    table.ajax.reload(null, false);
                    $('.modal').modal('hide');
                    swal_success_popup(option.message);
                    setTimeout(function () {
                    Swal.close();  
                    location.reload();     
                    }, 3000);
                    break; 
                    

                    default: 
                    displaySwal(xhr).then((result) => {
                        if (result.isConfirmed) {
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        }
                    });
                    break;
                }
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
                submitButton.prop('disabled', false);
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



   



    
   
</script>
@endprepend