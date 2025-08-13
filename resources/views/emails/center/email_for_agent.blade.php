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
                                        <h1 style="margin: 0;font-size: 22px; color:#ffffff;text-align: right;">Confirmation of Appointment - Massage Centre</h1>
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
                                We are please to confirm your appointment as Agent for the recent Registration of [Member
                                ID] on the [Date]. Your appointment has now been entered into the E4U database. You
                                can now log into the Agent Console and proceed to manage your Massage Centre’s
                                Account and Profiles.
                            </p>

                            <h3 style="margin-top: 25px;">Logging in</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 10px;">The following information will assist you when logging in:</p>
                            <ul style="padding-left: 20px; font-size: 15px; text-align: justify;">
                                <li>Web address: <a href="http://www.e4u.com.au" target="_blank">www.e4u.com.au</a></li>
                                <li>Username: {{$agentUser->phone ?? ''}} <em>(your mobile number)</em></li>
                                <li>Password: xxxxxxxxx <em>(please note passwords are case sensitive)</em></li>
                            </ul>
                            <p style="font-size: 13px; font-style: italic;">Note: Your logging in process is also subject to SMS 2FA verification. It is a good idea to bookmark
                                the Website.</p>

                            <h3 style="margin-top: 30px;">Your Massage Centre’s My Account</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Now that you have been appointed Agent, before you can create a Profile and Masseur
                                Profiles, you should spend a little time setting up their Account information. This will make
                                the experience when creating a Profile for the business, together with the Masseur Profiles,
                                much easier and quicker for you.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Simply log in and go to ‘My Advertisers’ and select Advertiser List and complete the
                                            following important settings from within the Massage Centre’s My Account:
                            </p>
                            <ul style="font-size: 15px; padding-left: 20px; text-align: justify;">
                                <li>Edit my Account - ‘About us’ and ‘Profile Contact Options’ (some settings are
                                    enabled by default)</li>
                                <li>Profile Information - ‘Additional Information About Us’, ‘Our Rates’, ‘Our Open
                                    Times’, ‘Our Services (tags)’ and ‘Our Social Media’; and</li>
                                <li>Notifications & Features (some settings are enabled by default)
                                </li>
                            </ul>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Once you have completed these important settings, then next go to Media, and upload the
                                Massage Centre’s photos and video for their business and select which will be your default
                                Media. It is recommended that the Banner image which will appear at the top of the Profile
                                perhaps be a photo of the business premises.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                If the Massage Centre has regular Masseurs then it would also be helpful to set up the
                                Masseurs’ Profiles. To achieve this go to Masseur Profiles > Add Profile as well as > Add
                                Media.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                All of these Account settings have help information to assist you. You only have to do this
                                once, but you can change any of the information by either going back to these settings, or
                                by updating them when you create or edit a Profile (including the Masseur Profiles, which
                                form a part of the Profile).
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
                            This is an automatically generated email by the Escorts4u Operations Centre.<br>
                            &copy; Copyright {{date('Y')}} Blackbox Tech Pty Ltd. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
