<script>
let formChanged = false;
</script>

@if(is_parent_massage_user_switch())  
<script>
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


    <!-- Other Centre View only Data ///////// -->

    @php
    $massage_page = request()->segment(2);
    $skip_page = ['archives-listing']
    @endphp

    @if( auth()->user() &&  !canManage())
    <script type="text/javascript">

        let massagePage = @json($massage_page);
        console.log('$massage_page',massagePage);

        $(document).ready(function() {
        $('.save_profile_btn').css({'display':'none'});
        $('.resetdays-icon').css({'display':'none'});
        $('.remove-lang').css({'display':'none'});


        $('#btn_add_brb').css({'display':'none'});
        $('#btn_suspend_profile').css({'display':'none'});
        $('#btn_extend_profile').css({'display':'none'});
        $('#btn_bumpup_profile').css({'display':'none'});


        $('.allow_only_numeric').prop({'disabled':true});

        $('input[type="number"]').prop('disabled', true);
        $('.my_service_anal .input_border').css({'background-color':'#fff'});
        $('.column_class').css({'display':'none'});
        $('.my_service_anal #span_id').css({'display':'none'});

        
        

        $('input[type="text"]').prop('disabled', true);
        $('select').prop('disabled', true);
        $('input[type="checkbox"]').prop('disabled', true);
        $('input[type="radio"]').prop('disabled', true);


        $('.create-tour-sec').css({'display':'none'});
        $('.MediaVerification').css({'display':'none'});
        $('#content').css({'user-select': 'none'});

        $('#userProfile input[type="submit"]').hide();
        $('#profile_tour_options input[type="submit"]').hide();
        $('#profile_notification_options input[type="submit"]').hide();

        
        $('#userProfile .request_one').hide();

        

        })
    </script>




       
        @if(!in_array($massage_page, $skip_page))
            @if(in_array($massage_page, ['archive-view-photos','media-centre','update-masseur']))
        <script>
        $(document).ready(function() 
        {   

                console.log('massage_page--------',massagePage);
                
                setInterval(() => {
                    $('#add_video_button').hide();
                    $('.deleteimg').css({'display':'none'});
                }, 200);

                $('#content *').css({'pointer-events': 'none','user-select': 'none'});
                $('#js_profile_media_gallery, #js_profile_media_gallery *').css({'pointer-events': 'auto','user-select': 'auto'});
                $('#defaultImage').css({'pointer-events': 'auto','user-select': 'auto'});
                $('#masseur_frm_media').css({'pointer-events': 'auto','user-select': 'auto'});

        })

        
        </script>

        @else
        <script>
        $(document).ready(function() {     
        console.log('else massage_page--------',massagePage);    
        //$('#content').css({'pointer-events': 'none','user-select': 'none'});
        })
        </script>
        @endif
    @endif
  

@endif
<!-- End Other Centre View only Data ///////// -->