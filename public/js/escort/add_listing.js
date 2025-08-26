let addListingButton = document.getElementById("add_listing");

addListingButton.addEventListener("click", function() {
    let $clone = $(".listing_area .eachListing:first").clone();

    let selectedLocations = $('select[name="escort_id[]"]').map(function() {
        return $(this).val();
    }).get().filter(val => val !== "");
    $clone.find('input, select').val('');
    let $select = $clone.find('select[name="escort_id[]"]');
    $select.find('option').each(function() {
        let val = $(this).val();
        if (val && selectedLocations.includes(val)) {
            $(this).hide();
        }
    });

    $(".listing_area").append($clone);
    $("#add_listing").prop("disabled", true);
    updateSelectOptions();
});

$(document).on('click', '.removeCross', function() {
    if ($('.eachListing').length > 1) {
        $(this).closest('.eachListing').remove();
        updateSelectOptions();
    }
});

$(document).on('change', 'select[name="escort_id[]"]', updateSelectOptions);

function updateSelectOptions() {
    let selectedValues = [];
    $('select[name="escort_id[]"]').each(function() {
        const val = $(this).val();
        if (val) selectedValues.push(val);
    });

    let row = $(this).closest('.eachListing');
    let escortId = row.find('select[name="escort_id[]"] option:selected').val();
    let startDate = row.find('input[name="start_date[]"]').val();
    let endDate = row.find('input[name="end_date[]"]').val();
    if(startDate && endDate){
        validateSelectedDateRange(row, {startDate,endDate,escortId});
    }

    $('select[name="escort_id[]"]').each(function() {
        let currentSelect = $(this);
        let currentValue = currentSelect.val();
        currentSelect.find('option').each(function() {
            let optionVal = $(this).val();
            $(this).show();
            if (optionVal && optionVal !== currentValue && selectedValues.includes(optionVal)) {
                $(this).hide();
            }
        });
    });
}

function checkLastRowDates() {
    let $lastRow = $(".eachListing").last();
    let start = $lastRow.find('input[name="start_date[]"]').val();
    let end = $lastRow.find('input[name="end_date[]"]').val();
    let escort_id = $lastRow.find('select[name="escort_id[]"]').val();
    let membership = $lastRow.find('select[name="membership[]"]').val();

    if (start !== "" && end !== "" && escort_id !== "" && membership !== "") {
        $("#add_listing").prop("disabled", false);
    } else {
        $("#add_listing").prop("disabled", true);
    }
}

$(document).on('input change, select[name="escort_id[]"], input[name="start_date[]"], input[name="end_date[], select[name="membership[]"]"]', function() {
    checkLastRowDates();
});

$(document).on('change', 'input[name="start_date[]"]', function() {
    let $row = $(this).closest('.eachListing');
    let startDate = $(this).val();
    let endDate = $row.find('input[name="end_date[]"]');
    let escortId = $row.find('select[name="escort_id[]"] option:selected').val();
    if (startDate) {
        endDate.attr('min', startDate);
        if (endDate.val() && endDate.val() < startDate) {
            endDate.val('');
        }
    } else {
        endDate.removeAttr('min');
    }
    endDate = endDate.val();
    if(endDate && escortId){
        validateSelectedDateRange($row, {startDate,endDate,escortId});
    }
});

$(document).on('change', 'input[name="end_date[]"]', function() {
    let row = $(this).closest('.eachListing');
    let endDate = $(this).val();
    let startDate = row.find('input[name="start_date[]"]').val();
    let escortId = row.find('select[name="escort_id[]"] option:selected').val();
    if(startDate && escortId){
        validateSelectedDateRange(row, {startDate,endDate,escortId});
    }
});

var validateSelectedDateRange = function(object, requestPayload){
    return false;
    
    $.ajax({
        url: '/escort-dashboard/listing/validate-date-range',
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: requestPayload,
        success: function (response) {
            if(response.success){
                object.find('input[name="start_date[]"]').val('');
                object.find('input[name="end_date[]"]').val('');
                Swal.fire({
                    title: 'Listings',
                    text: `${response.message}`,
                    icon: 'warning'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error in location filter:', error);
        }
    });
}