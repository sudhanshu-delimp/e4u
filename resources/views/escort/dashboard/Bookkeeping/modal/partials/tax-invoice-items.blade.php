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
                @switch($payment->service)
                 @case('Profile Extend')
                        Extended Listing applied to
                        <span style="color: #53657d;">({{$profile->profile_name}})</span>
                @break
                @case('Profile Upgrade')
                        Upgrade applied to
                        <span style="color: #53657d;">({{$profile->profile_name}})</span>
                @break
                @default
                    <strong>{{$purchase->MembershipType}} profile</strong> listed in {{$profile->StateAbbr}}<br />
                    <span style="color: #53657d;">({{$profile->profile_name}})</span>
                @endswitch
            </td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{$purchase->days_number}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency($purchase->rate)}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{!!formatCurrency($paymentItem->amount - $purchase->total_rate)!!}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency(($purchase->rate*10) / 100)}}</td>
            <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;"> {{ formatCurrency($paymentItem->amount)}}</td>
            </tr>
        @endforeach
    @elseif($payment->service === 'Product Purchase')
        @foreach($payment->items as $key => $paymentItem)
            @php 
            $item = $paymentItem->item;
            @endphp
            <tr style="background-color: #ffffff;">
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y')  : '---' }}</td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ $payment?->service ?? '---' }}</td>
            <td align="left" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; line-height: 1.4;text-align:left;">
                {!! $item->product->description !!}
            </td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{$item->quantity}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency($item->price)}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency(0)}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency(($item->price*10) / 100)}}</td>
            <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;"> {{ formatCurrency($item->total)}}</td>
            </tr>
        @endforeach
    @elseif($payment->service === 'Support Service')    
        @php 
            $paymentItem = $payment->items[0];
            $item = $paymentItem->item;
        @endphp
        @foreach($item->services ?? [] as $key => $service)
            @php
            [$serviceName, $price] = explode('|', $service);
            @endphp
            <tr style="background-color: #ffffff;">
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y')  : '---' }}</td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{ $payment?->service ?? '---' }}</td>
            <td align="left" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; line-height: 1.4;text-align:left;">
                {!! $serviceName !!}
            </td>
            <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{1}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency($price)}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency(0)}}</td>
            <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{formatCurrency(($price*10) / 100)}}</td>
            <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;"> {{ formatCurrency($price)}}</td>
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
                
                @switch($payment->service)

                    @case('Profile Bump Up')
                        Bump Up applied to
                        <span style="color: #53657d;">({{$profile->profile_name}})</span>
                    @break

                    @case('Profile Pin Up')
                        Pin Up <span style="color: #53657d;">(Attached to: {{$profile->profile_name}})</span> in {{$profile->StateAbbr}}. Period: {{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}
                    @break

                    @case('view')
                    <button>View</button>
                    @break

                    @default
                    <span>Invalid action</span>

                @endswitch
                </td>
                <td align="center" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; text-align:center;">{{1}}</td>
                <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
                <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ 0 }}</td>
                <td align="right" valign="top" style="padding: 10px 4px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->gst_amount ?? 0) }}</td>
                <td align="right" valign="top" style="padding: 10px 6px; border: 1px solid #cbd5e1; font-size: 11px; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
            </tr>
    @endif

<!-- Subtotal Row -->
<tr>
    <!-- Notes Box & Card details embedded in the left cells -->
    <td colspan="5" rowspan="4" valign="top" style="border: 1px solid #cbd5e1; padding: 12px; background-color: #ffffff;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top" style="border:0;padding:0px;">
                    <div style="width:55%;border: 1px dashed #22c55e; border-radius: 4px; padding: 6px 10px; font-size: 10.5px; color: #15803d; line-height: 1.4; background-color: #ffffff;">
                        <strong style="display: block; font-size: 11px; margin-bottom: 2px;">Notes:</strong>
                        1. Quantity can be either days or units.<br />
                        2. Card debited with your authority.
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" style="border:0; padding-bottom:0px; padding-right:0px; padding-left:0px; padding-top: 8px; font-size: 11.5px; font-weight: 700; color: #dc2626;">
                    Card<sup>(2)</sup>: {{ $payment?->card ?? '---' }}
                </td>
            </tr>
        </table>
    </td>
    <td colspan="2" align="center" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; font-weight: 700; color: #0c223d; background-color: #ffffff;text-align:center;">Subtotal:</td>
    <td align="right" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; color: #132238; background-color: #ffffff; white-space: nowrap;text-align:right;">{{ formatCurrency($payment?->amount ?? 0) }}</td>
</tr>

<!-- GST Row -->
<tr>
    <td colspan="2" align="center" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; font-weight: 700; color: #0c223d; background-color: #ffffff;text-align:center;">GST:</td>
    <td align="right" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; color: #132238; background-color: #ffffff; white-space: nowrap;text-align:right;">{{ formatCurrency($payment?->gst_amount ?? 0) }}</td>
</tr>

@if($payment->service === 'Product Purchase')
    <tr>
        <td colspan="2" align="center" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; font-weight: 700; color: #0c223d; background-color: #ffffff;text-align:center;">Delivery Charge:</td>
        <td align="right" style="padding: 8px 6px; border: 1px solid #cbd5e1; font-size: 11px; color: #132238; background-color: #ffffff; white-space: nowrap;text-align:right;">{{ formatCurrency($payment?->delivery_charge ?? 0) }}</td>
    </tr>
@endif

<!-- Balance Due Row -->
<tr style="background-color: #fafbfc;">
    <td colspan="2" align="left" style="padding: 9px 8px; border: 2px solid #0c223d; font-size: 13px; font-weight: 800; color: #0c223d;text-align:left;">Balance Due:</td>
    <td align="right" style="padding: 9px 6px; border: 2px solid #0c223d; font-size: 13px; font-weight: 800; color: #0c223d; white-space: nowrap; text-align:right;">{{ formatCurrency($payment?->paid_amount ?? 0) }}</td>
</tr>
@endif