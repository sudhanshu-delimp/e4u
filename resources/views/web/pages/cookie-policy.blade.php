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

<section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
           <h1 class="home_heading_first page-title">Cookie Policy</h1>

                 <h2 class="primery_color normal_heading">Information about the use of Cookies</h2>
                 <p>
                     Subject to the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F;font-size: 16px;">Terms and Conditions</a>, by accessing the Website and by using the
                     Services, you accept the following conditions in relation to the use of cookies.
                 </p>
                <p>
                    This Policy supplements our Privacy Policy.
                </p>
                 <p>
                     The Website uses cookies to distinguish you from other Users of the Website. This helps
                     us to provide you with a good experience when you browse the Website and also allows
                     us to improve the Website. A cookie is a small file of letters and numbers that we store on
                     your browser or the hard drive of your computer if you agree. Cookies contain information
                     such as your device type, browser type, IP address and pages you have accessed on this
                     Website and third party websites. You are not identifiable from such information.
                 </p>

                 <p>
                     We use the following cookies:
                 </p>
                 <ul>
                     <li>
                         Strictly necessary cookies. These cookies are essential to enable you to move around
                         our Website and use all of the features. Without these cookies, some of the Services
                         may not be able to be provided.
                     </li>
                     <li>
                         Analytical/performance cookies. These cookies allow us to recognise and to count the
                         number of Users to the Website and to see how visitors move around the Website
                         when they are using it. This helps us to improve the way the Website works, for
                         example, by ensuring that Users are finding what they are looking for easily.
                     </li>
                     <li>
                         Functionality cookies. These cookies are used to recognise you when you return to
                         the Website. This enables us to personalise our content for you, greet you by name
                         and remember your preferences (for example, your choice of language or region).
                     </li>
                 </ul>
                 <p>
                     If you are a registered User of this Website, Cookie management is available to you from within My Account.
                 </p>
            <p>
                You can also use the settings in your browser to control how your browser deals with
                cookies. However, in doing so, you may be unable to access certain pages or content on
                the Website.
            </p>

                 <!-- <h3>Changes to this Policy</h3>
                 <p>
                     We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
                     revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                     review the most current version.
                 </p>
                 <p>
                     Escorts4U archives all previous versions of this Policy.
                 </p>
           <p><b>This policy was last updated 01-12-18</b></p> -->


            <div class="container mt-4 px-0 chagneto-policy">
              <h2 class="primery_color normal_heading">Changes to this Policy</h2>
              <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                        review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 26-01-2024</b></p>
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
