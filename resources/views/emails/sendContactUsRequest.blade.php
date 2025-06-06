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
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle;">
                                        <h1 style="margin: 0;font-size: 26px;">Contact Us</h1>
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear Admin,</p><br/>

                             <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                {{ $body['first_name'] }} sent a contact us request:
                            </p>

                            <!-- Info Table -->
                            <table cellpadding="8" cellspacing="0" border="0"
                                style="width: 100%; font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td style=" width: 180px;">First Name:</td>
                                    <td>{{ $body['first_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="">Last Name:</td>
                                    <td>{{ $body['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="">Email:</td>
                                    <td>{{ $body['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="">Message:</td>
                                    <td>{{ $body['message'] }}</td>
                                </tr>
                               
                            </table>
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
                        <td>
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
