<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirmation : Support Ticket</title>
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
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle;">
                                        <h1 style="margin: 0;font-size: 22px; color: #ffffff;text-align: right;">Confirmation Support Ticket</h1>
                                        <div style="font-weight: 500;">Ticket ID : {{ $body['ref_number'] }}</div>
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                          

                             <p style="font-size: 18px; margin: 0 0 15px 0;">Dear  {{  ($body['name']!="")  ? $body['name'] : $body['member_id'] }},</p>

                             <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Thank you for your enquiry. Please allow 48 hours for one of our team members to respond to your enquiry.
                            </p>

                
                            <!-- Closing -->
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations centre</b>
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; padding: 15px 30px; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                        <td style="line-height: 21px;">
                            This is an automatically generated email by the Escorts4u Operations Centre.<br>
                            &copy; Copyright 2025 Blackbox Tech Pty Ltd. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
