console.log('😊 Common JS Loaded');

var initJsDatePicker = function () {
    var $inputs = $(".js_datepicker");
    if ($inputs.length > 0) {
        $inputs.attr('placeholder', 'DD-MM-YYYY');
        $inputs.attr('autocomplete', 'off');
        $inputs.each(function () {
            let options = {
                dateFormat: "dd-mm-yy",
                changeMonth: true, formChanged,
                changeYear: true,
                showAnim: "slideDown",
                constrainInput: false,
                onSelect: function (dateText) {
                    const event = new Event('change', {
                        bubbles: true
                    });
                    this.dispatchEvent(event); // 👈 manually trigger change event
                }
            };
            // Start from today
            if ($(this).hasClass('min_today')) {
                options.minDate = 0;
            }
            $(this).datepicker(options);
        });
    }
}

initJsDatePicker();

$(document).on('input', '.only_digits', function () {
    this.value = this.value.replace(/\D/g, '');
});

$(document).on('input', '.only_digits_decimal', function () {
    this.value = this.value
        .replace(/[^0-9.]/g, '')   // allow digits + dot
        .replace(/(\..*?)\..*/g, '$1'); // allow only ONE dot
});


function date_time_format(dateString) {

    const date = new Date(dateString.replace(" ", "T") + "Z");
    const options = {
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true,
        timeZone: 'Australia/Perth'
    };

    return date.toLocaleString('en-GB', options);
}

function swal_fire(message) {
    Swal.fire(message);
}

function swal_success_popup(message, redirect = null) {

    let config = {
        title: message ? message : 'Action Performed',
        icon: "success",
        draggable: true,
        allowOutsideClick: false,
        allowEscapeKey: false
    };

    if (redirect && redirect.time) {
        config.timer = redirect.time;
        config.showConfirmButton = false;
    }

    Swal.fire(config).then(() => {
        if (redirect && redirect.url) {
            window.location.href = redirect.url;
        }
    });
}

function swal_error_popup(message) {

    Swal.fire({
        title: (message) ? message : 'Action could not performed',
        icon: "error",
        draggable: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}

function swal_error_warning(titile, message) {
    Swal.fire((titile) ? titile : '', (message) ? message : '', 'warning');
}

function swal_waiting_popup(data) {

    let gif_img = `<img src="../../assets/img/wait_loader.gif" alt="loading..." style="width:80px; margin-top:10px;">`;
    let my_html = (data.title) ? '<p>' + data.title + '</p>' + gif_img : '<p>Processing your request...</p>' + gif_img;
    Swal.fire({
        title: 'Please wait...',
        html: my_html,
        showConfirmButton: false,
        allowOutsideClick: false
    });
}


async function isConfirm(data = {}) {

    const result = await Swal.fire({
        title: (data?.title == 'NA' ? "" : "Are you sure ?"),
        text: (data.text ? data.text : ''),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, " + (data.action ? data.action : 'do') + " it!",
        cancelButtonText: data.cancelText ? data.cancelText : "Cancel",
        showDenyButton: data.is_third_button ? true : false,
        denyButtonText: data.is_third_button
            ? (data.third_button_text ? data.third_button_text : "Save it & add another ")
            : undefined,

        denyButtonColor: data.is_third_button
            ? (data.third_button_color ? data.third_button_color : "#0c223d")
            : undefined,


    });

    if (result.isConfirmed) {
        return true;
    }
    else if (result.isDenied) {
        return "redirect";
    }
    else {
        return false;
    }
}



async function changeAlert(data = {}) {
    const result = await Swal.fire({
        title: data.title ?? "Are you sure?",
        text: data.text ?? "",
        icon: data.icon ?? "warning",
        showCancelButton: data.showCancelButton ?? true,
        confirmButtonColor: data.confirmButtonColor ?? "#3085d6",
        cancelButtonColor: data.cancelButtonColor ?? "#d33",
        confirmButtonText: data.confirmButtonText ?? "Yes",
        cancelButtonText: data.cancelButtonText ?? "Cancel",
        reverseButtons: true,
    });

    return result.isConfirmed;
}



function ajaxRequest({
    url,
    method,
    data = {},
    success = function (response) { console.log('Success:', response); },
    error = function (xhr, status, error) { console.error('Error:', error); }
}) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: success,
        error: error
    });
}

function swal_error_warning(titile, message) {
    Swal.fire((titile) ? titile : '', (message) ? message : '', 'warning');
}

function addOrUpdateHiddenInput(formId, name, value) {
    let form = document.getElementById(formId);

    let input = form.querySelector(`input[name="${name}"]`);

    if (input) {
        // Update existing value
        input.value = value;
    } else {
        // Create new hidden input
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;

        form.appendChild(input);
    }
}

var readXHR = (xhr) => {
    let response = xhr.responseJSON || JSON.parse(xhr.responseText.trim());
    console.log(`xhr Response is..`);
    console.log(response);
    return response;
}



var getStatusOption = (xhr) => {
    let icon, title;
    let response = readXHR(xhr);
    var message = response?.message || response?.gateway || 'Something went wrong';
    console.log(message);

    if (message?.errors?.length > 0) {
        message = message.errors.map(error => error.message).join('<br>');
    } else if (message?.error) {
        message = message.error;
    }

    switch (xhr.status) {
        case 200:
            icon = 'success';
            title = title ? title : 'Success';
            break;

        case 400:
            icon = 'warning';
            title = 'Bad Request';
            break;

        case 401:
            icon = 'warning';
            title = 'Unauthorized';
            message = 'Your session has expired. Please login again.';
            break;

        case 403:
            icon = 'warning';
            title = 'Forbidden';
            break;

        case 404:
            icon = 'info';
            title = 'Not Found';
            break;

        case 419:
            icon = 'warning';
            title = 'Unauthorized';
            break;

        case 422:
            icon = 'warning';
            title = 'Validation Error';

            // Show validation errors if exist
            if (response?.errors) {
                message = Object.values(response.errors).flat().join('\n');
            }
            break;

        case 500:
            icon = 'error';
            title = 'Server Error';
            break;

        default:
            icon = 'error';
            title = 'Error';
    }
    return { icon, title, message };
}

var displaySwal = function (xhr, showConfirmButton = true) {
    let option = getStatusOption(xhr);
    return Swal.fire({
        icon: option.icon,
        title: option.title,
        text: option.message,
        showConfirmButton: showConfirmButton,
        allowOutsideClick: false,
    });
}

var showLoadingPopup = function (title = 'Processing', text = 'Please wait...') {
    Swal.fire({
        title,
        text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => Swal.showLoading()
    });
}



function resetUnsavedChanges() {
    formChanged = false;
}

function removeAnythingExceptNumber(value) {
    return value.replace(/\D/g, '');
}

function formatCurrency(amount, currency = '$') {
    amount = parseFloat(amount).toFixed(2);

    let parts = amount.split('.');
    let intPart = parts[0];
    let decimalPart = parts[1];

    let lastThree = intPart.slice(-3);
    let restUnits = intPart.slice(0, -3);

    let formatted;

    if (restUnits !== '') {
        restUnits = restUnits.replace(/\B(?=(\d{2})+(?!\d))/g, ',');
        formatted = restUnits + ',' + lastThree;
    } else {
        formatted = lastThree;
    }

    return currency + formatted + '.' + decimalPart;
}

var getGeoLocationEscortAccountProfiles = function (state = 0) {
    if (state > 0) {
        $.ajax({
            url: `${window.App.baseUrl}escort-dashboard/get-geo-location-profiles`,
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                state
            },
            success: function (response) {
                if (response.success == true) {
                    let profileSelect = document.querySelector(
                        'select[name="escort_id[]"]');
                    profileSelect.innerHTML =
                        '<option value="">Select a profile</option>';

                    response.profiles.forEach(item => {
                        let label = `${item.name} (${item.profile_name})`;
                        let value = `${item.id}`;

                        let option = document.createElement('option');
                        option.value = value;
                        option.textContent = label;
                        profileSelect.appendChild(option);
                    });
                    profileSelect.disabled = false;
                } else {
                    swal.fire('Profile', `${response.message}`, 'error');
                    Swal.fire({
                        title: 'Listings',
                        text: `${response.message}`,
                        icon: 'info',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = `${window.App.baseUrl}escort-dashboard/create-profile`;
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error in location filter:', error);
            }
        });
    }
}

$('.video_icon_ec').append(
    '<div class="video_tooltip">Escort has video to view</div>'
);