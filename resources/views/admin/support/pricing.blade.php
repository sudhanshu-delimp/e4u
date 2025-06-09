@extends('layouts.admin')
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
                        <div class="v-main-heading h3">Pricing summary</div>
                     </div>
                  </div>
                  <!-- /.container-fluid -->
                  <div class="row">
                     <div class="col-md-12">
                        <h2 class="primery_color normal_heading"><b>Escorts</b></h2>
                        <br>
                        <div id="accordion" class="myacording-design">
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                 Advertising
                                 </a>
                              </div>
                              <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                          <h5 class="price-sec  text-center font-weight-bold">Profile &amp; Tour Fees</h5>
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top: 2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; width: 212px; text-align: left;border-right: 1px solid #e3e6f0;" aria-label="
                                                      Profile Name">Days <sup>(1)</sup>
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; width: 212px;" aria-label="
                                                      Profile Name
                                                      ">Platinum
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; width: 158px;" aria-label="Date Created">Gold</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; width: 206px;" aria-label="Subscription Type">Silver</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; width: 222px;" aria-label="Subscription Status">Free</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center; width: 113px;" aria-label="Status">Pin Up<sup>(2)</sup></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td> 1 day<sup>(3)</sup></td>
                                                   <td style="text-align:center;"> $ 8.00 </td>
                                                   <td style="text-align:center;"> $ 6.00 </td>
                                                   <td style="text-align:center;"> $ 4.00 </td>
                                                   <td style="text-align:center;"> $ 0.00 </td>
                                                   <td style="text-align:center;"> N/A</td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 3 days </td>
                                                   <td style="text-align:center;"> $ 24.00 </td>
                                                   <td style="text-align:center;"> $ 18.00 </td>
                                                   <td style="text-align:center;"> $ 12.00 </td>
                                                   <td style="text-align:center;"> $ 0.00 </td>
                                                   <td style="text-align:center;">  N/A </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 7 days </td>
                                                   <td style="text-align:center;"> $ 52.00 </td>
                                                   <td style="text-align:center;"> $ 42.00 </td>
                                                   <td style="text-align:center;"> $ 28.00 </td>
                                                   <td style="text-align:center;"> $ 0.00 </td>
                                                   <td style="text-align:center;"> $ 475.00 </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 10 days </td>
                                                   <td style="text-align:center;"> $ 80.00 </td>
                                                   <td style="text-align:center;"> $ 60.00 </td>
                                                   <td style="text-align:center;"> $ 40.00 </td>
                                                   <td style="text-align:center;"> $ 0.00 </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 21 days </td>
                                                   <td style="text-align:center;"> $ 168.00 </td>
                                                   <td style="text-align:center;"> $ 126.00 </td>
                                                   <td style="text-align:center;"> $ 84.00 </td>
                                                   <td style="text-align:center;"> $ 0.00 </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 30 days <sup>(4)</sup> </td>
                                                   <td style="text-align:center;"> $ 235.50 </td>
                                                   <td style="text-align:center;"> $ 177.30 </td>
                                                   <td style="text-align:center;"> $ 118.20 </td>
                                                   <td style="text-align:center;">  N/A </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 60 days </td>
                                                   <td style="text-align:center;"> $ 460.50 </td>
                                                   <td style="text-align:center;"> $ 348.30 </td>
                                                   <td style="text-align:center;"> $ 232.20 </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                   <td style="text-align:center;"> N/A  </td>
                                                </tr>
                                                <tr role="row">
                                                   <td> 90 days </td>
                                                   <td style="text-align:center;"> $ 685.50 </td>
                                                   <td style="text-align:center;"> $ 519.30 </td>
                                                   <td style="text-align:center;"> $ 346.20 </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                   <td style="text-align:center;"> N/A </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>Discounts apply from day 22 for each Membership Type.</li>
                                                <li> Pin Up is a set weekly Fee.</li>
                                                <li> Pay by the day available.</li>
                                                <li>Free Membership no longer applies.</li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                 Other Fees & Concierge Services
                                 </a>
                              </div>
                              <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                          <h5 class="price-sec  text-center">Concierge Services & Support Services</h5>
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top: 2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px; border-right:1px solid #e3e6f0; text-align:left;" aria-label="Subscription Type">Service Type<sup>(1)</sup></th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px; border-right:1px solid #e3e6f0; text-align:center;" aria-label="Subscription Status">Fee</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px; text-align:center;" aria-label="Status">Frequency</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td>NUM Notification </td>
                                                   <td style="text-align:center;">$ 5.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Support Services(2) </td>
                                                   <td style="text-align:center;">$ 50.00 </td>
                                                   <td style="text-align:center;">Per service</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Verified Media(3) </td>
                                                   <td style="text-align:center;">$ 10.00 </td>
                                                   <td style="text-align:center;">Per service, up to 7 photos</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Mobile SIM </td>
                                                   <td style="text-align:center;">$ 85.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Email account </td>
                                                   <td style="text-align:center;">$ 20.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>An Escort can engage an Agent to undertake any of the Services, otherwise Escorts4U will assist Escorts with support. A Fee applies.</li>
                                                <li>Includes any services that Escorts4U undertakes for the Escort, that the Escort could have completed themself online.</li>
                                                <li>Subject to Membership Type. Platinum Membership includes Verified Media.</li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#other_fees_concierge_services" aria-expanded="false">
                                 Discounts
                                 </a>
                              </div>
                              <div id="other_fees_concierge_services" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                          <h5 class="price-sec  text-center">Concierge Services & Support Services</h5>
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top: 2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px; text-align:left; border-right:1px solid #e3e6f0;" aria-label="Status">Membership Type<sup>(1)</sup></th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px; text-align:center; border-right:1px solid #e3e6f0;" aria-label="Status">Standard Fee</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px; text-align:center;" aria-label="Status">Discounted Fee<sup>(2)</sup></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td>Platinum</td>
                                                   <td style="text-align:center">$ 8.00</td>
                                                   <td style="text-align:center">$ 7.50</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Gold</td>
                                                   <td style="text-align:center">$ 6.00</td>
                                                   <td style="text-align:center">$ 5.70</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Silver </td>
                                                   <td style="text-align:center">$ 4.00</td>
                                                   <td style="text-align:center">$ 3.80</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>Discounts only apply to single transactions.</li>
                                                <li>Discount applies to a Profile or Tour from day 22.</li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram" aria-expanded="false">
                                 Loyalty Program
                                 </a>
                              </div>
                              <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <p>For every $200.00 spent by an Escort, Escorts4U will apply one day of free advertising. When creating your Profile or Tour, the program is automatically applied.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <h2 class="primery_color normal_heading mt-5 mb-4 pb-2"><b>Massage Centre</b></h2>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Advertising" aria-expanded="false">
                                 Advertising
                                 </a>
                              </div>
                              <div id="Advertising" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                          <h5 class="price-sec  text-center">Profile Fees</h5>
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top:2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:left; border-right:1px solid #e3e6f0; width: 212px;" aria-label="
                                                      Profile Name">Days <sup>(1)</sup>
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; border-right:1px solid #e3e6f0; width: 212px;" aria-label="
                                                      Profile Name
                                                      ">1
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; border-right:1px solid #e3e6f0; width: 158px;" aria-label="Date Created">21</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; border-right:1px solid #e3e6f0; width: 206px;" aria-label="Subscription Type">22<sup>(2)</sup></th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; width: 222px;" aria-label="Subscription Status">30</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td>Fee</td>
                                                   <td style="text-align:center;"> $ 30.00</td>
                                                   <td style="text-align:center;"> $ 630.00</td>
                                                   <td style="text-align:center;"> $ 658.50</td>
                                                   <td style="text-align:center;"> $ 801.00</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>Pay by the day available. Pin Up is not available to Massage Centres.</li>
                                                <li>A discount of 5% is applied from day 22 on single transactions only. Daily rate after discount is
                                                   applied is $28.50 per day.
                                                </li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#other-fees" aria-expanded="false">
                                 Other Fees & Concierge Services
                                 </a>
                              </div>
                              <div id="other-fees" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                          <h5 class="price-sec text-center">Concierge Services &amp; Support Services</h5>
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top:2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:left; border-right:1px solid #e3e6f0;width: 206px;" aria-label="Subscription Type">Service Type<sup>(1)</sup></th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; border-right:1px solid #e3e6f0;width: 222px;" aria-label="Subscription Status">Fee</th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align:center; width: 113px;" aria-label="Status">Frequency</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td>NUM Notification </td>
                                                   <td style="text-align:center;">$ 5.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Support Services(2) </td>
                                                   <td style="text-align:center;">$ 50.00 </td>
                                                   <td style="text-align:center;">Per service</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Verified Media(3) </td>
                                                   <td style="text-align:center;">$ 10.00 </td>
                                                   <td style="text-align:center;">Per service, up to 7 photos</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Mobile SIM </td>
                                                   <td style="text-align:center;">$ 85.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                                <tr role="row">
                                                   <td>Email account </td>
                                                   <td style="text-align:center;">$ 20.00 </td>
                                                   <td style="text-align:center;">Per month</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>An Massage Centre can engage an Agent to undertake any of the Services, otherwise Escorts4U will assist a Massage Centre with support. A Fee applies.</li>
                                                <li>Includes any services that Escorts4U undertakes for the Massage Centre, that the Massage Centre could have completed itself online.</li>
                                                <li>Fee applies to each Masseur. Membership includes Verified Media for the Massage Centre.</li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#Loyalty" aria-expanded="false">
                                 Loyalty Program
                                 </a>
                              </div>
                              <div id="Loyalty" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <p>For every $500.00 spent by a Massage Centre, Escorts4U will apply one day of free advertising. When creating your Profile, the program is automatically applied.</p>
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