        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('advertiser.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title htext" id="exampleModalLabel" style="color:white">
                            <img src="{{ asset('assets/app/img/logout-red.png')}}" class="log--out--pic">
                            Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body bodytext">Are you sure that you want to logout?</div>
                    <div class="modal-footer">
                        <button class="btn-cancel-modal btncancel" type="button" data-dismiss="modal">Cancel</button>
                        <form id="modalform" method="POST" action="{{ route('advertiser.logout') }}">
                            @csrf
                            <button type="submit" class="btn-success-modal btnok">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        {{-- <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/plugins/ajax/libs/jquery/jquery.min.js') }}"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
        <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script> -->
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('assets/dashboard/vendor/chart.js/Chart.min.js') }}"></script>
        <!--<script src="{{ asset('assets/app/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/app/js/demo/chart-pie-demo.js') }}"></script>-->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
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

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>

        <script src="{{ asset('assets/js/common.js') }}"></script>
        @stack('script')

        <!-- ///////////// Notification ////////////////// -->
        <script>
            const getNotifications = () => {
                    ajaxRequest({
                    url: "{{ route('center.get-notification') }}",
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
                    url: "{{ route('center.notification-seen') }}",
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
<script>
                
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
           @include('modal.change-password')

    </body>
</html>
