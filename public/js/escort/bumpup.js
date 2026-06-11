let bumpUpFrom = $(".modal-form-bumpUp form");
let bumpUpFromFromButton = bumpUpFrom.find('.modal-footer button[type="button"]');

bumpUpFromFromButton.prop('disabled', true);
$("#modalPaymentButton").prop("disabled", true);
$(document).on('change', '#bumpUpProfileId', function () {
    bumpUpFromFromButton.prop('disabled', !$(this).val().trim());
});

bumpUpFrom.on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: bumpUpFrom.attr('action'),
        method: bumpUpFrom.attr('method'),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: bumpUpFrom.serialize(),
        beforeSend: function () {
            showLoadingPopup();
        },
        success: function (response, textStatus, xhr) {
            Swal.close();
            if (response.success) {
                bumpUpFrom.closest('.modal').modal('hide');
                table.draw();
                displaySwal(xhr);
            }
            $("#modalPaymentButton").prop("disabled", true);
        },
        error: function (xhr) {
            Swal.close();
            if (xhr.status === 422) {
                let messages = Object.values(JSON.parse(xhr.responseText).errors).flat().join('<br>');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: messages
                });
            } else {
                let message = JSON.parse(xhr.responseText).message;
                Swal.fire({
                    icon: 'error',
                    title: xhr.statusText,
                    text: message || 'Something went wrong.'
                });
            }
            $("#modalPaymentButton").prop("disabled", false);
        }
    });
});
