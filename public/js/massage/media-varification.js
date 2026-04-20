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
                html: response.message.replace(/\n/g, "<br>")
            });

             // form.reset();  //
            $('.img_alert').show();
            $('.upload_varification_img_wrapper').addClass('has_img');
            $('#veryfy_media').modal('hide');
        },
        error: function (xhr) {
            let errorMsg = 'Something went wrong.';

            if (xhr.responseText) {
                try {
                    let res = JSON.parse(xhr.responseText);
                    if (res.message) {
                        errorMsg = res.message;
                    }
                } catch (e) {
                    console.log('JSON parse error');
                }
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMsg
            });
        },
        complete: function () {
            button.prop('disabled', false);
            button.text('Verify Media');
        }
    });

});