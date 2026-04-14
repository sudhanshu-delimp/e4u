@extends('layouts.admin')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">      
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Payment Reconciliation</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
               <div class="card-body">
                  <h3 class="NotesHeader"><b>Notes:</b> </h3>
                  <ol>
                     <li>The following report sets out the sales for Concierge Services by type.</li>                     
                     <li>Select Approve from the Action list to review the results for the billing period. If the
                        reconciliation is correct, select the Approve button.</li>
                                            <li>Once the reconciliation is approved, by selecting Email from the Action list, the report
                        is emailed to the Supplier.</li>
                        <li>Print report and process payment.</li>
                  </ol>
               </div>
         </div>
      </div>
</div>


    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 mt-2">
                    <div id="table-sec" class="table-responsive-xl">
                        <table class="table" id="AgentReportTable">
                            <thead class="table-bg">
                                <tr>
                                    <th>Date</th>
                                    <th>Billing Period</th>
                                    <th>Concierge</th>
                                    <th>Gross Sales</th>
                                    <th>Supplier</th>
                                    <th>Earnings</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>30-06-2025</td>
                                    <td>01-06-2025 to 30-06-2025</td>
                                    <td>Product</td>
                                    <td><div class="num_value">$<span>1,225.00</span></div></td>
                                    <td><div class="num_value">$<span>1,000.00</span></div></td>
                                    <td><div class="num_value">$<span>225.00</span></div></td>
                                    <td><span class="custom_badge badge_pending">Pending</span></td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-check-circle"   aria-hidden="true"></i>
                                                        Approve</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View Report</a>

                                                         <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"> <i
                                                            class="fa fa-at" aria-hidden="true"></i>
                                                        Email</a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item align-item-custom"  data-toggle="modal" data-target="#viewReports" href="#"> <i class="fa fa-eye" aria-hidden="true"></i>
                                                        View Supplier</a>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>30-06-2025</td>
                                    <td>01-06-2025 to 30-06-2025</td>
                                    <td>SIM</td>
                                    <td><div class="num_value">$<span>850.00</span></div></td>
                                    <td><div class="num_value">$<span>600.00</span></div></td>
                                    <td><div class="num_value">$<span>225.00</span></div></td>
                                    <td><span class="custom_badge badge_pending">Pending</span></td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-check-circle"   aria-hidden="true"></i>
                                                        Approve</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View Report</a>

                                                         <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"> <i
                                                            class="fa fa-at" aria-hidden="true"></i>
                                                        Email</a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item align-item-custom"  data-toggle="modal" data-target="#viewReports" href="#"> <i class="fa fa-eye" aria-hidden="true"></i>
                                                        View Supplier</a>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>30-06-2025</td>
                                    <td>01-06-2025 to 30-06-2025</td>
                                    <td>Product</td>
                                    <td><div class="num_value">$<span>1,225.00</span></div></td>
                                    <td><div class="num_value">$<span>1,000.00</span></div></td>
                                    <td><div class="num_value">$<span>225.00</span></div></td>
                                    <td><span class="custom_badge badge_resolved">Reconciled</span></td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-check-circle"   aria-hidden="true"></i>
                                                        Approve</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View Report</a>

                                                         <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"> <i
                                                            class="fa fa-at" aria-hidden="true"></i>
                                                        Email</a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item align-item-custom"  data-toggle="modal" data-target="#viewReports" href="#"> <i class="fa fa-eye" aria-hidden="true"></i>
                                                        View Supplier</a>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>30-06-2025</td>
                                    <td>01-06-2025 to 30-06-2025</td>
                                    <td>SIM</td>
                                    <td><div class="num_value">$<span>850.00</span></div></td>
                                    <td><div class="num_value">$<span>600.00</span></div></td>
                                    <td><div class="num_value">$<span>225.00</span></div></td>
                                    <td><span class="custom_badge badge_resolved">Reconciled</span></td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-check-circle"   aria-hidden="true"></i>
                                                        Approve</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#viewReports"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View Report</a>

                                                         <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"> <i
                                                            class="fa fa-at" aria-hidden="true"></i>
                                                        Email</a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item align-item-custom"  data-toggle="modal" data-target="#viewReports" href="#"> <i class="fa fa-eye" aria-hidden="true"></i>
                                                        View Supplier</a>
                                                </div>
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

{{-- end --}}

{{-- this is common modal you can use same for all  View Report --}}

<div class="modal fade upload-modal" id="viewReports" tabindex="-1" role="dialog"
    aria-labelledby="viewReportsLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">


                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                        class="custompopicon"> Payments Report Product - [Supplier name] (Period Ending 30-06-2025)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered reconciliation_table">
                    <thead class="table-bg">
                        <tr>
                            <th>Product ID</th>
                            <th>Advertiser</th>
                            <th class="text-center">Territory</th>
                            <th class="text-center">Delivery</th>
                            <th>Retail</th>
                            <th>Company</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td>CM01</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>


                        {{-- 2nd --}}
                        <tr>
                        <td>CM02</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 3rd --}}
                        <tr>
                        <td>CM03</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>

                        {{-- 4th --}}
                        <tr>
                        <td>CM04</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>

                        {{-- 5th --}}
                        <tr>
                        <td>CM05</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 6th --}}
                        <tr>
                        <td>CM06</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 7th --}}
                        <tr>
                        <td>CM07</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 8th --}}
                        <tr>
                        <td>CM08</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 9th --}}
                        <tr>
                        <td>CM09</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>
                        {{-- 10th --}}
                        <tr>
                        <td>CM10</td>
                        <td>E60125</td>
                        <td class="text-center">WA</td>
                        <td class="text-center">Door</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E50148</td>
                        <td class="text-center">SA</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>E20248</td>
                        <td class="text-center">NSW</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>

                       <tr>
                        <td></td>
                        <td>M40125</td>
                        <td class="text-center">Qld</td>
                        <td class="text-center">Post</td>
                        <td> <div class="num_value">$<span>50.00</div></td>
                        <td> <div class="num_value">$<span>10.00</div></td>
                        <td> <div class="num_value">$<span>40.00</div></td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                           
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>105.00</div></td>
                                    <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>40.00</div></td>
                            <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>160.00</div></td>
                        </tr>

                    </tbody>
                    
                    <tfoot>
                         <!-- ========= total ========= -->
                        <tr>
                            <td class="mt-5" colspan="7"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                          
                            <td style="border-top: 2px solid#444; border-bottom:6px double #444;font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>2,000.00 </div></td>
                                      <td style="border-top: 2px solid#444; border-bottom:6px double #444;font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>$ 400.00</div></td>
                            <td style="border-top: 2px solid#444; border-bottom:6px double #444;font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,600.00
                                </div>
                            </td>
                        </tr>

                    </tfoot>
                </table>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal">Print</button>
                <button type="button" class="btn-success-modal" data-dismiss="modal">Approved</button>

                {{-- <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button> --}}
            </div>
        </div>
    </div>
</div>
{{-- end --}}

{{-- end --}}
@endsection
@push('script')
<!-- opr_accordian_table JS -->
<script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>


<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const target = toggle.getAttribute('data-target').replace('#', '');
            const openGroup = document.querySelectorAll(`.detail-row[data-group="${target}"]`);
            const isOpen = openGroup[0]?.classList.contains('show');

            // Close all open groups
            document.querySelectorAll('.detail-row.show').forEach(r => {
                r.classList.remove('show');
            });

            // Open current group if not already open
            if (!isOpen) {
                openGroup.forEach(r => r.classList.add('show'));
            }

            // Rotate arrow
            document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
                'rotated'));
            if (!isOpen) toggle.querySelector('i').classList.add('rotated');
        });
    });
</script>

<script>
    var table = $("#AgentReportTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Agent ID"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,

           columns: [
               { data: 'date_issued', name: 'date_issued', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'billing_period', name: 'billing_period', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'agent_id', name: 'agent_id', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'territory', name: 'territory', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'fees', name: 'fees', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'date_agent_approved', name: 'date_agent_approved', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
           ],
    });
</script>
@endpush