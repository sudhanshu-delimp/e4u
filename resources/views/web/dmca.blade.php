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
      <h1 class="home_heading_first">DMCA Notices</h1>
       <p>The United States Digital Millennium Copyright Act <strong>(DMCA Act)</strong> provides measures for
       owners of copyrighted material <strong>(Material)</strong> to address allegations of misuse of the Material.</p>
       <p>Escorts4U recognises the spirit of the DCMA Act and therefore takes any allegations of
intellectual property infringement seriously. If you believe that your intellectual property is
being used without your permission by an Advertiser (Infringement) on the Website, you can
bring the alleged Infringement to our attention <strong>(Report)</strong>.
</p>
 
      <p>To assist us in addressing your Report, please provide the following important information:
      </p>
      <ul>
         <li>
            <p class="mb-0">A physical or electronic signature of the authorised representative or owner of the
            copyright that is allegedly infringed;
            </p>
         </li>
         <li>
            <p class="mb-0">A description of the material that is allegedly infringed, or, if there are multiple
            Infringements, a list of the Material;
            </p>
         </li>
         <li>
            <p class="mb-0">A description of the Material that is to be removed from the Website and sufficient
            information that will enable E4U to locate the Material within the Website;</p>
         </li>
         <li>
            <p class="mb-0">Your contact details, including your address, telephone number and e-mail address;
            </p>
         </li>
         <li>
            <p class="mb-0">A statement from you that you have a good faith belief that use of the Material is not
            authorised by the copyright owner, its representative (if applicable), or the law; and
            </p>
         </li>
         <li>
            <p class="mb-0">A statement from you that the Report is accurate, and that you are authorised to act
            on behalf of the copyright owner by providing the expressed terms of the authorisation.</p>
         </li>
      </ul>
      <p><strong> Please forward your Report to:</strong>
      </p>
      <p> <strong>Blackbox Tech Pty Ltd <br>
GPO Box T1756<br>
Perth WA 6845 <br> or: <br>
E: <a href="mailto:info@escorts4u.com.au">info@escorts4u.com.au</a> </strong></p>
      <h3 class="primery_color normal_heading">Disclaimer
      </h3>
      <p>Blackbox Tech Pty Ltd <strong>(Blackbox Tech)</strong> co-operates with copyright holders when called
upon and aims to ensure that their Material is not misused by Advertisers. To the full extent
permitted by law, Blackbox Tech disclaims all and any claims for any Infringement, expressed
or implied, regarding any use of the Material posted by an Advertiser.<p>
    <p>Blackbox Tech reserves the right to pursue claims against any person who makes a false
Report about an Advertiser and the Material, and reserves all of its rights to seek
compensation for any damages or losses suffered as a result of any fraudulent Report.</p>
     
     
     
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