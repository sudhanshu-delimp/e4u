<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Expiry Reminder</title>
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
                                        <h1 style="margin: 0;font-size: 22px;">Password Expiry Reminder</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 18px; margin: 0 0 15px 0;">Dear {{ $user->name }},</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                This is a friendly reminder that your password will expire in 
                                <b>{{ $days === 1 ? '24 hours' : $days . ' days' }}</b>,
                                on <b>{{ $expiryDate->format('d M Y') }}</b>.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Please update your password before it expires.  
                                <b>Note:</b> You cannot reuse any of your last 5 passwords.
                            </p>

                            

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
                        <td style="line-height: 21px;">
                            This is an automatically generated reminder from the Escorts4u Operations Centre.<br>
                            &copy; Copyright 2025 Blackbox Tech Pty Ltd. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
