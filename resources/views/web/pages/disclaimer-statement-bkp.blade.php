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
      <h1 class="home_heading_first">Disclaimer Statement</h1>
      <h2 class="primery_color normal_heading">Content warning</h2>
      <p><span class="termsandconditions_text_color"><b>WARNING:</b></span>This Website contains nudity and other sexually orientated content. It is
intended for adults only and must not be accessed by anyone under the age of 18 (or the
age of consent in the jurisdiction from which the Website is being accessed).</p>

      <h2 class="primery_color normal_heading">Entry to this Website</h2>
      <p class="text_decoration_for_a">Subject to the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a>, by using the Services, you accept the following
conditions:</p>


<ul>
   <li><p class="mb-0">Waiver</p></li>
   <p>Escorts4U accepts no responsibility for the completeness or accuracy of any of the
information contained on or accessed through any page of this Website or link to a
third party website, including any social media platform, (collectively Websites) and
makes no representations about its suitability for any particular purpose. To the extent
permitted by law, you waive Escorts4U from any and all liability for any loss or damage
arising out of and from the use of, or reliance on, the information contained on or
accessed through any of the Websites whether or not caused by any negligence on
the part of Escorts4U, its Users or agents.</p>
<li><p class="mb-0">Representations</p></li>
<p>Any information or materials which are offensive, pornographic, unsuitable for minors
access or otherwise of a criminal or violent nature may be accessible through any
Websites either as a result of hacking or material placed on linked websites.
Escorts4U makes no representations as to the suitability of the information accessible
for viewing by minors or any other person.</p>
<li><p class="mb-0">Risk</p></li>
<p>To the maximum extent permitted by law you assume all risks associated with the use
of any Websites including, without limitation the risk:

<ul style="list-style: disc;">
   <li><p class="mb-0">of your computer, software or data being damaged by any virus which might be
transmitted or activated via any Websites or your access to it; or</p></li>
<li><p class="mb-0">that the content of any Websites and linked websites complies with the laws of any
country outside Australia.</p></li>
</ul>
</p>

<li><p class="mb-0">Data Collection</p></li>
<p>Your use of any Websites may be logged for the purpose of Geolocation, security,
usage, monitoring and compliance with the <a href="{{ url('law-enforcement')}}" class="termsandconditions_text_color">Local Laws</a> (as they may apply).</p>
<li><p class="mb-0">Usage</p></li>
   <p>Unauthorised use of any Websites could result in a criminal prosecution.</p>
<li><p class="mb-0">Jurisdiction</p></li>
<p>Irrespective of whether the Websites are hosted on web servers in Australia or outside
Australia. These <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> are governed by the laws in force in the State
of Western Australia and the Commonwealth of Australia. Any dispute about these
Terms and Conditions or the content of any Websites are subject to the exclusive
jurisdiction of the courts of the State of Western Australia. By your accessing the
Websites you agree to submit to those Courts.
</p>

</ul>
<!-- <h2 class="primery_color normal_heading">Changes to this Policy</h2>
      <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
         revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
         review the most current version.
      </p>
      <p>Escorts4U archives all previous versions of this Policy.</p>
      <p><b>This policy was last updated 01-12-18</b></p> -->
   
<div class="container mt-4 px-0 chagneto-policy">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
                   review the most current version.</p>
           <p>Escorts4U archives all previous versions of this Policy.</p>
           <p><b>This policy was last updated 01-12-18</b></p>
     </div>

   </div>
</section>
























<!-- <section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
       <h4>Disclaimer Statement</h4>
       
 
 
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
            Entry to this Website
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Subject to the <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Terms and Conditions</a></span>, by using the Services, you accept the following conditions</p>
                   <ul class="font_size_forteenpx" style="color:#686a6c;">
                      <li>Waiver
                        <span class="custome_span_color">Escorts4U accepts no responsibility for the completeness or accuracy of any of the information contained on or accessed through any page of this Website or link to a third party website, including any social media platform, (collectively Websites) and makes no representations about its suitability for any particular purpose. To the extent permitted by law, you waive Escorts4U from any and all liability for any loss or damage arising out of and from the use of, or reliance on, the information contained on oraccessed through any of the Websites whether or not caused by any negligence onthe part of Escorts4U, its Users or agents</span>
                      </li>
                      <li>Representations
                        <span class="custome_span_color">Any information or materials which are offensive, pornographic, unsuitable for minorsaccess or otherwise of a criminal or violent nature may be accessible through anyWebsites either as a result of hacking or material placed on linked websites.Escorts4U makes no representations as to the suitability of the information accessiblefor viewing by minors or any other person</span>
                      </li>
                      <li>Risk
                        <span class="custome_span_color">To the maximum extent permitted by law you assume all risks associated with the useof any Websites including, without limitation the risk:</span>
                        <ul style="list-style:disc;">
                           <li>of your computer, software or data being damaged by any virus which might betransmitted or activated via any Websites or your access to it; or</li>
                           <li>that the content of any Websites and linked websites complies with the laws of anycountry outside Australia.</li>
                        </ul>
                      </li>
                      <li>Data Collection
                        <span class="custome_span_color">Your use of any Websites may be logged for the purpose of Geolocation, security,usage, monitoring and compliance with the <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Local Laws</a></span> (as they may apply).</span>
                      </li>
                      <li>Usage
                        <span class="custome_span_color">Unauthorised use of any Websites could result in a criminal prosecution.</span>
                      </li>
                      <li>Jurisdiction
                        <span class="custome_span_color">Irrespective of whether the Websites are hosted on web servers in Australia or outsideAustralia. These Terms and Conditions are governed by the laws in force in the Stateof Western Australia and the Commonwealth of Australia. Any dispute about theseTerms and Conditions or the content of any Websites are subject to the exclusivejurisdiction of the courts of the State of Western Australia. By your accessing theWebsites you agree to submit to those Courts.</span>
                      </li>
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