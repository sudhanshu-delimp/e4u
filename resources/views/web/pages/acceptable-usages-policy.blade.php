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
      <section class="mx-auto max_width_for_content">
      <section class="main_bg_color policy_padding text-center">
        <a href="#">
         <img src="img/logo.png" class="img-fluid" alt="">
        </a>
      </section>
      <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
      <div class="container">
         <h1 class="home_heading_first">Acceptable Use Policy</h1>
         <h2 class="primery_color normal_heading">Overview</h2>
         <p>These acceptable usage guidelines (Guidelines) describe the proper kinds of conduct and prohibited uses of Excorts services (Services) provided by Excorts (Excorts). These Guidelines are not exhaustive and Excorts reserves the right to modify them at any time, effective upon posting of the modified Guidelines to the Excorts website at: www.excorts.com.au (Website).</p>
         <p class="text_decoration_for_a">By registering for and using the Services, and thereby accepting these terms and conditions, you also agree to abide by the Guidelines as modified from time to time. Any violation of the Guidelines may result in the termination of your Account in the manner described in the Excorts <a href="#" class="termsandconditions_text_color">Terms and Conditions</a> (Terms). These Guidelines are to be read in conjunction with the Terms.</p>
         <h2 class="primery_color normal_heading">Guidelines</h2>
         <h5 class="policy_sub_headings">1.Your general responsibilities</h5>
         <p class="padding_left_five_px">The Services enable you to advertise escort and massage centre services, in the form of a Profile and to undertake a search for information. Generally, Excorts will not actively monitor, censor, or directly control any use that is made of the Website. Excorts provides the Services to you for the purposes of: </p>
         <ul>
            <li><p class="mb-0">Ensuring security, reliability and privacy of the Services and any User of the Services</p></li>
            <li><p class="mb-0">Maintaining an image and reputation of Excorts as a responsible provider of the Services</p></li>
            <li><p class="mb-0">Encouraging the responsible use of the Services by you and discouraging any  degrading, defamatory or illegal use of the Website</p></li>
         </ul>
         <p class="padding_left_five_px text_decoration_for_a">Excorts expects you to use the Services with respect toward others and in a responsible manner. A breach of the Guidelines is strictly prohibited and may result in the immediate termination of the Services. You remain solely liable and responsible for your use of the Services (see also <a href="#" class="termsandconditions_text_color">Covid-19 Statement</a>) and any and all content that you display, upload, download or transmit through the use of the Services. Indirect or attempted breaches of the Guidelines, and actual or attempted breaches by a third party on your behalf, are deemed to be a breach of the Guidelines by you and may result in the immediate termination of the Services.</p>
         <h5 class="policy_sub_headings">2.Illegal or harmful use</h5>
         <ul class="padding_zero_px">
            <li><p class="padding_left_five_px">You may use the Services for lawful purposes only. The transmission, distribution, sale, or storage of any material in violation of any Local Law, regulation, or the Guidelines is strictly prohibited. Excorts reserves the right, at its sole discretion, to restrict or prohibit any and all Uses of the Services or content in your Profiles and to remove any materials from its servers it considers appropriate for removal at its sole discretion where it is considered to be harmful to its servers, systems, network, reputation, good will, other Users, or any third party. Examples of such material include, without limitation, any material that falls within the following circumstances:</p></li>
         </ul>
         <ul class="padding_zero_px">
            <ul class="list_style_disc">
               <li>
                  <h5 class="policy_sub_headings">Infringement</h5>
                  <p>Material which is an infringement of intellectual property rights or other proprietary rights including, without limitation, material protected by copyright, trademark, patent, trade secret, rights to keep information confidential, or other intellectual property rights used without proper authorisation. Infringement may result from, among other activities, the unauthorised copying and posting of pictures, logos, software, articles, musical works and videos.
                  </p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Offensive Materials</h5>
                  <p>Material which constitutes the transmission, dissemination, sale, storage or hosting of any material that is unlawful, defamatory, obscene, pornographic, indecent, lewd, harassing, threatening, harmful, invasive of privacy rights, abusive, inflammatory or otherwise objectionable.
                  </p>
               </li>
                <li>
                  <h5 class="policy_sub_headings">Harmful Content</h5>
                  <p>Material which constitutes the dissemination or hosting of harmful content including, without limitation, viruses, Trojan horses, worms, time bombs, cancel-bots or any other computer programming routines that may damage, interfere with, surreptitiously intercept or expropriate any system, program, data or personal information.
                  </p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Fraudulent Conduct</h5>
                  <p>Material which offers or disseminates fraudulent goods, services, schemes, or promotions (for example and without limitation, make money fast schemes, chain letters, pyramid schemes), or the furnishing of false data on any signup forms, contracts or online applications or registrations, or the fraudulent use of any information obtained through the use of the Services, including, without limitation, the use of Card numbers.
                  </p>
               </li>
            </ul>
            </p>
         </li>
         </ul>
         <h5 class="policy_sub_headings">3. System and network security and integrity</h5>
         <ul class="padding_zero_px">
            <li><p class="padding_left_five_px">Breaches of Excorts or any third party's server, system or network security through the use of the Services are prohibited, and may result in a criminal referral or the commencement of civil proceedings. Excorts may, at its sole discretion, investigate incidents involving such violations which may include the co-operation with any law enforcement agency if a criminal act is suspected. Examples of server, system or network security violations include, without limitation, the following:
            <ul class="list_style_disc">
               <li>
                  <h5 class="policy_sub_headings">Hacking</h5>
                  <p>Unauthorised access to or use of data, systems, server or networks, including any attempt to probe, scan or test the vulnerability of a system, server or network or to breach security or authentication measures without express authorisation of Excorts, the owner of the system, server or network.
                  </p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Interception</h5>
                  <p>Unauthorised monitoring of data or traffic on any network, server, or system without express written authorisation of Excorts, the owner of the system, server, or network.</p>
               </li>
                <li>
                  <h5 class="policy_sub_headings">Intentional Interference<h5>
                  <p>Interference with the Service by any user, host or network including, without limitation, mail bombing, news bombing, other flooding techniques, deliberate attempts to overload a system, broadcast attacks and any activity resulting in the crash of a host. Intentional interference also includes, without limitation, the use of any kind of program/script/command, or send messages of any kind, designed to interfere with a User's terminal session, via any means, locally or by the Internet.</p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Falsification of Origin</h5>
                  <p>Forging of any TCP-IP packet header, e-mail header or any part of a message header. This prohibition includes the use of aliases or anonymous re-mailers.</p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Avoiding System Restrictions</h5>
                  <p>Using manual or electronic means to avoid any use limitations placed on the Services such as timing out.</p>
               </li>
               <li>
                  <h5 class="policy_sub_headings">Failure to Safeguard Accounts</h5>
                  <p>Failing to prevent unauthorised access to your Account, including any account password.</p>
               </li>
            </ul>
            </p>
         </li>
         </ul>
         <h5 class="policy_sub_headings">4. E-Mail</h5>
         <ul class="padding_zero_px">
            <li><p class="padding_left_five_px">You may not distribute, publish, or send any of the following types of e-mail:
            <ul class="list_style_disc">
               <li>

                  <p>unsolicited promotions, advertising or solicitations (commonly referred to as "spam"), including, without limitation, commercial advertising and informational announcements, except to those who have explicitly requested such e-mails</p>
               </li>
               <li>
                  <p>commercial promotions, advertising, solicitations, or informational announcements that contain false or misleading information in any form</p>
               </li>
                <li>
                  <p>harassing e-mail, whether through language, frequency, or size of messages</p>
               </li>
               <li>
                  <p>Chain letters</p>
               </li>
               <li>
                  <p>malicious e-mail, including without limitation "mail bombing" (flooding a user or web site with very large or numerous pieces of e-mail) or "trolling" (posting outrageous messages to generate numerous responses)</p>
               </li>
               <li>
                  <p>e-mails containing forged or falsified information in the header (including sender name and routing information), or any other forged or falsified information</p>
               </li>
            </ul>
            </p>
            <p class="padding_left_five_px">In addition, you may not use the Excorts mail server or another website's mail server to relay mail without the express written permission of the account holder of the website. Posting the same or similar message to one or more newsgroups (excessive cross-posting or multiple-posting) is also explicitly prohibited.</p>
         </li>
         </ul>
<h5 class="policy_sub_headings">5. Protection of Minors</h5>
         <ul class="padding_zero_px">
            <li><p class="padding_left_five_px text_decoration_for_a">Excorts takes seriously the protection of minors. We are serious in applying youth protection law and will exclude any Advertiser who violates our <a href="#" class="termsandconditions_text_color ">Terms and Conditions</a>, incorporating this policy, by publishing prohibited content or images (see also <a href="#" class="termsandconditions_text_color text_decoration-none">Law Enforcement & Trafficking Policy</a>).</p>
         </li>
         </ul>
         
   <h2 class="primery_color normal_heading">Changes to this Policy</h2>
   <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check both the Terms & Conditions and this Policy from time to time to review the most current version.</p>
   <p>Escorts4U archives all previous versions of this Policy</p>
   <h5 class="policy_sub_headings">This policy was last updated 20-02-2022</h5>

   <a href="{{ url('/')}}"><button type="button" class="btn policy_close_btn">Close</button></a>

      </div>
      </section>
   </section>
@endsection
@push('scripts')
<script>
   $(document).ready(function(){

       // if($.cookie('user-agreement') != 'true') {
       //     $('.akh').hide();
       //     console.log( $.cookie('user-agreement'));
       // }
   });
</script>
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
