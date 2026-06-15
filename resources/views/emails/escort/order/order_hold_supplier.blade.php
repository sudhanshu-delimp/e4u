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
                                            E4U Concierge - Product Order Hold
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

                            <p style="margin: 0 0 15px 0;">Dear Supplier,</p>

                            <p style="margin: 20px 0 15px 0;">We would like to inform you that the order has been placed
                                on hold and is currently under review.</p>
                            {{-- <p style="margin: 15px 0;">
                                <strong>Delivery Address:</strong> {{ $data['delivery_address'] ?? '' }}
                            </p> --}}

                            <p style="margin: 15px 0;">
                                Please do not proceed with any further processing, fulfillment, or delivery activities
                                relating to this order until further notice.</p>
                            <p style="margin: 15px 0;">
                                We will provide an update once the order status changes or additional instructions
                                become available. </p>
                            <p style="margin: 15px 0;">
                                Please retain this notification for your records and quote the order reference in any
                                future correspondence regarding this order. </p>

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
