@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content end here-->
   <div class="row">
      <div class="col-md-12 pl-0">
         <div class="v-main-heading h3">Commission Statement</div>
      </div>
      <div class="col-md-12 mt-4">
         <div class="row">
            <div class="col-md-9 pl-0">
               <div id="accordion" class="myacording-design">
                  <div class="card">
                     <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#Abbreviations" aria-expanded="false">
                        Notes
                        </a>
                     </div>
                     <div id="Abbreviations" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body pb-0">
                           <div class="accodien_manage_padding_content">
                              
                              <ol class="pl-3 mb-0">
                                 <li>
                                    The following definitions are from the Agent Agreement and apply for the purpose of calculating Commission:
                                    <ul class="pt-2 mt-1 list-new" style="
">
                                       <li><b>Billing Period</b> means each billing period as provided for in clause 5.4 (monthly ending on the 27th on each month).</li>
                                       <li class="d-flex"> <span><b>Commission</b> means the total sum of commission, if any, which are earned by an Agent in a Billing Period in relation to all Users and calculated in accordance with clause 5 and the Commission Details (Second Schedule).</span></li>
                                       <li><b>Commission Report</b> means the summary of business activity of Users which have appointed the Agent.</li>
                                    </ul>
                                 </li>
                                 <li class="mb-0">
                                    Commission will be paid to you within three (3) Business Days of the Commission Report having been provided to you, provided you have:
                                    <ul class="pt-2 mt-1 list-new">
                                       <li>Confirmed the correctness of the Commission Report within the 3 days; and</li>
                                       <li>There are no amendments you have requested;</li>
                                       <li class="d-flex">Where any amendments are made to the Commission Report, and the amendments are agreed to within three (3) Business days, then the amended Commission value will be paid within three (3) Business Days of the Commission Report; otherwise
                                       </li>
                                       <li class="d-flex">the amended Commission Report will be paid within seven (7) Business
                                          Days of the amended Commission Report having been agreed to by the
                                          Agent and E4U.
                                       </li>
                                    </ul>
                                 </li>
                                 <li class="mb-0">All Commission paid to you under the Agent Agreement will be paid into your
                                    nominated Bank Account. Commission is inclusive of GST.
                                 </li>
                                 <li class="mb-0">Any queries regarding Commission must be raised by logging a <a href="http://localhost/e4u/public/agent-dashboard/submitticket" class="termsandconditions_text_color text-decoration-none">Support Ticket</a> with
                                    E4U.
                                 </li>
                              </ol>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-2 pb-2">
            <div class="col-md-6 mb-2 pl-0">
               <div class="card Summary">
                  <div class="card-body pb-0">
                     <p><b>Agent Details</b> </p>
                     <ul class="mb-2">
                        <li class="text-capitalize"><b style="color: #5D6D7E;">Name:</b>Well Done Accounts</li>
                        <li><b style="color: #5D6D7E;">Contact:</b>Ava Lopez</li>
                        <li><b style="color: #5D6D7E;">ABN:</b>83 517 839 569</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-9 pl-0 mt-2">
               <div class="table-responsive-xl">
                  <table class="table">
                     <thead class="table-bg">
                        <tr>
                           <th scope="col">Date</th>
                           <th scope="col">Billing Period</th>
                           <th scope="col">Agent ID</th>
                           <th scope="col">Territory</th>
                           <th scope="col">Commission</th>
                           <th scope="col">Status</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <tr class="row-color">
                           <td class="theme-color">28-06-22</td>
                           <td class="theme-color">28-05-22 to 27-06-22</td>
                           <td class="theme-color">A600025</td>
                           <td class="theme-color">WA</td>
                           <td class="theme-color">$ 5,678.50</td>
                           <td class="theme-color">Approved</td>
                           <td class="theme-color">
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#">Approve</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#commission-report">View Report</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        <tr class="row-color">
                           <td class="theme-color">28-06-22</td>
                           <td class="theme-color">28-05-22 to 27-06-22</td>
                           <td class="theme-color">A600025</td>
                           <td class="theme-color">WA</td>
                           <td class="theme-color">$ 5,678.50</td>
                           <td class="theme-color">Pending</td>
                           <td class="theme-color">
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#">Approve</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#commission-report">View Report</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <nav aria-label="Page navigation example">
                     <ul class="pagination float-right pt-4">
                        <li class="page-item">
                           <a class="page-link" href="#" aria-label="Previous">
                           <span aria-hidden="true">«</span>
                           <span class="sr-only">Previous</span>
                           </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                           <a class="page-link" href="#" aria-label="Next">
                           <span aria-hidden="true">»</span>
                           <span class="sr-only">Next</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 886px !important;">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="commission-report">Commission Report (Period Ending 27-06-2022)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="row">
               <div class="col-md-12">
                  <div class="card mb-3">
                     <div class="card-body pb-0">
                        <p class="mb-1"><b>Notes</b> </p>
                        <ol class="pl-3">
                           <li style="font-size: 14px;">Membership levels: <span class="ml-4">P = Platinum</span>  <span class="ml-4">G = Gold</span>   <span class="ml-4">S = Silver</span>   <span class="ml-4">PU = Pin Up</span>   <span class="ml-4">F = Fixed daily rate</span>
                           </li>
                           <li class="mb-0" style="font-size: 14px;">Rates (Daily): <span class="ml-4"> P = $ 8.00 </span>  <span class="ml-4">G = $ 6.00</span>  <span class="ml-4"> S = $4.00 </span>  <span class="ml-4">F = $ 30.00  </span> 
                             <span class="ml-4"> (Weekly):  PU = $ 475.00 </span>
                           </li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
<div class="table-responsive-xl">
               <table class="table commission-table">
                  <thead class="table-bg">
                     <tr>
                        <th scope="col">Member ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Territory</th>
                        <th scope="col">Level 1 <sup>(1)</sup></th>
                        <th scope="col">Days</th>
                        <th scope="col">Value <sup>(2)</sup></th>
                        <th scope="col">Commission</th>
                     </tr>
                  </thead>
<tbody class="table-content">
   <tr class="row-color">
      <td class="theme-color">E612344</td>
      <td class="theme-color">Oxe Daisy</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">P</td>
      <td class="theme-color">22</td>
      <td class="theme-color">$ 176.00</td>
      <td class="theme-color">$ 8.80</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">G</td>
      <td class="theme-color">4</td>
      <td class="theme-color">$ 24.00</td>
      <td class="theme-color">$ 1.20</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">S</td>
      <td class="theme-color">2</td>
      <td class="theme-color">$ 8.00</td>
      <td class="theme-color">$ 0.40</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">PU</td>
      <td class="theme-color">7</td>
      <td class="theme-color">$ 475.00</td>
      <td class="theme-color">$ 23.75</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td colspan="1"><b>Totals</b></td>
      <td class="commission-border">35</td>
      <td class="commission-border">$ 683.00</td>
      <td class="commission-border">$ 34.15</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">E612351</td>
      <td class="theme-color">Rose Chaplin</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">P</td>
      <td class="theme-color">22</td>
      <td class="theme-color">$ 176.00</td>
      <td class="theme-color">$ 8.80</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">G</td>
      <td class="theme-color">4</td>
      <td class="theme-color">$ 24.00</td>
      <td class="theme-color">$ 1.20</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">S</td>
      <td class="theme-color">2</td>
      <td class="theme-color">$ 8.00</td>
      <td class="theme-color">$ 0.40</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">PU</td>
      <td class="theme-color">7</td>
      <td class="theme-color">$ 475.00</td>
      <td class="theme-color">$ 23.75</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td colspan="1"><b>Totals</b></td>
      <td class="commission-border">35</td>
      <td class="commission-border">$ 683.00</td>
      <td class="commission-border">$ 34.15</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">E612366</td>
      <td class="theme-color">Marry Smith</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">P</td>
      <td class="theme-color">22</td>
      <td class="theme-color">$ 176.00</td>
      <td class="theme-color">$ 8.80</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">G</td>
      <td class="theme-color">4</td>
      <td class="theme-color">$ 24.00</td>
      <td class="theme-color">$ 1.20</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">S</td>
      <td class="theme-color">2</td>
      <td class="theme-color">$ 8.00</td>
      <td class="theme-color">$ 0.40</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color"> </td>
      <td class="theme-color">PU</td>
      <td class="theme-color">7</td>
      <td class="theme-color">$ 475.00</td>
      <td class="theme-color">$ 23.75</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td colspan="1"><b>Totals</b></td>
      <td class="commission-border">35</td>
      <td class="commission-border">$ 683.00</td>
      <td class="commission-border">$ 34.15</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td class=" " colspan="1"><b>Total Escorts</b></td>
      <td class="commission-border commission-border-double">105</td>
      <td class="commission-border commission-border-double">$ 2,049.00</td>
      <td class="commission-border commission-border-double">$ 102.45</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">M612380</td>
      <td class="theme-color">Lin’s Massage</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">F</td>
      <td class="theme-color">30</td>
      <td class="theme-color">$ 900.00</td>
      <td class="theme-color">$ 45.00</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">M612380</td>
      <td class="theme-color">Lin’s Massage</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">F</td>
      <td class="theme-color">30</td>
      <td class="theme-color">$ 900.00 </td>
      <td class="theme-color">$ 45.00</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">M612380</td>
      <td class="theme-color">Lin’s Massage</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">F</td>
      <td class="theme-color">30</td>
      <td class="theme-color">$ 900.00</td>
      <td class="theme-color">$ 45.00</td>
   </tr>
   <tr class="row-color">
      <td class="theme-color">M612380</td>
      <td class="theme-color">Lin’s Massagey</td>
      <td class="theme-color">WA</td>
      <td class="theme-color">F</td>
      <td class="theme-color">30</td>
      <td class="theme-color">$ 900.00</td>
      <td class="theme-color">$ 45.00</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td class=" " colspan="1"><b>Total Massage Centres:</b></td>
      <td class="commission-border commission-border-double">120</td>
      <td class="commission-border commission-border-double">$ 3,600.00</td>
      <td class="commission-border commission-border-double">$ 180.00</td>
   </tr>
   <tr class="commission-color">
      <td class="border-0" colspan="3"></td>
      <td class=" " colspan="1"><b>Total Advertisers:</b></td>
      <td class="commission-border commission-border-double">225</td>
      <td class="commission-border commission-border-double">$ 5,649.00</td>
      <td class="commission-border commission-border-double">$ 282.45</td>
   </tr>
</tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer pt-0">
            <button type="button" class="btn btn-primary">Query</button>
            <button type="button" class="btn btn-primary">Approve</button>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush