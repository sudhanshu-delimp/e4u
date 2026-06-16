 <div class="tab-pane fade  active show" id="one" role="tabpanel" aria-labelledby="one-tab">
     <div class="row my-3">
         <div class="col-lg-3">
             <div class="row">
                 <div class="col-lg-12">
                     <table class="table table-bordered summery-border">
                         <tbody>
                             <tr>
                                 <td class="border-left-0 border-bottom-0 border-top-0 text-right">
                                     <b>Advertisers</b>
                                 </td>
                                 <td class="border-0 bg-white text-left">All Advertisers
                                 </td>
                             </tr>
                             <tr>
                                 <td class="border-left-0 border-bottom-0 border-top-0 text-right">
                                     <b>Report Generated</b>
                                 </td>
                                 <td class="border-0 bg-white text-left">12-12-2019</td>
                             </tr>
                             <tr>
                                 <td class="border-left-0 border-bottom-0 border-top-0 text-right">
                                     <b>Produced For</b>
                                 </td>
                                 <td class="border-0 bg-white text-left">Well Done Accounts
                                 </td>
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
                     <table class="table table-bordered">
                         <tbody>
                             <tr>
                                 <td class="bg-first text-right"><b>Current FY</b></td>
                                 <td class="text-center" id="current-fy" style="width:27%;">2025 / 2026</td>
                                 <td class="bg-first text-right"><b>Total Earnings</b>
                                 </td>
                                 <td class="text-right" style="width:20%;">
                                     <x-curFormat />486.60
                                 </td>
                             </tr>
                             <tr>
                                 <td class="bg-first text-right"><b>Select FY </b></td>
                                 <td style="width:27%;">
                                     <select class="rounded-0 w-100" id="select-fy" name="select-fy">
                                         @foreach ($availableFYs as $year)
                                             <option value="{{ $year }}">{{ $year }}</option>
                                         @endforeach
                                     </select>
                                 </td>
                                 <td class="bg-first text-right"><b>Average (P /
                                         Advertiser)</b>
                                 </td>
                                 <td class="text-right" style="width:20%;">
                                     <x-curFormat />121.65
                                 </td>
                             </tr>
                             <tr>
                                 <td class="bg-first text-right"><b>Display Type</b>
                                 </td>
                                 <td style="width:27%;">
                                     <select class="rounded-0 w-100">
                                         <option>Member ID
                                         </option>
                                         <option>Membership Type
                                         </option>
                                         <option>Highest Spend
                                         </option>
                                         <option>Lowest Spend
                                         </option>
                                         <option>Highest Fees
                                         </option>
                                         <option>Lowest Fees
                                         </option>
                                     </select>
                                 </td>
                                 <td class="bg-first text-right"><b>Total
                                         Advertisers</b></td>
                                 <td class="text-right" style="width:20%;">4</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     <div class="table-responsive mb-5">
         <table class="table table-bordered">
             <thead class="bg-first">
                 <tr class="text-center">
                     <th colspan="3"><b>Advertisers</b></th>
                     <th colspan="6"><b>Advertisers Gross Spend (Year to Date)
                             Earnings
                         </b>
                     </th>
                     <th colspan="3"><b>Earnings</b></th>
                 </tr>
                 <tr class="text-center">
                     <th><b>Member ID</b></th>
                     <th><b>Advertiser</b></th>
                     <th><b>Joined</b> </th>
                     <th><b>Platinum</b></th>
                     <th><b>Gold</b></th>
                     <th><b>Silver</b></th>
                     <th><b>PinUp</b></th>
                     <th><b>Fixed</b></th>
                     <th><b>Total Spend</b></th>
                     <th><b>Fees</b></th>
                     <th><b>Action</b></th>
                 </tr>
                 <tr>
             </thead>
             <tbody id="appendFeesSummaryAdvertiser">
                 {{-- <tr>
                     <td class="text-left">E612345 </td>
                     <td class="text-left">Oxi Daisy</td>
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
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#commission-report"
                                    >
                                     <i class="fa fa-eye"></i> View Advertiser Report
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#">
                                     <i class="fa fa-print"></i> Print Advertiser Report
                                 </a>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td class="text-left">E612356</td>
                     <td class="text-left">Josephine Miller</td>
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
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#commission-report">
                                     <i class="fa fa-eye"></i> View Advertiser Report
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#">
                                     <i class="fa fa-print"></i>
                                     Print Advertiser Report
                                 </a>

                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td class="text-left">E612398</td>
                     <td class="text-left">Marry Smith</td>
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
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#commission-report"> <i
                                         class="fa fa-eye"></i> View Advertiser Report
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i>
                                     Print Advertiser Report</a>

                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td class="text-left">M612465</td>
                     <td class="text-left">Lin’s Massage</td>
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
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#message-report"> <i
                                         class="fa fa-eye"></i> View Masseur Report
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i>
                                     Print Masseur Report</a>

                             </div>
                         </div>
                     </td>
                 </tr> --}}
             </tbody>
         </table>
     </div>
 </div>
