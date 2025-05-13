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
                        <td style="background-color:#2b3d50; padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: left;">
                                        <img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/logo.svg" alt="E4U Logo"
                                            style="height: 50px;">
                                    </td>
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        Order Confirmation - Mobile SIM<br>
                                        <span style="font-size: 13px; color: #cccccc;">(Order Ref: {{$body['order_ref']}})</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Dear {{ $body['escort_name'] }},</b></p>
                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Escort ID: {{ $body['member_id'] }},</b></p>
                            <!-- Main Message -->
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Your request for a Mobile SIM has been processed. Please allow <strong>48 hours</strong>
                                for the SIM to arrive. We have express posted your Mobile SIM to your nominated address.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                If you do not receive your SIM within <strong>72 hours</strong>, please lodge a Support
                                Ticket by logging onto your Dashboard, and quote the reference number stated in this
                                email.
                            </p>
                            <!-- Closing -->
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations</b>
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#2b3d50; padding: 15px 30px; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                        <td>
                            &copy; 2025 E4U. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
