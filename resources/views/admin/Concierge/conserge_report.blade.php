<head>
  <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/css/dk-style.css?v1.2') }}" rel="stylesheet">
</head>
<!-- Bootstrap CSS -->

<!-- Bootstrap JS -->
<table class="table table-bordered reconciliation_table">
    <thead class="table-bg">
        <tr>
            <th>Product ID</th>
            <th>Advertiser</th>
            <th class="text-center">Territory</th>
            <th class="text-center">Delivery</th>
            <th>Retail</th>
            <th>Company</th>
            <th>Supplier</th>
        </tr>
    </thead>

    <tbody>
        @php
            $totalPrice = 0;
            $totalRetailPrice = 0;
        @endphp

        @forelse ($items->groupBy(fn($item) => $item->product->code) as $productCode => $productItems)

            @php
                $price = $productItems->sum(fn($item) => $item->price * $item->quantity);
                $retailPrice = $productItems->sum(fn($item) => $item->retail_price * $item->quantity);
                $profit = $price - $retailPrice;

                $totalPrice += $price;
                $totalRetailPrice += $retailPrice;
            @endphp

            {{-- Product Items --}}
            @foreach ($productItems as $item)
                @php
                    $itemPrice = $item->price * $item->quantity;
                    $itemRetailPrice = $item->retail_price * $item->quantity;
                    $itemProfit = $itemPrice - $itemRetailPrice;
                @endphp

                <tr>
                    <td>{{ $item->product->code }}</td>

                    <td>
                        {{ $item->productOrder->user->member_id }}
                    </td>

                    <td class="text-center">
                        {{ $item->productOrder->user->state->name }}
                    </td>

                    <td class="text-center">
                        {{ $item->productOrder->delivery_type }}
                    </td>

                    {{-- Retail --}}
                    <td>
                        <div class="num_value">
                            $<span>{{ number_format($itemPrice, 2) }}</span>
                        </div>
                    </td>

                    {{-- Company --}}
                    <td>
                        <div class="num_value">
                            $<span>{{ number_format($itemRetailPrice, 2) }}</span>
                        </div>
                    </td>

                    {{-- Supplier --}}
                    <td>
                        <div class="num_value">
                            $<span>{{ number_format($itemProfit, 2) }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach

            {{-- Product Subtotal --}}
            <tr>
                <td colspan="4" class="text-right">
                    <strong>Subtotal:</strong>
                </td>

                <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                    <div class="num_value">
                        $<span>{{ number_format($price, 2) }}</span>
                    </div>
                </td>

                <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                    <div class="num_value">
                        $<span>{{ number_format($retailPrice, 2) }}</span>
                    </div>
                </td>

                <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                    <div class="num_value">
                        $<span>{{ number_format($profit, 2) }}</span>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="7" class="text-center">
                    Not found
                </td>
            </tr>
        @endforelse
    </tbody>

    <tfoot>
        @php
            $totalProfit = $totalPrice - $totalRetailPrice;
        @endphp

        {{-- Total --}}
        <tr>
            <td colspan="7" class="mt-5"></td>
        </tr>

        <tr>
            <td colspan="4" class="text-right">
                <strong>Total:</strong>
            </td>

            <td style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                <div class="num_value">
                    $<span>{{ number_format($totalPrice, 2) }}</span>
                </div>
            </td>

            <td style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                <div class="num_value">
                    $<span>{{ number_format($totalRetailPrice, 2) }}</span>
                </div>
            </td>

            <td style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                <div class="num_value">
                    $<span>{{ number_format($totalProfit, 2) }}</span>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

<input type="hidden" id="report_id" value="{{ $report_id }}">
<br>
<div class="supplier-payment-summary" >
    <h2>Supplier Payment Summary</h2>

    <table class="summary-table" style="width: 100%">
        <tbody>
            <tr>
                <td class="label"><strong>Supplier:</strong></td>
                <td>{{$supplier->name}}</td>
            </tr>

            <tr>  
                <td class="label"><strong>Payment:</strong></td>
                <td>${{number_format($totalRetailPrice, 2)}}</td>
            </tr>

            <tr>
                <td class="label"><strong> Account:</strong></td>
                <td> {{$supplier->supplierBankDetails->account_name}}</td>
            </tr>

            <tr>
                <td class="label"><strong>BSB:</strong></td>
                <td>{{$supplier->supplierBankDetails->bsb}}</td>
            </tr>

            <tr>
                <td class="label"><strong>Account:</strong></td>
                <td>{{$supplier->supplierBankDetails->account_number}}</td>
            </tr>
        </tbody>
    </table>
</div>
