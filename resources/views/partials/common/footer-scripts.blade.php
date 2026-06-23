@include('partials.common.other-user-permission')
<script src="{{ asset('js/common.js?v1.1') }}"></script>
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
</script>