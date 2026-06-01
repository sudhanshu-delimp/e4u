<script src="{{ asset('js/common.js') }}"></script>


@if(is_parent_massage_user_switch())  
<script>
let formChanged = false;
$(document).on('input change','input, textarea, select', function () {
formChanged = true;
});


$(document).on('click', '.switch-user-btn', async function (e) {

    if(formChanged){
        e.preventDefault();

        let my_alert = {
                title: "Unsaved Changes",
                text: "Please save your changes before Switch Account.",
                icon: "warning",
                cancelButtonText: "Ok",
                confirmButtonText: "Back to Parent Account.",
                
         }

        if (await changeAlert(my_alert))
        {
            swal_waiting_popup({'title':'Redirecting...'});    
            setTimeout(function () {
            window.location.href = "{{ route('center.back-to-parent') }}";
            }, 2000);
            
        }

        return false;
        //swal_error_warning('Unsaved Changes', 'Please save your changes before Switch Account.');
       
    }


    if (await isConfirm({'action': 'Switch', 'text': 'Switch Back to Parent Account?'}))
    {
        window.location.href = "{{ route('center.back-to-parent') }}";
    }

});

</script>
@endif