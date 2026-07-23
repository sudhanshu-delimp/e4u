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


    $(document).ready(function () {

    $('.account-toggle').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
       
        $('#accountMenu').collapse('toggle');
        $('.chevron-icon').toggleClass('rotate');
    });

    $('#accountMenu').on('click', function (e) {
        e.stopPropagation();
    });


});


$('.video_icon_ec').append(
    '<div class="video_tooltip">Escort has video to view</div>'
);

</script>