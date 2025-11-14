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
                                        <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo" style="height: 50px;">
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

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We are pleased to confirm your Registration has been accepted and you can now log into the Escort Console and proceed to create Profiles and Tours.
                            </p>

                            <h3 style="margin-top: 25px;">Logging in</h3>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 10px;">
                                The following information will assist you when logging in:
                            </p>
                            <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                <li>Web address: <a href="http://www.e4u.com.au" target="_blank">www.e4u.com.au</a></li>
                                <li>Username: {{$user->phone}} <em>(Your mobile number)</em></li>
                                <li>Password: {{$user->password}} <em>(please note passwords are case sensitive)</em></li>
                            </ul>
                            <p style="font-size: 13px; font-style: italic;">Note: Your logging in process is also subject to SMS 2FA verification. It is a good idea to bookmark the Website.</p>

                            <h3 style="margin-top: 30px;">Welcome</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Now that you have completed your Registration, before you can create any Profiles or Tours, you need to spend a little time setting up your Account information. This will make your experience when creating a Profile or Tour much easier and quicker for you.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">Simply log in and go to ‘My Account’ and complete the following important settings:</p>
                            <ul style="font-size: 15px; padding-left: 20px; line-height: 1.6;">
                                <li>Edit my Account - ‘About me’ and ‘Profile and Tour Options’ (some settings are enabled by default)</li>
                                <li>Profile Information - ‘My Additional Information’, ‘My Available Times’, ‘My Playmates’, ‘My Rates’, ‘My Service (tags)’ and ‘My Social Media’</li>
                                <li>Notifications & Features (some settings are enabled by default)</li>
                            </ul>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Once you have completed these important settings, then next go to Media, and upload your photos and video and select which will be your default Media. You can verify your photos here.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6;">
                                All of these Account settings have help information to assist you. You only have to do this once, but you can change any of the information by either going back to these settings, or by updating them when you create a Profile. This is particularly helpful when creating multiple Profiles for your Location or for a Tour.
                            </p>

                            <h3 style="margin-top: 30px;">Appointing an Agent</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                If you haven’t already, you can appoint a Support Agent at any time. Simply log in and go to Communication > Agent Request, and complete the form. A Support Agent can assist you with all matters to do with your Account, Media, Profiles, Tours and Concierge Services. We highly recommend you appoint a Support Agent, although this is optional.
                            </p>

                            <h3 style="margin-top: 30px;">Browsers</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                For the best performance of the Website we recommend you use the latest version of a modern browser. The Website is best supported by Chrome, Firefox and Edge.
                            </p>

                            <h3 style="margin-top: 30px;">How to Contact Us</h3>
                            <p style="font-size: 15px; line-height: 1.6;">
                                Our goal is to deliver an excellent service and user experience to you. Please don't hesitate to get in touch if you require any assistance, or contact your Support Agent if you have appointed one. You can reach the E4U Help Desk by logging a 'Support Ticket' from your Dashboard, or by forwarding a message from the ‘Contact Us’ page located in the Website footer.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Welcome to Escorts4U, we hope your experience with us is a pleasant one.
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
