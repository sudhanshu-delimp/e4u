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
                                            Concierge Service - Product Order
                                        </h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Our Ref: {{ $data['communication_id'] ?? '' }}<br>

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
                            <p style="margin: 0 0 15px 0;"><b>Attention Operations,</b></p>

                            <p style="margin: 20px 0 15px 0;">
                                A request for Products has been requested by:
                            </p>

                            <table>
                                <tr>
                                    <th style="text-align: left">Member Name:</th>
                                    <td>{{ $data['member_name'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Order Ref:</th>
                                    <td> #{{ $data['order_id'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Member ID:</th>
                                    <td>{{ $data['member_id'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Email:</th>
                                    <td>{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Mobile:</th>
                                    <td>{{ $data['mobile'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; white-space:nowrap; vertical-align: baseline;">Delivery
                                        address:</th>
                                    <td>{{ $data['delivery_address'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Delivery type:</th>
                                    <td>{{ ucfirst($data['delivery_type']) }}</td>
                                </tr>

                            </table>
                            <!-- email info -->
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations Centre</b>
                            </p>
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
