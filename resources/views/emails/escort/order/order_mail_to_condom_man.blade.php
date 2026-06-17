<!DOCTYPE html>
<html>

<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">
                    <!-- Header with background and logo -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: left;">
                                        <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo"
                                            style="height: 50px;">
                                    </td>
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        <h1
                                            style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">
                                            E4U Concierge - Product Order
                                        </h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Ref: {{ $data['id'] ?? '' }}<br>
                                            Member ID: {{ $data['member_id'] ?? '' }}
                                            <br>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Section -->
                    <tr>
                        <td style="padding: 30px; font-size: 16px;">
                            <p style="margin: 0 0 15px 0;"><b>Dear Supplier,</b></p>
                            <p style="margin: 20px 0 15px 0;">
                                We have received a request to supply products from an E4U Member. Please prepare the
                                order accordingly. The following information was provided by the Member:
                            </p>

                            <table width="600" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>Member name: </td>
                                    <td>{{ $data['member_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile:</td>
                                    <td>{{ $data['mobile'] }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery address:</td>
                                    <td>{{ $data['delivery_address'] }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery type: </td>
                                    <td>{{ ucfirst($data['delivery_type']) }}</td>
                                </tr>

                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="border:1px solid #e1e1e1;margin-top:10px;border-collapse:collapse;">
                                <tr>
                                    <th style="padding:8px;border:1px solid #e1e1e1;text-align:left;font-size:14px;">
                                        Product</th>
                                    <th style="padding:8px;border:1px solid #e1e1e1;text-align:left;font-size:14px;">
                                        Quantity</th>
                                    <th style="padding:8px;border:1px solid #e1e1e1;text-align:left;font-size:14px;">
                                        Price</th>
                                    <th style="padding:8px;border:1px solid #e1e1e1;text-align:left;font-size:14px;">
                                        Total</th>
                                </tr>

                                @foreach ($data['products'] as $item)
                                    <tr>
                                        <td
                                            style="padding:8px;border:1px solid #e1e1e1;vertical-align:top;font-size:13px;">
                                            {!! $item->product->description !!} <br>
                                            <span style="color:#555;font-size:12px;">
                                                QTY: {{ $item->product->qty }}
                                                @if (!empty($item->product->size) && $item->product->size != 'N/A')
                                                    <br>Size: {{ $item->product->size }}
                                                @endif
                                            </span>
                                        </td>

                                        <td style="padding:8px;border:1px solid #e1e1e1;font-size:13px;">
                                            {{ $item->quantity }}
                                        </td>

                                        <td style="padding:8px;border:1px solid #e1e1e1;font-size:13px;">
                                            ${{ number_format($item->price, 2) }}
                                        </td>

                                        <td style="padding:8px;border:1px solid #e1e1e1;font-size:13px;">
                                            ${{ number_format($item->price * $item->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            Payment has been made be the Member.
                            <!-- email info -->
                            <x-email-info />
                            <!-- end -->

                        </td>
                    </tr>
                </table>

                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
                    <tr>
                        <td>
                            <x-email-footer />
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>
