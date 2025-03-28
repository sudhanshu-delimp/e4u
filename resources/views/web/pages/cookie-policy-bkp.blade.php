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
      <h1 class="home_heading_first margin_btm_twenty_px page-title">Cookie Policy</h1>

            <h2 class="primery_color normal_heading">Information about the use of Cookies</h2>
            <p>
                Subject to the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F;font-size: 16px;">Terms and Conditions</a>, by using the Services, you accept the following conditions in relation to the use of cookies.
            </p>
            
            <p>
                The Website uses cookies to distinguish you from other Users of the Website. This helps
                us to provide you with a good experience when you browse the Website and also allows
                us to improve the Website. A cookie is a small file of letters and numbers that we store on
                your browser or the hard drive of your computer if you agree. Cookies contain information
                that is transferred to your computer’s hard drive.
            </p>
           
            <p>
                We use the following cookies:
            </p>
            <ul>
                <li>
                    Strictly necessary cookies. These cookies are essential to enable you to move around
                    our Website and use all of the features. Without these cookies, some of the Services
                    you have asked may not be able to be provided.
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
                If you are a registered User of this Website, Cookie management is available to you from
                within My Account.
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
           <p><b>This policy was last updated 01-12-18</b></p>
     </div>
      
   </div>
</section>


























<!-- <section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
       <h4>Copyright Statement</h4>
      
 
 
       <div class="accordion-container">
          
          <div class="set">
             <a>
             All Rights Reserved
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>All text, images and graphics on this Website (Portal) are protected by copyright
Cornitatus Pty Ltd (Cornitatus) ACN: 653 259 191.</p>
                   <span class="custome_span_color">Neither the whole or part of any information or material displayed in the Portal
(Information), including any underlying code or programming, may be printed out, copied,
downloaded, duplicated, adapted, transmitted, emailed, forwarded, distributed, sold,
licensed, dealt with or reverse-engineered without the prior written permission of
Cornitatus, except for Information that is printed from a PRINT function within the Portal
(for example, not from a print function which is a function available in the User's web
browser).
</span><br>
<span class="custome_span_color">Any other Trademarks, Copyrighted information and/or any other intellectual property
(Other Marks) that may be mentioned or displayed in the Portal and which are not the
property of Cornitatus, is the property of that Other Mark's respective owner whether
mentioned by name or not.
</span><br>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
            Permitted information
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Subject to the requirement that you only print Information from a PRINT function within the
Portal, you are permitted to view, copy, print, forward and distribute the Information
contained in the Portal provided that the Information is not on-sold, otherwise traded for
value or used inconsistently with the <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Terms & Conditions</a></span> pursuant to which the
Information was provided and subject to your agreement that you will:
<ul class="font_size_forteenpx" style="color:#686a6c;">
    <li>not modify the Information or any graphics contained within the Portal; and
</li>
    <li>display the copyright notice (Copyright Cornitatus Pty Ltd) on all Information used from
the Portal.
</li>
</ul>
</p>

                </div>
             </div>
          </div>
          <div class="set">
             <a>
             Enquiries
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>All enquiries are to be directed to our Privacy Offer: <a style="font-size: 14px;" href="#">privacy@escorts4u.com.au</a></p>
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