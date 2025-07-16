@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<style type="text/css">
   .table td, .table th {
   padding: 0.4rem;}
</style>
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">Commission Summary</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li style="font-size: 15px;">You can apply filters within the Commission Summary to suit your query or report type</li>
                  <li style="font-size: 15px;" class="mb-0">All Commission paid to you under the Agent Agreement will be paid into your nominated Bank Account. Commission is inclusive of GST.</li>
               
               </ol>
            </div>
         </div>
      </div>
      <div class="col-md-6">
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
      <div class="col-md-12 mt-4">
         <ul class="nav nav-tabs tab-sec">
            <li class="active"><a href="#one" data-toggle="tab" class="active">Commission Summary (YoY)</a></li>
            <li><a href="#two" data-toggle="tab" class="">Commission Summary (Advertiser)</a></li>
         </ul>
      </div>
      <div class="col-md-12 mt-4">
         <div class="w-100">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card mb-4 border-0">
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
                           <div class="table-responsive-xl mb-5">
                              <table class="table table-bordered total-summary text-right">
                                 <tbody>
                                    <tr>
                                       <td colspan="1"><b>Period:</b></td>
                                       <td colspan="3" class="text-center" style="color: #0000ff;">
                                          <select class="rounded-0 w-75" style="color: #0000ff;">
                                             <option class="text-secondary">Select Date</option>
                                             <option class="text-secondary">2022</option>
                                             <option class="text-secondary">2023</option>
                                             <option class="text-secondary">2024</option>
                                             <option class="text-secondary">2025</option>
                                          </select>
                                       </td>
                                       <td class="text-center" colspan="3"><b>This Week</b></td>
                                       <td class="text-center" colspan="3">
                                          <b>FY </b> 
                                          <span style="color: #0000ff;" class="ml-5">
                                             <select class="rounded-0 w-50" style="color: #0000ff;">
                                                <option class="text-secondary">2021</option>
                                                <option class="text-secondary">2022</option>
                                                <option class="text-secondary">2023</option>
                                                <option class="text-secondary">2024</option>
                                                <option class="text-secondary">2025</option>
                                             </select>
                                          </span>
                                       </td>
                                       <td colspan="2" class="text-center"><b>YoY<sup>(1)</sup> Growth</b>   </td>
                                       <td colspan="3" class="text-center">
                                          <b>
                                             FY 
                                             <span class="ml-5" style="color: #0000ff;">
                                                <select class="rounded-0 w-50" style="color: #0000ff;">
                                                   <option class="text-secondary">2021</option>
                                                   <option class="text-secondary">2022</option>
                                                   <option class="text-secondary">2023</option>
                                                   <option class="text-secondary">2024</option>
                                                   <option class="text-secondary">2025</option>
                                                </select>
                                             </span>
                                          </b>
                                       </td>
                                    </tr>
                                    <tr class="text-left">
                                       <td colspan="15"><b>Total Summary</b></td>
                                    </tr>
                                    <tr class="text-center">
                                       <td class="text-right pt-5" rowspan="2"><b>Variables</b></td>
                                       <td class="text-center" colspan="3"><b>20/07/2022</b></td>
                                       <td class="text-center" colspan="1"><b>Average</b></td>
                                       <td colspan="2"><b>Cumulative</b></td>
                                       <td colspan="1"><b>Average</b></td>
                                       <td colspan="2"><b>Cumulative  </b>   </td>
                                       <td><b>Com %</b></td>
                                       <td><b>No Units</b></td>
                                       <td colspan="1"><b>Average</b></td>
                                       <td colspan="2"><b>Cumulative</b></td>
                                    </tr>
                                    <tr>
                                       <td>Spend</td>
                                       <td class="bg-white">5%</td>
                                       <td style="background: #cccccc54;">No.</td>
                                       <td colspan="3">1810712022 to 24/07/2022</td>
                                       <td colspan="3">Year to Date</td>
                                       <td colspan="2">Year to Date</td>
                                       <td colspan="3">Year to Date</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Advertising Escorts</td>
                                       <td>$ 307.86</td>
                                       <td>$ 15.39</td>
                                       <td>36</td>
                                       <td>$ 17.19</td>
                                       <td>$ 51.57</td>
                                       <td>124</td>
                                       <td>$ 16.19</td>
                                       <td>$ 323.80</td>
                                       <td>765</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a> 7.0%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a> 7.4%
                                       </td>
                                       <td>$ 17.40</td>
                                       <td>$ 347.64</td>
                                       <td>826</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Advertising Massage Centres</td>
                                       <td>$ 1,200.00</td>
                                       <td>$ 60.00</td>
                                       <td>40</td>
                                       <td>$ 207.00</td>
                                       <td>$ 621.00</td>
                                       <td>138</td>
                                       <td>$ 195.00</td>
                                       <td>$ 3,900.00</td>
                                       <td>2,600</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>13.3%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>13.3%
                                       </td>
                                       <td>$ 225.00</td>
                                       <td>$ 4,500.00</td>
                                       <td>3,000</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Registrations</td>
                                       <td>$ 0.00</td>
                                       <td>$ 40.00</td>
                                       <td>2</td>
                                       <td>$ 53.00</td>
                                       <td>$ 160.00</td>
                                       <td>8</td>
                                       <td>$ 48.00</td>
                                       <td>$ 960.00</td>
                                       <td>640</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>18.8%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>15.8%
                                       </td>
                                       <td>$ 57.00</td>
                                       <td>$ 1,140.00</td>
                                       <td>760</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right"><b>Total Earned</b></td>
                                       <td><b>$ 1,507.86</b></td>
                                       <td><b>$ 115.39</b></td>
                                       <td><b>78</b></td>
                                       <td><b>$ 277.19</b></td>
                                       <td><b>$ 832.57</b></td>
                                       <td><b>270</b></td>
                                       <td><b>$ 259.19</b></td>
                                       <td><b>$ 5183.80</b></td>
                                       <td><b>4,005</b></td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a><b>13.4%</b>
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a><b>12.7%</b>
                                       </td>
                                       <td><b>$ 299.40</b></td>
                                       <td><b>$ 5 987.64</b></td>
                                       <td><b>4,586</b></td>
                                    </tr>
                                    <tr class="text-left">
                                       <td colspan="15"><b>Escorts Summary</b></td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Platinum</td>
                                       <td>$ 160.00</td>
                                       <td>$ 8.00</td>
                                       <td>20</td>
                                       <td>$ 9.20</td>
                                       <td>$ 27.60</td>
                                       <td>69</td>
                                       <td>$ 8.70</td>
                                       <td>$ 174.00</td>
                                       <td>435</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>6.5%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>5.4%
                                       </td>
                                       <td>$ 9.30</td>
                                       <td>$ 186.00</td>
                                       <td>460</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Gold</td>
                                       <td>$ 60.00</td>
                                       <td>$ 3.00</td>
                                       <td>10</td>
                                       <td>$ 3.45</td>
                                       <td>$ 10.35</td>
                                       <td>35</td>
                                       <td>$ 3.00</td>
                                       <td>$ 60.00</td>
                                       <td>200</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>14.3%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>14.2%
                                       </td>
                                       <td>$ 3.52</td>
                                       <td>$ 70.04</td>
                                       <td>233</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Silver</td>
                                       <td>$ 20.00</td>
                                       <td>$ 1.00</td>
                                       <td>5</td>
                                       <td>$ 1.15</td>
                                       <td>$ 3.45</td>
                                       <td>17</td>
                                       <td>$ 1.10</td>
                                       <td>$ 22.00</td>
                                       <td>110</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>7.7%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a>2.7%
                                       </td>
                                       <td>$ 1.19</td>
                                       <td>$ 23.80</td>
                                       <td>113</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Pin-Up</td>
                                       <td>$ 67.86</td>
                                       <td>$ 3.39</td>
                                       <td>1</td>
                                       <td>$ 3.39</td>
                                       <td>$ 10.17</td>
                                       <td>3</td>
                                       <td>$ 3.39</td>
                                       <td>$ 67.80</td>
                                       <td>20</td>
                                       <td><a href="#">
                                          <i class="fas fa-minus mr-3 text-warning"></i>
                                          </a>0.00%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-minus mr-3 text-warning"></i>
                                          </a>0.0%
                                       </td>
                                       <td>$ 3.39</td>
                                       <td>$ 67.80</td>
                                       <td>20</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right"><b>Total Spend / Earnings</b></td>
                                       <td><b>$ 307.86</b></td>
                                       <td><b>$ 15.39</b></td>
                                       <td><b>36</b></td>
                                       <td><b>$ 17.19</b></td>
                                       <td><b>$ 51.57</b></td>
                                       <td><b>124</b></td>
                                       <td><b>$ 16.19</b></td>
                                       <td><b>$ 323.80</b></td>
                                       <td><b>765</b></td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a><b>6.9%</b>
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-down mr-4 text-danger"></i>
                                          </a><b>7.4%</b>
                                       </td>
                                       <td><b>$ 17.40</b></td>
                                       <td><b>$ 347.64</b></td>
                                       <td><b>826</b></td>
                                    </tr>
                                    <tr class="text-left">
                                       <td colspan="17"><b>Massage Center Summary</b></td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Advertising</td>
                                       <td>$ 1,200.00</td>
                                       <td>$ 60.00</td>
                                       <td>40</td>
                                       <td>$ 207.00</td>
                                       <td>$ 621.00</td>
                                       <td>138</td>
                                       <td>$ 195.00</td>
                                       <td>$ 3,900.00</td>
                                       <td>2,600</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>13.3%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>13.3%
                                       </td>
                                       <td>$ 225.00</td>
                                       <td>$ 4,500.00</td>
                                       <td>3,000</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right">Registrations</td>
                                       <td>$ 0.00</td>
                                       <td>$40.00</td>
                                       <td>2</td>
                                       <td>s53.00</td>
                                       <td>$ 160.00</td>
                                       <td>8</td>
                                       <td>$48.00</td>
                                       <td>$ 960.00</td>
                                       <td>640</td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>18.8%
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a>15.8%
                                       </td>
                                       <td>557.00</td>
                                       <td>$ 1,140.00</td>
                                       <td>760</td>
                                    </tr>
                                    <tr>
                                       <td class="text-right"><b>Total Spend / Earnings</b></td>
                                       <td><b>$ 1,200.00</b></td>
                                       <td><b>$ 100.00</b></td>
                                       <td><b>42</b></td>
                                       <td><b>$ 260.00</b></td>
                                       <td><b>$781.00</b></td>
                                       <td><b>146</b></td>
                                       <td><b>$243.00</b></td>
                                       <td><b>$4,860.00</b></td>
                                       <td><b>3,240</b></td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a><b>13.8%</b>
                                       </td>
                                       <td><a href="#">
                                          <i class="fas fa-long-arrow-alt-up mr-4 text-success"></i>
                                          </a><b>13.8%</b>
                                       </td>
                                       <td><b>$ 282.00</b></td>
                                       <td><b>$ 5,640.00</b></td>
                                       <td><b>3,760</b></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                           <div class="row my-3">
                              <div class="col-lg-3">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <table class="table table-bordered total-summary summery-border">
                                         <tbody>
                                             <tr>
                                                <td class="border-left-0 border-bottom-0 border-top-0"><b>Advertisers</b></td>
                                                <td class="border-0 bg-white">All Advertisers</td>
                                             </tr>
                                             <tr>
                                                <td class="border-left-0 border-bottom-0 border-top-0"><b>Report Generated</b></td>
                                                <td class="border-0 bg-white">12-12-2019</td>
                                             </tr>
                                             <tr>
                                                <td class="border-left-0 border-bottom-0 border-top-0"><b>Produced For</b></td>
                                                <td class="border-0 bg-white">Well Done Accounts</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4">
                              </div>
                              <div class="col-lg-5">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <table class="table table-bordered total-summary">
                                          <tbody>
                                             <tr>
                                                <td class="form-back"><b>Current FY</b></td>
                                                <td class="text-center">2022 / 2023</td>
                                                <td class="form-back"><b>Total Earnings</b></td>
                                                <td class="text-right">$ 486.60</td>
                                             </tr>
                                             <tr>
                                                <td class="form-back"><b>Select</b></td>
                                                <td>
                                                   <select class="rounded-0 w-100">
                                                      <option class="text-secondary">Select Date</option>
                                                      <option class="text-secondary">2022</option>
                                                      <option class="text-secondary"ssssssselect>
                                                </td>
                                                <td class="form-back"><b>Average (p / A)</b></td>
                                                <td class="text-right">$ 121.65</td>
                                             </tr>
                                             <tr>
                                             <td class="form-back"><b>Display Type</b></td>
                                             <td>
                                             <select class="rounded-0 w-100">
                                             <option class="text-secondary">Member ID</option>
                                             <option class="text-secondary">Membership Type</option>
                                             <option class="text-secondary">Highest Spend</option>
                                             <option class="text-secondary">Lowest Spend</option>
                                             <option class="text-secondary">Highest
                                             Commission
                                             </option>
                                             <option class="text-secondary">Lowest Commission</option>
                                             </select>
                                             </td>
                                             <td class="form-back"><b>Total Advertisers</b></td>
                                             <td class="text-center">4</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive-xl mb-5">
                              <table class="table table-bordered total-summary">
                                 <tbody>
                                    <tr class="text-center">
                                       <td colspan="3"><b>Advertisers</b></td>
                                       <td colspan="6"><b>Advertisers Gross Spend (Year to Date) Earnings
                                          </b>
                                       </td>
                                       <td colspan="3"><b>Earnings</b></td>
                                    </tr>
                                    <tr class="text-center">
                                       <td><b>Member ID</b></td>
                                       <td><b>Advertiser</b></td>
                                       <td><b>Joined</b>   </td>
                                       <td><b>Platinum</b></td>
                                       <td><b>Gold</b></td>
                                       <td><b>Silver</b></td>
                                       <td><b>PinUp</b></td>
                                       <td><b>Fixed</b></td>
                                       <td><b>Total Spend</b></td>
                                       <td><b>Commission</b></td>
                                       <td><b>Action</b></td>
                                    </tr>
                                    <tr>
                                       <td>E612345 </td>
                                       <td>Oxi Daisy</td>
                                       <td class="text-center">01/01/2022</td>
                                       <td class="text-right">$ 960.00</td>
                                       <td class="text-right">$ 336.00</td>
                                       <td class="text-right">$ 348.00</td>
                                       <td class="text-right">$ 950.00</td>
                                       <td> </td>
                                       <td class="text-right">$ 2,594.00</td>
                                       <td class="text-right">$ 129.70</td>
                                       <td class="text-center">
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#commission-report"> <i class="fa fa-eye"></i> View Advertiser Report</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i> Print Advertiser Repor</a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>E612356</td>
                                       <td>Josephine Miller</td>
                                       <td class="text-center">01/01/2022</td>
                                       <td class="text-right">$ 960.00</td>
                                       <td class="text-right">$ 336.00</td>
                                       <td class="text-right">$ 348.00</td>
                                       <td class="text-right">$ 950.00</td>
                                       <td> </td>
                                       <td class="text-right">$ 2,594.00</td>
                                       <td class="text-right">$ 129.70</td>
                                       <td class="text-center">
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#commission-report"> <i class="fa fa-eye"></i> View Advertiser Report</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i> Print Advertiser Repor</a>
                                             
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>E612398</td>
                                       <td>Marry Smith</td>
                                       <td class="text-center">01/01/2022</td>
                                       <td class="text-right">$ 960.00</td>
                                       <td class="text-right">$ 336.00</td>
                                       <td class="text-right">$ 348.00</td>
                                       <td class="text-right">$ 950.00</td>
                                       <td> </td>
                                       <td class="text-right">$ 2,594.00</td>
                                       <td class="text-right">$ 129.70</td>
                                       <td class="text-center">
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#commission-report"> <i class="fa fa-eye"></i> View Advertiser Report</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i> Print Advertiser Repor</a>
                                             
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>M612465</td>
                                       <td>Lin’s Massage</td>
                                       <td class="text-center">01/01/2022</td>
                                       <td> </td>
                                       <td> </td>
                                       <td> </td>
                                       <td> </td>
                                       <td class="text-right">$ 1,950.00</td>
                                       <td class="text-right">$ 1,950.00</td>
                                       <td class="text-right">$ 97.50</td>
                                       <td class="text-center">
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#commission-report"> <i class="fa fa-eye"></i> View Advertiser Report</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i> Print Advertiser Repor</a>
                                             
                                             </div>
                                          </div>
                                       </td>
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
   </div>
</div>
<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px !important;">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="commission-report">Escort Report: Oxi Daisy (Member ID: E612345)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <div class="col-md-12">
               <div class="row mb-2">
                  <div class="col-sm-8">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td rowspan="2"><b>Financial Year
                                       </b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                    <td rowspan="2"><b>Totals</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Platinum</b></td>
                                    <td><b>Gold</b></td>
                                    <td><b>Silver</b></td>
                                    <td><b>PinUp</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>2022 / 2023</b></td>
                                    <td>$ 1,128.00</td>
                                    <td>$ 330.00</td>
                                    <td>$ 216.00</td>
                                    <td>$ 1,900.00</td>
                                    <td>$ 3,574.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>2021 / 2022</b></td>
                                    <td>$ 1,128.00</td>
                                    <td>$ 330.00</td>
                                    <td>$ 216.00</td>
                                    <td>$ 1,900.00</td>
                                    <td>$ 3,574.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>2020 / 2021</b></td>
                                    <td>$ 0.00</td>
                                    <td>$ 0.00</td>
                                    <td>$ 0.00</td>
                                    <td>$ 0.00</td>
                                    <td>$ 0.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 2,256.00</b></td>
                                    <td><b>$ 660.00</b></td>
                                    <td><b>$ 432.00</b></td>
                                    <td><b>$ 3,800.00</b></td>
                                    <td><b>$ 7,148.00</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="7" style="text-align: center;"><b>Statistics</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Postings</b></td>
                                    <td><b>Total Days</b></td>
                                    <td><b>Tours</b></td>
                                    <td><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>16</b></td>
                                    <td>250</td>
                                    <td>3</td>
                                    <td>209</td>
                                 </tr>
                                 <tr>
                                    <td><b>16</b></td>
                                    <td>250</td>
                                    <td>3</td>
                                    <td>209</td>
                                 </tr>
                                 <tr>
                                    <td><b>0</b></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>32</b></td>
                                    <td>500</td>
                                    <td>6</td>
                                    <td>418</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-sm-8">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td><b>2022 / 2023</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                    <td rowspan="2"><b>Totals</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Location</b></td>
                                    <td><b>Platinum</b></td>
                                    <td><b>Gold</b></td>
                                    <td><b>Silver</b></td>
                                    <td><b>PinUp</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>WA</b></td>
                                    <td>$ 168.00</td>
                                    <td>$ 72.00</td>
                                    <td>$ 32.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 747.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>NSW</b></td>
                                    <td>$ 320.00</td>
                                    <td>$ 84.00</td>
                                    <td>$ 64.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 943.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Vic</b></td>
                                    <td>$ 328.00</td>
                                    <td>$ 102.00</td>
                                    <td>$ 64.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 969.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Qld</b></td>
                                    <td>$ 312.00</td>
                                    <td>$ 72.00</td>
                                    <td>$ 56.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 915.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 1,128.00</b></td>
                                    <td><b>$ 330.00</b></td>
                                    <td><b>$ 216.00</b></td>
                                    <td><b>$ 1,900.00</b></td>
                                    <td><b>$ 3,574.00</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="7" style="text-align: center;"><b>Statistics</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Postings</b></td>
                                    <td><b>Total Days</b></td>
                                    <td><b>Tours</b></td>
                                    <td><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>41</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>70</td>
                                    <td>1</td>
                                    <td>70</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>74</td>
                                    <td>1</td>
                                    <td>74</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>65</td>
                                    <td>1</td>
                                    <td>65</td>
                                 </tr>
                                 <tr>
                                    <td><b>16</b></td>
                                    <td>225</td>
                                    <td>3</td>
                                    <td>209</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-8">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td><b>2022 / 2023</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                    <td rowspan="2"><b>Totals</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Location</b></td>
                                    <td><b>Platinum</b></td>
                                    <td><b>Gold</b></td>
                                    <td><b>Silver</b></td>
                                    <td><b>PinUp</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>WA</b></td>
                                    <td>$ 168.00</td>
                                    <td>$ 72.00</td>
                                    <td>$ 32.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 747.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>NSW</b></td>
                                    <td>$ 320.00</td>
                                    <td>$ 84.00</td>
                                    <td>$ 64.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 943.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Vic</b></td>
                                    <td>$ 328.00</td>
                                    <td>$ 102.00</td>
                                    <td>$ 64.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 969.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Qld</b></td>
                                    <td>$ 312.00</td>
                                    <td>$ 72.00</td>
                                    <td>$ 56.00</td>
                                    <td>$ 475.00</td>
                                    <td>$ 915.00</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 1,128.00</b></td>
                                    <td><b>$ 330.00</b></td>
                                    <td><b>$ 216.00</b></td>
                                    <td><b>$ 1,900.00</b></td>
                                    <td><b>$ 3,574.00</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="7" style="text-align: center;"><b>Statistics</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Postings</b></td>
                                    <td><b>Total Days</b></td>
                                    <td><b>Tours</b></td>
                                    <td><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>41</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>70</td>
                                    <td>1</td>
                                    <td>70</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>74</td>
                                    <td>1</td>
                                    <td>74</td>
                                 </tr>
                                 <tr>
                                    <td><b>4</b></td>
                                    <td>65</td>
                                    <td>1</td>
                                    <td>65</td>
                                 </tr>
                                 <tr>
                                    <td><b>16</b></td>
                                    <td>225</td>
                                    <td>3</td>
                                    <td>209</td>
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
</div>
<div class="modal fade upload-modal" id="message-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px !important;">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="message-report">Massage Centre Report: Lin’s Massage (Member ID: M612465)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <div class="col-md-12">
               <div class="row mb-2">
                  <div class="col-sm-5 pl-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td rowspan="2"><b>Financial Year
                                       </b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>Value</b></td>
                                    <td><b>Postings</b></td>
                                    <td><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>2022 / 2023</b></td>
                                    <td>$ 600.00</td>
                                    <td>6</td>
                                    <td>120</td>
                                 </tr>
                                 <tr>
                                    <td><b>2021 / 2022</b></td>
                                    <td>$ 600.00</td>
                                    <td>6</td>
                                    <td>120</td>
                                 </tr>
                                 <tr>
                                    <td><b>2020 / 2021</b></td>
                                    <td>$ 0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 1,200.00</b></td>
                                    <td><b>12</b></td>
                                    <td><b>240</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-7 pl-0 pr-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="18" style="text-align: center;"><b>Statistics</b> <span style=" float: right;"><b>P = Postings D = Total Days</b></span></td>
                                 </tr>
                                 <tr>
                                    <td colspan="2"><b>Masseur 1</b></td>
                                    <td colspan="2"><b>Masseur 2</b></td>
                                    <td colspan="2"><b>Masseur 3</b></td>
                                    <td colspan="2"><b>Masseur 4</b></td>
                                    <td colspan="2"><b>Masseur 5</b></td>
                                    <td colspan="2"><b>Masseur 6</b></td>
                                    <td colspan="2"><b>Masseur 7</b></td>
                                    <td colspan="2"><b>Masseur 8</b></td>
                                 </tr>
                                 <tr>
                                    <td>10</td>
                                    <td>123</td>
                                    <td>8</td>
                                    <td>89</td>
                                    <td>8</td>
                                    <td>50</td>
                                    <td>1</td>
                                    <td>23</td>
                                    <td>7</td>
                                    <td>44</td>
                                    <td>9</td>
                                    <td>27</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td>10</td>
                                    <td>123</td>
                                    <td>8</td>
                                    <td>89</td>
                                    <td>8</td>
                                    <td>50</td>
                                    <td>1</td>
                                    <td>23</td>
                                    <td>7</td>
                                    <td>44</td>
                                    <td>9</td>
                                    <td>27</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>20</b></td>
                                    <td><b>246</b></td>
                                    <td><b>16</b></td>
                                    <td><b>178</b></td>
                                    <td><b>16</b></td>
                                    <td>100</td>
                                    <td>2</td>
                                    <td>46</td>
                                    <td>14</td>
                                    <td>88</td>
                                    <td>18</td>
                                    <td>54</td>
                                    <td>28</td>
                                    <td>28</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-sm-5 pl-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td><b>2022 / 2023</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                 </tr>
                                 <tr>
                                    <td class="pt-4 pb-4"><b>Location</b></td>
                                    <td class="pt-4 pb-4"><b>Value</b></td>
                                    <td class="pt-4 pb-4"><b>Postings</b></td>
                                    <td class="pt-4 pb-4"><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>WA</b></td>
                                    <td>$ 600.00</td>
                                    <td>6</td>
                                    <td>120</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 600.00</b></td>
                                    <td><b>12</b></td>
                                    <td><b>240</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-7 pl-0 pr-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="18" style="text-align: center;"><b>Statistics</b> <span style=" float: right;"><b>P = Postings D = Total Days</b></span></td>
                                 </tr>
                                 <tr>
                                    <td colspan="2"><b>Masseur 1</b></td>
                                    <td colspan="2"><b>Masseur 2</b></td>
                                    <td colspan="2"><b>Masseur 3</b></td>
                                    <td colspan="2"><b>Masseur 4</b></td>
                                    <td colspan="2"><b>Masseur 5</b></td>
                                    <td colspan="2"><b>Masseur 6</b></td>
                                    <td colspan="2"><b>Masseur 7</b></td>
                                    <td colspan="2"><b>Masseur 8</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                 </tr>
                                 <tr>
                                    <td>10</td>
                                    <td>123</td>
                                    <td>8</td>
                                    <td>89</td>
                                    <td>8</td>
                                    <td>50</td>
                                    <td>1</td>
                                    <td>23</td>
                                    <td>7</td>
                                    <td>44</td>
                                    <td>9</td>
                                    <td>27</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>20</b></td>
                                    <td><b>246</b></td>
                                    <td><b>16</b></td>
                                    <td><b>178</b></td>
                                    <td><b>16</b></td>
                                    <td>100</td>
                                    <td>2</td>
                                    <td>46</td>
                                    <td>14</td>
                                    <td>88</td>
                                    <td>18</td>
                                    <td>54</td>
                                    <td>28</td>
                                    <td>28</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-sm-5 pl-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td><b>2022 / 2023</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>Spend</b></td>
                                 </tr>
                                 <tr>
                                    <td class="pt-4 pb-4"><b>Location</b></td>
                                    <td class="pt-4 pb-4"><b>Value</b></td>
                                    <td class="pt-4 pb-4"><b>Postings</b></td>
                                    <td class="pt-4 pb-4"><b>Total Days</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>WA</b></td>
                                    <td>$ 600.00</td>
                                    <td>6</td>
                                    <td>120</td>
                                 </tr>
                                 <tr>
                                    <td><b>Totals</b></td>
                                    <td><b>$ 600.00</b></td>
                                    <td><b>12</b></td>
                                    <td><b>240</b></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-7 pl-0 pr-0">
                     <div class="card border-0">
                        <div class="table-responsive-xl">
                           <table class="table table-bordered total-summary mb-0">
                              <tbody>
                                 <tr>
                                    <td colspan="18" style="text-align: center;"><b>Statistics</b> <span style=" float: right;"><b>P = Postings D = Total Days</b></span></td>
                                 </tr>
                                 <tr>
                                    <td colspan="2"><b>Masseur 1</b></td>
                                    <td colspan="2"><b>Masseur 2</b></td>
                                    <td colspan="2"><b>Masseur 3</b></td>
                                    <td colspan="2"><b>Masseur 4</b></td>
                                    <td colspan="2"><b>Masseur 5</b></td>
                                    <td colspan="2"><b>Masseur 6</b></td>
                                    <td colspan="2"><b>Masseur 7</b></td>
                                    <td colspan="2"><b>Masseur 8</b></td>
                                 </tr>
                                 <tr>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                    <td><b>P</b></td>
                                    <td><b>D</b></td>
                                 </tr>
                                 <tr>
                                    <td>10</td>
                                    <td>123</td>
                                    <td>8</td>
                                    <td>89</td>
                                    <td>8</td>
                                    <td>50</td>
                                    <td>1</td>
                                    <td>23</td>
                                    <td>7</td>
                                    <td>44</td>
                                    <td>9</td>
                                    <td>27</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>0</td>
                                 </tr>
                                 <tr>
                                    <td><b>20</b></td>
                                    <td><b>246</b></td>
                                    <td><b>16</b></td>
                                    <td><b>178</b></td>
                                    <td><b>16</b></td>
                                    <td>100</td>
                                    <td>2</td>
                                    <td>46</td>
                                    <td>14</td>
                                    <td>88</td>
                                    <td>18</td>
                                    <td>54</td>
                                    <td>28</td>
                                    <td>28</td>
                                    <td>0</td>
                                    <td>0</td>
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
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush