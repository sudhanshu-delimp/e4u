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
<section class="padding_top_eight_px padding_bottom_eight_px footer-links-si text-justify">
   <div class="container">
      <h1 class="home_heading_first margin_btm_twenty_px page-title">Parent Control </h1>
       <p>
         Blackbox Tech Pty Ltd (<b>Blackbox</b>) operates the Website as a Restricted to Adults (<b>RTA</b>)
         compliant website, Blackbox understands the importance of providing parents and guardians
         with the necessary information to control and to restrict their children’s access to any adult
         advertising website and streaming service. A range of measures have been incorporated into
         the Website.
       </p>

       <p>
         We value the well-being of minors and hope that this guide can help you implement effective
         parental controls.
       </p>
      <h2 class="primery_color normal_heading">
         Who can legally access the website?
      </h2>
      <p>It is strictly prohibited for individuals who are under the age of 18 (or the Age of Majority
         defined by their jurisdiction, if higher) to access content on the Website.
      </p>

      <p>
         Users must be fully capable, legally competent to agree to and fulfill the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a>,
         obligations, rules, and representations stated within the Website.
      </p>
      <p>
         Users must only access the Website from a jurisdiction which does not forbid the receipt or
         viewing of sexually explicit content.
      </p>

      <h2 class="primery_color normal_heading">How can a parent/legal guardian restrict access to the Website?</h2>
      <p>Use “SafeSearch’’. You can use these to make sure there are no 18+ websites in search
         results:</p>
      <ul>
         <li>
            Google SafeSearch
         </li>
         <li>
            Yahoo SafeSearch
         </li>
         <li>
            Bing SafeSearch
         </li>
      </ul>
      <p> For Apple devices (iPhone, iPad, iPod Touch), you can use Apple’s parental controls. For
         Android devices and laptops, you can use Google Family Link. For desktops with Windows
         10 or higher, you can use Microsoft Family Safety and for more parental monitoring software,
         you can research and try these:
      </p>

      <ul>
         <li>
            OpenDNS FamilyShield
         </li>
         <li>
            KidLogger
         </li>
         <li>
            Screen Time
         </li>
      </ul>
      <p>Additional parental control measures help ensure that your child's access to adult websites
         is restricted and that they have a safe online experience.</p>
      <h2 class="primery_color normal_heading">Disclaimer</h2>
      <p>This guide and all accompanying methods and services are intended for informational
         purposes only. Blackbox assumes no responsibility for any consequences that may arise
         from the methods suggested within this guide.</p>
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