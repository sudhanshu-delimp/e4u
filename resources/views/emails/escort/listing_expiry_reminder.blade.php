<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listing Expiry Reminder</title>
    
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
                                        <h1 style="margin: 0; font-size: 22px; color:#ffffff; text-align: right;">Listing Expiry Reminder - Escort</h1>
                                        <div style="font-weight: 500;">Member ID: {{$escort->user->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Body content -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$escort->user->name ?? ''}},</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Your Escort Profile **{{ $escort->name ?? 'on our site' }}** listing is set to expire on  {{ \Carbon\Carbon::parse($escort->end_date)->format('d-m-Y') }}.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                For your Profile to continue to be Listed, please extend your Profile Listing before the expiry date.
                            </p>
                            <div style="text-align: center; margin:30px 0px;">
                                <a href="{{route('escort.list','current')}}" style="background:#0c223d; font-size:14px;border-radius:5px; color:#fff; padding:10px; text-decoration:none;">Extend Now</a>
                            </div>
                            
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
