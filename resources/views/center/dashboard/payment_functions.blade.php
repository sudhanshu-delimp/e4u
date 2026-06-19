<script>

function make_order_summury(plandata) {
    return $.ajax({
        url: "{{route('center.make_order_summury')}}",
        method: 'POST',
        data: plandata
    });
}


$(document).on('submit', '#adjustment-form',  function(e) {
    e.preventDefault();

        var adjustmentForm = $('#adjustment-form');
        let formData = adjustmentForm.serializeArray();

        Object.keys(plandata).forEach(key => {
            formData.push({
            name: key,
            value: plandata[key]
            });
        });

        $.ajax({
            url: adjustmentForm.attr('action'),
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: $.param(formData),
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
                    // $(".order_summary_adjustment").html(res.html);
                    // addOrUpdateHiddenInput('adjustment-form', 'benefit_token', res.benefit_token)
                    // if (res.total_amount) {
                    //     $("#payment-form").find('input, button, select, textarea').prop('disabled',
                    //         false);
                    //     finishPaymentForm.find('input, button, select, textarea').prop('disabled',
                    //         true);
                    //     finishPaymentForm.parent().addClass('d-none');
                    // } else {
                    //     $("#payment-form").find('input, button, select, textarea').prop('disabled',
                    //         true);
                    //     finishPaymentForm.find('input, button, select, textarea').prop('disabled',
                    //         false);
                    //     finishPaymentForm.parent().removeClass('d-none');
                    // }
                } else {
                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                    });
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
    
});





</script>