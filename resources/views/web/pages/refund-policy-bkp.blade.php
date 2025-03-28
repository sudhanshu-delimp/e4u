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
      <h1 class="home_heading_first">Refund Policy</h1>
      <h2 class="primery_color normal_heading">Overview</h2>
      <p>Escorts4U recognises that from time to time Advertisers have issues regarding the
         payment of Fees. The following occasions are where our Refund Policy does not apply:
      </p>
      <ul>
         <li>
            <p class="mb-0">Your Profile has been posted on the Website but you have changed your mind,
               decided you did not like the published Profile, had no use for it, or found cheaper
               advertising elsewhere
            </p>
         </li>
         <li>
            <p class="text_decoration_for_a mb-0">You have breached our <a class="termsandconditions_text_color" href="{{ url('terms-conditions')}}">Terms and Conditions</a> including any of the <a href="{{ url('law-enforcement')}}" class="termsandconditions_text_color">Local Laws</a></p>
         </li>
         <li>
            <p class="mb-0">Your Profile is not presented in the form you asked for. (Profiles are presented in our
               template format according to your Membership type you chose)
            </p>
         </li>
         <li>
            <p class="mb-0">Any part of the Services become unavailable</p>
         </li>
      </ul>
      <h2 class="primery_color normal_heading">Request</h2>
      <p>You can request a refund of the Fee by:</p>
      <ul>
         <li>
            <p class="mb-0">Notifying Escorts4U about your query before:</p>
         </li>
         <ul>
            <li>
               <p class="mb-0">Your Profile is posted (you can create a Profile and place it on hold / archive it until
                  payment is made)
               </p>
            </li>
            <li>
               <p class="mb-0">Your membership registration becomes inactive</p>
            </li>
         </ul>
         <li>
            <p class="mb-0">Providing Escorts4U with sufficient information to assess your refund request (any
               errors that require correction, such as your arrival date)
            </p>
         </li>
      </ul>
      <p class="text_decoration_for_a">Any request for a refund needs to be registered as a "Support Ticket". Once you register
         your request with us, some one from of support team will contact you to determine
         whether to authorise a refund within five (5) business days from the date of your request.
         Escorts4U reserves the right, at its sole discretion, to authorise refunds, or credits on a
         case by case basis (see also <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a>).
      </p>
      <h2 class="primery_color normal_heading">Acknowledgement</h2>
      <p>You acknowledge and agree that you are liable for any Services provided to you by
         Escorts4U before any request for a refund is processed. Escorts4U may adjust any refund
         to account for the proportion of any Fees payable for the Services already utilised by you.
      </p>
     <!--  <h2 class="primery_color normal_heading">Changes to this Policy</h2>
      <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
         revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
         review the most current version.
      </p>
      <p>Escorts4U archives all previous versions of this Policy.</p>
      <p><b>This policy was last updated 01-12-18</b></p> -->

      <div class="container mt-4 px-0 chagneto-policy">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <<a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                   review the most current version.</p>
           <p>Escorts4U archives all previous versions of this Policy.</p>
           <p><b>This policy was last updated 01-12-18</b></p>
     </div>
   </div>
</section>









































<!-- <section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
     
       <h4>Refund Policy</h4>
      
 
       <div class="accordion-container">
          <div class="set">
             <a>
             Overview
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Escorts4U recognises that from time to time Advertisers have issues regarding thepayment of Fees. The following occasions are where our Refund Policy does not apply:</p>
                   <ul class="font_size_forteenpx" style="color:#686a6c;">
                      <li>Your Profile has been posted on the Website but you have changed your mind,decided you did not like the published Profile, had no use for it, or found cheaperadvertising elsewhere</li>
                      <li>You have breached our <a class="termsandconditions_text_color" href="#">Terms and Conditions</a> including any of the <a class="termsandconditions_text_color" href="#">Local Laws</a></li>
                      <li>Your Profile is not presented in the form you asked for. (Profiles are presented in ourtemplate format according to your Membership type you chose)</li>
                      <li>Any part of the Services become unavailable</li>
                  </ul>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
            Request
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content customepsizeofa">
                <div class="accodien_manage_padding_content">
                   <p>You can request a refund of the Fee by:</p>
                   <ul class="font_size_forteenpx" style="color:#686a6c;">
                      <li>Notifying Escorts4U about your query before:</li>
                      <ul style="list-style: disc;">
                        <li>Your Profile is posted (you can create a Profile and place it on hold / archive it untilpayment is made)</li>
                      <li>Your membership registration becomes inactive</li>
                      </ul>
                      <li>Providing Escorts4U with sufficient information to assess your refund request (anyerrors that require correction, such as your arrival date)</li>
                  </ul>
                  <span class="custome_span_color">
                     Any request for a refund needs to be registered as a "Support Ticket". Once you register your request with us, some one from of support team will contact you to determine whether to authorise a refund with in five (5) business days from the date of your request.Escorts4U reserves the right, at its sole discretion, to authorise refunds, or credits on acase by case basis (see also  <a class="termsandconditions_text_color" href="#">Terms and Conditions</a>).
                  </span>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
             Acknowledgement
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>You acknowledge and agree that you are liable for any Services provided to you by Escorts4U before any request for a refund is processed. Escorts4U may adjust any refund to account for the proportion of any Fees payable for the Services already utilised by you.</p>
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
                   <span class="custome_span_color">We may change or modify this Policy in the future.We will note the date that revisions were last made atthe bottom of this page.Any revision will take effectupon itsposting.It is your responsibility to check the <a class="termsandconditions_text_color" href="#">Terms and Conditionsand</a> this Policy from time to time to review the most current version.</span>
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