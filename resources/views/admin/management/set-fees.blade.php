@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
.concierge_services_table tbody td:nth-child(1), 
.concierge_services_table tbody td:nth-child(3), 
.concierge_services_table tbody td:nth-child(4),   
.concierge_services_table tbody td:nth-child(5) {
  text-align: center;
}
#loyalty_program_advertisers tbody td:nth-child(7),
#loyalty_program_advertisers tbody td:nth-child(1),
#loyalty_program_advertisers tbody td:nth-child(4),
#loyalty_program_advertisers tbody td:nth-child(5),
#loyalty_program_advertisers tbody td:nth-child(6),
#loyalty_program_advertisers tbody td:nth-child(3) {
  text-align: center;
}


#fee_support_services tbody td:nth-child(1),
#fee_support_services tbody td:nth-child(3),
#fee_support_services tbody td:nth-child(4),
#fee_support_services tbody td:nth-child(5) {
  text-align: center;
}
#agent_operator_fees tbody td:nth-child(5) {
  text-align: center;
}

#agent_operator_fees tbody td:nth-child(3) {
  text-align: center;
}

#agent_operator_fees tbody td:nth-child(4) {
  text-align: center;
}
#agent_operator_fees tbody td:nth-child(1) {
  text-align: center;
}

#commision_playbox_fees tbody td:nth-child(4) {
  text-align: center;
}


#commision_playbox_fees tbody td:nth-child(1) {
  text-align: center;
}

#commision_playbox_fees tbody td:nth-child(3) {
  text-align: center;
}


#myPricing tbody td:nth-child(1),
#myPricing tbody td:nth-child(3),
#myPricing tbody td:nth-child(4),
#myPricing tbody td:nth-child(5),
#myPricing tbody td:nth-child(6),
#myPricing tbody td:nth-child(7),
#myPricing tbody td:nth-child(8)  {
  text-align: center;
}



</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <!--middle content-->
         <div class="row">

            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Set Fees & Variables</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                           <li>
                              Fees and Variables can only be determined by the Managing Director (Level 1).
                           </li>
                           <li>
                              There are a range of Fees that apply to Advertisers, namely:
                              <ol class="level-2">
                                          <li>Advertising Fees.</li>
                                          <li>Concierge Services.</li>
                                          <li>Support Services.</li>
                                       </ol>
                           </li>
                           <li>
                           There is a loyalty program which applies to Advertisers.
                           </li>
                           <li>
                           There are a range of variables that determine:
                           <ol class="level-2">
                                          <li>Discounts to Adverting Fees.</li>
                                          <li>Loyalty Program entitlements and discounts.</li>
                                          <li>Agent Commission.</li>
                                       </ol>
                           </li>
                           <li>
                           All amounts are exclusive of GST.
                           </li>
                           <li>
                           Support Services are where E4U staff perform a service requested by the Advertiser, like for example, creating a Profile.

                           </li>
                        </ol>
                     </div>
               </div>
            </div>   
            <!-- Accordian Start -->
            <div class="col-md-12">
               <div id="accordion" class="myacording-design mb-5">

                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_advertising">
                        Set Fees - Advertising 
                        </a>
                     </div>
                     <div id="additional_advertising" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           <h3 class="NotesHeader"><b>Notes:</b> </h3>
                           <ol>
                              <li>
                                 Discount only aliplies:
                              </li>
                                 <ol type="a" class="level-2 my-1">
                                    <li>to a single transaction; and</li>
                                    <li>from day 22.</li>
                                 </ol>   
                              <li>
                                 After 21 days for Free, then Profile is suspended and Escort asked what Membership Type to go to, e.g. Platinum.
                              </li>
                           </ol>
                           
                           <div class="table-responsive">
                                 <table class="table table-bordered membership-table w-100" id="myPricing">
                                    <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-left">Item</th>
                                       <th class="text-left">Membership Type</th>
                                       <th class="text-center">Frequency</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">%</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="">
                                    </tbody>
                                 </table>
                           
                              {{-- <div class="d-flex justify-content-end">
                                 <button class="save_profile_btn" onclick="saveTable()">Save & Update</button>
                              </div> --}}
                           </div>
                              
                                 {{-- <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                 <ol>
                                    <li>
                                       Item is the internal number allocated to the Fee for our reference. Open to your
                                       suggested numbering protocol for Fees. This is a separate number to the Ref.
                                    </li>
                                    <li>Frequency: Fixed or set number of days.</li> 
                                    <li>Rate: per day, per month, per Service. This are what is set.</li>
                                    <li>% is the discount rate that is set.</li> 
                                    <li>After 21 days for Free, then Profile is suspended and Escort asked what
                                       Membership Type to go to, eg Platinum. Email is sent to Escort advising of
                                       intended suspension of Profile the day before expiry. Email provides link to
                                       Profile so that Membership Type can be edited to the level Escort wants.</li> 
                                    <li><strong>Special Note:</strong> Fee amount is applied right across the Website wherever
                                       a Fee value is displayed, including Footer files. Search
                                       website files for change to draw value from here. Eg $8.00
                                       or $6.00 and so on. Obvious areas are Listings - Payment
                                       based on Membership Type, Footer information files.</li> 
                                 
                                 </ol> --}}
                        </div>
                     </div>
                  </div>
                  {{-- end --}}
                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_concierge">
                        Set Fees - Concierge Services 
                        </a>
                     </div>
                     <div id="additional_concierge" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           <h3 class="NotesHeader"><b>Note</b>:</h3>
                              <ol>
                              <li>
                                 These Fees relate to support staff completing a request by the Advertiser to provide the Concierge Service.
                              </li>
                              </ol>

                              <div class="table-responsive">
                                 <table class="table table-bordered membership-table mt-3 w-100 concierge_services_table" id="concierge_services">
                                    <thead class="bg-first text-center">
                                       <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Fee</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                 </table>

                                 {{-- <div class="d-flex justify-content-end">
                                    <button class="save_profile_btn">Save & Update</button>
                                 </div> --}}
                              </div>
                              {{-- <h3 class="NotesHeader"><b>Note</b>:</h3>
                              <ol>
                                 <li>
                                    Item is the internal number allocated to the Fee for our reference. Open to your
                                    suggested numbering protocol for Fees.
                                 </li>
                                 <li>Rate: per day, per month, per Service.</li>
                                 <li>Amount can be set by dollar and cents value. These are what can be adjusted.</li>
                                 <li>Fee amount is applied right across the Website wherever a Fee value is
                                    displayed, including Footer files.</li>
                              </ol> --}}

                        </div>
                     </div>
                  </div>
                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_support">
                        Set Fees - Support Services (E4U Staff) 
                        </a>
                     </div>
                     <div id="additional_support" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           <h3 class="NotesHeader"><b>Notes:</b></h3>
                           <ol>
                              <li>No Fee applies to Media Verification if requested while creating a Platinum Profile.</li>
                              <li>Media Verification is limited to the default values per month. Additional Media Verification in the same month attracts the Fee.</li>
                           </ol>
                        
                           <div class="table-responsive">
                              <table class="table table-bordered membership-table mt-3 w-100"  id="fee_support_services">
                                 <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Fee</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">Action</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                        
                              {{-- <div class="d-flex justify-content-end">
                                 <button class="save_profile_btn">Save & Update</button>
                              </div> --}}
                           </div>
                        
                           {{-- <h3 class="NotesHeader"><b>Note:</b></h3>
                           <ol>
                              <li>Item is the internal number allocated to the Fee for our reference. Open to your
                                 suggested numbering protocol for Fees.</li>
                              <li>Rate: per day, per month, per Service.</li>
                              <li>Amount can be set by dollar and cents value. These are what can be adjusted.</li>
                              <li>Fee amount is applied right across the Website wherever a Fee value is
                                 displayed, including Footer files.</li>
                           </ol> --}}
                        </div>
                        
                     </div>
                  </div>
                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_variableloyalty">
                        Set Variables - Loyalty Program Advertisers
                        </a>
                     </div>
                     <div id="additional_variableloyalty" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           <h3 class="NotesHeader"><b>Note:</b></h3>
                           <ol>
                              <li>Level relates to which Membership Type qualifies for the Loyalty Program.</li>
                           </ol>
                        
                           <div class="table-responsive">
                              <table class="table table-bordered membership-table mt-3 w-100" id="loyalty_program_advertisers">
                                 <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Type</th>
                                       <th class="text-center">Level</th>
                                       <th class="text-left">Description</th>
                                       <th class="text-center">Value</th>
                                       <th class="text-center">Reward (Days)</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                        
                              {{-- <div class="d-flex justify-content-end">
                                 <button class="save_profile_btn">Save & Update</button>
                              </div> --}}
                           </div>
                        
                           {{-- <h3 class="NotesHeader"><b>Note:</b></h3>
                           <ol>
                              <li>Item is the internal number allocated for our reference. Open to your suggested numbering protocol for Fees.</li>
                              <li>Level: P = Platinum, G = Gold, S = Silver, MC = Massage Centre. Each can be enabled or disabled.</li>
                              <li>Amount can be set by dollar and cents value.</li>
                              <li>Values are applied right across the Website wherever a Fee value is displayed, including Footer files. The Value and Reward are what can be changed. They are applied in the Listing feature when calculating the Fee.</li>
                           </ol> --}}
                        </div>
                        
                     </div>
                  </div>
                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_variableagent">
                        Set Variables - Agent & Operator
                        </a>
                     </div>
                     <div id="additional_variableagent" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           <div class="table-responsive">
                              <table class="table table-bordered membership-table mt-3 w-100" id="agent_operator_fees">
                                 <thead class="bg-first text-center">
                                    <tr>

                                       <th class="text-center">Item</th>
                                       <th class="text-center">Description</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Value</th>
                                       <th class="text-center">
                                          Action
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                        
                              {{-- <div class="d-flex justify-content-end">
                                 <button class="save_profile_btn">Save & Update</button>
                              </div> --}}
                           </div>
                        
                           {{-- <h3 class="NotesHeader mt-4"><b>Note:</b></h3>
                           <ol>
                              <li>Item is the internal number allocated for our reference. Open to your suggested numbering protocol for Fees.</li>
                              <li>Rate: per day, per Registration, per Service.</li>
                              <li>Amount can be set by dollar and cents value, or for the percentage including the percentile.</li>
                              <li>Values are applied right across the Website wherever a Fee value is displayed, including Footer files.</li>
                              <li>These values apply to calculating Commission for the Agent and the Operator. See separate tasks.</li>
                           </ol> --}}
                        
                           
                        </div>
                        
                     </div>
                  </div>
                  <div class="card custom-help-contain">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_variableplaybox">
                        Set Commission - Playbox
                        </a>
                     </div>
                     <div id="additional_variableplaybox" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                           
                        
                           <h3 class="NotesHeader"><b>Note:</b></h3>
                           <ol>
                              <li>Earnings are split between the Escort and E4U.</li>
                              <li>Earnings paid at the end of the Month.</li>
                           </ol>
                        
                           <div class="table-responsive mt-3">
                              <table class="table table-bordered membership-table mt-3 w-100" id="commision_playbox_fees">
                                 <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Description</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                        
                              {{-- <div class="d-flex justify-content-end">
                                 <button class="save_profile_btn">Save & Update</button>
                              </div> --}}
                           </div>
                        </div>
                        
                     </div>
                  </div>

               </div>
            </div>
            <!-- Accordian End -->
            <!--middle content end here-->
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <footer class="sticky-footer bg-white">
      <div class="container my-auto">
         <div class="copyright text-center my-auto">
            <span> </span>
         </div>
      </div>
   </footer>
   <!-- End of Footer -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<div class="modal fade upload-modal" id="pricing-detail" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
               <h5 class="modal-title"><img src="{{ asset('assets/dashboard/img/edit-price.png')}}" class="custompopicon">Edit Fee Value</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
         </div>

         <div class="modal-body pb-0 agent-tour">
            <form id="agent_bank" method="post" action="{{ route('admin.save.pricing.details')}}">
               @csrf
               <input type="hidden" name="pricingId" value="" id="pricingId">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Membership Type</label>
                            <input type="text" class="form-control" placeholder="Membership Plan" id="membershipname" disabled>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Frequency</label>
                          <input type="text" class="form-control" placeholder="Frequency " id="frequency" name="frequency">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Rate</label>
                           {{-- <input type="text" class="form-control" id="days" name="days" disabled> --}}
                           <select class="custom-select" name="days" id="days" required data-parsley-required-message="Please select state">
                              <option value="">Select</option>
                              <option value="1">per day</option>
                              <option value="2">per week</option>
                              <option value="3">per Service</option>
                           </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Amount</label>
                           <input type="text" required class="form-control" placeholder="RATE" name="price" id="price" data-parsley-required-message="Please enter price" data-parsley-type="number" data-parsley-type-message="Enter only numbers">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>%</label>
                        <input type="text " class="form-control" placeholder="%"  id="percentage" name="percentage">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Amount</label>
                        <input type="text " class="form-control" placeholder="%"  id="discount_amount" disabled>
                        <input type="hidden" name="discount_amount" id="ac_amount">
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                           <button type="submit" class="btn-success-modal shadow-none float-right"> Save & Update</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Edit_Competitor"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Variables - Loyalty Program Advertisers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <label>Type</label>
                     <input type="text" class="form-control rounded-0" value="Escorts">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Level</label>
                     <input type="text" class="form-control rounded-0" value="P, G, S">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Value</label>
                     <input type="text" class="form-control rounded-0" value="$ 8.00">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Reward (Days)	</label>
                     <input type="text" class="form-control rounded-0" value="1">
                  </div>
                  <div class="col-12 mb-3">
                     <label>Description</label>
                     <textarea name="decs" class="form-control rounded-0" rows="5">Spend</textarea>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn-success-modal">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="concierge_services_modal" tabindex="-1" role="dialog" aria-labelledby="Concierge_ServicesLabel" aria-hidden="true">
   
</div>


<div class="modal fade upload-modal" id="support_fees_modal" tabindex="-1" role="dialog" aria-labelledby="Support_ServicesLabel" aria-hidden="true">
</div>

<div class="modal fade upload-modal" id="loyalty_program_advertisers_modal" tabindex="-1" role="dialog" aria-labelledby="Support_ServicesLabel" aria-hidden="true">
</div>

<div class="modal fade upload-modal" id="agent_operator_fees_modal" tabindex="-1" role="dialog" aria-labelledby="Support_ServicesLabel" aria-hidden="true">
</div>

<div class="modal fade upload-modal" id="commision_playbox_fees_fees_modal" tabindex="-1" role="dialog" aria-labelledby="Support_ServicesLabel" aria-hidden="true">
</div>





<div class="modal fade upload-modal" id="Agent_Operator" tabindex="-1" role="dialog" aria-labelledby="Agent_OperatorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Operator"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Variables - Agent & Operator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  
                  <div class="col-6 mb-3">
                     <label>Rate</label>
                     <input type="text" class="form-control rounded-0" value="per day">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Amount</label>
                     <input type="text" class="form-control rounded-0" value="$ 75.00">
                  </div>
                  <div class="col-12 mb-3">
                     <label>Description</label>
                     <textarea name="decs" class="form-control rounded-0" rows="5">Commission - Advertising</textarea>

                   
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn-success-modal">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade upload-modal" id="playbox" tabindex="-1" role="dialog" aria-labelledby="playboxLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="playbox"><img src="{{ asset('assets/dashboard/img/set-commission.png')}}" class="custompopicon">Set Commission - Playbox</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  
                  <div class="col-6 mb-3">
                     <label>Rate</label>
                     <input type="text" class="form-control rounded-0" value="10%">
                  </div>
                  <div class="col-12 mb-3">
                     <label>Description</label>
                     <textarea name="decs" class="form-control rounded-0" rows="5">Earnings portion - Escort</textarea>

                   
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn-success-modal">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>



@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$("#agent_bank").parsley({

});
$(document).ready(function(){

   var table = $('#myPricing').DataTable({
      "language": {
          search: "Search: _INPUT_",
           searchPlaceholder: "Search by Membership Type",

         oPaginate: {
         sNext: '<span aria-hidden="true">Next</span>',
         sPrevious: '<span aria-hidden="true">Previous</span>',
         sFirst: '<span aria-hidden="true">»</span>',
         sLast: '<span aria-hidden="true">»</span>'
         }
      },
      info: false,
      bLengthChange: true,
      processing: true,
      serverSide: true,
      lengthChange: true,
      order: [1,'asc'],
      searchable:false,
      //searching:true,
      bStateSave: false,

      ajax: {
         url: "{{ route('admin.myPricing.dataTable') }}",
         data: function (d) {
               d.type = 'player';
         }
      },
      columns: [

         { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
         { data: 'member_type', name: 'member_type', searchable: true, orderable:false ,defaultContent: 'NA'},
         { data: 'frequency_day', name: 'frequency_day', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'rate', name: 'rate', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'prices', name: 'prices', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'percentage', name: 'percentage', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'discount_amounts', name: 'discount_amounts', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ]
   });



    
      var concierge_services = $("#concierge_services").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Fee Type...",
      lengthMenu: "Show _MENU_ entries",
      zeroRecords: "No matching records found",
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "No entries available",
      infoFiltered: "(filtered from _MAX_ total entries)"
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.concierge_services_datatable') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'fee', name: 'fee', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'frequency', name: 'frequency', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'amount', name: 'amount', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],

      order: [[1, 'asc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


      $(document).on('click', '.edit_item', function(e) 
      {
                  var rowData = $(this).data('id');
                  var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                                     <form name="concierge_services_frm" method="post">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="Concierge_Services"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Fees - Concierge Services</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                             </button>
                                          </div>
                                          <div class="modal-body pb-0">
                                            
                                                <div class="row">
                                                   <div class="col-6 mb-3">
                                                      <label>Fee</label>
                                                      <input type="text" name="fee" class="form-control rounded-0" value="${(rowData.fee  ? rowData.fee : '')}" readonly>
                                                   </div>
                                                   <div class="col-6 mb-3">
                                                      <label>Rate</label>
                                                      <input type="text" name="frequency" class="form-control rounded-0" value="${(rowData.frequency ? rowData.frequency : '')}" readonly>
                                                   </div>
                                                   <div class="col-6 mb-3">
                                                      <label>Amount</label>
                                                      <input type="text" name="amount" class="form-control rounded-0" value="${(rowData.amount ? rowData.amount : '')}">
                                                   </div>
                                                </div>
                                            
                                          </div>
                                          <div class="modal-footer">
                                             <input type="hidden" type="hidden" name="concierge_services" value="concierge_services">
                                              <input type="hidden" type="hidden" name="id" value="${(rowData.id ? rowData.id : '')}">
                                             <input type="submit" class="btn-success-modal" id="update_concierge_services" value="Save &amp; Update">
                                          </div>
                                       </div>
                                        </form>
                                    </div>`;

                  $('#concierge_services_modal').html(modal_html);
                  $('#concierge_services_modal').modal({backdrop: 'static',  keyboard: false});          

      });


      $(document).on('submit', 'form[name="concierge_services_frm"]', function(e) 
      {
         console.log('dadadada');
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         swal_waiting_popup({'title':'Updatin Data'});
         $.ajax({
               url: "{{ route('admin.update_fees_data') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     concierge_services.ajax.reload(null, false); 
                     $('#concierge_services_modal').modal('hide');
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                   $('#concierge_services_modal').modal('hide');
                  swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });

   var today = moment().format('YYYY-MM-DD');
  

   $('body').on ('show.bs.modal', '#pricing-detail', function(event){
      button = $(event.relatedTarget);
      const bank = $(button).data('name');
      if($(button).data('target') == "#commission-report") {
         $('#bank_name').attr('disabled',true);
      }

      $('#membershipname').val($(button).data('membershipname'));
      $('#pricingId').val($(button).data('id'));
      $('#price').val(parseFloat($(button).data('price')).toFixed(2));
      $('#frequency').val($(button).data('frequency'));
      if($(button).data('membershipname') == 'Free') {
      $('#frequency').attr('disabled',false);

      } else {
      $('#frequency').attr('disabled',true);
      }
      $('#days').val($(button).data('days'));
      $('#percentage').val($(button).data('per'));
      $('#discount_amount').val($(button).data('discount_amount'));

      if ($(button).data('discount_amount') !== "N/A") {
         let discounts = parseFloat($(button).data('discount_amount'));
         if (!isNaN(discounts)) {
            $('#ac_amount').val(discounts);
         }
      }
      

      $('#bankId').val($(button).data('id'));
      console.log("target = ", button);
      
   });


   // $("#price").keyup(function(){
   //    var price = $(this).val();
   //    console.log("price = ", price);
   //    var per = $("#percentage").val();
   //    if(per != 'N/A') {
   //       var percent = price*per/100;
   //       var amount = price-percent;
   //       var per = $("#discount_amount").val(Math.ceil(amount * 100) / 100);
   //       $("#ac_amount").val(amount);
   //    } else {
   //       var per = $("#discount_amount").val('N/A');
   //       $("#ac_amount").val('');
   //    }

   //    console.log("ac price = ", price-percent);
   // });

   $("#price").on("keyup change", calculateDiscount);
   $("#percentage").on("keyup change", calculateDiscount);

   function calculateDiscount() {
    var price = parseFloat($("#price").val());
    var per = $("#percentage").val();

    // if price is not a number, stop
    if (isNaN(price)) return;

    if (per !== 'N/A' && per !== '' && !isNaN(per)) {
        per = parseFloat(per);
        var percent = (price * per) / 100;
        var amount = price - percent;

        // Set both values rounded up to 2 decimals
        $("#discount_amount").val(Math.ceil(amount * 100) / 100);
        $("#ac_amount").val(amount);

        console.log("Discount =", percent, "Final Amount =", amount);
    } else {
        $("#discount_amount").val('N/A');
        $("#ac_amount").val('');
    }
}

   $("body").on('submit','#agent_bank',function(e){
      $('.head_modal_title').html('Fee Value Setting');
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var data = new FormData(form[0]);
      $.ajax({
         method:form.attr('method'),
         url: url,
         data:data,
         contentType: false,
         processData: false,
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         },
         success :function(data) {
            console.log(data.data);
            if(data.error == 0) {
               $('.comman_msg').html("Updated");
               $("#comman_modal").modal('show');
               $("#pricing-detail").modal('hide');
               table.draw();
            }
         },
         error: function(data) {
            console.log("error otp: ", data.responseJSON.errors);
            // $.each(data.responseJSON.errors, function(key, value) {
            // errorsHtml = '<div class="alert alert-danger"><ul>';
            // errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
            // });
         }
      });

   });
});


///////////// Set Fees - Support Services /////////////////
var fee_support_services = $("#fee_support_services").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Fee...",
      lengthMenu: "Show _MENU_ entries",
      zeroRecords: "No matching records found",
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "No entries available",
      infoFiltered: "(filtered from _MAX_ total entries)"
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.fee_support_services') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'fee', name: 'fee', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'frequency', name: 'frequency', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'amount', name: 'amount', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],

      order: [[0, 'asc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


        $(document).on('click', '.edit_item_fee_support_services', function(e) 
      {
                  var rowData = $(this).data('id');
                  var modal_html =`<div class="modal-dialog modal-dialog-centered" role="document">
                                     <form name="fee_support_services_frm" method="post">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="Concierge_Services"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Fees - Support Services (E4U Staff)</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                             </button>
                                          </div>
                                          <div class="modal-body pb-0">
                                            
                                                <div class="row">
                                                   <div class="col-6 mb-3">
                                                      <label>Fee</label>
                                                      <input type="text" name="fee" class="form-control rounded-0" value="${(rowData.fee  ? rowData.fee : '')}" readonly>
                                                   </div>
                                                   <div class="col-6 mb-3">
                                                      <label>Rate</label>
                                                      <input type="text" name="frequency" class="form-control rounded-0" value="${(rowData.frequency ? rowData.frequency : '')}" readonly>
                                                   </div>
                                                   <div class="col-6 mb-3">
                                                      <label>Amount</label>
                                                      <input type="text" name="amount" class="form-control rounded-0" value="${(rowData.amount ? rowData.amount : '')}">
                                                   </div>
                                                </div>
                                            
                                          </div>
                                          <div class="modal-footer">
                                             <input type="hidden" type="hidden" name="fee_support_services" value="fee_support_services">
                                              <input type="hidden" type="hidden" name="id" value="${(rowData.id ? rowData.id : '')}">
                                             <input type="submit" class="btn-success-modal" id="update_fee_support_services" value="Save &amp; Update">
                                          </div>
                                       </div>
                                        </form>
                                    </div>`;

                  $('#support_fees_modal').html(modal_html);
                  $('#support_fees_modal').modal({backdrop: 'static',  keyboard: false});          

      });

      $(document).on('submit', 'form[name="fee_support_services_frm"]', function(e) 
      {
        
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         swal_waiting_popup({'title':'Updatin Data'});
         $.ajax({
               url: "{{ route('admin.update_fees_data') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     fee_support_services.ajax.reload(null, false); 
                     $('#support_fees_modal').modal('hide');
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                   $('#support_fees_modal').modal('hide');
                  swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });

///////////// Loyalty Program Advertisers /////////////////

var loyalty_program_advertisers = $("#loyalty_program_advertisers").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search By Type...",
      lengthMenu: "Show _MENU_ entries",
      zeroRecords: "No matching records found",
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "No entries available",
      infoFiltered: "(filtered from _MAX_ total entries)"
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.loyalty_program_advertisers') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'type', name: 'type', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'level', name: 'level', searchable: false, orderable:false,defaultContent: 'NA' },
            { data: 'discription', name: 'discription', searchable: false, orderable:false,defaultContent: 'NA' },
            { data: 'amount', name: 'amount', searchable: false, orderable:false,defaultContent: 'NA' },
            { data: 'reward', name: 'reward', searchable: false, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],

      order: [[0, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


        $(document).on('click', '.edit_item_loyalty_program_advertisers', function(e) 
      {
                  var rowData = $(this).data('id');
                  let rewardOptions = '';
                  for (let i = 1; i <= 10; i++) {
                     let selected = (rowData.reward == i) ? 'selected' : '';
                     rewardOptions += `<option value="${i}" ${selected}>${i}</option>`;
                  }


                  var modal_html = `<div class="modal-dialog modal-dialog-centered" role="document">
                                       <form name="loyalty_program_advertisers_modal_frm" method="post">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="Edit_Competitor"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon"> Set Variables - Loyalty Program Advertisers</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                                </button>
                                             </div>
                                             <div class="modal-body pb-0">
                                               
                                                   <div class="row">
                                                     

                                                      <div class="col-6 mb-3">
                                                         <label>Type</label>
                                                         <input type="text" class="form-control rounded-0" name="type"  value="${(rowData.type  ? rowData.type : '')}" required>
                                                      </div>

                                                      <div class="col-6 mb-3">
                                                         <label>Level</label>
                                                         <input type="text" class="form-control rounded-0" name="level"  value="${(rowData.level  ? rowData.level : '')}" required>
                                                      </div>

                                                      <div class="col-6 mb-3">
                                                         <label>Value</label>
                                                         <input type="number" class="form-control rounded-0" name="amount"  value="${(rowData.amount  ? rowData.amount : '')}" required>
                                                      </div>

                                                      <div class="col-6 mb-3">
                                                         <label>Reward (Days)</label>
                                                         <select class="form-control rounded-0" name="reward" required>
                                                            <option value="" disabled ${!rowData.reward ? 'selected' : ''}>Select Reward</option>
                                                            ${rewardOptions}
                                                         </select>
                                                      </div>

                                                      
                                                      <div class="col-12 mb-3">
                                                         <label>Description</label>
                                                         <textarea name="decs" class="form-control rounded-0" rows="5">${(rowData.discription  ? rowData.discription : '')}</textarea>
                                                      </div>
                                                   </div>
                                                
                                             </div>
                                             <div class="modal-footer">
                                              <input type="hidden" type="hidden" name="loyalty_program_advertisers" value="loyalty_program_advertisers">
                                              <input type="hidden" type="hidden" name="id" value="${(rowData.id ? rowData.id : '')}">
                                                <input type="submit" name="submit" class="btn-success-modal" value="Save &amp; Update">
                                             </div>
                                          </div>
                                        </form>
                                       </div>`;

                  $('#loyalty_program_advertisers_modal').html(modal_html);
                  $('#loyalty_program_advertisers_modal').modal({backdrop: 'static',  keyboard: false});          

      });

      $(document).on('submit', 'form[name="loyalty_program_advertisers_modal_frm"]', function(e) 
      {
        
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         swal_waiting_popup({'title':'Updatin Data'});
         $.ajax({
               url: "{{ route('admin.update_fees_data') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     loyalty_program_advertisers.ajax.reload(null, false); 
                     $('#loyalty_program_advertisers_modal').modal('hide');
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                   $('#loyalty_program_advertisers_modal').modal('hide');
                  swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });


//////////////// End Loyalty Program Advertisers /////////////////////


/////////////// Set Variables - Agent & Operator ////////////
var agent_operator_fees = $("#agent_operator_fees").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Rate...",
      lengthMenu: "Show _MENU_ entries",
      zeroRecords: "No matching records found",
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "No entries available",
      infoFiltered: "(filtered from _MAX_ total entries)"
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.agent_operator_fees') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
            
            { data: 'id', name: 'id', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'discription', name: 'discription', orderable:false, defaultContent: 'NA'},
            { data: 'rate', name: 'rate', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'percent', name: 'percent', searchable: false, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
           
      ],

      order: [[0, 'asc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


        $(document).on('click', '.edit_item_agent_operator_fees_modal', function(e) 
      {
                  var rowData = $(this).data('id');
                  let rewardOptions = '';
                  for (let i = 1; i <= 10; i++) {
                     let selected = (rowData.reward == i) ? 'selected' : '';
                     rewardOptions += `<option value="${i}" ${selected}>${i}</option>`;
                  }


                  var modal_html = `<div class="modal-dialog modal-dialog-centered" role="document">
                                       <form name="agent_operator_fees_frm" method="post">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="Edit_Competitor"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Variables - Agent & Operator</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                                </button>
                                             </div>
                                             <div class="modal-body pb-0">
                                               
                                                   <div class="row">
                                                      <div class="col-6 mb-3">
                                                         <label>Rate</label>
                                                               <select class="custom-select" name="rate" id="rate" required data-parsley-required-message="Please select state">
                                                                  <option value="">Select</option>
                                                                  <option value="1" ${rowData.rate == 'per day' ? 'selected' : ''}>per day</option>
                                                                  <option value="2" ${rowData.rate == 'per week' ? 'selected' : ''}>per week</option>
                                                                  <option value="3" ${rowData.rate == 'per Registration' ?  'selected' : ''}>per Registration</option>
                                                               </select>
                                                       
                                                      </div>
                                                      <div class="col-6 mb-3">
                                                         <label>Value</label>
                                                         <input type="text"  class="form-control rounded-0" name="percent"  value="${(rowData.percent  ? rowData.percent : '')}" required>
                                                      </div>

                                                       <div class="col-12 mb-3">
                                                         <label>Description</label>
                                                         <textarea name="discription" class="form-control rounded-0" rows="5">${(rowData.discription  ? rowData.discription : '')}</textarea>
                                                      </div>

                                                     
                                                      
                                                   </div>
                                                
                                             </div>
                                             <div class="modal-footer">
                                              <input type="hidden" type="hidden" name="agent_operator_fees" value="agent_operator_fees">
                                              <input type="hidden" type="hidden" name="id" value="${(rowData.id ? rowData.id : '')}">
                                                <input type="submit" name="submit" class="btn-success-modal" value="Save &amp; Update">
                                             </div>
                                          </div>
                                        </form>
                                       </div>`;

                  $('#agent_operator_fees_modal').html(modal_html);
                  $('#agent_operator_fees_modal').modal({backdrop: 'static',  keyboard: false});          

      });

      $(document).on('submit', 'form[name="agent_operator_fees_frm"]', function(e) 
      {
        
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         swal_waiting_popup({'title':'Updatin Data'});
         $.ajax({
               url: "{{ route('admin.update_fees_data') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     agent_operator_fees.ajax.reload(null, false); 
                     $('#agent_operator_fees_modal').modal('hide');
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                   $('#agent_operator_fees_modal').modal('hide');
                  swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });

/////////////// Set Variables - Agent & Operator ////////////


/////////////// Set Commission - Playbox  ////////////
var commision_playbox_fees = $("#commision_playbox_fees").DataTable({
      language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Description...",
      lengthMenu: "Show _MENU_ entries",
      zeroRecords: "No matching records found",
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "No entries available",
      infoFiltered: "(filtered from _MAX_ total entries)"
      },

      processing: true,
      serverSide: true,
      lengthChange: true,
      searchable:false,
      bStateSave: false,

      ajax: {
      url: "{{ route('admin.commision_playbox_fees') }}",
      data: function (d) {
      d.type = 'player';
      }
      },
      columns: [
            
            { data: 'id', name: 'id', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'discription', name: 'discription', orderable:false, defaultContent: 'NA'},
            { data: 'amount_perent', name: 'amount_perent', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
           
      ],

      order: [[0, 'asc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      });


        $(document).on('click', '.edit_item_commision_playbox_fees', function(e) 
      {
                  var rowData = $(this).data('id');
                  let rewardOptions = '';
                  for (let i = 1; i <= 10; i++) {
                     let selected = (rowData.reward == i) ? 'selected' : '';
                     rewardOptions += `<option value="${i}" ${selected}>${i}</option>`;
                  }


                  var modal_html = `<div class="modal-dialog modal-dialog-centered" role="document">
                                       <form name="commision_playbox_fees_frm" method="post">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="Edit_Competitor"><img src="{{ asset('assets/dashboard/img/add-fee.png')}}" class="custompopicon">Set Distribution - Add My to Playbox</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                                                </button>
                                             </div>
                                             <div class="modal-body pb-0">
                                               
                                                   <div class="row">
                                                     
                                                      <div class="col-12 mb-3">
                                                         <label>Amount</label>
                                                         <input type="text"  class="form-control rounded-0" name="amount"  value="${(rowData.amount  ? rowData.amount : '')}" required>
                                                      </div>

                                                       <div class="col-12 mb-3">
                                                         <label>Description</label>
                                                         <textarea name="discription" class="form-control rounded-0" rows="5">${(rowData.discription  ? rowData.discription : '')}</textarea>
                                                      </div>

                                                     
                                                      
                                                   </div>
                                                
                                             </div>
                                             <div class="modal-footer">
                                              <input type="hidden" type="hidden" name="commision_playbox_fees" value="commision_playbox_fees">
                                              <input type="hidden" type="hidden" name="id" value="${(rowData.id ? rowData.id : '')}">
                                                <input type="submit" name="submit" class="btn-success-modal" value="Save &amp; Update">
                                             </div>
                                          </div>
                                        </form>
                                       </div>`;

                  $('#commision_playbox_fees_fees_modal').html(modal_html);
                  $('#commision_playbox_fees_fees_modal').modal({backdrop: 'static',  keyboard: false});          

      });


      $(document).on('submit', 'form[name="commision_playbox_fees_frm"]', function(e) 
      {
        
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         swal_waiting_popup({'title':'Updatin Data'});
         $.ajax({
               url: "{{ route('admin.update_fees_data') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     commision_playbox_fees.ajax.reload(null, false); 
                     $('#commision_playbox_fees_fees_modal').modal('hide');
                     Swal.close();
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                   $('#commision_playbox_fees_fees_modal').modal('hide');
                  swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
               }
         });
      });


/////////////// Set Commission - Playbox   ////////////




</script>
@endpush
