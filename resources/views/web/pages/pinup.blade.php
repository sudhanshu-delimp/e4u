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
        <div class="container text-justify">
            <h1 class="home_heading_first">E4U Pin Up - enhance your opportunities!</h1>
            <h2 class="primery_color normal_heading">What is a Pin Up? Test</h2>
            <p> When a User visits the Website, they are greeted with their Pin Up registered in the User's Location. The Escort's
                 Pin Up image will appear on the Home page, which when clicked, will take the User to the Escort's Profile summary, 
                 a quick snapshot of the Escort.  From here, the User can then click the <i>View Profile</i> button to see the Escort's 
                 Profile in its complete format.
            </p>
            <p>The Pin Up feature is available in every Location.  It is very popular with Escorts, particularly when 
                the Escort is Touring and they want to maximise their opportunities.
            </p>
            <h2 class="primery_color normal_heading">How do I become a Pin Up?</h2>
            <p>It is very easy to become a Pin Up.  The criteria to become a Pin Up includes:
            </p>
            <ul>
                <li><p class="mb-0">You must have a current Listed Profile, where the start and finish dates are either side of the 
                    Pin Up listed period (what will be the published week); and</p></li>
                <li><p class="mb-0">Your Profile Membership Type is Platinum.</p></li>
            </ul>
            <p>From your Console's Profile Management, you select 'List Pin Up' and your available Listed Profile/s and 
                Pin Up available dates will appear.  Simply select the Profile you would like to be used as the Pin Up, the date it 
                will appear and proceed to payment.  Once your payment has been processed, your nominated Profile will automatically 
                list, in that Location, for the week you have selected.
            </p>
            <h2 class="primery_color normal_heading">Any benefits?</h2>
            <p>There are many benefits that come with being a Pin Up, including:</p>

            <ul>
                <li><p class="mb-0">The exclusive listing on the Home page.</p></li>
                <li><p class="mb-0">You are automatically ranked on the Listing page in the first position.</p></li>
                <li><p class="mb-0">Your Profile will display a unique Membership Type banner incorporating the Pin Up logo, 
                    letting Users know you are the Location's Pin Up for that week.</p></li>
                <li><p class="mb-0">Maximise your exposure by booking the Pin Up, in advance, for each Location on a Tour.</p></li>    
            </ul>
            <h2 class="primery_color normal_heading">Cost and availability</h2>
            <p>The Pin UP feature is available in weekly increments, Monday through to Sunday, at $475.00 per week.  You can register 
                as often as you like to re-appear as our Pin Up providing you have a current Listed Profile and the week you are seeking is available.</p>
                <p>Remember, you can only appear as a Pin Up in a Location that you have a Listed Profile and the week you are seeking is available.  Get ahead of everyone else 
                    and register your Profile as a Pin Up!
                </p>
            
<div class="container mt-4 px-0 chagneto-policy">
            <hr class="custom_hr">
                <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                <p>We may change or modify this Policy in the future. We will note the date that revisions were last
                    made at the bottom of this page. Any revision will take effect upon its posting. It is your
                    responsibility to check the <a href="https://e4u.local/terms-conditions" style="color:#FF3C5F">Terms and Conditions</a> and
                    this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 04-06-2025</b></p>
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
