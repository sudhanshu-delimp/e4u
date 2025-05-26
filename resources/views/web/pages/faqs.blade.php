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
      <h1 class="home_heading_first margin_btm_twenty_px">Frequently Asked Questions</h1>
      <div class="accordion-container">
         <div class="set">
            <a>
            Administration
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p class="pt-4"><b>Q:How do I get to post my Profile on the Escorts Home Page?</b></p>
                  <p>Your Membership automatically entitles you to appear on the Escort Home Page,
                     appearing within the Membership Type you have selected when creating your Profile. 
                     Where the number of Profiles exceeds, within the Membership Type, the number of
                     available positions within the Escort Home Page, the Website, every two hours, will
                     randomly rotate the Profiles, so as to ensure all Advertisers receive equal time at the
                     top of their respective Membership Types. The rotation of Profiles occurs in both List
                     View and Grid View.
                  </p>
                  <p>Only the Membership Type 'Free', will be presented with a silhouette thumbnail, that is,
                     the thumbnail is not apparent on the Escort Home Page, but their photographs do
                     appear within their Profile which Viewers can see when they open the Profile. Their
                     Profile summary is also restricted, Viewers will need to open the Profile to determine
                     all of the Escort's basic information to form a perception.
                  </p>
                  <p><b>Q:How long do I have to wait to be at the top of the Escort Home Page?</b></p>
                  <p>Every Profile within a Membership Type is randomly rotated every two hours.</p>
                  <p><b>Q:What if I forget my login or password?</b></p>
                  <p>If you forget your password simply go to the Logon Page and click the “forgot
                     password” link and then enter your details. You will receive an email to the email
                     address registered in your My Account details. Escorts4U also uses SMS 2FA
                     technology for certain functions within the Website, including login and password
                     recovery.
                  </p>
                  <p><b>Q:Do I need a SWA (see <a class="c-red" href="faqs">Local Laws</a> Victoria) number to advertise with you?</b></p>
                  <p>If you are operating as a sex worker in Victoria, you have the option of displaying your SWA number on your Profile. It is no longer compulsory to register and display your SWA number under the Victorian State government legislation. Your Profile setup has a provision for you to insert your SWA number. You will be able to complete a Profile without your SWA number where your Home State or the Profile is designated as Victoria.
                  </p>
                  <p>If you do not currently have a SWA number, but would prefer to do so, you will need to register with the Business Licensing
                     Authority (BLA). For more information, contact the BLA at:
                  </p>
                  <p><a href="www.consumer.vic.gov.au/businesses/licensed-businesses/sex-work-service-providers">www.consumer.vic.gov.au/businesses/licensed-businesses/sex-work-service-providers
                     </a>
                  </p>
                  <p><b>Q:Can I have a default Profile - can I create other Profiles from my default Profile when I
                     want to Tour?</b>
                  </p>
                  <p>Yes you absolutely can. In fact you can go further by creating a Profile for each city
                     you visit. Each Profile is kept in your Archive Folder. Simply turn off your Profile when
                     you are leaving a city and turn on your Archived Profile for the city your are next
                     visiting. Very convenient. This way you can have subtle differences between Profiles
                     within Locations. 
                  </p>
                  <p>You can go one step further and create a Tour, two or more Locations, by linking your
                     Profiles you have created and stored in your Archive Folder. Once you post your Tour
                     all you need to do is keep to the scheduled dates you have set in the Tour. Each
                     Profile for the Location you are in will be posted the day before you arrive and will be
                     taken down at midnight preceding the day you leave, all done automatically. You don't
                     need to do anything. You can edit your Tour along the way if your schedule changes. 
                     The Website keeps track of any changes to your Tour along the way, such as where
                     you shorten a stay in a Location, you will be credited for the number of days you have
                     reduced the Tour by.
                  </p>
               </div>
            </div>
         </div>
<div class="set">
            <a id="Local_Laws">
            Local Laws
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <table class="table color-black">
                     <tbody>
                        <tr>
                           <td class="font-weight-bold" style="width: 10%;">State
                           </td>
                           <td class="font-weight-bold">Legislation<sup>(1)</sup></td>
                           <td class="font-weight-bold">Regulations</td>
                           <td class="font-weight-bold">Comments</td>
                        </tr>
                        <tr>
                           <td>Federal</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www6.austlii.edu.au/cgi-bin/viewdoc/au/legis/cth/consol_act/cca1995115/sch1.html">Criminal Code Act 1995</a></td>
                           <td>None</td>
                           <td>Divisions 270 &amp; 271</td>
                        </tr>
                        <tr>
                           <td>ACT</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.legislation.act.gov.au/a/1992-64/default.asp">Sex Work Act 1992</a></td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.legislation.act.gov.au/sl/1993-19/default.asp">Prostitution Regulation 1993</a></td>
                           <td>Regulations repealed 9th August 2018</td>
                        </tr>
                        <tr>
                           <td>NSW</td>
                           <td>As at 1st January 2021, there is no Prostitution legislation in place in the State of New South Wales.</td>
                           <td>None</td>
                           <td>None</td>
                        </tr>
                        <tr>
                           <td>NT</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/nt/consol_act/pra317/">Prostitution Regulation Act</a></td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/nt/consol_reg/pr314/">Prostitution Regulations</a></td>
                           <td>None</td>
                        </tr>
                        <tr>
                           <td>QLD</td>
                           <td><a class="theme-text-color" target="_blank" href="https://www.legislation.qld.gov.au/view/html/inforce/current/act-1999-073">Prostitution Act 1999</a></td>
                           <td><a class="theme-text-color" target="_blank" href="https://www.legislation.qld.gov.au/view/html/inforce/current/sl-2014-0192">Prostitution Regulation 2000</a></td>
                           <td>Massage Centres must have their business telephone number registered with the Prostitution Licensing Authority and display their number in their Profile</td>
                        </tr>
                        <tr>
                           <td>SA:</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/sa/consol_act/clca1935262/">Criminal Law Consolidation Act 1935</a> and <a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/sa/consol_act/soa1953189/index.html">Summary Offences Act 1953</a></td>
                           <td>None</td>
                           <td>None</td>
                        </tr>
                        <tr>
                           <td>TAS</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/tas/consol_act/sioa2005253/">Sex Industry Offences Act 2005</a></td>
                           <td>None</td>
                           <td>None</td>
                        </tr>
                        <tr>
                           <td>VIC</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.legislation.vic.gov.au/Domino/Web_Notes/LDMS/LTObject_Store/ltobjst8.nsf/DDE300B846EED9C7CA257616000A3571/818BBA0CE3EA0706CA257BC60007035D/$FILE/94-102aa080%20authorised.pdf">Sex Work Act 1994</a></td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.legislation.vic.gov.au/Domino/Web_Notes/LDMS/LTObject_Store/LTObjSt7.nsf/DDE300B846EED9C7CA257616000A3571/11D809EA9BF85B86CA257B200017205D/$FILE/06-64sra012%20authorised.pdf">Sex Work Regulations 2006</a></td>
                           <td>You must display your SWA in your Profile</td>
                        </tr>
                        <tr>
                           <td>WA:</td>
                           <td><a class="theme-text-color" target="_blank" href="http://www.austlii.edu.au/au/legis/wa/consol_act/pa2000205/">Prostitution Act 2000</a></td>
                           <td>None</td>
                           <td>None</td>
                        </tr>
                     </tbody>
                  </table>
                  <p class="border-top-0 pl-2 pb-2"><b>Note:</b> 1. Local Laws published in the relevant jurisdiction as at 1st January 2024.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Managing My Account & Profiles
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p style="border: none;"><b>Q: What Account information is mandatory for an Advertiser and what is not?</b></p>
                  <p>When you register to be come a Member, there is some mandatory information we
                     request from you, such as your:
                  </p>
                  <ul>
                     <li>mobile number</li>
                     <li>email account; and</li>
                     <li>Home State (where you are domiciled).</li>
                  </ul>
                  <p>You do not have to provide your name but it is optional. When you create a Profile,
                     you can nominate a Profile Name for the Profile you are creating. We refer to that name as your 'Stage Name'.  You can allocate a
                     different Stage Name for each Profile and have as many as your like.
                  </p>
                  <p>When Escorts4U or a User communicates with you, you are addressed by your
                     Membership Number unless you have provided your name to us.
                  </p>
                  <p><b>Q: What Account information is mandatory for a Viewer and what is not?</b></p>
                  <p>When you register to be come a Member, there is some mandatory information we
                     request from you, such as your:
                  </p>
                  <ul>
                     <li>mobile number; and</li>
                     <li>Home State (where you are domiciled).
                     </li>
                  </ul>
                  <p>You do not have to provide your name but it is optional and should you choose to have
                     a name, the name you choose can be anonymous in nature. 
                  </p>
                  <p><b>Q: To what extent is Geolocation applied in the Website?</b>
                  </p>
                  <p>Geolocation by proxy IP is by Country-Region-City. The Website does not undertake
                     any geolocation search beyond the City you reside in. If you do not live in a capital
                     city, then the Website will by default attach you to the capital city in the region
                     Location.
                  </p>
                  <p><b>Q: Once I am online, can I update my Profile(s) by myself?</b>
                  </p>
                  <p>Absolutely, you can. Managing your Profiles has never been easier. All Advertisers
                     have their own username and password, and have the ability to login and update their
                     Account, Profile Information and Profiles any time of the day. All changes to Profile
                     content and settings will be visible online immediately.</p>
                  
                  <p>We even make it much easier for you by making available an Agent to help you with
                     your Account, Profile Information, Profiles and Tours. Once you have registered, you
                     simply request the help of an Agent and they will help you with all your queries and
                     management of your Account.
                  </p>
                  <p><b>Q: Can I update my Media?</b></p>
                  <p>You certainly can. You will have direct access to your image gallery and videos
                     retained in your Archive Folder. Simply log on and upload or delete Media retained in
                     your Archive Folder (those which are displayed in any of your Profiles) any time of the
                     day. You can move Media around and nominate which photo image is your
                     Thumbnail or Banner Image.
                  </p>
                  <p>If required, we will format your Media for you, to create a striking presentation. All
                     changes to images will be online within a 24 hour period of new images having been
                     uploaded (often within a few hours).
                  </p>
                  <p>Once you have all of your images and video uploaded in your Archive Folder, you will
                     have three groups of Media:
                  </p>
                  <ul>
                     <li>Thumbnail (default image for your series of Profile photos - up to 7)</li>
                     <li>Banner Image (which appears across the top of the Profile)
                     </li>
                     <li>Video image (a frame selected from the video and which appears as an image with
                        a play tag)
                     </li>
                   </ul>
                  <p>If you have requested Escorts4U to verify your Media, we will attach an Escorts4U
                        Verified Icon to the image.  This is highly recommended as the verification adds credibility to your Profile.
                     </p>
                  <p><b>Q: Can I remove my photos?</b></p>
                  <p>You can delete Media from your Archive Folder by simply selecting the cross on the
                     image and it is deleted. You can organise your images into groups (folders within your
                     Archive Folder) to help you better manage your Media. You should always update
                     your Profiles with your new Media before deleting any existing Media as any Media
                     which is deleted will automatically be removed from a Profile which that image or video
                     was contained in.
                  </p>
                  <!-- <p><b>Q:</b>Can I remove my photos?</p>
                     <p>You can delete Media from your Archive Folder by simply selecting the cross on the
                     image and it is deleted. You can organise your images into groups (folders within your
                     Archive Folder) to help you better manage your Media. You should always update
                     your Profiles with your new Media before deleting any existing Media as any Media
                     which is deleted will automatically be removed from a Profile which that image or video
                     was contained in.</p>         --> 
                  <p><b>Q: Can I select a Thumbnail or Banner Image?</b></p>
                  <p>You can select your Thumbnail or Banner Image (the preview image that appears
                     across the top of your Profile) by logging on, selecting your preferred image and
                     dragging it to the Profile basket. You can have a different Thumbnail or Banner Image
                     for each Profile you create.
                  </p>
                  <p>The Thumbnail you select for any Profile will be the photo image which appears on the
                     Search Page where your Profile is listed.
                  </p>
                  <p><b>Q: Can I see how much traffic I am generating for my Profile?</b></p>
                  <p>You certainly can. From the moment you begin to advertise with us you will be able to
                     access your Dashboard and view all of your analytics from within your Dashboard. 
                     The Profile statistics are broken down into numerous information groups to assist you
                     when analysing your successes.
                  </p>
                  <p><b>Q; How does the Tour feature work?</b>
                  </p>
                  <p></p>
                  <p>As soon as you create your Tour from your selected Profiles, it will be posted
                     according to your start date. One day prior to your first Tour destination you will appear
                     on the Escort Home Page for that Location, according to the Membership Type you
                     have chosen when you created the Tour. That is, if you selected Platinum you will
                     appear in the top group on the Escort Home Page.
                  </p>
                  <p>This will enable you to have maximum exposure before your Tour commences, and
                     give you the chance to take pre bookings in advance. You can also send out a V-Alert
                     to those Viewers who have added you to their Legbox and enabled the V-Alert feature
                     to receive V-Alert notifications. Where you select this option in the Tour creator, a
                     V-Alert will be automatically forwarded to Viewers, who have enabled this feature, one day before each leg of the Tour. 
                     This is a free service.  The Viewer will receive the notification according to their settings, that is, by email or text.
                  </p>
                  <p></p>
                  <p><b>Q: Do I need to enter information into my Tour?</b></p>
                  <p>Your Tour will automatically use the same information and Media that is set up in each
                     of your selected Profiles you have created for your different Locations. Like for
                     example, your Sydney and Melbourne Profiles.
                  </p>
                  <p>
                     If you would like to display different information in your Tour, such as Rates, About Me
                     or Availability, you can login and edit your Tour at any time or you can edit the
                     information while you create the Tour.
                  </p>
                  <p>For Tours which include Victoria, in order for us to display your Profile in Victoria and Queensland,
                     images will need to comply with the Local Laws of these Locations. You cannot show your bare
                     breasts, buttocks, anus or full frontal nudity of the genital region. You will also need to
                     supply us with your SWA number, at your option, to comply with the Victorian legislation, if you have chosen to display your SWA number.</p>
                  <p>Escort advertising laws in Australia differ from state to state. Before you embark on a
                     Tour, it is your responsibility to become familiar with the Local Laws and ensure you
                     are compliant (see Local Laws above).
                  </p>
                  <p>
                     While on Tour, if you upgrade your Membership Type you will not lose any remaining
                     days you have paid for. They will be applied automatically if you do not continue at
                     the higher Membership Type.
                  </p>
                  <p><b>Q: What is an Agent and how can they help me?</b>
                  </p>
                  <p>An Agent is a person or entity that has been appointed by Escorts4U in a designated
                     Location, like for example the “Victorian Agent”. The role of the Agent is to assist
                     Advertisers in the management of their Account, Media, Profiles, Tours, Concierge
                     Services and Account information.
                  </p>
                  <p>You can appoint an Agent at any time by either:
                  </p>
                  <ul>
                     <li>Nominating the Agent as a part of the registration process; or by</li>
                     <li>Requesting an Agent to be appointed by lodging a request through your
                        Dashboard.
                     </li>
                  </ul>
                  <p>When you appoint an Agent, you enter into an arrangement with the Agent directly for
                     the Agent to provide the Agent Services. The Agent will have full access to your
                     Account.
                  </p>
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
                  <p class="pt-4"><b>Q: How frequent are the advertising payments?</b></p>
                  <p>Fees are paid in advance according to the advertising period you have selected for
                     your Profile or Tour. You will receive an email from us 24 hours before the expiry of
                     the Profile (advertisement). If you do not renew the Profile Subscription, your Profile
                     will be removed from the Website, but retained in your archived Profiles within the
                     Archive Folder which you can access from your Dashboard. You can renew a Profile
                     at any time.
                  </p>
                  <p>When setting up a Profile, you can elect to have an automatic renewal for a
                     determined period for the Profile, like for example, every 5 days at the Platinum level.
                  </p>
                  <p><b>Q: How will I know my next payment is due?</b></p>
                  <p>We will email you a notification 24 hours prior to the expiry of your Profile. Your
                     payment options will be listed in the email.
                  </p>
                  <p> You can also find out your due date at any time by logging in and clicking on the
                     Dashboard link that administers published Profiles and Tours.
                  </p>
                  <p><b>Q: What are my payment options?</b></p>
                  <p>We accept payments by Card only. Payment is processed online when you post or
                     renew your Profile or Tour. You are not required to provide your Card information
                     when you set up your Account or any Profiles. You can even set up Profiles to be
                     retained in your Archive Folder until you are ready to advertise.
                  </p>
                  <!-- <p>We accept payments by Card only. Payment is processed online when you post or
                     renew your Profile or Tour. You are not required to provide your Card information
                     when you set up your Account or any Profiles. You can even set up Profiles to be
                     retained in your Archive Folder until you are ready to advertise.
                     </p> -->
                  <p>There are effectively three payment options, all with your Card, namely:</p>
                  <ul>
                     <li>Pay as you go. If you post a Profile for 3 days, you can pay for 3 days.</li>
                     <li>Pay in advance. You can pay a lump sum into your Account and then draw down
                        on those funds as you post and renew your Profiles or Tours.
                     </li>
                     <li>Pay and renew. You pay for the number of days you have selected for your Profile,
                        and elect to automatically renew your Profile each nominated period thereafter (like
                        every 5 days) and for the nominated occurrences (like for 3 renewals).
                     </li>
                  </ul>
                  <p><b>Q: Can I pay weekly?</b></p>
                  <p>Yes you can. We calculate your Fees based on the number of days you select for
                     your Profile to be published. Some discounts do apply in certain circumstances (see
                     <a class="c-red" href="help-for-advertisers">Loyalty Program</a> )
                  </p>
                  <p><b>Q: Do I receive a discount if I make a pre payment for months in advance?</b>
                  </p>
                  <p>Yes you do. We offer generous discounts for pre-payments, long term advertising (22
                     days or more) and cumulative spending. You can see all of our discounts in the Fee
                     summary which you can access from your Dashboard.
                  </p>
                  <p><b>Q: Important note regarding payments</b></p>
                  <p>When raising a query with us, we can only trace and allocate a payment to your Profile
                     if it has the correct Payment Reference. It is very important that your payment query
                     has the correct Payment Reference, which is the confirmation reference number we
                     provide you in your email notification once your published Profile Fee has been made. 
                     It is like a receipt.
                  </p>
                  <p>When you view a published Profile in your Archive Folder, the Profile will have the
                     number reference attached to it for your convenience. A current published Profile is
                     retained in the ‘Current Publications’ sub-group and all historical 
                     publications are retained in your ‘Past Profiles’ sub-group.
                  </p>
                  <p>Any queries regarding payments that cannot be matched to Profiles will remain open
                     until you match the payment query to the Profile.
                  </p>
               </div>
            </div>
         </div>          
         <div class="set">
            <a>
            Signing Up with Us
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p class="pt-4"><b>Q: Do I have to sign a contract to advertise?</b></p>
                  <p>Save for the Policy statements including the <a class="c-red" href="{{ url('terms-conditions')}}">Terms and Conditions</A> of use, there are
                     no other contracts, no obligation to advertise and you can cancel your Membership at
                     any time
                  </p>
                  <p><b>Q: What is the best type of Membership for me?</b></p>
                  <p>We have a range of Membership options that are sure to fit in with your needs.
                  </p>
                  <p>Depending on the Viewer's display preference, the Search Page will present in either a
                     "List View" or "Grid View" format. Viewers can then select to view your Profile. You
                     will always rank within your Membership Type in all search results irrespective of which
                     format the Viewers choose to view the Escort Home Page. Each Membership Type
                     reshuffles every 2 hours enabling all Advertisers to appear first from time to time within
                     their respective Membership Type on the Escort Home Page
                  </p>
                  <p>A viewer can ‘flag’ your Profile and then view the list of Profiles from within the Escort
                     Home Page that they have selected. A registered Viewer can go one step further by
                     adding your Profile to their Legbox. That will entitle them to receive notifications from
                     you as well as having communication capability with you should you have those
                     features enabled.
                  </p>
                  <p>Each Membership Type enjoys certain benefits according to that Membership Type.
                     The following table summarises the distinctions between each Membership Type
                     according to the format:
                  </p>
                  <table class="table faq--table">
                     <thead>
                        <tr>
                           <th>Type</th>
                           <th>Description</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Platinum</td>
                           <td>
                              <p>Platinum Membership always ranks at the top of the Escort Home Page.</p>
                              <div class="tb-flex">
                                 <p><b>List View: </b></p>
                                 <p>Your Thumbnail photo is 142px x 200px. Rates, review rating,
                                    available to, verification and your 'Who I am' are displayed.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Grid View:  </b></p>
                                 <p>Your Thumbnail photo is 200px x 281px. Hourly rate, services,
                                    gender, orientation and view rating are included in the display.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Profile Page:  </b></p>
                                 <p>A comprehensive and informative summary about you. Your
                                    Thumbnail is 420px x 600px together with 6 additional photos
                                    and a video player 640px x 360px. All photos and the video
                                    can pop up.
                                 </p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>Gold</td>
                           <td>
                              <p>Gold Membership ranks behind Platinum and before Silver.</p>
                              <div class="tb-flex">
                                 <p><b>List View: </b></p>
                                 <p>Your Thumbnail photo is 112px x 157px. Rates, review rating,
                                    available to, verification and your 'Who I am' are displayed.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Grid View:  </b></p>
                                 <p>Your Thumbnail photo is 163px x 229px. Hourly rate, services,
                                    gender, orientation and view rating are included in the display.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Profile Page:  </b></p>
                                 <p>A comprehensive and informative summary about you. Your
                                    Thumbnail is 420px x 600px together with 6 additional photos
                                    and a video player 640px x 360px. All photos and the video
                                    can pop up.
                                 </p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>Silver</td>
                           <td>
                              <p>Silver Membership ranks behind Gold and before Free.</p>
                              <div class="tb-flex">
                                 <p><b>List View: </b></p>
                                 <p>Your Thumbnail photo is 102px x 144px. Review rating,
                                    available to, verification and your 'Who I am' are displayed.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Grid View:  </b></p>
                                 <p>Your Thumbnail photo is 136px x 191px. Hourly rate, services,
                                    gender, orientation and view rating are included in the display.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Profile Page:  </b></p>
                                 <p>A comprehensive and informative summary about you. Your
                                    Thumbnail is 420px x 600px together with 6 additional photos
                                    and a video player 640px x 360px. All photos and the video can
                                    pop up
                                 </p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>Free</td>
                           <td>
                              <p>Free Membership ranks behind Silver.</p>
                              <p>Escort Home Page: You will appear after paid listings in all Search Page
                                 results and Profile shortlist displays.
                              </p>
                              <div class="tb-flex">
                                 <p><b>List View: </b></p>
                                 <p>Your Thumbnail is displayed as a silhouette 79px x 116px.
                                    Available to and your 'Who I am' are displayed.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Grid View:  </b></p>
                                 <p>Your Thumbnail is displayed as a silhouette 100px x 145px.
                                    Hourly rate and services are included in the display.
                                 </p>
                              </div>
                              <div class="tb-flex">
                                 <p><b>Profile Page:  </b></p>
                                 <p>A comprehensive and informative summary about you. Your
                                    thumbnail photo is 420px x 600px together with 6 additional
                                    photos 100px x 100px. No video is available. All photos can
                                    pop up.
                                 </p>
                              </div>
                              <p>If you receive over a certain number of Profile views or telephone number
                                 clicks during the free 14 day period you will be informed and notified to
                                 upgrade to a paying Membership Type. 
                              </p>
                              <p>We do this to provide for the fairest distribution of leads between our Free
                                 Members. If you do not elect to become a paying Member, your Profile will be
                                 suspended. You will still be able to log onto your Account at any time to
                                 upgrade your Membership Type.
                              </p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <p><b>Q: What do I have to do to create a Profile?</b></p>
                  <p>There are two steps to creating your Profile. First you set up your Account, including
                     your Additional Information, which is referred to as My Account, and then from within
                     your Dashboard you create Profiles to advertise. You can create many profiles, for
                     example, a Profile for each city you visit or two Profiles within a Location. Like
                     ‘Perth01’ and ‘Perth02’. The difference may only be your Profile Name and the
                     published Media.
                  </p>
                  <p>Although there may only be subtle differences between Profiles, you have the
                     convenience of activating the right Profile already configured for the city you are
                     visiting without having to edit the one Profile every time you travel to another Location. 
                     You have a 'Default Profile' in your Archives Folder which you use to create new
                     Profiles for Locations, or even more then one Profile for a Location.
                  </p>
                  <p>You can create a Profile at any time after registering on the <a class="c-red" href="{{ url('advertiser-register')}}">registration page</a>. It is a
                     very quick and easy process to follow. You can create a Profile in less than 5 minutes. 
                     You can also request our assistance or better still, request the services of an Agent 
                     who can help you create your Profile/s and manage your Account generally, along with
                     many other services.
                  </p>
                  <p><b>Q: How many images and video can I have in my Profile?</b></p>
                  <p>You can have a maximum of seven photo images, including the Thumbnail,
                     irrespective of your Membership Type with your Thumbnail acting as the default image
                     displayed on the Escort Home Page (except for Free Membership). Platinum and
                     Gold Members can also upload a maximum of three videos as well as their photos
                     being displayed in a larger format than other Membership Types on the Escort Home
                     Page in both List View and Grid View.
                  </p>
                  <p>Your can retain many photos and video in your Archive Folder, but you are limited to
                     the number of photos and video permitted in a Profile.
                  </p>
                  <p><b>Q: How long does it take for my advertisement to go online?</b></p>
                  <p>When you create a Profile and pay the Fee, the Profile is published immediately. If
                     you have included Verified Photos in the Profile, our support team, whilst they will
                     have a report advising us you have posted the Profile, will not necessarily review the
                     Profile.
                  </p>
                  <p>If the Profile you have posted does not contain Verified Photos, then our support team
                     will review the Profile to check the Media is compliant with the Classification Laws. 
                     The review of your Profile will be completed within 24 hours. If the Profile is deemed
                     to be non-compliant, then the Profile will be suspended and you will be notified by
                     email. You will have the option to edit the Profile which will then be immediately
                     posted and the support team will again review the Profile, if any of the Media is not
                     verified.
                  </p>
                  <p>All Media which is verified will be displayed with an E4U Verification Icon (see <a class="c-red" href="{{ url('abbreviations')}}">Website
                          Icons</a>).
                  </p>
                  <p>During the review of your Profile, if the Profile is suspended for more than one day,
                     and the Fee paid includes the supended period, then the Fee will be credited back to
                     you.
                  </p>
                  <p><b>Q:How can I maximise my presence?</b></p>
                  <p>Most Escorts usually advertise on a number of websites. When advertising on another
                     website, include your website address to Escorts4U. For example,
                     www.escorts4u.com.au/123456 (your Profile ID Number). Over time your clients,
                     when you re-direct them to this Website, will conclude this is the better website to find
                     you.
                  </p>
                  <p><b>Q:Do I need to have professional photography?</b></p>
                  <p>We recommend that your Media is professional in quality. But it is entirely up to you.
                     Self images are fine but you should always bear in mind that the more professional the
                     photos, the better your chances of attracting clients. Overall though, your photos do
                     not need to be taken by a professional photographer, but must have a good quality
                     finish. Remembering, the higher quality images you provide, the more striking
                     presentation we can make for you.
                  </p>
                  <p>It is important that images have a certain mood, atmosphere and sensuality. This is
                     essential in order to capture the attention of your potential clients, and leave them
                     wanting to see more. Try not to have obscure or misleading photos. Any Media
                     where the face is not present or obscure may be rejected.
                  </p>
                  <p><b>Q:Can you recommend any professional photographers?</b></p>
                  <p>We do not provide any recommendations for professional photographers. You will
                     need to speak to your colleagues or use good old "Google".
                  </p>
                  <p><b>Q:Can I advertise with you if I am working for an Massage Centre?</b></p>
                  <p>Absolutely. You can have your own Account and post Profiles whenever you want as
                     well as being included in the Massage Profile should the Massage Centre also
                     register. Just remember, by registering and creating your own Account, you are
                     considered to be an Escort for the purposes of posting a Profile.
                  </p>
                  <p><b>Q:How do I cancel my Membership?</b></p>
                  <p>Just send us a Support Ticket requesting we cancel your Membership and we will
                     attend to your request. Always retain your Membership Number. If you decide to join
                     again, your Membership Number will assist you with re-registration.
                  </p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Technical
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p class="pt-4"><b>Q: I cannot login to My Account, what should I do?</b></p>
                  <p>Check that you typed in the right email or password and that you have also entered in
                     the correct SMS 2FA code that was texted to you. If you have lost your password, use
                     the “Forgot Your Password” link. Please be mindful that we do use SMS 2FA
                     verification when logging onto the Website. If you still have problems, please email us
                     at <a href="mailto:support@escorts4u.com.au">support@escorts4u.com.au</a> and include your <u>Membership Number</u> in the body of
                     the email.
                  </p>
                  <p><b>Q: I cannot upload and/or save my images, why?</b></p>
                  <p>Check the allowed image types below and then try again:</p>
                  <ul>
                     <li>photos must be .jpg or .png format</li>
                     <li>photos must be portrait orientation</li>
                     <li>the minimum height and width of the photos must be 500px</li>
                     <li>the proper ratio is 2/3 (width/height)</li>
                     <li>if your ratio is smaller then we will crop from the bottom</li>
                     <li>if your ratio is larger then we will crop from the sides</li>
                     <li>maximum allowed dimension is 4000x6000px</li>
                  </ul>
                  <p>If you still have problems, please email us or preferably, log on and create a Support Ticket.</p>
                  <p><b>Q: I have other questions, where can I send my messages?</b>
                  </p>
                  If you have any other technical or administrative questions, please email us or
                  preferably, log on and create a Support Ticket.
                  <p><b>Q: Why does the Website have a Home State and Location?</b>
                  </p>
                  <p>By designating the Advertiser with a Home State, the Website will function more
                     accurately when posting Profiles and Tours. For example, in Victoria you have the option to be registered under the Sex Work Act 1994 and display your SWA registration
                     number. When completing your Profile Information in the Dashboard, the Website will
                     know to make the SWA number optional for you to include.</p>
                  <p>
                      Whereas, when you are on Tour, the Location is simply the State you are visiting.</p>
                  <p>
                     Geolocation technology is deployed in the Website. When you register, the Website
                     will automatically know your Location and will then deem it your Home State, unless
                     you change it. Once you complete your registration, the Home State can not be
                     changed.
                  </p>
                  <p><b>Q:What exactly is SMS 2FA authentication?</b></p>
                  <p>Two-factor authentication (2FA) is an additional layer of end-user Account protection
                     beyond a password. It significantly decreases the risk of Account takeovers where a
                     hacker accesses banking, shopping, social media or other online accounts by
                     combining the password (something you know) with a second factor, like a one-time
                     passcode or push notification sent to your mobile phone (something you have).
                  </p>
                  <p><b>Q: Is SMS 2FA the same thing as two-step verification?</b></p>
                  <p>Yes. Websites refer to this security feature in several different ways: two-factor
                     authentication (or 2FA), two-step verification (or 2-Step), multi-factor authentication
                     and two-step authentication.
                  </p>
                  <p><b>Q: How does SMS 2FA work?</b></p>
                  <p>This form of authentication is actually quite simple. After signing in, the User receives
                     a text message with an SMS authentication code. All they need to do is enter that
                     code into the field provided on the Website pop up to gain access. You have probably already
                     experienced this process yourself when logging into websites like Amazon, Facebook,
                     Google, Twitter, and other services like banking.
                  </p>
                  <p>As a possession-based factor, SMS 2FA verifies a User’s identity based on something
                     they own, like their mobile phone. This adds an extra layer of security to a login. In
                     theory, bad actors would have to steal a User’s password and their mobile phone in
                     order to gain unauthorised access to your Account.
                  </p>
                  <p><b>Q: What if I lose my mobile phone?</b></p>
                  <p>If your mobile phone is lost or stolen you should immediately contact your mobile
                     phone provider to lock access to the device. Additionally, to prevent unwanted access
                     to your personal phone data and apps in the case where it is lost or stolen, it is always
                     a best practice to utilise the lock feature in your phone's settings. You should set your
                     mobile phone to lock and require a password for use of the device when you are not
                     actively using it. 
                  </p>
                  <p>As a general guide on passwords, use different passwords across your accounts; use
                     a combination of special characters, numbers and both upper and lowercase letters;
                     avoid using passwords that include information that can be easily discovered online
                     like maiden names, high school mascots and phone numbers; do not create
                     passwords that are so complicated that they need to be written down or that require a
                     password reset on every login.
                  </p>
                  <p><b>Q: Do I have to use SMS 2FA verification to gain access to the Website and services?</b></p>
                  <p>Yes.  But only to your Dashboard once you have registered.</p>
                  <p><b>Does the Website work on any device/</b></p>
                  <p>Yes, absolutely.</p>
                  <!-- changes to policy -->
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