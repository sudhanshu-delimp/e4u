let bumpUpFrom = $(".modal-form-bumpUp form");
let bumpUpFromFromButton = bumpUpFrom.find('.modal-footer button[type="button"]');
console.log('bumpUpFrom', bumpUpFromFromButton);
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

// bumpUpFromFromButton.addEventListener("click", function (e) {
//     e.preventDefault();

//     const button = e.target
//     const form = button.closest('form');
//     if (!form) {
//         console.error("Form not found!");
//         return;
//     }
//     const action = form.action;
//     const method = form.method;
//     const formData = new FormData(form);
//     $.ajax({
//         url: action,
//         method: method,
//         data: formData,
//         processData: false,
//         contentType: false,
//         headers: {
//             'Accept': 'application/json',
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//         },
//         beforeSend: function () {
//             bumpUpFromFromButton.prop('disabled', true);
//         },
//         success: function (data) {
//             if (data.success) {
//                 Swal.fire({
//                     icon: 'success',
//                     text: data.message
//                 });
//                 form.reset();
//                 $("#bumpup_profile").modal('hide');
//                 table.draw();
//             }
//         },
//         error: function (xhr) {
//             if (xhr.status === 422) {
//                 let messages = Object.values(JSON.parse(xhr.responseText).errors).flat().join('<br>');
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Validation Error',
//                     html: messages
//                 });
//             } else {
//                 let message = JSON.parse(xhr.responseText).message;
//                 Swal.fire({
//                     icon: 'error',
//                     title: xhr.statusText,
//                     text: message || 'Something went wrong.'
//                 });
//             }
//             savePinupButton.disabled = false;
//         }
//     });
// });