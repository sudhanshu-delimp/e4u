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
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>
@endsection
@section('content')






<section class="padding_top_eight_px padding_bottom_eight_px">
   <div class="container">
        <h1 class="home_heading_first margin_btm_twenty_px page-title">Visa & Education</h1>

        <h2 class="primery_color normal_heading">Partnership</h2>
        <p>
            Escorts4U have partnered with a leading provider of visa, migration and education
            services (<strong>Services</strong>). The Booking Service is only available to registered Advertisers.

        </p>
        <h2 class="primery_color normal_heading">Access to the Services </h2>
        <p>
            To access the Services, Advertisers need to <a href="{{ route('advertiser.login') }}" class="e4ulinks" style="color:#FF3C5F;font-size: 16px;">logon</a> and at their Dashboard:

        </p>
        <ul>
            <li><p class="mb-0">Select Concierge from the menu and click "Visa & Migration"</p></li>
            <li><p class="mb-0">Follow the instructions by completing the form</p></li>
            <li><p class="mb-0">Submit your request</p></li>
        </ul>

        <!-- changes to this policy -->
    <div class="container mt-4 px-0 chagneto-policy">
        <hr class="custom_hr">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
         <p>Escorts4U archives all previous versions of this Policy.</p>
         <p><b>This policy was last updated 28-05-2025</b></p>
    </div>
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
