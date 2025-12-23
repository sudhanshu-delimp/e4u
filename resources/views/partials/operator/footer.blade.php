        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal opr-modal fade fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                   
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/logout.png') }}" class="custompopicon"> Logout</h5>
                        <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/dashboard/img/operator/close.png')}}" class="opr-close-btn">
                        </a>

                    </div>
                    <div class="modal-body text-center">
                        <h5 class="popu_heading_style mb-0 mt-4">
                                Are you sure that you want to logout?
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="opr-btn-common" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('admin.logout') }}">
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
        <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

        <script src="{{ asset('assets/js/common.js') }}"></script>

        <script>
        $(document).ready(function(){
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        })
        
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

        @section('script')
        @show
       
        @stack('script')

         
</body>
</html>
