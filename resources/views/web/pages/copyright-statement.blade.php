@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('content')










    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="home_heading_first">Copyright Statement</h1>
            <h2 class="primery_color normal_heading">All Rights Reserved</h2>
            <p>All of this Website’s (<b>Portal</b>) contents and material is copyright © 2024 Blackbox Tech Pty Ltd
                (<b>Blackbox</b>) ACN: 664 919 975 or other copyright owners.</p>
            <p>Neither the whole or part of any content in the Portal (<b>Information</b>), including any underlying
                code or programming, may be printed out, copied, downloaded, duplicated, adapted, transmitted, emailed,
                forwarded, distributed, sold, licensed, dealt with or reverse engineered without the prior written
                permission of Blackbox.</p>
            <p> Any other Trademarks, Copyrighted information and/or any other intellectual property that may be
                mentioned or displayed in the Portal and which are not the property of Blackbox, is the property of that
                Other Mark's respective owner whether mentioned by name or not.</p>
            <p>You must obtain written permission before using any copyrighted material or other intellectual property that is published on this Website. Any unauthorized use of the materials appearing on this Website may violate copyright, trade mark and other property rights or legal protections and could result in criminal or civil penalties.</p>

            <h2 class="primery_color normal_heading">Permitted information</h2>
            <p class="text_decoration_for_a">You may store, print and display the content supplied solely for your own personal use. You are not permitted to publish, manipulate, distribute or otherwise reproduce, in any format, any of the content or copies of the content supplied to you or which appears on this Website nor may you use any such content in connection with any business or commercial enterprise.</p>

            <h2 class="primery_color normal_heading">Enquiries</h2>
            <p>All enquiries are to be directed to our Privacy Offer: <a href="mailto:privacy@escorts4u.com.au" class="termsandconditions_text_color">privacy@escorts4u.com.au</a>
            </p>


        <!-- <h2 class="primery_color normal_heading">Changes to this Policy</h2>
           <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
              review the most current version.
           </p>
           <p>Escorts4U archives all previous versions of this Policy.</p>
           <p><b>This policy was last updated 01-12-18</b></p> -->

            <div class="container mt-4 px-0 chagneto-policy">
            <hr class="custom_hr">
                <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                <p>We may change or modify this Policy in the future. We will note the date that revisions were last
                    made at the bottom of this page. Any revision will take effect upon its posting. It is your
                    responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and
                        Conditions</a> and this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 23-05-2025</b></p>
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
                from: function (value) {
                    return parseInt(value);
                },
                to: function (value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function (values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });

    </script>

@endpush
