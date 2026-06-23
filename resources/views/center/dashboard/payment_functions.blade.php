<script>

   function make_order_summury(plandata) {

    return $.ajax({
        url: "{{route('center.make_order_summury')}}",
        method: 'POST',
        data: plandata,
        success: function(response) {

            updatedPlanSummary = response;
            if (response && response.data) {
                $(".paymentSubtotal").text(response.data.paymentSubtotal);
                $(".paymentTotal").text(response.data.total_fee);
                $(".taxAmount").text(response.data.gstTax);
                $('.totalDue').text(response.data.total_due);
                $('.wallet_amount').text(response.data.wallet_use);
                $('.loyalty_amount').text(response.data.loyalty_use);
                
            } else {
                console.error("Response data format sahi nahi hai.");
            }
        },
        error: function(xhr) {
            console.error("Summary update failed:", xhr.responseText);
        }
    });
}

    
    
$(document).on('submit', '#adjustment-form', function(e) {

    e.preventDefault();

    let adjustmentForm = $('#adjustment-form');
    let formData = adjustmentForm.serializeArray();

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

        success: function(res) {
            
            console.log('Main AJAX Response:', res);

            try 
            {
             
                let loyalty = res.loyality_amount !== undefined ? res.loyality_amount : 0;
                let wallet = res.wallet_balance !== undefined ? res.wallet_balance : 0;
                let loyalty_day = res.loyalty_day !== undefined ? res.loyalty_day : 0;

                let updatedPlanData = {
                    ...plandata,
                    loyalty_discount: loyalty,
                    wallet_discount: wallet,
                    loyalty_day: loyalty_day,
                   
                };

                make_order_summury(updatedPlanData)
                .done(function(summaryResponse) {
                    updatedPlanSummary = summaryResponse;
                    console.log('updatedPlanSummary:', updatedPlanSummary);
                    Swal.close();
                    swal_success_popup(res.message);
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

 $(document).on("click", ".reset_benifit", async function () {

        $('input[name="wallet_amount"]').val('');
        $('input[name="loyalty_day"]').val('')
        let response = await make_order_summury(plandata);

    });


</script>