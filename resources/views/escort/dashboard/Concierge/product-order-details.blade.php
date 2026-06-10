<style>
    .section-title {
        background: #f8f9fa;
        border-left: 4px solid #1f2732;
        padding: 10px 15px;
        margin: 20px 0 10px;
        font-size: 18px;
        font-weight: 600;
    }
</style>
<div class="p-3">
    <!-- ORDER DETAILS -->
    <h4 class="section-title">Order Details</h4>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->order_id ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>{{ $order->order_status ? Str::ucfirst($order->order_status) : 'N/A' }}</td>
        </tr>

        <tr>
            <th>Console</th>
            <td>{{ $order->type ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>Order Date</th>
            <td>
                {{ !empty($order->order_date) ? date('d M Y, h:i A', strtotime($order->order_date)) : 'N/A' }}
            </td>
        </tr>

        <tr>
            <th style="width:205px">Message</th>
            <td>{{ $order->notes ?? 'N/A' }}</td>
        </tr>
    </table>


    <!-- ORDER ITEMS -->
    <h4 class="section-title">Order Items</h4>

    @if (!empty($order->orderItems) && count($order->orderItems) > 0)

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>
                            {!! $item->product->description ?? 'Product Not Found' !!}
                            <br>

                            @if (!empty($item->size) && $item->size !== 'N/A')
                                Size: {{ $item->size }}
                            @endif
                        </td>

                        <td>{{ $item->quantity ?? 0 }}</td>

                        <td>${{ number_format($item->price ?? 0, 2) }}</td>

                        <td>
                            ${{ number_format(($item->price ?? 0) * ($item->quantity ?? 0), 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No items found.</p>
    @endif


    <!-- ADDRESS DETAILS -->
    <h4 class="section-title">Address Details</h4>

    @if (!empty($order->orderAddress) && count($order->orderAddress) > 0)

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">

                <thead>
                    <tr>
                        <th>Address Type</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Landmark</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->orderAddress as $item)
                        <tr>
                            <td>{{ $item->type ? Str::ucfirst($item->type) : 'N/A' }}</td>
                            <td>{{ $item->phone ?? 'N/A' }}</td>
                            <td>{{ $item->email ?? 'N/A' }}</td>
                            <td>{{ $item->address_line1 ?? 'N/A' }}</td>
                            <td>{{ $item->address_line2 ?? 'N/A' }}</td>
                            <td>{{ $item->city ?? 'N/A' }}</td>
                            <td>{{ $item->state ?? 'N/A' }}</td>
                            <td>{{ $item->pincode ?? 'N/A' }}</td>
                            <td>{{ !empty($item->landmark) ? $item->landmark : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    @else
        <p class="text-muted">No address information found.</p>
    @endif


    <!-- PAYMENT DETAILS -->
    <h4 class="section-title">Payment Details</h4>

    @php
        $payment = $order->paymentDetails ?? null;
    @endphp

    @if ($payment)
        <table class="table table-bordered table-striped table-hover">

            <tr>
                <th>Transaction ID</th>
                <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Sub Total</th>
                <td>${{ number_format($payment->amount ?? 0, 2) }}</td>
            </tr>

            <tr>
                <th>Wallet Amount</th>
                <td>${{ number_format($payment->wallet_amount ?? 0, 2) }}</td>
            </tr>

            <tr>
                <th>Delivery Type / Charge</th>
                <td>
                    {{ !empty($order->delivery_type) ? ucfirst($order->delivery_type) : 'N/A' }}
                    /
                    ${{ number_format($payment->delivery_charge ?? 0, 2) }}
                </td>
            </tr>

            <tr>
                <th>GST Amount ({{ config('escorts.product_tax') }}% of Subtotal)</th>
                <td>${{ number_format($payment->gst_amount ?? 0, 2) }}</td>
            </tr>

            <tr>
                <th>Amount Paid</th>
                <td>${{ number_format($payment->paid_amount ?? 0, 2) }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{ $payment->status ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Payment Date</th>
                <td>
                    {{ !empty($payment->paid_at) ? date('d M Y, h:i A', strtotime($payment->paid_at)) : 'N/A' }}
                </td>
            </tr>

        </table>
    @else
        <p class="text-muted">No payment details found.</p>
    @endif

</div>
