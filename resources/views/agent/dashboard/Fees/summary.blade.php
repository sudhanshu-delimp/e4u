@extends('layouts.agent') @section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}"> @endsection @section('content')
<style type="text/css">
    .table td {
            border-color: #022c3d !important;
        }

        .table td,
        .table th {
            padding: 0.4rem;
            text-align: center;
        }

        .note_list ol li {
            padding-left: 25px
        }

        .total_row {
            border-top: 2px solid !important;
            border-bottom: 2px solid !important;
        }

        .table-bordered {
            border-color: #022c3d !important;
        }

        .custom_fees_tab li a {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.01em;
            padding: 10px;
            background: #022c3d;
            border-radius: 3px;
            color: #fff;
        }

        .custom_fees_tab li a.active {
            background-color: #ff3c5f !important;
            color: #fff !important;
        }

        select option {
            color: #858796 !important;
        }
</style>
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content end here-->
    <div class="row">
        <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">Fees Summary</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>You can apply filters within the Fees Summary to suit your query or report type.</li>
                        <li>All Fees paid to you under the Agent Agreement will be paid into your nominated Bank Account. Fees is inclusive of GST.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <ul class="nav nav-tabs tab-sec custom_fees_tab">
                <li class="active"><a href="#one" data-toggle="tab" class="active">Fees Summary (Advertiser)</a></li>
                <li><a href="#two" data-toggle="tab">Fees Summary (YoY)</a></li>
            </ul>
        </div>
        <div class="col-md-12 mt-4">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card mb-4 border-0">
                            <div class="tab-content" id="myTabContent">
                                {{-- 1 --}}
                                @include('agent.dashboard.Fees.fees_summery_advertiser')
                                {{-- 2 --}}
                                @include('agent.dashboard.Fees.fees_summery_yoy')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- For Escort Report --}}
<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commission-report"> <img
                            src="{{ asset('assets/dashboard/img/statement-report.png') }}" class="custompopicon"> Escort
                        Report: Oxi Daisy (Member ID: E612345)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <div class="card border-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered  mb-0">
                                        <thead class="bg-first">
                                            <tr>
                                                <th rowspan="2"><b>Financial Year
                                                        </b>
                                                </th>
                                                <th colspan="4" style="text-align: center;"><b>Spend</b></th>
                                                <th rowspan="2"><b>Totals</b></th>
                                            </tr>
                                            <tr>
                                                <th><b>Platinum</b></th>
                                                <th><b>Gold</b></th>
                                                <th><b>Silver</b></th>
                                                <th><b>PinUp</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="collapse-accordion">
                                            <!-- GROUP 1: ACT -->
                                            <tr data-toggle="toggle-row" data-target=".group-1" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                        <span>2025 / 2026</span> <i class="fa fa-chevron-down"></i>
                                                    </div>
                                                </td>
                                                <td><b>$ 1,128.00</b></td>
                                                <td><b>$ 330.00</b></td>
                                                <td><b>$ 216.00</b></td>
                                                <td><b>$ 1,900.00</b></td>
                                                <td><b>$ 3,574.00</b></td>
                                            </tr>
                                            <!-- middle Content -->

                                            <tr class="collapse-row group-1">
                                                <td><b>WA</b></td>
                                                <td>$ 168.00</td>
                                                <td>$ 72.00</td>
                                                <td>$ 32.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 747.00</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td><b>NSW</b></td>
                                                <td>$ 320.00</td>
                                                <td>$ 84.00</td>
                                                <td>$ 64.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 943.00</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td><b>Vic</b></td>
                                                <td>$ 328.00</td>
                                                <td>$ 102.00</td>
                                                <td>$ 64.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 969.00</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td><b>Qld</b></td>
                                                <td>$ 312.00</td>
                                                <td>$ 72.00</td>
                                                <td>$ 56.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 915.00</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td class="text-right"><b>Totals</b></td>
                                                <td class="total_row"><b>$ 1,128.00</b></td>
                                                <td class="total_row"><b>$ 330.00</b></td>
                                                <td class="total_row"><b>$ 216.00</b></td>
                                                <td class="total_row"><b>$ 1,900.00</b></td>
                                                <td class="total_row"><b>$ 3,574.00</b></td>
                                            </tr>
                                            <!-- GROUP 2: ACT -->
                                            <tr data-toggle="toggle-row" data-target=".group-2" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                        <span>2024 / 2025</span> <i class="fa fa-chevron-down"></i>
                                                    </div>
                                                </td>
                                                <td><b>$ 1,128.00</b></td>
                                                <td><b>$ 330.00</b></td>
                                                <td><b>$ 216.00</b></td>
                                                <td><b>$ 1,900.00</b></td>
                                                <td><b>$ 3,574.00</b></td>
                                            </tr>
                                            <!-- middle Content -->

                                            <tr class="collapse-row group-2">
                                                <td><b>WA</b></td>
                                                <td>$ 168.00</td>
                                                <td>$ 72.00</td>
                                                <td>$ 32.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 747.00</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td><b>NSW</b></td>
                                                <td>$ 320.00</td>
                                                <td>$ 84.00</td>
                                                <td>$ 64.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 943.00</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td><b>Vic</b></td>
                                                <td>$ 328.00</td>
                                                <td>$ 102.00</td>
                                                <td>$ 64.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 969.00</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td><b>Qld</b></td>
                                                <td>$ 312.00</td>
                                                <td>$ 72.00</td>
                                                <td>$ 56.00</td>
                                                <td>$ 475.00</td>
                                                <td>$ 915.00</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td class="text-right"><b>Totals</b></td>
                                                <td class="total_row"><b>$ 1,128.00</b></td>
                                                <td class="total_row"><b>$ 330.00</b></td>
                                                <td class="total_row"><b>$ 216.00</b></td>
                                                <td class="total_row"><b>$ 1,900.00</b></td>
                                                <td class="total_row"><b>$ 3,574.00</b></td>
                                            </tr>
                                            {{-- end --}}
                                            <!-- GROUP 3: ACT -->
                                            <tr data-toggle="toggle-row" data-target=".group-3" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                        <span>2023 / 2024</span> <i class="fa fa-chevron-down"></i>
                                                    </div>
                                                </td>
                                                <td><b>$ 0.00</b></td>
                                                <td><b>$ 0.00</b></td>
                                                <td><b>$ 0.00</b></td>
                                                <td><b>$ 0.00</b></td>
                                                <td><b>$ 0.00</b></td>
                                            </tr>
                                            <!-- middle Content -->

                                            <tr class="collapse-row group-3">

                                            </tr>
                                            {{-- end --}}


                                            <tr>
                                                <td class="text-right"><b>Totals</b></td>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-first">
                                            <tr>
                                                <th colspan="7" style="text-align: center;"><b>Statistics</b></th>
                                            </tr>
                                            <tr>
                                                <th><b>Listings</b></th>
                                                <th><b>Total Days</b></th>
                                                <th><b>Tours</b></th>
                                                <th><b>Total Days</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="collapse-accordion">
                                            {{-- row 1 --}}
                                            <tr>
                                                <td><b>16</b></td>
                                                <td><b>250</b></td>
                                                <td><b>3</b></td>
                                                <td><b>209</b></td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td>4</td>
                                                <td>41</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td>4</td>
                                                <td>70</td>
                                                <td>1</td>
                                                <td>70</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td>4</td>
                                                <td>74</td>
                                                <td>1</td>
                                                <td>74</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td>4</td>
                                                <td>65</td>
                                                <td>1</td>
                                                <td>65</td>
                                            </tr>
                                            <tr class="collapse-row group-1">
                                                <td class="total_row"><b>16</b></td>
                                                <td class="total_row"><b>250</b></td>
                                                <td class="total_row"><b>3</b></td>
                                                <td class="total_row"><b>209</b></td>
                                            </tr>
                                            {{-- end --}} {{-- row 2 --}}
                                            <tr>
                                                <td><b>16</b></td>
                                                <td><b>250</b></td>
                                                <td><b>3</b></td>
                                                <td><b>209</b></td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td>4</td>
                                                <td>41</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td>4</td>
                                                <td>70</td>
                                                <td>1</td>
                                                <td>70</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td>4</td>
                                                <td>74</td>
                                                <td>1</td>
                                                <td>74</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td>4</td>
                                                <td>65</td>
                                                <td>1</td>
                                                <td>65</td>
                                            </tr>
                                            <tr class="collapse-row group-2">
                                                <td class="total_row"><b>16</b></td>
                                                <td class="total_row"><b>250</b></td>
                                                <td class="total_row"><b>3</b></td>
                                                <td class="total_row"><b>209</b></td>
                                            </tr>
                                            {{-- end --}} {{-- row 3 --}}
                                            <tr>
                                                <td><b>0</b></td>
                                                <td><b>0</b></td>
                                                <td><b>0</b></td>
                                                <td><b>0</b></td>

                                            </tr>
                                            {{-- end --}} {{-- total --}}
                                            <tr>
                                                <td class="total_row"><b>32</b></td>
                                                <td class="total_row"><b>500</b></td>
                                                <td class="total_row"><b>6</b></td>
                                                <td class="total_row"><b>418</b></td>
                                            </tr>
                                            {{-- end --}}
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
{{-- end --}} {{-- For Massage Report --}}

<div class="modal fade upload-modal" id="message-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="message-report"><img
                            src="{{ asset('assets/dashboard/img/statement-report.png') }}" class="custompopicon"> Massage
                        Centre Report: Lin’s Massage (Member ID: M612465)
                    </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-sm-5 pl-0">
                            <div class="card border-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-first">
                                            <tr>
                                                <th rowspan="2"><b>Financial Year
                                                        </b>
                                                </th>
                                                <th colspan="4" style="text-align: center;"><b>Spend</b></th>
                                            </tr>
                                            <tr>
                                                <th><b>Value</b></th>
                                                <th><b>Listings</b></th>
                                                <th><b>Total Days</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="collapse-accordion">

                                            <tr>
                                                <tr data-toggle="toggle-row" data-target=".group-01" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                            <span>2025 / 2026</span> <i class="fa fa-chevron-down"></i>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">$ 600.00</td>
                                                    <td class="text-right">6</td>
                                                    <td class="text-right">120</td>
                                                </tr>
                                                <tr class="collapse-row group-01">
                                                    <td><b>WA</b></td>
                                                    <td class="text-right">$ 600.00</td>
                                                    <td class="text-right">6</td>
                                                    <td class="text-right">120</td>
                                                </tr>
                                                <tr class="collapse-row group-01">
                                                    <td class="text-right"><b>Totals</b></td>
                                                    <td class="text-right total_row"><b>$ 600.00</b></td>
                                                    <td class="text-right total_row"><b>6</b></td>
                                                    <td class="text-right total_row"><b>120</b></td>
                                                </tr>

                                                <tr data-toggle="toggle-row" data-target=".group-02" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                            <span>2024 / 2025</span> <i class="fa fa-chevron-down"></i>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">$ 600.00</td>
                                                    <td class="text-right">6</td>
                                                    <td class="text-right">120</td>
                                                </tr>

                                                <tr class="collapse-row group-02">
                                                    <td><b>WA</b></td>
                                                    <td class="text-right">$ 600.00</td>
                                                    <td class="text-right">6</td>
                                                    <td class="text-right">120</td>
                                                </tr>
                                                <tr class="collapse-row group-02">
                                                    <td class="text-right"><b>Totals</b></td>
                                                    <td class="text-right total_row"><b>$ 600.00</b></td>
                                                    <td class="text-right total_row"><b>6</b></td>
                                                    <td class="text-right total_row"><b>120</b></td>
                                                </tr>
                                                <tr data-toggle="toggle-row" data-target=".group-03" data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between font-weight-bold">
                                                            <span>2023 / 2024</span> <i class="fa fa-chevron-down"></i>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">$ 0.00</td>
                                                    <td class="text-right">0</td>
                                                    <td class="text-right">0</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><b>Totals</b></td>
                                                    <td class="text-right total_row"><b>$ 1,200.00</b></td>
                                                    <td class="text-right total_row"><b>12</b></td>
                                                    <td class="text-right total_row"><b>240</b></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 pl-0 pr-0">
                            <div class="card border-0">
                                <div class="table-responsive-xl">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-first">
                                            <tr>
                                                <th colspan="18" style="text-align: center;"><b>Statistics</b> <span style=" float: right;"><b>Left = Listings Right =
                                                                Days</b></span></th>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><b>Masseur 1</b></th>
                                                <th colspan="2"><b>Masseur 2</b></th>
                                                <th colspan="2"><b>Masseur 3</b></th>
                                                <th colspan="2"><b>Masseur 4</b></th>
                                                <th colspan="2"><b>Masseur 5</b></th>
                                                <th colspan="2"><b>Masseur 6</b></th>
                                                <th colspan="2"><b>Masseur 7</b></th>
                                                <th colspan="2"><b>Masseur 8</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- row 01 --}}
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


                                            <tr class="collapse-row group-01">
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
                                            <tr class="collapse-row group-01">
                                                <td class="total_row">10</td>
                                                <td class="total_row">123</td>
                                                <td class="total_row">8</td>
                                                <td class="total_row">89</td>
                                                <td class="total_row">8</td>
                                                <td class="total_row">50</td>
                                                <td class="total_row">1</td>
                                                <td class="total_row">23</td>
                                                <td class="total_row">7</td>
                                                <td class="total_row">44</td>
                                                <td class="total_row">9</td>
                                                <td class="total_row">27</td>
                                                <td class="total_row">14</td>
                                                <td class="total_row">14</td>
                                                <td class="total_row">0</td>
                                                <td class="total_row">0</td>
                                            </tr>
                                            {{-- end --}} {{-- row02 --}}
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
                                            <tr class="collapse-row group-02">
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

                                            <tr class="collapse-row group-02">
                                                <td class="total_row">10</td>
                                                <td class="total_row">123</td>
                                                <td class="total_row">8</td>
                                                <td class="total_row">89</td>
                                                <td class="total_row">8</td>
                                                <td class="total_row">50</td>
                                                <td class="total_row">1</td>
                                                <td class="total_row">23</td>
                                                <td class="total_row">7</td>
                                                <td class="total_row">44</td>
                                                <td class="total_row">9</td>
                                                <td class="total_row">27</td>
                                                <td class="total_row">14</td>
                                                <td class="total_row">14</td>
                                                <td class="total_row">0</td>
                                                <td class="total_row">0</td>
                                            </tr>
                                            {{-- end --}} {{-- row03 --}}
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
                                            {{-- 3nd --}}
                                            <tr>
                                                <td class="total_row"><b>20</b></td>
                                                <td class="total_row"><b>246</b></td>
                                                <td class="total_row"><b>16</b></td>
                                                <td class="total_row"><b>178</b></td>
                                                <td class="total_row"><b>16</b></td>
                                                <td class="total_row">100</td>
                                                <td class="total_row">2</td>
                                                <td class="total_row">46</td>
                                                <td class="total_row">14</td>
                                                <td class="total_row">88</td>
                                                <td class="total_row">18</td>
                                                <td class="total_row">54</td>
                                                <td class="total_row">28</td>
                                                <td class="total_row">28</td>
                                                <td class="total_row">0</td>
                                                <td class="total_row">0</td>
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
{{-- end --}} @endsection @push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
{{--
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/agent/management/fee/fees-summery.js') }}"></script>

<script>
    // $(document).ready(function() {
        //     $('#select-fy').on('change', function() {
        //         const selectedFY = $(this).val();
        //         $('#current-fy').text(selectedFY.replace('-', ' / '));
        //     })
        // });
</script>
@endpush