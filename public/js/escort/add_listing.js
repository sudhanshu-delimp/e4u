let addListingButton = document.getElementById("add_listing");

addListingButton.addEventListener("click", function () {
    let $clone  = $(".listing_area .eachListing:first").clone();

    let selectedLocations = $('select[name="escort_id[]"]').map(function () {
            return $(this).val();
        }).get().filter(val => val !== "");
    $clone.find('input, select').val('');
    let $select = $clone.find('select[name="escort_id[]"]');
    $select.find('option').each(function () {
        let val = $(this).val();
        if (val && selectedLocations.includes(val)) {
            $(this).hide();
        }
    });

    $(".listing_area").append($clone);
    $("#add_listing").prop("disabled", true);
    updateSelectOptions();
});

$(document).on('click', '.removeCross', function () {
    if ($('.eachListing').length > 1) {
        $(this).closest('.eachListing').remove();
        updateSelectOptions();
    }
});

$(document).on('change', 'select[name="escort_id[]"]', updateSelectOptions);

function updateSelectOptions() {
    let selectedValues = [];
    $('select[name="escort_id[]"]').each(function () {
        const val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('select[name="escort_id[]"]').each(function () {
        let currentSelect = $(this);
        let currentValue = currentSelect.val();
        currentSelect.find('option').each(function () {
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

$(document).on('input change, select[name="escort_id[]"], input[name="start_date[]"], input[name="end_date[], select[name="membership[]"]"]', function () {
    checkLastRowDates();
});

$(document).on('change', 'input[name="start_date[]"]', function () {
    let $row = $(this).closest('.eachListing');
    let startDate = $(this).val();
    let $endInput = $row.find('input[name="end_date[]"]');

    if (startDate) {
        $endInput.attr('min', startDate);
        if ($endInput.val() && $endInput.val() < startDate) {
            $endInput.val('');
        }
    } else {
        $endInput.removeAttr('min');
    }
});

