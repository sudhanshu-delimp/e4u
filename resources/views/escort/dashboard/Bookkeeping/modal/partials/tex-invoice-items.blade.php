@if(!empty($payment))
    @if(in_array($payment->service,['Profile Listing','Profile Extend','Profile Upgrade','Tour']))
        @foreach($payment->items as $key => $paymentItem)
            @php 
            $purchase = $paymentItem->item;
            $profile = $purchase->advertiser;
            @endphp
            <tr style="background-color: #ffffff;">
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y')  : '---' }}</td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ $payment?->service ?? '---' }}</td>
            <td align="left" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; line-height: 1.4;text-align:left;">
            <strong>{{$purchase->MembershipType}} profile</strong> listed in {{$profile->StateAbbr}}<br />
            <span style="color: #53657d;">({{$profile->profile_name}})</span>
            </td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{$purchase->days_number}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{$purchase->rate}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{($purchase->rate*10) / 100}}</td>
            <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;"> {{ formatCurrency($paymentItem->amount)}}</td>
            </tr>
        @endforeach
    @else 
        @php 
            $paymentItem = $payment->items[0];
            $item = $paymentItem->item;
            $purchase = $item->purchase;
            $profile = $purchase->advertiser;
        @endphp
            <tr style="background-color: #ffffff;">
                <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y')  : '---' }}</td>
                <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ $payment?->service ?? '---' }}</td>
                <td align="left" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; line-height: 1.4;text-align:left;">
                <strong>{{$purchase->MembershipType}} profile</strong> listed in {{$profile->StateAbbr}}<br />
                <span style="color: #53657d;">({{$profile->profile_name}})</span>
                </td>
                <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{'---'}}</td>
                <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
                <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->gst_amount ?? 0) }}</td>
                <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
            </tr>
    @endif
@endif