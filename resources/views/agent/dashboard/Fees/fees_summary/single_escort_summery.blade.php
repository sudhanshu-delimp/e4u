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
                            <th colspan="5" class="text-center">Spend</th>
                            <th rowspan="2">Totals</th>
                        </tr>
                        <tr>
                            <th>Platinum</th>
                            <th>Gold</th>
                            <th>Silver</th>
                            <th>PinUp</th>
                            <th>Fixed</th>
                        </tr>
                    </thead>
                    <tbody id="report-accordion">
                        @foreach ($datas['fy_data'] as $fy => $yearData)
                            @php($groupClass = 'report-group-' . $loop->index)
                            <tr data-toggle="toggle-row" data-target=".{{ $groupClass }}" data-parent="#report-accordion" style="cursor: pointer;">
                                <td><div class="d-flex align-items-center justify-content-between font-weight-bold"><span>{{ $yearData['fy_label'] }}</span><i class="fa fa-chevron-down"></i></div></td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['platinum'], ' ') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['gold'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['silver'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['pinup'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['fixed'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="text-right">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['total'], '') }}</span>
                                        </div>
                                    </b>
                                </td>




                                {{-- <td><b>{{ formatCurrency($yearData['fy_totals']['total']) }}</b></td> --}}
                            </tr>
                            @foreach ($yearData['states'] as $location => $spend)
                                <tr class="collapse-row {{ $groupClass }}">
                                    <td><b>{{ $location }}</b></td>
                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['platinum'], '') }}</span>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['gold'], '') }}</span>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['silver'], '') }}</span>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['pinup'], '') }}</span>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['fixed'], '') }}</span>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{  formatCurrency($spend['total'], '') }}</span>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                            <tr class="collapse-row {{ $groupClass }}">
                                <td class="text-right"><b>Totals</b></td>
                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['platinum'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['gold'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['silver'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['pinup'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['fixed'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                                <td class="total_row">
                                    <b>
                                        <div class="num_value">
                                            <span class="currency">$</span>
                                            <span class="amount">{{ formatCurrency($yearData['fy_totals']['total'], '') }}</span>
                                        </div>
                                    </b>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><b>Totals</b></td>
                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['platinum'], '') }}</span>
                                    </div>
                                </b>
                            </td>


                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['gold'], '') }}</span>
                                    </div>
                                </b>
                            </td>

                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['silver'], '') }}</span>
                                    </div>
                                </b>
                            </td>

                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['pinup'], '') }}</span>
                                    </div>
                                </b>
                            </td>

                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['fixed'], '') }}</span>
                                    </div>
                                </b>
                            </td>

                            <td>
                                <b>
                                    <div class="num_value">
                                        <span class="currency">$</span>
                                        <span class="amount">{{formatCurrency($datas['grand_totals']['total'], '') }}</span>
                                    </div>
                                </b>
                            </td>

                            

                            {{-- <td><b>{{ formatCurrency($datas['grand_totals']['total']) }}</b></td> --}}
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
