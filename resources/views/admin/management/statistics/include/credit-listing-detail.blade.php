@php
    $currentYearCreditAmountNow = stateWalletCredit($key, $currentStart, $currentEndDate, $advertiser);
    $previousYearCreditAmountNow = stateWalletCredit($key, $previousStart, $previousEndDate, $advertiser);

    $variation = $currentYearCreditAmountNow-$previousYearCreditAmountNow;
    $variation_percentage = $previousYearCreditAmountNow != 0
    ? (($currentYearCreditAmountNow - $previousYearCreditAmountNow) / $previousYearCreditAmountNow) * 100
    : null;

    $previousYearCreditAmount = stateWalletCredit($key, $previousStart, $previousEnd, $advertiser);

    $previous_year_variation = $previousYearCreditAmount-$currentYearCreditAmountNow;
    $previous_year_variation_percentage = $previousYearCreditAmount != 0
    ? ((previousYearCreditAmount - $currentYearCreditAmountNow) / $currentYearCreditAmountNow) * 100
    : null;
@endphp
<tr class="collapse-row group-{{$key}}">
    <td></td>
    <td>{{$advertiser == 3 ? 'Escorts':'Centers'}}</td>
    <td class="text-right">{{formatCurrency($currentYearCreditAmountNow, '' , false)}}</td>
    <td class="text-right">{{formatCurrency($previousYearCreditAmountNow, '' , false)}}</td>
    <td><span class="text-danger">
    <div class="num_value">- <span>{{formatCurrency($variation, '' , false)}}</span></div>
    </span></td>
    <td><span class="text-danger">
    <div class="num_value">- <span>{{ $variation_percentage !== null ? number_format($variation_percentage, 2) . '%' : 'N/A' }}</span></div>
    </span></span></td>
    <td class="text-right"><span class="text-danger">{{formatCurrency($previousYearCreditAmount, '' , false)}}</span></td>
    <td><span class="text-danger">
    <div class="num_value">↓<span> {{formatCurrency($previous_year_variation, '' , false)}}</span></div>
    </span></td>
    <td><span class="text-danger">
    <div class="num_value">↓<span> {{$previous_year_variation_percentage}}</span></div>
    </span></td>
    <td></td>
    <td><span class="text-success">
    <div class="num_value">↑<span> 235</span></div>
    </span></td>
    <td><span class="text-success">
    <div class="num_value">↑<span> 9.4</span></div>
    </span></td>
</tr>