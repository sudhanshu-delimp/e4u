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
            <h1 class="home_heading_first">Register your interest - E4U Pin Up</h1>
            <h2 class="primery_color normal_heading">Timing</h2>
            <p>Our Pin Up feature is very popular with Advertisers. Register your interest to be our Pin
                Up in your Location and when your turn arrives, we will send you a message asking you to
                confirm you still wish to appear as our Pin Up on the Home Page (within your Location).
            </p>
            <h2 class="primery_color normal_heading">Cost</h2>
            <p>The Pin UP feature is only available for one week at $475.00, but you can register as often
                as you like to re-appear as our Pin Up.
            </p>
            <h2 class="primery_color normal_heading">Where to register</h2>
            <p>To register your interest, Advertisers need to <a href="{{ route('advertiser.login') }}"
                                                                 class="termsandconditions_text_color text-decoration-none">logon</a>
                and at their Dashboard:</p>

            <ul>
                <li><p class="mb-0">Select Pinups from the menu and click "New Pinup Registration"</p></li>
                <li><p class="mb-0">Follow the instructions and complete the form</p></li>
                <li><p class="mb-0">Check your details are correct and proceed to payment</p></li>
            </ul>
            <p>When creating a Tour, you can also request to be a Pinup in any of the Locations you are visiting during the Tour. If the Pinup time slot is available, it will be included in the Tour
you create.</p>
            <p><b>Changes to this Guide</b></p>
            <p>This Guide was last updated on 13-07-2024.</p>

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
