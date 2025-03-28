@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .select2-container .select2-choice, .select2-result-label {
   font-size: 1.5em;
   height: 52px !important; 
   overflow: auto;
   }
   .select2-arrow, .select2-chosen {
   padding-top: 6px;
   }
   span.select2.select2-container.select2-container--default > span.selection > span {
   height: 52px !important; 
   }
   .list-sec .table td, .table th{
   border: 1px solid #0c233d;
   }
</style>
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5">
            <!--middle content-->
            <div class="row">
               <div class="col-md-9">
                  <!-- Begin Page Content -->
                  <div class="container-fluid" style="padding: 0px 0px;">
                     <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="v-main-heading h3">Help for Advertisers</div>
                     </div>
                  </div>
                  <!-- /.container-fluid --><br>
                  <div class="row">
                     <div class="col-md-12">
                        <div id="accordion" class="myacording-design">
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                 Membership
                                 </a>
                              </div>
                              <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: Is Membership free?</b></p>
                                    <p><b><span class="theme-text-color">Yes, your first two weeks with us are free!</span></b></p>
                                    <p>Create and refine your Profile over the first two weeks and then decide if you want to continue using us. There are no restrictions placed on how your Profile is published except that you will not feature at the top of the Escort Home Page under this Membership type. All of our paying Advertisers are prioritised to the front of the Escort Home Page. You can elect to become a paying Advertiser at any time.</p>
                                    <p>Viewers will have full access to your Profile including unrestricted communication rights should you have texting and email enabled.
                                    </p>
                                    <p class="mt-2"><b>Q: Are there any great features available to me?
                                       </b>
                                    </p>
                                    <p>Yes. We have a number of great features to enhance your Profile and relationship with Viewers. You can:</p>
                                    <ul>
                                       <li>Send "A-Alert" to registered Viewers, who have flagged you, when you are visiting their location</li>
                                       <li>Chat with followers within a secure environment</li>
                                       <li>Exchange pictures within the chat facility</li>
                                       <li>Archive Profiles, ready to activate at any time or to create a Tour</li>
                                    </ul>
                                    <p class="mt-2"><b>Q: Are there any loyalty programs?</b></p>
                                    <p>Yes. Escorts4U will reward you for your loyalty. A simple program, for every $200.00 in advertising you spend with us, we will reward you with 1 day of free advertising (Platinum and Gold level). You can use your rewards any time you like, or accumulate your rewards and use them all at at once, it is entirely up to you.</p>
                                    <p class="mt-2"><b>Q: Can I get help to manage my Account</b></p>
                                    <p>Yes you can. Our team will help you manage your Account or alternatively, you can reach out to an Escort Agent. An Escort Agent will assist you with:</p>
                                    <ul>
                                       <li>Managing your Account details and Profile Information</li>
                                       <li>Managing your Images and video</li>
                                       <li>Creating your Profiles and Tours;</li>
                                       <li>Any of the Concierge services; and</li>
                                       <li>Generally, be there for you</li>
                                    </ul>
                                    <p>You can request help from an Escort Agent from your Dashboard.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                 Membership packages
                                 </a>
                              </div>
                              <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: What are the packages?</b></p>
                                    <p>Packages are designed around the Membership type you choose on the day you post your Profile. You can change a Profile package during the advertised period.</p>
                                    <table style="width:100%;font-size: 1rem;font-weight: normal;line-height: 30px;">
                                       <tbody>
                                          <tr>
                                             <th style="width:20%">Features<sup>(1)</sup></th>
                                             <th style="width:10%">Platinum</th>
                                             <th style="width:10%">Gold</th>
                                             <th style="width:10%">Silver</th>
                                             <th style="width:10%">Free</th>
                                             <th style="width:40%">Comments</th>
                                          </tr>
                                          <tr>
                                             <td align="left">Carousel Position</td>
                                             <td>Top of page</td>
                                             <td>After Platinum</td>
                                             <td>After Gold</td>
                                             <td>Bottom of page</td>
                                             <td>Profiles within each Membership type randomly rotate every 4 hours</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Priority Search</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Search results according to your Membership type</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Short list me</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>✗</td>
                                             <td>Search results according to the short list</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Home page - Pin Up</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Display your Thumbnail on the home page</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Thumbnail - List View</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Larger thumbnail for Platinum reducing down to Silver</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Thumbnail - Grid View</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Larger thumbnail for Platinum reducing down to Silver</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Thumbnail - Profile View</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>Same size for all Membersip Types, including 6 smaller photos</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Video (640px x 360px)</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>✗</td>
                                             <td>Limited to 30 seconds play</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Touring Schedule</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>Set your arrival and departure times</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Availability Summary</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Let your clients know when you are available for companionship</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Service Listing</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>A complete itemised display of the Services on offer</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Profile Summary</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>A structured summary of you, like "Age" and "Nationality"</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Rate Summary</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>Summarise your rates according to the time spent with your client</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Photo Verification</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Have your photos display our verified certificate</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Social Media Summary</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>✗</td>
                                             <td>List all of your social media profiles and websites</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Alert Notifications</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>✗</td>
                                             <td>Forward your followers A-Alert notifications ahead of your arrival</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Support Tickets</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>Private footprinted communication with our support team</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Chat Service</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Have private chatts with your followers, exchange images</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Home Location</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>You set your home State</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Access to your Reviews</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>You can view any review posted about you</td>
                                          </tr>
                                          <tr>
                                             <td align="left">National Ugly Mugs (NUM) List</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>✗</td>
                                             <td>Report difficult incidents about clients</td>
                                          </tr>
                                          <tr>
                                             <td align="left">NUM Alerts<sup>(2)</sup></td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>Recieve an Alert by text or email of a dangerous individual</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Archive your Profiles</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>You can archive all of your Profiles, activating whenever you need to</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Transfer Credits</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>You can transfer any credits you have when you uprate your Profile</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Analytics</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>You can view all your statistics in your Dashboard</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Daily Rate<sup>(3)</sup></td>
                                             <td>$8.00</td>
                                             <td>$6.00</td>
                                             <td>$4.00</td>
                                             <td>14 days</td>
                                             <td>You choose the number of days you want to advertise your Profile</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Bulk Discounts<sup>(3)</sup></td>
                                             <td>$7.50</td>
                                             <td>$5.70</td>
                                             <td>$3.80</td>
                                             <td>None</td>
                                             <td>Discounts apply to advertisements for 22 days or more</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Home Page <i>Pin Up</i></td>
                                             <td>$475.00</td>
                                             <td>$475.00</td>
                                             <td>$475.00</td>
                                             <td>✗</td>
                                             <td>A fixed weekly fee to be exclusively featured on the home page.</td>
                                          </tr>
                                          <tr>
                                             <td align="left">Loyalty Program</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✓</td>
                                             <td>✗</td>
                                             <td>Spend $200.00 in advertising, get 1 day free</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <p class="mt-4"><sup>1</sup> Feature availability is subject to the <a href="faqs.php">Local Laws</a></p>
                                    <p><sup>2</sup> Monthly fee of $5.00 (to cover SMS costs)</p>
                                    <p><sup>3</sup> Payment by credit card</p>
                                    <h5 class="mt-4">Some other great services</h5>
                                    <table style="width:100%;font-size: 1rem;font-weight: normal;line-height: 30px;margin-top: 0.8rem;">
                                       <tbody>
                                          <tr>
                                             <th align="left">Service</th>
                                             <th align="left">Description</th>
                                          </tr>
                                          <tr>
                                             <td>Bookkeeping:</td>
                                             <td>Keep a simple ledger of all of your earnings and expences</td>
                                          </tr>
                                          <tr>
                                             <td>Products:</td>
                                             <td>Order products which are delivered to your door or posted to you</td>
                                          </tr>
                                          <tr>
                                             <td>Telecomunications</td>
                                             <td>Order a SIM for your mobile phone and an email acount to meet Australian standards</td>
                                          </tr>
                                          <tr>
                                             <td>Travel &amp; Accommodation:</td>
                                             <td>Complete all of your travel and accommodation bookings online with us</td>
                                          </tr>
                                          <tr>
                                             <td>Visa &amp; Migration services:</td>
                                             <td>Get professional advice about all of your Visa and Migration requirements</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#other_fees_concierge_services" aria-expanded="false">
                                 Membership types
                                 </a>
                              </div>
                              <div id="other_fees_concierge_services" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: Who can register for Membership?</b></p>
                                    <p>There are several types of Membership available:</p>
                                    <ul>
                                       <li>Independent Escorts (or Advertisers as we refer to them as)</li>
                                       <li>Massage Centres; and</li>
                                       <li>Escort Agent, management agent for Escorts</li>
                                    </ul>
                                    <p class="mt-2"><b>Q: What is the effect on me according to the Membership type I select?</b></p>
                                    <p>We have a range of Membership options that are sure to fit in with your requirements.</p>
                                    <p>Depending on the Viewer's display preference, the search results will present in either a "List" or "Grid" format. Viewers can then select, and flag, from either List or Grid format to view a summary of your Profile. You will always rank within your Membership type in all search results irrespective of which format the Viewers choose to view the Escort Home Page. Each Membership type reshuffles every 4 hours enabling all Advertisers to appear first from time to time within their respective Membership type.</p>
                                    <p>Each Membership type enjoys certain benefits according to the type. The following table summarises the distinctions between each Membership type according to the format:</p>
                                    <table style="width:100%;font-size: 1rem;font-weight: normal;line-height: 30px;">
                                       <tbody>
                                          <tr>
                                             <th>Type</th>
                                             <th>Description</th>
                                          </tr>
                                          <tr>
                                             <td valign="top">Platinum:</td>
                                             <td>
                                                <p>Platinum Membership always ranks at the top of the Escort Home Page.</p>
                                                <i>List View:</i> Your default thumb display photo is 142px x 200px. Rates, review rating, available to, verification and your 'Who I am' are displayed.<br>
                                                <i>Grid View:</i> Your default thumb display photo is 200px x 281px. Hourly rate, services, gender, orientation and view rating are included in the display.<br>
                                                <i>Profile Page:</i> A comprehensive and informative summary about you. Your thumbnail photo is 420px x 600px together with 6 smaller photos 100px x 100px and a video player 640px x 360px. All photos and the video can pop up.
                                             </td>
                                          </tr>
                                          <tr>
                                             <td valign="top">Gold:</td>
                                             <td>
                                                <p>Gold Membership ranks behind Platinum and before Silver.</p>
                                                <i>List View:</i> Your default thumb display photo is 112px x 157px. Rates, review rating, available to, verification and your 'Who I am' are displayed.<br>
                                                <i>Grid View:</i> Your default thumb display photo is 163px x 229px. Hourly rate, services, gender, orientation and view rating are included in the display.<br>
                                                <i>Profile Page:</i> A comprehensive and informative summary about you. Your thumbnail photo is 420px x 600px together with 6 smaller photos 100px x 100px and a video player 640px x 360px. All photos and the video can pop up.
                                             </td>
                                          </tr>
                                          <tr>
                                             <td valign="top">Silver:</td>
                                             <td>
                                                <p>Silver Membership ranks behind Gold and before Free.</p>
                                                <i>List View:</i> Your default thumb display photo is 102px x 144px. Review rating, available to, verification and your 'Who I am' are displayed.<br>
                                                <i>Grid View:</i> Your default thumb display photo is 136px x 191px. Hourly rate, services, gender, orientation and view rating are included in the display.<br>
                                                <i>Profile Page:</i> A comprehensive and informative summary about you. Your thumbnail photo is 420px x 600px together with 6 smaller photos 100px x 100px and a video player 640px x 360px. All photos and the video can pop up.
                                             </td>
                                          </tr>
                                          <tr>
                                             <td valign="top">Free:</td>
                                             <td>
                                                <p>Free Membership ranks behind Silver.</p>
                                                <i>Escort Home Page:</i> You will appear after paid listings in all search results and Profile display pages.<br>
                                                <i>List View:</i> Your default thumbnail is displayed as a silhouette 79px x 116px. Available to and your 'Who I am' are displayed.<br>
                                                <i>Grid View:</i> Your default thumbnail is displayed as a silhouette 100px x 145px. Hourly rate and services are included in the display.<br>
                                                <i>Profile Page:</i> A comprehensive and informative summary about you. Your thumbnail photo is 420px x 600px together with 6 smaller photos 100px x 100px. All photos can pop up.<br><br>
                                                <p>If you receive over a certain number of profile views or telephone number clicks during the free 14 day period you will be informed and notified to upgrade to a paying Membership type. We do this to provide for the fairest distribution of leads between our free members. If you do not elect to become a paying member, your profile will be suspended. You will still be able to log onto your Account at any time to upgrade your Membership type.</p>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <p>If you upgrade you will not lose any remaining days you have paid for. They will be applied automatically if you do not continue at the higher Membership type.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram" aria-expanded="false">
                                 Payments
                                 </a>
                              </div>
                              <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>  Q: How do I pay for advertising? </b></p>
                                    <p>Payment, by credit card, is requested when you post a Profile. If you renew the Profile, your credit card will be debited automatically.</p>
                                    <p class="mt-2"><b>Q: Does Escorts4U retain my credit card details?</b></p>
                                    <p>Yes, we do. Our third party payments provider retains your details. Escorts4U does not directly retain your credit card details.</p>
                                    <p class="mt-2"><b>Q: Can I transfer credits I have earnt from my Loyalty program?</b></p>
                                    <p>Yes, whenyou create a Profile, any credits you have will be displayed and you will have the option to utilise them.</p>
                                    <p class="mt-2"><b>Q: What is the easiest way to pay?</b></p>
                                    <p>You can pay for your advertising by 2 methods, namely:</p>
                                    <ul>
                                       <li>Pay as you go. Simply create your Profile/s, select the number of days for advertising and payment is calculated accordingly; or</li>
                                       <li>Pay a sum as a credit towards future advertising. When you upload a Profile and set the number of days your charges are automaticly calculated and deducted from your credit total.</li>
                                    </ul>
                                    <p>All transactions are confirmed by email notifcation to you. You can also view all of your purchase history from your Dashboard.</p>
                                    <p class="mt-2"><b>Q: How do you set prices?</b></p>
                                    <p>Our main objective is to provide value-for-money in an effective way. Our pricing is defined on a daily per city basis with discounts for booking longer periods. We only raise prices (and not often) when the number of enquiries and Advertisers goes over a certain level. This is to maintain the number of Platinum and Gold listings at a level where each paid listing will continue to receive the number of enquiries they expect from us.</p>
                                    <p>We introduced variable pricing after talking to many Advertisers who were asking how they could get more exposure and indicated they were willing to pay more if they could stand out.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Profile" aria-expanded="false">
                                 Profile
                                 </a>
                              </div>
                              <div id="Profile" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>  Q: How do I make a great Profile?
                                       </b>
                                    </p>
                                    <p>If you provide a complete Profile with accurate information, you will increase the number and quality of results you get from it. We have a very comprehensive Profile creator which will help you create a great Profile for yourself. Much of the creator is simply tick the box or select from a drop down menu. Here are some good tips for you:</p>
                                    <ul>
                                       <li>Put real photos up, preferably more than one. You can upload up to 6 photos. Make sure you have had them verified</li>
                                       <li>Take time to provide a good description of yourself and the services you offer. You can set your services in your Account settings</li>
                                       <li>List only the services you provide. The Profile creator has a comprehension selection of services where you can easily select from your drop down list</li>
                                       <li>Make sure your phone number and email address is correct</li>
                                       <li>If you have a video to upload, make sure it is not too long and that the recording is of good quality</li>
                                       <li>Include your website link, if you have one, and social media links</li>
                                    </ul>
                                    <p>Please do not:</p>
                                    <ul>
                                       <li>Post fake listings or fake photos, they will be deleted</li>
                                       <li>Use ALL CAPS, it looks CHEAP. Clients do not like you yelling at them</li>
                                       <li>Use foul or unacceptable language</li>
                                       <li>Attempt to deceive Viewers. You will get caught out and that may have an effect on your reputation if a review is posted</li>
                                    </ul>
                                    <p class="mt-2"><b> Q: Can one individual have more than one profile?</b></p>
                                    <p>Yes. If you create duplicate Profiles make sure you use different images and post a different summary about yourself. Our Profile creator is very detailed, you will be very satisfied with how we present your profile.</p>
                                    <p>You can archive your Profiles so that you do not have to edit or recreate the one Profile across a number of destinations, including more than one in the same location. Just switch on and switch off the Profile for the location you are in. It is really easy to manage your Profiles and advertising.</p>
                                    <p class="mt-2"><b>  Q: Can I make profiles for different individuals?</b></p>
                                    <p>Yes, as long as you have their permission for you to list them and they are real people. If you are an Escort Agency, you can create as many profiles as you like as well as archiving profiles to be reactivated when you need them again.</p>
                                    <p class="mt-2"><b>Q: How are profiles ordered?</b></p>
                                    <p>Profiles within different Membership types (Platinum, Gold, Silver and Free) are randomised every 4 hours and customised to each individual Advertiser according to their Profile Information. The search engine in the Website is very powerful and enables Viewers to search Advertisers by:</p>
                                    <ul>
                                       <li>State</li>
                                       <li>Gender</li>
                                       <li>Age</li>
                                       <li>Price</li>
                                       <li>Service type, such as Massage, Incall or Outcall; and</li>
                                       <li>Verified photos and video</li>
                                    </ul>
                                    <p>The search engine also has an advanced feature whereby Viewers can also search by Service Tags for:</p>
                                    <ul>
                                       <li>Fun stuff on the Viewer</li>
                                       <li>Kinky stuff on the Viewer</li>
                                       <li>Fun stuff on the Advertiser</li>
                                    </ul>
                                    <p>By completing your Profile creator answering all the questions, you enhance your chances of being found under the search engine. We do this to provide the best possible experience for Advertisers and Viewers ensuring that all Advertisers in a single Membership type receive a similar amount of exposure to Viewers.</p>
                                    <p class="mt-2"><b>Q: Fake photos are not OK</b></p>
                                    <p>If you post fake photos, your Account will be blocked. If we determine that you have other accounts, they will also be blocked regardless of wether they are genuine or not. There are no excuses and we will not enter into any discussion with you. Posting fake photos is fraud and a breach of intellectual property rights of the owner of the photo. If you have paid for Profiles and you are blocked the credits are not refundable.</p>
                                    <p class="mt-2"><b>Q: Why are my photos marked as fake?</b></p>
                                    <p>This is the most common complaint from other Advertisers about Profiles. In addition, fake photos are not fair for other Advertisers. Your photos may be marked as fake because of a report from an Advertiser or Viewer. You will receive a warning email when this happens and then you have 48 hours to have your photos verified before your Profile is blocked.</p>
                                    <p class="mt-2"><b>Q: What is not OK?</b></p>
                                    <p>If you are an Advertiser and do not follow the rules, your Account, including any current account associated with you and any future accounts, will be blocked.</p>
                                    <p>It is not ok for:</p>
                                    <ul>
                                       <li>Underage photos or photos of children to appear in any profile</li>
                                       <li>Trafficking, enslavement or anything similar to be promoted</li>
                                       <li>Abuse, violence or oppressive behaviour to be directed towards other Advertisers or Viewers</li>
                                       <li>Online trolling or other defamation to be directed towards other Advertisers or Viewers</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Profile-images" aria-expanded="false">
                                 Profile images and video
                                 </a>
                              </div>
                              <div id="Profile-images" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b> Q: Can I use fake images if they look very similar to me?</b></p>
                                    <p>Absolutely not. We have a strict policy that all images must belong to the Escort, and be of themselves. This is mandatory and there is no negotiation on this policy.</p>
                                    <p class="mt-2"><b>Q: Is it a requirement to have my photos verified?</b></p>
                                    <p>Image verification is not a requirement, it is optional. However, we highly recommend you have your images verified by us so that you can better establish client trust. Verifying images also enables your Profile to be posted immediately.</p>
                                    <p class="mt-2"><b>Q: How do I get my photos verified?</b></p>
                                    <p>We have our own image verification process. Please email us for more information.</p>
                                    <p>If you pass our image verification criteria, we will mark your profile with the prestigious Photos Verified seal.</p>
                                    <p class="mt-2"><b>Q: Will any of my images be blurred?</b></p>
                                    <p>We offer a blurring service free of charge to Platinum Advertisers. It is not available for any of the other packages.</p>
                                    <p>The service is free of charge to each Advertiser under the Platinum package to a maximum of six per month. All images for blurring must be submitted at the same time.</p>
                                    <p class="mt-2"><b>Q: What are the photograph image requirements to advertise?</b></p>
                                    <p>We have a strict policy on what images you can publish. Your images must:</p>
                                    <ul>
                                       <li>be good quality and high resolution</li>
                                       <li>be your own (of yourself). Other people in the image is acceptable provided you have their consent</li>
                                       <li>have no large or distracting watermarks (we will watermark your photos for you)</li>
                                       <li>have no photographer's watermarks (they will be removed, or we will request new images without the watermark)</li>
                                       <li>be professional in quality. They do not need to be taken by a professional photographer, but must have a good quality finish</li>
                                    </ul>
                                    <p>We will not publish any images which:</p>
                                    <ul>
                                       <li>are low quality (too small, dark, grainy or blurry)</li>
                                       <li>that we find on non escort websites, or any photo where we have doubt about the ownership of the image</li>
                                       <li>overly explicit</li>
                                       <li>have borders or frames that have been added with a photo program (please upload your original images without borders)</li>
                                       <li>have watermarks that have been placed by the photographer to advertise their business</li>
                                       <li>have your contact details on them, such as email, telephone or website address. This information is set out in your Profile</li>
                                       <li>contain magazine covers, publications or video/DVD covers</li>
                                    </ul>
                                    <p class="mt-2"><b>Q: What are the video requirements for inclusion in my advertisement?</b></p>
                                    <p>We have a strict policy on the content of your video you can publish. Your video must:</p>
                                    <ul>
                                       <li>be no longer than 30 seconds</li>
                                       <li>be in either mp4 or wav format, or you provide a link to your video, such as Vimeo</li>
                                       <li>not contain any sexually explicit content or language, for example, intercourse</li>
                                       <li>not contain any of your contact details, such as email, telephone or website address. This information is set out in your Profile</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Profile-reporting" aria-expanded="false">
                                 Profile reporting
                                 </a>
                              </div>
                              <div id="Profile-reporting" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: Can I see how much business you are generating for me?</b></p>
                                    <p>Yes you certainly can. Logon to your Account and in the Dashboard area you can see statistics, graphs and results which detail:</p>
                                    <ul>
                                       <li>Clicks on your profile</li>
                                       <li>Clicks on your phone number</li>
                                       <li>Clicks on each of your photos</li>
                                       <li>Views of your video</li>
                                       <li>The number of messages sent to you</li>
                                       <li>Clicks through to your website (if you have provided a link)</li>
                                       <li>Clicks to your social media page/s (if you have provided a link)</li>
                                       <li>And many other helpful analytics</li>
                                    </ul>
                                    <p>If you use Google Analytics you can also find the number of website visitors by looking in Acquisition > Campaigns > All Campaigns. We know you will not always know about all the customers we send, but we have tried our best to give you an idea.</p>
                                    <p>If you have questions about measurement, get in touch, as we greatly appreciate hearing about your results and any suggestions about how we can improve the information we present to you.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Telecommunications-services" aria-expanded="false">
                                 Telecommunications services
                                 </a>
                              </div>
                              <div id="Telecommunications-services" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: What are these services?</b></p>
                                    <p>Escorts4U offers for your convenience:</p>
                                    <ul>
                                       <li>Mobile SIM service for your mobile phone while in Australia. Unlimited voice and text for a fixed monthly fee</li>
                                       <li>Managed Email account. Use your email account to register for all of your purchasers while in Australia</li>
                                    </ul>
                                    <p class="mt-2"><b>Q: How do i pay for these services?</b></p>
                                    <p>Payment, by credit card, is requested when you request any of these services. You tell us how long you are here for and payment is charged according to the stay. You can extend any time, your credit card will be debited automatically.</p>
                                    <p class="mt-2"><b>Q: How do I get my Mobile SIM?</b></p>
                                    <p>Register with Escorts4U, then logon and from your Dashboard order your Mobile SIM. We will post the SIM to you.</p>
                                    <p class="mt-2"><b>Q: How do I access my email account?</b></p>
                                    <p>You can acess your email account via your phone email app (Microsoft Outlook) or a web browser. It's very easy, simply follow the install instructions and you will be up and running within minutes.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Travel-accommodation" aria-expanded="false">
                                 Travel & accommodation
                                 </a>
                              </div>
                              <div id="Travel-accommodation" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: Who is the engine behind this service?</b></p>
                                    <p>Escorts4U has partnered with a leading provider of travel, accommodation and related services online bookings as a convenient one stop stop. It is no different to booking your accommodation and flights directly through those providers.</p>
                                    <p class="mt-2"><b>Q: Will I recieve the same amount of information?</b></p>
                                    <p>Yes you will. All of the information you would receive by booking direct, you will also revieve through our Website. There is no difference.</p>
                                    <p class="mt-2"><b>Q: Will I get the same discounts on offers as if I went direct?</b></p>
                                    <p>Yes you will. Any promotions and discounts on offer directly will be available through this Website as well.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Ugly-Mugs-Registern" aria-expanded="false">
                                 Ugly Mugs Register
                                 </a>
                              </div>
                              <div id="Ugly-Mugs-Registern" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b>Q: What is the Ugly Mugs Register?</b></p>
                                    <p>The National Ugly Mugs register (NUM) is a pioneering, national concept delivered by Escorts4U through this Website. It is designed to provide greater protection for Escorts who are often targeted or find themselves the victim of a dangerous individual, but are reluctant to report the incident to the police. These offenders are often serial sexual predators or criminals who pose a risk to Escorts and to the public as a whole.</p>
                                    <p class="mt-2"><b>Q: How does the register help me?</b></p>
                                    <p>As a registered Advertiser, you will have access to NUM through the Dashboard after logging onto your Account. You simply complete an online report regarding your incident, and the NUM Report (UMReport) is made available to other Escorts via thier Dashboard. You remain anonymous.</p>
                                    <p class="mt-2"><b>Q: Is NUM confidential?</b></p>
                                    <p>Yes. NUM operates under a strict confidentiality policy which means we will not disclose or share information outside the Escorts4U team without your permission. Your information will be held electronically on a secure system. We follow strict guidelines of confidentiality, and we can reassure you that we will always protect your interests and respect to everything you say.</p>
                                    <p>We follow the Local Laws and the principles set out in the Privacy Act and the Notifiable Data Breaches scheme.</p>
                                    <p class="mt-2"><b>Q: Is the NUM funded by the police?</b></p>
                                    <p>No. Escorts4U has no connection with any of the police services throughout Australia.</p>
                                    <p class="mt-2"><b>Q: How do I make a report?</b></p>
                                    <p>Simply log on and go to the Dashboard. Select "Make a Report" to submit your incident. The UMReport will be reviewed by Escorts4U and then published to other Escorts via the NUM register. Only Advertisers have access to the NUM register.</p>
                                    <p class="mt-2"><b>NUM Alerts</b></p>
                                    <p>We turn your UMReport into a sanitised Alert - with enough information to alert other Escorts, but not to identify you. We then post the Alert to our Website and email or text to other Escorts, who have enabled this service, alerting them of dangerous individuals.</p>
                                    <p>Where the UMReport turns out to be a scam report. We will post the scam details to the 'Scammer Alerts' page on the Website.</p>
                                    <p class="mt-2"><b>What is a NUM Alert?</b></p>
                                    <p>An Alert is simply a warning meant to alert Escorts to people or situations that may be dangerous to them.</p>
                                    <p>When we receive a UMReport it will be moderated and risk assessed by Escorts4U and sanitised to form an Alert. This will then be posted onto the NUM register, which registered Advertisers can access from their Dashboard.</p>
                                    <p class="mt-2"><b>What can I do in the NUM register?</b></p>
                                    <p>When you register as an Advertiser you automatically gain access to the NUM register. You can:</p>
                                    <ul>
                                       <li>View Alerts</li>
                                       <li>Make a report</li>
                                       <li>Do a number check</li>
                                       <li>Do an email check</li>
                                    </ul>
                                    <p class="mt-2"><b>Can I do a Number check?</b></p>
                                    <p>Yes. Simply log on and follow these simple steps:</p>
                                    <ul>
                                       <li>Go to your dashboard.</li>
                                       <li>Click "Lookup"</li>
                                       <li>Type in the number you want to check in the serach field</li>
                                       <li>Select "Submit"</li>
                                       <li>A message will appear letting you know if there has been a match or not. This service is subject to the Privacy Act.</li>
                                    </ul>
                                    <p>As the number checker is new, there are not so many 'ugly numbers' in the database, so if there is no match this is not to say that the number and person using the number are safe to meet with.</p>
                                    <p>Every time an 'ugly number' is reported to NUM it will be immediately added to the database.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#visa-applications" aria-expanded="false">
                                 Visa applications & banking
                                 </a>
                              </div>
                              <div id="visa-applications" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <p class="mt-2"><b> Q: How do I apply for a Visa?</b></p>
                                    <p>You can apply for a Visa online or engage a migration agent to prepare your application on your behalf.</p>
                                    <p class="mt-2"><b>Q: Can Escorts4U help me with my Visa?</b></p>
                                    <p>No. We do not provide Visa services however, we can assist you by putting you in touch with a migration agent who may be able to provide you with advice.</p>
                                    <p class="mt-2"><b>Q: How do I open a bank account by myself?</b></p>
                                    <p>If you choose to open a bank account within six weeks of your arrival you will only need your passport as identification. If you wait more than six weeks after your arrival to open an account you will need extra identification like a birth certificate, driver's licence or credit card.</p>
                                    <p>When opening your bank account, make sure you are very clear about your address. Ask to view your address details entered up by the bank officer on the monitor to be absolutely sure the addess is correct. This will avaoid any problems with the delivery of your debit card.</p>
                                    <p class="mt-2"><b>Q: My card has not arrived, what should I do?</b></p>
                                    <p>If your card has not arrived within the time the bank advised you it would take for the card to arrive, go back to the bank and re-order the card. Some banks, as an interim solution, will issue you an international dedit card while you are there. You will need to transfer funds into the international acount the bank creates for you. You can do that via your bank app.</p>
                                    <p class="mt-2"><b>Q: How do I move money Internationally?</b></p>
                                    <p>Most banks in Australia have International Money Transfer services as a part of the online banking service. Once you have opened your bank account and registered to access your online banking, simply go to the "International Transfers" page of the website and follow the instructions. There are terms and conditions attached to the Bank which you have to comply with in relation to international money transfers.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--middle content end here-->
               <!--right side bar start from here-->
            </div>
         </div>
      </div>
   </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush