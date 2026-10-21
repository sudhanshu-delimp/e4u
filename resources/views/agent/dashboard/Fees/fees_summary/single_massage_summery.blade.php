<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="message-report">
            <img src="{{ asset('assets/dashboard/img/statement-report.png') }}" class="custompopicon">
            Massage Centre Report: {{ $datas['advertiser_name'] }} (Member ID: {{ $datas['member_id'] ?: 'N/A' }})
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                    class="img-fluid img_resize_in_smscreen"></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="row mb-2">
                <div class="col-sm-4 pl-0">
                    <div class="card border-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-first">
                                    <tr>
                                        <th rowspan="2" style="width: 30%"><b>Financial Year</b></th>
                                        <th colspan="3" style="text-align: center;"><b>Spend</b></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%"><b>Value</b></th>
                                        <th><b>Listings</b></th>
                                        <th><b>Total Days</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas['fy_data'] as $fy)
                                        <tr>
                                            <td><span>{{ $fy['fy_label'] }}</span></td>
                                            <td class="text-right">$ {{ number_format($fy['fy_totals']['total'], 2) }}</td>
                                            <td class="text-right">{{ $fy['fy_totals']['listings'] }}</td>
                                            <td class="text-right">{{ $fy['fy_totals']['listing_days'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No listed massage purchases found.</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td class="text-right"><b>Totals</b></td>
                                        <td class="text-right total_row">
                                            <b>$ {{ number_format($datas['grand_totals']['total'], 2) }}</b>
                                        </td>
                                        <td class="text-right total_row"><b>{{ $datas['grand_totals']['listings'] }}</b></td>
                                        <td class="text-right total_row"><b>{{ $datas['grand_totals']['listing_days'] }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 pl-0 pr-0">
                    <div class="card border-0">
                        <div class="table-responsive-xl">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-first">
                                    <tr>
                                        <th colspan="{{ max(count($datas['masseurs']) * 2, 2) }}" style="text-align: center;">
                                            <b>Statistics</b>
                                            <span style="float: right;"><b>Left = Listings Right = Days</b></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach ($datas['masseurs'] as $index => $masseur)
                                            <th colspan="2">
                                                <b>Masseur {{ $index + 1 }} ({{ $masseur->member_id ?: 'N/A' }})</b>
                                            </th>
                                        @endforeach
                                        @if (count($datas['masseurs']) === 0)
                                            <th colspan="2"><b>No masseurs</b></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($datas['masseurs']) > 0)
                                        @forelse ($datas['fy_data'] as $fy)
                                            <tr>
                                                @foreach ($datas['masseurs'] as $masseur)
                                                    <td>{{ $fy['masseurs'][$masseur->id]['listings'] ?? 0 }}</td>
                                                    <td>{{ $fy['masseurs'][$masseur->id]['days'] ?? 0 }}</td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ max(count($datas['masseurs']) * 2, 2) }}" class="text-center">No statistics available.</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            @foreach ($datas['masseurs'] as $masseur)
                                                <td class="total_row"><b>{{ $datas['grand_totals']['masseurs'][$masseur->id]['listings'] ?? 0 }}</b></td>
                                                <td class="total_row"><b>{{ $datas['grand_totals']['masseurs'][$masseur->id]['days'] ?? 0 }}</b></td>
                                            @endforeach
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="2" class="text-center">No statistics available.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
