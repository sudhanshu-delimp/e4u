let savePinupButton = document.getElementById("savePinupButton");
let btn_pinup_profile = document.getElementById("btn_pinup_profile");
let locationSelect = $('#pinup_location_id');
let profileSelect = $('#pinup_profile_id');

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
    let tour_location_id = $(this).find(':selected').data('tour-location-id');
    $.ajax({
        url: `${window.App.baseUrl}escort-dashboard/get-tour-location-profiles`,
        type: "POST",
        dataType: "json",
        data:{tour_location_id},
        beforeSend: function () {

        },
    }).done(function (response) {
        if (response.success) {
            profileSelect.append('<option value="">-- Select Profile --</option>');
            $.each(response.profiles, function (i, item) {
                profileSelect.append(
                    $('<option>', {
                    value: item.escort.id,
                    text: `${item.escort.name}`
                    })
                );
            });
        }
        else{
            profileSelect.append(`<option value="">-- ${response.message}--</option>`);
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
});
