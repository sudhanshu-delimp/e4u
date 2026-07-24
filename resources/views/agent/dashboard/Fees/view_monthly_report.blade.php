@php
    $reportEndDate = isset($feeData['report_end_date']) ? $feeData['report_end_date'] : '';
    $esortReports = isset($feeData[3]) ? $feeData[3] : collect();
    //echo "<pre/>";
    //print_r($feeData);die;

    $massgeReports = isset($feeData[4]) ? $feeData[4] : collect();

    $totalMassageDays = 0;
    $totalMassageSpent = 0;
    $totalMassageAgenFee = 0;
    $totalEscortDays = 0;
    $totalEscortSpent = 0;
    $totalEscortAgenFee = 0;
@endphp
@if ($esortReports->isNotEmpty() || $massgeReports->isNotEmpty())
    <table class="table table-bordered mb-0 common_accordian_table">
        <thead class="table-bg modal-thaed">
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>Territory</th>
                <th>Type</th>
                <th>Days</th>
                <th>Spend</th>
                <th>Fee</th>
            </tr>
        </thead>
        <tbody id="accordionParent">
            {{-- Start escort listing --}}
            @if ($esortReports->isNotEmpty())



                @foreach ($esortReports as $esortReport)
                    @php
                        $totalEscortDays = $totalEscortDays + $esortReport['total_days'];
                        $totalEscortSpent = $totalEscortSpent + $esortReport['total_purchase_amount'];
                        $totalEscortAgenFee = $totalEscortAgenFee + $esortReport['total_commission_amount'];
                    @endphp

                    <tr class="accordion-toggle" data-toggle="collapse" data-target="#details1" aria-expanded="false"
                        aria-controls="details1">
                        <td class="text-left">{{ $esortReport['user_member_id'] }}</td>
                        <td class="opr_expand_arrow">{{ $esortReport['user_name'] }}<i class="fa fa-chevron-down"></i>
                        </td>
                        <td>{{ $esortReport['user_state_name'] }}</td>
                        <td></td>
                        <td>{{ $esortReport['total_days'] }}</td>
                        <td class="text-left">
                            <div class="num_value">$<span>{{ $esortReport['total_purchase_amount'] }}</span></div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>{{ $esortReport['total_commission_amount'] }}</span></div>
                        </td>
                    </tr>
                    <!-- Detail rows -->
                    <tr class="detail-row" data-group="details1">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>P</td>
                        <td>22</td>
                        <td class="text-left">
                            <div class="num_value">$<span>176.00</span></div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>8.80</span></div>
                        </td>
                    </tr>
                    <tr class="detail-row" data-group="details1">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>G</td>
                        <td>4</td>
                        <td class="text-left">
                            <div class="num_value">$<span>24.00</span></div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>1.20</span></div>
                        </td>
                    </tr>
                    <tr class="detail-row" data-group="details1">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>S</td>
                        <td>2</td>
                        <td class="text-left">
                            <div class="num_value">$<span>8.00</span></div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>0.40</span></div>
                        </td>
                    </tr>
                    <tr class="detail-row" data-group="details1">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>PU</td>
                        <td>7</td>
                        <td class="text-left">
                            <div class="num_value">$<span>475.00</span></div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>23.75</span></div>
                        </td>
                    </tr>
                    {{-- Start escort sub-total --}}
                    <tr class="detail-row" data-group="details1">
                        <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                        <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">
                            {{ $esortReport['total_days'] }}
                        </td>
                        <td
                            style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                            <div class="num_value">$<span>{{ $esortReport['total_purchase_amount'] }}</div>
                        </td>
                        <td
                            style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                            <div class="num_value">$<span>{{ $esortReport['total_commission_amount'] }}</div>
                        </td>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="7" style="padding:10px"></td>
                    </tr>
                    {{-- End escort sub-total --}}
                @endforeach

                {{-- Start Escort Total --}}
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Escorts:</strong></td>
                    <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                        {{ $totalEscortDays }}
                    </td>
                    <td
                        style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                        <div class="num_value">$<span>{{ number_format($totalEscortSpent, 2, '.', '') }}</div>
                    </td>
                    <td
                        style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                        <div class="num_value">$<span>{{ number_format($totalEscortAgenFee, 2, '.', '') }}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="7" style="padding:10px"></td>
                </tr>
            @endif
            {{-- End Escort Total --}}

            {{-- end escort listing --}}

            {{-- Start massage listing --}}
            @if ($massgeReports->isNotEmpty())

                @foreach ($massgeReports as $massgeReport)
                    @php
                        $totalMassageDays = $totalMassageDays + $massgeReport['total_days'];
                        $totalMassageSpent = $totalMassageSpent + $massgeReport['total_purchase_amount'];
                        $totalMassageAgenFee = $totalMassageAgenFee + $massgeReport['total_commission_amount'];
                    @endphp

                    <tr class="accordion-toggle" data-toggle="collapse" data-target="#details3" aria-expanded="false"
                        aria-controls="details3">
                        <td class="text-left">{{ $massgeReport['user_member_id'] }}</td>
                        <td class="opr_expand_arrow">{{ $massgeReport['user_name'] }}</td>
                        <td>{{ $massgeReport['user_state_name'] }}</td>
                        <td></td>
                        <td>{{ $massgeReport['total_days'] }}</td>
                        <td class="text-left">
                            <div class="num_value">$<span>{{ $massgeReport['total_purchase_amount'] }}</div>
                        </td>
                        <td class="text-left">
                            <div class="num_value">$<span>{{ $massgeReport['total_commission_amount'] }}</div>
                        </td>
                    </tr>
                    {{-- space --}}
                    <tr>
                        <td colspan="7" style="padding:10px"></td>
                    </tr>
                    {{-- end --}}
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Massage Centres:</strong></td>
                    <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                        {{ $totalMassageDays }}
                    </td>
                    <td
                        style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                        <div class="num_value">$<span>{{ number_format($totalMassageSpent, 2, '.', '') }}</div>
                    </td>
                    <td
                        style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                        <div class="num_value">$<span>{{ number_format($totalMassageAgenFee, 2, '.', '') }}</div>
                    </td>
                </tr>
                {{-- End massage listing --}}
            @endif

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
                <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">
                    {{ $totalDays }}</td>
                <td
                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                    <div class="num_value">$<span>{{ $totalSpent }}</div>
                </td>
                <td
                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                    <div class="num_value">$<span>{{ $totalAgenFee }}</div>
                </td>
            </tr>
            {{-- Start Total Advertisers --}}

        </tfoot>
    </table>
@endif

<!-- opr_accordian_table JS -->
<script>
    $(document).ready(function() {
        $("#reportendDate").html('Fee Report (Period Ending: {{ $reportEndDate }})');
    });
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
