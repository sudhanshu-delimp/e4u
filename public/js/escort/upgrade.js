let upgradeFrom = $(".modal-form-upgrade form");
let upgradeFromButton = upgradeFrom.find('.modal-footer button[type="button"]');

upgradeFrom.on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: upgradeFrom.attr('action'),
        method: upgradeFrom.attr('method'),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: upgradeFrom.serialize(),
        beforeSend: function () {
            showLoadingPopup();
        },
        success: function (response, textStatus, xhr) {
            Swal.close();
            if (response.success) {
                upgradeFrom.closest('.modal').modal('hide');
                table.draw();
                displaySwal(xhr);
            }
            $("#modalPaymentButton").prop("disabled", true);
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
            $("#modalPaymentButton").prop("disabled", false);
        }
    });
});

$('#upgrade_profile_id').on('change', function () {
    let selectedMembership = parseInt($(this).find(':selected').data('membership'));

    let membershipSelect = $('#membershipId');

    membershipSelect.find('option').each(function () {
        let value = parseInt($(this).val());

        if ($(this).val() == "") {
            $(this).show(); // placeholder
        } else if (value < selectedMembership) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    membershipSelect.val('').trigger('change');
});

$(document).on('change', '#membershipId', function () {
    let membershipId = $(this).val();
    let escortId = $(this).parents('form').find('select[name="escort_id"]').val();
    console.log(membershipId, escortId);
    if (membershipId) {
        return $.ajax({
            url: `${window.App.baseUrl}escort-dashboard/get-upgrade-amount`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            dataType: "json",
            data: { escortId, membershipId },
            beforeSend: function () {

            },
        }).done(function (response) {
            if (response.success) {
                upgradeFrom.find("input[name='upgrade_amount']").val(response.net_amount);
                upgradeFromButton.attr('fee_token', response.fee_token);
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    else {
        $("#upgrade_amount").val('0.00');
    }
});


