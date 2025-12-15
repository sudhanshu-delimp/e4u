        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white">
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
                        <h5 class="popu_heading_style mb-0 mt-4">
                                Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn-cancel-modal" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('admin.logout') }}">
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
        <script src="{{ asset('assets/js/common.js') }}"></script>
        <!-- <script src="{{ config('constants.socket_url') }}/socket.io/socket.io.js"></script>
          <script>
              const socket_url = "{{ config('constants.socket_url') }}";
          </script>
          <script src="{{ asset('assets/js/web-socket.js') }}"></script>
          <script src="{{ config('constants.socket_url') }}/socket.io/socket.io.js"></script> -->
        <script>
            var initJsDatePicker = function() {
                $(".js_datepicker").attr('placeholder', 'DD-MM-YYYY');
                $(".js_datepicker").attr('autocomplete', 'off');
                $(".js_datepicker").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true,
                    showAnim: "slideDown",
                    constrainInput: false,
                    onSelect: function(dateText) {
                        const event = new Event('change', {
                            bubbles: true
                        });
                        this.dispatchEvent(event); // 👈 manually trigger change event
                    }
                });
            }
            initJsDatePicker();
        </script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })
        </script>



        @section('script')
        @show
        @stack('script')


      
  
</body>
</html>
