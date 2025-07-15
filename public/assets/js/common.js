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


    // function is_confirm()
    // {
    //     Swal.fire({
    //     title: "Are you sure?",
    //     //text: "You won't be able to revert this!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonColor: "#3085d6",
    //     cancelButtonColor: "#d33",
    //     confirmButtonText: "Yes, delete it!"
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire({
    //         title: "Deleted!",
    //         text: "Your file has been deleted.",
    //         icon: "success"
    //         });
    //     }
    //     });
    // }