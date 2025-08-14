<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Registration - Escort</title>
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
                                        <h1 style="margin: 0; font-size: 22px; color: #ffffff; text-align: right;">
                                            New Registration - Massage Centre
                                        </h1>
                                        <div style="font-weight: 500;">Member ID: {{$user->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <!-- Content -->
                            <p style="font-size: 16px; font-weight: bold; margin: 0 0 15px 0;">Attention Operations</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                The following Massage Centre Registration was made on the {{$user->create_at}}. Details
                                of the registration are:
                            </p>

                            <table cellpadding="0" cellspacing="0" style="font-size: 15px; line-height: 1.8; margin-bottom: 20px; text-align: justify;">
                                <tr>
                                    <td style="padding-right: 10px; font-weight: bold;">Mobile:</td>
                                    <td>{{$user->phone ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-right: 10px; font-weight: bold;">Email:</td>
                                    <td>{{$user->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-right: 10px; font-weight: bold;">Location:</td>
                                    <td>{{$user->location ?? ''}}</td>
                                </tr>
                                @if($user->agent_id)
                                <tr>
                                    <td style="padding-right: 10px; font-weight: bold;">Agent ID:</td>
                                    <td>{{$user->agent_id}}</td>
                                </tr>
                                @endif
                            </table>

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
