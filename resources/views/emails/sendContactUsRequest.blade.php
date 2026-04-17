<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Us Request</title>
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
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle;">
                                       <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Contact Us Request</h1>
                                        <span style="font-size: 13px;color:#ccc;">Ref: {{ $body['ref_number'] }}</span>
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 18px; margin: 0 0 15px 0;"><b>Attention Operations</b></p>

                             <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                A User has logged a request for contact. Details are:
                            </p>

                            <!-- Info Table -->
                            <table cellpadding="8" cellspacing="0" border="0"
                                style="width: 100%; font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td style=" width: 180px; padding-left: 0;">First Name:</td>
                                    <td>{{ $body['first_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 0;">Second Name:</td>
                                    <td>{{ $body['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 0;">Email:</td>
                                    <td>{{ $body['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 0;">Comments (by {{ $body['role_type'] }}):</td>
                                    <td>{{ $body['message'] }}</td>
                                </tr>
                               
                            </table>
                            <!-- Closing -->
                             <!-- email info -->
                                <x-email-info/>
                            <!-- end -->
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d;  font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
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
