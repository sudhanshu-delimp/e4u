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
    <td><div class="num_value">$<span>{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</span></div></td>
    <td colspan="2"><div class="num_value">$<span>{{formatCurrency($LFY_Till_Date_Credit, '' , false)}}</span></div></td>
    <td><div class="num_value">{{formatCurrency($variation, '' , false)}}</div></td>
    <td><div class="num_value">{{round($variation_percentage, 2)}}</div></td>

    <td colspan="2"><div class="num_value">$<span>{{formatCurrency($LFY_Credit, '' , false)}}</span></div></td>
    <td><div class="num_value">{{formatCurrency($LFY_variation, '' , false)}}</div></td>
    <td><div class="num_value">{{round($LFY_variation_percentage, 2)}}</div></td>

    <td colspan="2"><div class="num_value">$<span>{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</span></div></td>
    <td ><div class="num_value">{{formatCurrency($actual_variation, '' , false)}}</div></td>
    <td><div class="num_value">{{round($actual_variation_percentage, 2)}}</div></td>
</tr>