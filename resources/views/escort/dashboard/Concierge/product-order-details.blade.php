<style>
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: white !important
    }
</style>
<ul class="nav nav-tabs" id="orderTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="order-tab" data-toggle="tab" href="#orderTab" role="tab">
            Order Details
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="items-tab" data-toggle="tab" href="#itemsTab" role="tab">
            Order Items
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="address-tab" data-toggle="tab" href="#addressTab" role="tab">
            Address Details
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="payment-tab" data-toggle="tab" href="#paymentTab" role="tab">
            Payment Details
        </a>
    </li>
</ul>

<div class="tab-content p-3" id="orderTabsContent">

    <!-- ORDER -->
    <div class="tab-pane fade show active" id="orderTab" role="tabpanel">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Order ID</th>
                <td>{{ $order->order_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $order->order_status ?? 'N/A' }}</td>
            </tr>
            {{-- <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Sub Total</th>
                <td>${{ $order->paymentDetails->amount ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gst Amount </th>
                <td>${{ $order->paymentDetails->gst_amount ?? 'N/A' }}</td>
            </tr> --}}
            <tr>
                <th>Console</th>
                <td>{{ $order->type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Transaction Id</th>
                <td>{{ $order->transaction_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method ?? 'N/A' }}</td>
            </tr>




            <tr>
                <th>Order Date</th>
                <td>{{ date('d M Y, h:i A', strtotime($order->order_date)) ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th style="width:205px">Message</th>
                <td>{{ $order->notes ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- ITEMS -->
    <div class="tab-pane fade" id="itemsTab" role="tabpanel">
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
                                {!! $item->product->description ?? 'Product Not Found' !!} <br>
                                {{ !empty($item->size) && $item->size !== 'N/A' ? 'Size: ' . $item->size : '' }}
                            </td>
                            <td>{{ $item->quantity ?? 0 }}</td>
                            <td>${{ $item->price ?? 0 }}</td>
                            <td>${{ ($item->price ?? 0) * ($item->quantity ?? 0) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p class="text-muted">No items found.</p>
        @endif
    </div>

    <!-- ADDRESS -->
    <div class="tab-pane fade table-responsive" id="addressTab" role="tabpanel">
        @if (!empty($order->orderAddress) && count($order->orderAddress) > 0)
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Address Type</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Landmark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderAddress as $item)
                        <tr>
                            <td>{{ $item->type ?? 'N/A' }}</td>
                            <td>{{ $item->phone ?? 'N/A' }}</td>
                            <td>{{ $item->email ?? 'N/A' }}</td>
                            <td>{{ $item->address_line1 ?? 'N/A' }}</td>
                            <td>{{ $item->address_line2 ?? 'N/A' }}</td>
                            <td>{{ $item->city ?? 'N/A' }}</td>
                            <td>{{ $item->state ?? 'N/A' }}</td>
                            <td>{{ $item->pincode ?? 'N/A' }}</td>
                            <td>{{ $item->landmark || empty($item->landmark) ? $item->landmark : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No address information found.</p>
        @endif
    </div>

    <!-- PAYMENT -->
    <div class="tab-pane fade" id="paymentTab" role="tabpanel">
        @php $payment = $order->paymentDetails ?? null; @endphp

        @if ($payment)
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Transaction ID</th>
                    <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Sub Total</th>
                    <td>${{ $payment->amount ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Wallet Amount </th>
                    <td>${{ $payment->wallet_amount ?? 'N/A' }}</td>
                </tr>
                
                <tr>
                    <th>Delivery Type / Charge</th>
                    <td>{{ ucfirst($order->delivery_type) ?? 'N/A' }}{{ '/$' . $payment->delivery_charge ?? 'N/A' }}
                    </td>
                </tr>

                <tr>
                    <th>Gst Amount ( {{ config('escorts.product_tax') }}% of Subtotal )</th>
                    <td>${{ $payment->gst_amount ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>${{ $payment->paid_amount ?? '0.00' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $payment->status ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Payment Date</th>
                    <td>{{ $payment->paid_at ? date('d M Y, h:i A', strtotime($payment->paid_at)) : 'N/A' }}</td>

                </tr>
            </table>
        @else
            <p class="text-muted">No payment details found.</p>
        @endif
    </div>
</div>
