@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 200px !important;
   }
   #myPricing {
    width: 100% !important;
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid">
         <!--middle content-->
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                  <!-- Page Heading -->
                  <div class="d-flex align-items-center">
                     <div class="v-main-heading h3">Pricing Summaries</div>
                  </div>
                  <div class="d-flex align-items-center mb-4">
                     <div class="v-main-heading h2"> Advertiser Fees &amp; Variables</div>
                  </div>
                  <div class="row ml-1">
                     <div class="panel-heading">
                        <ul class="nav nav-tabs tab-sec" style="width: 68%; gap: 0px;">
                           <li class="mr-4"><a href="#tab0warning" data-toggle="tab" class="active">Notes</a></li>
                           <li class="mr-4"><a href="#tab1warning" data-toggle="tab" class="">Advertising Fees</a></li>
                           <li class="mr-4"><a href="#tab2warning" data-toggle="tab" class="">Recommended Support Fees - Concierge Services</a></li>
                           <li class="mr-4"><a href="#tab3warning" data-toggle="tab" class="">Recommended Support Fees - Support Services</a></li>
                           <li class="mr-4"><a href="#tab4warning" data-toggle="tab" class="">Loyalty Program Advertisers</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-9">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab0warning">
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                       <ol class="pl-3">
                                          <li>
                                             There are a range of Fees that apply to Advertisers, namely:
                                             <ul class="list-new">
                                                <li class="mb-0">Advertising Fees</li>
                                                <li class="mb-0">Concierge Services</li>
                                                <li class="mb-0">Support Services</li>
                                             </ul>
                                          </li>
                                          <li>There is a loyalty program which applies to Advertisers.
                                          </li>
                                          <li>
                                             There are a range of variables that determine:
                                             <ul class="list-new">
                                                <li class="mb-0">Discounts to Adverting Fees
                                                </li>
                                                <li class="mb-0">Loyalty Program entitlements and discounts</li>
                                             </ul>
                                          </li>
                                          <li>All amounts are exclusive of GST.</li>
                                       </ol>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab1warning">
                                 <div class="row mb-4">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                       <form class="search-form-bg navbar-search">
                                          <div class="input-group">
                                             <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                                             <div class="input-group-append">
                                                <button class="btn-right-icon" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                                </button>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                       <div class="bothsearch-form">
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#commission-report">Ready Reckoner <i class="fa fa-exclamation-circle fa-fw text-white"></i></button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                       <ol class="pl-3">
                                          <li>
                                             Discount only applies:
                                             <ul class="list-new">
                                                <li class="mb-0">to a single transaction; and</li>
                                                <li class="mb-0">from day 22 to all Advertisers</li>
                                             </ul>
                                          </li>
                                          <li>After 21 days for Free Membership, then Profile is suspended and Escort asked what Membership Type<br> to go to, eg Platinum.</li>
                                       </ol>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl mb-5" id="table-sec">
                                    <table class="table" id="myPricing">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Item</th>
                                             <th scope="col">Membership Type</th>
                                             <th scope="col">Frequency</th>
                                             <th scope="col">Rate</th>
                                             <th scope="col">Amount</th>
                                             <th scope="col">%</th>
                                             <th scope="col">Amount</th>
                                             {{-- <th scope="col">Action</th> --}}
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          {{--<tr class="row-color">
                                             <td width="10%" class="theme-color">01</td>
                                             <td width="20%" class="theme-color">Platinum</td>
                                             <td class="theme-color">Fixed</td>
                                             <td class="theme-color">per day</td>
                                             <td class="theme-color">$ 8.00</td>
                                             <td class="theme-color">6.25</td>
                                             <td class="theme-color">$ 7.50</td>
                                          </tr>
                                           <tr class="row-color">
                                             <td width="10%" class="theme-color">02</td>
                                             <td width="20%" class="theme-color">Gold</td>
                                             <td class="theme-color">Fixed</td>
                                             <td class="theme-color">per day</td>
                                             <td class="theme-color">$ 6.00</td>
                                             <td class="theme-color">5</td>
                                             <td class="theme-color">$ 5.70</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">02</td>
                                             <td width="20%" class="theme-color">Silver</td>
                                             <td class="theme-color">Fixed</td>
                                             <td class="theme-color">per day</td>
                                             <td class="theme-color">$ 4.00</td>
                                             <td class="theme-color">5</td>
                                             <td class="theme-color">$ 3.80</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">02</td>
                                             <td width="20%" class="theme-color">Free</td>
                                             <td class="theme-color">21 Days</td>
                                             <td class="theme-color">per day</td>
                                             <td class="theme-color">$ 0.00</td>
                                             <td class="theme-color">N/A</td>
                                             <td class="theme-color">$ 0.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">02</td>
                                             <td width="20%" class="theme-color">Massage Centre</td>
                                             <td class="theme-color">Fixed</td>
                                             <td class="theme-color">per day</td>
                                             <td class="theme-color">$ 30.00</td>
                                             <td class="theme-color">5.00</td>
                                             <td class="theme-color">$ 28.50</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">02</td>
                                             <td width="20%" class="theme-color">Pin-up</td>
                                             <td class="theme-color">Fixed</td>
                                             <td class="theme-color">per week</td>
                                             <td class="theme-color">$ 475.00</td>
                                             <td class="theme-color">0.00</td>
                                             <td class="theme-color">$ 475.00</td>
                                          </tr> --}}
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab2warning">
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                       <ol class="pl-3">
                                          <li>
                                             These recommended Support Fees relate to an Agent completing a requeston behalf of the Advertiser to E4U to provide a Concierge Service.
                                          </li>
                                        <li>The Support Fee must be collected by the Agent from the Advertiser.</li>
                                       </ol>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl mb-5">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Item</th>
                                             <th scope="col">Fee</th>
                                             <th scope="col">Rate</th>
                                             <th scope="col">Amount</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">07</td>
                                             <td class="theme-color">Travel</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 75.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">08</td>
                                             <td class="theme-color">Accommodation</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 75.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">09</td>
                                             <td class="theme-color">Mobile SIM</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 75.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">10</td>
                                             <td class="theme-color">Email Account</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 75.00</td>
                                          </tr>
                                       <tr class="row-color">
                                             <td width="10%" class="theme-color">11</td>
                                             <td class="theme-color">Visa Migration &amp; Education Placement</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 75.00</td>
                                          </tr></tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab3warning">
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                       <ol class="pl-3">
                                          <li>
                                             These recommended Support Fees relate to an Agent completing a Support
                                             Service for an Advertiser.
                                          </li>
                                       </ol>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl mb-5">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Item</th>
                                             <th scope="col">Fee</th>
                                             <th scope="col">Rate</th>
                                             <th scope="col">Amount</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">12</td>
                                             <td class="theme-color">Create Profile</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 50.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">13</td>
                                             <td class="theme-color">Edit Profile</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 20.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">14</td>
                                             <td class="theme-color">Create Tour</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 50.00</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">15</td>
                                             <td class="theme-color">Edit Tour</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 20.00</td>
                                          </tr>
                                       <tr class="row-color">
                                             <td width="10%" class="theme-color">16</td>
                                             <td class="theme-color">Upload Media (for verfication)</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 20.00</td>
                                          </tr><tr class="row-color">
                                             <td width="10%" class="theme-color">17</td>
                                             <td class="theme-color">Complete Media Verification (excluding Platinum)</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 10.00</td>
                                          </tr><tr class="row-color">
                                             <td width="10%" class="theme-color">18</td>
                                             <td class="theme-color">Complete Profile Information</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 30.00</td>
                                          </tr><tr class="row-color">
                                             <td width="10%" class="theme-color">19</td>
                                             <td class="theme-color">Organise Profiles and Media in Archives</td>
                                             <td class="theme-color">Per Services</td>
                                             <td class="theme-color">$ 50.00</td>
                                          </tr></tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab4warning">
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <h3 class="NotesHeader"><b>Notes:</b> </h3>

                                       <ol class="pl-3">
                                          <li>Membership levels: <span class="ml-4">P = Platinum</span>  <span class="ml-4">G = Gold</span>   <span class="ml-4">S = Silver</span> <span class="ml-4">MC = Massage Centre</span>
                           </li>
                                          <li>
                                             Level relates to which Membership Type qualifies for the Loyalty Program.
                                          </li>
                                       </ol>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl mb-5">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Item</th>
                                             <th scope="col">Type</th>
                                             <th scope="col">Level</th>
                                             <th scope="col">Description</th>
                                             <th scope="col">Value</th>
                                             <th scope="col">Reward (Days)</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">20</td>
                                             <td class="theme-color">Escorts</td>
                                             <td class="theme-color">P, G, S</td>
                                             <td class="theme-color">Spend</td>
                                             <td class="theme-color">$ 200.00</td>
                                             <td class="theme-color">1</td>
                                          </tr>
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">21</td>
                                             <td class="theme-color">Massage Centre</td>
                                             <td class="theme-color">MC</td>
                                             <td class="theme-color">Spend</td>
                                             <td class="theme-color">$ 500.00</td>
                                             <td class="theme-color">1</td>
                                          </tr>
                                       </tbody>
                                    </table>
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
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="commission-report1">Ready Reckoner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form>
            <div class="row">
               <div class="col-md-12">
                  <div class="card mb-4">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="pl-3">
                           <li>Use the ready reckoner to calculate the Fee for a Profile or Tour.</li>
                           <li>
                              When calculating the Fee for a Tour:
                              <ul class="list-new">
                                 <li class="mb-0">The end date should be the last day of the Tour; and</li>
                                 <li class="mb-0">The number of Locations is the number of Locations included in theTour.</li>
                                             </ul>
                           </li>
                           <li>The Fee is inclusive of any discounts that would apply to a single transactionin excess of 21 days.</li>
                        </ol>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <input type="date" name="start_date" class="form-control form-control-sm select_tag_remove_box_sadow" placeholder="Profile Start Date" value="" id="start_date" onkeydown="return false" required="" >
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <input type="date" name="end_date" class="form-control form-control-sm select_tag_remove_box_sadow" placeholder="Profile End Date" value="" id="end_date" onkeydown="return false" required="" >
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <select class="custom-select" name="membership" id="membership">
                        <option value="" >Select Membership</option>
                        <option value="1" >Platinum</option>
                        <option value="2" >Gold</option>
                        <option value="3" >Silver</option>

                        </select>
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <select class="custom-select" name="location" id="location">
                        <option value="" selected="">Select Location</option>
                        <option value="1">Locations 1</option>
                        <option value="2">Locations 2</option>
                        <option value="3">Locations 3</option>
                        <option value="4">Locations 4</option>
                        <option value="5">Locations 5</option>
                        <option value="6">Locations 6</option>
                        <option value="7">Locations 7</option>
                        <option value="8">Locations 8</option>
                        <option value="9">Locations 9</option>
                        <option value="10">Locations 10</option>

                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <label></label> <label id="showCal"></label>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <button type="reset" id="reset_form">Reset</label>
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="pricing-detail" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
               <h5 class="modal-title">Edit Pricing Detail</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
         </div>

         <div class="modal-body pb-0 agent-tour">
            <form id="agent_bank" method="post" action="{{ route('agent.save.pricing.details')}}">
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
                        <input type="text " class="form-control" placeholder="%"  id="percentage" disabled>
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
                           <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
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
         search: "_INPUT_",
         searchPlaceholder: "Search",
         "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',

         oPaginate: {
         sNext: '<span aria-hidden="true">»</span>',
         sPrevious: '<span aria-hidden="true">«</span>',
         sFirst: '<span aria-hidden="true">»</span>',
         sLast: '<span aria-hidden="true">»</span>'
         }
      },
      info: false,
      bLengthChange: false,
      processing: true,
      serverSide: true,
      lengthChange: true,
      order: [1,'asc'],
      searchable:false,
      //searching:true,
      bStateSave: false,

      ajax: {
         url: "{{ route('agent.myPricing.dataTable') }}",
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
         // { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ]
   });


   var today = moment().format('YYYY-MM-DD');
   $("#start_date").attr({
      "min" : today,
      "value" : today,         // values (or variables) here
   });
   $("#end_date").attr({
      "min" : today,
      "value" : '',         // values (or variables) here
   });
   $("#commission-report").on("hidden.bs.modal", function (e) {
      console.log("Modal hidden");
      $("input[type=date]").val("");

      $("#start_date").attr({
         "min" : today,
         "value" : today,
      });
      $("#end_date").attr({
         "min" : today,
         "value" : '',
      });
      $("#membership").val("");
      $("#location").val("");
      $("#showCal").html("");
   });
   $('body').on('click','#reset_form', function(){
      $("input[type=date]").val("");

      $("#start_date").attr({
         "min" : today,
         "value" : today,
      });
      $("#end_date").attr({
         "min" : today,
         "value" : '',
      });
      $("#membership").val("");
      $("#location").val("");
      $("#showCal").html("");
   })
   $('body').on('change','#start_date', function(){
      $("#end_date").prop( "disabled", false );

      var val = $(this).val();

      var result = new Date(val);
      var ss = result.setDate(result.getDate() + 1);
      var first_date = moment(ss).format('YYYY-MM-DD');
      $("#end_date").val('');
      $("#membership").val('');
      $("#location").val('');
            $("#start_date").attr({
            "min" : val,
            "value" : val,         // values (or variables) here
            });
            $("#end_date").attr({
            "min" : first_date,
            "value" : first_date,         // values (or variables) here
            });
            //$('#start_date_tab').html(val);

            console.log(first_date);
            console.log(val);

   });
   $('body').on ('show.bs.modal', '#pricing-detail', function(event){
        button = $(event.relatedTarget);

        //$('.parsley-required').css('list-style-type', 'disc');
        //$("form #agent_bank").attr('autocomplete', 'on');
        const bank = $(button).data('name');
        if($(button).data('target') == "#commission-report") {
            $('#bank_name').attr('disabled',true);
        }

        $('#membershipname').val($(button).data('membershipname'));
        $('#pricingId').val($(button).data('id'));
        $('#price').val($(button).data('price'));
        $('#frequency').val($(button).data('frequency'));
        if($(button).data('membershipname') == 'Free') {
         $('#frequency').attr('disabled',false);

        } else {
         $('#frequency').attr('disabled',true);
        }
        $('#days').val($(button).data('days'));
        $('#percentage').val($(button).data('per'));
        $('#discount_amount').val($(button).data('discount_amount'));

        if($(button).data('discount_amount') != "N/A") {
         $('#ac_amount').val($(button).data('discount_amount'));
        }
      //   if($(button).data('percentage') == "N/A") {
      //    $('#ac_amount').val('0');
      //   }

        $('#bankId').val($(button).data('id'));
        console.log("target = ", button);
        //document.getElementById("bank_name").value = bank;
    });
   $('body').on('change','#membership', function()
   {
      //$("#membership").val('');
      $("#location").val('');
   });
   $('body').on('change','#end_date', function()
   {
      //$("#membership").val('');
      $("#location").val('');
   });
   $('body').on('change','#end_date2', function()
   {

      var val = $(this).val();

      var result = new Date(val);
      var ss = result.setDate(result.getDate() - 1);
      var first_date = moment(ss).format('YYYY-MM-DD');
            $("#end_date").attr({
            "min" : val,
            "value" : val,         // values (or variables) here
            });
            console.log(first_date);
            console.log(val);

   });
   $('body').on('change','#location', function()
   {
      var val = $(this).val();
      console.log("hello if",val);
      var end = new Date($("#end_date").val());
      var start = new Date($("#start_date").val());

      var ss = start.setDate(start.getDate());
      var first_date = moment(ss).format('YYYY-MM-DD');

      //var user_diff = end.getTime() - user_createdat.getTime();
      var diff = end.getTime() - start.getTime();
      var days = diff / (1000 * 3600 * 24);
      //var user_diff_days = user_diff / (1000 * 3600 * 24);
      var plan = $("#membership").val();
      var above_day = 0;
      if(plan == 1 ) {
            var actual_rate = 8;
            if(days <= 21) {
               var rate = 8;
            } else {
               var rate = 7.5;
               var dis_rate = 0.5;
            }
            var plan_name = "Platinum";
      } else if(plan == 2) {
            var actual_rate = 6;
            if(days <= 21) {
               var rate = 6;
            } else {
               var rate = 5.7;
               var dis_rate = 0.3;
            }
            var plan_name = "Gold";
      } else  {
            var actual_rate = 4;
            if(days <= 21) {
               var rate = 4;
            } else {
               var rate = 3.8;
               var dis_rate = 0.2;
            }
            var plan_name = "Silver";
      }
      if(days !== null && days <= 21) {

         var total_rate = days*rate;
         var dis = 0;
         //$('#rate_tab').html("$ "+rate.toFixed(2));
         //console.log("<=21");
      } else {
            var days_21 = 21*actual_rate;
            var above_day = days - 21;

            var total_rate = (above_day*rate + days_21);

            var dis = above_day*dis_rate;

            //$('#rate_tab').html("$ "+rate.toFixed(2));
            //console.log(">21"+days);
      }

   // $('#dis_tab').html("$ "+dis.toFixed(2));
   // $('#total_rate').html("$ "+total_rate.toFixed(2));

   $("#showCal").html("<b>Fee:</b> $"+total_rate.toFixed(2) +" </br><b>Days:</b> "+ days + " (21 Full Fee "+above_day+"  Discounted Fee) </br><b>Membership Type:</b> "+plan_name+ " ($"+rate+" per day) </br><b>Discount:</b> $"+dis.toFixed(2)+ "</br>");
   });

   $("#price").keyup(function(){
      var price = $(this).val();
      console.log("price = ", price);
      var per = $("#percentage").val();
      if(per != 'N/A') {
         var percent = price*per/100;
         var amount = price-percent;
         var per = $("#discount_amount").val(amount);
         $("#ac_amount").val(amount);
      } else {
         var per = $("#discount_amount").val('N/A');
         $("#ac_amount").val('');
      }

      console.log("ac price = ", price-percent);


   });
   $("body").on('submit','#agent_bank',function(e){
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
</script>
@endpush
