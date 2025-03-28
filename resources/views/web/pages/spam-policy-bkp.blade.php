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
      <h1 class="home_heading_first">Spam Policy</h1>
      <h2 class="primery_color normal_heading">Compliance</h2>
      <p>Escorts4U complies with the Australian Spam Act 2003 as set out by the Australian
Communications & Media Authority.
      </p>
      <p>We believe strongly in preventing unwanted email from entering our Users inboxes and
offer a 'one click' unsubscribe function at the bottom of every promotional email, whether it
is from us or an Advertiser you, as a Viewer, have subscribed to. This function will
immediately unsubscribe your address from our system and Users will no longer receive
any further communications relating to promotions or notifications from Advertisers.
However, you will still receive our W-Alert emails as a result of any other communication
with Escorts4U.
</p>
<p>Our server provides an activation link when you register your email address on the
Website as a means to provide confirmation that you wish to 'opt-in' to certain lists, or
features we offer.</p>
<p>We also try to avoid over-marketing to your inbox. We understand the frustration of
receiving too many promotional emails, it's easy to get tired of seeing a company's
message in your inbox if its arriving every day. So we limit our promotional emails to just a
few a month if at all. It is more likely that you will receive information from an Advertiser
that you have added to your Legbox than from Escorts4U.</p>
<p>Escorts4U will never sell your details to any other organisation or for use in 'promotional
lists'. Not only is this is a breach of the Privacy Act, we consider that conduct to be
unethical. </p>
<p class="text_decoration_for_a">Should you have any concerns or queries about Escorts4U email marketing activities,
please contact our Privacy Officer: 

<a class="termsandconditions_text_color" href="mailto:">privacy@escorts4U.com.au</a></p>
      <!-- <h2 class="primery_color normal_heading">Changes to this Policy</h2>
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
 
       <h4>Spam Policy</h4>
 
 
       <div class="accordion-container">
          
          <div class="set">
             <a>
            Compliance
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Escorts4U complies with the Australian Spam Act 2003 as set out by the Australian Communications & Media Authority.</p>
                   <span class="custome_span_color">We believe strongly in preventing unwanted email from entering our Users inboxes and offer a 'one click' unsubscribe function at the bottom of every promotional email, whether it is from us or an Advertiser you, as a Viewer, have subscribed to. This function will immediately unsubscribe your address from our system and Users will no longer receive any further communications relating to promotions or notifications from Advertisers. However, you will still receive our W-Alert emails as a result of any other communication with Escorts4U.</span><br>
                   <span class="custome_span_color">Our server provides an activation link when you register your email address on the Website as a means to provide confirmation that you wish to 'opt-in' to certain lists, or features we offer.</span><br>
                   <span class="custome_span_color">We also try to avoid over-marketing to your inbox. We understand the frustration of receiving too many promotional emails, it's easy to get tired of seeing a company's message in your inbox if its arriving every day. So we limit our promotional emails to just a few a month if at all.  It is more likely that you will receive information from an Advertiser that you have added to your Legbox than from Escorts4U.</span><br>
                   <span class="custome_span_color">Escorts4U will never sell your details to any other organisation or for use in 'promotional lists'. Not only is this is a breach of the Privacy Act, we consider that conduct to be unethical.</span><br>
                   <span class="custome_span_color">Should you have any concerns or queries about Escorts4U email marketing activities, please contact our Privacy Officer: <a href="mailto:privacy@escorts4U.com.au">privacy@escorts4U.com.au</a></span>
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