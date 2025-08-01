let savePinupButton = document.getElementById("savePinupButton");
let btn_pinup_profile = document.getElementById("btn_pinup_profile");
savePinupButton.disabled = true;
$(document).on('change','#pinup_profile_id', function(){
    let weekSelect = document.getElementById('pinup_week');
    let escortId = $(this).val();
    $.ajax({
        url: '/escort-dashboard/pinup-available-weeks/' + escortId,
        type: 'GET',
        success: function(response) {
            weekSelect.innerHTML = '<option value="">Select a week</option>';
            if(response.success){
                response.weeks.forEach(week => {
                    let label = `${week.start} (Mon)  -To-  ${week.end} (Sun)`;
                    let value = `${week.start}|${week.end}`;

                    let option = document.createElement('option');
                    option.value = value;
                    option.textContent = label;
                    weekSelect.appendChild(option);
                });
                savePinupButton.disabled = false;
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Pin Up',
                    text: response.message
                });
                savePinupButton.disabled = true;
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Pin Up',
                text: response.message
            });
            savePinupButton.disabled = true;
        }
    });
});

savePinupButton.addEventListener("click", function (e) {
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
    savePinupButton.disabled = true;
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
        success: function(data) {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Register for Pin Up',
                    text: data.message
                });
                form.reset();
                savePinupButton.disabled = false;
                $("#pinup_profile").modal('hide');
                btn_pinup_profile.disabled = true;
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