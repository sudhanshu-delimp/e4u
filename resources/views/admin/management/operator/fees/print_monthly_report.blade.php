<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Operator Montly Fee Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/dashboard/css/dk-style.css?v1.2') }}" rel="stylesheet">

    <style>
        

        @page {
            size: A4;margin: 20px;
        }
       

body {
    margin: 0;
    padding: 0;
}

        h2 {
            font-size: 16px;
            font-weight: bold;
        }

        h6 {
            font-size: 16px;
        }

        .table td {
            vertical-align: middle;
        }

        table td {
            padding: .75rem;
            color: #333 !important;
            font-size: 12px;
        }

        table th {
            padding: .45rem .75rem .55rem !important;
            font-size: 12px;
            font-weight: 500;
            vertical-align: middle;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body style="margin:0;width:100%">
    @php
        $totalMassageDays = 0;
        $totalMassageSpent = 0;
        $totalMassageAgenFee = 0;
        $totalEscortDays = 0;
        $totalEscortSpent = 0;
        $totalEscortAgenFee = 0;
        $cnt = 0;

        $path = public_path('/assets/dashboard/img/admin-report.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    @endphp
    @if (count($feeDatas) > 0)
        <table class="table mb-0 common_accordian_table" style="background-color:#0c223d;">
            <tr>
                <td style="text-align: left !important;"> <span>
                        <img src="{{ $base64 }}" style="width: 25px;">
                    </span><span
                        style="color:#fff; font-weight:bold;text-align: left !important;padding-top:-20px;font-size: 14px;">Operator
                        Montly Fee Report (Period Ending: {{ $reportEndDate }})</span> </td>
                <td style="text-align: right">
                    <span
                        style="color:#fff; font-weight:bold;text-align: right !important;padding-top:-20px;font-size: 14px;">Operator
                        ID: {{ $operatorMemberId }}</span>
                </td>
            </tr>
        </table>
        <table class="table" style="border: 1px solid #ccc;padding: 0;">
            <tr>
                <td style="width: 100%;padding: 10px 5px 20px 5px;">
                    <table class="table mb-0 common_accordian_table">
                        <thead class="table-bg modal-thaed">
                            <tr>
                                <th>Agent ID</th>
                                <th>Name</th>
                                <th>Territory</th>
                                <th>Type</th>
                                <th>Days</th>
                                <th>Spend</th>
                                <th>Fee</th>
                            </tr>
                        </thead>
                        <tbody id="accordionParent">
                            @foreach ($feeDatas as $agentId => $feeData)
                                @php
                                    $esortReports = isset($feeData[3]) ? $feeData[3] : [];
                                    $massgeReports = isset($feeData[4]) ? $feeData[4] : [];
                                    $reportEndDate = isset($feeData['report_end_date'])
                                        ? $feeData['report_end_date']
                                        : '';
                                    $agentMemberId = isset($feeData['agent_member_id'])
                                        ? $feeData['agent_member_id']
                                        : '';

                                @endphp
                                {{-- Start escort listing --}}
                                @if (count($esortReports) > 0)
                                    @foreach ($esortReports as $esortReport)
                                        @php
                                            $totalEscortDays = $totalEscortDays + $esortReport['total_days'];
                                            $totalEscortSpent =
                                                $totalEscortSpent + $esortReport['total_purchase_amount'];
                                            $totalEscortAgenFee =
                                                $totalEscortAgenFee + $esortReport['total_commission_amount'];
                                            $cnt++;
                                        @endphp

                                        <tr class="accordion-toggle" data-toggle="collapse"
                                            data-target="#details{{ $cnt }}" aria-expanded="false"
                                            aria-controls="details{{ $cnt }}">
                                            <td class="text-left">{{ $agentMemberId }}</td>
                                            <td class="opr_expand_arrow">{{ $esortReport['user_name'] }}<i
                                                    class="fa fa-chevron-down"></i>
                                            </td>
                                            <td>{{ $esortReport['user_state_name'] }}</td>
                                            <td></td>
                                            <td>{{ $esortReport['total_days'] }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ $esortReport['total_purchase_amount'] }}</span></div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ $esortReport['total_commission_amount'] }}</span></div>
                                            </td>
                                        </tr>
                                        <!-- Detail rows -->
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td title="Platinum">P</td>
                                            <td>{{ $esortReport['details']['P']['days'] ?? 0 }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['P']['purchase'], 2, '.', '') ?? 0.0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['P']['commission'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td title="Gold">G</td>
                                            <td>{{ $esortReport['details']['G']['days'] ?? 0 }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['G']['purchase'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['G']['commission'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td title="Silver">S</td>
                                            <td>{{ $esortReport['details']['S']['days'] ?? 0 }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['S']['purchase'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['S']['commission'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td title="Pin Up">PU</td>
                                            <td>{{ $esortReport['details']['PU']['days'] ?? 0 }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['PU']['purchase'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['PU']['commission'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Bump UP -->
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td title="Bump Up">BU</td>
                                            <td>{{ $esortReport['details']['EBU']['days'] ?? 0 }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['EBU']['purchase'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['details']['EBU']['commission'], 2, '.', '') ?? 0 }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- Start escort sub-total --}}
                                        <tr>
                                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                                            <td
                                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">
                                                {{ $esortReport['total_days'] }}
                                            </td>
                                            <td
                                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['total_purchase_amount'], 2, '.', '') }}</span>
                                                </div>
                                            </td>
                                            <td
                                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                                <div class="num_value">
                                                    $<span>{{ number_format($esortReport['total_commission_amount'], 2, '.', '') }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td colspan="7" style="padding:10px"></td>
                                        </tr>
                                        {{-- End escort sub-total --}}
                                        @php
                                            $agentMemberId = '';
                                        @endphp
                                    @endforeach

                                    {{-- Start Escort Total --}}
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total Escorts:</strong></td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                                            {{ $totalEscortDays }}
                                        </td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                            <div class="num_value">
                                                $<span>{{ number_format($totalEscortSpent, 2, '.', '') }}</span>
                                            </div>
                                        </td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                            <div class="num_value">
                                                $<span>{{ number_format($totalEscortAgenFee, 2, '.', '') }}</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" style="padding:10px"></td>
                                    </tr>
                                @endif
                                {{-- End Escort Total --}}

                                {{-- end escort listing --}}

                                {{-- Start massage listing --}}
                                @if (count($massgeReports) > 0)
                                    @foreach ($massgeReports as $massgeReport)
                                        @php
                                            $totalMassageDays = $totalMassageDays + $massgeReport['total_days'];
                                            $totalMassageSpent =
                                                $totalMassageSpent + $massgeReport['total_purchase_amount'];
                                            $totalMassageAgenFee =
                                                $totalMassageAgenFee + $massgeReport['total_commission_amount'];
                                        @endphp

                                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details3"
                                            aria-expanded="false" aria-controls="details3">
                                            <td class="text-left">{{ $agentMemberId }}</td>
                                            <td class="opr_expand_arrow">{{ $massgeReport['user_name'] }}</td>
                                            <td>{{ $massgeReport['user_state_name'] }}</td>
                                            <td></td>
                                            <td>{{ $massgeReport['total_days'] }}</td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($massgeReport['total_purchase_amount'], 2, '.', '') }}
                                                    </span></div>
                                            </td>
                                            <td class="text-left">
                                                <div class="num_value">
                                                    $<span>{{ number_format($massgeReport['total_commission_amount'], 2, '.', '') }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- space --}}
                                        <tr>
                                            <td colspan="7" style="padding:10px"></td>
                                        </tr>
                                        {{-- end --}}
                                        @php
                                            $agentMemberId = '';
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total Massage Centres:</strong>
                                        </td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                                            {{ $totalMassageDays }}
                                        </td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                            <div class="num_value">
                                                $<span>{{ number_format($totalMassageSpent, 2, '.', '') }}</span>
                                            </div>
                                        </td>
                                        <td
                                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                            <div class="num_value">
                                                $<span>{{ number_format($totalMassageAgenFee, 2, '.', '') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- End massage listing --}}
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            @php
                                $totalDays = $totalMassageDays + $totalEscortDays;
                                $totalSpent = number_format($totalMassageSpent + $totalEscortSpent, 2, '.', '');
                                $totalAgenFee = number_format($totalMassageAgenFee + $totalEscortAgenFee, 2, '.', '');
                            @endphp

                            {{-- Start Total Advertisers --}}

                            <tr>
                                <td colspan="7" style="padding:10px"></td>
                            </tr>

                            <tr>
                                <td colspan="4" class="text-right"><strong>Total Advertisers:</strong></td>
                                <td
                                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                                    {{ $totalDays }}</td>
                                <td
                                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                    <div class="num_value">$<span>{{ number_format($totalSpent, 2, '.', '') }}</span>
                                    </div>
                                </td>
                                <td
                                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                    <div class="num_value">
                                        $<span>{{ number_format($totalAgenFee, 2, '.', '') }}</span></div>
                                </td>
                            </tr>
                            {{-- Start Total Advertisers --}}

                        </tfoot>

                    </table>
                </td>
            </tr>
        </table>
    @endif
</body>
</html>
