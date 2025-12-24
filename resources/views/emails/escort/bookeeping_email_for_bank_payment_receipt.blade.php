<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bank Payment Receipt - Escort</title>
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
                                        {{ $body['subject'] ?? 'N/A'}}<br>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $body['member_id'] ?? 'N/A'}}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Dear {{ $body['name'] ?? 'N/A' }},</b></p>

                            <!-- Main Message -->
                            <p style="font-size: 15px; line-height: 2.0; margin-bottom: 15px;">
                              EFT your payment to this bank account:
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; margin-bottom: 15px;">
                                <strong>Summary:</strong>
                            </p>
                             <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: left; padding:5px 0px;">
                                        BSB:
                                    </td>
                                    <td style="font-size: 16px; padding:5px 0px;">
                                        {{ $body['bsb'] ?? 'N/A' }} 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; padding:5px 0px;">
                                        A/C Number:
                                    </td>
                                    <td style="  font-size: 16px; padding:5px 0px;">
                                        {{$body['account_number'] ?? 'N/A'}} 
                                    </td>
                                </tr>
                               
                            </table>

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
