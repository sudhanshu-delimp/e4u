        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure Do you want to logout ?</div>
                    <div class="modal-footer">
                        <button class="btn main_bg_color site_btn_primary" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('advertiser.logout') }}">
                            @csrf
                            <button type="submit" class="btn main_bg_color site_btn_primary">Logout</button>
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
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#dashboard").click(function(e){
                    $("#dash").css("color","#FF3C5F");
                    // e.preventDefault();
                    // var url = $(this).attr('href');
                    // $.post({
                    // type: 'POST',
                    // url: url,
                    // }).done(function (data) {
                    //     if(data.error == false) {
                    //        console.log(data); 
                    //     } else {
                        
                    //     }
                    // });

                    console.log($(this).attr('href'));

                })
            });

        </script>
        @stack('script')
    </body>
</html>
