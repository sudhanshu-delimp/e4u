<script>
 let adjustmentForm = $('#adjustment-form');
 var finishPaymentForm = $('#finish-payment-form');


function make_order_summury(plandata) 
{
    return $.ajax({
        url: "{{route('center.make_order_summury')}}",
        method: 'POST',
        data: plandata,
        success: function(response) {

            updatedPlanSummary = response;
            if (response && response.data) {
                $(".paymentSubtotal").text(response.data.order_summry.paymentSubtotal);
                $(".paymentTotal").text(response.data.order_summry.total_fee);
                $(".taxAmount").text(response.data.order_summry.gstTax);
                $('.totalDue').text(response.data.order_summry.total_due);
                $('.wallet_amount').text(response.data.order_summry.wallet_use);
                $('.loyalty_amount').text(response.data.order_summry.loyalty_use);
                
            } else {
                console.error("Response data format sahi nahi hai.");
            }
        },
        error: function(xhr) {
            console.error("Summary update failed:", xhr.responseText);
        }
    });
}

    
    
$(document).on('submit', '#adjustment-form', function (e, action, checkAmount = true) {

    e.preventDefault();
    let formData = adjustmentForm.serializeArray();
    console.log('checkAmount',checkAmount);
    formData.push({name: 'checkAmount',value: checkAmount });
    Object.keys(plandata).forEach(key => {
        formData.push({
            name: key,
            value: plandata[key]
        });
    });

    swal_waiting_popup('Applying adjustment');

    $.ajax({
        url: adjustmentForm.attr('action'),
        method: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Safe CSRF token
        },
        data: $.param(formData),

        success:  function(res, textStatus, xhr) {
            
            console.log('Main AJAX Response:', res);

            try 
            {
             
                let loyalty = res.loyality_amount !== undefined ? res.loyality_amount : 0;
                let wallet = res.wallet_balance !== undefined ? res.wallet_balance : 0;
                let loyalty_day = res.loyalty_day !== undefined ? res.loyalty_day : 0;
                let total_amount = res.total_amount !== undefined ? res.total_amount : 0;

                let updatedPlanData = {
                    ...plandata,
                    loyalty_discount: loyalty,
                    wallet_discount: wallet,
                    loyalty_day: loyalty_day,
                    total_fee:total_amount
                   
                };

               

                make_order_summury(updatedPlanData)
                .done(function (summaryResponse) {
                    updatedPlanSummary = summaryResponse;
                    console.log('after make_order_summury :', updatedPlanSummary);
                    Swal.close();

                    /////////// Form Adjustment //////////////
                    let option = getStatusOption(xhr);
                    if (res.status) 
                    {
                        const encrypted =  encryptBenefitData(
                            updatedPlanSummary.data.pay_data
                        );

                        let benefit_token = encrypted;
                        console.log('benefit_token',benefit_token);
                        $(".order_summary_adjustment").html(res.html);
                        addOrUpdateHiddenInput('adjustment-form', 'benefit_token', benefit_token)
                        if (res.total_due_amount) {
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

                      swal_success_popup(res.message);
                    } 
                    else 
                    {
                        Swal.fire({
                            icon: option.icon,
                            title: option.title,
                            text: option.message
                        });
                    }

                    
                })
                .fail(function(err) {
                    console.error('Summary Function Error:', err);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Summary error!' });
                });

            } catch (error) {
                Swal.close();
                console.error('Try Catch Error:', error);
            }
        },

        error: function(xhr) {
            Swal.close();
            let message = 'Error occured while applying benefit';
            if (xhr.responseText) {
                try {
                    let response = JSON.parse(xhr.responseText);
                    message = response.message || message;
                } catch (e) {
                    message = xhr.responseText;
                }
            }
            Swal.fire({icon: 'error',title: 'Error',text: message
            });
        }
    });
});


async function checkSessionData() 
{

    var  checkout_number = "";
    if (Object.keys(updatedPlanSummary?.data?.checkout_number || {}).length > 0 && parseFloat(updatedPlanSummary.data.pay_data.total_amount) > 0)                  
    {
         checkout_number = updatedPlanSummary?.data?.checkout_number;
         checkout_number = encryptBenefitData(checkout_number);
    }
        
    return $.ajax({
            url: "{{route('center.check-payment-session')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                checkout_number:checkout_number,
            }
    });
}

 function encryptBenefitData(data) {
    const jsonData = JSON.stringify(data);
    return CryptoJS.AES.encrypt(
        jsonData,
        CryptoJS.enc.Utf8.parse(secretKey),
        {
            iv: CryptoJS.enc.Utf8.parse(iv),
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }
    ).toString();
}

finishPaymentForm.submit(function(e) {
        e.preventDefault();
        let submitButton = finishPaymentForm.find(":submit");
        submitButton.attr({
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
                console.log('response' , response);
                Swal.close();
                submitButton.removeAttr('disabled');
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
                submitButton.removeAttr('disabled');
            }
        });
    });

    $(document).on("click", ".reset_benifit", function (e) {
        e.preventDefault();
        adjustmentForm[0].reset();
      
        $('#adjustment-form').trigger('submit', ['listing', false]);
    });
 

</script>