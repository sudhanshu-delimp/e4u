<div class="modal-header">
    <h5 class="modal-title" id="commission-report">
        <img src="{{ asset('assets/dashboard/img/statement-report.png') }}" class="custompopicon">
        Escort Report: {{ $datas['advertiser_name'] }} (Member ID: {{ $datas['member_id'] }})
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
    </button>
</div>
<div class="modal-body">
    <div class="row mb-2">
        <div class="col-sm-8">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-first">
                        <tr>
                            <th rowspan="2">Financial Year</th>
                            <th colspan="4" class="text-center">Spend</th>
                            <th rowspan="2">Totals</th>
                        </tr>
                        <tr>
                            <th>Platinum</th>
                            <th>Gold</th>
                            <th>Silver</th>
                            <th>PinUp</th>
                        </tr>
                    </thead>
                    <tbody id="report-accordion">
                        @foreach ($datas['fy_data'] as $fy => $yearData)
                            @php($groupClass = 'report-group-' . $loop->index)
                            <tr data-toggle="toggle-row" data-target=".{{ $groupClass }}" data-parent="#report-accordion" style="cursor: pointer;">
                                <td><div class="d-flex align-items-center justify-content-between font-weight-bold"><span>{{ $yearData['fy_label'] }}</span><i class="fa fa-chevron-down"></i></div></td>
                                <td><b>{{ formatCurrency($yearData['fy_totals']['platinum']) }}</b></td>
                                <td><b>{{ formatCurrency($yearData['fy_totals']['gold']) }}</b></td>
                                <td><b>{{ formatCurrency($yearData['fy_totals']['silver']) }}</b></td>
                                <td><b>{{ formatCurrency($yearData['fy_totals']['pinup']) }}</b></td>
                                <td><b>{{ formatCurrency($yearData['fy_totals']['total']) }}</b></td>
                            </tr>
                            @foreach ($yearData['states'] as $location => $spend)
                                <tr class="collapse-row {{ $groupClass }}">
                                    <td><b>{{ $location }}</b></td>
                                    <td>{{ formatCurrency($spend['platinum']) }}</td>
                                    <td>{{ formatCurrency($spend['gold']) }}</td>
                                    <td>{{ formatCurrency($spend['silver']) }}</td>
                                    <td>{{ formatCurrency($spend['pinup']) }}</td>
                                    <td>{{ formatCurrency($spend['total']) }}</td>
                                </tr>
                            @endforeach
                            <tr class="collapse-row {{ $groupClass }}">
                                <td class="text-right"><b>Totals</b></td>
                                <td class="total_row"><b>{{ formatCurrency($yearData['fy_totals']['platinum']) }}</b></td>
                                <td class="total_row"><b>{{ formatCurrency($yearData['fy_totals']['gold']) }}</b></td>
                                <td class="total_row"><b>{{ formatCurrency($yearData['fy_totals']['silver']) }}</b></td>
                                <td class="total_row"><b>{{ formatCurrency($yearData['fy_totals']['pinup']) }}</b></td>
                                <td class="total_row"><b>{{ formatCurrency($yearData['fy_totals']['total']) }}</b></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><b>Totals</b></td>
                            <td><b>{{ formatCurrency($datas['grand_totals']['platinum']) }}</b></td>
                            <td><b>{{ formatCurrency($datas['grand_totals']['gold']) }}</b></td>
                            <td><b>{{ formatCurrency($datas['grand_totals']['silver']) }}</b></td>
                            <td><b>{{ formatCurrency($datas['grand_totals']['pinup']) }}</b></td>
                            <td><b>{{ formatCurrency($datas['grand_totals']['total']) }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-first">
                        <tr><th colspan="4" class="text-center">Statistics</th></tr>
                        <tr>
                            <th>Listings</th>
                            <th>Total Days</th>
                            <th>Tours</th>
                            <th>Total Days</th>
                        </tr>
                    </thead>
                    <tbody id="statistics-accordion">
                        @foreach ($datas['fy_data'] as $yearData)
                            @php($groupClass = 'report-group-' . $loop->index)
                            <tr>
                                <td><b>{{ $yearData['fy_totals']['listings'] }}</b></td>
                                <td><b>{{ $yearData['fy_totals']['listing_days'] }}</b></td>
                                <td><b>{{ $yearData['fy_totals']['tours'] }}</b></td>
                                <td><b>{{ $yearData['fy_totals']['tour_days'] }}</b></td>
                            </tr>
                            @foreach ($yearData['states'] as $spend)
                                <tr class="collapse-row {{ $groupClass }}">
                                    <td>{{ $spend['listings'] }}</td>
                                    <td>{{ $spend['listing_days'] }}</td>
                                    <td>{{ $spend['tours'] }}</td>
                                    <td>{{ $spend['tour_days'] }}</td>
                                </tr>
                            @endforeach
                            <tr class="collapse-row {{ $groupClass }}">
                                <td class="total_row"><b>{{ $yearData['fy_totals']['listings'] }}</b></td>
                                <td class="total_row"><b>{{ $yearData['fy_totals']['listing_days'] }}</b></td>
                                <td class="total_row"><b>{{ $yearData['fy_totals']['tours'] }}</b></td>
                                <td class="total_row"><b>{{ $yearData['fy_totals']['tour_days'] }}</b></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="total_row"><b>{{ $datas['grand_totals']['listings'] }}</b></td>
                            <td class="total_row"><b>{{ $datas['grand_totals']['listing_days'] }}</b></td>
                            <td class="total_row"><b>{{ $datas['grand_totals']['tours'] }}</b></td>
                            <td class="total_row"><b>{{ $datas['grand_totals']['tour_days'] }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
