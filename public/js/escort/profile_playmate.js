$(() => {
    var getAvailablePlaymates = function(searchValue=''){
        let escortId = window.App.escortId;
        return $.ajax({
            url: `${window.App.baseUrl}escort-dashboard/available-playmates`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            dataType: "json",
            data:{escortId,stateId,searchValue},
            beforeSend: function () {
                $(".playmates-card-grid").html(`<div class="alert alert-info">Please wait a moment while we find your available Playmates.</div>`);
            },
        }).done(function (response) {
            if (response.success) {
                $(".playmates-card-grid").html(response.playmates_container_html);
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    
    let stateId = $("#state_id").val();
    if(stateId && $(".playmates-card-grid").length > 0){
        getAvailablePlaymates();
    }
    
    $(document).on('keyup','#profileSearch', function(){
        let obj = $(this);
        let searchValue = obj.val();
        if(searchValue.length > 3){
            getAvailablePlaymates(searchValue);
        }
        if(searchValue.length === 0){
            getAvailablePlaymates();
        }
    });

    $('#myplaymates').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);

        if (form.parsley().isValid()) {

            $('#my_playmates').prop('disabled', true);
            $('#my_playmates').html('<div class="spinner-border"></div>');
            var url = form.attr('action');
            var data = new FormData($('#myplaymates')[0]);
            

            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        Swal.fire('Updated', '', 'success');
                        $('#my_playmates').prop('disabled', false);
                        $('#my_playmates').html('Save');
                        getAvailablePlaymates();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops.. somthing wrong Please try again',
                            text: data.message
                        });
                        $('#my_playmates').prop('disabled', false);
                        $('#my_playmates').html('Save');
                    }
                }
            });
        }
    });

    $(document).on('click','input[name^="add_playmate"],input[name^="update_playmate"]',function(){
        $(this).is(':checked')?$(this).next().text('Included as Playmate'):$(this).next().text('Add as Playmate');
    })
});



