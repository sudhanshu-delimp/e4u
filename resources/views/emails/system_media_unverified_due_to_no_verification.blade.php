<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Media Status Update</title>
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
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo"
                                            style="height: 50px;">
                                    </td>
                                   
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        Media Status - Unverified<br>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Member ID: {{ $body['member_id'] }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            
                            <!-- Greeting -->
                            <p style="font-size: 18px; margin: 0 0 15px 0;">
                                <b>Dear {{ $body['name'] ?? 'Member' }},</b>
                            </p>

                            <!-- Message -->
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                As you have not uploaded a Media Verification image within the required 48 hours, your Media status has been changed to Unverified.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                You can submit a Media Verification image at any time, and once reviewed, 
                                your Media can be verified.
                            </p>

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
                    style="background-color:#0c223d; padding: 0px; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
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