<script>


$(document).ready(function(){


    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const d = String(today.getDate()).padStart(2, '0');
    const todayStr = `${y}-${m}-${d}`;

    $('#start_date_mc').val(todayStr).attr('min', todayStr);
    $('#end_date_mc').val(todayStr).attr('min', todayStr);



            $('#add-new-row-mc').on('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('membershipModal_mc'));
                modal.show();
            });

            $('#reckoner_mc tbody').html(`
                <tr class="blank-row">
                    <td colspan="6" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner_mc tfoot').hide();

            $('#add-new-row-mc').on('click', function () {
                //setNextStartDate();
                var modal = new bootstrap.Modal(document.getElementById('membershipModal_mc'));
                modal.show();
                
            });

            $('#start_date_mc, #start_date_mc').on('input change', function () {
                $(this).removeClass('input-error');
                $(this).siblings('.invalid-feedback').addClass('d-none');
            });

    });


    // ############ Calculater ###########

   $(document).ready(function() {

    
    function formatForInput_mc(dateObj) {
        const y = dateObj.getFullYear();
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const d = String(dateObj.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    
    function parseDisplayDate_mc(str) {
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

   
    function getLastRowEndDate_mc() {
        const lastRow = $('#reckoner_mc tbody tr').not('.blank-row').last();
        if (!lastRow.length) return null;
        const endText = lastRow.find('td').eq(1).text().trim();
        return parseDisplayDate_mc(endText);
    }

    
    $('#membershipModal_mc').on('show.bs.modal', function () {
        const lastEnd = getLastRowEndDate_mc();

       

    if (!lastEnd) {
        let today = new Date();
        let todayStr = formatForInput_mc(today);

        $('#start_date')
            .attr('min', todayStr)
            .val(todayStr);

        $('#end_date')
            .attr('min', todayStr)
            .val(todayStr);

    } else {
        
        const nextDay = new Date(lastEnd);
        nextDay.setDate(nextDay.getDate() + 1);
        const nextStr = formatForInput_mc(nextDay);

        $('#start_date_mc')
            .attr('min', nextStr)
            .val(nextStr);

        $('#end_date_mc')
            .attr('min', nextStr)
            .val(nextStr);
    }


        // Clear any validation UI if you have
        $('#start_date_mc, #end_date_mc').removeClass('input-error');
        $('#start_date_mc, #end_date_mc').siblings('.invalid-feedback').addClass('d-none');
    });


    // ======= SUBMIT (with client-side check against min) =======
    $('#membership_modal_popup').on('submit', function (e) {
        e.preventDefault();

        console.log('ffsfsfsfsfs');

        // client-side validation against min and start <= end
        const startVal = $('#start_date_mc').val(); // yyyy-mm-dd
        const endVal = $('#end_date_mc').val();     // yyyy-mm-dd
        const minVal = $('#start_date_mc').attr('min'); // may be undefined

        let hasError = false;
        $('#start_date_mc, #end_date_mc').removeClass('input-error');
        $('#start_date_mc, #end_date_mc').siblings('.invalid-feedback').addClass('d-none');

        if (!startVal) {
            $('#start_date_mc').addClass('input-error');
            $('#start_date_mc').siblings('.invalid-feedback').removeClass('d-none').text('Start date is required.');
            hasError = true;
        } else if (minVal && startVal < minVal) {
            $('#start_date_mc').addClass('input-error');
            $('#start_date_mc').siblings('.invalid-feedback').removeClass('d-none').text('Start date must be after previous add-on end date.');
            hasError = true;
        }

        if (!endVal) {
            $('#end_date_mc').addClass('input-error');
            $('#end_date_mc').siblings('.invalid-feedback').removeClass('d-none').text('End date is required.');
            hasError = true;
        } else if (endVal < startVal) {
            $('#end_date_mc').addClass('input-error');
            $('#end_date_mc').siblings('.invalid-feedback').removeClass('d-none').text('End date cannot be earlier than start date.');
            hasError = true;
        }

        if (hasError) return;

       
        let formData = {
            location: 1,
            start_date: startVal,
            end_date: endVal,
            membership_id: 5,
            members: 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: "{{route('agent.reckoner-calculate')}}",
            type: "POST",
            data: formData,
            success: function (response) {

                console.log('response',response);

                const data = {
                    locationText: $('#state option:selected').text(),
                    startFormatted: response.start_formatted,
                    endFormatted: response.end_formatted,
                    membershipName: response.membership_name,
                    members: $('#cal_members_mc').val(),
                    fee: response.fee,
                    days: response.days,
                    locationValue: ''
                };

                // Remove blank row
                $('#reckoner_mc tbody tr.blank-row').remove();

                // Add new row
                $('#reckoner_mc tbody').append(buildDataRow_mc(data));

                // Update total footer
                updateTotal_mc();

                // Reset modal form
                $('#membership_modal_popup')[0].reset();

                // Close modal
                $('#membershipModal_mc .close').trigger('click');
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
    function buildDataRow_mc({ locationText, startFormatted, endFormatted, membershipName, members, fee, days, locationValue }) {
        return `
            <tr data-location="${locationValue}">
               
                <td class="text-center">${startFormatted}</td>
                <td class="text-center">${endFormatted}</td>
                <td class="text-center">${days}</td>
                <td class="text-center">${membershipName}</td>
                <td class="text-center">${members}</td>
                <td class="text-right">
                    <input type="hidden" class="row-fee" value="${fee}">
                    ${fee}
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>
        `;
    }



    // ============================
    // UPDATE TOTAL FEES (unchanged)
    // ============================
    function updateTotal_mc() {
        let total = 0;
        let rows = $('#reckoner_mc tbody tr').not('.blank-row');

        if (rows.length === 0) {
            $('#reckoner_mc tbody').html(`
                <tr class="blank-row">
                    <td colspan="7" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner_mc tfoot').hide();
            return;
        }

        rows.each(function () {
            let feeString = $(this).find('.row-fee').val();
            let cleanString = feeString.replace(/,/g, '');
            total += parseFloat(cleanString) || 0;
            console.log('total===',total);
        });

        $('#reckoner_mc tfoot').html(`
            <tr class="custom-last-row">
                <td colspan="6" class="text-right font-weight-bold">Total Fees:</td>
                <td  class="font-weight-bold text-center">$${total.toFixed(2)}</td>
            </tr>
        `).show();
    }


    $('#reckoner_mc').on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotal_mc();
    });

   
    (function init() {
        // if there are no rows pre-existing, show blank
        if ($('#reckoner_mc tbody tr').not('.blank-row').length === 0) {
            $('#reckoner_mc tbody').html(`
                <tr class="blank-row">
                    <td colspan="7" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner_mc tfoot').hide();
        } else {
            updateTotal_mc();
        }
    })();



     $('#reset-reckoner-mc').on('click', function () {
        resetReckoner_mc();
    });


    function resetReckoner_mc() {
    
    $('#reckoner_mc tbody').html(`
        <tr class="blank-row">
            <td colspan="7" class="text-center text-muted">No Profile Added.</td>
        </tr>
    `);

    // Hide footer totals
    $('#reckoner_mc tfoot').hide().empty();

    // Reset form fields
    $('#membership_modal_popup')[0].reset();
    $('#start_date_mc, #end_date_mc').removeAttr('min');

    // Reset date pickers → set today's date
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const d = String(today.getDate()).padStart(2, '0');
    const todayStr = `${y}-${m}-${d}`;

    $('#start_date_mc').val(todayStr).attr('min', todayStr);
    $('#end_date_mc').val(todayStr).attr('min', todayStr);
}
    

});   
</script>