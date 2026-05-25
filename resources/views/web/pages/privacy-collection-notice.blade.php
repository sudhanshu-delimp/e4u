@extends('layouts.web')
@section('style')
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="home_heading_first">Privacy Collection Notice</h1>
            <p>This Privacy Collection Notice (<b>Collection Notice</b>) describes how Blackbox Tech Pty Ltd t/a Escorts4U (ABN 88
                664 919 975) (<b>we,</b> <b>us</b> or <b>our</b>) collects and handles your personal information when you make
                an enquiry with us. We collect personal information from you so that we can respond to your
                enquiry and for related purposes set out in our <a class="c-red" href="{{ 'privacy-policy' }}"
                    target="_blank"> Privacy Policy</a>, available on our website (or on request).</p>
            <p>We may disclose this personal information to third parties, including our personnel, related
                entities, any third parties engaged by us and acting on our behalf and as otherwise set out in
                our Privacy Policy.</p>
            <p>We store personal information in Australia. Where we disclose your personal information to
                third parties, those third parties may store, transfer or access personal information outside of
                Australia.
            </p>
            <p>If you do not provide your personal information to us, it may affect your ability to do business with you and offer our services to you.</p>
            <p>Please see our <a class="c-red" href="{{ 'privacy-policy' }}" target="_blank"> Privacy Policy</a> for more
                information about how we collect, store, use and
                disclose your personal information, including details about overseas disclosure, access,
                correction, how you can make a privacy-related complaint and our complaint-handling
                process.</p>
            <p>If you have questions about our privacy practices, please contact us by email at:
                <a class="c-red" href="mailto:privacy@escorts4u.com.au" target="_blank">privacy@escorts4u.com.au</a>. By providing your personal information to us, you agree to the
                collection, use, storage and disclosure of that information as described in this Collection
                Notice.</p>








            <div class="container mt-4 px-0 chagneto-policy">
                <hr class="custom_hr">
                <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at
                    the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to
                    check the <a href="{{ url('terms-conditions') }}" style="color:#FF3C5F">Terms and Conditions</a> and
                    this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 25-05-2025</b></p>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var skipSliderage = document.getElementById("skipstepage");
        var skipValuesage = [
            document.getElementById("skip-value-lower-age"),
            document.getElementById("skip-value-upper-age")
        ];

        noUiSlider.create(skipSliderage, {
            start: [0, 30],
            connect: true,
            behaviour: "drag",
            step: 1,
            range: {
                min: 18,
                max: 60
            },
            format: {
                from: function(value) {
                    return parseInt(value);
                },
                to: function(value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function(values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });
    </script>
@endpush
