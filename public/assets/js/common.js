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


console.log(date_time_format("2025-08-21 08:03:12")); 
console.log(date_time_format("2025-08-21 08:15:52")); 

function swal_success_popup(message) {

      Swal.fire({
      title: (message) ? message : 'Action Performed',
      icon: "success",
      draggable: true,
      allowOutsideClick: false,
        allowEscapeKey: false,
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

function swal_waiting_popup(data) {

    let gif_img = `<img src="../../assets/img/wait_loader.gif" alt="loading..." style="width:80px; margin-top:10px;">`;
    let my_html  = (data.title) ? '<p>'+data.title+'</p>'+gif_img  :  '<p>Processing your request...</p>'+gif_img;
        Swal.fire({
        title: 'Please wait...',
        html: my_html,
        showConfirmButton: false,
        allowOutsideClick: false
    });
}


async function isConfirm(data = {}) {

    console.log(data?.title);

    const result = await Swal.fire({
        title: (data?.title == 'NA' ? "" : "Are you sure ?"),
        text: (data.text ? data.text : ''),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, " + (data.action ? data.action : 'do') + " it!"
    });

    if (result.isConfirmed) {
        return true;
    } else {
        return false;
    }
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


