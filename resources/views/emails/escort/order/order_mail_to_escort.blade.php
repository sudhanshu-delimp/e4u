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
                                            Order Confirmation - Products
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

                            <p style="margin: 0 0 15px 0;"><b>Dear {{ $data['billing_name'] }},</b></p>

                            <p style="margin: 20px 0 15px 0;">
                                Your order for a range of Products has been received. Please note, if your order has
                                been
                                placed before 11:00 am and you have requested a delivery, delivery will
                                occur on the same day. If your order is by post, please allow 48 hours
                                for the Products to arrive. We will express post your Products to your nominated
                                delivery
                                address.
                            </p>

                            <p style="margin: 15px 0;">
                                If you do not receive your Products within 72 hours, please lodge a
                                Support Ticket by logging onto your Dashboard and quoting your reference number
                                {{ $data['order_id'] }}.
                            </p>

                            <p style="margin: 15px 0;">
                                We confirm payment has been made according to your instructions.
                            </p>

                            <p style="margin: 20px 0 10px 0;"><strong>Notes:</strong></p>

                            <ol style="padding-left: 20px; margin: 0; line-height: 22px;">
                                <li>
                                    Your products will, if by post:
                                    <ul style="padding-left: 20px; margin-top: 10px; list-style: none">
                                        <li>(a) be dispatched on the next business day; and</li>
                                        <li>(b) can be tracked.</li>
                                    </ul>
                                </li>
                                <li style="margin-top: 10px;">
                                    You can view your order online by going to your Dashboard and selecting Orders within the Bookkeeping group.
                                </li>
                            </ol>


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
