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
      <h1 class="home_heading_first">Covid-19 Statement</h1>
      <h2 class="primery_color normal_heading">Content warning</h2>
      <p><span class="termsandconditions_text_color"><b>WARNING:</b></span>This Website contains nudity and other sexually orientated content. It is
intended for adults only and must not be accessed by anyone under the age of 18 (or the
age of consent in the jurisdiction from which the Website is being accessed).
      </p>

      <h2 class="primery_color normal_heading">Statement</h2>
      <p>Escorts4U uses its resources to the best of its ability to keep informed Users about their
respective responsibilities towards compliance with State and Federal Government
legislation, regulations and rules (Australia) concerning the virus known as Covid-19
(collectively <b>Covid-19 Regulations</b>). It is not the responsibility of Escorts4U to ensure
Users are compliant with the Covid-19 Regulations.</p>

<p class="text_decoration_for_a">Subject to the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a>, by using the Services, Users accept the following
conditions in relation to the Covid-19 Regulations:</p>

<ul>
   <li><p class="mb-0">Waiver</p></li>
   <p>Escorts4U accepts no responsibility for the completeness or accuracy of any
information an Escort or Massage Centre (collectively you) collects when complying
with the Covid-19 Regulations. To the extent permitted by law, you waive
Escorts4U from any and all liability for any loss or damage arising out of and from
the use of, or reliance on, the information contained on or accessed through any of
the Websites whether or not caused by any negligence on the part of Escorts4U or
resulting from the non-compliance by you of any provision under the Covid-19
Regulations.</p>
<li><p class="mb-0">Risk</p></li>
<p>To the maximum extent permitted by law you assume all risks and responsibilities
associated with:</p>
<li><p class="mb-0">any meeting or association you engage in with a User; and</p></li>
<li><p class="mb-0">compliance with the Covid-19 Regulations</p></li>
</ul>


     <!--  <h2 class="primery_color normal_heading">Changes to this Policy</h2>
      <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
         revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
         review the most current version.
      </p>
      <p>Escorts4U archives all previous versions of this Policy.</p>
      <p><b>This policy was last updated 01-12-18</b></p> -->

 <div class="container mt-4 px-0 chagneto-policy">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                   review the most current version.</p>
           <p>Escorts4U archives all previous versions of this Policy.</p>
           <p><b>This policy was last updated 01-12-18</b></p>
     </div>
      
   </div>
</section>
















<!-- <section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
       <h4>Covid-19 Statement</h4>    
 
 
       <div class="accordion-container">
          <div class="set">
             <a>
             Content warning
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p><span class="termsandconditions_text_color"><b>WARNING:</b></span>This Website contains nudity and other sexually orientated content. It is intended for adults only and must not be accessed by anyone under the age of 18 (or the age of consent in the jurisdiction from which the Website is being accessed).</p>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
            Statement
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Escorts4U uses its resources to the best of its ability to keep informed Users about their respective responsibilities towards compliance with State and Federal Government legislation, regulations and rules (Australia) concerning the virus known as Covid-19(collectively <b>Covid-19 Regulations</b>).  It is not the responsibility of Escorts4U to ensure Users are compliant with the Covid-19 Regulations</p>
                   <span class="custome_span_color">Subject to the <a class="termsandconditions_text_color" href="#" style="font-size: 14px;">Terms and Conditions</a>, by using the Services, Users accept the followingconditions in relation to the Covid-19 Regulations:</span>
                   <ul class="font_size_forteenpx" style="color:#686a6c;">
                      <li>Waiver</li>
                      <li>Escorts4U accepts no responsibility for the completeness or accuracy of any information an Escort or Massage Centre (collectivelyyou) collects when complying with the Covid-19 Regulations.  To the extent permitted by law, you waive Escorts4U from any and all liability for any loss or damage arising out of and from the use of, or reliance on, the information contained on or accessed through any of the Websites whether or not caused by any negligence on the part of Escorts4U or resulting from the non-compliance by you of any provision under the Covid-19 Regulations.</li>
                      <li>Risk
                        <span class="custome_span_color">To the maximum extent permitted by law you assume all risks and responsibilities associated with:</span>
                      </li>
                      <li>any meeting or association you engage in with a User; and</li>
                      <li>compliance with the Covid-19 Regulations</li>
                  </ul>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
             Changes to this Policy
             <i class="fa fa-angle-down"></i>
             </a>
            <div class="content">
                <div class="accodien_manage_padding_content">
                   <p class="custome_span_color">We may change or modify this Policy in the future.We will note the date that revisions were last made atthe bottom of this page.Any revision will take effect upon its posting.It is your responsibility to check the <a class="termsandconditions_text_color" href="#" style="font-size: 14px;">Terms and Conditions</a> and this Policy from time to time to review the most current version.</p>
                </div>
             </div>
          </div>
       </div>
    </div>
</section> -->
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