$("#upgrade_modal").on('show.bs.modal', function(event){
    let button = $(event.relatedTarget);
    let profileId   = button.data('id');
    let membership = button.data('membership');
    let select = $('#membershipId');
    select.find('option').show();
    select.val('');
    if(membership==2){
        select.find('option[value="2"]').hide();
    }
    $(this).find('form input[name="profile_id"]').val(profileId);
});

$(document).on('change','#membershipId', function(){
    let membershipId = $(this).val();
    let profieId = $(this).parents('form').find('input[name="profile_id"]').val();
    console.log(membershipId, profieId);
    if(membershipId){
        return $.ajax({
            url: `${window.App.baseUrl}escort-dashboard/get-upgrade-amount`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            dataType: "json",
            data:{profieId,membershipId},
            beforeSend: function () {
                
            },
        }).done(function (response) {
            if (response.success) {
                console.log(response);
                $("#upgrade_amount").val(response.net_amount);
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    else{
        $("#upgrade_amount").val('0.00');
    }
});

$(document).on('submit','#upgrade_modal_form', function(e){
    e.preventDefault();
    let form = $(this);
    let formData = form.serialize();
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: formData,
        beforeSend: function () {
            form.find('button[type="submit"]').attr('disabled','disabled');
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    text: response.message
                });
                table.draw();
                form.trigger('reset');
                $("#upgrade_modal").modal('hide');
            }
            form.find('button[type="submit"]').removeAttr('disabled');
        },
        error: function (xhr) {
            $('#saveBumpupButton').html('<span style="color:red">Error occurred</span>');
        }
    });
});

