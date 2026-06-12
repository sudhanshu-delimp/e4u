@php
    $subTotal = 0;
@endphp

@if ($products->isEmpty() || empty($cart))
    <tr>
        <td colspan="6" class="text-center">Details Not Found</td>
    </tr>
@else
    @foreach ($products as $product)
        @php
            $qty = $cart[$product->id]['qty'] ?? 0;
            $price = (float) $product->price;
            $total = $qty * $price;
            $description = $product->description;

            $subTotal += $total;
        @endphp

        <tr>

            <td class="theme-color">
                {{ $product->code }}
            </td>

            <td class="theme-color">
                {!! $description !!}<br>

                <strong>QTY:</strong> {{ $product->qty }}

                @if ($product->size && $product->size !== 'N/A')
                    | <strong>Size:</strong> {{ $product->size }}
                @endif
            </td>

            <td class="theme-color text-ce nter">
                ${{ number_format($price, 2) }}
            </td>

            <td class="theme-color qty te xt-center">
                {{ $qty }}
            </td>

            <td class="theme-color text -center">
                <div class="view_cart_total_td">
                    <span class="total-cell" data-id="{{ $product->id }}">
                        ${{ number_format($total, 2) }}
                    </span>
                </div>
            </td>
        </tr>
    @endforeach

    @php
        $grandTotal = $subTotal + $shipping;
    @endphp
   <tr>
    <td colspan="5" class="p-0 border-0">
        <div class="d-flex justify-content-end">
            <table class="table table-bordered mb-0" style="width:350px;">
                <tbody>
                    <tr>
                        <th class="text-end">Subtotal</th>
                        <td id="subtotal" class="text-end">
                            ${{ number_format($subTotal, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <th class="text-end">Shipping</th>
                        <td id="shipping" class="text-end">
                            ${{ number_format($shipping, 2) }}
                        </td>
                    </tr>

                    <tr class="table-li ght">
                        <th class="text-end">Grand Total</th>
                        <td id="grand-total" class="text-end">
                            <strong>${{ number_format($grandTotal, 2) }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </td>
</tr>
@endif
