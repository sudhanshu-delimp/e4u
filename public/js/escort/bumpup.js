let saveBumpupButton = document.getElementById("saveBumpupButton");
saveBumpupButton.disabled = true;
$(document).on('change','#bumpUpProfileId', function(){
    saveBumpupButton.disabled = !$(this).val().trim();
});

saveBumpupButton.addEventListener("click", function (e) {
    e.preventDefault();
    
    const button = e.target
    const form = button.closest('form');
    if (!form) {
        console.error("Form not found!");
        return;
    }
    const action = form.action;
    const method = form.method;
    const formData = new FormData(form);
    $.ajax({
        url: action,
        method: method,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function(){
            saveBumpupButton.disabled = true;
        },
        success: function(data) {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    text: data.message
                });
                form.reset();
                $("#bumpup_profile").modal('hide');
                table.draw();
            }
        },
        error: function(xhr) {
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
            savePinupButton.disabled = false;
        }
    });
});