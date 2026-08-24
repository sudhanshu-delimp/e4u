

$('#passwordExpiry').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    $("#modal-title").text('Password Expiry');

    if (form.parsley().isValid()) {
        var url = form.attr('action');
        var data = new FormData(form[0]);

        $.ajax({
            method: form.attr('method'),
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.status === true) {
                    showAlert('success', 'Success',data.message);
                    $("#resetPasswordDate").modal('hide');
                    $('#passwordExpiryText').html(data.data.text);
                }
            },
            error: function (xhr) {
                var errorMsg = "Something went wrong.";
                // If the server sent a JSON response with a message
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    // Try to parse manual JSON if server responded as plain text
                    try {
                        var res = JSON.parse(xhr.responseText);
                        if (res.message) {
                            errorMsg = res.message;
                        }
                         showAlert('error', 'Error',errorMsg);
                    } catch (e) {
                        // Not JSON, keep the generic message
                    }
                }

            }
        });
    }
});
