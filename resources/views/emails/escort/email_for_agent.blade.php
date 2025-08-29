<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation of Appointment</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: left;">
                                        <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                                    </td>
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle;">
                                        <h1 style="margin: 0;font-size: 22px; color:#ffffff;text-align: right;">Confirmation of Appointment - Escort</h1>
                                        <div style="font-weight: 500;">Member ID: {{$user->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body content -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$agentUser->name ?? ''}},</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We are pleased to confirm your appointment as Agent for the recent Registration of {{$user->member_id ?? ''}} on the {{$user->create_at}}. Your appointment has now been entered into the E4U database. You can now log into the Agent Console and proceed to manage your Escort’s Profiles and Tours.
                            </p>

                            <h3 style="margin-top: 25px;">Logging in</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 10px;">The following information will assist you when logging in:</p>
                            <ul style="padding-left: 20px; font-size: 15px; text-align: justify;">
                                <li>Web address: <a href="http://www.e4u.com.au" target="_blank">www.e4u.com.au</a></li>
                                <li>Username: {{$agentUser->phone ?? ''}} <em>(your mobile number)</em></li>
                                <li>Password: xxxxxxxxx <em>(please note passwords are case sensitive)</em></li>
                            </ul>
                            <p style="font-size: 13px; font-style: italic;">Note: Your logging in process is also subject to SMS 2FA verification. It is a good idea to bookmark the Website.</p>

                            <h3 style="margin-top: 30px;">Your Escort’s My Account</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Now that you have been appointed Agent, before you can create any Profiles or Tours for the Escort, you should spend a little time setting up their Account information. This will make the experience when creating a Profile or Tour much easier and quicker for you.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Simply log in and go to ‘My Advertisers’ and select Advertiser List and complete the following important settings from within the Escort’s My Account:
                            </p>
                            <ul style="font-size: 15px; padding-left: 20px; text-align: justify;">
                                <li>Edit my Account - ‘About me’ and ‘Profile and Tour Options’ (some settings are enabled by default)</li>
                                <li>Profile Information - ‘My Additional Information’, ‘My Available Times’, ‘My Playmates’, ‘My Rates’, ‘My Service (tags)’ and ‘My Social Media’</li>
                                <li>Notifications & Features (some settings are enabled by default)</li>
                            </ul>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Once you have completed these important settings, then next go to the Escort’s Media, and upload their photos and video and select which will be their default Media. You can verify their photos here.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                All of these Account settings have help information to assist you. You only have to do this once, but you can change any of the information by either going back to these settings, or by updating them when you create a Profile for the Escort. This is particularly helpful when creating multiple Profiles for your Escort’s Location or for a Tour.
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
