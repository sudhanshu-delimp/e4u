<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Reset Password - Request</title>
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
                                         Reset Password - Request<br>
                                         <span style="font-size: 13px; color: #cccccc;">Ref:
                                            {{ $body['ref'] }}</span><br>
                                            
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $body['member_id'] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{ $body['name'] }},</p>
                            <!-- Main Message -->
                            
                            <h4 style="font-size: 17px; line-height: 1.6; margin-bottom: 15px;">
                                Request to reset your Password
                            </h4>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We have received a request to reset your password. Click the button below to create a new
password for your Account.
                            </p>
                            <div style="text-align:center;margin:20px 0px;"><a href="{{$body['url']}}" style="background-color:#0c223d;  padding:10px 20px; color:#fff; text-decoration:none;">Reset Password</a></div>
                            <p>If you did not make this request, then no further action is required on your part.</p>
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



