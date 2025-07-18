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
                    <div class="modal-body">Are you sure that you want to logout?</div>
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
        {{-- <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script> --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
        <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
        <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('assets/js/common.js') }}"></script>
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
                //Create sweet alert for flash message
                @foreach(['success', 'warning', 'info', 'error'] as $alert)
                @if (Session::has($alert))
                swal.fire('', '{{Session::get($alert)}}', '{{$alert}}');
                @endif
                @endforeach

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
</script>

    </body>
</html>
