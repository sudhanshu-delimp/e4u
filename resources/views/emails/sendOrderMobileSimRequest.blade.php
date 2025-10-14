{{-- @component('mail::message')
    <h2>Dear {{ $body['escort_name'] }},</h2>
    <h2>Escort ID: {{ $body['member_id'] }},</h2>
    <p>Your request for a Mobile SIM has been processed. Please allow 48 hours
        for the SIM to arrive. We have expressed posted your Mobile SIM to your
        nominated address.<br><br>
        If you do not receive your SIM within 48 hours, please lodge a Support Ticket
        and quote the reference number stated in your A-Alert.
    </p>
@endcomponent --}}


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Mobile SIM</title>
</head>

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
                                        Order Confirmation - Mobile SIM<br>
                                        <span style="font-size: 13px; color: #cccccc;">(Ref:
                                            {{ $body['order_ref'] }})</span><br>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            E6{{ str_pad($body['member_id'], 4, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{ $body['escort_name'] }},</p>

                            <!-- Main Message -->
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Your request for a Mobile SIM has been received. Please allow <strong>72 hours</strong>
                                for the SIM to arrive. We will express post your Mobile SIM to your nominated address.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                If you do not receive your SIM within 72 hours, please lodge a Support
                                Ticket by logging onto your Dashboard, and quote your reference number
                                <strong>{{ $body['order_ref'] }}</strong>.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We confirm payment will be made according to your instructions.
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; margin-bottom: 15px;">
                                <strong>Note:</strong> your SIM will:
                            </p>
                            <ol style="counter-reset: alphaList; margin: 8px 0 15px 25px; padding: 0; margin-left: 40px;">
        <li style="font-size: 14px; line-height: 1.6; margin-bottom: 8px; list-style: none; position: relative;">
            <span style="position: absolute; left: -22px;">(a)</span>
            be dispatched on the next business day; and
        </li>
        <li style="font-size: 14px; line-height: 1.6; margin-bottom: 8px; list-style: none; position: relative;">
            <span style="position: absolute; left: -22px;">(b)</span>
            have been activated. Simply install the SIM into your phone and you can use it immediately.
        </li>
    </ol>

                            <!-- Closing -->
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations Centre</b>
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; padding: 15px 30px; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                        <td>
                            This is an automatically generated email by the Escorts4U Operations Centre.<br>
                            &copy; Copyright 2025 Blackbox Tech Pty Ltd. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
