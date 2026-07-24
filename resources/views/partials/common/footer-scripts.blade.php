@include('partials.common.other-user-permission')
<script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
<script>
    var encryptValue = function(value) {

        return $.ajax({
            url: "/encrypt",
            type: "POST",
            data: {
                value: value,
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        });

    }

    var decryptValue = function(value) {

        return $.ajax({
            url: "/decrypt",
            type: "POST",
            data: {
                value: value,
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        });

    }


    $(document).ready(function() {

        $('.account-toggle').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $('#accountMenu').collapse('toggle');
            $('.chevron-icon').toggleClass('rotate');
        });

        $('#accountMenu').on('click', function(e) {
            e.stopPropagation();
        });


    });

    $(document).ready(function() {

        @if(Auth::check())
        $("#sendOtp_modal").on('show.bs.modal', function() {

            $.ajax({
                url: "{{ route('send.opt.notification', ['user' => Auth::id()]) }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    action: "payment"
                },
                success: function(res) {
                    console.log(res);
                },
                error: function(xhr) {
                    Swal.close();

                    let option = getStatusOption(xhr);

                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                    });
                }
            });

        });
        @endif

    });
</script>