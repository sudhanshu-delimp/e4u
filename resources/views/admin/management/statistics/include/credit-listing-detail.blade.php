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
    <td>{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
    <td colspan="2">{{formatCurrency($LFY_Till_Date_Credit, '' , false)}}</td>
    <td >{{formatCurrency($variation, '' , false)}}</td>
    <td>{{$variation_percentage}}</td>
    <td colspan="2">{{formatCurrency($LFY_Credit, '' , false)}}</td>
    <td >{{formatCurrency($LFY_variation, '' , false)}}</td>
    <td>{{$LFY_variation_percentage}}</td>
    <td colspan="2">{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
    <td >{{formatCurrency($actual_variation, '' , false)}}</td>
    <td>{{$actual_variation_percentage}}</td>
</tr>