@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
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
               <h1 class="h1">Set Fees & Variables for UAdvertisers</h1>
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
                                          <li>Advertising Fees</li>
                                          <li>Concierge Services</li>
                                          <li>Support Services</li>
                                       </ol>
                           </li>
                           <li>
                           There is a loyalty program which applies to Advertisers.
                           </li>
                           <li>
                           There are a range of variables that determine:
                           <ol class="level-2">
                                          <li>Discounts to Adverting Fees</li>
                                          <li>Loyalty Program entitlements and discounts</li>
                                          <li>Agent Commission</li>
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
                                 <table class="table table-bordered membership-table mt-3">
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
                                       <tr>
                                       <td class="text-center">10</td>
                                       <td class="text-left">Travel</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 75.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Concierge_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                       </tr>
                                       <tr>
                                       <td class="text-center">11</td>
                                       <td class="text-left">Accommodation</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 75.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Concierge_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                       </tr>
                                       <tr>
                                       <td class="text-center">12</td>
                                       <td class="text-left">Mobile SIM</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 75.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Concierge_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                       </tr>
                                       <tr>
                                       <td class="text-center">13</td>
                                       <td class="text-left">Email Account</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 75.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Concierge_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                       </tr>
                                       <tr>
                                       <td class="text-center">14</td>
                                       <td class="text-left">Visa Migration & Education Placement</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 75.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Concierge_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                       </tr>
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
                              <table class="table table-bordered membership-table mt-3">
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
                                    <tr>
                                       <td class="text-center">20</td>
                                       <td class="text-left">Create Profile</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 50.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">21</td>
                                       <td class="text-left">Edit Profile</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 20.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">22</td>
                                       <td class="text-left">Create Tour</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 50.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">23</td>
                                       <td class="text-left">Edit Tour</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 20.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">24</td>
                                       <td class="text-left">Upload Media (for verification)</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 20.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">25</td>
                                       <td class="text-left">Complete Media Verification (excluding Platinum)</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 10.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">26</td>
                                       <td class="text-left">Complete Profile Information</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 30.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">27</td>
                                       <td class="text-left">Organise Profiles and Media in Archives</td>
                                       <td class="text-center">per Service</td>
                                       <td class="text-center">$ 50.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Support_Services"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
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
                              <table class="table table-bordered membership-table mt-3">
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
                                    <tr>
                                       <td class="text-center">30</td>
                                       <td class="text-left">Escorts</td>
                                       <td class="text-center">P, G, S</td>
                                       <td class="text-left">Spend</td>
                                       <td class="text-center">$ 200.00</td>
                                       <td class="text-center">1</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">31</td>
                                       <td class="text-left">Massage Centre</td>
                                       <td class="text-center">MC</td>
                                       <td class="text-left">Spend</td>
                                       <td class="text-center">$ 500.00</td>
                                       <td class="text-center">1</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
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
                              <table class="table table-bordered membership-table mt-3">
                                 <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Description</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Value</th>
                                       <th class="text-center">
                                          Action
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="text-center">40</td>
                                       <td class="text-left">Commission - Advertising</td>
                                       <td class="text-center">per day</td>
                                       <td class="text-center">5.00%</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Agent_Operator"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">41</td>
                                       <td class="text-left">Commission - Massage Centre sign up</td>
                                       <td class="text-center">per Registration</td>
                                       <td class="text-center">$ 20.00</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Agent_Operator"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="text-center">42</td>
                                       <td class="text-left">Commission - Operator</td>
                                       <td class="text-center">per day</td>
                                       <td class="text-center">2.00%</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Agent_Operator"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
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
                              <table class="table table-bordered membership-table mt-3">
                                 <thead class="bg-first text-center">
                                    <tr>
                                       <th class="text-center">Item</th>
                                       <th class="text-left">Description</th>
                                       <th class="text-center">Rate</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="text-center">50</td>
                                       <td class="text-left">Earnings portion - Escort</td>
                                       <td class="text-center">10%</td>
                                       <td class="text-center"> 
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#playbox"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
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
               <h5 class="modal-title">Edit Pricing Detail</h5>
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
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Edit_Competitor">Set Variables - Loyalty Program Advertisers</h5>
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
            <button type="button" class="btn btn-primary">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Concierge_Services" tabindex="-1" role="dialog" aria-labelledby="Concierge_ServicesLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Concierge_Services">Set Fees - Concierge Services</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <label>Fee</label>
                     <input type="text" class="form-control rounded-0" value="Travel">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Rate</label>
                     <input type="text" class="form-control rounded-0" value="Per Service">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Amount</label>
                     <input type="text" class="form-control rounded-0" value="$ 75.00">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Support_Services" tabindex="-1" role="dialog" aria-labelledby="Support_ServicesLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Support_Services">Set Fees - Support Services (E4U Staff)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <label>Fee</label>
                     <input type="text" class="form-control rounded-0" value="Travel">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Rate</label>
                     <input type="text" class="form-control rounded-0" value="Per Service">
                  </div>
                  <div class="col-6 mb-3">
                     <label>Amount</label>
                     <input type="text" class="form-control rounded-0" value="$ 75.00">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Agent_Operator" tabindex="-1" role="dialog" aria-labelledby="Agent_OperatorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Operator">Set Variables - Agent & Operator</h5>
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
            <button type="button" class="btn btn-primary">Save &amp; Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="playbox" tabindex="-1" role="dialog" aria-labelledby="playboxLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="playbox">Set Commission - Playbox</h5>
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
            <button type="button" class="btn btn-primary">Save &amp; Update</button>
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
         search: "_INPUT_",
         searchPlaceholder: "Search",
         "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',

         oPaginate: {
         sNext: '<span aria-hidden="true">Next</span>',
         sPrevious: '<span aria-hidden="true">Previous</span>',
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


   var today = moment().format('YYYY-MM-DD');
   // $("#start_date").attr({
   //    "min" : today,
   //    "value" : today,         // values (or variables) here
   // });
   // $("#end_date").attr({
   //    "min" : today,
   //    "value" : '',         // values (or variables) here
   // });
   // $("#commission-report").on("hidden.bs.modal", function (e) {
   //    console.log("Modal hidden");
   //    $("input[type=date]").val("");

   //    $("#start_date").attr({
   //       "min" : today,
   //       "value" : today,
   //    });
   //    $("#end_date").attr({
   //       "min" : today,
   //       "value" : '',
   //    });
   //    $("#membership").val("");
   //    $("#location").val("");
   //    $("#showCal").html("");
   // });
   // $('body').on('click','#reset_form', function(){
   //    $("input[type=date]").val("");

   //    $("#start_date").attr({
   //       "min" : today,
   //       "value" : today,
   //    });
   //    $("#end_date").attr({
   //       "min" : today,
   //       "value" : '',
   //    });
   //    $("#membership").val("");
   //    $("#location").val("");
   //    $("#showCal").html("");
   // })
   // $('body').on('change','#start_date', function(){
   //    $("#end_date").prop( "disabled", false );

   //    var val = $(this).val();

   //    var result = new Date(val);
   //    var ss = result.setDate(result.getDate() + 1);
   //    var first_date = moment(ss).format('YYYY-MM-DD');
   //    $("#end_date").val('');
   //    $("#membership").val('');
   //    $("#location").val('');
   //          $("#start_date").attr({
   //          "min" : val,
   //          "value" : val,         // values (or variables) here
   //          });
   //          $("#end_date").attr({
   //          "min" : first_date,
   //          "value" : first_date,         // values (or variables) here
   //          });
   //          //$('#start_date_tab').html(val);

   //          console.log(first_date);
   //          console.log(val);

   // });
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
   // $('body').on('change','#membership', function()
   // {
   //    //$("#membership").val('');
   //    $("#location").val('');
   // });
   // $('body').on('change','#end_date', function()
   // {
   //    //$("#membership").val('');
   //    $("#location").val('');
   // });
   // $('body').on('change','#end_date2', function()
   // {

   //    var val = $(this).val();

   //    var result = new Date(val);
   //    var ss = result.setDate(result.getDate() - 1);
   //    var first_date = moment(ss).format('YYYY-MM-DD');
   //          $("#end_date").attr({
   //          "min" : val,
   //          "value" : val,         // values (or variables) here
   //          });
   //          console.log(first_date);
   //          console.log(val);

   // });
   // $('body').on('change','#location', function()
   // {
   //    var val = $(this).val();
   //    console.log("hello if",val);
   //    var end = new Date($("#end_date").val());
   //    var start = new Date($("#start_date").val());

   //    var ss = start.setDate(start.getDate());
   //    var first_date = moment(ss).format('YYYY-MM-DD');
   //    var diff = end.getTime() - start.getTime();
   //    var days = diff / (1000 * 3600 * 24);
   //    var plan = $("#membership").val();
   //    var above_day = 0;
   //    if(plan == 1 ) {
   //          var actual_rate = 8;
   //          if(days <= 21) {
   //             var rate = 8;
   //          } else {
   //             var rate = 7.5;
   //             var dis_rate = 0.5;
   //          }
   //          var plan_name = "Platinum";
   //    } else if(plan == 2) {
   //          var actual_rate = 6;
   //          if(days <= 21) {
   //             var rate = 6;
   //          } else {
   //             var rate = 5.7;
   //             var dis_rate = 0.3;
   //          }
   //          var plan_name = "Gold";
   //    } else  {
   //          var actual_rate = 4;
   //          if(days <= 21) {
   //             var rate = 4;
   //          } else {
   //             var rate = 3.8;
   //             var dis_rate = 0.2;
   //          }
   //          var plan_name = "Silver";
   //    }
   //    if(days !== null && days <= 21) {

   //       var total_rate = days*rate;
   //       var dis = 0;
   //    } else {
   //          var days_21 = 21*actual_rate;
   //          var above_day = days - 21;

   //          var total_rate = (above_day*rate + days_21);

   //          var dis = above_day*dis_rate;

   //    }

   // $("#showCal").html("<b>Fee:</b> $"+total_rate.toFixed(2) +" </br><b>Days:</b> "+ days + " (21 Full Fee "+above_day+"  Discounted Fee) </br><b>Membership Type:</b> "+plan_name+ " ($"+rate+" per day) </br><b>Discount:</b> $"+dis.toFixed(2)+ "</br>");
   // });

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
