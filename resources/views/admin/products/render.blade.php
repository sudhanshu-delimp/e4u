@if ($products->isEmpty() || empty($cart))
    <tr>
        <td colspan="6" class="text-center">Cart is empty</td>
    </tr>
@else
    @foreach ($products as $product)
        @php
            $qty = $cart[$product->id]['qty'] ?? 0;
            $price = floatval($product->price);
            $total = $qty > 0 ? $price * $qty : 0;
            $description = $product->description;
        @endphp

        <tr>
            <td class="theme-color">
                <div class="form-check d-flex align-items-center text-center">
                    <input type="checkbox" class="form-check-input mr-2 product-check" data-id="{{ $product->id }}"
                        data-price="{{ $price }}" {{ in_array($product->id, $finalCart) ? 'checked' : '' }}
                        style="width:17px; height:17px">

                    <img src="{{ $product->image }}" class="product-image" data-image="{{ $product->image }}"
                        data-title="{!! $description !!}" style="width:50px">
                </div>
            </td>

            <td class="theme-color">{{ $product->code }}</td>

            <td class="theme-color">
                {!! $description !!}<br>
                <strong>QTY:</strong> {{ $product->qty }}
                @if ($product->size && $product->size !== 'N/A')
                    | <strong>Size:</strong> {{ $product->size }}
                @endif
            </td>

            <td class="theme-color text-center">
                ${{ number_format($price, 2) }}
            </td>

            <td class="theme-color qty text-center">
                <select class="qty-select" data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                    @foreach ([1, 2, 3, 4, 5] as $q)
                        <option value="{{ $q }}" {{ $q == $qty ? 'selected' : '' }}>
                            {{ $q }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td class="theme-color text-center">
                <div class="view_cart_total_td">
                    <span class="total-cell" data-id="{{ $product->id }}"> ${{ number_format($total, 2) }}</span>
                    <span id="remove_product" onclick="removeItemFromCart({{ $product->id }})"><i
                            class="fa fa-times"></i></span>
                </div>
            </td>
        </tr>
    @endforeach
@endif
