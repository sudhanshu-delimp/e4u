   function date_time_format(dateString)
    {

            const date = new Date(dateString.replace(" ", "T"));
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };

        return formatted = date.toLocaleString('en-US', options);
    }



    function swal_waiting_popup(data)
    {

        Swal.fire({
            title: (data.title) ? data.title : 'Processing...',
            text: (data.message) ? data.message : 'Please wait.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }


   async function isConfirm(data={}) {
      const result = await Swal.fire({
        title: "Are you sure?",
        text: (data.text ? data.text : ''),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, "+(data.action ? data.action : 'do')+" it!"
    });

    if (result.isConfirmed) {
        return true;
    } else {
        return false;
    }
}


function ajaxRequest({
    url,
    method = 'POST',
    data = {},
    success = function(response) { console.log('Success:', response); },
    error = function(xhr, status, error) { console.error('Error:', error); }
}) 
{
    $.ajax({ 
        url: url,
        type: method,
        data: data,
        success: success,
        error: error
    });
}
