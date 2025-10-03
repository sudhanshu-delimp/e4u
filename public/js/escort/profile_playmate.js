$(() => {
    var getAvailablePlaymates = function(){
        return $.ajax({
            url: `${window.App.baseUrl}escort-dashboard/available-playmates`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            dataType: "json",
            data:{stateId},
        }).done(function (response) {
            if (response.success) {
                $(".playmates-card-grid").html(response.playmates_container_html);
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    
    let stateId = $("#state_id").val();
    if(stateId){
        console.log('getAvailablePlaymates');
        getAvailablePlaymates();
    }

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
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops.. sumthing wrong Please try again',
                            text: data.message
                        });
                        $('#my_playmates').prop('disabled', false);
                        $('#my_playmates').html('Save');
                    }
                }
            });
        }
    });
});



