@extends('layouts.userDashboard')
@section('style')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}"> -->
<!-- <style type="text/css">
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
</style> -->
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid pl-3 pl-lg-5">
   <!--middle content-->
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Help for Viewers</h1>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
      </div>
   </div>
  
  <div class="row">
      <div class="col-md-12 my-2">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol></ol>
            </div>
          </div>
      </div>
  </div>
   <div class="row mt-2">
      <div class="col-md-12">
         <!-- Begin Page Content -->
         <div class="container-fluid" style="padding: 0px 0px;">
         <div class="row pb-5">
            <div class="col-md-12">
               <div id="accordion" class="myacording-design">
                  <div class="card">
                     <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                        Anonymity
                        </a>
                     </div>
                     <div id="about_me" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body p-0">
                           <div class="row">
                              <div class="col-sm-12">
                                 <p class="pt-2">
                                    <b>
                                       <stong>
                                          Q: Can I remain anonymous as a subscriber?
                                       </stong>
                                    </b>
                                 </p>
                                 <p>Yes you can. We only request your:</p>
                                 <ul>
                                    <li> Mobile number (for SMS 2FA verification) </li>
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
                                    <li>Advertiser notes (record your experience with an Advertiser)</li>
                                    <li>A-Alert notifications (how you are notified for any alert, by email or text or both)</li>
                                    <li>Upload your Avatar (Display your personal image or any image with your Account summary)</li>
                                    <li>My Pin-Up escort (display your favourite Escort on your dashboard)</li>
                                 </ul>
                              </div>
                              <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: What will happen if I leave the Website open on my browser and I walk away?</b></p>
                                 <p>If you are registered as a Viewer and logged on, and you walk away from your browser
                                    and there is no activity on the Website, then the Website will close and load “Google”
                                    home page. 
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                        Payments
                        </a>
                     </div>
                     <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body p-0">
                           <div class="row">
                              <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: How much will it cost me to be a Member?</b></p>
                                 <p>Nothing, Subscription to the Website is absolutely free. There are absolutely no
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
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#other_fees_concierge_services" aria-expanded="false">
                        Marketing and Third Party Advertisers
                        </a>
                     </div>
                     <div id="other_fees_concierge_services" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body p-0">
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
                              </div>
                           </div>
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