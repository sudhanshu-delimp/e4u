        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->

        <div class="modal fade upload-modal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <img src="{{ asset('assets/app/img/logout-red.png') }}" class="log--out--pic">
                            Logout
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 class="my-0 custom_modal_text">
                                Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center pt-0">
                        <button class="btn-cancel-modal" type="button"
                            data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('advertiser.logout') }}">
                            @csrf
                            <button type="submit" class="btn-success-modal">Logout</button>
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
        <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('assets/dashboard/vendor/chart.js/Chart.min.js') }}"></script>
        <!--<script src="{{ asset('assets/app/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/app/js/demo/chart-pie-demo.js') }}"></script>-->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('assets/app/js/jquery-ui.min.js')}}"></script>
        @include('partials.common.footer-scripts')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#dashboard").click(function(e) {
                    $("#dash").css("color", "#FF3C5F");
                    console.log($(this).attr('href'));
                })
            });
        </script>
        @stack('script')
        @section('script')
        @show

        <!-- ///////////// Notification ////////////////// -->
        <script>
            const getNotifications = () => {
                    ajaxRequest({
                    url: "{{ route('agent.get-notification') }}",
                    method : 'Get',
                    data: {},
                    success: function(response) {

                        let alert_notifications = response.alert_notifications;
                        let support_notifications = response.support_notifications;
                        let fee_report_notifications = response.fee_report_notifications;
                        let alert_notifications_html = "";
                        let support_notify_html = "";
                        let fee_report_html = "";

                            /////////// Alert Notification List ///////////////////////
                            if (alert_notifications?.data?.length > 0)
                            {   
                                if(alert_notifications.is_new)
                                {
                                $('.alert_notify_bell').html('<i class="top-icon-bg fas fa-bell fa-fw"></i><span class="badge badge-danger badge-counter"> '+alert_notifications?.data?.length+' </span>');
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
                            } else if (fee_report_notifications?.data?.length > 0) {   
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

                        

                        ///////////// Support Notification List //////////////////////////////
                        
                        if (support_notifications?.data?.length > 0) 
                        {   
                                if(support_notifications.is_new)
                                { 
                                $('.support_notify_bell').html('<i class="top-icon-bg fas fa-ticket-alt fa-fw"></i><span class="badge badge-danger badge-counter"> '+support_notifications?.data?.length+' </span>');
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
                    url: "{{ route('agent.notification-seen') }}",
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

             function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type
            });

        }
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

        @foreach (['warning', 'info', 'error'] as $alert)
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
