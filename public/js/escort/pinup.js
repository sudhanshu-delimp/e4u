let pinupFrom = $(".modal-form-pinup form");
let pinupFromButton = pinupFrom.find(":submit");
let btn_pinup_profile = document.getElementById("btn_pinup_profile");
pinupFromButton.disabled = true;
$(document).on('change', '#pinup_profile_id', function () {
    let weekSelect = document.getElementById('pinup_week');
    let escortId = $(this).val();
    $.ajax({
        url: '/escort-dashboard/pinup-available-weeks/' + escortId,
        type: 'GET',
        success: function (response) {
            weekSelect.innerHTML = '<option value="">Select a week</option>';
            if (response.success) {
                response.weeks.forEach(week => {
                    let label = `${week.start} (Mon)  -To-  ${week.end} (Sun)`;
                    let value = `${week.start}|${week.end}`;

                    let option = document.createElement('option');
                    option.value = value;
                    option.textContent = label;
                    weekSelect.appendChild(option);
                });
                pinupFromButton.disabled = false;
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Pin Up',
                    text: response.message
                });
                pinupFromButton.disabled = true;
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Pin Up',
                text: response.message
            });
            pinupFromButton.disabled = true;
        }
    });
});

pinupFrom.on('submit', function (e) {
    e.preventDefault();
    pinupFromButton.disabled = true;
    $.ajax({
        url: pinupFrom.attr('action'),
        method: pinupFrom.attr('method'),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: pinupFrom.serialize(),
        beforeSend: function () {
            showLoadingPopup();
        },
        success: function (response, textStatus, xhr) {
            Swal.close();
            if (response.success) {
                if (response.validation) {
                    pinupFrom.closest('.modal').modal('hide');
                    $("#modalPaymentButton").trigger('click');
                }
                else {
                    pinupFrom.closest('.modal').modal('hide');
                    table.draw();
                    displaySwal(xhr);
                }
            }
            pinupFromButton.disabled = false;
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
            pinupFromButton.disabled = false;
        }
    });
});

$("#pinupSummary").on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let dataId = button.data('id');
    $.ajax({
        url: `/escort-dashboard/pinup-summary/${dataId}`,
        type: 'GET',
        beforeSend: function () {
            $("#pinupSummary .modal-dialog .modal-body").html(`<div class="text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span></div>`);
        },
        success: function (data) {
            if (data.success) {
                $("#pinupSummary .modal-dialog").html(data.html);
            }
        },
        error: function (xhr) {
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
            pinupFromButton.disabled = false;
        }
    });
});