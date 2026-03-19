function readVarificationImageURL(input) {
    if (input.files && input.files[0]) {
        var $img = $(input).siblings('img');
        var reader = new FileReader();
        reader.onload = function (e) {
            $img.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).off('submit', '#mediaVerification');
$(document).on('submit', '#mediaVerification', function (e) {

    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    let button = $('#verifyMediaBtn');
    button.text('Verifying...');
    button.prop('disabled', true);

    let fileInput = $(form).find('input[type="file"]')[0];
    let verificationType = $('input[name="verification_type"]:checked').val();

    if (!verificationType) {
        Swal.fire({
            icon: 'warning',
            title: 'Verification Type Required',
            text: 'Please select verification type.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    if (!fileInput.files.length) {
        Swal.fire({
            icon: 'warning',
            title: 'Image Required',
            text: 'Please upload verification image.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    let file = fileInput.files[0];

    let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!allowedTypes.includes(file.type)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid File Type',
            text: 'Only JPG and PNG images are allowed.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    let maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        Swal.fire({
            icon: 'error',
            title: 'File Too Large',
            text: 'Image size must be less than 5MB.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    $.ajax({
        url: $(form).attr('action'),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message ?? 'Verification submitted successfully.'
            });

             // form.reset();  // 
            $('#mediaVerificationModal').modal('hide');
        },
        error: function (xhr) {

            let errors = xhr.responseJSON?.errors;
            let errorMsg = '';

            if (errors) {
                $.each(errors, function (key, value) {
                    errorMsg += value[0] + "<br>";
                });
            } else {
                errorMsg = 'Something went wrong.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMsg
            });
        },
        complete: function () {
            button.prop('disabled', false);
            button.text('Verify Media');
        }
    });

});