
$('#passwordExpiry').on('submit', function(e) {
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
            success: function(data) {
                if (data.status === true) {
                    showGlobalAlert("Password expiry updated successfully.", "success");
                    $("#resetPasswordDate").modal('hide');
                    $('#passwordExpiryText').html(data.text);
                } else {
                    showGlobalAlert(errorsHtml, "danger");
                }
            },
            error: function(data) {
                let errorsHtml = '<ul>';
                $.each(data.responseJSON.errors, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                errorsHtml += '</ul>';
                showGlobalAlert(errorsHtml, "danger");
            }
        });
    }
});

function showGlobalAlert(message, type = 'success') {
    const alertBox = $('#globalAlert');
    alertBox
        .removeClass('d-none alert-success alert-danger')
        .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
        .html(message);

    setTimeout(() => {
        alertBox.addClass('d-none');
    }, 4000); // hide after 4 seconds
}