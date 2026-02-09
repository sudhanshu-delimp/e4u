@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
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
        .table-bordered{
         border-color: #022c3d !important; 
        }
    </style>
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->
        <div class="row">
            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Fees Summary</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>You can apply filters within the Fees Summary to suit your query or report type.</li>
                            <li>All Fees paid to you under the Agent Agreement will be paid into your nominated Bank
                                Account. Fees is inclusive of GST.</li>

                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <ul class="nav nav-tabs tab-sec">
                    <li class="active"><a href="#one" data-toggle="tab" class="active">Fees Summary (YoY)</a></li>
                    <li><a href="#two" data-toggle="tab" class="">Fees Summary (Advertiser)</a></li>
                </ul>
            </div>
            <div class="col-md-12 mt-4">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-4 border-0">
                                <div class="tab-content" id="myTabContent">

                                    {{-- 1 --}}
                                    <div class="tab-pane fade active show" id="one" role="tabpanel"
                                        aria-labelledby="one-tab">


                                        <div class="table-responsive membership--inner">
                                            <table class="table table-bordered text-center mb-0" id="tourStatisticTable">
                                                <thead>
                                                    <tr>
                                                        <td colspan="1"><b>Period:</b></td>
                                                        <td colspan="3" class="text-center bg-first">
                                                            <select class="rounded-0 w-75"
                                                                style="outline:none; color: #022c3d;">
                                                                <option class="text-secondary">Select Date</option>
                                                                <option class="text-secondary">2025</option>
                                                                <option class="text-secondary">2026</option>
                                                                <option class="text-secondary">2027</option>
                                                                <option class="text-secondary">2028</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center" colspan="3"><b>This
                                                                Week<sup>(1)</sup></b></td>
                                                        <td class="text-center bg-first" colspan="3">
                                                            <b>FY<sup>(3)</sup> </b>
                                                            <span class="ml-5">
                                                                <select class="rounded-0 w-50"
                                                                    style="outline:none; color: #022c3d;">
                                                                    <option class="text-secondary">2026</option>
                                                                    <option class="text-secondary">2027</option>
                                                                    <option class="text-secondary">2028</option>
                                                                    <option class="text-secondary">2029</option>
                                                                </select>
                                                            </span>
                                                        </td>
                                                        <td colspan="2" class="text-center"><b>YoY<sup>(1)</sup>
                                                                Growth<sup>(5)</sup></b> </td>
                                                        <td colspan="3" class="text-center bg-first">
                                                            <b>
                                                                FY <sup>(4)</sup>
                                                                <span class="ml-5">
                                                                    <select class="rounded-0 w-50"
                                                                        style="outline:none; color: #022c3d;">
                                                                        <option class="text-secondary">2026</option>
                                                                        <option class="text-secondary">2027</option>
                                                                        <option class="text-secondary">2028</option>
                                                                        <option class="text-secondary">2029</option>
                                                                    </select>
                                                                </span>
                                                            </b>
                                                        </td>
                                                    </tr>


                                                </thead>

                                                <tbody id="collapse-accordion">

                                                    <tr id="hideAlltr">
                                                        <td colspan="15" style="text-align: left; font-weight: bold;">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                                <span>Total Summary</span> <i
                                                                    class="fa fa-chevron-down"></i>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="text-center">
                                                        <td class="text-right pt-5" rowspan="2"><b>Variables</b></td>
                                                        <td class="text-center bg-first" colspan="3"><b>20/01/2026</b>
                                                        </td>
                                                        <td class="text-center" colspan="1"><b>Average</b></td>
                                                        <td colspan="2" class="bg-first text-center"><b>Cumulative</b>
                                                        </td>
                                                        <td colspan="1" class="text-center"><b>Average</b></td>
                                                        <td colspan="2" class="bg-first text-center"><b>Cumulative </b>
                                                        </td>
                                                        <td class="text-center"><b>↕ Com %</b></td>
                                                        <td class="bg-first text-center"><b>↕ No. Units</b></td>
                                                        <td colspan="1"><b>Average</b></td>
                                                        <td colspan="2" class="bg-first text-center"><b>Cumulative</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Spend</td>
                                                        <td class="bg-white">5%</td>
                                                        <td style="background: #cccccc54;">No.</td>
                                                        <td colspan="3">19/01/2026 to 26/01/2026</td>
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
                                                    <!-- GROUP 1: ACT -->
                                                    <tr data-toggle="toggle-row" data-target=".group-1"
                                                        data-parent="#collapse-accordion" style="cursor: pointer;">
                                                        <td colspan="15">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                                <span>Escorts Summary</span> <i
                                                                    class="fa fa-chevron-down"></i>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <!-- middle Content -->
                                                    <tr class="collapse-row group-1">
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
                                                    <tr class="collapse-row group-1">
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
                                                    <tr class="collapse-row group-1">
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
                                                    <tr class="collapse-row group-1">
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
                                                    <tr class="collapse-row group-1">
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


                                                    <!-- end 1 -->

                                                    <!-- GROUP 2: NSW -->
                                                    <tr data-toggle="toggle-row" data-target=".group-2"
                                                        data-parent="#collapse-accordion" style="cursor: pointer;">
                                                        <td colspan="15">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                                <span>Massage Centres Summary</span> <i
                                                                    class="fa fa-chevron-down"></i>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- middle Content -->
                                                    <tr class="collapse-row group-2">
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
                                                    <tr class="collapse-row group-2">
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
                                                        <td>557.00</td>
                                                        <td>$ 1,140.00</td>
                                                        <td>760</td>
                                                    </tr>
                                                    <tr class="collapse-row group-2">
                                                        <td class="text-right"><b>Total Spend / Earnings</b></td>
                                                        <td><b>$ 1,200.00</b></td>
                                                        <td><b>$ 100.00</b></td>
                                                        <td><b>42</b></td>
                                                        <td><b>$ 260.00</b></td>
                                                        <td><b>$ 781.00</b></td>
                                                        <td><b>146</b></td>
                                                        <td><b>$ 243.00</b></td>
                                                        <td><b>$ 4,860.00</b></td>
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


                                                    <!-- end 2 -->
                                                </tbody>

                                            </table>
                                        </div>


                                        <div class="col-lg-12">
                                            <h5 class="font-weight-bold my-3" style="cursor: pointer"
                                                data-toggle="collapse" data-target="#notes2" aria-expanded="true">Notes :
                                            </h5>

                                            <div class="card collapse" id="notes2" style="">
                                                <div class="card-body note_list">
                                                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                                    <ol>
                                                        <li>This Week, a 7 day week which are the days either side of the
                                                            selected date, means:
                                                            <ul class="level-2">
                                                                <li>Average for that week, week to date, that is Thursday
                                                                    would be Monday + Tuesday + Wednesday + Thursday / by 4.
                                                                </li>
                                                                <li>Cumulative for that week would be Monday + Tuesday +
                                                                    Wednesday + Thursday.</li>
                                                            </ul>
                                                        </li>
                                                        <li>YoY means Year over Year. Year is 365 days.</li>
                                                        <li>FY means the financial data selected for that year, whereby:
                                                            <ul class="level-2">
                                                                <li>Average for the year means the total Fees revenue / by
                                                                    the number of days to date.</li>
                                                                <li>Cumulative for the year means the cumulative Fees earned
                                                                    for the year to date.</li>
                                                            </ul>
                                                        </li>
                                                        <li>FY means the financial data selected for that year, whereby:
                                                            <ul class="level-2">
                                                                <li>Average for the year means the total Fees revenue / by
                                                                    the number of days to date.</li>
                                                                <li>Cumulative for the year means the cumulative Fees earned
                                                                    for the year to date.</li>
                                                            </ul>
                                                        </li>
                                                        <li>YoY Growth means:<ul class="level-2">
                                                                <li>Green arrow up means an increase. Red arrow down means a
                                                                    decrease. Yellow dash means no change.</li>
                                                                <li>Com % means the percentage increase or decrease from
                                                                    that year to the year being compared to.</li>
                                                                <li>No. Units means the percentage increase or decrease from
                                                                    that year to the year being compared to.</li>
                                                            </ul>
                                                        </li>

                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    {{-- 2 --}}
                                    <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                                        <div class="row my-3">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered summery-border">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        class="border-left-0 border-bottom-0 border-top-0 text-right">
                                                                        <b>Advertisers</b>
                                                                    </td>
                                                                    <td class="border-0 bg-white text-left">All Advertisers
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        class="border-left-0 border-bottom-0 border-top-0 text-right">
                                                                        <b>Report Generated</b>
                                                                    </td>
                                                                    <td class="border-0 bg-white text-left">12-12-2019</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        class="border-left-0 border-bottom-0 border-top-0 text-right">
                                                                        <b>Produced For</b>
                                                                    </td>
                                                                    <td class="border-0 bg-white text-left">Well Done
                                                                        Accounts</td>
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
                                                                    <td class="text-center">2025 / 2026</td>
                                                                    <td class="bg-first text-right"><b>Total Earnings</b>
                                                                    </td>
                                                                    <td class="text-right">$ 486.60</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bg-first text-right"><b>Select FY</b></td>
                                                                    <td>
                                                                        <select class="rounded-0 w-100">
                                                                            <option class="text-secondary">Select Date
                                                                            </option>
                                                                            <option class="text-secondary">2022</option>
                                                                            <option class="text-secondary"ssssssselect>
                                                                    </td>
                                                                    <td class="bg-first text-right"><b>Average (p / A)</b>
                                                                    </td>
                                                                    <td class="text-right">$ 121.65</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bg-first text-right"><b>Display Type</b>
                                                                    </td>
                                                                    <td>
                                                                        <select class="rounded-0 w-100">
                                                                            <option class="text-secondary">Member ID
                                                                            </option>
                                                                            <option class="text-secondary">Membership Type
                                                                            </option>
                                                                            <option class="text-secondary">Highest Spend
                                                                            </option>
                                                                            <option class="text-secondary">Lowest Spend
                                                                            </option>
                                                                            <option class="text-secondary">Highest
                                                                                Fees
                                                                            </option>
                                                                            <option class="text-secondary">Lowest Fees
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="bg-first text-right"><b>Total
                                                                            Advertisers</b></td>
                                                                    <td class="text-right">4</td>
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
                                                <tbody>


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
                                                            <a class="dropdown-toggle" href="#" role="button"
                                                                id="dropdownMenuLink" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i
                                                                    class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                aria-labelledby="dropdownMenuLink" style="">
                                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                    href="#" data-toggle="modal"
                                                                    data-target="#commission-report"> <i
                                                                        class="fa fa-eye"></i> View Advertiser
                                                                    Report</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                    href="#" data-toggle="modal" data-target="#">
                                                                    <i class="fa fa-print"></i> Print
                                                                    Advertiser Repor</a>
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
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink" style="">
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#commission-report"> <i
                                                                            class="fa fa-eye"></i> View Advertiser
                                                                        Report</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#"> <i class="fa fa-print"></i> Print
                                                                        Advertiser Repor</a>

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
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink" style="">
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#commission-report"> <i
                                                                            class="fa fa-eye"></i> View Advertiser
                                                                        Report</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#"> <i class="fa fa-print"></i> Print
                                                                        Advertiser Repor</a>

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
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink" style="">
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#message-report"> <i
                                                                            class="fa fa-eye"></i> View Masseur
                                                                        Report</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#"> <i class="fa fa-print"></i> Print
                                                                        Masseur Repor</a>

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
    {{-- For Escort Report --}}
    <div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog"
        aria-labelledby="CompetitorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px !important;">
            <div class="modal-content basic-modal">
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
                                    <div class="table-responsive membership--inner">
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
                                                <tr data-toggle="toggle-row" data-target=".group-1"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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
                                                <tr data-toggle="toggle-row" data-target=".group-2"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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
                                                <tr data-toggle="toggle-row" data-target=".group-3"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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
                                                {{-- end --}}


                                                {{-- row 2 --}}
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
                                                {{-- end --}}
                                                {{-- row 3 --}}
                                                <tr>
                                                    <td><b>0</b></td>
                                                    <td><b>0</b></td>
                                                    <td><b>0</b></td>
                                                    <td><b>0</b></td>

                                                </tr>
                                                {{-- end --}}
                                                {{-- total --}}
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
    {{-- end --}}
    {{-- For Massage Report --}}

    <div class="modal fade upload-modal" id="message-report" tabindex="-1" role="dialog"
        aria-labelledby="CompetitorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px !important;">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="message-report">Massage Centre Report: Lin’s Massage (Member ID: M612465)
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
                                    <div class="table-responsive membership--inner">
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
                                                <tr data-toggle="toggle-row" data-target=".group-01"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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

                                                <tr data-toggle="toggle-row" data-target=".group-02"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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
                                                <tr data-toggle="toggle-row" data-target=".group-03"
                                                    data-parent="#collapse-accordion" style="cursor: pointer;">
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between font-weight-bold">
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
                                                    <th colspan="18" style="text-align: center;"><b>Statistics</b> <span
                                                            style=" float: right;"><b>Left = Listings Right =
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
                                                {{-- end --}}
                                                {{-- row02 --}}
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
                                                {{-- end --}}
                                                {{-- row03 --}}
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
    {{-- end --}}
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let isHidden = false;

            $('#hideAlltr').on('click', function() {
                const $chevron = $(this).find('i');

                if (!isHidden) {
                    // Hide only visible rows, and mark them
                    $('#hideAlltr').nextAll('tr:visible').addClass('user-hidden').hide();
                    $chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    isHidden = true;
                } else {
                    // Show only those rows that were hidden by this action
                    $('tr.user-hidden').removeClass('user-hidden').show();
                    $chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    isHidden = false;
                }
            });
        });

        $(document).ready(function() {
            $('.collapse-row').hide(); // 🔒 Hide all groups initially

            $('[data-toggle="toggle-row"]').on('click', function() {
                const targetClass = $(this).data('target');
                const $icon = $(this).find('i.fa');
                const isVisible = $(targetClass).is(':visible');

                $('.collapse-row').not(targetClass).hide();
                $('[data-toggle="toggle-row"] i.fa').removeClass('fa-chevron-up').addClass(
                    'fa-chevron-down');

                if (!isVisible) {
                    $(targetClass).show();
                    $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(targetClass).hide();
                }
            });
        });
    </script>
@endpush
