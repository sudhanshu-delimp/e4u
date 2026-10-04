@php
    $reportEndDate = "";
    $totalMassageDays = 0;
    $totalMassageSpent = 0;
    $totalMassageAgenFee = 0;
    $totalEscortDays = 0;
    $totalEscortSpent = 0;
    $totalEscortAgenFee = 0;
    $cnt = 0;
@endphp
@if (count($feeDatas) > 0)
    <table class="table table-bordered mb-0 common_accordian_table">
        <thead class="table-bg modal-thaed">
            <tr>
                <th class="text-left">Agent ID</th>
                <th class="text-left">Name</th>
                <th>Territory</th>
                <th>Type</th>
                <th class="text-center">Days</th>
                <th class="text-left">Spend</th>
                <th class="text-left">Fee</th>
            </tr>
        </thead>
        <tbody id="accordionParent">
            @foreach ($feeDatas as $agentId => $feeData)
                @php
                    $esortReports = isset($feeData[3]) ? $feeData[3] : collect();
                    $massgeReports = isset($feeData[4]) ? $feeData[4] : collect();
                    $reportEndDate = isset($feeData['report_end_date']) ? $feeData['report_end_date'] : '';
                    $agentMemberId = isset($feeData['agent_member_id']) ? $feeData['agent_member_id'] : '';
                    $escortDays = 0;
                    $escortSpent = 0;
                    $escortAgenFee = 0;
                    $massageDays =  0;
                    $massageSpent =  0;
                    $massageSpent =  0;

                @endphp
                {{-- Start escort listing --}}
                @if (count($esortReports) > 0)
                    @foreach ($esortReports as $esortReport)
                        @php
                            $totalEscortDays = $totalEscortDays + $esortReport['total_days'];
                            $totalEscortSpent = $totalEscortSpent + $esortReport['total_purchase_amount'];
                            $totalEscortAgenFee = $totalEscortAgenFee + $esortReport['total_commission_amount'];
                            $cnt++;
                            $escortDays = $escortDays + $esortReport['total_days'];
                            $escortSpent = $escortSpent + $esortReport['total_purchase_amount'];
                            $escortAgenFee = $escortAgenFee + $esortReport['total_commission_amount'];
                        @endphp

                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details{{ $cnt }}"
                            aria-expanded="false" aria-controls="details{{ $cnt }}">
                            <td class="text-left">{{  $agentMemberId }}</td>
                            <td class="opr_expand_arrow">{{ $esortReport['user_name'] }}<i
                                    class="fa fa-chevron-down"></i>
                            </td>
                            <td>{{ $esortReport['user_state_name'] }}</td>
                            <td></td>
                            <td class="text-center">{{ $esortReport['total_days'] }}</td>
                            <td class="text-right">
                                <div class="num_value">$<span>{{ $esortReport['total_purchase_amount'] }}</span></div>
                            </td>
                            <td class="text-right">
                                <div class="num_value">$<span>{{ $esortReport['total_commission_amount'] }}</span></div>
                            </td>
                        </tr>
                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td title="Platinum">P</td>
                            <td class="text-center">{{ $esortReport['details']['P']['days'] ?? 0 }}</td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['P']['purchase'], 2) ?? 0.0 }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['P']['commission'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td title="Gold">G</td>
                            <td class="text-center">{{ $esortReport['details']['G']['days'] ?? 0 }}</td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['G']['purchase'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['G']['commission'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td title="Silver">S</td>
                            <td class="text-center">{{ $esortReport['details']['S']['days'] ?? 0 }}</td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['S']['purchase'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['S']['commission'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td title="Pin Up">PU</td>
                            <td class="text-center">{{ $esortReport['details']['PU']['days'] ?? 0 }}</td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['PU']['purchase'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['PU']['commission'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                        </tr>
                        <!-- Bump UP -->
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td title="Bump Up">BU</td>
                            <td class="text-center">{{ $esortReport['details']['EBU']['days'] ?? 0 }}</td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['EBU']['purchase'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['details']['EBU']['commission'], 2) ?? 0 }}</span>
                                </div>
                            </td>
                        </tr>
                        {{-- Start escort sub-total --}}
                        <tr class="detail-row" data-group="details{{ $cnt }}">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold;text-align:center;">
                                {{ $esortReport['total_days'] }}
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['total_purchase_amount'], 2) }}</span>
                                </div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">
                                    $<span>{{ number_format($esortReport['total_commission_amount'], 2) }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- End escort sub-total --}}
                        @php 
                        $agentMemberId = "";
                        @endphp
                    @endforeach

                    {{-- Start Escort Total Agent wise --}}
                    <tr>
                        <td colspan="4" class="text-right"><strong>Escorts:</strong></td>
                        <td style="border-top: 2px solid #444; border-bottom:2px solid #444; font-weight:bold;text-align:center;">
                            {{ $escortDays }}
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:2px solid #444; font-weight:bold; text-align:right;">
                            <div class="num_value">$<span>{{ number_format($escortSpent, 2) }}</span>
                            </div>
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:2px solid #444; font-weight:bold; text-align:right;">
                            <div class="num_value">$<span>{{ number_format($escortAgenFee, 2) }}</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="7" style="padding:10px"></td>
                    </tr>
                     {{-- End Escort Total Agent wise --}}
                @endif
               

                {{-- end escort listing --}}

                {{-- Start massage listing --}}
                @if (count($massgeReports) > 0)
                    @foreach ($massgeReports as $massgeReport)
                        @php
                            $totalMassageDays = $totalMassageDays + $massgeReport['total_days'];
                            $totalMassageSpent = $totalMassageSpent + $massgeReport['total_purchase_amount'];
                            $totalMassageAgenFee = $totalMassageAgenFee + $massgeReport['total_commission_amount'];

                            $massageDays = $massageDays + $massgeReport['total_days'];
                            $massageSpent = $massageSpent + $massgeReport['total_purchase_amount'];
                            $massageSpent = $massageSpent + $massgeReport['total_commission_amount'];
                        @endphp

                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details3"
                            aria-expanded="false" aria-controls="details3">
                            <td class="text-left">{{ $agentMemberId }}</td>
                            <td class="opr_expand_arrow">{{ $massgeReport['user_name'] }}</td>
                            <td>{{ $massgeReport['user_state_name'] }}</td>
                            <td></td>
                            <td class="text-right">{{ $massgeReport['total_days'] }}</td>
                            <td class="text-right">
                                <div class="num_value">
                                    $<span>{{ number_format($massgeReport['total_purchase_amount'], 2) }}
                                    </span></div>
                            </td>
                            <td class="text-right">
                                <div class="num_value">
                                    $<span>{{ number_format($massgeReport['total_commission_amount'], 2) }}</span>
                                </div>
                            </td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                          @php 
                        $agentMemberId = "";
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Massage Centres:</strong></td>
                        <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:center;">
                            {{ $massageDays }}
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:center;">
                            <div class="num_value">$<span>{{ number_format($massageSpent, 2) }}</span>
                            </div>
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:center;">
                            <div class="num_value">$<span>{{ number_format($massageAgenFee, 2) }}</span>
                            </div>
                        </td>
                    </tr>
                    {{-- End massage listing --}}
                @endif
            @endforeach

             {{-- Start Escort Total --}}
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Escorts:</strong></td>
                        <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:center;">
                            {{ $totalEscortDays }}
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:right;">
                            <div class="num_value">$<span>{{ number_format($totalEscortSpent, 2) }}</span>
                            </div>
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:right;">
                            <div class="num_value">$<span>{{ number_format($totalEscortAgenFee, 2) }}</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="7" style="padding:10px"></td>
                    </tr>
                     {{-- End Escort Total --}}
                    @if( $totalMassageDays > 0)
                     <tr>
                        <td colspan="4" class="text-right"><strong>Total Massage Centres:</strong></td>
                        <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:center;">
                            {{ $totalMassageDays }}
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:center;">
                            <div class="num_value">$<span>{{ number_format($totalMassageSpent, 2) }}</span>
                            </div>
                        </td>
                        <td
                            style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:center;">
                            <div class="num_value">$<span>{{ number_format($totalMassageAgenFee, 2) }}</span>
                            </div>
                        </td>
                    </tr>
                      <tr>
                        <td colspan="7" style="padding:10px"></td>
                    </tr>
                    @endif
        </tbody>

        <tfoot>
            @php
                $totalDays = $totalMassageDays + $totalEscortDays;
                $totalSpent = $totalMassageSpent + $totalEscortSpent;
                $totalAgenFee = $totalMassageAgenFee + $totalEscortAgenFee;
            @endphp

            {{-- Start Total Advertisers --}}

            <tr>
                <td colspan="7" style="padding:10px"></td>
            </tr>

            <tr>
                <td colspan="4" class="text-right"><strong>Total Advertisers:</strong></td>
                <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:center;">
                    {{ $totalDays }}</td>
                <td
                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:ricenterght;">
                    <div class="num_value">$<span>{{ number_format($totalSpent, 2) }}</span></div>
                </td>
                <td
                    style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold;text-align:center;">
                    <div class="num_value">$<span>{{ number_format($totalAgenFee, 2) }}</span></div>
                </td>
            </tr>
            {{-- Start Total Advertisers --}}

        </tfoot>
    </table>
@endif

<!-- opr_accordian_table JS -->
<script>
    $(document).ready(function() {
        $("#reportendDate").html('Operator Montly Fee Report (Period Ending: {{ $reportEndDate }})');
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
