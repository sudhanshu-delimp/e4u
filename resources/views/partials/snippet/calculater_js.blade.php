@php
    $reckonerUrl = match (auth()->user()->type) {
    5 => route('agent.reckoner-calculate'),
    4 => route('centre.reckoner-calculate'),
    default => route('escort.reckoner-calculate'),
};
@endphp

<script>

    let calculateUrl = "{{ $reckonerUrl }}";
    console.log('calculateUrl',calculateUrl);


    $(document).ready(function(){
            $('#add-new-row').on('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
                modal.show();
            });

            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="8" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();

            $('#add-new-row').on('click', function () {
                setNextStartDate();
                var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
                modal.show();
                
            });

            $('#start_date, #end_date').on('input change', function () {
                $(this).removeClass('input-error');
                $(this).siblings('.invalid-feedback').addClass('d-none');
            });

    });


    // ############ Calculater ###########

   $(document).ready(function() {

    // Helper: format Date -> yyyy-mm-dd (for input[type=date])
    function formatForInput(dateObj) {
        const y = dateObj.getFullYear();
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const d = String(dateObj.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    // Helper: parse display date string (supports dd-mm-yyyy, yyyy-mm-dd, mm/dd/yyyy)
    function parseDisplayDate(str) {
        if (!str) return null;
        str = String(str).trim();

        // ISO yyyy-mm-dd or yyyy-mm-ddTHH:MM:SS
        const isoMatch = str.match(/^(\d{4})-(\d{2})-(\d{2})/);
        if (isoMatch) {
            return new Date(Number(isoMatch[1]), Number(isoMatch[2]) - 1, Number(isoMatch[3]));
        }

        // dd-mm-yyyy
        const dmy = str.match(/^(\d{2})-(\d{2})-(\d{4})/);
        if (dmy) {
            return new Date(Number(dmy[3]), Number(dmy[2]) - 1, Number(dmy[1]));
        }

        // mm/dd/yyyy
        const mdy = str.match(/^(\d{2})\/(\d{2})\/(\d{4})/);
        if (mdy) {
            return new Date(Number(mdy[3]), Number(mdy[1]) - 1, Number(mdy[2]));
        }

        // fallback: try Date constructor
        const d = new Date(str);
        return isNaN(d.getTime()) ? null : d;
    }

    // Get last row's End Date as a Date object (or null)
    function getLastRowEndDate() {
        const lastRow = $('#reckoner tbody tr').not('.blank-row').last();
        if (!lastRow.length) return null;

        // end date expected in 3rd td (index 2)
        const endText = lastRow.find('td').eq(2).text().trim();
        return parseDisplayDate(endText);
    }

    

    // When modal opens, set start_date & end_date min = lastEnd + 1 day
    $('#membershipModal').on('show.bs.modal', function () {
        const lastEnd = getLastRowEndDate();

       

    if (!lastEnd) {
        // ⭐ FIRST TIME ONLY → use today as default
        let today = new Date();
        let todayStr = formatForInput(today);

        $('#start_date')
            .attr('min', todayStr)
            .val(todayStr);

        $('#end_date')
            .attr('min', todayStr)
            .val(todayStr);

    } else {
        // ⭐ AFTER FIRST ROW → use last end date + 1 day
        const nextDay = new Date(lastEnd);
        nextDay.setDate(nextDay.getDate() + 1);
        const nextStr = formatForInput(nextDay);

        $('#start_date')
            .attr('min', nextStr)
            .val(nextStr);

        $('#end_date')
            .attr('min', nextStr)
            .val(nextStr);
    }


        // Clear any validation UI if you have
        $('#start_date, #end_date').removeClass('input-error');
        $('#start_date, #end_date').siblings('.invalid-feedback').addClass('d-none');
    });


    // ======= SUBMIT (with client-side check against min) =======
    $('#membershipModal form').on('submit', function (e) {
        e.preventDefault();

        // client-side validation against min and start <= end
        const startVal = $('#start_date').val(); // yyyy-mm-dd
        const endVal = $('#end_date').val();     // yyyy-mm-dd
        const minVal = $('#start_date').attr('min'); // may be undefined

        let hasError = false;
        $('#start_date, #end_date').removeClass('input-error');
        $('#start_date, #end_date').siblings('.invalid-feedback').addClass('d-none');

        if (!startVal) {
            $('#start_date').addClass('input-error');
            $('#start_date').siblings('.invalid-feedback').removeClass('d-none').text('Start date is required.');
            hasError = true;
        } else if (minVal && startVal < minVal) {
            $('#start_date').addClass('input-error');
            $('#start_date').siblings('.invalid-feedback').removeClass('d-none').text('Start date must be after previous add-on end date.');
            hasError = true;
        }

        if (!endVal) {
            $('#end_date').addClass('input-error');
            $('#end_date').siblings('.invalid-feedback').removeClass('d-none').text('End date is required.');
            hasError = true;
        } else if (endVal < startVal) {
            $('#end_date').addClass('input-error');
            $('#end_date').siblings('.invalid-feedback').removeClass('d-none').text('End date cannot be earlier than start date.');
            hasError = true;
        }

        if (hasError) return;

        // prepare AJAX data (unchanged)
        let formData = {
            location: $('#state').val(),
            start_date: startVal,
            end_date: endVal,
            membership_id: $('#cal_memship_type').val(),
            members: $('#cal_members').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: calculateUrl,
            type: "POST",
            data: formData,
            success: function (response) {

                const data = {
                    locationText: $('#state option:selected').text(),
                    startFormatted: response.start_formatted,
                    endFormatted: response.end_formatted,
                    membershipName: response.membership_name,
                    members: $('#cal_members').val(),
                    fee: response.fee,
                    days: response.days,
                    locationValue: $('#state').val()
                };

                // Remove blank row
                $('#reckoner tbody tr.blank-row').remove();

                // Add new row
                $('#reckoner tbody').append(buildDataRow(data));

                // Update total footer
                updateTotal();

                // Reset modal form
                $('#membershipModal form')[0].reset();

                // Close modal
                $('#membershipModal .close').trigger('click');
            },
            error: function (xhr) {
                console.log(xhr.responseJSON || xhr);
                alert("Validation Error");
            }
        });
    });



    // ============================
    // BUILD ROW HTML (unchanged)
    // ============================
    function buildDataRow({ locationText, startFormatted, endFormatted, membershipName, members, fee, days, locationValue }) {
        return `
            <tr data-location="${locationValue}">
                <td>${locationText}</td>
                <td>${startFormatted}</td>
                <td>${endFormatted}</td>
                <td>${membershipName}</td>
                <td class="text-center">${members}</td>
                <td class="text-right">
                    <input type="hidden" class="row-fee" value="${fee}">
                    ${fee}
                </td>
                <td class="text-center">${days}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>
        `;
    }



    // ============================
    // UPDATE TOTAL FEES (unchanged)
    // ============================
    function updateTotal() {
        let total = 0;
        let rows = $('#reckoner tbody tr').not('.blank-row');

        if (rows.length === 0) {
            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="8" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();
            return;
        }

        rows.each(function () {
            let feeString = $(this).find('.row-fee').val();
            let cleanString = feeString.replace(/,/g, '');
            total += parseFloat(cleanString) || 0;
            console.log('total===',total);
        });

        $('#reckoner tfoot').html(`
            <tr class="custom-last-row">
                <td colspan="7" class="text-right font-weight-bold">Total Fees:</td>
                <td  class="font-weight-bold text-center">$${total.toFixed(2)}</td>
            </tr>
        `).show();
    }


    $('#reckoner').on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotal();
    });

   
    (function init() {
        // if there are no rows pre-existing, show blank
        if ($('#reckoner tbody tr').not('.blank-row').length === 0) {
            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="8" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();
        } else {
            updateTotal();
        }
    })();

});   
</script>