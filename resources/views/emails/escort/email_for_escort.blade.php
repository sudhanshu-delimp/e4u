<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirmation of Registration</title>

</head>

<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50; text-align: justify;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px; text-align: left;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                                    </td>
                                    <td style="color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle; text-align: right;">
                                        <h1 style="margin: 0; font-size: 22px; color:#ffffff; text-align: right;">Confirmation of Registration - Escort</h1>
                                        <div style="font-weight: 500;">Member ID: {{$user->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Body content -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$user->name ?? ''}},</p>
                            <h3 style="margin-top: 25px;">E4U Registration - Confirmation</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We are pleased to confirm your Registration has been accepted and you can now log into
                                the Escort Console and proceed to create Profiles and Tours.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Thank you for joining the E4U community.
                            </p>
                            <h3 style="margin-top: 25px;">Logging in</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 10px;">
                                The following information will assist you when logging in:
                            </p>
                            <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                <li>Web address: <a href="http://www.e4u.com.au" target="_blank">www.e4u.com.au</a></li>
                                <li>Username: {{removeSpaceFromString($user->phone)}} <em>(Your mobile number)</em></li>
                                <li>Password: {{$user->password}} <em>(please note passwords are case sensitive)</em></li>
                            </ul>
                            <p style="font-size: 13px; font-style: italic;">Your logging in process is also subject to SMS 2FA verification. It is a good idea to bookmark the
                                Website.
                            </p>
                            <h3 style="margin-top: 25px;">Welcome Message</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">When logging on for the first time, you will be greeted with a ‘Welcome Message’ which sets
                                out some information about the Website to make your experience a pleasant and enjoyable
                                one.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">Please note that your Registration whilst granted, our Operations team will review your
                                registration.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">If you need any help, please raise a Support Ticket from your dashboard.</p>
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
                        <td style="line-height: 21px;text-align:center;">
                            This is an automatically generated email by the Escorts4U Operations Centre.<br>
                            &copy; Copyright {{date('Y')}} Blackbox Tech Pty Ltd. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>