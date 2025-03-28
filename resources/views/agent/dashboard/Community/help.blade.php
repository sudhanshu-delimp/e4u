@extends('layouts.agent')
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
                        <div class="v-main-heading h3">Help for Agents</div>
                     </div>
                  </div>
                  <!-- /.container-fluid --><br>
                  <div class="row">
                     <div class="col-md-12">
                        <div id="accordion" class="myacording-design">
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                 Administration and Marketing
                                 </a>
                              </div>
                              <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Do I have to enter into an Agreement to become an Agent?</b></p>
                                       <p>Yes. We require you to enter into an “Agent Agreement” which sets out all of our respective obligations. The agreement also contains:
                                       </p>
                                       <ul>
                                          <li> The services that you will provide to Advertisers</li>
                                          <li> KPI requirements</li>
                                          <li> Training information </li>
                                          <li> Commission structure </li>
                                       </ul>
                                       <p>
                                          The Agent Agreement appointment is for a set time with options to renew.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: What communication tools will be available to me? </b></p>
                                       <p>You will have an email account allocated you for all communications to Escorts4U,
                                          Advertisers and prospective Members. Your email account will be styled:
                                       </p>
                                       <p>agent.[teritory]@e4u.com.au</p>
                                       <p>We will also provide you with business cards</p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Will I have access to all my clients Accounts?</b></p>
                                       <p>Yes you absolutely will. You will have access to Profile Information, Profile and Tour creator and the Archive Folder, as well as to the Concierge Services.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: What marketing materials will be made available to me?</b></p>
                                       <p>
                                          Escorts4U will provide all of your marketing materials, such as:
                                       </p>
                                       <ul>
                                          <li>Proposal to a Massage Centre to become a Member</li>
                                          <li>Information about the Services</li>
                                       </ul>
                                       <p>
                                          All of the marketing material is loaded in your Dashboard. You simply pull up the
                                          document you want to use, insert the addressee’s information, save the document to a
                                          folder and then print the document in either soft or hard form. Marketing materials are designed to summarise to the prospective Member information about the relevant area of Escorts4U you are targeting. You can print the document to take with you to a
                                          meeting, or email it in pdf format to the prospective member.                            
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Can I use my own marketing material?</b></p>
                                       <p>No. You must use the Escorts4U marketing material unless your material is approved by us.</p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Is there any training?</b></p>
                                       <p>
                                          Yes there is. Training is provided for free. Usually over three sessions totaling ten to twelve hours.
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                 Applying to become an Agent
                                 </a>
                              </div>
                              <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: How do I apply to become an Agent?</b></p>
                                       <ul class="list-step">
                                          <li>
                                             <span>Step 1.  </span> 
                                             <p> you land on the Website hover over “Register” located at the top right
                                                hand corner and click “Agent Registration”.
                                             </p>
                                          </li>
                                          <li>
                                             <span>Step 2.  </span> 
                                             <p>  Complete the information fields.</p>
                                          </li>
                                          <li>
                                             <span>Step 3.  </span> 
                                             <p>  Click the “Register” button.</p>
                                          </li>
                                       </ul>
                                       <p>
                                          Someone from our support team will be in touch with you within 24 hours.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Will I get a confirmation of my application to become an Agent?</b></p>
                                       <p>
                                          Yes you will. Escorts4U will forward to you by email a confirmation that we have
                                          received your application. The confirmation will contain a reference number for you to
                                          quote if any follow up is required.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: How do I get in touch with Escorts4U if I have any queries?</b></p>
                                       <p>
                                          You can forward an email to our <a href="#" style="color:#FF3C5F">support team</a> anytime. Please allow us some time to
                                          get back to you. We will get back to you within 24 hours, usually sooner.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Do I have to be a registered business to be an Agent?</b></p>
                                       <p>
                                          Yes. It is up to you as to which form of entity you wish to be, sole trader or an
                                          incorporated company. You will need to be registered for GST as well.                           
                                       </p>
                                       <p>
                                          Escorts4U can assist you with putting into place the entity you wish to use. That
                                          assistance is only with the putting into place the entity type, we do not provide advice
                                          on which type of entity is best suited to you. You need to get your own advice from an
                                          accountant in that regard.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Can Escorts4U put me in touch with an accountant?</b></p>
                                       <p>
                                          Yes we can. We have a list of accounting practices in each State who have an
                                          understanding of the Escorts4U business model. Simply request the details and then
                                          choose an accountant that is nearest to you. When you contact the accounting
                                          practice, mention you are wanting to make an appointment to discuss becoming an
                                          Agent for Escorts4U.
                                       </p>
                                       <p>
                                          Escorts4U has no financial arrangements with any of the accounting practices. We do
                                          not pay any commissions to the accounting practices.                            
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Will I have exclusivity to the area I am appointed in?</b></p>
                                       <p>
                                          No. Your appointment is a non-exclusive appointment within a Location. It is not our
                                          practice to appoint more than 3 Agents to each Location. It is our view that 3 Agents
                                          is adequate to service all of the Advertisers needs in any Location.
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#visa-applications" aria-expanded="false">
                                 Payments
                                 </a>
                              </div>
                              <div id="visa-applications" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: What is the basis of how am I paid?</b> </p>
                                       <p>
                                          You are paid a Commission based upon your successes with recruiting Massage
                                          Centres and Escorts to become a Member and on their respective advertising with us. 
                                          Your commission is calculated on:
                                       </p>
                                       <ul>
                                          <li>A set payment for each Massage Centre irrespective of whether they advertise with us or not</li>
                                          <li>A set percentage rate of 5% for all advertising placed with us by the Advertiser</li>
                                       </ul>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: Can I see a report on the Commission?</b></p>
                                       <p>
                                          Yes you can. Each month you are sent a report setting out the results of new
                                          Members and advertising spent by the Advertisers. You will have an opportunity to
                                          review the report and raise any queries before payment is made to you.                       
                                       </p>
                                       <p>
                                          You can also look up an Advertiser’s ongoing spend by logging onto the Website and
                                          going to your Dashboard.
                                       </p>
                                    </div>
                                    <div class="col-sm-12">
                                       <p class="pt-2"><b>Q: How do I get paid?</b></p>
                                       <p>
                                          You are paid monthly into your nominated bank account.
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                            <div class="card">
                              <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#Responsibilities" aria-expanded="false">
                                 Responsibilities
                                 </a>
                              </div>
                              <div id="Responsibilities" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="col-sm-12">
                          <p class="pt-2"><b>Q: What are my responsibilities? </b> </p>
                          <p>
                             It is your responsibility when conducting business with Escorts to:         
                          </p>
                          <ul>
                              <li>present, promote and sell the Services using solid arguments </li>
                              <li>establish, develop and maintain positive business relationships; and</li>
                              <li>to the extent that the Agent is able to, reach out through cold calling,</li>
                          </ul>
                          <p>and with Massage Centres to:</p>
                          <ul>
                              <li>identify, contact and recruit</li>
                              <li>present, promote and sell the Services using solid arguments</li>
                              <li>perform cost-benefit and needs analysis to meet their needs</li>
                              <li>establish, develop and maintain positive business relationships</li>
                              <li>reach out through cold calling</li>
                              <li>co-ordinate sales effort with Escorts4U where appropriate</li>
                          </ul>
                          <p>
                             Escorts4U will assist you will all of these tasks, in particular, through your Dashboard,
                             access to a Massage Centre database to assist you with making appointments.
                          </p>
                          <p>
                             Generally, you are expected to:
                          </p>
                          <ul>
                              <li>have the required knowledge base</li>
                              <li>expedite the notification of User problems and complaints to E4U so as to maximise a speedy resolution</li>
                              <li>analyse the territory/market potential, track sales and status reports through the Agent Log </li>
                              <li>provide E4U with reports on User needs, problems, interests, competitive activities,and potential for new products and services</li>
                              <li>keep abreast of best practices and promotional trends</li>
                              <li>continuously improve through feedback</li>
                          </ul>
                      </div>

                      <div class="col-sm-12">
                       <p class="pt-2"><b>Q: Can I provide other services to Advertisers?</b></p>
                       <p>
                         Yes you can. Provided they are not services linked to another advertising website for Escorts or Massage Centres.
                      </p>
                   </div>
                   
                   <div class="col-sm-12">
                       <p class="pt-2"><b>Q: Will Escorts4U work closely with me?</b></p>
                        <p>
                         Yes we will, but only to the extent you need us to. As an Agent, you are expected to
                         look after you interests under the Agent Agreement. The Agent Agreement is very
                         comprehensive and sets out in a very clear manner what is expected of you as an Agent.
                        </p>
                       
                   </div>

                   <div class="col-sm-12">
                       <p class="pt-2"><b>Q: Can I put forward ideas and suggestions?</b></p>
                     <p>
                         Yes you can. We encourage to put forward fresh ideas on how to improve the
                         Website and its administrative processes. Whist you are an independent operator
                         under the Agent Agreement, we do work closely with you and encourage you to be a
                         part of the team.
                     </p>
                    <p>
                    
                   </p></div>

                   <div class="col-sm-12">
                     <p class="pt-2"><b>Q: As an Agent, can I communicate with other Agents?</b></p>
                  <p>
                     Yes you can. It is not encouraged but if you feel the need to discuss matters with
                     other Agents then you can do so. We do not permit Agents from one Location to
                     conduct business in another Location. Whilst the Agent Agreement is a non-exclusive
                     agreement, it is limited to the Territory named in the Agent Agreement.                        
                  </p>

                 </div>
                    
                 <div class="col-sm-12">
                     <p class="pt-2"><b>Q: Will I have direct access to Advertisers?</b></p>
                     <p>
                         Yes you will but only to those Advertisers who have engaged you. You are
                         encouraged to build a close working relationship with Advertisers who have appointed
                         you. You are also encouraged to meet with and hopefully persuade other Advertisers
                         to engage you as their Agent.
                     </p>
                 </div>

                 <div class="col-sm-12">
                     <p class="pt-2"><b>Q: Do I have to resolve Advertiser queries?</b></p>
                     <p>
                         No, you do not. Assist with minor queries if you get one, but otherwise you refer the
                         Advertiser to their Dashboard and ask them to log a Support Ticket
                     </p>
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