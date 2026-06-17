let pinupFrom = $(".modal-form-pinup form");
let pinupFromButton = pinupFrom.find(":submit");
let pinupButton = $("#btn_pinup_profile");
let weekSelect = $('#pinup_week');
let locationSelect = $('#pinup_location_id');
let profileSelect = $('#pinup_profile_id');
let pinupTourSelect = $(".modal-form-pinup #escort_tour_id");
pinupFromButton.prop('disabled', true);


var getTourLocations = function (tour_id) {
    $.ajax({
        url: `${window.App.baseUrl}escort-dashboard/get-tour-locations`,
        type: "POST",
        dataType: "json",
        data: {
            tour_id: tour_id,
            module: 'pinup'
        },
        beforeSend: function () {
            locationSelect.empty();
        },
    }).done(function (response) {
        if (response.success) {
            locationSelect.append('<option value="">-- Select Location --</option>');
            $.each(response.locations, function (i, item) {
                locationSelect.append(
                    $('<option>', {
                        value: item.state.id,
                        text: `${item.state.name}`,
                        'data-tour-location-id': item.id,
                        'data-start': item.start_date,
                        'data-end': item.end_date
                    })
                );
            });
        } else {
            locationSelect.append(`<option value="">-- ${response.message}--</option>`);
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
}

pinupTourSelect.on('change', function () {
    getTourLocations($(this).val());
});

$("#pinup_profile").on('show.bs.modal', function (event) {
    locationSelect.empty();
    let button = $(event.relatedTarget);
    let tour_id = button.data('tour-id');
    if (tour_id) {
        pinupTourSelect.parents('.form-group').remove();
        getTourLocations(tour_id);
    }
});

locationSelect.on("change", function () {
    profileSelect.empty();
    weekSelect.empty();
    let tour_location_id = $(this).find(':selected').data('tour-location-id');
    $.ajax({
        url: `${window.App.baseUrl}escort-dashboard/get-tour-location-profiles`,
        type: "POST",
        dataType: "json",
        data: { tour_location_id },
        beforeSend: function () {

        },
    }).done(function (response) {
        if (response.success) {
            profileSelect.append('<option value="">-- Select Profile --</option>');
            $.each(response.profiles, function (i, item) {
                if (item.tour_plan == 1) {
                    profileSelect.append(
                        $('<option>', {
                            value: item.escort.id,
                            text: `${item.escort.name}`
                        })
                    );
                }
            });

            if (profileSelect.find('option').length === 1 && profileSelect.find('option:first').val() === '') {
                profileSelect.empty();
                profileSelect.append('<option value="">-- Platinum Profile does not exist --</option>');
            }
            else {
                weekSelect.append('<option value="">Select a week</option>');
                response.weeks.forEach(week => {
                    weekSelect.append(
                        $('<option>', {
                            value: `${week.start}|${week.end}`,
                            text: `${week.start} (Mon)  -To-  ${week.end} (Sun)`
                        })
                    );
                });
                if (weekSelect.find('option').length === 1 && weekSelect.find('option:first').val() === '') {
                    weekSelect.empty();
                    weekSelect.append('<option value="">-- Weeks does not exist --</option>');
                }
                else {
                    pinupFromButton.prop('disabled', false);
                    $("input[name='tour_location_id']").val(tour_location_id);
                }
            }
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Pin Up',
                text: response.message
            });
            pinupFromButton.prop('disabled', true);
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
});

pinupFrom.on('submit', function (e) {
    e.preventDefault();
    pinupFromButton.prop('disabled', true);
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
                    pinupFrom.find("#modalPaymentButton").trigger('click');
                    //pinupButton.prop('disabled', true);
                }
                else {
                    pinupFrom.closest('.modal').modal('hide');
                    if ($("table#sailorTable").length > 0) {
                        table.draw();
                        displaySwal(xhr);
                    }
                    else {
                        displaySwal(xhr).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            }
            pinupFromButton.prop('disabled', false);
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
            pinupFromButton.prop('disabled', false);
        }
    });
});
