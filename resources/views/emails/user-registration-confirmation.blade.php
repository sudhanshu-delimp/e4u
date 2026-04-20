<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New User Registration - Confirmation</title>
    <link rel="stylesheet" href="styles.css" />
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
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo"
                                            style="height: 50px;">
                                    </td>
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">New User Registration - Confirmation</h1>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $user->member_id }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{ $user->name ?? $user->email }},</p>
                            <!-- Main Message -->

                            <h4 style="font-size: 17px; line-height: 1.6; margin-bottom: 15px;">
                                E4U Registration - Confirmation
                            </h4>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Thank you for joining the E4U community. Your Account has been automatically generated
                                and you can log on straight away.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">When logging on for the first time, you will be greeted with a ‘Welcome Message’ which
                                sets out some information about the Website to make your experience a pleasant and
                                enjoyable one.</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">Please note that your Registration whilst granted, our Operations team will review your
                                registration.</p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">If you need any help, please raise a Support Ticket from your dashboard.</p>
                            <!-- Closing -->
                            
                            <!-- email info -->
                                <x-email-info/>
                            <!-- end -->
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                         <td>
                            <x-email-footer/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>