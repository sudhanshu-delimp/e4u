        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white">
                            <img src="{{ asset('assets/app/img/logout-red.png')}}" class="log--out--pic">
                            Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                     <div class="modal-body text-center">
                        <h5 class="popu_heading_style mb-0 mt-4">
                                Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn-cancel-modal" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('advertiser.logout') }}">
                            @csrf
                            <button type="submit" class="btn-success-modal">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        {{-- <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script> --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
        <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('assets/js/common.js?v1') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        
        <script>
            jQuery.browser = {};
            (function () {
                jQuery.browser.msie = false;
                jQuery.browser.version = 0;
                if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                    jQuery.browser.msie = true;
                    jQuery.browser.version = RegExp.$1;
                }
            })();

        window.App = {
            userId: {{ auth()->id() }},
            csrfToken: "{{ csrf_token() }}",
            baseUrl: "{{ asset('') }}"
        };
        console.log(window.App);
        var initJsDatePicker = function(){
            $(".js_datepicker").attr('placeholder','DD-MM-YYYY');
            $(".js_datepicker").attr('autocomplete','off');
            $(".js_datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showAnim: "slideDown",
                constrainInput: false,
                onSelect: function(dateText) {
                    const event = new Event('change', { bubbles: true });
                    this.dispatchEvent(event); // 👈 manually trigger change event
                }
            });
        }
        initJsDatePicker();
        </script>
        <script>
            $(document).ready(function(){
                //Display tooltip
                $('[data-toggle="tooltip"]').not('.delay_tooltip, .excludeTooltip').tooltip({
                    delay: { "show": 100, "hide": 100 }
                });
                $('[data-toggle="tooltip"].delay_tooltip').tooltip({
                    delay: { "show": 100, "hide": 80000 }
                });
                $(document).on('mouseenter', '[data-toggle="tooltip"]', function() {
                    $('.tooltip').tooltip("hide")
                });

                // //Create sweet alert for flash message
                // @foreach(['success', 'warning', 'info', 'error'] as $alert)
                // @if (Session::has($alert))
                // swal.fire('', '{{Session::get($alert)}}', '{{$alert}}');
                // @endif
                // @endforeach



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>

        @stack('script')

        @section('script')
        @show

        <script>
            $(document).on('select2:open', function(e) {
                var select2_id_attr = $(e.target).attr('id');
                if($('input[aria-controls="select2-' + select2_id_attr + '-results"]')[0]) {
                    $('input[aria-controls="select2-' + select2_id_attr + '-results"]')[0].focus();
                }
            });
        </script>

        <script>
$('#myAnchor').click(function() {
    location.reload();
});
$(document).ready(function(e) {
    $(".date-picker").each(function() {
        int_datePicker($(this));
    });
});
function int_datePicker(ele) {
    let datePickerOptions = {
        showAnim: 'slideDown',
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showOn: "both",
        buttonImageOnly: true,
        buttonImage: "{{asset('assets/img/calendar.svg')}}"
    };
    var dynamicOptions = $(ele).data('options') ? $(ele).data('options').split(', ') : '';
    $(dynamicOptions).each(function( index, element ) {
        var item = element.split(':');
        datePickerOptions[item[0]] = item[1];
    });
    if($(ele).data('min')) {
        datePickerOptions['minDate'] = new Date($(ele).data('min'));
    }
    $(ele).datepicker(datePickerOptions);

    //THis is to remove icon from the input when the input is disabled
    if($(ele).prop('disabled')){
        $(ele).find('.ui-datepicker-trigger').hide();
    }
    $(".ui-datepicker-trigger").removeAttr("title");
}

    $(document).ready(function () {

            var selectedLocation = {
                lat : '',
                lng : '',
                tiemzone : ''
            }

            navigator.geolocation.getCurrentPosition(async function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                selectedLocation.lat = latitude;
                selectedLocation.lng = longitude;
                sendLocationData(selectedLocation);
            });

            function sendLocationData(data) {
                $.ajax({
                    url: '{{ route("user.current.location") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data
                    },
                    success: function (response) {
                        if(response.status){ 
                            if($(".js_geo_location_profiles").length > 0){ /** Only display user's current location profiles in the create new listing page. */
                                getGeoLocationProfiles(response.data.state);
                            }
                            if($(".js_profile_current_location").length > 0){
                                $("select[name='state_id']").val(response.data.state).trigger("change");
                            }
                            $(".live_current_time").text(response.data.current_time);
                            $(".live_current_location").text(response.data.current_location);
                            $(".resident_home_state").text(response.data.home_state);
                            selectedLocation.timezone = response.data.timezone;
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error in location filter:', error);
                    }
                });
            }

            var getGeoLocationProfiles = function(state=0){
                if(state > 0){
                    $.ajax({
                    url: '{{ route("listing.get_geo_location_profiles") }}',
                    method: 'POST',
                    headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {state},
                    success: function (response) {
                        if(response.success==true){
                            let profileSelect = document.querySelector('select[name="escort_id[]"]');
                            profileSelect.innerHTML = '<option value="">Select a profile</option>';
           
                            response.profiles.forEach(item => {
                                let label = `${item.name} (${item.profile_name})`;
                                let value = `${item.id}`;

                                let option = document.createElement('option');
                                option.value = value;
                                option.textContent = label;
                                profileSelect.appendChild(option);
                            });
                            profileSelect.disabled = false;
                        }
                        else{
                            swal.fire('Profile', `${response.message}`, 'error');
                            Swal.fire({
                                title: 'Listings',
                                text: `${response.message}`,
                                icon: 'info',
                                confirmButtonText: 'OK'
                                }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href = "{{route('escort.profile')}}"; 
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error in location filter:', error);
                    }
                });
                }
            }

           function updateLiveTime() {
                const now = new Date();

                const timeString = new Intl.DateTimeFormat('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true,
                    timeZone: selectedLocation.timezone
                }).format(now);

                $(".live_current_time").text(timeString);
            }

            updateLiveTime(); // Initial call
            setInterval(updateLiveTime, 5000); // Update every 5 seconds
    });

</script>


<!-- ///////////// Notification ////////////////// -->
        <script>
            const getNotifications = () => {
                    ajaxRequest({
                    url: "{{ route('escort.get-notification') }}",
                    method : 'Get',
                    data: {},
                    success: function(response) {

                        let alert_notifications = response.alert_notifications;
                        let support_notifications = response.support_notifications;
                        let alert_notifications_html = "";
                        let support_notify_html = "";

                            /////////// Alert Notification List ///////////////////////
                            if (alert_notifications?.data?.length > 0)
                            {   
                                if(alert_notifications.is_new)
                                {
                                $('.alert_notify_bell').html('<i class="top-icon-bg fas fa-bell fa-fw"></i><span class="badge badge-danger badge-counter"> '+alert_notifications?.data?.length+'</span>');
                                }
                            
                                alert_notifications.data.forEach((notification) => {
                                    alert_notifications_html+= `<span class="dropdown-item d-flex align-items-center alert_notify_li" id="${notification.id}">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-success">
                                                    ${notification.notification_icon}
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-800"> ${notification.created_at}</div>
                                                    ${notification.title}
                                                </div>
                                            </span>`;
                                });

                                alert_notifications_html+=`<a class="dropdown-item text-center small text-gray-800" href="show-ALL">Show All Alerts</a>`;
                                $('.alert_notify_html').html(alert_notifications_html);
                            }
                            else
                            {
                                $('.alert_notify_bell').html('<i class="top-icon-bg fas fa-bell fa-fw"></i>');
                                $('.alert_notify_html').html(`<a class="dropdown-item d-flex align-items-center" href="#">No New Notification Found</a>`); 
                            }
                        /////////// End  Alert Notification List /////////////////////////////

                        

                        ///////////// Support Notification List //////////////////////////////
                        
                        if (support_notifications?.data?.length > 0) 
                        {  
                             
                                if(support_notifications.is_new)
                                {
                                $('.support_notify_bell').html('<i class="top-icon-bg fas fa-ticket-alt fa-fw"></i><span class="badge badge-danger badge-counter"> '+support_notifications?.data?.length+'</span>');
                                }
                            
                                support_notifications.data.forEach((notification) => {
                                    support_notify_html+= `<span class="dropdown-item d-flex align-items-center support_notify_li" id="${notification.id}">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-success">
                                                    ${notification.notification_icon}
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-800"> ${notification.created_at}</div>
                                                    ${notification.title}
                                                </div>
                                            </span>`;
                                });

                                support_notify_html+=`<a class="dropdown-item text-center small text-gray-800" href="show-ALL">Show All Alerts</a>`;
                                $('.support_notify_html').html(support_notify_html);
                        }
                        else
                        {       $('.support_notify_bell').html('<i class="top-icon-bg fas fa-ticket-alt fa-fw"></i>');
                                $('.support_notify_html').html(`<a class="dropdown-item d-flex align-items-center" href="#">No New Notification Found</a>`); 
                        }
                        ///////////// End Support Notification List //////////////////////////
                    },
                    error: function(xhr) {
                        console.log('Error in Notification List');
                    }
                    });

            }

         const notificationSeen = (notification_id) => {

             return new Promise((resolve, reject) => {
                ajaxRequest({
                    url: "{{ route('escort.notification-seen') }}",
                    method : 'Post',
                    data: {
                        'notification_id' : notification_id
                    },
                    success: function(response) {
                        if(response.success)
                         {
                            resolve(true);
                         }
                         else
                         {
                            resolve(false);
                         }   
                        
                    },
                    error: function() {
                        resolve(false); 
                    }
                });
             });

         }   
        
         $(document).ready(function(){
            getNotifications();
             setInterval(function () {
                  getNotifications();
            }, 15000);

            $(document).on('click', '.alert_notify_li', async function (e) {
                const seen = await notificationSeen($(this).attr('id'));
                 if (seen) {
                    getNotifications();
                 }
            });

            $(document).on('click', '.support_notify_li', async function (e) {
                const seen = await notificationSeen($(this).attr('id'));
                 if (seen) {
                    getNotifications();
                 }
            });
        });

        $(document).on('click', '.alert_notify_html .dropdown-item', function (e) {
            e.stopPropagation(); 
        });

        </script>  
                    @if (Session::has('success'))
                    <script>
                        Swal.fire({
                            title: '{{ Session::get('title') }}',
                            text: '{{ Session::get('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                @foreach(['warning', 'info', 'error'] as $alert)
                    @if (Session::has($alert))
                        <script>
                            Swal.fire({
                                title: '{{ ucfirst($alert) }}',
                                text: '{{ Session::get($alert) }}',
                                icon: '{{ $alert }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                @endforeach
                        

                 

</body>
</html>
