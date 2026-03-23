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
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <!--middle content-->
         <div class="row">

            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Fee Discounts</h1>
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
                                          <li>Agent Fees.</li>
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
         </div>
      </div>
</div>
@endsection
@push('script')
@endpush
