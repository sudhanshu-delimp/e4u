        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal opr-modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">

                    <div class="modal-header">
                        <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/logout.png') }}" class="custompopicon"> Logout</h5>
                        <a href="" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/dashboard/img/operator/close.png')}}" class="opr-close-btn">
                        </a>

                    </div>
                    <div class="modal-body text-center">
                        <h5 class="my-2 custom_modal_text">
                            Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center pt-0">
                        <button class="opr-btn-common" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" name="logout"  id="logout" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="opr-btn-common">Logout</button>
                        </form>

                         
                    </div>
                </div>
            </div>
        </div>
       <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
        @include('partials.common.footer-scripts')
        <script>
        $(document).ready(function(){
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        })
    
           

            function int_datePicker(ele) {
                let datePickerOptions = {
                    showAnim: 'slideDown',
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    showOn: "both",
                    buttonImageOnly: true,
                    buttonImage: "{{ asset('assets/img/calendar.svg') }}"
                };
                var dynamicOptions = $(ele).data('options') ? $(ele).data('options').split(', ') : '';
                $(dynamicOptions).each(function(index, element) {
                    var item = element.split(':');
                    datePickerOptions[item[0]] = item[1];
                });
                if ($(ele).data('min')) {
                    datePickerOptions['minDate'] = new Date($(ele).data('min'));
                }
                $(ele).datepicker(datePickerOptions);

                //THis is to remove icon from the input when the input is disabled
                if ($(ele).prop('disabled')) {
                    $(ele).find('.ui-datepicker-trigger').hide();
                }
                $(".ui-datepicker-trigger").removeAttr("title");
            }

            var initJsDatePickerEdit = function() {
                var $inputs = $(".js_datepicker_edit");
                if ($inputs.length > 0) {
                    $inputs.attr('placeholder', 'DD-MM-YYYY');
                    $inputs.attr('autocomplete', 'off');
                    $inputs.datepicker({
                        dateFormat: "dd-mm-yy",
                        changeMonth: true,
                        changeYear: true,
                        showAnim: "slideDown",
                        onSelect: function(dateText) {
                            $(this).trigger('change');
                        }
                    });
                }
            }
            </script>

        @section('script')
         @stack('script')
        @show
       
         <!-- ///////////// Notification ////////////////// -->
        <script>
            const getNotifications = () => {
                    ajaxRequest({
                    url: "{{ route('operator.get-notification') }}",
                    method : 'Get',
                    data: {},
                    success: function(response) {

                        let alert_notifications = response.alert_notifications;
                        let fee_report_notifications = response.fee_report_notifications;
                        let alert_notifications_html = "";
                        let fee_report_html = "";

                            /////////// Alert Notification List ///////////////////////
                    if (fee_report_notifications?.data?.length > 0) {   
                                if(fee_report_notifications.is_new)
                                {
                                $('.alert_notify_bell').html('<i class="top-icon-bg fas fa-bell fa-fw"></i><span class="badge badge-danger badge-counter"> '+fee_report_notifications?.data?.length+' </span>');
                                }
                            
                                fee_report_notifications.data.forEach((notification) => {
                                    fee_report_html+= `<span class="dropdown-item d-flex align-items-center alert_notify_li" id="${notification.id}">
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

                               
                                $('.alert_notify_html').html(fee_report_html);
                            }
                            else
                            {   $('.alert_notify_bell').html('<i class="top-icon-bg fas fa-bell fa-fw"></i>');
                                $('.alert_notify_html').html(`<a class="dropdown-item d-flex align-items-center" href="#">No New Notification Found</a>`); 
                            }
                        /////////// End  Alert Notification List /////////////////////////////
                    },
                    error: function(xhr) {
                        console.log('Error in Notification List');
                    }
                    });

            }

         const notificationSeen = (notification_id) => {

             return new Promise((resolve, reject) => {
                ajaxRequest({
                    url: "{{ route('operator.notification-seen') }}",
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

         function showAlert(title, message, type, confirm = false) {
                const options = {
                    title: title,
                    html: message,
                    icon: type
                };

                if (confirm) {
                    options.showCancelButton = true;
                    options.confirmButtonText = 'Yes, Confirm';
                    options.cancelButtonText = 'Cancel';
                    options.reverseButtons = true;
                }

                return Swal.fire(options);

            }
        </script>  

         
</body>
</html>
