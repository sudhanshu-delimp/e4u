        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade upload-modal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <img src="{{ asset('assets/app/img/logout-red.png')}}" class="log--out--pic">
                            Logout
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="custompopicon">
                        </span>
                        </button>
                    </div>
                     <div class="modal-body text-center">
                        <h5 class="my-0 custom_modal_text">
                                Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center pt-0">
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
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/common.js') }}"></script>
   
        <script>
        $(document).ready(function(){
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        });
        initJsDatePicker();
        var initJsDatePicker = function() {
                var $inputs = $(".js_datepicker");
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
        @show
       
        @stack('script')

         
</body>
</html>
