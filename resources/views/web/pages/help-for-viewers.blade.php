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
<section class="padding_top_eight_px padding_bottom_eight_px">


   <div class="container">

      
      <h1 class="home_heading_first margin_btm_twenty_px">Help for Viewers</h1>

      <div class="accordion-container">
         <div class="set">
             <a>
             Anonymity
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                 <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                         <div class="row">
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>
                                     <stong>
                                     Q:</strong> Can I remain anonymous as a subscriber?
                                 </b></p>
                                 <p>Yes you can. We only request your:</p>
                                 <ul>
                                     <li> Mobile number (for SMS 2FA verification), and notifications if you have your mobile number selected for that purpose </li>
                                     <li>Email address (for notifications)</li>
                                     <li>Your location (city)</li>
                                 </ul>
                                 <p>as a mandatory information requirement during the registration process.</p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Will Advertisers see my identity?</b></p>
                                 <p>No. During the registration process, you create a user name (optional) and you logon
                                     using your email address. Your Account details are never displayed to any other User. 
                                     Any communication between Users only shows the Member Number, unless the User
                                     enables their name to be displayed in any communications.
                                 </p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: How much control will I have?</b></p>
                                 <p>You have total control over every aspect of your Subscription. You can enable and
                                     disable every feature available to you, including your Subscription. It is your choice.                                
                                 </p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: What features can I control?</b></p>
                                 <p>In your Dashboard you will have access to the Viewer features. Some features are
                                     enabled by default which include:
                                 </p>
                                 <ul>
                                     <li>Legbox. You can flag your favourite Advertiser to be added to your Legbox </li>
                                     <li>Write reviews</li>
                                     <li>Receive A-Alert notifications (email is enabled by default)</li>
                                     <li>Participate in direct chatting with an Advertiser (if the Advertiser has this feature enabled)</li>
                                 </ul>
                                 <p>Optional features that you can enable include:</p>
                                 <ul>
                                     <li>What are your interests? (This will help us refine your Advertiser Home Page landing)</li>
                                     <li>Display my name in communications (whatever name you have set up in your Account details, which can be a fictitious name, like “Longman10")</li>
                                     <li>Password expiry (default is set to “Never”)</li>
                                     <li>Browser expiry (default is set to "Never")</li>
                                     <li>Advertiser notes (record your experience with an Advertiser "Notebox")</li>
                                     <li>A-Alert notifications (how you are notified for any alert, by email or text or both)</li>
                                     <li>Upload your Avatar (Display your personal image or any image with your Account summary)</li>
                                  </ul>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: What will happen if I leave the Website open on my browser and I walk away?</b></p>
                                 <p>If you are registered as a Viewer and logged on, and you walk away from your browser
                                     and there is no activity for the set time, if you have your preferences for this feature enabled, the Website will close and load “Google”
                                     home page after the set time has expired. 
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
                             <div class="set">
             <a>
             Benefits
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                 <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                         <div class="row">
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Are there any benefits to me as as Registered Viewer? </b></p>
                                 <p>Absolutely.  As a registered Viewer you receive a number of benefits, all of which are free.  You pay no Fees to access any of the Services provided to you as a Viewer.  Benefits include:</p>
                             </div>
                         </div>
                     </div>
                                                 <div class="table-responsive-sm">
                                <table class="table" style="border: 1px;">
                                    <thead>
                                    <tr>
                                        <th>Features</th>
                                        <th>Registered</th>
                                        <th>Unregistered</th>
                                        <th>Comments</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><p>Viewing</p></td>
                                        <td><p>✓</p></td>
                                        <td><p>✓</p></td>
                                        <td><p>View all of the Advertisers on the Website</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Chatting</p></td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Participate in direct chatting with Advertisers (provided they have enabled this feature)</td>
                                    </tr>
                                    <tr>
                                        <td>Favorites</td>
                                        <td>✓</td>
                                        <td>✓</td>       
                                        <td>Flag your favorite Escorts while searching and then view your shortlist</td>
                                    </tr>

                                    <tr>
                                        <td>Legbox</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Select your favorite Escorts by adding them to your Legbox. View your Legbox anytime</td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Send a message to an Escort (provided they have enabled this feature)</td>
                                    </tr>
                                    <tr>
                                        <td>My Playbox</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Access to all Playbox material uploaded by Escorts</td>
                                    </tr>

                                    <tr>
                                        <td>Notebox</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Make notes about your experience with an Escort</td>
                                    </tr>
                                    <tr>
                                        <td>Notifications</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Receive A-Alerts from Advertisers when they are visiting your location</td>
                                    </tr>
                                                                     
                                    <tr>
                                        <td>Rating</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Rate your experience with an Escort so you will remember for next time</td>
                                    </tr>
                                    <tr>
                                        <td>Recommendation</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Share your experiences and publish a recommendation [thumb icon up] or [thumb icon down]</td>
                                    </tr>
                                    <tr>
                                        <td>Reviews</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Write a review about your experience with an Escort</td>
                                    </tr>
                                    <tr>
                                        <td>Security</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Our Website is a secure environment so that we can maintain your anonymity</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                 </div>
             </div>
                   </div>              

                   <div class="set">
             <a>
             Marketing and Third Party Advertisers
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                 <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                         <div class="row">
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Will my email address or mobile number be passed onto third parties? </b></p>
                                 <p>Absolutely not. Your identity will remain absolutely confidential. We do not on-sell any
                                     data about Users. Escorts4U works hard to ensure your privacy, and does not
                                     promote any advertising, marketing or third party approaches on the Website. We do
                                     not even permit competitor platforms to advertise on the Website. Profiles are not
                                     permitted to advertise any third party promoters or marketing material, not even “Only
                                     Fans” or any similar websites for example.
                                 </p>
                                 <p>
                                     To the greatest extent possible, the Website is coded to limit or prohibit ‘big tech’ from crawling over your information while logged on.
                                 </p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Can Advertisers market to me?</b></p>
                                 <p>No. Unless you enable the "Alert" feature with a favourite Advertiser, and they choose
                                     to use the feature, you will not receive any material or notifications.
                                 </p>
                                 <p><b>How can I see an Escort's Playbox?</b></p>
                                 <p>Whenever an Escort posts a Profile, anywhere in Australia, if the Escort has My Playbox enabled, then the ‘My Playbox’ icon will appear on the Profile. Simply click the My Playbox icon and it will take you to the Escort’s Playbox page.</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
                   </div>              

         <div class="set">
             <a>
             Payments
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                 <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                         <div class="row">
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: How much will it cost me to be a Member?</b></p>
                                 <p>Absolutely nothing.  Subscription to the Website is absolutely free. There are absolutely no
                                     Fees to pay. There are no restrictions to any of the Services or to Advertisers.
                                 </p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Can I pay an Escort through the Website?</b></p>
                                 <p>Absolutely not. Escorts4U does not act as agent for Advertisers. You need to
                                     speak to the Advertiser to ascertain what are their payment options. A Profile
                                     will usually display payment options with an Advertiser.
                                 </p>
                             </div>
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Are there any payments I need to make? </b></p>
                                 <p>No. As a Viewer there are no charges to be a subscriber to the Website.
                                     Absolutely none.
                                 </p>
                                 <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 23-05-2025</b></p>
                  </div>
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>
                 </div>
             </div>
         </div>
     </div>

         {{--<div class="accordion-container">
            <div class="set">
               <a>
                  Anonymity
               <i class="fa fa-angle-down"></i>
               </a>
               <div class="content">
                  <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                     <div class="row">
                        <div class="col-sm-12">
                              <p class="pt-2"><b><stong>Q: Can I remain anonymous as a subscriber?</stong></b></p>
                              <p class="pbot">Yes you can. We only request your:</p>
                              <ul>
                              <li> Mobile number (for SMS 2FA verification) </li>
                              <li>Email address (for notifications)</li>
                              <li>Your location (city)</li>
                           </ul>
                           <p>as a mandatory information requirement during the registration process.</p>
                        </div>
                        <div class="col-sm-12">
                           <p class="pt-2"><b>Q: Will Advertisers see my identity?</b></p>
                           <p class="pbot">No. During the registration process, you create a user name (optional) and you logon
                              using your email address. Your Account details are never displayed to any other User. 
                              Any communication between Users only shows the Member Number, unless the User
                              enables their name to be displayed in any communications.
                              </p>
                     </div>
                     <div class="col-sm-12">
                           <p class="pt-2"><b>Q: How much control will I have?</b></p>
                           <p class="pbot">You have total control over every aspect of your Subscription. You can enable and
                              disable every feature available to you, including your Subscription. It is your choice.                                
                              </p>
                     </div>
                     <div class="col-sm-12">
                           <p class="pt-2"><b>Q: What features can I control?</b></p>
                           <p class="pbot">In your Dashboard you will have access to the Viewer features. Some features are
                              enabled by default which include:</p>
                              <ul>
                                 <li>Legbox. You can flag your favourite Advertiser to be added to your Legbox </li>
                                 <li>Write reviews</li>
                                 <li>Receive A-Alert notifications (email is enabled by default)</li>
                                 <li>Participate in direct chatting with an Advertiser (if the Advertiser has this feature enabled)</li>
                              </ul>
                           <p>In your Dashboard you will have access to the Viewer features. Some features are:
                              </p><ul>
                                 <li>What are your interests? (This will help us refine your Advertiser Home Page landing)</li>
                                 <li>Display my name in communications (whatever name you have set up in your Account details, which can be a fictitious name, like “Longman10")</li>
                                 <li>Password expiry (default is set to “Never”)</li>
                                 <li>Advertiser notes (record your experience with an Advertiser)</li>
                                 <li>A-Alert notifications (how you are notified for any alert, by email or text or both)</li>
                                 <li>Upload your Avatar (Display your personal image or any image with your Account summary)</li>
                                 <li>My Pin-Up escort (display your favourite Escort on your dashboard)</li>
                              </ul>
                     </div>
                     <div class="col-sm-12">
                           <p class="pt-2"><b>Q: What will happen if I leave the Website open on my browser and I walk away?</b></p>
                           <p class="pbot">If you are registered as a Viewer and logged on, and you walk away from your browser
                              and there is no activity on the Website, then the Website will close and load “Google”
                              home page. </p>
                     </div>
                     </div>
                  </div>
               </div>
               </div>
            </div>

            <div class="set">
               <a>
               payments
               <i class="fa fa-angle-down"></i>
               </a>
               <div class="content">
                  <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                     <div class="row">
                        <div class="col-sm-12">
                           <p class="pt-2"><b>Q: How much will it cost me to be a Member?</b></p>
                           <p class="pbot">Nothing, Subscription to the Website is absolutely free. There are absolutely no
                              Fees to pay. There are no restrictions to any of the Services or to Advertisers.</p>
                        </div>
                        <div class="col-sm-12">
                        <p class="pt-2"><b>Q: Can I pay an Escort through the Website?</b></p>
                        <p class="pbot">Absolutely not. Escorts4U does not act as agent for Advertisers. You need to
                           speak to the Advertiser to ascertain what are their payment options. A Profile
                           will usually display payment options with an Advertiser.</p>
                     </div>
                     <div class="col-sm-12">
                     <p class="pt-2"><b>Q: Are there any payments I need to make? </b></p>
                        <p class="pbot">No. As a Viewer there are no charges to be a subscriber to the Website.
                           Absolutely none.</p>
                  </div>
                     
                     </div>
                  </div>
               </div>
               </div>
            </div>

               <!--  Marketing and Third Party Advertisers -->
            <div class="set">
               <a>
               Marketing and Third Party Advertisers
               <i class="fa fa-angle-down"></i>
               </a>
               <div class="content">
                  <div class="accodien_manage_padding_content">
                     <div class="border_top_one_px padding_ten_px_top_btm">
                        <div class="row">
                           <div class="col-sm-12">
                              <p class="pt-2"><b>Q: Will my email address or mobile number be passed onto third parties?</b></p>
                                 <p class="pbot">Absolutely not. Your identity will remain absolutely confidential. We do not on-sell any
                                 data about Users. Escorts4U works hard to ensure your privacy, and does not
                                 promote any advertising, marketing or third party approaches on the Website. We do
                                 not even permit competitor platforms to advertise on the Website. Profiles are not
                                 permitted to advertise any third party promoters or marketing material, not even “Only
                                 Fans” or any similar websites for example.</p>
                                 <p>
                                       To the greatest extent possible, the Website is coded to limit or prohibit ‘big tech’ from crawling over your information while logged on.
                                 </p>
                           </div>
                           <div class="col-sm-12">
                           <p class="pt-2"><b>Q: Can Advertisers market to me?</b></p>
                              <p class="pbot">No. Unless you enable the "Alert" feature with a favourite Advertiser, and they choose
                              to use the feature, you will not receive any material or notifications.</p>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>--}}
   
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