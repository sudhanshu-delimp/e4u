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
            console.log('getAvailablePlaymates',response.playmates.length);
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
});



