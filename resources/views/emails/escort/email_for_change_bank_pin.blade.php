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
    <title>Change Pin - Escort</title>
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
                                        Change Pin<br>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $body['member_id'] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{ $body['name'] }},</p>
                            <!-- Main Message -->
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Your E4U PIN has been successfully updated to {{ $body['pin'] }}. Do not show anyone your new PIN.
                            </p>
                            <!-- Closing -->
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U</b>
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
                            &copy; Copyright 2025 Blackbox Tech Pty Ltd. All rights reserved..
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
