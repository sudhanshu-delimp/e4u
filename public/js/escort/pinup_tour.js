let savePinupButton = document.getElementById("savePinupButton");
let btn_pinup_profile = document.getElementById("btn_pinup_profile");
let weekSelect = $('#pinup_week');
let locationSelect = $('#pinup_location_id');
let profileSelect = $('#pinup_profile_id');
savePinupButton.disabled = true;
$("#pinup_profile").on('show.bs.modal', function (event) {
    locationSelect.empty();
    let button = $(event.relatedTarget);
    let tour_id = button.data('tour-id');
    $.ajax({
        url: `${window.App.baseUrl}escort-dashboard/get-tour-locations`,
        type: "POST",
        dataType: "json",
        data:{tour_id,module:'pinup'},
        beforeSend: function () {

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
        }
        else{
            locationSelect.append(`<option value="">-- ${response.message}--</option>`);
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
});

locationSelect.on("change", function() {
    profileSelect.empty();
    weekSelect.empty();
    let tour_location_id = $(this).find(':selected').data('tour-location-id');
    $.ajax({
        url: `${window.App.baseUrl}escort-dashboard/get-tour-location-profiles`,
        type: "POST",
        dataType: "json",
        data:{tour_location_id},
        beforeSend: function () {

        },
    }).done(function (response) {
        console.log(response);
        if (response.success) {
            weekSelect.append('<option value="">Select a week</option>');
            response.weeks.forEach(week => {
                weekSelect.append(
                    $('<option>', {
                    value: `${week.start}|${week.end}`,
                    text: `${week.start} (Mon)  -To-  ${week.end} (Sun)`
                    })
                );
            });
            savePinupButton.disabled = false;
            $("input[name='tour_location_id']").val(tour_location_id);

            profileSelect.append('<option value="">-- Select Profile --</option>');
            $.each(response.profiles, function (i, item) {
                if(item.tour_plan==1){
                    profileSelect.append(
                        $('<option>', {
                        value: item.escort.id,
                        text: `${item.escort.name}`
                        })
                    );
                }
            });
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Pin Up',
                text: response.message
            });
            savePinupButton.disabled = true;
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
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
                    title: 'Registered for Pin Up',
                    text: data.message
                });
                form.reset();
                savePinupButton.disabled = false;
                $("#pinup_profile").modal('hide');
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
