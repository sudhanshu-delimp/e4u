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
       <p>Advertisers may request a refund from Escorts4U in accordance with this Policy.</p>

      <p>The following occasions are where our Refund Policy does not apply:
      </p>
      <ul>
         <li>
            <p class="mb-0">Your Profile has been posted on the Website but you have changed your mind,
                decided you did not like the published Profile, had no use for it, or found cheaper
                advertising elsewhere
            </p>
         </li>
         <li>
            <p class=" mb-0">You have breached our <a class="termsandconditions_text_color" href="{{ url('terms-conditions')}}">Terms and Conditions</a> including any of the <a href="{{ url('faqs#Local_Laws')}}" class="termsandconditions_text_color">Local Laws</a></p>
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
      <h2 class="primery_color normal_heading">Refund Request Process
      </h2>
       <p><u><i>When can a refund be requested?</i></u></p>
      <p>You can request a refund of the Fee before:</p>
      <ul>
         <li>Your Profile is posted (you can create a Profile and place it on hold / archive it until
             payment is made); or
         </li>
         <li>Your membership registration becomes inactive</li>
      </ul>
      <p>Any refund request made after a Profile or Tour has been posted, or your Membership
          becomes inactive will not be considered or provided.
      </p>
       <p><u><i>How can a refund requested?</i></u></p>
      <p>A written refund request must be submitted to Escorts4U by the Advertiser or Agent. A
          written refund request can only be submitted by ‘Support Ticket’. The written request must
          be sent to <a href="mailto:support@e4u.com.au">support@escorts4u.com.au</a>. Your refund request must include sufficient information for us to assess your refund request (including any errors that require
          correction, such as your arrival date).
      </p>
       <p><u><i>What happens after the refund request is made?</i></u></p>
      <p class="mb-1">Escorts4U will action the ‘Support Ticket’ promptly after receiving the written refund
          request.
      </p>
      <p>Escorts4U will contact you within five (5) business days from the date of your request to
          gather more information to allow it to determine whether or not to authorise a refund.
      </p>
       <p><u><i>How will a refund request be decided?</i></u></p>
      <p class="mb-1">Escorts4U reserves the right, at its sole discretion, to authorise refunds, or credits on a
          case by case basis (see also <a href="{{ url('terms-conditions')}}"
                                          class="termsandconditions_text_color">Terms and Conditions</a>).
      </p>
      <p>You will be informed of the outcome of the refund request within thirty (30) days from your
          refund request being received. If a refund request is approved the refund will be provided
          to the provided bank account details within two (2) business days of your refund request
          being approved.
      </p>
      <h5>Acknowledgment</h5>
      <p>You acknowledge and agree that you are liable for any Services provided to you by
          Escorts4U before any request for a refund is processed. Escorts4U may adjust any refund
          to account for the proportion of any Fees payable for the Services already utilised by you.
      </p>
      <div class="container mt-4 px-0 chagneto-policy">
      <hr class="custom_hr">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
            review the most current version.
         </p>
         <p>Escorts4U archives all previous versions of this Policy.</p>
         <p><b>This policy was last updated 23-05-2025</b></p>
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
