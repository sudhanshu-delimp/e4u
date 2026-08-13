


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Profile Listing Notification</title>
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
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Profile Listing Notification</h1>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID : {{ $member_id }}</span>
                            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{ $viewer_name }},</p>
                            <!-- Main Message -->

                           
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                    One of your favorite Escorts, {{ $name }} wants you to know they will be
                                    visiting your Location from {{ $start_date }} and leaving on the {{ $end_date }}. They
                                    would love to catch up with you.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Here is a link to their Profile   {!! $profile_url !!} 
                            </p>

                           
                            
                            <!-- email info -->
                                <x-email-info/>
                            <!-- end -->
                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; font-family:Arial, sans-serif; color:#ffffff !important; font-size:12px; text-align:center;">
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