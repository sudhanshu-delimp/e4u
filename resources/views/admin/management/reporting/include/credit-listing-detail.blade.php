@php 

    $CFY_Till_Date_Credit = stateWalletCredit($currentStart, $currentTodayEnd, $key, $advertiser);
    $LFY_Till_Date_Credit = stateWalletCredit($lastStart, $lastTodayEnd, $key, $advertiser);

    $variation = $CFY_Till_Date_Credit-$LFY_Till_Date_Credit;
    $variation_percentage = $LFY_Till_Date_Credit != 0 ? (($CFY_Till_Date_Credit - $LFY_Till_Date_Credit) / $LFY_Till_Date_Credit) * 100 : 0;

    $LFY_Credit = stateWalletCredit($lastStart, $lastEnd, $key, $advertiser);
    $PFY_Credit = stateWalletCredit($previousStart, $previousEnd, $key, $advertiser);

    $LFY_variation = $LFY_Credit-$PFY_Credit;
    $LFY_variation_percentage = $PFY_Credit != 0 ? (($LFY_Credit - $PFY_Credit) / $PFY_Credit) * 100 : 0;

    $actual_variation = $CFY_Till_Date_Credit-$LFY_Credit;
    $actual_variation_percentage = $LFY_Credit != 0 ? (($CFY_Till_Date_Credit - $LFY_Credit) / $LFY_Credit) * 100 : 0;
@endphp
<tr class="collapse-row group-{{$key}}">
    <td></td>
    <td>{{$advertiser == 3 ? 'Escorts':'Centers'}}</td>
    <td><div class="num_value">$<span>{{formatAmount($CFY_Till_Date_Credit)}}</span></div></td>
    <td colspan="2"><div class="num_value">$<span>{{formatAmount($LFY_Till_Date_Credit)}}</span></div></td>
    <td><div class="num_value">{!! getReportIcon($variation, '$') !!} {{formatAmount($variation)}}</div></td>
    <td><div class="num_value">{!! getReportIcon($variation_percentage) !!} {{formatAmount($variation_percentage)}}</div></td>

    <td colspan="2"><div class="num_value">$<span>{{formatAmount($LFY_Credit)}}</span></div></td>
    <td><div class="num_value">{!! getReportIcon($LFY_variation, '$') !!} {{formatAmount($LFY_variation)}}</div></td>
    <td><div class="num_value">{!! getReportIcon($LFY_variation_percentage) !!} {{formatAmount($LFY_variation_percentage)}}</div></td>

    <td colspan="2"><div class="num_value">$<span>{{formatAmount($CFY_Till_Date_Credit)}}</span></div></td>
    <td ><div class="num_value">{!! getReportIcon($actual_variation, '$') !!} {{formatAmount($actual_variation)}}</div></td>
    <td><div class="num_value">{!! getReportIcon($actual_variation_percentage) !!} {{formatAmount($actual_variation_percentage)}}</div></td>
</tr>