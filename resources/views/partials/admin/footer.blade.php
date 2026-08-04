        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

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
        <script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
        @include('partials.common.footer-scripts')
        <!-- <script src="{{ config('constants.socket_url') }}/socket.io/socket.io.js"></script>
          <script>
              const socket_url = "{{ config('constants.socket_url') }}";
          </script>
          <script src="{{ asset('assets/js/web-socket.js') }}"></script>
          <script src="{{ config('constants.socket_url') }}/socket.io/socket.io.js"></script> -->
        <script>
            function getCountryByUserId(obj, type) {
                var operatorId = $(obj).val();
                 $('#'+type+'country_id').empty();
                $.get("/get_country_by_user_id/" + operatorId, function(response) {
                    if (response.status) {
                        $('#'+type+'country_id').append(
                            '<option value="' + response.country_id + '">' + response
                            .country_name +
                            '</option>'
                        );
                    }
                });
            }
            var initJsDatePicker = function() {
                var $inputs = $(".js_datepicker");
                if ($inputs.length > 0) {
                    $inputs.attr('placeholder', 'DD-MM-YYYY');
                    $inputs.attr('autocomplete', 'off');
                    $inputs.each(function() {
                        let options = {
                            dateFormat: "dd-mm-yy",
                            changeMonth: true,
                            changeYear: true,
                            showAnim: "slideDown",
                            onSelect: function(dateText) {
                                $(this).trigger('change');
                            }
                        };
                    // Start from today
                    if ($(this).hasClass('min_today')) {
                        options.minDate = 0;
                    }
                        $(this).datepicker(options);
                    });
                }
            }

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })

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

        

        $(document).ready(function () {
    $('.formatMobile').on('blur', function () {
        let value = $(this).val();

        // Remove non-numeric characters
        value = value.replace(/\D/g, '');

        let formatted = value;

        if (value.length === 10) {
            // 0438 028 728
            formatted = value.replace(/(\d{4})(\d{3})(\d{3})/, '$1 $2 $3');
        } else if (value.length === 11) {
            // 0412 345 6789
            formatted = value.replace(/(\d{4})(\d{3})(\d{4})/, '$1 $2 $3');
        } else if (value.length === 12) {
            // 6143 802 8728 (with country code)
            formatted = value.replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
        }

        $(this).val(formatted);
    });
});
 function formatMobile(obj) {
        let value = $(obj).val();
        // Remove non-numeric characters
        value = value.replace(/\D/g, '');
        let formatted = value;
        if (value.length === 10) {
            // 0438 028 728
            formatted = value.replace(/(\d{4})(\d{3})(\d{3})/, '$1 $2 $3');
        } else if (value.length === 11) {
            // 0412 345 6789
            formatted = value.replace(/(\d{4})(\d{3})(\d{4})/, '$1 $2 $3');
        } else if (value.length === 12) {
            // 6143 802 8728 (with country code)
            formatted = value.replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
        }
         $(obj).val(formatted);
    }
  </script>

       @if (Session::has('success'))
        <script>
            Swal.fire({
                title: ' ',
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
                title: '',
                text: '{{ Session::get($alert) }}',
                icon: '{{ $alert }}',
                confirmButtonText: 'OK'
            });
        </script>
        @endif
        @endforeach
  @stack('script')
        </body>
        </html>
